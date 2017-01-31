@extends('layouts.app')

@section('content')
	<div>
		<div class="panel panel-primary"  style="width:600px;" >
			<div class="panel-heading">
				Add Author
			</div>

			<div class="panel-body">
				@include('common.errors')

				<form action="{{URL::to('/')}}/admin/author/addnewauthor" method="POST">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="authorname" class="control-label">Author Name</label>
						<div>
							<input type="text" name="authorname" value="{{ old('authorname') }}" id="authorname" class="form-control" >
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="control-label">Address</label>
						<div>
							<input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="control-label">City</label>
						<div>
							<input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="state" class="control-label">State</label>
						<div>
							<input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="zip" class="control-label">Zip</label>
						<div>
							<input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Email ID</label>
						<div>
							<input type="text" name="email_id" id="email_id" class="form-control" value="{{ old('email_id') }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="control-label">Phone</label>
						<div>
							<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" >
						</div>
					</div>
					
					<div class="form-group">
						<div>
							<button type="submit" class="btn btn-primary">Add</button>
							<a href="{{URL::to('/')}}/admin/author" class="btn btn-warning">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endsection
