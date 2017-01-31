 @extends('layouts.app')
@section('content')
	<div>
			<div class="panel panel-primary"  style="width:600px;">
				<div class="panel-heading">
					Add Admin User
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<form action="{{URL::to('/')}}/admin/newadminuser" method="POST">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<div>
								<input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" >
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Email</label>
							<div>
								<input type="text" name="email" id="email" class="form-control" value="{{old('email')}}" >
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password</label>
							<div>
								<input type="password" name="password" id="password" class="form-control" >
							</div>
						</div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
							<div>
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
							</div>
                        </div>
						<div class="form-group">
							<label for="role_id" class="control-label">Role</label>
							<div>
								<select name="role_id" id="role_id" class="form-control">
									@for ($i = 0; $i < count($roles); $i++)
										<option value="{{$roles[$i]['id']}}" {{old('role_id') == $roles[$i]['id'] ? ' selected' : '' }}>{{$roles[$i]['name']}}</option>
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
