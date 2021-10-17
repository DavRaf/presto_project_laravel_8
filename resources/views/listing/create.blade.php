<x-layout>
    <div class="container-fluid bg-grigiochiaro min-vh-100">
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
                
                <form method="POST" action="{{route('listing.store')}}" class="mt-5" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uniqueSecret" value="{{$uniqueSecret}}">
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Titolo (massimo 40 caratteri)</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="exampleInputText1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText2" class="form-label">Prezzo in Euro</label>
                        <input type="text" name="price" value="{{old('price')}}"  class="form-control" id="exampleInputText2" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleSelect" class="form-label">Categorie</label>
                        <select class="form-select" name="category" aria-label="Default select example" id="exampleSelect">
                            <option selected disabled value="">Scegli...</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option> <!-- mantenere old value -->
                            @endforeach
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" placeholder="Scrivi una descrizione del tuo articolo" id="floatingTextarea2" style="height: 100px">{{old('description')}}</textarea>
                        <label for="floatingTextarea2">Descrizione</label>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="images" class="col-md-12 col-form-label text-md-right">
                            Immagini
                        </label>
                        <div class="col-md-12">
                            <div class="dropzone" id="drophere"></div>
                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Invia</button>

                </form>
            </div>
        </div>
    </div>
</x-layout>