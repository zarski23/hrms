<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCommunityTax;
use App\Models\EmployeeInformation;
use App\Models\EmployeePosition;
use App\Models\EmployeeProfile;
use App\Models\EmployeeSalary;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    
    public function index()
    {
        if (Auth::user()->hr_user_role=='Admin' || Auth::user()->hr_user_role=='admin' )
        {
            $result = DB::table('users')->get();

            $result = DB::table('users')
                ->leftJoin('employee_information', 'users.employee_id', '=', 'employee_information.user_id')
                ->leftJoin('employee_profiles', 'users.employee_id', '=', 'employee_profiles.user_id')
                ->leftJoin('employee_positions', 'employee_positions.position_id', '=', 'employee_profiles.position_id')
                ->leftJoin('employee_departments', 'employee_departments.department_id', '=', 'employee_profiles.department_id')
                ->select('users.id', 'employee_id', 'first_name', 'middle_name', 'last_name', 'email_address','image', 'position_name', 'mobile_number','date_hired','hr_user_role','employment_status','department_name')
                ->orderBy('employee_id')
                ->get(); // get all users

            
            return view('usermanagement.user_control',compact('result'));
        }
        else
        {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        
    }


    // Add New Employee addNewUser

    public function addNewUser(Request $request){
        
        DB::beginTransaction();

        try{

            $existing = User::select('*')
                        ->where('first_name', $request->first_name)
                        ->where('middle_name', $request->middle_name)
                        ->where('last_name', $request->last_name)
                        ->first();

            if($existing == null){
    
                $dt = Carbon::now();
                $todayDate = $dt->toFormattedDayDateString();
        
                // Create the user and hash the password using SHA-1
                $user = User::create([
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'image' => $request->image,
                    'hr_user_role' => $request->hr_user_role,
                    'date_hired' => $todayDate,  
                    'password' => sha1($request->password), // Hash the password using SHA-1
                ]); 

                //Input activity Logs
                $dt = Carbon::now();
                $todayDate  = $dt->toDayDateTimeString();
                $activityLog = [
                    'user_id' => Session::get('user_id'),
                    'activities' => 'Add: New Employee: "' . $request->first_name . ' ' . $request->last_name.'"',
                    'date_time' => $todayDate,
                ];
                DB::table('activity_logs')->insert($activityLog);

                DB::commit();
                Toastr::success('Updated successfully !','Success');
            }else{
                Toastr::error('Data Already Existing !','Error');
            }

            // $employmentType = $this->getEmploymentType();
            $result = (new AdminControllerEmployeeProfile)->getAllUser();
            // $employeeDepartment = $this->getEmployeeDepartment();

            $employeeCount = DB::table('users')->where('id', '<>', 1)->count();
            Session::put('employeeCount', $employeeCount);

            
            return view('usermanagement.user_control',compact('result'));

        }catch(\Exception $e){
            DB::rollback();
            // dd($e);
            Toastr::error('Adding failed !','Error');
            return redirect()->back();
        }
    }

    public function resetPassword(Request $request)
    {
        try{

            DB::beginTransaction();
            // Reset the password using SHA-1
            $user = User::where('id', $request->user_id)->update([
                'password' => sha1($request->password), // Hash the password using SHA-1
                'updated_at' => now(),
            ]);

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Update failed !','Error');
            return redirect()->back();
        }
    }


    
    // save profile information
    public function profileInformation(Request $request)
    {
        DB::beginTransaction();

        
        try {
            $username = $request->username;
            $user_id = $request->user_id;

// ------------------ update employee image ------------------------------------ //
            if(!empty($request->upload_picture)){
                if($image = $username.'.'.$request->upload_picture->extension())
                {
                    $image = $username.'.'.$request->upload_picture->extension();  
                    $request->upload_picture->move(public_path('assets/images'), $image);
                }
                else{
                    unset($image);
                }

                $update = [
                    'image' => $image,
                ];
                User::where('username',$request->username)->update($update);

            }
           
            $hr_user_role=Auth()->user()->hr_user_role;

            if($hr_user_role=='admin' || $hr_user_role=='Admin' ){
                
            // ------------------ update employee name ------------------------------------ //
                $information = User::updateOrCreate(['username' => $request->username]);
                $information->first_name         = $request->fname;
                $information->middle_name        = $request->mname;
                $information->last_name          = $request->lname;
                $information->status             = $request->employeeStatus;
                $information->save();

                $user = Auth::User();
                Session::put('name', $user->name); // update session employee name

    
            }

  
            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Update failed !','Error');
            return redirect()->back();
        }
    }

    public function employeeInformationSave(Request $request)
    {
       
        DB::beginTransaction();

        try {

            $employeeInformation = (new UserManagementController)->getEmployeeInformation();
            
            if(!empty($employeeInformation)){
                
                DB::table('employee_information')
                ->where('user_id', $request->user_id)
                ->update([
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'mobile_number' => $request->mobile_number,
                    'address' => $request->address,
                    'birth_date' => $request->birth_date,
                    'marital_status' => $request->marital_status,
                    'tin_number' => $request->tin_number,
                    'philhealth_number' => $request->philhealth_number,
                ]);

                DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'email' => $request->email,
                ]);

            }else{
                
                DB::table('employee_information')->updateOrInsert(
                    ['user_id' => $request->user_id],
                    [
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'mobile_number' => $request->mobile_number,
                        'address' => $request->address,
                        'birth_date' => $request->birth_date,
                        'marital_status' => $request->marital_status,
                        'tin_number' => $request->tin_number,
                        'philhealth_number' => $request->philhealth_number,
                    ]
                );

                DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'email' => $request->email,
                ]);
            }     
           
            $employeeInformation = (new UserManagementController)->getEmployeeInformation();

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->back()->with('employeeInformation', $employeeInformation);
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Update failed !','Error');
            return redirect()->back();
        }


    }


    public function profile()
    {   
        $user_id = Session::get('user_id'); // get user_id session

        $employeeInformation = $this->getEmployeeInformation();
        $employeeProfile = [];
        
        $employeePositions = [];
        $employeeDepartment = [];
        $employmentType = [];
        $employeeSalary = [];
        $employeeCommunityTax = [];

        $employeeSchedule = null;

        $user = User::where('id',$user_id)->first();

        return view('employee_dashboard',compact('employeeInformation','employeeProfile','employeePositions','employeeDepartment','employmentType','user','employeeSchedule','employeeSalary','employeeCommunityTax'));
    }

    public function getEmployeeInformation()
    { 
        
        $user_id = Session::get('user_id'); // get user_id session
        
        $employeeInformation = EmployeeInformation::where('user_id',$user_id)->first(); // user information
        
        return $employeeInformation;
    }

    public function getEmployeeProfile()
    { 
        $user_id = Session::get('user_id'); // get user_id session
        $employeeProfile = DB::connection('second_db')
                ->table('hrms_db.employee_profiles')
                ->leftjoin('hrms_db.employee_positions', 'employee_profiles.position_id', '=', 'employee_positions.position_id')
                ->leftjoin('hrms_db.employee_departments', 'employee_profiles.department_id', '=', 'employee_departments.department_id')
                ->leftjoin('hrms_db.employment_types', 'employee_profiles.employment_type_id', '=', 'employment_types.employment_type_id')
                ->select('user_id', 'position_name', 'department_name', 'employment_type', 'dtr_id')
                ->where('user_id',$user_id)
                ->first(); // user employee profile  

        return $employeeProfile;
    }

    public function getEmployeePositions()
    { 
        $employeePositions = DB::connection('second_db')
                            ->table('hrms_db.employee_positions') 
                            ->select('position_name','position_id')
                            ->get(); // get all employee positions list

        
        return $employeePositions;
    }

    public function getEmployeeDepartment()
    { 
        $employeeDepartment = DB::connection('second_db')
                            ->table('hrms_db.employee_departments') 
                            ->select('department_name','department_id')
                            ->get(); // get all employee department list

        
        return $employeeDepartment;
    }
    // public function getEmploymentType()
    // { 
    //     $employeeDepartment = DB::connection('second_db')
    //                         ->table('hrms_db.employment_types') 
    //                         ->select('employment_type','employment_type_id')
    //                         ->get(); // get all employment Type list

        
    //     return $employeeDepartment;
    // }

    public function getSignatories()
    { 
        $signatories = DB::connection('second_db')
                            ->table('hrms_db.signatories_table') 
                            ->select('id','document_form','signatory_count','complete_name','position')
                            ->get(); // get all signatories list

        
        return $signatories;
    }

    public function getSignatories_DailyWagePayroll()
    { 
        $signatories = DB::connection('second_db')
                            ->table('hrms_db.signatories_table') 
                            ->select('id','document_form','signatory_count','complete_name','position')
                            ->where('document_form','DAILY WAGE PAYROLL')
                            ->get(); // get all signatories list
        return $signatories;
    }




    // DepED System Functions

    public function getCriteriaSPET()
    { 
        $criteria = DB::table('criteria_spet') 
                            ->select('*')
                            ->get(); // get all employee positions list

        return $criteria;
    }



}
