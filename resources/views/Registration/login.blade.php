@extends('layouts.parent')

@section('title', 'Login Form')

@section('styles')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="signup-form">
    <form action="/handleLogin" method="post">
        @csrf
        <h2>Login</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Login Now</button>
        </div>

    </form>
    <div class="text-center">Already have an account? <a href="/register">Sign in</a></div>
</div>
@endsection