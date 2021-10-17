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
                   
  <!-- Sezione prodotto -->
  <div class="container-fluid bg-grigiochiaro">
    <!-- Prima sezione -->
    <div class="row pt-5">
      <!-- Carosello --> 
      <div class="col-12 col-md-6 px-md-5">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class='carousel-inner'>
            @for ($i = 0; $i < $listing->images->count(); $i++)
                @if ($i == 0)
                  <div class="carousel-item active">
                    <img src="{{$listing->images[$i]->getUrl(300, 150)}}" class='d-block w-100'>
                  </div>
                @else
                  <div class="carousel-item">
                    <img src="{{$listing->images[$i]->getUrl(300, 150)}}" class='d-block w-100'>
                  </div>
                @endif
            @endfor
          </div>
       
          @if (count($listing->images) > 1)  
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          @endif
        </div>
      </div>

     
      <!-- Parte centrale -->
      <div class="col-12 col-md-4 px-md-5">
        <div class="row">

          <div class="col-8">
            <h2>{{$listing->title}}</h2>
            <hr>
          </div>

          <div class="col-4 d-flex justify-content-center">
            <button class="btn btn-nav btn-wishlist"><p class="my-auto"><i class="fas fa-heart my-auto pe-1"></i>Wishlist</p></button>
          </div>

          <div class="col-12">
            <div class="row">
              <div class="col-4">
                <p class="small">Luogo:</p>
              </div>
              <div class="col-8">
                <p class="small">Firenze</p>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <p class="small">Postato il:</p>
              </div>
              <div class="col-8">
                <p class="small">{{$listing->created_at->format('d/m/y')}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <p class="small">Categoria:</p>
              </div>
              <div class="col-8">
                <p class="small">{{$listing->category->name}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <p class="small">Condizione:</p>
              </div>
              <div class="col-8">
                <p class="small">Come nuovo</p>
              </div>
            </div>
          </div>

          <hr>
          <div class="col-12 pb-1">
            <div class="row align-items-center">
              <div class="col-4">
                <p class="small">Prezzo:<p>
              </div>
              <div class="col-4">
                <h3 class="my-auto">€ {{$listing->price}}</h3>
              </div>
              <div class="col-4 d-flex justify-content-center">
                <button class="btn btn-nav btn-compra"><p class="my-auto"><i class="fas fa-wallet my-auto pe-1"></i>Contatta il venditore</p></button>
              </div>
            </div>
          </div>
              
          <hr class="mt-3">
          <div class="row">
            <div class="col-4">
              <p class="small">Pagamenti:</p>
            </div>
            <div class="col-8">
              <i class="fab fa-cc-paypal me-2"></i><i class="fab fa-google-pay me-2"></i><i class="fab fa-cc-visa me-2"></i><i class="fab fa-cc-mastercard me-2"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Informazioni sul venditore -->
      <div class="col-12 col-md-2 px-md-5">
        <h4 class="small">Venditore</h4>
        <p class="small">🖤🖤🖤🖤🤍</p>
        <p class="small">Feedback positivi: 80%</p>
        <hr>
        <a href=""><p class="small">Altri oggetti dallo stesso venditore</p></a>
        <a href=""><p class="small">Contatta il venditore</p></a>
        <a href=""><p class="small">Condividi questo oggetto</p></a>
      </div>
     
    </div>

    <!-- Descrizione prodotto -->
    <div class="row p-md-5">
      <div class="col-12 pb-3">
        <h2>Descrizione del prodotto</h2>
      </div>
      <div class="col-12 text-break">
        {{$listing->description}}
      </div>
      <div class="col-12 pt-3 pb-md-5 mt-5">
        <h4>#tag #tag</h4>
      </div>
    </div>

    <!-- Carosello Prodotti correlati -->
    <div class="row py-3 p-md-5 justify-content-center">
      <div class="col-12">
        <h2>Prodotti correlati</h2>
      </div>
      <div class="col-12">
        <img src="https://picsum.photos/2200/300" class="img-fluid" alt="">
      </div>
    </div>

  </div>
                             
</x-layout>