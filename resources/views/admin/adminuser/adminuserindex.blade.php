@extends('layouts.app')

@section('content')
	<div>
			<p>
				<a href="{{ url('admin/newadminuser') }}" class="btn btn-primary">Add Admin User</a>		
			</p>

			@if (count($adminUsers) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Admin Users
					</div>

					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th></th>
							</thead>
							<tbody>
								@for ($i = 0; $i < count($adminUsers); $i++)
									<tr>
										<td>{{$adminUsers[$i]['name']}}</td>
										<td>{{$adminUsers[$i]['email']}}</td>
										<td>{{!$adminUsers[$i]['roles']->isEmpty() ? $adminUsers[$i]['roles'][0]->name : 'No role'}}</td>
										<td>
											<ul class="list-inline list-unstyled">
												<li>
													<a href="{{ url('admin/adminuser/'. $adminUsers[$i]['id'])}}" class="btn btn-xs btn-link " title="Edit the admin user">
														<i class="glyphicon glyphicon-edit"></i>
													</a>
												</li>
												<li>
											        <form action="{{ url('admin/adminuser/'. $adminUsers[$i]['id'])}}" method="POST">
											            {!! csrf_field() !!}
											            {!! method_field('DELETE') !!}

														<input value="{{$adminUsers[$i]['id']}}" name="adminUserId" type="hidden">
											            <button type="submit" class="btn btn-xs btn-link" title="Delete the admin user">
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
