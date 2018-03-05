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
        <a href="{{ route('post.show', $post->id ) }}">
            <h4 class="media-heading">{{ $post->title }}</h4>
            <p class="teaser">
               {{  str_limit($post->content, 100) }}
            </p>
            <p class="teaser">
               {{ $post->status }}
            </p>
        </a>
			</div>
		</div>
		<div class="posts-list-bottom">

			<form id="delete-form" class="pull-left" action="{{ route('post.delete', $post->id) }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-default btn-sm">Delete</button>
			</form>

			<a href="{{ url('/admin/post/edit/'.$post->id) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ url('/admin/post/'.$post->id) }}">
				<button type="button" class="btn btn-default btn-sm">Viwe</button>
			</a>

		</div>
		<hr>
	@endforeach
  <div class="text-center">
      {!! $posts->links() !!}
  </div>
@stop
