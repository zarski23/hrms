<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class Activity extends Controller
{
    public function userLog(){

        $userLog = UserLog::select('user_logs.id','users.username', 'users.first_name', 'users.middle_name', 'users.last_name', 'user_logs.description', 'user_logs.date_time')
        ->join('users', 'user_logs.user_id', '=', 'users.id')
        ->orderBy('user_logs.id', 'asc')
        ->get();

       
        return view('user_log',compact('userLog'));

    }

    public function activityLog(){

        $activityLog = ActivityLog::select('activity_logs.id','users.employee_id', 'users.first_name', 'users.middle_name', 'users.last_name','application_name', 'activity_logs.activities', 'activity_logs.date_time')
        ->join('users', 'activity_logs.user_id', '=', 'users.id')
        ->join('applications', 'activity_logs.app_id', '=', 'applications.id')
        ->orderBy('activity_logs.id', 'asc')
        ->get();

        return view('activity_log',compact('activityLog'));
        
    }
}
