@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h4>Category List</h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('category.store') }}" method="POST" class="mb-3 w-50">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                <button type="submit" class="btn btn-success">Add</button>
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </form>

        <table class="table table-bordered w-50">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->category_id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('category.delete', $category->category_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
