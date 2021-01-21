  
<!DOCTYPE >
<html>
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css') }}">
</head>
<body>


    
<div class="daddy-div">
 
   <img id="logo" src="/png/w.png">
<img  id="tagline" src="/svg/tag.svg">
<div class="tagline">
    <p class="apts">A place to share,</p>
    <p class="wnc">Where nameless care.</p>
</div>


<div class="right-div">
    

    
    <div class="inputs">
    <form action="{{ route('login') }}" method="post">
        @csrf

    <div class="email">
        
         <input id="email" placeholder="E-Mail" type="email" class="na @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                                @error('email')
                                    <span  role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        
    </div>

            <div class="password">
                
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                                @error('password')
                                    <span  role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

            </div>
            <div class="register">
                <button class="login" type="submit">Login</button>
            </div>
                                @if (Route::has('password.request'))

                                <div class="fpass">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>

                                    
                                @endif
    </form>

<div class="click-here">
     
     <a href="{{ route('register') }}" class="ch"> Click Here To Register</a>
</div>
</div>

    
</div>


</div>

</body>
</html>



