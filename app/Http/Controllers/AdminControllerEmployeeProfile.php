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
                
            $result = $this->getAllUser();

            // $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
            // $employmentType = (new UserManagementController)->getEmploymentType();

            return view('usermanagement.user_control',compact('result'));
        
        }catch(\Exception $e){
            // dd($e);
            Toastr::error('Failed to Load Data','Error');
            return redirect()->back();
        }
    }

    public function getAllUser(){
        
        $users = DB::connection('mysql')
                ->table('users')
                ->get();

            $result = DB::table('users')->where('id', '<>', 1)->get();

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
            }else{
                DB::table('employee_information')
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
            dd($e);
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }


    }

    // save profile information
    public function adminSaveEmployeeProfile(Request $request)
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
                    $request->upload_picture->move(public_path(path: 'assets/images'), $image);
                }
                else{
                    unset($image);
                }

                $update = [
                    'image' => $image,
                ];
                User::where('username',$request->username)->update($update);

            }
                
        // ------------------ update employee name ------------------------------------ //
            $information = User::updateOrCreate(['username' => $request->username]);
            $information->first_name         = $request->fname;
            $information->middle_name        = $request->mname;
            $information->last_name          = $request->lname;
            $information->date_hired         = $request->date_hired;
            $information->save();
            

            //Input activity Logs
            // $dt = Carbon::now();
            // $todayDate  = $dt->toDayDateTimeString();
            // $activityLog = [
            //     'user_id' => Session::get('user_id'),
            //     'app_id' => '1',
            //     'activities' => 'Update: Employee Profile: "' . $request->fname . ' ' . $request->lname.'"',
            //     'date_time' => $todayDate,
            // ];
            // DB::table('activity_logs')->insert($activityLog);
            
            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->route('employee/profile', ['user_id' => $user_id]);

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
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
                if($image = $request->username.'.'.$request->images->extension())
                {
                    $image = $request->username.'.'.$request->images->extension();  
                    $request->images->move(public_path('assets/images'), $image);
                }
                else{
                    unset($image);
                }

                $update = [
                    'image' => $image,
                ];
                User::where('username',$request->username)->update($update);

            }

            $information = User::updateOrCreate(['username' => $request->username]);
            $information->first_name         = $request->first_name_edit;
            $information->middle_name        = $request->middle_name_edit;
            $information->last_name          = $request->last_name_edit;
            $information->status             = $request->status_edit;
            $information->hr_user_role       = $request->role_name_edit;
            $information->save();

            
            $employeeInformation = $this->adminGetEmployeeInformation($request->user_id);
            
            
            // Check Edited value to record in Activity Logs
            // $modifiedValue = "";
            // if ($request->old_first_name != $request->first_name_edit) {
            //     $modifiedValue .= 'Firstname: '. $request->old_first_name .' to '.$request->first_name_edit . ', ';
            // }
            // if ($request->old_middle_name != $request->middle_name_edit) {
            //     $modifiedValue .= 'Middlename: '. $request->old_middle_name .' to '.$request->middle_name_edit . ', ';
            // }
            // if ($request->old_last_name != $request->last_name_edit) {
            //     $modifiedValue .= 'Lastname: '. $request->old_last_name .' to '.$request->last_name_edit . ', ';
            // } 
            // if ($request->old_role_name != $request->role_name_edit) {
            //     $modifiedValue .= 'Role: '. $request->old_role_name .' to '.$request->role_name_edit . ', ';
            // }
            // if ($request->old_status != $request->status_edit) {
            //     $modifiedValue .= 'Status: '. $request->old_status .' to '.$request->status_edit . ', ';
            // }
            // if ($request->old_dtr_id != $request->dtr_id_edit) {
            //     $modifiedValue .= 'DTR ID: '. $request->old_dtr_id .' to '.$request->dtr_id_edit;
            // }

            // // Remove trailing comma and space
            // $modifiedValue = rtrim($modifiedValue, ', ');

            // //Input activity Logs
            // $dt = Carbon::now();
            // $todayDate  = $dt->toDayDateTimeString();
            // $activityLog = [
            //     'user_id' => Session::get('user_id'),
            //     'app_id' => '1',
            //     'activities' => 'Modify: '.$request->old_first_name.' '.$request->old_last_name.' : "'.$modifiedValue.'"',
            //     'date_time' => $todayDate,
            // ];
            // DB::table('activity_logs')->insert($activityLog);

            Toastr::success('Updated successfully !','Success');

            $result = $this->getAllUser();
            $employeeDepartment = [];
            $employmentType = [];

            return view('usermanagement.user_control',compact('result','employeeDepartment','employmentType'));

        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }

}
