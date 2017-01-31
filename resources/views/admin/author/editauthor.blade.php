@extends('layouts.app')

@section('content')
	<div>
		<div class="panel panel-primary"  style="width:600px;" >
			<div class="panel-heading">
				Edit Author
			</div>

			<div class="panel-body">
				@include('common.errors')

				<form action="{{URL::to('/')}}/admin/author/editauthor/{{$author->id}}" method="POST">
						{{ csrf_field() }}
						{!! method_field('PATCH') !!}

					<div class="form-group">
						<label for="authorname" class="control-label">Author Name</label>
						<div>
							<!-- <input type="text" name="authorname" id="authorname" class="form-control" value="{{$author->authorname}}" > -->
						
							<input type="text" name="authorname" id="authorname" class="form-control" value="{{ old('authorname') ?: $author->authorname}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="control-label">Address</label>
						<div>
							<input type="text" name="address" id="address" class="form-control" value="{{old('address') ?: $author->address}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="control-label">City</label>
						<div>
							<input type="text" name="city" id="city" class="form-control" value="{{old('city') ?: $author->city}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="state" class="control-label">State</label>
						<div>
							<input type="text" name="state" id="state" class="form-control" value="{{old('state') ?: $author->state}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="zip" class="control-label">Zip</label>
						<div>
							<input type="text" name="zip" id="zip" class="form-control" value="{{old('zip') ?: $author->zip}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Email ID</label>
						<div>
							<input type="text" name="email_id" id="email_id" class="form-control" value="{{old('email_id') ?: $author->email_id}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="control-label">Phone</label>
						<div>
							<input type="text" name="phone" id="phone" class="form-control" value="{{old('phone') ?: $author->phone}}" >
						</div>
					</div>
					
					<div class="form-group">
						<div>
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{URL::to('/')}}/admin/author" class="btn btn-warning">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endsection
