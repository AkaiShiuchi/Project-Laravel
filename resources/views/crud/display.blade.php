@extends('crud.layouts')
@section('content')
<div class="container">
    <div class="row" style="margin:20px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>CRUD with Laravel</h2>
                </div>
                <div class="card-body">
                    <a href="{{ url('/user/create') }}" class="btn btn-success btn-sm" title="Add New User">
                        Add New
                    </a>
                    <a href="{{ url('/home') }}" class="btn btn-success btn-sm" title="Home">
                        Home
                    </a>
                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="{{ url('/user/' . $item->id) }}" title="View User">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                View
                                            </button>
                                        </a>
                                        <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Edit User">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Edit
                                            </button>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" title="Delete User"
                                            data-toggle="modal" data-target="#deleteConfirmationModal"
                                            data-delete-url="{{ url('/user/' . $item->id) }}">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@include('crud.modal.deleteModal')

@endsection