<div class="container-fluid px-0">
  
  <nav class="navbar navbar-expand-lg navbar-light bg-grigioazzurro justify-content-between">
    
    <div class="col-2">
      <a class="navbar-brand titolo ps-1 py-2" href="{{route('home')}}">
        <img src="/media/453-savings-pig-outline.gif" alt="" width="50" height="50" class="d-inline-block align-text-bottom logo">
        PRESTO.IT
      </a> 
    </div>
    
    <div class="col-10 py-3 pe-3 text-end">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
          
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{route('home')}}">{{ __('ui.home') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('listing.create')}}">{{ __('ui.newListing') }}</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ __('ui.category') }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($categories as $category)
              <li>
                <a class="dropdown-item" href="{{route('listing.getByCategory', compact('category'))}}">{{$category->name}}</a>
              </li>
              @endforeach
            </ul>
          </li>

          <li class="nav-item dropdown">
            
            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">{{__('ui.language')}}</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown03">
              <li class="nav-item d-flex">
                @include('components.locale', ['lang'=> 'it', 'nation'=> 'it'])
                <span class="pt-1">Italiano</span>
              </li>
              <li class="nav-item d-flex">
                @include('components.locale', ['lang'=> 'en', 'nation'=> 'gb'])
                <span class="pt-1">English</span>
              </li>
              <li class="nav-item d-flex">
                @include('components.locale', ['lang'=> 'fr', 'nation'=> 'fr'])
                <span class="pt-1">Français</span>
              </li>
            </ul>
          </li>
          
          @guest
                    
          <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Registrati</a></li>
          
          @else

          @if (!Auth::user()->is_revisor)
          <li class="nav-item"><a class="nav-link" href="{{route('workWithUs')}}">{{ __('ui.work') }}</a></li>
          @else
            <li class="nav-item">
              <a class="nav-link" href={{route('revisor.home')}}>
                {{__('ui.revisor')}}
                <span class="badge badge-pill badge-warning">{{
                  \App\Models\Listing::ToBeRevisionedCount()}}
                </span>
              </a>
            </li>
            {{-- <li class="nav-item"><a class="nav-link" href="">{{ __('ui.trash') }}</a></li>           --}}
          @endif
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ __('ui.profile') }}, {{Auth::user()->name}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                document.getElementById('form-logout').submit();">Logout</a>
              </li>
              <form method="POST" action="{{route('logout')}}" id="form-logout">
                @csrf
              </form>
            </ul>
          </li>
          
          @endguest
          
        </ul>
      </div>
    </div>
  </nav>
</div>