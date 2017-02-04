@extends('layouts.app')

@section('content')
	<div>
		<div class="panel panel-primary"  style="width:600px;" >
			<div class="panel-heading">
				Add Role
			</div>

			<div class="panel-body">
				@include('common.errors')

				<form action="{{URL::to('/')}}/admin/role/addnewrole" method="POST">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="name" class="control-label">Name</label>
						<div>
							<input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="display_name" class="control-label">Display Name</label>
						<div>
							<input type="text" name="display_name" id="display_name" class="form-control" value="{{old('display_name')}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="control-label">Description</label>
						<div>
							<input type="text" name="description" id="description" class="form-control" value="{{old('description')}}"  >
						</div>
					</div>
					<div class="form-group">
						<label  class="control-label">Permissions</label>
						<div>
						@foreach($permissions as $permission)
							<input type="checkbox" name="permissions[]" id="permission" value={{$permission->name}}> {{ucfirst($permission->name)}}
						@endforeach

						</div>
					</div>

					<div class="form-group">
						<div>
							<button type="submit" class="btn btn-primary">Add</button>
							<a href="{{URL::to('/')}}/admin/role" class="btn btn-warning">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endsection
