@extends('layouts.parent')

@section('title', 'Register Form')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="signup-form">
    @if (session('message'))
    <span class="aler alert-danger">
        <strong>{{session('message')}}</strong>
    </span>
    @endif
    <form action="/create-user" method="post">
        @csrf
        <h2>Register</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif

        <div class="form-group">
            <div class="row">
                <div class="col"><input type="text" class="form-control" name="name" placeholder="User Name"
                        required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"
                required="required">
        </div>

        <div class="form-check form-check-inline mb-0 me-4">
            <input class="form-check-input" type="radio" name="role" id="admin" value="admin" />
            <label class="form-check-label" for="role">Admin</label>
        </div>

        <div class="form-check form-check-inline mb-0 me-4">
            <input class="form-check-input" type="radio" name="role" id="super_admin" value="super_admin" />
            <label class="form-check-label" for="role">Super Admin</label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="/login">Login</a></div>
</div>
@endsection