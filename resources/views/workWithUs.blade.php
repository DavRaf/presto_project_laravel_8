<x-layout>
<h1 class="text-center my-5">{{__('ui.workWithUs')}}</h1>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4 mb-5">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{route('index')}}" class="mt-5">
                @csrf
                <div class="form-floating mb-3">
                    <textarea class="form-control" name='message' placeholder="Scrivi un messaggio" id="floatingTextarea2" style="height: 100px">{{old('message')}}</textarea>
                    <label for="floatingTextarea2">Messaggio</label>
                </div>
                <button type="submit" class="btn btn-primary">Invio</button>
            </form>
        </div>
    </div>
</div>













</x-layout>