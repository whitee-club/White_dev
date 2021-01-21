@extends('layouts.app')

@section('content')
<a href="/hokage-kakashi/reports"> Reports</a>
<h2>User Count:-</h2><h3>{{$users->count()}}</h3>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		
@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td>
				@if($user->isOnline())
					<li class="text-success">
						Online
					</li>
				@else
					<li class="text-muted">
						Offline
					</li>	
				@endif
			</td>

		</tr>
@endforeach		
	</tbody>	
</table>

@endsection