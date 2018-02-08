@extends('admin.layout')

@section('title', 'Shop page')

@section('content')

<div class="media">
	<div class="media-body">
	  <h4 class="media-heading">{{ $product->name }}</h4>
	  <p>{{ $product->description }}</p>
	</div>
</div>

@stop
