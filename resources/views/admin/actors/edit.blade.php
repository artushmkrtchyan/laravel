@extends('admin.layout')

@section('title', 'Genre Shop')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Genre shop</div>

    <div class="panel-body">
        {!! Form::open(['method' => 'PUT', 'files' => true, 'route'=>['actor.update', $actor->id]]) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('Name:') !!}
              {!! Form::text('name', old('name', $actor->name), ['class'=>'form-control', 'placeholder'=>'name']) !!}
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group ">
              {!! Form::label('Biography:') !!}
              {!! Form::textarea('biography', old('biography', $actor->biography), ['class'=>'form-control', 'placeholder'=>'Biography']) !!}
            </div>

            <div class="form-group">
              {{ Form::label('Birthdate:') }}
              {!! Form::text('birthdate', old('birthdate', $actor->birthdate), ['id' => 'datepicker', 'data-provide' => 'datepicker']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Image') !!}
                {!! Form::file('image', null) !!}
            </div>

            <div class="form-group">
              <button class="btn btn-success">Edit actor</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
