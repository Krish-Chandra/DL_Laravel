@extends('layouts.app')

@section('content')
	<div>
		<div class="">

			<!-- Current Tasks -->
			@if (count($books) > 0)
				<div class="panel panel-primary">
					<div class="panel-heading">
						Your Request Cart
					</div>

					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<th>Title</th>
								<th>Author</th>
								<th>Category</th>
								<th>Publisher</th>
								<th>Total Copies</th>
								<th>Available Copies</th>
							</thead>
							<tbody>
									@for ($i = 0; $i < count($books); $i++)
										<tr>
											<td>{{$books[$i]['title']}}</td>
											<td>{{$books[$i]->author->authorname}}</td>
											<td>{{$books[$i]->category->categoryname}}</td>
											<td>{{$books[$i]->publisher->publishername}}</td>
											<td>{{$books[$i]['total_copies']}}</td>
											<td>{{$books[$i]['available_copies']}}</td>
											<td>
										        <form action="{{ url('deletefromcart/'.$books[$i]['id']) }}" method="POST">
										            {!! csrf_field() !!}
										            <!-- {!! method_field('DELETE') !!} -->

										            <button type="submit" id="delete-book-{{ $books[$i]['id'] }}" class="btn btn-xs btn-link" title="Remove the book from the cart" >
										                <i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
										            </button>
										        </form>
										    </td>											
										</tr>
									@endfor
							</tbody>
						</table>
				        <div style="text-align: center">
							<a href="{{ url('checkout') }}"><i aria-hidden='true' class='glyphicon glyphicon-arrow-right' title="Send a request to the Admin"></i></a>
				        </div>

					</div>
				</div>
			@else
				<div class="alert alert-warning">
					<span>Your request cart is empty!</span>
				</div>
			@endif
		</div>
	</div>
@endsection
