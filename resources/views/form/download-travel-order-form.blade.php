
@extends('layouts.exportmaster')
@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
        }
        
        .page-wrapper{
            font-size: 18px;
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
            font-size: 18px;
            font-weight: bold;
        }

        .logo {
            max-width: 100px; /* Adjust as needed */
            max-height: 100px; /* Adjust as needed */
            margin: 0 10px; /* Add spacing between the logo and text */
        }

        .sub-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            
        }

        .control-no {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: right;
        }

        .content {
            font-size: 16px;
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
    <div class="">
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid" id="app">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col" style="margin-left: -222px;">
                        <h3 class="page-title">Travel Order Form</h3>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item">HR Administration</li>
                            <li class="breadcrumb-item active"><a href="{{ route('payroll/report/page') }}">Forms</a></li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white"><a href=""@click.prevent="printme" target="_blank">PDF</a></button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="" @click.prevent="printme" target="_blank"> Print</a></button>
                        </div>
                    </div>
                </div>
           
            <div class="row" style="margin-left: -240px;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div>
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
                                            <img src="{{ asset('assets/img/deped_leyte_logo.png') }}" alt="Right Image" class="logo">
                                        </div>
                                    </div>

                                    <hr>
                                    <br>
                                    <div style="padding: 0px 20px;">
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
                                    <br><br><br><br>
                                    <hr>
                                        <p style="font-weight: bold; margin: 0px;">Barugo Padayon Ang Gugma!</p>
                                        <p>Municipal Hall, Burgos St. Poblacion District I Barugo, Leyte<br>
                                            09423386298/09458867038 lgu.@yahoo.com</p>
                                    </div>
                                </div>
                            </div>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    </div>
@endsection
