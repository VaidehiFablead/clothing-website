@extends('layout.app')

@section('content')
<section class="update-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm rounded-4 p-4 my-5">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 update-heading">Add Product</h2>
                    </div>

                    <form id="addProductForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label update-heading w-25">
                                    <i class="fa-solid fa-user px-2"></i>Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                                 <div class="invalid-feedback">Name is required</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label update-heading">
                                    <i class="fa-solid fa-list px-2"></i>Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="invalid-feedback">Select Yopur category</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label update-heading"><i class="fa-solid fa-audio-description px-2"></i>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                             <div class="invalid-feedback">Description is required</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label update-heading"><i class="fa-solid fa-dollar-sign px-2"></i>Price (Rs)</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                                 <div class="invalid-feedback">Price is required</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label update-heading"><i class="fa-solid fa-signal px-2"></i>Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option>In Stock</option>
                                    <option>Out of Stock</option>
                                    <option>Backorder</option>
                                </select>
                            </div>
                             <div class="invalid-feedback">Select stock</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label update-heading"><i class="fa-solid fa-image px-2"></i>Product Images</label>
                            <input class="form-control" type="file" id="images" name="images[]" multiple>
                             <div class="invalid-feedback">Upload image</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-success" id="addProduct">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#addProductForm').on('submit', function (e) {
            e.preventDefault();

            let name = $('#name').val().trim();
            let category = $('#category_id').val();
            let price = $('#price').val().trim();
            let status = $('#status').val();
            let images = $('#images')[0].files;
             let isValid = true;

            // Validation
            if (!name) {
                $("#name").addClass("is-invalid");
                    isValid = false;
            }
            if (!category) {
                $("#category_id").addClass("is-invalid");
                    isValid = false;
            }
            if (!price || isNaN(price) || Number(price) <= 0) {
                $("#price").addClass("is-invalid");
                    isValid = false;
            }
            if (!status) {
                $("#status").addClass("is-invalid");
                    isValid = false;
            }
            if (images.length === 0) {
                Swal.fire('Validation Error', 'At least one image is required', 'warning');
                return;
            }

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('product.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#addProduct').prop('disabled', true).text('Uploading...');
                },
                success: function (response) {
                    Swal.fire('Success', 'Product added successfully!', 'success');
                    $('#addProductForm')[0].reset();
                },
                error: function (xhr) {
                    let errorMsg = "Something went wrong!";
                    if (xhr.responseJSON?.errors) {
                        const errors = xhr.responseJSON.errors;
                        const firstKey = Object.keys(errors)[0];
                        errorMsg = errors[firstKey][0];
                    }
                    Swal.fire('Error', errorMsg, 'error');
                },
                complete: function () {
                    $('#addProduct').prop('disabled', false).text('Add Product');
                }
            });
        });
    });
</script>
@endpush
