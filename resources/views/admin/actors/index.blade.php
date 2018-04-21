@extends('admin.layout')

@section('title', 'Genre List')

@section('content')
<div class="posts-list">
  @foreach ($actors as $actor)
  <div class="media">
    <div class="media-left">
      <img src="{{ Storage::url('/uploads/actors/'.$actor->image) }}" class="media-object" style="width:100px">
    </div>
    <div class="media-body">
      <a href="{{ route('actor.show', $actor->id ) }}">
          <h4 class="media-heading">{{ $actor->name }}</h4>
          <p class="teaser">
             {{  str_limit($actor->biography, 100) }}
          </p>
      </a>
    </div>
  </div>
  <div class="posts-list-bottom">

    {{ Form::open(['method' => 'DELETE', 'route' => ['actor.destroy', $actor->id], 'class'=>'float-left']) }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
    {{ Form::close() }}

    <a href="{{ route('actor.edit', $actor->id) }}">
      <button type="button" class="btn btn-default btn-sm">Edit</button>
    </a>

    <a href="{{ route('actor.show', $actor->id) }}">
      <button type="button" class="btn btn-default btn-sm">Viwe</button>
    </a>

  </div>
  <hr>

	@endforeach
  <div class="text-center">
      {!! $actors->links() !!}
  </div>
</div>
@stop
