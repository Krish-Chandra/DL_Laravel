@extends('layouts.app')

@section('content')
	<div>
	<p>
		<a href="{{ url('admin/book/addnewbook') }}" class="btn btn-primary">Add Book</a>				
	</p>

	<div class="panel panel-primary">
		<div class="panel-heading">
			Books
		</div>

		<div class="panel-body">
			@if (count($books) > 0)		
				<table class="table table-bordered table-striped">
					<thead>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Publisher</th>
						<th>ISBN</th>
						<th>Total Copies</th>
						<th>Available Copies</th>
						<th></th>
					</thead>
					<tbody>
						@for ($i = 0; $i < count($books); $i++)
							<tr>
								<td>{{$books[$i]['title']}}</td>
								<td>{{$books[$i]['author']['authorname']}}</td>
								<td>{{$books[$i]['category']['categoryname']}}</td>
								<td>{{$books[$i]['publisher']['publishername']}}</td>
								<td>{{$books[$i]['isbn']}}</td>
								<td>{{$books[$i]['total_copies']}}</td>
								<td>{{$books[$i]['available_copies']}}</td>
								<td>
									<ul class="list-inline list-unstyled">
										<li>
											<a href="{{ url('admin/book/editbook/'. $books[$i]['id'])}}" class="btn btn-xs btn-link " title="Edit the book">
												<i class="glyphicon glyphicon-edit"></i>
											</a>
										</li>
										<li>
									        <form action="{{ url('admin/book/deletebook/') }}" method="POST">
									            {!! csrf_field() !!}
									            <!-- {!! method_field('DELETE') !!} -->

												<input value="{{$books[$i]['id']}}" name="bookId" type="hidden">
									            <button type="submit" class="btn btn-xs btn-link" title="Delete the book">
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
			@else
				No books in the catalog!
			@endif
		</div>
	</div>
	</div>
@endsection
