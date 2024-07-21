@extends('layouts.master')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">All Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Main</a></li>
                            <li class="breadcrumb-item active">User Controller</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add Employee</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- Search Filter -->
            <form action="" method="">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="name" onkeyup="search()">
                            <label class="focus-label">Search Here</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <button type="submit" class="btn btn-info btn-block"> Refresh </button>  
                    </div>
                </div>
            </form>     
            <!-- /Search Filter -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="employee_table" class="table table-striped custom-table datatable" style="font-size: 13px !important;">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>Image</th>
                                    <th>Employee ID</th>
                                    <th>DTR ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>      
                                    <!-- <th>Email</th>
                                    <th>Phone</th> -->
                                    <th>Department</th>
                                    <th>Employment</th>                                    
                                    <th>Role</th>                                   
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $userArray)
                                @php
                                    $user = $userArray['user'];
                                    $userInformation = $userArray['userInformation']->first();
                                @endphp
                                
                                <tr>
                                    <td hidden class="id">{{ $user->id }}</td>
                                    <td>
                                        <span hidden class="image">{{ $user->image}}</span>
                                        <h2 class="table-avatar">  
                                            <a href="{{ url('employee/profile/'.$user->id) }}" class="avatar"><img src="{{ URL::to('/assets/images/'. $user->image) }}" alt="{{ $user->image }}"></a>
                                            
                                        </h2>
                                    </td>
                                    <td class="employee_id">{{ $user->employee_id }}</td>
                                    @if(!empty($userInformation->dtr_id))
                                        <td class="dtr_id">{{ $userInformation->dtr_id }}</td>
                                    @else
                                        <td class="dtr_id"></td>
                                    @endif
                                    <td class="first_name">{{ $user->first_name }}</td>
                                    <td class="middle_name">{{ $user->middle_name }}</td>
                                    <td class="last_name">{{ $user->last_name }}</td>                                      
                                    <!-- <td class="email">{{ $user->email }}</td> -->
                                    <!-- @if(!empty($userInformation->mobile_number))
                                        <td class="phone_number">{{ $userInformation->mobile_number }}</td>
                                    @else
                                        <td class="phone_number"></td>
                                    @endif -->
                                    @if(!empty($userInformation->department_name))
                                        <td class="department">{{ $userInformation->department_name }}</td>          
                                    @else          
                                        <td class="department"></td>                 
                                    @endif
                                    @if(!empty($userInformation->employment_type))
                                        <td class="employment">{{ $userInformation->employment_type }}</td>          
                                    @else          
                                        <td class="employment"></td>                 
                                    @endif
                                    <td>
                                        @if ($user->hr_user_role=='admin')
                                            <span class="badge bg-inverse-danger role_name">{{ $user->hr_user_role }}</span>
                                            @elseif ($user->hr_user_role=='Super Admin')
                                            <span class="badge bg-inverse-warning role_name">{{ $user->hr_user_role }}</span>
                                            @elseif ($user->hr_user_role=='employee')
                                            <span class="badge bg-inverse-info role_name">{{ $user->hr_user_role }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->status=='active')
                                            <span class="badge bg-inverse-success statuss">{{ $user->status }}</span>
                                            @elseif ($user->status=='inactive')
                                            <span class="badge bg-inverse-danger statuss">{{ $user->status }}</span>
                                            
                                        @endif
                                    </td>                                 
                                    
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <!-- <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> -->
                                                <a style="cursor: pointer;" class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$user->user_id.'" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <!-- <a class="dropdown-item userDelete" href="#" data-toggle="modal" ata-id="'.$user->user_id.'" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                            <!-- </div> -->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        

        <!-- Add User Modal -->
        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add_user_form" action="{{route('add/new/employee')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>First Name: </label>
                                <input class="form-control" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                <!-- Error message placeholder -->
                                <span class="invalid-feedback" role="alert" id="first_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Middle Name:</label>
                                <input class="form-control @error('middle_name') is-invalid @enderror" type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" required>
                                <!-- Error message placeholder -->
                                <span class="invalid-feedback" role="alert" id="middle_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                <!-- Error message placeholder -->
                                <span class="invalid-feedback" role="alert" id="last_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" value="{{ old('password') }}" required>
                                <!-- Error message placeholder -->
                                <span class="invalid-feedback" role="alert" id="password_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Repeat Password:</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password_confirmation" name="password_confirmation" required>
                                <!-- Error message placeholder -->
                                <span class="invalid-feedback" role="alert" id="password_confirmation_error"></span>
                            </div>
                            <div class="form-group">
                                <label>Biometric / DTR ID:</label>
                                <input class="form-control @error('dtr_id') is-invalid @enderror" type="text" id="dtr_id" name="dtr_id" value="{{ old('dtr_id') }}" required>
                                <!-- Error message placeholder -->
                                <span class="invalid-feedback" role="alert" id="dtr_id_error"></span>
                            </div>
                            <!-- insert default picture -->
                            <input type="hidden" class="image" name="image" value="photo_defaults.png">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add User Modal -->

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#add_user form').on('submit', function(e) {
                    e.preventDefault();
                    
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function(response) {                            
                            // Handle success response
                            $('#add_user').modal('hide');
                            toastr.success('Updated successfully!', 'Success');
                            // Reload the page
                            location.reload(); 
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                var errors = response.responseJSON.errors;
                                // Clear previous error messages
                                $('#add_user .invalid-feedback').empty();
                                // Remove is-invalid class from all input fields
                                $('#add_user input').removeClass('is-invalid');

                                
                                // Populate modal with error messages
                                $.each(errors, function(key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).siblings('.invalid-feedback').text(value[0]);
                                });
                                $('#add_user').modal('show');
                            }
                        }
                    });
                });
            });
        </script> -->
				
        <!-- Edit User Modal -->
        <div id="edit_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="modal-body">
                        <form id="edit_user_form" action="{{ route('admin/edit/employee/profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" id="e_id" value="">
                            <input type="hidden" name="employee_id" id="emp_id" value="">
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name_edit" id="first_name_edit" value="" required/>
                                        <input class="form-control" type="hidden" name="old_first_name" id="old_first_name" value="" />
                                        <!-- Error message placeholder -->
                                        <span class="invalid-feedback" role="alert" id="first_name_edit_error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Middle Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="middle_name_edit" id="middle_name_edit" value="" required/>
                                    <input class="form-control" type="hidden" name="old_middle_name" id="old_middle_name" value=""/>
                                    <!-- Error message placeholder -->
                                    <span class="invalid-feedback" role="alert" id="middle_name_edit_error"></span>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name_edit" id="last_name_edit" value="" required/>
                                        <input class="form-control" type="hidden" name="old_last_name" id="old_last_name" value="" />
                                        <!-- Error message placeholder -->
                                        <span class="invalid-feedback" role="alert" id="last_name_edit_error"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select name="department_edit" class="form-control" id="department_edit" required>
                                        <option value="" disabled selected>--- Select ---</option>
                                        @foreach ($employeeDepartment as $key=>$department )
                                            @if ($department->department_name !== null)
                                            <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input class="form-control" type="hidden" name="old_department" id="old_department" value=""/>
                                    <!-- Error message placeholder -->
                                    <span class="invalid-feedback" role="alert" id="department_edit_error"></span>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Employment Type <span class="text-danger">*</span></label>
                                    <select name="employment_edit" class="form-control" id="employment_edit" required>
                                        <option value="" disabled selected>--- Select ---</option>
                                        @foreach ($employmentType as $key=>$employment )
                                            @if ($employment->employment_type !== null)
                                            <option value="{{ $employment->employment_type }}">{{ $employment->employment_type }}</option>           
                                            @endif                           
                                        @endforeach
                                    </select>
                                    <input class="form-control" type="hidden" name="old_employment" id="old_employment" value=""/>
                                    <!-- Error message placeholder -->
                                    <span class="invalid-feedback" role="alert" id="employment_edit_error"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <label>User Role <span class="text-danger">*</span></label> 
                                    <select class="select" name="role_name_edit" id="role_name_edit" disabled>
                                        <option value="employee">employee</option>
                                        <option value="admin">admin</option>
                                    </select>
                                    <input class="form-control" type="hidden" name="old_role_name" id="old_role_name" value=""/>
                                    <!-- Error message placeholder -->
                                    <span class="invalid-feedback" role="alert" id="role_name_edit_error"></span>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select class="select" name="status_edit" id="status_edit" required>
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>
                                    </select>
                                    <input class="form-control" type="hidden" name="old_status" id="old_status" value=""/>
                                    <!-- Error message placeholder -->
                                    <span class="invalid-feedback" role="alert" id="status_edit_error"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row"> 
                            <div class="col-sm-6"> 
                                    <label>Biometric / DTR ID <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="dtr_id_edit" id="dtr_id_edit" value="" required/>
                                    <input class="form-control" type="hidden" name="old_dtr_id" id="old_dtr_id" value=""/>
                                    <!-- Error message placeholder -->
                                    <span class="invalid-feedback" role="alert" id="dtr_id_edit_error"></span>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Photo</label>
                                    <input class="form-control" type="file" id="image" name="images">
                                    <input type="hidden" name="hidden_image" id="e_image" value="">
                                </div>
                            </div>
                            <br>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Salary Modal -->
		<!-- <script>
            $('#edit_user form').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {                            
                        // Handle success response
                        $('#edit_user').modal('hide');
                        toastr.success('Updated successfully!', 'Success');
                        // Reload the page
                        location.reload(); 
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            // Clear previous error messages
                            $('#edit_user .invalid-feedback').empty(); // This line clears error messages in the Edit modal
                            // Remove is-invalid class from all input fields
                            $('#edit_user input').removeClass('is-invalid');

                            // Populate modal with error messages
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid'); // This line adds is-invalid class to the input field in the Edit modal
                                $('#' + key).siblings('.invalid-feedback').text(value[0]); // This line populates the error message in the Edit modal
                            });
                            $('#edit_user').modal('show'); // This line ensures that the Edit modal is shown with error messages
                        }
                    }
                });
            });
        </script> -->


        <!-- Delete User Modal -->
        <div class="modal custom-modal fade" id="delete_user" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete User</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="avatar" class="e_avatar" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete User Modal -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')


    {{-- update employee js --}}
    <script>
        $(document).on('click','.userUpdate',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#emp_id').val(_this.find('.employee_id').text());
            $('#first_name_edit').val(_this.find('.first_name').text());
            $('#old_first_name').val(_this.find('.first_name').text());
            $('#middle_name_edit').val(_this.find('.middle_name').text());
            $('#old_middle_name').val(_this.find('.middle_name').text());
            $('#last_name_edit').val(_this.find('.last_name').text());
            $('#old_last_name').val(_this.find('.last_name').text());
            $('#eemail_edit').val(_this.find('.email').text());
            $('#old_email').val(_this.find('.email').text());
            $('#ephone_number_edit').val(_this.find('.phone_number').text());
            $('#old_phone_number').val(_this.find('.phone_number').text());
            $('#dtr_id_edit').val(_this.find('.dtr_id').text());
            $('#old_dtr_id').val(_this.find('.dtr_id').text());
            $('#e_image').val(_this.find('.image').text());


            var name_role = (_this.find(".role_name").text());
            var _option = '<option selected value="' + name_role+ '">' + _this.find('.role_name').text() + '</option>'
            $( _option).appendTo("#role_name_edit");
            $('#old_role_name').val(_this.find('.role_name').text());

            var position = (_this.find(".position").text());
            var _option = '<option selected value="' +position+ '">' + _this.find('.position').text() + '</option>'
            $( _option).appendTo("#position_edit");
            $('#old_position').val(_this.find('.position').text());

            var department = _this.find(".department").text().trim();
            if (department) {
                // Remove any previously selected options
                $('#department_edit option').removeAttr('selected');

                // Find the option with the matching department name and select it
                $('#department_edit option').each(function() {
                    if ($(this).val() === department) {
                        $(this).attr('selected', 'selected');
                    }
                });
            } else {
                // If department is null or empty, ensure the default option is selected
                $('#department_edit').val('');
            }
            $('#old_department').val(department);


            var employment = _this.find(".employment").text().trim();
            if (employment) {
                // Remove any previously selected options
                $('#employment_edit option').removeAttr('selected');

                // Find the option with the matching employment type and select it
                $('#employment_edit option').each(function() {
                    if ($(this).val() === employment) {
                        $(this).attr('selected', 'selected');
                    }
                });
            } else {
                // If employment is null or empty, ensure the default option is selected
                $('#employment_edit').val('');
            }
            $('#old_employment').val(employment);


            var status = (_this.find(".statuss").text());
            var _option = '<option selected value="' +status+ '">' + _this.find('.statuss').text() + '</option>'
            $( _option).appendTo("#status_edit");
            $('#old_status').val(_this.find('.statuss').text());
            
        });
    </script>
    {{-- delete js --}}
    <script>
        $(document).on('click','.userDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.e_avatar').val(_this.find('.image').text());
        });
    </script>

    <script>
        function search() {
            var input, filter, table, tr, td, i, j;
            input = document.getElementById("name");
            filter = input.value.toUpperCase();
            table = $('#employee_table').DataTable(); // Get DataTables instance
            
            // Temporarily disable pagination
            var oldPaging = table.page();
            table.page.len(-1).draw();

            // Clear existing search
            table.search('').draw();

            // Search through all pages
            table.rows().every(function () {
                var rowData = this.data();
                var found = false;
                for (j = 0; j < rowData.length; j++) {
                    if (rowData[j].toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                if (found) {
                    this.nodes().to$().show(); // Show row
                } else {
                    this.nodes().to$().hide(); // Hide row
                }
            });

            // Re-enable pagination
            table.page(oldPaging).draw();
        }
    </script>


    @endsection

@endsection
