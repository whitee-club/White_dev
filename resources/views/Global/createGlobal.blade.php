@extends('layouts.app')

@section('content')
<!DOCTYPE>
<html>

<head>
    <title>White</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/problemCreate.css') }}">
    

</head>

<body>
   

    <div class="container">
        <div class="row">
            <div class="daddy-div col-10 d-md-flex flex-md-row">
                <div class="disclaimer col-12 col-md-6 text-center">
                    <h1>Disclaimer</h1>
                    <br>Anonymously share whats been bothering you in a non abusive manner and give others a chance to help.
                    
                    
                    <div class="bg">
                        <img id="bg" src="/png/sleepindark.png" alt="">
                    </div>
                </div>

                <div class="col-12 col-md-6 px-0">
                    <form method="POST" action="/global-post">
                        @csrf
                       
                        <textarea placeholder="Type Here..." id="problem" type="text"
                            class="form-control @error('problem') is-invalid @enderror" name="problem"
                            value="{{ old('problem') }}" required autocomplete="problem" autofocus></textarea>

                        @error('problem')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="col-md-12">
                            <div class="eye col-9 text-center">
                                <img src="/png/girl.png">
                            </div>
                            <button class="float-right" type="submit">
                                {{ __('Share') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="stare">
        <img src="/png/stare.png">
    </div>
    <div class="thinkMob d-block d-md-none">
        <img src="/png/sleepindark.png" alt="">
    </div>

</body>

</html>

@endsection