@extends('admin.layout')

@section('title', 'Posts List')

@section('content')
<div class="posts-list">
  @foreach ($posts as $post)
		<div class="media">
			<div class="media-left">
			  <img src="{{ Storage::url('/uploads/posts/'.$post->image) }}" class="media-object" style="width:100px">
			</div>
			<div class="media-body">
        <a href="{{ route('admin.post.show', $post->id ) }}">
            <h4 class="media-heading">{{ $post->title }}</h4>
            <p class="teaser">
               {{  str_limit($post->content, 100) }}
            </p>
        </a>
			</div>
		</div>
		<div class="posts-list-bottom">

			<form id="delete-form" class="pull-left" action="{{ route('admin.post.delete', $post->id) }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-default btn-sm">Delete</button>
			</form>

			<a href="{{ route('admin.post.edit', $post->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ route('admin.post.show', $post->id) }}">
				<button type="button" class="btn btn-default btn-sm">View</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $posts->links() !!}
  </div>
@stop
