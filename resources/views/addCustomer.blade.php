@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow p-4 rounded-4">
            <h2 class="mb-4">Add Customer</h2>
            <form id="addCustomerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter full name">
                        <div class="invalid-feedback">Please enter a valid name.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="example@example.com">
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Enter password">
                        <div class="invalid-feedback">Password must be atleast 6 charcter.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <div class="invalid-feedback">Upload an image.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                        <label class="form-check-label" for="male">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                        <label class="form-check-label" for="female">Female</label>
                        <!-- <div class="invalid-feedback">select gender.</div> -->
                    </div>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter city name">
                    <div class="invalid-feedback">Please enter city.</div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter full address"></textarea>
                    <div class="invalid-feedback">Please enter address.</div>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact Info</label>
                    <input type="number" name="contact" class="form-control" id="contact"
                        placeholder="Phone number or alternate contact">
                    <div class="invalid-feedback">Please enter a contact in 10 digit.</div>
                </div>

                <button type="submit" class="btn btn-primary">Add Customer</button>
            </form>
        </div>
    </div>



@endsection

@push('script')
<script>

$(document).ready(function(){
    $('#addCustomerForm').on('submit',function(e){
        e.preventDefault();

        


    })
})

</script>


@endpush