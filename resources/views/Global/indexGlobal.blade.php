@extends('layouts.app')

@section('content')
<!DOCTYPE >
<html>
<head>
    <title>white</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{asset('/css/publicproblem.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

</head>
<body>
<div class="addNew">
    <a href="/global-create"><img src="/png/New Add.png"></a>
    <h3 class="tag">Feel It, Heal It, Help Them Deal It.</h3>
</div>
    @foreach($problems as $problem)
    <div class="daddy-div">
        <i class="fas fa-ellipsis-v fa-lg" ></i>

    <div class="query">
        Query
    </div>
               
                <div class="problem">
                 {{$problem->problem}}
                    
                </div>

               
                   

                    <form method="get" action="/global/problem/{{$problem->id}}">
                        @csrf
                        <button class="respond">
                            Respond
                        </button>
                    </form>
               

                
               
            </div>
            
        

@endforeach
</body>
</html>

@endsection


