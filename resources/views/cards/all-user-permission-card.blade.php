
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
                        <h3 class="page-title">User Admin | User Role Permissions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Main</a></li>
                            <li class="breadcrumb-item active">User Controller</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add User Permission</a>
                        <div class="view-icons">
                            <a href="{{ route('all/user/permission') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
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
            <div class="row staff-grid-row">
                @foreach ($users as $lists )
                    <div class="col-md-2 col-sm-3 col-6 col-lg-2 col-xl-2 mb-3 px-2">
                        <div class="profile-widget" style="padding-bottom: 0;">
                            <div class="profile-img">
                                <a href="{{ url('employee/profile/'.$lists->id) }}" class="avatar"><img src="{{ URL::to('/assets/images/'. $lists->image) }}" alt="{{ $lists->image }}" alt="{{ $lists->image }}"></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ url('employee/user/permission/view/edit/'.$lists->id) }}" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{url('employee/user/permission/delete/'.$lists->id)}}"onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html">{{ $lists->first_name }} {{ $lists->last_name }}</a></h5>
                            <p style="font-size: 11px; margin-top: 5px; color: #04882d;">HR Admin </p>
                            <div class="small text-muted"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/user/permission/save') }}" method="POST">  
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Name</label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="user" name="user">
                                            <option value="">-- Select --</option>
                                            @foreach ($userList as $key=>$user )
                                            <option value="{{ $user->id }}" data-employee_id={{ $user->username }}>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Auto id employee" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-15">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr style="background-color: #0a9743; color: #FFFFFF;">
                                            <th>Module Permission</th>
                                            <th class="text-center">Add</th>
                                            <th class="text-center">View</th>
                                            <th class="text-center">Update</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center">Upload</th>
                                            <th class="text-center">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $key = 0;
                                            $key1 = 0;
                                        ?>
                                        @foreach ($permission_lists as $lists)
                                        <tr>
                                            <td>{{ $lists->permission_name }}</td>
                                            <input type="hidden" name="permission_name[]" value="{{ $lists->permission_name }}">
                                            <input type="hidden" name="id_count[]" value="{{ $lists->id }}">
                                            <td class="text-center">
                                                <input type="hidden" name="add[{{ $lists->id }}]" value="N">
                                                <input type="checkbox" class="add{{ $lists->id }}" id="add{{ $lists->id }}" name="add[{{ $lists->id }}]" value="Y">
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="view[{{ $lists->id }}]" value="N">
                                                <input type="checkbox" class="view{{ $lists->id }}" id="view{{ $lists->id }}" name="view[{{ $lists->id }}]" value="Y">
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="update[{{ $lists->id }}]" value="N">
                                                <input type="checkbox" class="update{{ $lists->id }}" id="update{{ $lists->id }}" name="update[{{ $lists->id }}]" value="Y">
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="delete[{{ $lists->id }}]" value="N">
                                                <input type="checkbox" class="delete{{ $lists->id }}" id="delete{{ $lists->id }}" name="delete[{{ $lists->id }}]" value="Y">
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="upload[{{ $lists->id }}]" value="N">
                                                <input type="checkbox" class="upload{{ $lists->id }}" id="upload{{ $lists->id }}" name="upload[{{ $lists->id }}]" value="Y">
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="download[{{ $lists->id }}]" value="N">
                                                <input type="checkbox" class="download{{ $lists->id }}" id="download{{ $lists->id }}" name="download[{{ $lists->id }}]" value="Y">
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
            $('#employee_id').val($(this).find(':selected').data('employee_id'));
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
