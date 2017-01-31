@extends('layouts.app')

@section('content')
	<div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					Add Category
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<form action="{{URL::to('/')}}/admin/category/createcategory" method="POST"  style="width:500px;" >
						{{ csrf_field() }}

						<div class="form-group">
							<label for="categoryname" class="control-label">Name</label>
							<div>
								<input type="text" name="categoryname" id="categoryname" class="form-control col-sm-6" value="{{old('categoryname')}}"  >
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="control-label">Description</label>
							<div>
								<input type="text" name="description" id="description" class="form-control col-sm-6" value="{{old('description')}}"  >
							</div>
						</div>
						
						<div class="form-group">
							<div>
								<button type="submit" class="btn btn-primary">Add</button>
								<a href="{{URL::to('/')}}/admin/category" class="btn btn-warning">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection
