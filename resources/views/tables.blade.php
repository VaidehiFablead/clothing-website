@extends('layout.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 mb-4 text-gray-800">Product Table</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="d-flex justify-content-between py-3 px-4 bg-info">
                <h6 class="h3 m-0 font-weight-bold text-white">Product List</h6>
                <div class="add-product bg-danger px-3 py-2 shadow rounded">
                    <a href="{{ url('/add-product') }}" class="add-product-button text-white text-decoration-none">
                        <i class="fas fa-shopping-cart pe-2"></i> Add Product
                    </a>
                </div>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        @php
                                            $firstImage = explode(',', $product->image)[0] ?? null;
                                        @endphp

                                        @if ($firstImage)
                                            <img src="{{ asset('uploads/products/' . $firstImage) }}" width="100"
                                                height="100" class="me-1 mb-1">
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->status }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>
                                        <a href="{{  route('product.edit', $product->product_id) }}" class="btn btn-warning btn-sm">
                                           Edit
                                        </a>

                                        <form action="{{ route('product.delete', $product->product_id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
