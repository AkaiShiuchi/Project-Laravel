<!-- Modal for Add New -->
<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('add-product') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @if (session('message'))
                        <span class="aler alert-danger">
                            <strong>{{ session('message') }}</strong>
                        </span>
                    @endif

                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <label>Id</label></br>
                    <input type="text" name="id" id="id" class="form-control"></br>
                    <label>Product Name</label></br>
                    <input type="text" name="name" id="name" class="form-control"></br>
                    <label>Describe</label></br>
                    <input type="text" name="describe" id="describe" class="form-control"></br>
                    <label>Image</label></br>
                    <input type="file" name="file" id="file" class="form-control"></br>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
