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

      {{ Form::open(['method' => 'DELETE', 'route' => ['shops.destroy', $shop->id], 'class'=>'form_delete']) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
      {{ Form::close() }}

			<a href="{{ route('shops.edit', $shop->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ route('shops.show', $shop->id) }}">
				<button type="button" class="btn btn-default btn-sm">Viwe</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $shops->links() !!}
  </div>
@stop
