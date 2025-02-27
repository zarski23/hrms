
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
                        <h3 class="page-title">Criteria for Special Education Teacher</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Administration</a></li>
                            <li class="breadcrumb-item active">Item List</li>
                        </ul>
                    </div>
                    @if(session('hr_user_role') == 'Super Admin')
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_signatories"><i class="fa fa-plus"></i> Add Criteria</a>
                    </div>
                    @endif
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
                                <th>Criteria</th>
                                <th></th>
                                <th style="text-align: center;">Standard Points</th>                                 
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $numbering = 1; ?>
                            @foreach ($criteria as $index => $items )
                            <tr>
                                <td hidden class="id">{{ $items->id }}</td>

                                <!-- 1st Column: # -->
                                @if ($index === 0 || $items->criteria !== $criteria[$index - 1]->criteria)
                                    <td>{{ $numbering++ }}</td>
                                    <td class="document_form">{{ $items->criteria }} </td>
                                    <td></td>   
                                @else
                                    <td></td> <!-- Skip numbering if sub_criteria is null and the criteria is the same as the previous row -->
                                    <td colspan="2" class="document_form">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; - {{ $items->sub_criteria }} </td>   
                                @endif  
                                <td class="signatory_count" style="text-align: center;">{{ $items->standard_points }} </td>                           
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item edit_signatories" href="#" data-toggle="modal" data-target="#edit_signatories">
                                                <i class="fa fa-pencil m-r-5"></i> Edit
                                            </a>
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
        
        <!-- Add Criteria Modal -->
        <div id="add_signatories" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Criteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin/add/criteria') }}" method="POST">
                    @csrf
                    <!-- Checkbox for Criteria and Sub Criteria -->
                    <div class="form-group">
                        <label>Select Criteria Type <span class="text-danger">*</span></label><br>
                        <input type="radio" id="criteria_type" name="criteria_type" value="criteria" checked>
                        <label for="criteria">Criteria</label><br>
                        <input type="radio" id="sub_criteria_type" name="criteria_type" value="sub_criteria">
                        <label for="sub_criteria">Sub Criteria</label>
                    </div>

                    <!-- Input fields for Criteria -->
                    <div id="criteria_fields">
                        <div class="form-group">
                            <label>Criteria <span class="text-danger">*</span></label>
                            <input class="form-control @error('criteria_form') is-invalid @enderror" type="text" id="criteria_form" name="criteria_form">
                            @error('criteria_form')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <label>Standard Points <span class="text-danger">*</span></label>
                            <input class="form-control @error('standard_points') is-invalid @enderror" type="text" id="standard_points" name="standard_points">
                            @error('standard_points')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                        </div>
                    </div>

                    <!-- Additional Input for Sub Criteria -->
                    <div id="sub_criteria_fields" style="display:none;">
                        <div class="form-group">
                            <label>Criteria <span class="text-danger">*</span></label>
                            <select class="form-control @error('criteria_form1') is-invalid @enderror" id="criteria_form1" name="criteria_form1">
                                <option value="" disabled selected>--- Select Criteria ---</option>
                                @foreach ($uniqueCriteria as $criteria)
                                    <option value="{{ $criteria }}">{{ $criteria }}</option>
                                @endforeach
                            </select>
                            @error('criteria_form1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>

                            <label>Sub Criteria <span class="text-danger">*</span></label>
                            <input class="form-control @error('sub_criteria_form1') is-invalid @enderror" type="text" id="sub_criteria_form1" name="sub_criteria_form1">
                            @error('sub_criteria_form1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>

                            <label>Standard Points <span class="text-danger">*</span></label>
                            <input class="form-control @error('standard_points1') is-invalid @enderror" type="text" id="standard_points1" name="standard_points1">
                            @error('standard_points1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-success submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <!-- /Add Criteria Modal -->
        
        <!-- Edit Signatories Modal -->
        <div id="edit_signatories" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Criteria</h5>
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
                                <label>Criteria<span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="document_form_edit" name="document_form" value="">
                                <br>
                                <label>Standard Points<span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="signatory_count_edit" name="signatory_count" value="">
                                <!-- <br>
                                <label>Complete Name <span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="complete_name_edit" name="complete_name" value="">
                                <br>
                                <label>Position Name <span class="text-danger">*</span></label>                                
                                <input type="text" class="form-control" id="position_edit" name="position" value="">
                                <br>                                 -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const criteriaType = document.getElementById('criteria_type');
            const subCriteriaType = document.getElementById('sub_criteria_type');
            const criteriaFields = document.getElementById('criteria_fields');
            const subCriteriaFields = document.getElementById('sub_criteria_fields');
            const subCriteriaSelect = document.querySelector('#sub_criteria_fields select'); // Adjust selector if needed

            // Function to clear input fields
            function clearInputFields(container) {
                const inputs = container.querySelectorAll('input[type="text"]');
                inputs.forEach(input => input.value = '');
            }

            // Function to reset select dropdowns
            function resetSelectFields(container) {
                const selects = container.querySelectorAll('select');
                selects.forEach(select => select.selectedIndex = 0); // Resets to the first option
            }

            // Event listener to show/hide fields based on selection
            criteriaType.addEventListener('click', function() {
                // Show criteria fields and hide sub criteria fields
                criteriaFields.style.display = 'block';
                subCriteriaFields.style.display = 'none';

                // Clear the input fields and reset select dropdown in sub criteria fields
                clearInputFields(subCriteriaFields);
                resetSelectFields(subCriteriaFields);
            });

            subCriteriaType.addEventListener('click', function() {
                // Show sub criteria fields and hide criteria fields
                criteriaFields.style.display = 'none';
                subCriteriaFields.style.display = 'block';

                // Clear the input fields in criteria fields
                clearInputFields(criteriaFields);
            });
        });
    </script>



    @endsection
@endsection
