@extends('layouts.app')

@section('content')

<table>
	<thead>
		<tr>
			<th>Report</th>
			<th>Section</th>
			<th>info</th>
		</tr>
	</thead>
	<tbody>
		
@foreach($reports as $report)
		<tr>
			<td>{{$report->reason}}</td>
			<td>{{$report->section}}</td>
<td>	<a href="/hokage-kakashi/report-details/{{$report->id}}" >		Go </a> </td>

		</tr>
@endforeach		
	</tbody>	
</table>

@endsection