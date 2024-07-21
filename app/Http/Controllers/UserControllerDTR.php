<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserControllerDTR extends Controller
{
    public function viewDTR(){

        // Query on the first database connection (second_db)
        $attendanceData = DB::connection('second_db')
        ->table('employee_attendance')
        ->select(
            'employee_profiles.user_id',
            'employee_attendance.dtr_id',
            'employee_attendance.date',
            'employee_attendance.week',
            'employee_attendance.time_in',
            'employee_attendance.break_out',
            'employee_attendance.break_in',
            'employee_attendance.time_out',
            'employee_attendance.late',
            'employment_types.employment_type'
        )
        ->join('hrms_db.employee_profiles', 'employee_attendance.dtr_id', '=', 'hrms_db.employee_profiles.dtr_id')
        ->leftjoin('hrms_db.employment_types', 'employee_profiles.employment_type_id', '=', 'employment_types.employment_type_id')
        ->orderBy('employee_attendance.date', 'desc')
        ->orderBy(DB::raw('CAST(employee_attendance.dtr_id AS SIGNED)'), 'asc')
        ->where('hrms_db.employee_profiles.user_id', Session::get('user_id'))
        ->get();

        // Query on the second database connection (mysql)
        $users = DB::connection('mysql')
        ->table('admin_db.users')
        ->select('id', 'first_name', 'middle_name', 'last_name')
        ->get();

        // Merge the data based on user_id
        $attendance = $attendanceData->map(function ($item) use ($users) {
        $user = $users->firstWhere('id', $item->user_id);
        $item->first_name = $user->first_name;
        $item->middle_name = $user->middle_name;
        $item->last_name = $user->last_name;
        return $item;
        });

        // Now $attendanceWithUsers contains the combined data from both databases
        return view('user.user_DTR')->with('attendance', $attendance);

    }
}
