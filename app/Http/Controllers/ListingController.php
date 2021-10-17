<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ListingRequest;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;
use Illuminate\Support\Facades\Bus;


class ListingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show','getByCategory', 'search', 'locale']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::where('is_accepted', true)->orderBy('created_at','desc')->take(5)->get();
        return view('home', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $uniqueSecret = $request->old("uniqueSecret", base_convert(sha1(uniqid(mt_rand())), 16, 36));
        return view('listing.create', compact('categories', 'uniqueSecret'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ListingRequest $request
     * @return \Illuminate\Http\Response
     */

    // public function newListing(Request $request){
    //     $uniqueSecret = $request->old(
    //         "uniqueSecret", 
    //         base_convert(sha1(uniqid(mt_rand())), 16, 36)
    //     );
    //     return view("listings.new", compact("uniqueSecret"));
    // }

    public function store(ListingRequest $request)
    {
        $listing = Listing::create([
            'title'=>$request->title,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=>$request->category,
            'user_id'=>Auth::id(),
        ]);

        $uniqueSecret = $request->input("uniqueSecret");
        
        $images = session()->get("images.{$uniqueSecret}",[]);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);        

        $images = array_diff($images, $removedImages);

        foreach ($images as $image) {
            $i = new ListingImage();
            $fileName = basename($image);


            // la path nel db si intende esclusa da storage/ perche' poi viene aggiunta quando
            // si chiama la getURL
            // mentre la destinazione sul filesystem deve includere public perche' e' configurato
            // in filesystem.php    
            $fsDestination = "/public/listings/{$listing->id}/{$fileName}";
            $dbDestination = "listings/{$listing->id}/{$fileName}";

            Storage::move($image, $fsDestination);

            $i->file = $dbDestination;
            $i->listing_id = $listing->id;
            $i->save();

            GoogleVisionSafeSearchImage::withChain([
                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),
                new ResizeImage($fsDestination, 300, 150),
                new ResizeImage($fsDestination, 400, 300),
            ])->dispatch($i->id);

        }
             
        
        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));


        return redirect(route('home'))->with('message', "Grazie " . Auth::user()->name . ", il tuo articolo ora è in revisione. Ti manderemo un'email una volta pubblicato.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listing.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ListingRequest  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
    }

    public function getByCategory(Category $category){
    
        $category_id = $category->id;
        
      
        // $listings = $category->listings()->where('is_accepted', true)->orderBy('created_at','desc')->paginate(5);
        $listings = Listing::where('category_id', $category_id)->get();
        return view('listing.getByCategory', compact('listings', 'category'));
    }

    public function search(Request $request){
        $q = $request->q;
        $listings = Listing::search($q)->where('is_accepted', true)->orderBy('created_at','desc')->get();
        return view('listing.search', compact('q','listings'));
    }

    

    public function uploadImages(Request $request){
       $uniqueSecret = $request->input("uniqueSecret");
       $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            120,
            120
        ));

       session()->push("images.{$uniqueSecret}", $fileName);
       return response()->json(
           [
               "id" => $fileName
           ]
        );
    }

    public function removeImages(Request $request){
        $uniqueSecret = $request->input("uniqueSecret");
        $fileName = $request->input("id");
        session()->push("removedimages.{$uniqueSecret}", $fileName);
        Storage::delete($fileName);
        return response()->json("ok");
    }

    public function getImages(Request $request){
        $uniqueSecret = $request->input("uniqueSecret");
        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        $data = [];

        foreach ($images as $image){
            $data[] = [
                "id" => $image,
                "src" => ListingImage::getUrlByFilePath($image, 120, 120)
            ];
        }

        return response()->json($data);
    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect(route('home'));
    }
 
}
