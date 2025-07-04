@extends('layout.app')

@section('content')
    <div class="container">
        <h2>Product List</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $products)
                    <tr>
                        <td>
                            @foreach (explode(',', $products->image) as $img)
                                <img src="{{ asset('uploads/products/' . $img) }}" width="50" height="50">
                            @endforeach
                        </td>
                        <td>{{ $products->name }}</td>
                        <td>{{ $products->price }}</td>
                        <td>{{ $products->description }}</td>
                        <td>{{ $products->status }}</td>
                        <td>{{ $products->category->name ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
