
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
                        <h3 class="page-title">List of Signatories</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Signatories</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_signatories"><i class="fa fa-plus"></i> Add Signatories</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th>Document / Form</th>
                                    <th>Signatory Count</th>
                                    <th>Complete Name</th>
                                    <th>Position</th>                                    
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employeeSignatories as $key=>$items )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td class="document_form">{{ $items->document_form }}</td>
                                    <td class="signatory_count">{{ $items->signatory_count }}</td>
                                    <td class="complete_name">{{ $items->complete_name }}</td>
                                    <td class="position">{{ $items->position }}</td>                                    
                                    <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item  edit_signatories" href="#" data-toggle="modal" data-target="#edit_signatories"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <!-- <a class="dropdown-item delete_signatories" href="#" data-toggle="modal" data-target="#delete_signatories"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                        </div>
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
        
        <!-- Add Signatories Modal -->
        <div id="add_signatories" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Signatories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/add/signatories') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Document / Form <span class="text-danger">*</span></label>
                                <input class="form-control @error('document_form') is-invalid @enderror" type="text" id="document_form" name="document_form">
                                @error('document_form')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Signatory count <span class="text-danger">*</span></label>
                                <input class="form-control @error('signatory_count') is-invalid @enderror" type="text" id="signatory_count" name="signatory_count">
                                @error('signatory_count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Complete Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('complete_name') is-invalid @enderror" type="text" id="complete_name" name="complete_name">
                                @error('complete_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label>Position <span class="text-danger">*</span></label>
                                <input class="form-control @error('position') is-invalid @enderror" type="text" id="position" name="position">
                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Signatories Modal -->
        
        <!-- Edit Signatories Modal -->
        <div id="edit_signatories" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Signatories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/edit/signatories') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id_edit" name="id" value="">
                                <label>Document / Form <span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="document_form_edit" name="document_form" value="">
                                <br>
                                <label>Signatory count<span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="signatory_count_edit" name="signatory_count" value="">
                                <br>
                                <label>Complete Name <span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="complete_name_edit" name="complete_name" value="">
                                <br>
                                <label>Position Name <span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="position_edit" name="position" value="">
                                <br>                                
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Signatories Modal -->

        <!-- Delete Signatories Modal -->
        <!-- <div class="modal custom-modal fade" id="delete_signatories" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Signatories</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
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
        </div> -->
        <!-- /Delete Postion Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_signatories',function()
        {
            var _this = $(this).parents('tr');
            $('#id_edit').val(_this.find('.id').text());
            $('#document_form_edit').val(_this.find('.document_form').text());
            $('#signatory_count_edit').val(_this.find('.signatory_count').text());
            $('#complete_name_edit').val(_this.find('.complete_name').text());
            $('#position_edit').val(_this.find('.position').text());            
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_signatories',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
