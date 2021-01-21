@extends('layouts.app')

@section('content')
<!DOCTYPE >
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" type="text/css" href="{{asset('/css/confession.css') }}">


</head>
<body>

  <img id="pink" src="/png/pink.png">

                  <div class="daddy-div">

                    <img  src="/png/confession.png">
                    
                      <div class="name">
                        
                  {{ $confessingTo->name }}
                    
                          
                      </div>
                    
               

                <div class="problem">
                    <form method="POST" action="/confessions/created/{{$confessingTo->uuid}}">
                        @csrf

                       

                        <div class="form-group row">

                            <div class="col-md-6">
                                <textarea id="confession"
                                placeholder="Type Here..." 
                                name="confession"
                                type="text"
                                class="form-control @error('confession') is-invalid @enderror"
                                 value="{{ old('confession') }}" required autocomplete="confession" autofocus> </textarea>

                                @error('confession')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="respond">
                                    POST
                                </button>
                            </div>
                        </div>
                    </form>  

</div>
                  </div>
  
    <img id="art" src="/png/blue.png">
</body>
</html>                
@endsection
