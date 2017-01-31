@extends('layouts.app')

@section('content')
	<div>

			@if (count($issues) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Issues
					</div>

					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>Issued To</th>
								<th>Book</th>
								<th>Total Copies</th>
								<th>Available Copies</th>
								<th>Issued On</th>
								<th>Due On</th>
							</thead>
							<tbody>
								@for ($i = 0; $i < count($issues); $i++)
									<tr>
										<td>{{$issues[$i]['user']->name}}</td>
										<td>{{$issues[$i]['book']['title']}}</td>
										<td>{{$issues[$i]['book']['total_copies']}}</td>
										<td>{{$issues[$i]['book']['available_copies']}}</td>
										<td>{{$issues[$i]['issue_date']}}</td>
										<td>{{$issues[$i]['due_date']}}</td>
										<td>
									        <form action="{{ url('admin/issue/returnbook/'. $issues[$i]->id
											)}}" method="POST">
									            {!! csrf_field() !!}

									            <button type="submit" class="btn btn-xs btn-link" id="issue-book-{{ $issues[$i]['id'] }}" title="Has the book been returnded by the User?" >
									                <a><i class="glyphicon glyphicon-ok" aria-hidden="true"></i></a>
									            </button>
									        </form>

										</td>
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
			@else
				<div class="alert alert-warning">
					<span>No book has been issued!</span>
				</div>
			@endif
	</div>
@endsection
