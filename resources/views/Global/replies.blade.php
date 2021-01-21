@extends('layouts.app')
@section('content')
<!DOCTYPE >
<html>
<head>
  
  <title></title>
  <meta charset="utf-8">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
<link rel="stylesheet" type="text/css" href="{{asset('/css/replies.css') }}">

 
</head>
<div class="info">
<h4>Here you can find all the people you've helped on global page and their replies </h4>
</div>
@if(count($responses) > 0)
@foreach($responses as $response )
<div class="replies-daddy">
  <div class="list">
    <i class="fas fa-ellipsis-v"></i>
  </div>
  <div class="question">
  <h3>{{$response->problem}}</h3>
</div>
      <div class="answer">
      <h4>{{$response->answer}}</h4>
</div>
<div class="rep">
	<h5>{{$response->response}}</h5>
</div>
</div>
@endforeach
@else 
<h4 class="rcd">Respond on <img src="/svg/rc.svg " alt=""><br>to get things to display here.<h4>
@endif
</body>
</html>
@endsection