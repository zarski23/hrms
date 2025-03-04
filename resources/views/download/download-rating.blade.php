
@extends('layouts.exportmaster')
@section('content')

    <style>
        * {
            box-sizing: border-box; /* Ensures padding and borders are included in the element's total width */
        }

        /* Ensure table and its container take full width of the screen */
        .table-responsive {
            width: 100%;
            max-width: 100%;
            overflow-x: auto; /* Allows the table to scroll horizontally if necessary */
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Ensures that borders don't have space between them */
            table-layout: auto; /* Auto-layout for equal column widths */
        }

        /* Style for table cells */
        table, th, td {
            border: 1px solid black; /* Adds border to the table, header, and cells */
            padding: 8px; /* Adds padding inside the cells */
            text-align: center; /* Aligns text to the left inside the cells */
        }

        /* Style for the table header */
        th {
            background-color: #f2f2f2; /* Light grey background for the header */
            font-weight: bold; /* Makes the text in the header bold */
        }

        /* Reducing padding and height to ensure compactness */
        .small-row-height {
            height: 20px; /* Adjust the height as needed */
        }
        
        .table td, .table th {
            padding: 4px; /* Reduce padding to make the table more compact */
        }

        /* Remove any extra margins/padding from the page wrapper */
        .page-wrapper {
            margin-left: 0;
            margin-right: 0;
            max-width: 100%;
            overflow-x: hidden; /* Prevents horizontal scrolling */
        }

        /* Make sure page header and modal content fit the page */
        .modal-header, .content {
            width: 100%;
            max-width: 100%;
        }
    </style>

    <div class="page-wrapper" style="margin-left: 0px; margin-top: -60px;">
        <!-- Page Content -->
        <div class="content container-fluid" id="app">
            <!-- Page Header -->
            <div class="page-header">
                <!-- <div class="row align-items-center">
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white"><a href=""@click.prevent="printme" target="_blank">PDF</a></button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="" @click.prevent="printme" target="_blank"> Print</a></button>
                        </div>
                    </div>
                </div> -->
                <div class="modal-header" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <img src="{{ asset('assets/img/deped_logo.png') }}" alt="Logo" style="width: 75px; height: auto; margin-bottom: 5px; padding: 0;">

                    <p style="font-family: 'Old English Text MT'; font-size: 13pt; font-weight: bold; margin: 0; padding: 0;">
                        Republic of the Philippines
                    </p>
                    <p style="font-family: 'Old English Text MT'; font-size: 19pt; font-weight: bold; margin: -10px; padding: 0;">
                        Department of Education
                    </p>
                    <p style="font-family: 'Trajan Pro'; font-size: 11pt; font-weight: bold; margin: 0; padding: 0;">
                        REGION VIII<br>SCHOOLS DIVISION OF LEYTE
                    </p>
                    <br>
                    <h3 style="font-family: 'Courier New', Courier, monospace; font-weight: bold;" class="modal-title">Individual Evaluation Sheet (IES)</h3>
                    <p style="text-align: center; font-size: 1.10rem; font-family: 'Courier New', Courier, monospace; font-weight: 900;">Level 2 Positions</p>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <input type="text" hidden name="application_code" value="{{ $applicant->application_code }}">
                        <div class="row"> 
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <label style="margin: 0;">Name of Applicants: <span style="text-decoration: underline; font-weight: bold;" id="e_name"> {{ $applicant->last_name }}, {{ $applicant->first_name }} {{ $applicant->middle_name }} {{ $applicant->extension_name }}  </span></label>
                                    <br>
                                    <label style="margin: 0;">Position Applied For: <span style="text-decoration: underline; font-weight: bold;" id="">{{ $applicant->application_title }} </span></label>
                                    <br>
                                    <label style="margin: 0;">Schools Division Office: <span style="text-decoration: underline; font-weight: bold;" id="">Leyte Division </span></label>
                                    <br>
                                    <label style="margin: 0;">Contact Number: <span style="text-decoration: underline; font-weight: bold;" id="">{{ $applicant->contact_number }} </span></label>
                                    <br>
                                    <label style="margin: 0;">Job Group/SG-Level: <span style="" id="">_______________________ </span></label>
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group" style="text-align: right; margin-right: 20px;">
                                    <label>Application Code: <span style="text-decoration: underline; font-weight: bold;" id="e_application_code_label">{{ $applicant->application_code }} </span></label>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered review-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width:40px;">#</th>
                                    <th colspan="2">Criteria</th>
                                    <th style="text-align: center;">Weight<br>Allocation</th>
                                    <th>Details of Applicant's <br>Qualification</th>
                                    <th style="text-align: center;">Rating</th>
                                    <th style="text-align: center;">Points</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $numbering = 1; $sub_total = false; ?>

                                @php
                                    // Check if $combinedData is set and is an array or collection
                                    $isCombinedDataSet = isset($combinedData) && (is_array($combinedData) || $combinedData instanceof \Illuminate\Support\Collection);
                                @endphp

                                @if ($isCombinedDataSet && !empty($combinedData))
                                    @foreach ($combinedData as $index => $items)
                                        <tr>
                                            <td hidden class="id">{{ $items->id }}</td>

                                            <!-- Check if it's a new main criteria or the same one as the previous -->
                                            @if ($index === 0 || $items->criteria !== $combinedData[$index - 1]->criteria)
                                                
                                                <!-- Print the criteria row -->
                                                <td>{{ $numbering++ }}</td>
                                                <td colspan="2" class="document_form" style="text-align: left;">{{ $items->criteria }}</td>

                                                @if ($index + 1 >= count($combinedData) || $items->criteria !== $combinedData[$index + 1]->criteria)
                                                    <!-- Single row criteria without sub-criteria -->
                                                    <td class="document_form" style="text-align: center;">{{ $items->standard_points }}</td>
                                                    <td>{{ $items->criteria_details }}</td>
                                                    <td>{{ $items->criteria_increment }}</td>
                                                    <td>{{ $items->criteria_points }}</td>
                                                @else
                                                    <!-- Multiple rows criteria with sub-criteria -->
                                                    <td colspan="4" class="document_form"></td>
                                                @endif
                                                
                                                <?php $sub_total = false; ?>

                                            @else
                                                <!-- Sub-criteria row -->
                                                <td></td> <!-- Skip numbering -->
                                                <td colspan="2" class="document_form"  style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp; - {{ $items->sub_criteria }}</td>
                                                <td class="document_form" style="text-align: center;">{{ $items->standard_points }}</td>
                                                <td>{{ $items->criteria_details }}</td>
                                                <td>{{ $items->criteria_increment }}</td>
                                                <td>{{ $items->criteria_points }}</td>

                                                <?php $sub_total = true; ?>
                                            @endif

                                            <!-- Display sub-total row if needed -->
                                            <!-- @if ($sub_total && ($index + 1 >= count($combinedData) || $items->criteria !== $combinedData[$index + 1]->criteria))
                                                <tr>
                                                    <td></td>
                                                    <td colspan="5" class="document_form" style="text-align: right;">Sub Total:</td>
                                                    <td><input type="text" class="form-control" style="text-align: center;" id="criteria_{{ $items->id }}_points" placeholder="0" readonly></td>
                                                    <td></td>
                                                </tr>
                                                <?php $sub_total = false; ?>
                                            @endif -->
                                        </tr>
                                    @endforeach

                                    <!-- Total Row -->
                                    <tr>
                                        <td colspan="3" class="text-center">Total</td>
                                        <td style="text-align: center;">100</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $totalPoints }}</td>
                                    </tr>
                                @else
                                    <p>No criteria available.</p>
                                @endif
                            </tbody>
                        </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="responsive-text" style="word-wrap: break-word; word-break: break-word; white-space: normal;">
                                        I hereby attest to the conduct of the application and assessment process in accordance with the applicable guidelines;
                                        and acknowledge, upon discussion with the Human Resource Merit Promotion and Selection Board (HRMPSB), the results of the comparative
                                        assessment and the points given to me based on my qualifications and submitted documentary requirements for the
                                        <u>{{ $applicant->application_title }}</u> under <strong>DepEd - Division of Leyte.</strong>
                                        Furthermore, I hereby affix my signature in this Form to attest to the objective and judicious conduct of HRMPSB evaluation
                                        through the Open Ranking System.
                                    </p>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: right;">
                                <div style="text-align: center;">
                                    <p style="text-decoration: underline; font-weight: bold; margin: 0;">
                                        {{ $applicant->first_name }} 
                                        {{ isset($applicant->middle_name) ? strtoupper(substr($applicant->middle_name, 0, 1)) . '.' : '' }}
                                        {{ $applicant->last_name }} 
                                        {{ $applicant->extension_name }}
                                    </p>
                                    <p style="margin: 0;" id="">Name and Signature of Applicant</p>
                                    <p style="margin: 0;" id="">
                                        Date: <?php echo date('F j, Y'); ?>
                                    </p>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: left;">
                                <div style="text-align: left;">
                                    <p id="">Attested:</p>
                                    <p style="text-decoration: underline; font-weight: bold; margin: 0;">
                                       &nbsp;&nbsp;&nbsp; SGD TEODORICO C. PELINO JR. EdD &nbsp;&nbsp;&nbsp;
                                    </p>
                                    <p style="margin: 0;" id=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HRMPSB CHAIRPERSON</p>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div style="display: flex; align-items: center;">
                                    <img src="{{ asset('assets/img/deped_matatag.png') }}" alt="Logo" style="max-width: 75px; margin-bottom: 15px; margin-right: 10px;">
                                    <img src="{{ asset('assets/img/bagong_pilipinas.png') }}" alt="Logo" style="max-width: 75px; margin-bottom: 15px; margin-right: 10px;">
                                    <img src="{{ asset('assets/img/deped_leyte_logo.png') }}" alt="Logo" style="max-width: 75px; margin-bottom: 15px; margin-right: 10px;">
                                    <p style="font-family: 'Calibri', sans-serif; font-size: 12pt; margin-left: 15px;">
                                        <strong>Address:</strong> Government Center, Candahug, Palo, Leyte<br>
                                        <strong>Telephone No.:</strong> (053) 888-3527<br>
                                        <strong>Email Address:</strong> leyte.ro8@deped.gov.ph<br>
                                        <strong>Website:</strong> depedleytedivision.com
                                    </p>
                                </div>
                                <p style="text-align: right; margin-left: auto; margin-right: 5px;">
                                    Page <strong>1</strong> of <strong>1</strong>
                                </p>
                            </div>
                    </div>
                </div>
            </div>       
      
        </div>
        <!-- /Page Content -->
    </div>

@endsection
