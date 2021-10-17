<x-layout>

    @if (session('message'))
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 alert bg-grigioazzurro mt-3 text-center">
                    {{ session('message') }}
                </div>
            </div>  
        </div>
    @endif
    
    <!-- Welcome e barra ricerca -->
    <div class="container-fluid bg-grigiochiaro">
        <div class="row text-center">
            <div class="col-12 py-5">
                <h1>{{ __('ui.welcome') }}</h1>
            </div>
        </div>
        <form  method="GET" action="{{route('search')}}">
            <div class="row px-md-3 px-lg-5">
                <div class="col-1">
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-floating">
                        <input type="search" name="q" class="form-control">
                        <label for="floatingInputGrid">{{__('ui.find')}}</label>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control">
                        <label for="floatingInputGrid">{{{__('ui.city')}}}</label>
                    </div>
                </div>
        
                <div class="col-12 col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                        <option selected></option>
                        <option value="1">Uno</option>
                        <option value="2">Due</option>
                        <option value="3">Tre</option>
                        <option value="4">Quattro</option>
                        <option value="5">Cinque</option>
                        <option value="6">Sei</option>
                        <option value="7">Sette</option>
                        <option value="8">Otto</option>
                        <option value="9">Nove</option>
                        <option value="10">Dieci</option>
                        </select>
                        <label for="floatingSelectGrid">{{__('ui.findCategory')}}</label>
                    </div>
                </div>

                <div class="col-12 col-md-1 d-flex align-items-center justify-content-center mx-auto ms-lg-0 mt-3 mt-md-0">                    
                    <button class="btn btn-nav" type="submit">Cerca</button>                
                </div>
            </div>
        </form>
    </div>

    {{-- Ultimi annunci --}}
    <div class="container-fluid bg-grigiochiaro">
        <h2 class="text-center py-5">{{__('ui.latestListing')}}</h2>
        <div class="row row-cols-1 row-cols-md-2 px-2 px-md-5 pb-5 row-cols-lg-5">
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
                                    <a href="#" class="btn btn-anteprima popup-btn">Anteprima</a> 
                                </div>
                                <div class="col-6 col-md-6">
                                    <a href="{{route('listing.show', compact('listing'))}}" class="btn btn-nav details-btn">Dettagli</a>  
                                </div>
                            </div>                 

                        </div>
                    </div>
                    {{-- Pop-up --}}
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
                                    <h5>Firenze</h5>
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