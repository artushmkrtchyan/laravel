@extends('layouts.main')

@section('title', 'Cuntact US page title...')

@section('content')
	<div class="container">
		<div class="row">

      @if(isset($success))
        <div class="alert alert-success">
          {{ $success }}
        </div>
      @endif


      {!! Form::open(['route'=>'contact_us.store']) !!}

        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
          {!! Form::label('Last Name:') !!}
          {!! Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder'=>'Enter Last Name']) !!}
          <span class="text-danger">{{ $errors->first('last_name') }}</span>
        </div>

        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
          {!! Form::label('First Name:') !!}
          {!! Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder'=>'Enter First Name']) !!}
          <span class="text-danger">{{ $errors->first('first_name') }}</span>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
          {!! Form::label('Email:') !!}
          {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
          <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
          {!! Form::label('Message:') !!}
          {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) !!}
          <span class="text-danger">{{ $errors->first('message') }}</span>
        </div>

        <div class="form-group">
          <button class="btn btn-success">Contact US!</button>
        </div>


      {!! Form::close() !!}
		</div>
	</div>
@stop
