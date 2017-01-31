@extends('layouts.app')

@section('content')
	<div>
			<p>
				<a href="{{ url('admin/category/addnewcategory') }}" class="btn btn-primary">Add Category</a>
			</p>

			@if (count($categories) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Categories
					</div>

					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>Name</th>
								<th>Description</th>
								<th></th>
							</thead>
							<tbody>
								@for ($i = 0; $i < count($categories); $i++)
									<tr>
										<td>{{$categories[$i]['categoryname']}}</td>
										<td>{{$categories[$i]['description']}}</td>
										<td>
											<ul class="list-inline list-unstyled">
												<li>
													<a href="{{ url('admin/category/editcategory/'. $categories[$i]['id'])}}" class="btn btn-xs btn-link " title="Edit the Category">
														<i class="glyphicon glyphicon-edit"></i>
													</a>
												</li>
												<li>
											        <form action="{{ url('admin/category/deletecategory/') }}" method="POST">
											            {!! csrf_field() !!}
											            <!-- {!! method_field('DELETE') !!} -->

														<input value="{{$categories[$i]['id']}}" name="categoryId" type="hidden">
											            <button type="submit" class="btn btn-xs btn-link" title="Delete the Category">
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
