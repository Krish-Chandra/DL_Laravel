 @extends('layouts.app')
@section('content')
	<div>
			<div class="panel panel-primary"  style="width:600px;">
				<div class="panel-heading">
					Edit Admin User
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<form action="{{URL::to('/')}}/admin/adminuser/{{$adminUser->id}}" method="POST">
						{{ csrf_field() }}
						{!! method_field('PATCH') !!}

						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<div>
								<!-- <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" > -->
								{{$adminUser->name}}
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Email</label>
							<div>
								<input type="text" name="email" id="email" class="form-control" value="{{old('email') ?: $adminUser->email}}" >
							</div>
						</div>
						<div class="form-group">
							<label for="role_id" class="control-label">Role</label>
							<div>
								@php 
									$userRoleId = old('role_id') ?: $adminUser->roles()->get()->first() != null ? $adminUser->roles()->get()->first()->id : ""
								@endphp

								<select name="role_id" id="role_id" class="form-control">
									<option value="">Select a Role</option>
									@for ($i = 0; $i < count($roles); $i++)
										<option value="{{$roles[$i]['id']}}" {{$userRoleId == $roles[$i]['id'] ? ' selected' : '' }}>{{$roles[$i]['name']}}</option>
									@endfor
								</select>
							</div>
						</div>

						<div class="form-group">
							<div>
								<button type="submit" class="btn btn-primary">
									Add
								</button>
								<a href="{{URL::to('/')}}/admin/adminuser" class="btn btn-warning">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection
