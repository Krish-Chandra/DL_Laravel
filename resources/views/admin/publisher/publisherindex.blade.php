@extends('layouts.app')

@section('content')
	<div>
			<p>
				<a href="{{ url('admin/publisher/addnewpublisher') }}" class="btn btn-primary">Add Publisher</a>				
			</p>

			@if (count($publishers) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Publishers List
					</div>

					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>Name</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								<th>Email ID</th>
								<th>Phone</th>
								<th></th>
							</thead>
							<tbody>
								@for ($i = 0; $i < count($publishers); $i++)
									<tr>
										<td>{{$publishers[$i]['publishername']}}</td>
										<td>{{$publishers[$i]['address']}}</td>
										<td>{{$publishers[$i]['city']}}</td>
										<td>{{$publishers[$i]['state']}}</td>
										<td>{{$publishers[$i]['zip']}}</td>
										<td>{{$publishers[$i]['email_id']}}</td>
										<td>{{$publishers[$i]['phone']}}</td>
										<td>
											<ul class="list-inline list-unstyled">
												<li>
													<a href="{{ url('admin/publisher/editpublisher/'. $publishers[$i]['id'])}}" class="btn btn-xs btn-link " title="Edit the Publisher">
														<i class="glyphicon glyphicon-edit"></i>
													</a>
												</li>
												<li>
											        <form action="{{ url('admin/publisher/deletepublisher/') }}" method="POST">
											            {!! csrf_field() !!}
											            <!-- {!! method_field('DELETE') !!} -->

														<input value="{{$publishers[$i]['id']}}" name="publisherId" type="hidden">
											            <button type="submit" class="btn btn-xs btn-link" title="Delete the Publisher">
											                <i class="glyphicon glyphicon-remove"></i>
											            </button>
											        </form>
												</li>
											</ul>
										</td>
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
			@endif
	</div>
@endsection
