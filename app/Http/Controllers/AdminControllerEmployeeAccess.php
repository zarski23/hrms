<?php

namespace App\Http\Controllers;

use App\Models\app_access;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AdminControllerEmployeeAccess extends Controller
{
    // all employee application access view
    public function accessAllEmployee()
    {
        $users = User::join('app_access', 'users.id', '=', 'app_access.user_id')
        ->join('applications', 'applications.id', '=', 'app_access.app_id')
        ->select('users.id', 'image', 'first_name', 'last_name', 'app_access.app_id', 'application_name', 'app_access.user_role')
        ->get();
        
        $userList = DB::table('users as u')
                    ->select('u.id', 'u.employee_id', 'u.first_name', 'u.middle_name', 'u.last_name')
                    ->leftJoin('app_access as a', 'u.id', '=', 'a.user_id')
                    ->whereNull('a.user_id')
                    ->where('u.id', '!=', 1)
                    ->get();
        
        $applications_lists = DB::table('applications')
                    ->where('id', '!=', 1)
                    ->get();
       
        return view('form.allemployeeaccess',compact('users','userList','applications_lists'));
    }

    // save data employee
    public function saveAccess(Request $request)
    {
        
        $user_id = $request->user; //get the value of user_id


        $request->validate([
            'user'        => 'required|string|max:255',
            'employee_id' => 'required|string|max:255',
        ]);
        $selectedRead = $request->input('read');
       
       

        DB::beginTransaction();
        try{

            for($i=0;$i<count($selectedRead);$i++)
            {
                $index = $selectedRead[$i];
                $role = "user_role" . $index;

                $app_access = [
                    'user_id' => $user_id,
                    'app_id' => $selectedRead[$i],
                    'user_role' => $request->$role,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                DB::table('app_access')->insert($app_access);
            }

            //Input activity Logs
            $dt = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            $activityLog = [
                'user_id' => Session::get('user_id'),
                'app_id' => '1',
                'activities' => 'Add Application Access - ' . $request->fname . ' ' . $request->lname,
                'date_time' => $todayDate,
            ];
            DB::table('activity_logs')->insert($activityLog);

            DB::commit();
            Toastr::success('Added successfully','Success');
            return redirect()->route('all/employee/access');

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }
    }

    // delete employee access record
    public function deleteAccessRecord($user_id)
    {
        
        DB::beginTransaction();
        try{

            app_access::where('user_id',$user_id)->delete();

            DB::commit();
            Toastr::success('Delete record successfully','Success');
            return redirect()->route('all/employee/access');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Delete record fail','Error');
            return redirect()->back();
        }
    }
}
