<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.revisor');
    }

    public function index(){
        $listing = Listing::where('is_accepted', null)
            ->orderBy('created_at')
            ->first();
        
        return view('revisor.revisorHome', compact('listing'));
    }

    private function setAccepted($listing_id, $value){
        $listing = Listing::find($listing_id);
        $listing->is_accepted = $value;
        $listing->save();
        return redirect(route('revisor.home'));
    }

    public function accept($listing_id){
        return $this->setAccepted($listing_id, true)->with('message', "Hai accettato l'articolo.");
    }

    public function reject($listing_id){
        return $this->setAccepted($listing_id, false)->with('message', "Hai rifiutato l'articolo.");
    }


}
