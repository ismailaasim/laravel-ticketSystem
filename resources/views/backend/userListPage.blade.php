@extends('Backend.layout.app')

@section('main-content')
<style>
/* #example_wrapper .pagination{
    float: right  !important;
}

div.dt-container div.dt-paging ul.pagination{
    float: right !important;
} */
div.dt-container div.dt-search {
    text-align: right;
    display: none;
}

</style>
    <div class="container-fluid mt-4" style="
    min-height: 60vh;">

        <div class="row mt-4 ms-auto">
            <div class="container">
                {{-- ******* Card ******** --}}
                <div class="card">
                    {{-- ******* Card Header ******** --}}
                    <div class="container-fluid card-header ">
                        <div class="row wrapping">
                            <div class="col-md-5 custom-col">
                                <h3>User List</h3>
                            </div>
                            <div class="col-md-7 custom-col1">
                                <div class="d-flex mx-1 wrapping1">
                                    <div class="input-container ms-auto me-2 cont1">
                                        <i class="fas fa-search"></i>
                                        <input type="text" class="form-control" id="searchInputExample"
                                            placeholder="Search">
                                        <i class="fas fa-times" style="display:none;"></i>
                                    </div>

                                    {{-- Filter --}}
                                    <div class="filter-container">
                                        <button id="filterBtn" class="filter-btn btn btn-outline-secondary me-2">
                                            <i class="fa fa-filter"></i>
                                            <span id="selectedCount" class="badge bg-secondary ms-2">0</span>
                                        </button>
                                        <div id="filterDown" class="filter-dpt">
                                            <h4>Filter Options</h4>
                                            <div class="filter-option">
                                                <label for="subscriptionStatus" class="" style="font-size:13px;">Branches:</label>
                                                <select id="filterBranch" class="form-control" name="branch[]" multiple>
                                                    <option value="all" class="child_cls">Select All</option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->branch_name }}" class="child_cls">
                                                            {{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="filter-option">
                                                <label for="userStatus">Role:</label>
                                                <select id="userStatus" class="form-control">
                                                    <option value="">Select option</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="User">User</option>

                                                </select>
                                            </div>
                                            <button id="applyBtn" class="apply-btn btn mt-2">Apply</button>
                                        </div>
                                    </div>
                                    {{-- Filter - Ends --}}
                                   
                                    <button type="button" class="btn float-end no-hover adding" data-bs-toggle="modal"
                                        data-bs-target="#addEmployeeModal">Add Employee</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- ******* Card Body******** --}}
                    <div class="card-body">
                        {{--  ************************************************** Data Tables  ************************************************ --}}
                        <div id="userTableContainer">

                            <div class="table-responsive dragscroll">
                                <table id="example" class="table table-striped table-hover " class="display">
                                    <thead>

                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Branch</th>
                                            <th>Role</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>
                                                    <img src="{{ $user->image ? $user->image : asset('assets/img/userti.png') }}"
                                                        class="user-image" alt="User Image">
                                                    {{ $user->name }}
                                                </td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $user->branch }}">
                                                    {{ Str::limit($user->branch, 10, '..etc') }}
                                                </td>
                                                <td>{{ $user->role }}</td>
                                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $user->address }}">
                                                    {{ Str::limit($user->address, 12, '...') }}
                                                </td>
                                                <td>
                                                    <span class="icon" data-id="{{ $user->id }}">
                                                        <i class="fa fa-thin fa-pencil" data-bs-toggle="modal"
                                                            data-bs-target="#EditIcon" style="cursor: pointer;"></i>
                                                    </span>
                                                    <button class="generate-password-btn btn-sm"
                                                        data-url="{{ route('user.generatePassword', $user->id) }}">Generate
                                                        Password</button>
                                                    <i class="ms-4 fa fa-trash bin text-danger delete-icon"
                                                        style="cursor: pointer;"
                                                        data-url="{{ route('user.delete', $user->id) }}"></i>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No records found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    {{-- **************************************************Create Modal Form ********************************************** --}}

    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New User</h5>

                </div>
                <div class="modal-body">
                    <form id="UserCreateForm" action="{{ route('userStore') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- add profile image --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="userProfile">Profile Photo</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="form-control text-secondary"
                                            id="image">
                                        <button class="btn btn-secondary upload" type="button">Upload</button>
                                        <p class="text-danger" id="imageError"></p>
                                    </div>
                                </div>
                            </div>
                            {{-- add user name --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter user name">
                                    <p class="text-danger" id="nameError"></p>
                                </div>
                            </div>
                            {{-- add email --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter email">
                                    <p class="text-danger" id="emailError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- add gender --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Gender</label>
                                    <select class="form-control shadow" name="gender" id="gender">
                                        <option value="" selected disabled hidden>Select Gender
                                        </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <p class="text-danger" id="genderError"></p>
                            </div>
                            {{-- add role --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control shadow" name="role" id="role">
                                        <option value="" selected disabled hidden>Select the Role
                                        </option>
                                        <option>Manager</option>
                                        <option>Admin</option>
                                        <option>User</option>
                                    </select>
                                </div>
                                <p class="text-danger" id="roleError"></p>
                            </div>

                            {{-- add branch --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_list">Branch</label><br>
                                    <select id="branch_list" class="form-control" name="branch[]" multiple>
                                        <option value="all" class="child_cls">Select All</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->branch_name }}" class="child_cls">
                                                {{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger" id="branchError"></p>

                                </div>
                            </div>
                            {{-- add address --}}
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your address" id="address"></textarea>
                                <p class="text-danger" id="addressError"></p>
                            </div>
                        </div>
                </div>
                {{-- modal footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn mdlBtn1 btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="SaveButton" class="btn mdlBtn btn-sm no-hover1">Save</button>
                </div>

            </div>
            </form>
        </div>
    </div>

    {{--  ************************************************** Edit Modal Form ********************************************** --}}
    <div class="modal fade" id="EditIcon" tabindex="-1" aria-labelledby="updateEmployeeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEmployeeModalLabel">Update User</h5>

                </div>
                <div class="modal-body">
                    <form id="UserUpdateForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- update image --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="userProfile">Profile Photo</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="form-control text-secondary"
                                            id="updateImage">
                                        <button class="btn btn-secondary" type="button">Upload</button>
                                    </div>
                                    <!-- update Image preview -->
                                    <img id="imagePreview" src="" alt="User Image"
                                        style="max-width: 100px; margin-top: 10px;">
                                </div>
                            </div>
                            {{-- update name --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatename">User Name</label>
                                    <input type="text" value="{{ old('name') }}" class="form-control"
                                        name="name" id="updatename" placeholder="Enter user name">
                                    <p class="text-danger" id="nameError"></p>
                                </div>
                            </div>
                            {{-- update Email --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updateEmail">Email</label>
                                    <input type="email" value="{{ old('email') }}" class="form-control"
                                        name="email" id="updateEmail" placeholder="Enter email">
                                    <p class="text-danger" id="emailError"></p>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            {{-- update gender --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role">Gender</label>
                                    <select class="form-control shadow" name="gender" id="Updategender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                    <p class="text-danger" id="genderError"></p>
                                </div>
                            </div>
                           
                            {{-- update Role --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updateRole">Role</label>
                                    <select class="form-control shadow" name="role" id="updateRole">
                                        <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager
                                        </option>
                                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                                    </select>
                                    <p class="text-danger" id="roleError"></p>

                                </div>
                            </div>
                             {{-- update branch --}}
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updateBranch">Branch</label><br>
                                    <select id="updateBranch" class="form-control" name="branch[]" multiple>
                                        <option value="all" class="child_cls">Select All</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->branch_name }}" class="child_cls">
                                                {{ $branch->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger" id="branchError"></p>
                                    <div id="updateBranchDisplay" class="branch-display"></div>
                                </div>
                            </div>
                            {{-- update Address --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label" for="updateAddress">Address</label>
                                    <textarea class="form-control" name="address" id="updateAddress" placeholder="Address">{{ old('address') }}</textarea>
                                    <p class="text-danger" id="addressError"></p>
                                </div>
                            </div>

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn mdlBtn1 btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="UpdateButton" class="btn mdlBtn btn-sm no-hover1">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    {{-- New code start --}}
    {{-- // Generate Password --}}
   
    
    <script>
        // password-start
         $(document).on('click', '.generate-password-btn', function(e) {
            e.preventDefault();
            // Show the SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Do you need to Generate a Password?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks 'OK', generate the password
                    let generatedPassword = generatePassword(8,
                        15); // Generate a password of 8-15 characters

                    // Show the "Processing..." alert
                    Swal.fire({
                        title: "Processing...",
                        text: "Please wait while the password is being generated.",
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                    // Perform the AJAX request to send the password to the server
                    $.ajax({
                        url: $(this).data(
                            'url'), // Replace with your route URL and pass the user ID
                        method: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            password: generatedPassword
                        },
                        success: function(response) {
                            // Close the "Processing..." alert
                            Swal.close();
                            // Handle the response from the server - Show the success alert
                            Swal.fire('Password Generated!',
                                'The password has been sent to the user\'s email.',
                                'success').then(() => {
                                window.location.href =
                                    userListRoute; // Redirect back to the user list
                            });
                        },
                        error: function(xhr, status, error) {
                            // Close the "Processing..." alert
                            Swal.close();
                            // Handle any errors
                            Swal.fire('Error', 'Failed to generate password',
                                'error');
                        }
                    });
                } else {
                    // If the user clicks 'Cancel', do nothing
                    Swal.fire('Cancelled', 'Password generation was cancelled', 'info');
                }
            });
        });
        // Function to generate a random password 
        function generatePassword(minLength, maxLength) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            const length = Math.floor(Math.random() * (maxLength - minLength + 1)) + minLength;
            let password = "";
            for (let i = 0, n = charset.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * n));
            }
            return password;
        }
        // generate paassword-end




        $(document).ready(function() {
            var userStore = '{{ route('userStore') }}';
           
            function initializeDataTable() {
        // Check if DataTable is already initialized and destroy it
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }

        // Initialize DataTable
        $('#example').DataTable({
            // 'dom':'lrtip',
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
            "searching": true,
            "info": false,
            "order": [], // Disable initial sorting
            "columnDefs": [
            { "orderable": false, "targets": -1 } // Disable ordering for the "Action" column (last column)
        ]
        });
         // Reinitialize tooltips after DataTable is initialized
        $('[data-bs-toggle="tooltip"]').tooltip();
    }

    function bindSearchToDataTable() {
        $('#searchInputExample').on('keyup', function() {
            var table = $('#example').DataTable();
            table.search(this.value).draw();
        });
    }

    // Initial bind of search to DataTable
    bindSearchToDataTable();
    initializeDataTable();
 
    $('#filterBtn').on('click', function () {
        $('#filterDown').toggle();
    });

    // Hide dropdown if clicked outside
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.filter-container').length) {
            $('#filterDown').hide();
        }
    });

    // Update the selected count when options are selected or deselected
    $('#filterBranch').on('change', function () {
        var selectedValues = $(this).val();
        var selectedCount = selectedValues.length;

        if (selectedValues.includes('all')) {
            selectedCount = $('#filterBranch option').not('[value="all"]').length;
        }
        $('#selectedCount').text(selectedCount);
    });

    // Apply the filter
    $('#applyBtn').on('click', function (e) {
        e.preventDefault();
        
        var selectedBranches = $('#filterBranch').val();
        var userStatus = $('#userStatus').val();

        // Filter DataTable based on selected branches and user status
        var table = $('#example').DataTable();

        // Branch filter: using regex to match any selected branches
        table.column(3).search(selectedBranches.join('|'), true, false).draw();

        // Optionally, you can add a role filter here as well
        if (userStatus !== '') {
            table.column(4).search(userStatus).draw();
        } else {
            table.column(4).search('').draw(); // Clear filter if no role is selected
        }

        $('#filterDown').hide(); // Close the filter dropdown

        // AJAX filter functionality
        $.ajax({
            url: '{{ route('user-List') }}',
            type: 'GET',
            data: {
                branch: selectedBranches,
                role: userStatus,
            },
            success: function(response) {
                // Update the table container with the new content
                $('#userTableContainer').html($(response).find('#userTableContainer').html());

                // Reinitialize the DataTable after updating content
                initializeDataTable();

                // Bind search input again to the new DataTable instance
                // bindSearchToDataTable();
            },
            error: function(xhr) {
                console.log("An error occurred: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

            // Multi-select handling
            let isUpdating = false;
            let previousSelectedValues = [];

            $('#branch_list,#updateBranch,#filterBranch').on('change', function() {
                if (isUpdating) return;
                isUpdating = true;

                let selectedOptions = $(this).val() || [];
                let previousSelectedSet = new Set(previousSelectedValues);
                let lastUncheckedValue = null;
                let lastCheckedValue = null;

                previousSelectedValues.forEach(function(value) {
                    if (!selectedOptions.includes(value)) {
                        lastUncheckedValue = value;
                    }
                });

                selectedOptions.forEach(function(value) {
                    if (!previousSelectedSet.has(value)) {
                        lastCheckedValue = value;
                    }
                });

                previousSelectedValues = selectedOptions.slice();

                if (lastUncheckedValue == 'all') {
                    $(this).find('option.child_cls').prop('selected', false);
                    $(this).trigger('change');
                } else if (lastCheckedValue == 'all') {
                    $(this).find('option.child_cls').prop('selected', true);
                    $(this).trigger('change');
                } else {
                    $(this).find('option[value="all"]').prop('selected', false);
                    $(this).trigger('change');
                }

                isUpdating = false;
            });

            // Validation and Errors
            function clearErrors() {
                $('.text-danger').text('');
            }

            function validateForm(formData) {
                let isValid = true;

                if (formData.name === '') {
                    $('#nameError').text('Name field is required');
                    isValid = false;
                }
                if (formData.gender === '') {
                    $('#genderError').text('Gender field is required');
                    isValid = false;
                }
                if (formData.email === '') {
                    $('#emailError').text('Email field is required');
                    isValid = false;
                }
                if (formData.branch === null || formData.branch.length === 0) {
                    $('#branchError').text('Branch field is required');
                    isValid = false;
                }
                if (formData.role === '') {
                    $('#roleError').text('Role field is required');
                    isValid = false;
                }
                if (formData.address === '') {
                    $('#addressError').text('Address field is required');
                    isValid = false;
                }

                return isValid;
            }

            function submitForm(url, formData) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            $.each(response.errors, function(key, value) {
                                $('#' + key + 'Error').text(value[0]);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("An error occurred: " + error);
                    }
                });
            }

            // Create Ajax Response
            $('#UserCreateForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.message) {
                            // Close the modal after successful user creation
                            $('#addEmployeeModal').modal('hide');

                            // Reload the table body with the updated user list
                            $('#userTableContainer').load(
                                '{{ route('user-List') }} #userTableContainer > *',
                                function() {
                                    // Call the common function to reinitialize the DataTable
                                    initializeDataTable();
                                });
                            $('#UserCreateForm')[0].reset();

                            // Show success message using SweetAlert2
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

                        // Use SweetAlert2 to show validation errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please correct the errors and try again.',
                            confirmButtonText: 'Ok'
                        });

                        // Display validation errors if necessary
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

            //first code correct
           
            //2nd code correct
            $(document).on('click', '.fa-pencil', function() {
                var userId = $(this).closest('span').data('id');
                console.log("userId", userId);

                if (userId) {
                    $.ajax({
                        url: '/backend/user-list/' + userId + '/edit',
                        method: 'GET',
                        success: function(data) {
                            if (data.error) {
                                console.error(data.error);
                                return;
                            }

                            // Update the form action URL
                            $('#UserUpdateForm').attr('action', '/backend/user-list/' + userId +
                                '/update');

                            // Populate form fields
                            $('#updatename').val(data.name);
                            $('#updateGender').val(data.gender);
                            $('#updateEmail').val(data.email);

                            // Clear previous branch selections
                            $('#updateBranch').val([]).trigger('change');

                            // Handle branch selection
                            let branches = data.branch ? data.branch.split(',') : [];
                            const allOptionValue = 'all';
                            const totalBranches = $('#updateBranch option').not('[value="all"]')
                                .length;

                            if (branches.length === totalBranches) {
                                // Select "All" option and manually select all branches
                                $('#updateBranch').val([allOptionValue]);

                                // Select all individual branch options
                                $('#updateBranch').not('[value="all"]').prop('selected',
                                    true);
                            } else {
                                // Otherwise, set the selected branches
                                $('#updateBranch').val(branches);
                            }

                            // Trigger change to update UI
                            $('#updateBranch').trigger('change');

                            // Populate other fields
                            $('#updateRole').val(data.role);
                            $('#updateAddress').val(data.address);

                            // Set image preview
                            if (data.image) {
                                $('#imagePreview').attr('src', data.image);
                            } else {
                                $('#imagePreview').attr('src',
                                    "{{ asset('assets/img/userti.png') }}"); // Fallback image
                            }

                            // Show the modal
                            $('#EditIcon').modal('show');
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseText);
                        }

                    });
                }
            });


            $('#updateImage').change(function(event) {
                let file = event.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

          
            $('#UpdateButton').click(function(event) {
                event.preventDefault();
                clearErrors();

                let formData = new FormData($('#UserUpdateForm')[0]);
                formData.append('existingImage', $('#existingImage')
                    .val()); // Include existing image data if needed

                $.ajax({
                    url: $('#UserUpdateForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Close the update modal
                            $('#EditIcon').modal('hide');

                            // Reload the table body with the updated user list
                            $('#userTableContainer').load(
                                '{{ route('user-List') }} #userTableContainer > *',
                                function() {
                                    initializeDataTable();
                                });

                            // Show success message using SweetAlert2
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'User updated successfully.',
                                confirmButtonText: 'Ok'
                            });

                            // Handle branch selection
                            let newBranches = response.newBranches ||
                        []; // Example new data, adjust as needed

                            // Clear previous branch selections
                            $('#updateBranch').val([]).trigger('change');

                            // Set the new branch selections
                            if (newBranches.length > 0) {
                                $('#updateBranch').val(newBranches).trigger('change');
                            }

                            initializeDataTable();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#' + key + 'Error').text(value[0]);
                            });

                            // Use SweetAlert2 to show a generic error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please correct the errors and try again.',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            });

            $(document).on('click', '.delete-icon', function() {
                var userURL = $(this).data('url');
                var trObj = $(this).closest('tr'); // Use closest to find the nearest <tr> element

                // SweetAlert2 confirmation
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
                            url: userURL,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content') // CSRF token
                            },
                            dataType: 'json',
                            success: function(data) {
                                // SweetAlert2 success message
                                $('#userTableContainer').load(
                                    '{{ route('user-List') }} #userTableContainer > *',
                                    function() {
                                        initializeDataTable();
                                    });

                                Swal.fire(
                                    'Deleted!',
                                    data
                                    .message, // Assuming the response contains a message
                                    'success'
                                );
                                trObj.remove(); // Remove the row from the table
                            },
                            error: function(xhr) {
                                // SweetAlert2 error message
                                Swal.fire(
                                    'Error!',
                                    'An error occurred: ' + xhr.responseText,
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Initial DataTable setup
            initializeDataTable();
        });
    </script>
@endpush
