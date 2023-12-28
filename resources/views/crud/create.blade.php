@extends('crud.layouts')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Create New User</div>
    <div class="card-body">
        @if (session('message'))
        <span class="aler alert-danger">
            <strong>{{session('message')}}</strong>
        </span>
        @endif
        <form action="{{ url('user') }}" method="post">
            {!! csrf_field() !!}
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif
            <label>Name</label></br>
            <input type="text" name="name" id="name" class="form-control"></br>
            <label>Email</label></br>
            <input type="text" name="email" id="email" class="form-control"></br>
            <label>Password</label></br>
            <input type="password" name="password" id="password" class="form-control"></br>
            <label>Confirm Password</label></br>
            <input type="password" name="confirm_password" id="password" class="form-control"></br>
            <input type="submit" value="Save" class="btn btn-success"></br>
        </form>

    </div>
</div>

@stop