@extends('layout.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Product Details</h3>
                <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>Product Name:</h5>
                    <p>{{ $product->name }}</p>

                    <h5>Price:</h5>
                    <p>₹{{ number_format($product->price, 2) }}</p>

                    <h5>Description:</h5>
                    <p>{{ $product->description }}</p>

                    <h5>Status:</h5>
                    <p>{{ ucfirst($product->status) }}</p>

                    <h5>Category:</h5>
                    <p>{{ $product->category->name ?? 'No Category' }}</p>
                </div>

                <div class="col-md-6">
                    <h5>Product Images:</h5>
                    <div class="d-flex flex-wrap">
                        @php
                            $images = explode(',', $product->image);
                        @endphp

                        @foreach ($images as $img)
                            <div class="m-2 border rounded" style="width: 150px; height: 150px; overflow: hidden;">
                                <img src="{{ asset('uploads/products/' . $img) }}" alt="Product Image"
                                    class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url('/tables') }}" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>
@endsection
