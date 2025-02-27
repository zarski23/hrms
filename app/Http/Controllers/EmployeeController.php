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

        $employeeInformation = (new EmployeeInformation())->where('user_id',$user_id)->first(); // user information
        
        // dd($user, $employeeInformation);

        $employeeProfile = [];
        
        $employeeSalary = [];
        $employeeCommunityTax = [];
        
        
        $employeeSchedule = null; // Initialize to null
        if ($employeeProfile && $employeeProfile->dtr_id !== null) {
            $employeeSchedule = (new ShiftandSchedule)->getEmployeeSchedule($employeeProfile->dtr_id); // user Schedule
        }

        $employeePositions = [];
        $employeeDepartment = [];
        $employmentType = [];
        $workingSchedules = [];
        

        //dd($employeeSchedule);

        return view('users.employeeprofile',compact('user','employeeInformation','employeeProfile', 'employeeSalary','employeeCommunityTax', 'employeePositions', 'employeeDepartment', 'employmentType','employeeSchedule','workingSchedules'));
    }

    
}
