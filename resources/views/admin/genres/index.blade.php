@extends('admin.layout')

@section('title', 'Genre List')

@section('content')
<div class="genre-list container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th></th>
      </tr>
    </thead>
  <tbody>
  @foreach ($genres as $genre)
    <tr>
      <td>{{$genre->name}}</td>
      <td>{{$genre->description}}</td>
      <td class="index-buttun">
          <a href="{{ route('genre.edit', $genre->id) }}">
    				<button type="button" class="btn btn-default btn-sm">Edit</button>
    			</a>
    			<a href="{{ route('genre.show', $genre->id) }}">
    				<button type="button" class="btn btn-default btn-sm">View</button>
    			</a>
          {{ Form::open(['method' => 'DELETE', 'route' => ['genre.destroy', $genre->id]]) }}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
          {{ Form::close() }}
        </td>
    </tr>

	@endforeach
    </tbody>
  </table>
  <div class="text-center">
      {!! $genres->links() !!}
  </div>
@stop
