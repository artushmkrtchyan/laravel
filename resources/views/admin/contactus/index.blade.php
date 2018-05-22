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
      <td style="width:20%">{{$mail->last_name}} {{$mail->first_name}}</td>
      <td style="width:20%">{{$mail->email}}</td>
      <td style="width:35%">{{$mail->message}}</td>
      <td style="width:15%">{{$mail->created_at}}</td>
      <td style="width:10%">
            {{ Form::open(['method' => 'DELETE', 'route' => ['admin.contact.destroy', $mail->id]]) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger', "data-toggle" => "confirmation"]) }}
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
