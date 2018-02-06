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

			<form id="delete-form" class="pull-left" action="{{ route('category.delete', $category->id) }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-default btn-sm">Delete</button>
			</form>

			<a href="{{ url('/admin/category/edit/'.$category->id) }}">
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
