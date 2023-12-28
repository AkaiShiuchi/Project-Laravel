@extends('crud.layouts')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">Detail User</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title">Name : {{ $users->name }}</h5>
            <p class="card-text">Email : {{ $users->email }}</p>
            <!-- <p class="card-text">Password : {{ $users->password }}</p> -->
        </div>
        </hr>
    </div>
</div>