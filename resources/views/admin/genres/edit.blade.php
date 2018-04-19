@extends('admin.layout')

@section('title', 'Genre Shop')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Genre shop</div>

    <div class="panel-body">
        {!! Form::open(['method' => 'PUT', 'route'=>['genre.update', $genre->id]]) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('Name:') !!}
              {!! Form::text('name', old('name', $genre->name), ['class'=>'form-control', 'placeholder'=>'name']) !!}
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              {!! Form::label('description:') !!}
              {!! Form::textarea('description', old('description', $genre->description), ['class'=>'form-control', 'placeholder'=>'description']) !!}
              <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>

            <div class="form-group">
              <button class="btn btn-success">Edit genre</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
