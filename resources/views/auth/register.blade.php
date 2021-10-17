<x-layout>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4 offset-md-4 mb-5">

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{route('register')}}" class="mt-5">
          @csrf
          <div class="mb-3">
            <label for="exampleInputText1" class="form-label">Nome</label>
            <input type="text" name='name' class="form-control" id="exampleInputText1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Indirizzo Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Conferma Password</label>
            <input type="password" name='password_confirmation' class="form-control" id="exampleInputPassword2">
          </div>
          <button type="submit" class="btn btn-primary">Invio</button>
        </form>
        
      </div>
    </div>
  </div>
</x-layout>