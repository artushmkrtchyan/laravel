@extends('admin.layout')

@section('title', 'Categoryes')

@section('content')

<div class="categoryes-list">
  @foreach ($categories as $category)
		<div class="media">
			<div class="media-body">
        <a href="{{ route('category.show', $category->id ) }}">
            <h4 class="media-heading">{{ $category->name }}</h4>
        </a>
			</div>
		</div>
		<div class="posts-list-bottom">

      {{ Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id], 'class'=>'form_delete']) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
      {{ Form::close() }}

      <a href="{{ route('category.edit', $category->id) }}">
        <button type="button" class="btn btn-default btn-sm">Edit</button>
      </a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $categories->links() !!}
  </div>
</div>
@stop
