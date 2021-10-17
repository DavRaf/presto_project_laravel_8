<x-layout>

    @if (session('message'))
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 alert alert-success">
                    {{ session('message') }}
                </div>
            </div>  
        </div>
    @endif

    <div class="container-fluid bg-grigiochiaro">
        <h2 class="text-center py-5">Gli ultimi annunci della categoria {{$category->name}}</h2>
        <div class="row row-cols-1 row-cols-md-2 px-2 px-md-5 pb-5 row-cols-lg-4">
            @foreach ($listings as $listing)
            <!-- Card prodotto e card del suo popup -->
            <div class="col product">
                    
                <div class="card d-flex">
                    @if (count($listing->images) > 0)
                        <img src="{{$listing->images[0]->getUrl(300, 150)}}" 
                        class="card-img-top img-fluid p-1 bg-grigioazzurro" 
                        alt="...">                             
                    @endif
                    <div class="card-body text-center">
                        
                        <div class="row">
                            <div class="col-6">
                                <h5 class="small text-start">{{$listing->category->name}}</h5>
                            </div>
                            <div class="col-6 text-end">
                                <h5 class="small">Inserito il {{$listing->created_at->format('d/m/y')}}</h5>
                            </div>
                            <hr class="p-2 bg-grigioazzurro mt-1">
                        </div>

                        <div class="row mt-2">
                            <h4 class="card-title">{{$listing->title}}</h4>   
                        </div>
                        
                        <div class="row mt-4">                                
                            <h2>Prezzo: €{{$listing->price}}</h2>                                
                        </div>

                        <div class="row mt-4">
                            <div class="col-6 col-md-6">
                                <a href="#" class="btn btn-nav popup-btn">Anteprima</a> 
                            </div>
                            <div class="col-6 col-md-6">
                                <a href="{{route('listing.show', compact('listing'))}}" class="btn btn-nav details-btn">Dettagli</a>  
                            </div>
                        </div>                 

                    </div>
                </div>
    
                <div class="popup-view">
                    <div class="popup-card">
                        <a><i class="fas fa-times close-btn"></i></a>
                        <div class="product-img">                                
                            <div class="col-10 ps-md-0 ms-md-0">
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                    <div class='carousel-inner data-interval="1000"'>
                                        @for ($i = 0; $i < $listing->images->count(); $i++)
                                            @if ($i == 0)
                                            <div class="carousel-item active text-center" data-bs-interval="2000">
                                                <img class="img-fluid" src="{{$listing->images[$i]->getUrl(300, 150)}}" class='d-block w-100'>
                                            </div>
                                            @else
                                            <div class="carousel-item text-center" data-bs-interval="2000">
                                                <img class="img-fluid" src="{{$listing->images[$i]->getUrl(300, 150)}}" class='d-block w-100'>
                                            </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>                                      
                        </div>

                        <div class="row info">
                            <div class="col-12">
                                <h4>{{$listing->title}}</h4> 
                            </div>
                            <div class="col-12 my-3">
                                <h5>Dove si trova</h5>
                            </div>
                            <div class="col-12 pb-1">
                                <p class="truncated">{{$listing->description}}</p>
                            </div>
                            <div class="col-12 mb-sm-1 mb-md-2 mb-lg-5 pt-4">
                                <h2>PREZZO: € {{$listing->price}}</h2>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{route('listing.show', compact('listing'))}}" class="btn-nav details-btn">Dettagli</a>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        @endforeach   
        </div>
    </div>

</x-layout>

