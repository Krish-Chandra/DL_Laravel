@extends('layouts.app')

@section('content')
	<div>
			<p>
				<a href="{{ url('admin/author/addnewauthor') }}" class="btn btn-primary">Add Author</a>				
			</p>

			@if (count($authors) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Authors
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
								@for ($i = 0; $i < count($authors); $i++)
									<tr>
										<td>{{$authors[$i]['authorname']}}</td>
										<td>{{$authors[$i]['address']}}</td>
										<td>{{$authors[$i]['city']}}</td>
										<td>{{$authors[$i]['state']}}</td>
										<td>{{$authors[$i]['zip']}}</td>
										<td>{{$authors[$i]['email_id']}}</td>
										<td>{{$authors[$i]['phone']}}</td>
										<td>
											<ul class="list-inline list-unstyled">
												<li>
													<a href="{{ url('admin/author/editauthor/'. $authors[$i]['id'])}}" class="btn btn-xs btn-link " title="Edit the author">
														<i class="glyphicon glyphicon-edit"></i>
													</a>
												</li>
												<li>
											        <form action="{{ url('admin/author/deleteauthor/') }}" method="POST">
											            {!! csrf_field() !!}
											            <!-- {!! method_field('DELETE') !!} -->

														<input value="{{$authors[$i]['id']}}" name="authorId" type="hidden">
											            <button type="submit" class="btn btn-xs btn-link" title="Delete the author">
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
