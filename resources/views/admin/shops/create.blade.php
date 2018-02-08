@extends('admin.layout')

@section('title', 'Add Shops')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add shops</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('shops.create') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-2 control-label">Name</label>

                <div class="col-md-9">
                    <input id="title" type="text" class="form-control" name="name" value="" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

             <div class="form-group">
                <label for="content" class="col-md-2 control-label">description</label>

                <div class="col-md-9">
                    <textarea rows="7" cols="50" class="form-control" name="description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">
                        Add shop
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
