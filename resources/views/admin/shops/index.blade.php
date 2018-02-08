@extends('admin.layout')

@section('title', 'Shops List')

@section('content')
<div class="posts-list">
  @foreach ($shops as $shop)
		<div class="media">
			<div class="media-left">
			</div>
			<div class="media-body">
        <a href="{{ route('shops.show', $shop->id ) }}">
            <h4 class="media-heading">{{ $shop->name }}</h4>
            <p class="teaser">
               {{  $shop->description }}
            </p>
        </a>
			</div>
		</div>
		<div class="shops-list-bottom">

			<form id="delete-form" class="pull-left" action="{{ route('shops.delete', $shop->id) }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-default btn-sm">Delete</button>
			</form>

			<a href="{{ url('/admin/shops/edit/'.$shop->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ url('/admin/shops/'.$shop->id) }}">
				<button type="button" class="btn btn-default btn-sm">Viwe</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $shops->links() !!}
  </div>
@stop
