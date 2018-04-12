@extends('admin.layout')

@section('title', 'Edit Shop')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit shop</div>

    <div class="panel-body">
        {!! Form::open(['method' => 'PUT', 'route'=>['shops.update', $shop->id]]) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('Name:') !!}
              {!! Form::text('name', old('name', $shop->name), ['class'=>'form-control', 'placeholder'=>'name']) !!}
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              {!! Form::label('description:') !!}
              {!! Form::textarea('description', old('description', $shop->description), ['class'=>'form-control', 'placeholder'=>'description']) !!}
              <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>

            <div class="form-group">
              <button class="btn btn-success">Edit shop</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
