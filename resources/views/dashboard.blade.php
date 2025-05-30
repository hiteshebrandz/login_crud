@extends('layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Product Dashboard</h2>
        <div>
            <strong>Welcome, {{ Auth::user()->name }}</strong>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('create') }}" class="btn btn-primary mb-3">Add Product</a>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Quantity</th>
                <th>Added By</th>
                <th>Image</th>
                <th>Video</th>
                <th>PDF</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->user->name ?? '-' }}</td>

                <td>
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" width="100">
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if($product->video_path)
                        <video width="200" controls>
                            <source src="{{ asset('storage/' . $product->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if($product->pdf_path)
                        <a href="{{ asset('storage/' . $product->pdf_path) }}" target="_blank" class="btn btn-sm btn-secondary">View PDF</a>
                    @else
                        -
                    @endif
                </td>

                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
