
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Non Teaching Applicants <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Administration</a></li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add New Applicant</a>
                    </div>
                </div>
            </div>
             <!-- Search Filter -->
             <!-- <form action="" method="POST"> -->
                <!-- @csrf -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="name" onkeyup="search()">
                            <label class="focus-label">Search Here</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <button type="sumit" class="btn btn-info btn-block" onclick="location.reload()"> Refresh </button>  
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">  
                        <a href="#" style="text-transform:none;" class="btn btn-success btn-block" data-toggle="modal" data-target="#add_salary"><i class="fa fa-file"></i> Batch Upload <small>(Excel File)</small></a> 
                    </div>
                </div>
            <!-- </form>      -->
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="employee_table" class="table table-striped custom-table datatable"  style="font-size: 13px !important;">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Application Code</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Sex</th>
                                    <th>Civil Status</th>
                                    <th>Contact #</th>
                                    <th>Email Address</th>
                                    <th>Barangay</th>
                                    <th>Position Applied</th>
                                    <th class="text-center">Total Ratings</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applicantInformation as $record)
                                <tr class="table_row"
                                        data-id="{{ $record->id }}"
                                        data-name="{{ strtolower($record->last_name) }}, {{ strtolower($record->first_name) }} {{ strtolower($record->middle_name) }}"
                                        data-application_code="{{ $record->application_code }}"
                                        data-position_applied="Special Education Teacher I">

                                    <td class="id" hidden>{{ $record->id }}</td>
                                    <td class="application_code">{{ $record->application_code }}</td>
                                    <td class="name" style="text-transform: capitalize;">{{ strtolower($record->last_name) }}</td>
                                    <td class="dtr_id" style="text-transform: capitalize;">{{ strtolower($record->first_name) }}</td>
                                    <td style="text-transform: capitalize;">{{ strtolower($record->middle_name) }}</td>
                                    <td class="dtr_year">{{ $record->sex }}</td>
                                    <td class="dtr_date">{{ $record->civil_status }}</td>
                                    <td class="week">{{ $record->contact_number }}</td>
                                    <td class="break_out">{{ $record->email }}</td>
                                    <td class="break_in">{{ $record->barangay }}</td>
                                    <td class="position_applied">Special Education Teacher I</td>
                                    <td>58.01</td>
                                    <td class="text-center">
                                        <span class="badge bg-inverse-success role_name">Qualified</span>
                                        @if ($record->status=='Absent')
                                            <span class="badge bg-inverse-danger role_name">{{ $record->status }}</span>
                                        @elseif ($record->status=='Full-Day')
                                            <span class="badge bg-inverse-success role_name">{{ $record->status }}</span>
                                        @elseif ($record->status=='Half-Day')
                                            <span class="badge bg-inverse-info role_name">{{ $record->status }}</span>
                                        @elseif ($record->status=='Off-Duty')
                                            <span class="badge bg-inverse-danger role_name">{{ $record->status }}</span>
                                        @elseif ($record->status=='Overtime')
                                            <span class="badge bg-inverse-warning role_name">{{ $record->status }}</span>
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a class="dropdown-item userUpdate" ><i class="fa fa-pencil m-r-5"></i> Add Score</a>
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
       

        <!-- Upload File Modal -->
        <div id="add_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Batch Upload <small>(Excel File)</small></h5>                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                        
                    </div>
                    <div class="modal-body">
                        <form action="{{route('upload/elementary/applicants')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div> 
                                <div>
                                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="file">
                                </div>
                            
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Upload File Modal -->
        
        <!-- Edit Rating Modal -->
        <div id="edit_rating" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-max" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Courier New', Courier, monospace; font-weight: bold;" class="modal-title">Individual Evaluation Sheet (IES)</h5>
                        <br>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p style="text-align: center; font-size: 1.10rem; font-family: 'Courier New', Courier, monospace; font-weight: 900;">Level 2 Positions</p>
                    <div class="modal-body">
                        <form action="{{ route('admin/edit/employee/attendance') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="id" id="e_id" value="" readonly>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Name of Applicants: <span style="text-decoration: underline; font-weight: bold;" id="e_name"> </span></label>
                                        <label>Position Applied For: <span style="text-decoration: underline; font-weight: bold;" id="e_position_applied"> </span></label>
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <div class="form-group" style="text-align: right; margin-right: 20px;">
                                        <label>Application Code: <span style="text-decoration: underline; font-weight: bold;" id="e_application_code"> </span></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <table style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="padding: 10px;"></th>
                                        <th style="padding: 10px;">Criteria</th>
                                        <th style="padding: 10px;">Details of Applicant's Qualification</th>
                                        <th style="padding: 10px;">No. of Increments</small></th>
                                        <th style="padding: 10px;">Actual Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Education</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Training</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Experience</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Performance</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Outstanding Accomplishments</td>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px; text-align: left;">&nbsp;&nbsp; Award & Recognition</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px; text-align: left;">&nbsp;&nbsp; Research & Innovation</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px; text-align: left;">&nbsp;&nbsp; Subject Matter Expert / <br>&nbsp;&nbsp; Membership in National <br>&nbsp;&nbsp; TWG or Committees </td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px; text-align: left;">&nbsp;&nbsp; Resource Speakership / <br>&nbsp;&nbsp; Learning Facilitation</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"></td>
                                        <td style="padding: 10px; text-align: left;">&nbsp;&nbsp; NEAP Accredited Learning<br>&nbsp;&nbsp; Facilitator</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Application of Education</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Application of L&D</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;"><input type="checkbox" onclick="toggleRowEditable(this)"></td>
                                        <td style="padding: 10px; text-align: left; cursor: pointer;" onclick="checkCheckbox(this)">Potential (Written Test, <br>BEI, Work Sample Test)</td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                        <td style="padding: 10px;"><input style="padding: 0px 5px; height: 30px; text-align: center; border-color: #939191;" class="form-control" type="text" name="" id="" value="" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <hr>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success submit-btn">Submit</button> &nbsp;
                                <button type="button" class="btn btn-warning submit-btn" onclick="clearTimeFields()">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Rating Modal -->
        
        <!-- Delete Salary Modal -->
        <!-- <div class="modal custom-modal fade" id="delete_salary" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Salary</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="id" class="e_id" value="">
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
        <!-- /Delete Salary Modal -->
     
    </div>
    <!-- /Page Wrapper -->
    @section('script')
        <script>
            $(document).ready(function() {
                $('.select2s-hidden-accessible').select2({
                    closeOnSelect: false
                });
            });
        </script>
        <script>
            // select auto id and email
            $('#name').on('change',function()
            {
                $('#employee_id').val($(this).find(':selected').data('employee_id'));
            });
    </script>
        
         {{-- delete js --}}
    <script>
        $(document).on('click','.salaryDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
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

    <!-- Clear Input type = time -->
    <script>
    function clearTimeFields() {
        document.getElementById('e_time_in').value = null;
        document.getElementById('e_break_in').value = null;
        document.getElementById('e_break_out').value = null;
        document.getElementById('e_time_out').value = null;
    }
    </script>

    <script>
        // Highlight row on hover
        $('#employee_table tbody tr').hover(
            function() {
                $(this).css('background-color', '#FEECB3');
            },
            function() {
                $(this).css('background-color', '');
            }
        );

        $(document).ready(function(){
            // Make the entire row clickable
            $('#employee_table tbody').on('click', '.table_row', function() {

                // Get data from the clicked row
                var id = $(this).data('id');
                var name = $(this).data('name').toUpperCase();
                var application_code = $(this).data('application_code');
                var position_applied = $(this).data('position_applied');

                // Fill the modal fields with the data
                $('#e_id').val(id);
                $('#e_name').text(name);
                $('#e_application_code').text(application_code);
                $('#e_position_applied').text(position_applied);

                // Show the modal
                $('#edit_rating').modal('show');
            });
        });


    </script>

    <script>
        function toggleRowEditable(checkbox) {
            const row = checkbox.closest('tr');
            const inputs = row.querySelectorAll('td:nth-child(n+3):nth-child(-n+4) input'); // Get all inputs except last TD

            // Check if the current row is "Outstanding Accomplishments"
            if (row.querySelector('td:nth-child(2)').innerText.trim() === "Outstanding Accomplishments") {
                let currentRow = row.nextElementSibling;

                for (let i = 0; i < 5; i++) { // Loop through the current row and the next 5 rows
                    if (!currentRow) break; // Ensure we don't go out of bounds

                    const inputs = currentRow.querySelectorAll('td:nth-child(n+3):nth-child(-n+4) input');
                    inputs.forEach(input => {
                        input.readOnly = !checkbox.checked;
                    });

                    currentRow = currentRow.nextElementSibling; // Move to the next row
                }
            } else {
                inputs.forEach(input => {
                    input.readOnly = !checkbox.checked;
                });
            }
        }

        function checkCheckbox(td) {
            const row = td.closest('tr');
            const checkbox = row.querySelector('input[type="checkbox"]');

            // Toggle checkbox state
            checkbox.checked = !checkbox.checked;

            // Update the row's editability based on the checkbox state
            toggleRowEditable(checkbox);
        }

    </script>


    @endsection
@endsection
