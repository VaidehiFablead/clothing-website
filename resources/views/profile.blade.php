@extends('layout.app')

@section('content')
    <!-- profile  -->
    <section class="profile">
        <div class="container mt-5 pt-5">

            <div class="change_pass d-flex justify-content-between">
                <div>
                    <h3 class="mb-3">Profil</h3>
                </div>
                <form method="GET" action="{{ route('password.form') }}">
                    <div class="pass_button">
                        <button type="submit" class="btn btn-danger" id="changePassword">Change Password</button>
                    </div>
                </form>
            </div>


            <form method="post" id="updateProfile" action="{{ route('profile.update') }}">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ session('name') }}" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ session('email') }}" />
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
    </section>
@endsection
