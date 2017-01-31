@extends('layouts.app')

@section('content')
	<div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					Edit Category
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<form action="{{URL::to('/')}}/admin/category/editcategory/{{$category->id}}" method="POST"  style="width:500px;" >
						{{ csrf_field() }}
						{!! method_field('PATCH') !!}

						<div class="form-group">
							<label for="categoryname" class="control-label">Name</label>
							<div>
								<input type="text" name="categoryname" id="categoryname" class="form-control" value="{{old('categoryname') ?: $category->categoryname}}" >
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="control-label">Description</label>
							<div>
								<input type="text" name="description" id="description" class="form-control" value="{{old('description') ?: $category->description}}" >
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
							<a href="{{URL::to('/')}}/admin/category" class="btn btn-warning">Cancel</a>
						</div>

						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection
