<script>
$('#UserCreateForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('userStore') }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.message) {
                            $('#addEmployeeModal').modal('hide');

                            $('#userTableContainer').load(
                                '{{ route('user-List') }} #userTableContainer > *',
                                function() {
                                    $('#example').DataTable().destroy();

                                    $('#example').DataTable({
                                        "pageLength": 5,
                                        "pagingType": "simple_numbers",
                                        "language": {
                                            "paginate": {
                                                "first": "First",
                                                "last": "Last",
                                                "next": "Next",
                                                "previous": "Prev"
                                            }
                                        },
                                        "lengthChange": false,
                                        "searching": false,
                                        "info": false
                                    });
                                }
                            );

                            $('#UserCreateForm')[0].reset();

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'User created successfully.',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please correct the errors and try again.',
                            confirmButtonText: 'Ok'
                        });

                        $('#nameError').text(errors.name ? errors.name[0] : '');
                        $('#emailError').text(errors.email ? errors.email[0] : '');
                        $('#branchError').text(errors.branch ? errors.branch[0] : '');
                        $('#roleError').text(errors.role ? errors.role[0] : '');
                        $('#addressError').text(errors.address ? errors.address[0] : '');
                        $('#genderError').text(errors.gender ? errors.gender[0] : '');
                        $('#imageError').text(errors.image ? errors.image[0] : '');
                    }
                });
            });

            // Edit modal Ajax Response
            $('#example').on('click', '.fa-pencil', function() {
                var userId = $(this).closest('span').data('id');
                editUser(userId);
            });

            function editUser(userId) {
                $.ajax({
                    url: '/backend/user-list/' + userId + '/edit',
                    method: 'GET',
                    success: function(data) {
                        if (data.error) {
                            console.error(data.error);
                            return;
                        }
                        $('#UserUpdateForm').attr('action', '/backend/user-list/' + userId + '/update');
                        $('#updatename').val(data.name);
                        $('#updateGender').val(data.gender);
                        $('#updateEmail').val(data.email);

                        let branches = data.branch ? data.branch.split(',') : [];
                        $('#updateBranch').val(branches).trigger('change');
                        $('#updateRole').val(data.role);
                        $('#updateAddress').val(data.address);

                        $('#updateModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log("An error occurred: " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
       
        // Update Form Submission
        $('#UserUpdateForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var actionUrl = $(this).attr('action');

            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.message) {
                        $('#updateModal').modal('hide');

                        $('#userTableContainer').load(
                            '{{ route('user-List') }} #userTableContainer > *',
                            function() {
                                $('#example').DataTable().destroy();

                                $('#example').DataTable({
                                    "pageLength": 5,
                                    "pagingType": "simple_numbers",
                                    "language": {
                                        "paginate": {
                                            "first": "First",
                                            "last": "Last",
                                            "next": "Next",
                                            "previous": "Prev"
                                        }
                                    },
                                    "lengthChange": false,
                                    "searching": false,
                                    "info": false
                                });
                            }
                        );

                        $('#UserUpdateForm')[0].reset();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'User updated successfully.',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please correct the errors and try again.',
                        confirmButtonText: 'Ok'
                    });

                    $('#updatenameError').text(errors.name ? errors.name[0] : '');
                    $('#updateEmailError').text(errors.email ? errors.email[0] : '');
                    $('#updateBranchError').text(errors.branch ? errors.branch[0] : '');
                    $('#updateRoleError').text(errors.role ? errors.role[0] : '');
                    $('#updateAddressError').text(errors.address ? errors.address[0] : '');
                    $('#updateGenderError').text(errors.gender ? errors.gender[0] : '');
                    $('#updateImageError').text(errors.image ? errors.image[0] : '');
                }
            });
        });

        // Delete User with AJAX
        $('#example').on('click', '.delete-icon', function() {
            var userId = $(this).data('id');
            var csrfToken = $(this).attr('content');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/backend/user-list/' + userId,
                        method: 'DELETE',
                        data: {
                            _token: csrfToken
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'The user has been deleted.',
                                    'success'
                                );

                                $('#userTableContainer').load(
                                    '{{ route('user-List') }} #userTableContainer > *',
                                    function() {
                                        $('#example').DataTable().destroy();

                                        $('#example').DataTable({
                                            "pageLength": 5,
                                            "pagingType": "simple_numbers",
                                            "language": {
                                                "paginate": {
                                                    "first": "First",
                                                    "last": "Last",
                                                    "next": "Next",
                                                    "previous": "Prev"
                                                }
                                            },
                                            "lengthChange": false,
                                            "searching": false,
                                            "info": false
                                        });
                                    }
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Failed!',
                                'An error occurred while deleting the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        </script>