@extends('layout.app')

@section('content')
    <section class="profile">
        <div class="container mt-5 pt-5">

            <div class="change_pass d-flex justify-content-between">
                <div>
                    <h3 class="mb-3">Change Your Password</h3>
                </div>
            </div>


            <form method="POST" action="{{ route('password.change') }}" id="updatePassword">
                @csrf

                {{-- <div class="form-outline mb-4">
                                <input type="text" id="id" name="nid" class="form-control"  hidden />
                            </div> --}}

                <!-- email -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ session('email') }}"
                        readonly />
                </div>

                <!-- old password -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="oldpassword">Old Password:</label>
                    <input type="password" id="old_password" name="old_password" class="form-control" />
                    <div class="invalid-feedback">Password must be at least 6 characters</div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="newpassword">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" />
                    <div class="invalid-feedback">Password must be at least 6 characters</div>
                </div>

                <button type="submit" class="btn btn-success" id="updatepass">Update Password</button>
        </div>
        </form>
    </section>


    {{-- <script>
        $(document).ready(function() {

            // $("#changePassword").click(function(){
            //     window.location.href="profile.php";
            // });

            $("#updatePassword").on("submit", function(e) {
                e.preventDefault(); // Prevent default form submission



                var id = $("#id").val();
                var email = $("#email").val();
                var oldPassword = $("#oldPassword").val();
                var newPassword = $("#newPassword").val();
                let isValid = true;

                $(".form-control").removeClass("is-invalid");



                if (oldPassword === "" || oldPassword.length < 6) {
                    $("#oldPassword").addClass("is-invalid");
                    isValid = false;
                }


                if (newPassword === "" || newPassword.length < 6) {
                    $("#newPassword").addClass("is-invalid");
                    isValid = false;
                }
                if (!isValid) {
                    return false;
                }
            });
        });
    </script> --}}
@endsection
