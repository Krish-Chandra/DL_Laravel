@extends('layouts.app')

@section('content')
	<div>
			<p>
				<a href="{{ url('admin/role/addnewrole') }}" class="btn btn-primary">Add Role</a>				
			</p>

			@if (count($roles) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Authors
					</div>

					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>Name</th>
								<th>Display Name</th>
								<th>Description</th>
								<th></th>
							</thead>
							<tbody>
								@for ($i = 0; $i < count($roles); $i++)
									<tr>
										<td>{{$roles[$i]['name']}}</td>
										<td>{{$roles[$i]['display_name']}}</td>
										<td>{{$roles[$i]['description']}}</td>
										<td>
											<ul class="list-inline list-unstyled">
												<li>
													<a href="{{ url('admin/role/editrole/'. $roles[$i]['id'])}}" class="btn btn-xs btn-link " title="Edit the Role">
														<i class="glyphicon glyphicon-edit"></i>
													</a>
												</li>
												<li>
											        <form action="{{ url('admin/role/'.$roles[$i]['id']) }}" method="POST">
											            {!! csrf_field() !!}
											            {!! method_field('DELETE') !!}

											            <button type="submit" class="btn btn-xs btn-link" title="Delete the Role">
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
