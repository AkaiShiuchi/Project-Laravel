@extends('crud.layouts')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Edit User</div>
    <div class="card-body">

        <form action="{{ url('user/' .$users->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{$users->id}}" id="id" />
            <label>Name</label></br>
            <input type="text" name="name" id="name" value="{{$users->name}}" class="form-control"></br>
            <label>Email</label></br>
            <input type="email" name="email" id="email" value="{{$users->email}}" class="form-control"></br>
            <label>Password</label></br>
            <input type="password" name="password" id="password" value="{{$users->password}}" class="form-control"></br>
            <input type="submit" value="Update" class="btn btn-success"></br>
        </form>

    </div>
</div>

@stop