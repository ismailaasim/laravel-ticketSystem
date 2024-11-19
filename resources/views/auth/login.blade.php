@include('Backend.layout.common-header')
<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">

<div class="wrapper" id="loginFormContent">
    <h1>Login</h1>
    <form id="loginForm" action="{{ route('login-user') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="alert alert-success d-none" id="successMessage"></div>
        <div class="alert alert-danger text-white d-none" id="failMessage"></div>
        
        <div class="input-box position-relative">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            <span class="text-danger" id="emailError"></span>
        </div>

        <div class="input-box position-relative">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <span class="text-danger" id="passwordError"></span>
            <i class="toggle-password fa fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="link">
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </form>
</div>
@include('Backend.layout.common-footer')

<!-- Custom Styles -->
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
        $('#togglePassword').on('click', function() {
            const passwordInput = $('#password');
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);

            // Toggle the Font Awesome icon
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        // Validate form
        function validateForm() {
            let isValid = true;
            $('.text-danger').text('');
            const email = $('#email').val().trim();
            const password = $('#password').val().trim();

            if (email === '') {
                $('#emailError').text('Email field is required');
                isValid = false;
            }

            if (password === '') {
                $('#passwordError').text('Password field is required');
                isValid = false;
            }
            return isValid;
        }

        // Handle form submission
        $('#loginForm').on('submit', function(e) {
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
                        window.location.href = response.redirectUrl;
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
</script>
