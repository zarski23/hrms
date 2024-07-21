<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCommunityTax;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Profiler\Profile;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $hr_user_role=Auth()->user()->hr_user_role;
            // $role_name = Session::get('role_name');
             

            if($hr_user_role=='employee')
            {

                $user_id = Session::get('user_id'); // get user_id session

                $user = User::where('id',$user_id)->first();
                $employeeInformation = (new UserManagementController)->getEmployeeInformation();
                $employeeProfile = (new UserManagementController)->getEmployeeProfile();
                $employeePositions = (new UserManagementController)->getEmployeePositions();
                $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
                $employmentType = (new UserManagementController)->getEmploymentType();
                $employeeSalary = (new EmployeeSalary())->setConnection('second_db')->where('user_id',$user_id)->first(); // get employee salary
                $employeeCommunityTax = (new EmployeeCommunityTax())->setConnection('second_db')->where('user_id',$user_id)->first(); // get employee community tax

                $employeeSchedule = null; // Initialize to null
                if ($employeeProfile && $employeeProfile->dtr_id !== null) {
                    $employeeSchedule = (new ShiftandSchedule)->getEmployeeSchedule($employeeProfile->dtr_id); // user Schedule
                }
                
                return view('employee_dashboard',compact('user','employeeInformation','employeeProfile','employeePositions','employeeDepartment', 'employmentType','employeeSchedule','employeeSalary','employeeCommunityTax'));
            }
            else if($hr_user_role=='admin')
            {

                $permissions = DB::connection('second_db')
                    ->table('permission_module')
                    ->where('user_id', '=', Session::get('user_id'))
                    ->get();

                // Create an associative array to hold permissions
                $permissionsArray = [];
                foreach ($permissions as $permission) {
                    $permissionsArray[$permission->id_count] = [
                        'add' => $permission->add_action,
                        'view' => $permission->view_action,
                        'update' => $permission->update_action,
                        'delete' => $permission->delete_action,
                        'upload' => $permission->upload_action,
                        'download' => $permission->download_action,
                    ];
                }

                Session::put('permissionsArray', $permissionsArray);

                // dd( $permissionsArray);
                return view('admin.adminhome');
            }
            else
            {
                return redirect()->back();    
            }
        }
    }

    public function post()
    {
        return view("post");
    }
}
