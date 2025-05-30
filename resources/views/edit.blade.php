@extends('layout')

@section('content')
<div class="container mt-5">
    <h2>Edit Product</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" required>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label>Current Image:</label><br>
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" width="120" class="mb-2">
            @else
                N/A
            @endif
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <!-- Video -->
        <div class="mb-3">
            <label>Current Video:</label><br>
            @if($product->video_path)
                <video width="300" controls class="mb-2">
                    <source src="{{ asset('storage/' . $product->video_path) }}" type="video/mp4">
                </video>
            @else
                N/A
            @endif
            <input type="file" class="form-control" name="video" accept="video/*">
        </div>

        <!-- PDF -->
        <div class="mb-3">
            <label>Current PDF:</label><br>
            @if($product->pdf_path)
                <a href="{{ asset('storage/' . $product->pdf_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary mb-2">View PDF</a>
            @else
                N/A
            @endif
            <input type="file" class="form-control" name="pdf" accept="application/pdf">
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
