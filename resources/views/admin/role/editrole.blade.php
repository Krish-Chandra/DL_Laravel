@extends('layouts.app')

@section('content')
	<div>
		<div class="panel panel-primary"  style="width:600px;" >
			<div class="panel-heading">
				Edit Role
			</div>

			<div class="panel-body">
				@include('common.errors')

				<form action="{{URL::to('/')}}/admin/role/editrole/{{$role->id}}" method="POST">
					{{ csrf_field() }}
					{!! method_field('PATCH') !!}

					<div class="form-group">
						<label for="name" class="control-label">Name</label>
						<div>
							{{$role->name}}
						</div>
					</div>
					<div class="form-group">
						<label for="display_name" class="control-label">Display Name</label>
						<div>
							{{$role->display_name}}
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="control-label">Description</label>
						<div>
							{{$role->description}}
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="control-label">Permissions</label>
						<div>
						@foreach($permissions as $permission)
							<input type="checkbox" name="permissions[]" id="permission" value={{$permission->name}}
							{{in_array($permission->name, $rolePermissions) ? 'checked' : ''}} > {{ucfirst($permission->name)}}
						@endforeach
						</div>
					</div>

					<div class="form-group">
						<div>
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{URL::to('/')}}/admin/role" class="btn btn-warning">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

