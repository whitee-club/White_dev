
<!DOCTYPE >
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<link rel="stylesheet" type="text/css" href="{{asset('/css/register.css') }}">
</head>
<body>

    <div class="daddy-div">
 

    
    <img id="logo" src="/png/w.png">
    
        <img id="tagline" src="/svg/tag.svg">
        <div class="tagline">
    <p class="apts">A place to share,</p>
    <p class="wnc">Where nameless care.</p>
</div>
    


<div class="right-div">
    

       <div class="inputs">
    <form action="{{ route('register') }}" method="post">
        @csrf

    <div class="name">

        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        
    </div>

    <div class="email">
       
         <input id="email" placeholder="E-Mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" r>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        
    </div>
            <div class="gender">
               <label class="male">Male</label>  <input type="radio" name="gender" value="male" class="maleInput"> 
                <label class="female">Female</label> <input type="radio" name="gender" value="female" class="femaleInput"> 
            </div>

            <div class="password">
               
                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

            </div>

             <div class="form-group row">
                            

                            <div class="col-md-6">
                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
            
            
                
                 <button class="register" type="submit">
                                    Register
                                </button>
           
    </form>

</div>

    
</div>


</div>

</body>
</html>



