
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <style>
        .download-button {
            text-transform: none;
            font-size: 0.8rem; /* Smaller font size */
            padding: 5px 10px; /* Adjust padding for a smaller button */
            position: absolute;
            right: 20px; /* Adjust the position from the right edge */
            top: 50%; /* Center vertically relative to the parent */
            transform: translateY(-50%); /* Adjust to perfectly center */
            margin: 25px;
        }

        .modal-header {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-header .modal-title {
            flex-grow: 1;
            text-align: center;
           
        }

        .custom-toggle-btn {
            background-color: #f0f0f0;
            color: #919191; 
            text-transform: capitalize !important;
            border: 1px solid #ccc; 
            padding: 6px 12px  !important;
            font-weight: 400; 
        }

        .custom-toggle-btn.active {
            background-color: #243c2e; /* Slightly darker when active */
            border-color: #bbb; /* Darker border when active */
            color: #f0f0f0;
        }

        .custom-toggle-btn:hover {
            background-color: #e0e0e0; /* Slightly darker on hover */
            border-color: #bbb; /* Darker border on hover */
        }

        .custom-toggle-btn.active:hover {
            color: #919191; /* Text color on hover when active */
            background-color: #2a4a3a; /* Optional: further darken the background on hover */
        }
        
    </style>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">SPET Applicants <span id="year"></span></h3>
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
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">
                        <!-- Toggle Button Group -->
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn custom-toggle-btn {{ !$isScoreActive ? 'active' : '' }}" id="update-info-btn">
                                <input type="radio" name="options" id="option1" autocomplete="off" {{ !$isScoreActive ? 'checked' : '' }}> Update Info
                            </label>
                            <label class="btn custom-toggle-btn {{ $isScoreActive ? 'active' : '' }}" id="add-score-btn">
                                <input type="radio" name="options" id="option2" autocomplete="off" data-toggle="modal" data-target="#add_score_modal" {{ $isScoreActive ? 'checked' : '' }}> Add Score
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <button style="text-transform: capitalize !important;" type="sumit" class="btn btn-info btn-block" onclick="location.reload()"> Refresh </button>  
                    </div>
                    @if (Session::get('hr_user_role') == "Super Admin" || Session::get('hr_user_role') == "Data Admin")
                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">  
                            <a href="#" style="text-transform:none;" class="btn btn-success btn-block" data-toggle="modal" data-target="#add_salary"><i class="fa fa-upload"> </i> &nbsp; Batch Upload <small>(Excel File)</small></a> 
                        </div>
                    @endif
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
                                    <th>Suffix</th>
                                    <!-- <th>Sex</th>
                                    <th>Civil Status</th> -->
                                    <!-- <th>Contact #</th> -->
                                    <!-- <th>Email Address</th> -->
                                    <th>Home Address</th>
                                    <th>Position Applied</th>
                                    <th>School Address</th>
                                    <th class="text-center">Total Ratings</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applicantInformation as $record)
                                <tr class="table_row" data-applicant-code="{{ $record->applicant_code }}">
                                    <td class="id" hidden>{{ $record->applicant_id }}</td>
                                    <td class="application_code">{{ $record->applicant_code }}</td>
                                    <td class="last_name" style="text-transform: capitalize;">{{ strtolower($record->last_name) }}</td>
                                    <td class="first_name" style="text-transform: capitalize;">{{ strtolower($record->first_name) }}</td>
                                    <td style="text-transform: capitalize;">{{ strtolower($record->middle_name) }}</td>
                                    <td style="text-transform: capitalize;">{{ strtolower($record->extension_name) }}</td>
                                    <!-- <td style="text-transform: capitalize;" class="sex">{{ strtolower($record->sex) }}</td>
                                    <td style="text-transform: capitalize;" class="civil_status">{{ strtolower($record->civil_status) }}</td> -->
                                    <!-- <td class="contact_number">{{ $record->contact_number }}</td> -->
                                    <!-- <td class="email">{{ $record->email }}</td> -->
                                    <td class="barangay">{{ $record->barangay }} {{ $record->municipality }} {{ $record->province }}</td>
                                    <td class="position_applied">{{ $record->application_title }}</td>
                                    <td class="address">{{ $record->school_barangay }} {{ $record->school_municipality }}</td>
                                    <td style="text-align: center; color: #0037ff;">{{ $record->total_points }}</td>
                                    <td class="text-center"> <span class="badge bg-inverse-success role_name">Qualified</span></td>
                                    <td class="education_inc" hidden>{{ $record->education_inc }}</td>
                                    <td class="education_points" hidden>{{ $record->education_points }}</td>
                                    <td class="training_inc" hidden>{{ $record->training_inc }}</td>
                                    <td class="training_points" hidden>{{ $record->training_points }}</td>
                                    <td class="experience_inc" hidden>{{ $record->experience_inc }}</td>
                                    <td class="experience_points" hidden>{{ $record->experience_points }}</td>
                                    <td class="pbet_let_lept_rating" hidden>{{ $record->pbet_let_lept_rating }}</td>
                                    <td class="pbet_let_lept_points" hidden>{{ $record->pbet_let_lept_points }}</td>
                                    <td class="ppst_coi_rating" hidden>{{ $record->ppst_coi_rating }}</td>
                                    <td class="ppst_coi_points" hidden>{{ $record->ppst_coi_points }}</td>
                                    <td class="ppst_ncoi_rating" hidden>{{ $record->ppst_ncoi_rating }}</td>
                                    <td class="ppst_ncoi_points" hidden>{{ $record->ppst_ncoi_points }}</td>

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
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("name");
            filter = input.value.toUpperCase();
            table = document.getElementById("employee_table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) { // Start at 1 to skip the table header
                tr[i].style.display = "none"; // Hide the row initially
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = ""; // Show the row if the search matches
                            break; // Stop searching other cells in this row
                        }
                    }
                }
            }
        }

        // Attach the search function to the keyup event
        document.getElementById("name").addEventListener("keyup", search);
    </script>

    <script>
        // Highlight row on hover and change cursor to pointer
        $('#employee_table tbody tr').hover(
            function() {
                $(this).css({
                    'background-color': '#FEECB3',  // Highlight the row
                    'cursor': 'pointer'             // Change cursor to pointer
                });
            },
            function() {
                $(this).css({
                    'background-color': '',          // Revert to original background
                    'cursor': ''                     // Revert to default cursor
                });
            }
        );

        // Toogle Button, Update info and Add Score
        document.getElementById('update-info-btn').addEventListener('click', function() {
            window.location.href = "{{ route('update/info/page') }}";
        });

        document.querySelectorAll('.table_row').forEach(row => {
            row.addEventListener('click', function() {
                var applicantCode = this.getAttribute('data-applicant-code');
                window.location.href = "{{ url('update/applicant/info/score') }}/" + applicantCode;
            });
        });

    </script>


    @endsection
@endsection
