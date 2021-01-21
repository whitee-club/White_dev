@extends('layouts.app')

@section('content')

<!DOCTYPE >
<html>
<head>
  
  <title></title>
  <meta charset="utf-8">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
<link rel="stylesheet" type="text/css" href="{{asset('/css/homepage.css') }}">

 
</head>
<body onload="toggle_visibility('left');">
 
<div class="daddy-link" >
 
    <div class="link-header">

     <h4>
      <img src="/svg/link.svg">

Confession Link:
    </h4>

    </div>
      
     
       
  <input class="link" type="text" value="whitee.club/c/c/{{Auth::user()->uuid}}" id="myInput">
  

      <button onclick="myFunction()" class="link-but">
        <i class="fa fa-files-o" aria-hidden="true"></i>Link
      </button>

  </div>


<div class="toggle" >
  <div class="acc">
     <div class="allConfessions" onclick="toggle_visibility('left');">
        <button>All Confessions</button>
     </div>
       <span class="count" id="d">
         {{$confessions->count()}}
       </span>
     </div>
                <h1 class=fpn>|</h1>
            
         <div class="recieved" onclick="toggle_visibility('right');">
       <button>Received </button> 
      </div> 
      <h1 class="spn">|</h1>
       <div class="resp">
        <form action="/global-replies">
         <button>Responses</button>
         </form>
       </div>
     </div>



<div id="left">
@if(count($confessions) > 0)
  @foreach($confessions as $confession)
  <div class="confession">
 <div class="dropdown">
    <img src="/svg/option.svg" alt="" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="dropdown-menu" aria-labelledby="#navbarDropdown">
                        <a class="dropdown-item" href="/report-confession/{{$confession->id}}">Report</a>
  </div>
</div>
    <form action="/confessions/add/{{$confession->confessionFrom}}" method="POST">

     @csrf
     <div class="written">
    <h3> {{$confession->name ?? "NA"}}</h3><h1>|</h1><b>{{$confession->created_at}}</b>
 
  </div>
     

     <div class="body">
     <p>{{$confession->confession}}</p>
</div>

     <button class="chat-bt">
       Chat
     </button>
     

</form>

  
  </div>
@endforeach
@else
    <div class="cf">
      <h3>No Confessions Found</h3>
      <h4>Share <img src="/svg/cl.svg" alt="Confession link"> with friends to get confessions..</h4>
    </div> 
@endif
</div>

<div id="right">
@if(count($globals) > 0)
  @foreach($globals as $global)
<div class="replies-daddy">
  
    <div class="dropdown">
    <img src="/svg/option.svg" alt="" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="dropdown-menu" aria-labelledby="#navbarDropdown">
                        <a class="dropdown-item" href="/report-answer/{{$global->id}}">Report</a>
  </div>
</div>

 
  
  <div class="question">
  <h3>{{$global->problem}}</h3>
  </div>
      <div class="answer">
      <h4>{{$global->answer}}</h4>
      </div>
<form action="{{route('global.response',[$global->id])}}" method="post">
  @csrf

      <div class="emoji-toggle fa-4x">
       <div class="emo-left"> 
           <button  type="submit" name="resp" value="normal"> <img src="/svg/normal.svg"></button>
        </div>
        <div class="emo-mid">
          
        <button type="submit" name="resp" value="smile"> <img src="/svg/average.svg" > </button>
        </div>
        <div class="emo-right">
        <button type="submit" name="resp" value="happy"> <img src="/svg/max.svg" > </button>
        </div>
          
      </div>
        <div class="comment">
          
        
<input placeholder="Reply to that person here. And hit any emo button to send it." type="text" id="response" name="response" >

</form>
        </div>
</div>
  @endforeach
  @else
  <div class="nr">
    <h3>No Responses Found</h3>
  <h4>Share what's on your mind on <img src="/svg/globeblack.svg" alt="Globe Icon"> to receive responses..</h4>
  </div>
  @endif
</div>




@endsection
<script  type="text/javascript">
        top.visible_div_id = 'right';

        function toggle_visibility(id) {
            var old_e = document.getElementById(top.visible_div_id);
            var new_e = document.getElementById(id);
            if (old_e) {
                
                old_e.style.display = 'none';
            }
            
            new_e.style.display = 'block';
            top.visible_div_id = id;
        }

        function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
} 
    </script>

