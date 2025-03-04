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
                        <h3 class="page-title">User Log</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Main</a></li>
                            <li class="breadcrumb-item active">User Controller</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- /Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" style="font-size: 14px !important;">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th style="color: #4CAF50;">Logs</th>
                                    <th>Date Time</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (collect($userLog)->sortByDesc('id') as $user)
                                    <tr>
                                        <td hidden>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                        <td style="color: #4CAF50;">{{ $user->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->date_time)->format('D, M d, Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection


