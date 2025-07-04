@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h4>Edit Category</h4>
    <form action="{{ route('category.update', $category->category_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('viewcategory') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
