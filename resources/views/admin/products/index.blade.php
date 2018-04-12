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
        <a href="{{ route('admin.product.show', $product->id ) }}">
            <h4 class="media-heading">{{ $product->name }}</h4>
            <p class="teaser">
               {{  $product->description }}
            </p>
        </a>
			</div>
		</div>
		<div class="product-list-bottom">

      {{ Form::open(['method' => 'DELETE', 'route' => ['admin.product.destroy', $product->id], 'class'=>'form_delete']) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
      {{ Form::close() }}

			<a href="{{ route('admin.product.edit', $product->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ route('admin.product.show', $product->id) }}">
				<button type="button" class="btn btn-default btn-sm">Viwe</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $products->links() !!}
  </div>
@stop
