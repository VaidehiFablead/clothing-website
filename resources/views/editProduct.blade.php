@extends('layout.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow p-4">
            <h3 class="mb-4">Edit Product</h3>
            <form id="editProductForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Select --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    {{ $category->category_id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ $product->price }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="In Stock" {{ $product->status == 'In Stock' ? 'selected' : '' }}>In Stock
                            </option>
                            <option value="Out of Stock" {{ $product->status == 'Out of Stock' ? 'selected' : '' }}>Out of
                                Stock</option>
                            <option value="Backorder" {{ $product->status == 'Backorder' ? 'selected' : '' }}>Backorder
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Upload New Images (optional)</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                </div>

                @if ($product->image)
                    <div class="mb-3">
                        <label>Old Images</label><br>
                        <div id="oldImagesContainer">
                            @php
                                $oldImages = explode(',', $product->image);
                            @endphp
                            @foreach ($oldImages as $img)
                                <div class="image-box d-inline-block position-relative me-2 mb-2"
                                    data-image="{{ $img }}">
                                    <img src="{{ asset('uploads/products/' . $img) }}" width="100" height="100"
                                        class="rounded shadow">
                                    <button type="button"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image"
                                        title="Remove" style="padding: 2px 6px;">×</button>
                                </div>
                            @endforeach
                        </div>
                        <!-- Store updated list of old images -->
                        <input type="hidden" name="old_images" id="old_images" value="{{ $product->image }}">
                    </div>
                @endif

                <div class="d-flex justify-content-end">
                    <button type="submit" id="updateBtn" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
        
            // Handle image remove
            $(document).on('click', '.remove-image', function() {
                const imageBox = $(this).closest('.image-box');
                const imageName = imageBox.data('image');

                // Remove image element from view
                imageBox.remove();

                // Update the hidden input to remove the deleted image
                let currentImages = $('#old_images').val().split(',');
                let updatedImages = currentImages.filter(img => img !== imageName);
                $('#old_images').val(updatedImages.join(','));
            });

            $('#editProductForm').on('submit', function(e) {
                e.preventDefault();
                // alert('AJAX called');
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('product.update', $product->product_id) }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#updateBtn').prop('disabled', true).text('Updating...');
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: res.message,
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = res.redirect;
                            }
                        });
                    },
                    error: function(xhr) {
                        let msg = 'Something went wrong!';
                        if (xhr.responseJSON?.errors) {
                            const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                            msg = xhr.responseJSON.errors[firstKey][0];
                        }
                        Swal.fire('Error', msg, 'error');
                    },
                    complete: function() {
                        $('#updateBtn').prop('disabled', false).text('Update Product');
                    }
                });
            });
        });
    </script>
@endpush
