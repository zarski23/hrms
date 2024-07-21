<?php

namespace App\Http\Controllers;

use App\Models\app_access;
use App\Models\EmployeeCommunityTax;
use App\Models\EmployeeInformation;
use App\Models\EmployeeSalary;
use App\Models\EmployeeSchedule;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    

    // employee profile with all controller user
    public function profileEmployee($user_id)
    {
        
        $user = User::where('id',$user_id)->first();

        $employeeInformation = (new EmployeeInformation())->setConnection('second_db')->where('user_id',$user_id)->first(); // user information
        

        $employeeProfile = DB::connection('second_db')->table('hrms_db.employee_profiles')
                ->leftJoin('hrms_db.employee_positions', 'employee_profiles.position_id', '=', 'employee_positions.position_id')
                ->leftJoin('hrms_db.employee_departments', 'employee_profiles.department_id', '=', 'employee_departments.department_id')
                ->leftJoin('hrms_db.employment_types', 'employee_profiles.employment_type_id', '=', 'employment_types.employment_type_id')
                ->select('user_id', 'dtr_id','position_name', 'department_name', 'employment_type')
                ->where('user_id',$user_id)
                ->first(); // user employee profile
        
        $employeeSalary = (new EmployeeSalary())->setConnection('second_db')->where('user_id',$user_id)->first(); // get employee salary
        $employeeCommunityTax = (new EmployeeCommunityTax())->setConnection('second_db')->where('user_id',$user_id)->first(); // get employee community tax
        
        
        $employeeSchedule = null; // Initialize to null
        if ($employeeProfile && $employeeProfile->dtr_id !== null) {
            $employeeSchedule = (new ShiftandSchedule)->getEmployeeSchedule($employeeProfile->dtr_id); // user Schedule
        }

        $employeePositions = (new UserManagementController)->getEmployeePositions();
        $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
        $employmentType = (new UserManagementController)->getEmploymentType();
        $workingSchedules = (new WorkingScheduleList)->getWorkingSchedules();
        

        //dd($employeeSchedule);

        return view('form.employeeprofile',compact('user','employeeInformation','employeeProfile', 'employeeSalary','employeeCommunityTax', 'employeePositions', 'employeeDepartment', 'employmentType','employeeSchedule','workingSchedules'));
    }

    
}
