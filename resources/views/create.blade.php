@extends('layout')

@section('content')
<div class="container m-5 p-5">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input name="price" type="number" step="0.01" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Quantity</label>
                        <input name="quantity" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input name="image" type="file" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label>Video</label>
                        <input name="video" type="file" class="form-control" accept="video/*">
                    </div>
                    <div class="mb-3">
                        <label>PDF File</label>
                        <input name="pdf" type="file" class="form-control" accept="application/pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
