@extends('admin.layout')

@section('title', 'Users')

@section('content')

<div class="users-list">
	@foreach ($users as $user)
		<div class="media">
			<div class="media-left">
			  <img src="{{ Storage::url('/uploads/avatars/'.$user["avatar"]) }}" class="media-object" style="width:60px">
			</div>
			<div class="media-body">
			  <h4 class="media-heading">{{ $user['name'] }}</h4>
			  <p>{{ $user['description'] }}</p>
				@foreach ($user->roles as $role)
					<p> Role: <span>{{ $role->name }}</span> </p>
				@endforeach
			</div>
		</div>
		<div class="users-list-bottom">

			<form id="delete-form" class="pull-left" action="{{ route('users.delete', $user['id']) }}" method="post">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-default btn-sm">Delete</button>
			</form>

			<a href="{{ url('/admin/users/edit/'.$user['id']) }}">
				<button type="button" class="btn btn-default btn-sm">Edit</button>
			</a>

			<a href="{{ url('/admin/user/'.$user['id']) }}">
				<button type="button" class="btn btn-default btn-sm">Viwe</button>
			</a>

		</div>
		<hr>
	@endforeach
	<div class="text-center">
      {!! $users->links() !!}
  </div>
</div>
@stop
