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
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->describe }}</td>
                                    <td>
                                        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->id }}" />
                                            <input type="file" name="file" id="fileInput">
                                            <img id="imagePreview" src="#" alt="Uploaded Image" style="display: none"
                                                width="100px">
                                            <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script>
                    document.getElementById('fileInput').addEventListener('change', function(e) {
                        var fileInput = e.target;
                        var imagePreview = document.getElementById('imagePreview');

                        if (fileInput.files && fileInput.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                imagePreview.src = e.target.result;
                                imagePreview.style.display = 'block';
                            };

                            reader.readAsDataURL(fileInput.files[0]);
                        } else {
                            imagePreview.src = '#';
                            imagePreview.style.display = 'none';
                        }
                    });
                </script>

            </div>
        </div>
    </div>
@endsection
