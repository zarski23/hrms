
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
                        <h3 class="page-title">Employee View</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee View Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Employee edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('employee/user/permission/update') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $employees[0]->id }}">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Full Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employees[0]->first_name }} {{ $employees[0]->last_name }}">
                                    <br>
                                    </div>
                                    <label class="col-form-label col-md-2">Employee ID</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $employees[0]->employee_id }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee Permission</label>
                                    <div class="col-md-10">
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
                                                    @foreach ($combinedPermissions as $items)
                                                        @foreach ($items['permission_lists'] as $permissionList)
                                                    <tr>
                                                        <td>{{ $permissionList->permission_name }}</td>
                                                        <input type="hidden" name="permission_name[]" value="{{ $permissionList->permission_name }}">
                                                        <input type="hidden" name="id_count[]" value="{{ $items['permission']->id_count }}">
                                                        <td class="text-center">
                                                            <input type="hidden" name="add[{{ $items['permission']->id_count }}]" value="N">
                                                            <input type="checkbox" id="add" name="add[{{ $items['permission']->id_count }}]" value="Y" {{ $items['permission']->add_action == 'Y' ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="hidden" name="view[{{ $items['permission']->id_count }}]" value="N">
                                                            <input type="checkbox" id="view" name="view[{{ $items['permission']->id_count }}]" value="Y" {{ $items['permission']->view_action == 'Y' ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="hidden" name="update[{{ $items['permission']->id_count }}]" value="N">
                                                            <input type="checkbox" id="update" name="update[{{ $items['permission']->id_count }}]" value="Y" {{ $items['permission']->update_action == 'Y' ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="hidden" name="delete[{{ $items['permission']->id_count }}]" value="N">
                                                            <input type="checkbox" id="delete" name="delete[{{ $items['permission']->id_count }}]" value="Y" {{ $items['permission']->delete_action == 'Y' ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="hidden" name="upload[{{ $items['permission']->id_count }}]" value="N">
                                                            <input type="checkbox" id="upload" name="upload[{{ $items['permission']->id_count }}]" value="Y" {{ $items['permission']->upload_action == 'Y' ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="hidden" name="download[{{ $items['permission']->id_count }}]" value="N">
                                                            <input type="checkbox" id="download" name="download[{{ $items['permission']->id_count }}]" value="Y" {{ $items['permission']->download_action == 'Y' ? 'checked' : '' }}>
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-success submit-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
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
    @endsection

@endsection
