
@extends('layouts.master')
@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            
        }

        .container {
            text-align: center;
        }

        .center-image {
            width: 500px;
            margin: 0 auto; /* Center the image */
            height: 100px;
        }

        .headerForm {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap; /* Allow items to wrap to the next line if necessary */
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .logo {
            max-width: 100px; /* Adjust as needed */
            max-height: 100px; /* Adjust as needed */
            margin: 0 10px; /* Add spacing between the logo and text */
        }

        .sub-header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            
        }

        .control-no {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: right;
        }

        .content {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .footer {
            text-align: center;
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
                        <h3 class="page-title">Travel Order Form</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">HR Administration</a></li>
                            <li class="breadcrumb-item active">Forms</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ url('form/travel/order/print') }}" class="btn add-btn" target="_blank" style="margin: 0px 10px; background-color:#55ce63;"><i class="fa fa-print"></i>Print</a>
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#edit_form"><i class="fa fa-edit"></i>Edit Form</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div><hr>
                    <div class="container">
                            <div>
                                <img src="{{ asset('assets/img/philippines-symbol.png') }}" alt="Center Image" class="center-image">
                            </div>
                            <div class="headerForm">
                                <img src="{{ asset('assets/img/province_of_leyte_seal.png') }}" alt="Left Image" class="logo">
                                Republic of the Philippines<br>
                                PROVINCE OF LEYTE<br>
                                Municipality of Barugo<br><br>
                                Human Resource Management Office
                                <img src="{{ asset('assets/img/barugo_logo.png') }}" alt="Right Image" class="logo">
                            </div>
                        </div>

                        <hr>
                        <br>
                        <div style="padding: 0px 100px;">
                            <div class="sub-header">
                                TRAVEL ORDER
                            </div>

                            <div class="control-no">
                                <p class="label">No. 2023-07-000001</p>
                            </div>

                            <div class="content">
                                
                                <p class="label">NAME OF EMPLOYEE:</p>
                                <p class="label">OFFICE:</p>
                                <p class="label">TRAVEL DATE:</p>
                                <p class="label">DESTINATION:</p>
                                <p class="label">PURPOSE:</p>

                                <br><br>
                                <p class="label">REMARKS:</p>
                                <p>Your travel is OFFICIAL and immediately returns to the station as soon as OFFICIAL BUSINESS is over.</p>
                            </div>
                        </div>
                        <div class="signature">
                        <br><br><br>
                            <p>Approved by:</p><br>
                            <p style="font-weight: bold;">DR. ARON CABANACAN BALAIS, FPCEM<br>
                            Municipal Mayor</p>
                        <br><br>
                        </div>

                        <div class="footer">
                        <br><br>
                        <hr>
                            <p style="font-weight: bold; margin: 0px;">Barugo Padayon Ang Gugma!</p>
                            <p>Municipal Hall, Burgos St. Poblacion District I Barugo, Leyte<br>
	                            09423386298/09458867038 lgu.@yahoo.com</p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        
        <!-- Edit Department Modal -->
        <div id="edit_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Department Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="department_edit" name="department" value="">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Department Modal -->

    </div>

    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_department',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#department_edit').val(_this.find('.department').text());
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_department',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
