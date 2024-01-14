@extends('products.layouts')
@section('content')
<div class="row" style="margin:20px;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>Danh Sách Sản Phẩm</h2>
            </div>
            <div class="card-body">
                <a href="{{ url('/home') }}" class="btn btn-success btn-sm" title="Home">
                    Home
                </a>
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div>
                            <input type="file" name="file" id="customFile">
                            <label for="customFile" class="btn btn-success btn-sm">Choose file</label>
                        </div>
                    </div>
                    <button class="btn btn-success btn-sm">Import</button>
                    <a href="{{ route('export-products') }}" class="btn btn-success btn-sm" title="Export">Export</a>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product Name</th>
                            <th>Describe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $item)
                        <tr>
                            <td>{{$item -> id}}</td>
                            <td>{{$item -> name}}</td>
                            <td>{{$item ->describe}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection