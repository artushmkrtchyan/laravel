@extends('admin.layout')

@section('title', 'Product List')

@section('content')
<div class="posts-list">
  @foreach ($products as $product)
		<div class="media">
      <div class="media-left">
    	  <img src="{{ Storage::url('/uploads/products/'.$product->image) }}" class="media-object" style="width:300px">
    	</div>
			<div class="media-body">
        <a href="{{ route('product.show', $product->id ) }}">
            <h4 class="media-heading">{{ $product->name }}</h4>
            <p class="teaser">
               {{  $product->description }}
            </p>
        </a>
			</div>
		</div>
		<div class="product-list-bottom">

			<form id="delete-form" class="pull-left" action="{{ route('product.delete', $product->id) }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-default btn-sm">Delete</button>
			</form>

			<a href="{{ url('/admin/product/edit/'.$product->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ url('/admin/product/'.$product->id) }}">
				<button type="button" class="btn btn-default btn-sm">Viwe</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $products->links() !!}
  </div>
@stop
