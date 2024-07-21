<?php

namespace App\Http\Controllers;

use App\Models\EmployeeInformation;
use App\Models\EmployeeProfile;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class AdminControllerEmployeeProfile extends Controller
{
    public function viewAllEmployee()
    {
        try{

            $result = $this->getAllEmployee();

            $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
            $employmentType = (new UserManagementController)->getEmploymentType();

            return view('usermanagement.user_control',compact('result','employeeDepartment','employmentType'));
        
        }catch(\Exception $e){
            // dd($e);
            Toastr::error('Failed to Load Data','Error');
            return redirect()->back();
        }
    }

    public function getAllEmployee(){
        
        $users = DB::connection('mysql')
                ->table('users')
                ->get();

            $result = [];

            foreach ($users as $user) {

                // Skip the user with ID 1
                if ($user->id == 1) {
                    continue;
                }
                
                $userInformation = DB::connection('second_db')
                    ->table('employee_profiles')
                    ->select(
                        'employee_profiles.user_id',
                        'employee_profiles.dtr_id',
                        'employee_positions.position_name',
                        'employee_information.mobile_number',
                        'employee_departments.department_name',
                        'employment_types.employment_type'
                    )
                    ->leftJoin('employee_information', 'employee_information.user_id', '=', 'employee_profiles.user_id')
                    ->leftJoin('employee_positions', 'employee_positions.position_id', '=', 'employee_profiles.position_id')
                    ->leftJoin('employee_departments', 'employee_departments.department_id', '=', 'employee_profiles.department_id')
                    ->leftJoin('employment_types', 'employment_types.employment_type_id', '=', 'employee_profiles.employment_type_id')
                    ->where('employee_profiles.user_id', '=', $user->id) 
                    ->orderBy('employee_profiles.user_id')
                    ->get();

                $result[] = [
                    'user' => $user,
                    'userInformation' => $userInformation,
                ];
            }

        return $result;
    }

    public function adminSaveEmployeeInformation(Request $request)
    {

        DB::beginTransaction();

        try {
            
            if(!empty($request->email_address)){
                DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'email' => $request->email_address,
                ]);
            }

            $employeeInformation = $this->adminGetEmployeeInformation($request->user_id);
            
            if(!empty($employeeInformation)){
                
                DB::connection('second_db')
                ->table('hrms_db.employee_information')
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
            }else{
                DB::connection('second_db')
                ->table('hrms_db.employee_information')
                ->insert([
                    'user_id' => $request->user_id,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'mobile_number' => $request->mobile_number,
                    'address' => $request->address,
                    'birth_date' => $request->birth_date,
                    'marital_status' => $request->marital_status,
                    'tin_number' => $request->tin_number,
                    'philhealth_number' => $request->philhealth_number,
                ]);
            }

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->route('employee/profile', ['user_id' => $request->user_id]);
        }catch(\Exception $e){
            DB::rollback();
            // dd("ERROR");
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }


    }

    // save profile information
    public function adminSaveEmployeeProfile(Request $request)
    {

        $request->validate([
            'employee_position' => 'required|string',
        ]);

        DB::beginTransaction();

        
        try {
            $employee_id = $request->employee_id;
            $user_id = $request->user_id;

// ------------------ update employee image ------------------------------------ //
            if(!empty($request->upload_picture)){
                if($image = $employee_id.'.'.$request->upload_picture->extension())
                {
                    $image = $employee_id.'.'.$request->upload_picture->extension();  
                    $request->upload_picture->move(public_path('assets/images'), $image);
                }
                else{
                    unset($image);
                }

                $update = [
                    'image' => $image,
                ];
                User::where('employee_id',$request->employee_id)->update($update);

            }
            

                
        // ------------------ update employee name ------------------------------------ //
            $information = User::updateOrCreate(['employee_id' => $request->employee_id]);
            $information->first_name         = $request->fname;
            $information->middle_name        = $request->mname;
            $information->last_name          = $request->lname;
            $information->status             = $request->employeeStatus;
            $information->hr_user_role       = $request->employeeRole;
            $information->save();

                
            
        // ------------------ update employee profile ------------------------------------ //

                
            $employeePositionsID = DB::connection('second_db')
                                ->table('hrms_db.employee_positions') 
                                ->select('position_id')
                                ->where('position_name',$request->employee_position)
                                ->first(); // get employee position ID

            $employeeDepartmentID = DB::connection('second_db')
                                ->table('hrms_db.employee_departments') 
                                ->select('department_id')
                                ->where('department_name',$request->employee_department)
                                ->first(); // get employee department ID
                                    
            $employmentTypeID = DB::connection('second_db')
                                ->table('hrms_db.employment_types') 
                                ->select('employment_type_id')
                                ->where('employment_type',$request->employmentType)
                                ->first(); // get employee employment type ID
            
            
            $employeeProfile = EmployeeProfile::where('user_id',$user_id)->first();
            
            if(!empty($employeeProfile)){
                
                DB::connection('second_db')
                    ->table('hrms_db.employee_profiles')
                    ->where('user_id', $user_id)
                    ->update([
                    'dtr_id' => $request->dtr_id,
                    'position_id' => $employeePositionsID->position_id,
                    'department_id' => $employeeDepartmentID->department_id,
                    'employment_type_id' => $employmentTypeID->employment_type_id,
                ]);
            
            }else{
                
                DB::connection('second_db')->table('employee_information')->updateOrCreate(
                    ['user_id' => $request->user_id],
                    [
                    'dtr_id' => $request->dtr_id,
                    'position_id' => $employeePositionsID->position_id,
                    'department_id' => $employeeDepartmentID->department_id,
                    'employment_type_id' => $employmentTypeID->employment_type_id,
                    ]
                );

            }     

            //Input activity Logs
            $dt = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $activityLog = [
                'user_id' => Session::get('user_id'),
                'app_id' => '1',
                'activities' => 'Update: Employee Profile: "' . $request->fname . ' ' . $request->lname.'"',
                'date_time' => $todayDate,
            ];
            DB::table('activity_logs')->insert($activityLog);
            
            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->route('employee/profile', ['user_id' => $user_id]);

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            dd("Validation Required : ",$e);
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }

    public function adminGetEmployeeInformation($user_id) //with passing value of employee ID
    {
        try{
            $employeeInformation = EmployeeInformation::where('user_id',$user_id)->first(); // user information

            return $employeeInformation;
        } catch(\Exception $e){

            return redirect()->back();
        }
    }

    public function adminEditEmployeeProfile(Request $request){

        try{
            
            if(!empty($request->images)){
                if($image = $request->employee_id.'.'.$request->images->extension())
                {
                    $image = $request->employee_id.'.'.$request->images->extension();  
                    $request->images->move(public_path('assets/images'), $image);
                }
                else{
                    unset($image);
                }

                $update = [
                    'image' => $image,
                ];
                User::where('employee_id',$request->employee_id)->update($update);

            }

            $information = User::updateOrCreate(['employee_id' => $request->employee_id]);
            $information->first_name         = $request->first_name_edit;
            $information->middle_name        = $request->middle_name_edit;
            $information->last_name          = $request->last_name_edit;
            $information->status             = $request->status_edit;
            $information->hr_user_role       = $request->role_name_edit;
            $information->save();

            $employeeDepartmentID = DB::connection('second_db')->table('hrms_db.employee_departments') 
                                ->select('department_id')
                                ->where('department_name',$request->department_edit)
                                ->first(); // get employee department ID

            $employmentID = DB::connection('second_db')->table('hrms_db.employment_types') 
            ->select('employment_type_id')
            ->where('employment_type',$request->employment_edit)
            ->first(); // get employment ID
            

            $employeeProfile = EmployeeProfile::where('user_id',$request->user_id)->first();

            
            if(!empty($employeeProfile)){
                DB::connection('second_db')->table('hrms_db.employee_profiles')
                    ->where('user_id', $request->user_id)
                    ->update([
                    'dtr_id' => $request->dtr_id_edit,
                    'department_id' => $employeeDepartmentID->department_id,
                    'employment_type_id' => $employmentID->employment_type_id,
                ]);
            }else{
                EmployeeProfile::updateOrCreate(
                    ['user_id' => $request->user_id],
                    [
                    'dtr_id' => $request->dtr_id_edit,
                    'department_id' => $employeeDepartmentID->department_id,
                    'employment_type_id' => $employmentID->employment_type_id,
                    ]
                );
            }
            $employeeInformation = $this->adminGetEmployeeInformation($request->user_id);
            
            // if(!empty($employeeInformation)){
                
            //     DB::connection('second_db')->table('hrms_db.employee_information')
            //     ->where('user_id', $request->user_id)
            //     ->update([
            //         'mobile_number' => $request->phone_number_edit,
            //     ]);
            // }else{
               
            //     $employeeInformation = EmployeeInformation::updateOrCreate(
            //         ['user_id' => $request->user_id],
            //         ['mobile_number' => $request->phone_number_edit]
            //     );
            // }
            
            // Check Edited value to record in Activity Logs
            $modifiedValue = "";
            if ($request->old_first_name != $request->first_name_edit) {
                $modifiedValue .= 'Firstname: '. $request->old_first_name .' to '.$request->first_name_edit . ', ';
            }
            if ($request->old_middle_name != $request->middle_name_edit) {
                $modifiedValue .= 'Middlename: '. $request->old_middle_name .' to '.$request->middle_name_edit . ', ';
            }
            if ($request->old_last_name != $request->last_name_edit) {
                $modifiedValue .= 'Lastname: '. $request->old_last_name .' to '.$request->last_name_edit . ', ';
            }     
            // if ($request->old_email != $request->email_edit) {
            //     $modifiedValue .= 'Email: '. $request->old_email .' to '.$request->email_edit . ', ';
            // }
            // if ($request->old_phone != $request->phone_number_edit) {
            //     $modifiedValue .= 'Phone number: '. $request->old_phone .' to '.$request->phone_number_edit . ', ';
            // }
            if ($request->old_department != $request->department_edit) {
                $modifiedValue .= 'Department: '. $request->old_department .' to '.$request->department_edit . ', ';
            }
            if ($request->old_employment != $request->employment_edit) {
                $modifiedValue .= 'Employment: '. $request->old_employment .' to '.$request->employment_edit . ', ';
            }
            if ($request->old_role_name != $request->role_name_edit) {
                $modifiedValue .= 'Role: '. $request->old_role_name .' to '.$request->role_name_edit . ', ';
            }
            if ($request->old_status != $request->status_edit) {
                $modifiedValue .= 'Status: '. $request->old_status .' to '.$request->status_edit . ', ';
            }
            if ($request->old_dtr_id != $request->dtr_id_edit) {
                $modifiedValue .= 'DTR ID: '. $request->old_dtr_id .' to '.$request->dtr_id_edit;
            }

            // Remove trailing comma and space
            $modifiedValue = rtrim($modifiedValue, ', ');

            //Input activity Logs
            $dt = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $activityLog = [
                'user_id' => Session::get('user_id'),
                'app_id' => '1',
                'activities' => 'Modify: '.$request->old_first_name.' '.$request->old_last_name.' : "'.$modifiedValue.'"',
                'date_time' => $todayDate,
            ];
            DB::table('activity_logs')->insert($activityLog);

            Toastr::success('Updated successfully !','Success');

            $result = $this->getAllEmployee();
            $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
            $employmentType = (new UserManagementController)->getEmploymentType();

            return view('usermanagement.user_control',compact('result','employeeDepartment','employmentType'));

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Update fail !','Error');
            return response()->json(['error' => 'Update fail !'], 422);
        }
    }

}
