
 @extends('layouts.app')

@section('content')
	<div>
			<div class="panel panel-primary"  style="width:600px;">
				<div class="panel-heading">
					Add Book
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<form action="{{URL::to('/')}}/admin/book/addnewbook" method="POST">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="title" class="control-label">Title</label>
							<div>
								<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" >
							</div>
						</div>
						<div class="form-group">
							<label for="author_id" class="control-label">Author</label>
							<div>
								<select name="author_id" id="author_id" class="form-control">
									@for ($i = 0; $i < count($auths); $i++)
										<option value="{{$auths[$i]['id']}}" {{old('author_id') == $auths[$i]['id'] ? ' selected' : '' }}>{{$auths[$i]['authorname']}}</option>
									@endfor
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="publisher_id" class="control-label">Publisher</label>
							<div>
								<select name="publisher_id" id="publisher_id" class="form-control">
									@for ($i = 0; $i < count($pubs); $i++)
										<option value="{{$pubs[$i]['id']}}" {{old('publisher_id') == $pubs[$i]['id'] ? ' selected' : '' }}>{{$pubs[$i]['publishername']}}</option>
									@endfor
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="category_id" class="control-label">Category</label>
							<div>
								<select name="category_id" id="category_id" class="form-control">
									@for ($i = 0; $i < count($cats); $i++)
										<option value="{{$cats[$i]['id']}}" {{old('category_id') == $cats[$i]['id'] ? ' selected' : '' }}>{{$cats[$i]['categoryname']}}</option>
									@endfor
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="isbn" class="control-label">ISBN</label>
							<div>
								<input type="text" name="isbn" id="isbn" class="form-control" value="{{old('isbn')}}" >
							</div>
						</div>

						<div class="form-group">
							<label for="total_copies" class="control-label">Total Copies</label>
							<div>
								<input type="number" name="total_copies" id="total_copies" class="form-control" value="{{old('total_copies')}}" >
							</div>
						</div>
<!-- 						<div class="form-group">
							<label for="available_copies" class="control-label">Available Copies</label>
							<div>
								<input type="number" name="available_copies" id="available_copies" class="form-control" value="{{old('available_copies')}}"  >
							</div>
						</div>
 -->						
						<div class="form-group">
								<button type="submit" class="btn btn-primary">
									Add
								</button>
								<a href="{{URL::to('/')}}/admin/book" class="btn btn-warning">Cancel</a>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection
