@extends('layouts.app')

@section('content')
	<div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				Requests
			</div>

			<div class="panel-body">
			@if (count($requests) > 0)			
				<table class="table table-bordered table-striped">
					<thead>
						<th>Book</th>
						<th>Author</th>
						<th>Total Copies</th>
						<th>Available Copies</th>
						<th>Requested By</th>
						<th>Requested On</th>
					</thead>
					<tbody>
						@for ($i = 0; $i < count($requests); $i++)
							<tr>
								<td>{{$requests[$i]['book']['title']}}</td>
								<td>{{$requests[$i]['book']['author']['authorname']}}</td>
								<td>{{$requests[$i]['book']['total_copies']}}</td>
								<td>{{$requests[$i]['book']['available_copies']}}</td>
								<td>{{$requests[$i]['user']->name}}</td>
								<td>{{$requests[$i]['request_date']}}</td>
								<td>
							        <form action="{{ url('admin/request/issuebook/'. $requests[$i]->id
									)}}" method="POST">
							            {!! csrf_field() !!}
							            
							            <button type="submit" title="Issue the book to the User?" class="btn btn-xs btn-link" id="issue-book-{{ $requests[$i]['id'] }}" >
							                <i class="glyphicon glyphicon-ok" aria-hidden="true"></i>
							            </button>
							        </form>
								</td>
							</tr>
						@endfor
					</tbody>
				</table>
			</div>
			@else
				<div class="alert alert-warning">
					<span>No requests for books!</span>
				</div>
			@endif
			
		</div>
	</div>
@endsection
