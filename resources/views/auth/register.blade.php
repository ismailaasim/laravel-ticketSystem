@include('Backend.layout.common-header')
<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">

<div class="wrapper" id="registerFormContent">
    <h1>Register</h1>
    <form id="registrationForm" action="{{ route('register-user') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="alert alert-success d-none" id="successMessage"></div>
        <div class="alert alert-danger d-none" id="failMessage"></div>

        <div class="input-box">
            <input type="text" name="name" id="name" placeholder="Username" class="form-control" required>
            <span class="text-danger" id="nameError"></span>
        </div>

        <div class="input-box">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            <span class="text-danger" id="emailError"></span>
        </div>

        <div class="input-box">
            <input type="password" placeholder="Password" id="password" name="password" class="form-control" required>
            <span class="text-danger" id="passwordError"></span>
            <i class="toggle-password fa fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
        </div>
        {{-- this is for demo --}}
        {{-- <div class="input-box position-relative">
            <input type="password" placeholder="Password" id="password" name="password" class="form-control" required>
            <span class="text-danger" id="passwordError"></span>
            <i class="toggle-password fa fa-eye-slash position-absolute" id="togglePassword" style="cursor: pointer;"></i>
        </div> --}}

        <div class="input-box">
            <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" class="form-control" required>
            <span class="text-danger" id="confirmPasswordError"></span>
            <i class="toggle-password fa fa-eye-slash" id="togglePassword1" style="cursor: pointer;"></i>
        </div>

        <div class="checkbox1">
            <label><input type="checkbox" name="terms" required> I agree to terms & conditions</label>
        </div>

        <button type="submit" class="btn">Register</button>

        <div class="link">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </form>
</div>
@include('Backend.layout.common-footer')
<style>
    .input-box {
        position: relative;
    }

    .input-box .form-control {
        padding-right: 40px; /* Add space for the icon inside the input */
    }

    .input-box .toggle-password {
        position: absolute;
        right: 18px; /* Position the icon inside the input */
        top: 50%;
        transform: translateY(-50%); /* Center the icon vertically */
        cursor: pointer;
        color: #222020; /* Optional: Set icon color */
    }

    .input-box .toggle-password:hover {
        color: #333; /* Optional: Hover color change */
    }
</style>

<script>
    $(document).ready(function() {

        // Toggle password visibility
        $('#togglePassword, #togglePassword1').on('click',function(){
            const passInput = $('#password, #confirm_password');
            const type = passInput.attr('type') === 'password' ? 'text' : 'password';
            passInput.attr('type',type);

            $(this).toggleClass('fa-eye fa-eye-slash');

        })
        function validateForm() {
            let isValid = true;
            $('.text-danger').text('');
            const name = $('#name').val().trim();
            const email = $('#email').val().trim();
            const password = $('#password').val().trim();
            const confirmPassword = $('#confirm_password').val().trim();

            if (name === '') {
                $('#nameError').text('Name is required');
                isValid = false;
            } else if (name.length < 4 || name.length > 30) {
                $('#nameError').text('Name must be between 4 to 30 characters');
                isValid = false;
            }
            if (email === '') {
                $('#emailError').text('Email field is required');
                isValid = false;
            }
            const passwordPattern = /^(?=.*[A-Z])(?=.*\W)(?=.*\d).{8,}$/;
            if (password === '') {
                $('#passwordError').text('Password is required');
                isValid = false;
            } else if (!passwordPattern.test(password)) {
                $('#passwordError').text('Password must be at least 8 characters, with uppercase, special character, and number.');
                isValid = false;
            }
            if (confirmPassword === '') {
                $('#confirmPasswordError').text('Confirm Password is required');
                isValid = false;
            } else if (password !== confirmPassword) {
                $('#confirmPasswordError').text('Password mismatch');
                isValid = false;
            }
            return isValid;
        }

        $('#registrationForm').on('submit', function(e) {
            e.preventDefault();
            if (!validateForm()) {
                return;
            }
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#successMessage').text(response.message).removeClass('d-none');
                        $('#failMessage').addClass('d-none');
                        $('#registrationForm')[0].reset();
                    } else {
                        $('#failMessage').text(response.message).removeClass('d-none');
                        $('#successMessage').addClass('d-none');
                    }
                },
                error: function() {
                    $('#failMessage').text('Please try again.').removeClass('d-none');
                    $('#successMessage').addClass('d-none');
                }
            });
        });
    });
    // demo
   
</script>
