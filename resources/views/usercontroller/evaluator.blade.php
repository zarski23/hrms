
@extends('layouts.master')
@section('content')
   
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-lists-center">
                    <div class="col">
                        <h3 class="page-title">Evaluator Access</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Main</a></li>
                            <li class="breadcrumb-item active">User Controller</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Evaluator Access</a>
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
                        <table id="employee_table" class="table table-striped custom-table datatable" style="font-size: 14px !important;">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>Full Name</th>                                  
                                    <th>Role</th>                                   
                                    <th>Access Criteria</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($userEvaluator as $user)
                                
                                <tr>
                                    <td hidden class="id">{{ $user->user_id }}</td>
                                    <td>
                                        <span hidden class="image">{{ $user->image}}</span>
                                        <h2 class="table-avatar">  
                                            <a href="{{ url('employee/profile/'.$user->user_id) }}" class="avatar"><img src="{{ URL::to('/assets/images/'. $user->image) }}" alt="{{ $user->image }}"></a>
                                            
                                        </h2>
                                    </td>
                                    <td class="employee_id">{{ $user->username }}</td>
                                    <td class="name">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                    <td><span style="font-size: 12px;" class="badge bg-inverse-info role_name">{{ $user->hr_user_role }}</span></td>
                                    <td style="max-width: 250px; word-wrap: break-word; word-break: break-all; white-space: normal;">
                                        {!! str_replace(',', '<br>', $user->criteria_list) !!}
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

        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Evaluator Access</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add/evaluator/permission') }}" method="POST">  
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Name</label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="user" name="user">
                                            <option value="">-- Select --</option>
                                            @foreach ($userList as $key=>$user )
                                            <option value="{{ $user->id }}" data-username={{ $user->username }}>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="username" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-15">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr style="background-color: #0a9743; color: #FFFFFF;">
                                        <th>Criteria</th>
                                        <th></th>
                                        <th class="text-center">Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $key = 0; ?>
                                    
                                    @foreach ($criteria as $index => $lists)
                                    <tr>
                                        <!-- 1st Column: Criteria -->
                                        @if ($index === 0 || $lists->criteria !== $criteria[$index - 1]->criteria)
                                            <td style="font-weight: bold;">{{ $lists->criteria }}</td>
                                        @endif

                                        <!-- 2nd Column: Sub Criteria -->
                                        @if ($lists->sub_criteria)
                                            <td colspan="2">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;- {{ $lists->sub_criteria }}</td>
                                        @else
                                            <td></td>
                                        @endif

                                        <!-- 3rd Column: Permission -->
                                        <td class="text-center">
                                            @if ($lists->sub_criteria)
                                                <!-- If sub_criteria is present, show checkbox -->
                                                <input type="checkbox" class="read{{ ++$key }}" name="read[]" value="{{ $lists->id }}">
                                            @else
                                                <!-- If sub_criteria is null and next row has the same criteria, don't display the checkbox -->
                                                @if (!isset($criteria[$index + 1]) || $lists->criteria !== $criteria[$index + 1]->criteria)
                                                    <input type="checkbox" class="read{{ ++$key }}" name="read[]" value="{{ $lists->id }}">
                                                @endif
                                            @endif
                                            <!-- Hidden field to track unchecked checkboxes -->
                                            <input type="hidden" name="unchecked[]" value="{{ $lists->id }}">
                                        </td>
                                    </tr>   
                                @endforeach

                                </tbody>
                            </table>



                            </div>
                            <div class="submit-section">
                                <button class="btn btn-success submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->

        <!-- Update Employee Modal -->
        <div id="update_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Employee Access</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/access/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Name</label>
                                        <input type="text" class="form-control" id="user_update" name="user_update" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="employee_id_update" name="employee_id_update" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-15">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr style="background-color: #0a9743; color: #FFFFFF;">
                                            <th>System Application</th>
                                            <th class="text-center">Permission</th>
                                            <th class="text-center">User Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $key = 0;
                                            $key1 = 0;
                                        ?>
                                        @foreach ($applications_lists as $lists )
                                        <tr>
                                            <td>{{ $lists->application_name }}</td>
                                            <input type="hidden" name="application_name[]" value="{{ $lists->application_name }}">
                                            <input type="hidden" name="id_count[]" value="{{ $lists->id }}">
                                            <td class="text-center">
                                                <input type="checkbox" class="read{{ ++$key }}" id="read" name="read[]" value="{{ $lists->id }}" >
                                            </td>
                                            <td class="text-center">
                                                <select class="select form-control" id="user_role" name="user_role{{ $lists->id }}" style="height: 30px;">
                                                    <option></option>
                                                    <option value="employee">Employee</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Update Employee Modal -->

        
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2s-hidden-accessible').select2({
                closeOnSelect: false
            });
        });
    </script>

    <script>
        // select auto id and email
        $('#user').on('change',function()
        {
            $('#username').val($(this).find(':selected').data('username'));
        });

    </script>

    <script>
        function search() {
            // Get the search input value
            var input = document.getElementById('name');
            var filter = input.value.toLowerCase();
            // Get all user divs
            var userDivs = document.querySelectorAll('.profile-widget');

            // Loop through the user divs and hide those that don't match the search query
            userDivs.forEach(function(userDiv) {
                var userName = userDiv.querySelector('.user-name').textContent.toLowerCase();
                if (userName.includes(filter)) {
                    userDiv.parentElement.style.display = '';
                } else {
                    userDiv.parentElement.style.display = 'none';
                }
            });
        }
    </script>
    @endsection

@endsection
