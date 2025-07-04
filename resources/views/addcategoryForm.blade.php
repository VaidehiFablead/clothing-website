@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-tag me-2"></i>Add Category</h4>
                    </div>

                    <div class="card-body">
                        <form id="addCategoryForm" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter category name">
                                <div class="invalid-feedback">Please enter a category name.</div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-plus-circle me-1"></i> Add Category
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#addCategoryForm').submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = form.serialize();

                // Clear old error
                $('#name').removeClass('is-invalid');
                $('#nameError').text('');

                $.ajax({
                    url: '/addcategoryForm', 
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // 🎉 SweetAlert Success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });

                        form[0].reset(); // Clear form
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#name').addClass('is-invalid');
                                $('#nameError').text(errors.name[0]);
                            }
                        } else {
                            alert("Something went wrong.");
                        }
                    }
                });
            });
        });
    </script>
@endsection
