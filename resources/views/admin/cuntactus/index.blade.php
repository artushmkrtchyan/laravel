@extends('admin.layout')

@section('title', 'Posts List')

@section('content')
<div class="mail-list container">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>date</th>
        <th>delete</th>
      </tr>
    </thead>
  <tbody>
  @foreach ($mails as $mail)
    <tr>
      <td>{{$mail->last_name}} {{$mail->first_name}}</td>
      <td>{{$mail->email}}</td>
      <td>{{$mail->message}}</td>
      <td>{{$mail->created_at}}</td>
      <td>
            {{ Form::open(['method' => 'DELETE', 'route' => ['cuntact-us.destroy', $mail->id]]) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        </td>
    </tr>

	@endforeach
    </tbody>
  </table>
  <div class="text-center">
      {!! $mails->links() !!}
  </div>
@stop
