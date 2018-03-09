@extends('admin.layout')

@section('title', 'Edit User')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit account</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('users.edit', $user->id) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="form-group">
                <label for="description" class="col-md-4 control-label">Description</label>

                <div class="col-md-6">
                    <textarea rows="3" cols="50" class="form-control" name="description">{{ $user->description }}</textarea>
                </div>
            </div>

             <div class="form-group">
                <label for="avatar" class="col-md-4 control-label">Avatar</label>

                <div class="col-md-6">
                    <input type="file" name="avatar">
                </div>
            </div>

            <div class="form-group">
               <label for="avatar" class="col-md-4 control-label">Role</label>

               <div class="col-md-6">

                 <select name="role">
                   <?php foreach($roles as $role){
                     $selected = '';
                     foreach ($user->roles as $user_role) {
                       if($user_role->name == $role->name){
                         $selected = 'selected';
                       }
                     }?>
                      <option value="{{$role->id}}" {{$selected}}>{{ $role->name }}</option>
                   <?php } ?>
                </select>
               </div>
           </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>

            <div class="media-left">
                <?php if($user->provider_id){?>
                  <img src="{{ $user->avatar }}" class="media-object" style="width:60px">
                <?php
                }else{ ?>
                  <img src="{{ Storage::url('/uploads/avatars/'.$user->avatar) }}" class="media-object" style="width:60px">
                <?php
                } ?>
            </div>

        </form>
    </div>
</div>

@endsection
