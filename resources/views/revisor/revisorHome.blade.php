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

 @if ($listing)
    <!-- Informazioni prodotto -->
    <div class="container-fluid bg-grigiochiaro">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 pt-5 px-lg-5">

          <div class="row">
            <div class="col-12 text-center">
              <h2>TITOLO: {{$listing->title}}</h2>
              <hr class="my-4">
            </div>
          </div>
          
          <div class="col-12 text-center">

            <div class="row justify-content-center pt-3">
              <div class="col-3">
                <p class="small">Luogo:</p>
              </div>
              <div class="col-3">
                <p class="small">Firenze</p>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-3">
                <p class="small">Utente:</p>
              </div>
              <div class="col-3">
                <p class="small">{{$listing->user->name}}</p>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-3">
                <p class="small">Postato il:</p>
              </div>
              <div class="col-3">
                <p class="small">{{$listing->created_at->format('d/m/y')}}</p>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-3">
                <p class="small">Categoria:</p>
              </div>
              <div class="col-3">
                <p class="small">{{$listing->category->name}}</p>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-3">
                <p class="small">Condizione:</p>
              </div>
              <div class="col-3">
                <p class="small">Come nuovo</p>
              </div>
            </div>

            <div class="col-12">
              <div class="row justify-content-center">
                <div class="col-3">
                  <p class="small">Prezzo:<p>
                </div>
                <div class="col-3">
                  <h3>€ {{$listing->price}}</h3>
                </div>               
              </div>
            </div>

          </div>
        </div>
      </div>
         
      <!-- Descrizione prodotto -->
      <div class="row justify-content-center">
        <div class="col-10">
          <hr class="mt-4 mb-5 mx-lg-4">
        </div>
        <div class="col-10 text-center mb-3">
          <h2>Descrizione del prodotto</h2>
        </div>
        <div class="col-10 text-break px-5">
          <p>{{$listing->description}}</p>
        </div>
        <div class="col-10 pt-3 pt-md-5 text-center">
          <h4>#tag #tag</h4>
        </div>
      </div>
          
    </div>       
                            
    <!-- Sezione prodotto -->
    <div class="container-fluid bg-grigiochiaro">
      <!-- Prima sezione -->
      <div class="row pt-2">
          <!-- Card Immagini --> 
        <div class="col-12 py-5 revisor-padding revisor-card-padding">

          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($listing->images as $image)
              <div class="col">              
                <div class="card">
                  <img src="{{$image->getUrl(300, 150)}}" class="card-img-top" alt="...">
                  <div class="card-body bg-grigiochiaro">
                    <h4 class="card-title text-center py-2">Valutazione dell'immagine con ID: {{ $image->id }}</h4>
                    <div>
                      <h5 class="text-center small">Nome File:</h5>
                      <p class="text-center small"> {{ basename($image->file) }}</p>
                    </div>
                    <div class="text-center">
                      <h5 class="text-center small">Image URL:</h6>
                      <a class="small" href="{{ Storage::url($image->file) }}"> {{ Storage::url($image->file) }}</a>
                    </div>

                    <hr>

                    {{-- Contenuti&etichette --}}
                    <div class="container-fluid bg-grigiochiaro text-center p-0">
                      <div class="row">
                        <div class="col-12">
                          <h5 class="text-center py-3">Contenuti ed Etichette</h5>
                        </div>
                      </div>
  
                      <div class="card-text">
                        <div class="row d-flex align-items-center">
                          <div class="col-12 col-lg-5">
                            
                            {{-- Contenuti --}}
                            <div class="row">
                              <div class="col-6 col-lg-8">
                                <div>
                                  <h5>Adult: </h5>
                                </div>
                                <div>
                                  <h5>Spoof: </h5>
                                </div>
                                <div>
                                  <h5>Medical: </h5>
                                </div>
                                <div>
                                  <h5>Violence: </h5>
                                </div>
                                <div>
                                  <h5>Racy: </h5>
                                </div>
                                
                              </div>
  
                              {{-- Etichette --}}
                              <div class="col-6 col-lg-4 ps-lg-0">
                                <div>
                                  <span class="{{$image->stoplight($image->adult)}}"></span>
                                </div>
                                <div>
                                  <span class="{{$image->stoplight($image->spoof)}}"></span>
                                </div>
                                <div>
                                  <span class="{{$image->stoplight($image->medical)}}"></span>
                                </div>
                                <div>
                                  <span class="{{$image->stoplight($image->violence)}}"></span>
                                </div>
                                <div>
                                  <span class="{{$image->stoplight($image->racy)}}"></span>
                                </div>
                              </div>
                            </div>
  
                          </div>
  
                          {{-- Labels --}}
                          <div class="col-12 col-lg-7">
                            <ul class="list-group mt-2">
                              @if ($image->labels)
                                @foreach ($image->labels as $label)
                                  <li class="list-group-item bg-grigioazzurro">{{ $label }}</li> 
                                @endforeach
                              @endif
                            </ul>  
                          </div>
  
                        </div>                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

        </div>
      </div>        

      {{-- Bottoni accetta o rifiuta --}}
      <hr class="mt-2">
      <div class="row my-4">
        <div class="col-6 text-end">
          <form action="{{route('revisor.reject', $listing->id)}}" method="POST"> 
            @csrf               
            <button class="btn btn-danger"> Rifiuta </button>
          </form>                
        </div>
        <div class="col-6 text-start">
          <form action="{{route('revisor.accept', $listing->id)}}" method="POST">   
            @csrf             
            <button class="btn btn-success"> Accetta </button>
          </form>
        </div>
      </div>
  
    </div>

  @else
    <h2 class="text-center mt-5">{{__('ui.noRevisor')}}</h2>
    
  @endif

</x-layout>