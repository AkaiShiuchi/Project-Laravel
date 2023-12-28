@extends('crud.layouts')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Edit User</div>
    <div class="card-body">

        <form action="{{ url('user/' .$users->id) }}" method="post">
            {!! csrf_field() !!}
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{$users->id}}" id="id" />
            <label>Name</label></br>
            <input type="text" name="name" id="name" value="{{$users->name}}" class="form-control"></br>
            <label>Email</label></br>
            <input type="text" name="email" id="email" value="{{$users->email}}" class="form-control"></br>
            <label>Old Password</label></br>
            <input type="password" name="current_password" id="password" value="" class="form-control"></br>
            <label>New Password</label></br>
            <input type="password" name="new_password" id="password" value="" class="form-control"></br>
            <input type="submit" value="Update" class="btn btn-success"></br>
        </form>

    </div>
</div>

@stop