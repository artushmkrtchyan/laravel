@extends('admin.layout')

@section('title', 'Films List')

@section('content')
<div class="posts-list">
  @foreach ($films as $film)
		<div class="media">
			<div class="media-left">
			  <img src="{{ Storage::url('/uploads/films/'.$film->image) }}" class="media-object" style="width:100px">
			</div>
			<div class="media-body">
        <a href="{{ route('film.show', $film->id ) }}">
            <h4 class="media-heading">{{ $film->title }}</h4>
            <p class="teaser">
               {!! html_entity_decode(str_limit($film->description, 100)) !!}
            </p>
            <p class="teaser">
               {{ $film->status }}
            </p>
        </a>
			</div>
		</div>
		<div class="posts-list-bottom">

      {{ Form::open(['method' => 'DELETE', 'route' => ['film.destroy', $film->id], 'class'=>'float-left']) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
      {{ Form::close() }}

			<a href="{{ route('film.edit', $film->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ route('film.show', $film->id) }}">
				<button type="button" class="btn btn-default btn-sm">View</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $films->links() !!}
  </div>
@stop
