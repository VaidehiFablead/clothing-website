@extends('layout.app')

@section('content')
    <section class="update-form">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Form Section -->
                <div class="col-lg-12">
                    <div class="card shadow-sm rounded-4 p-4 my-5">
                        <div class="d-flex justify-content-between">
                            <h2 class=" mb-4  update-heading">Add Product</h2>
                            {{-- <button type="button" class="btn btn-primary mb-4"><a href="tables.php"
                                    class="text-white text-decoration-none ">Back</a></button> --}}
                        </div>

                        <form id="addProductForm" action="{{ route('product.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="productName" class="form-label update-heading w-25">
                                        <i class="fa-solid fa-user px-2"></i>Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="productName"
                                        name="name">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label update-heading"><i
                                            class="fa-solid fa-list px-2"></i>Category</label><br>
                                    <select class="form-control w-100 p-2" id="category_id" name="category_id">
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label update-heading"><i
                                        class="fa-solid fa-audio-description px-2"></i>Description</label>
                                <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label update-heading"><i
                                            class="fa-solid fa-dollar-sign px-2"></i>Price
                                        (Rs)</label>
                                    <input type="text" class="form-control" placeholder="price" name="price"
                                        id="price">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label update-heading"><i
                                            class="fa-solid fa-signal px-2"></i>Status</label><br>
                                    <select class="form-control w-100 p-2" id="status" name="status">
                                        <option>In Stock</option>
                                        <option>Out of Stock</option>
                                        <option>Backorder</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label update-heading"><i
                                        class="fa-solid fa-image px-2"></i>Product
                                    Images</label>
                                <input class="form-control" type="file" id="images" name="images[]" multiple>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success" name="addProduct" id="addProduct">Add
                                    Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
