@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <link rel="stylesheet" type="text/css" href="{{asset('/css/problemShow.css') }}">
    </head>
    <body>
        <div class="daddy-div">
    
                <div class="left-div">

                  <p> {{$problem->problem}} </p>
                   </div>
                   <div class="right-div">

                    <form method="post" action="/global/answer/{{$problem->id}}">
                        @csrf
                        
                            
                            
                                <textarea placeholder="Type Here..." id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" required autocomplete="answer" autofocus> 

                                </textarea>

                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                                <button id="but" class="desk" type="submit">
                                   <img src="/png/send.png" alt="">
                                </button>
                        
                        <button id="but" class="mobile" type="submit">
                                   <img src="/png/send.png" alt="">
                                </button>

                        
                        

                        
                        </div>
                        
                    </form>
                    </div>
             </div>   
    </body>
    </html>

@endsection


