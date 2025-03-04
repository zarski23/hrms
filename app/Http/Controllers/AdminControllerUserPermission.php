<?php

namespace App\Http\Controllers;

use App\Models\app_access;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AdminControllerUserPermission extends Controller
{
    // all employee user permission view
    public function viewAllPermission()
    {
        // Get distinct user IDs from the second database
        $distinctUserIds = DB::table('permission_module')
        ->distinct()
        ->pluck('user_id')
        ->toArray();

        // Retrieve users with the distinct user IDs
        $users = User::select('id', 'image', 'first_name', 'last_name')
        ->whereIn('id', $distinctUserIds)
        ->get(); 

        // Retrieve users whose IDs are not in the list of distinct user IDs
        $userList = User::select('id', 'username', 'image', 'first_name', 'middle_name', 'last_name')
        ->whereNotIn('id', $distinctUserIds)
        ->where('id', '!=', 1)
        ->get();

        
        $permission_lists = DB::table('permission_lists')->get();

        return view('cards.all-user-permission-card',compact('users','userList','permission_lists'));
    }

    // save data employee
    public function saveUserPermission(Request $request)
    {
        
        $user_id = $request->user; //get the value of user_id

        
        $request->validate([
            'user'        => 'required|string|max:255',
            'username' => 'required|string|max:255',
        ]);
      

        DB::beginTransaction();
        try{

            for ($i = 0; $i < count($request->id_count); $i++) {
                $id = $request->id_count[$i];
                $module_permissions = [
                    'user_id' => $user_id,
                    'id_count' => $id,
                    'add_action' => $request->add[$id] ?? 'N',
                    'view_action' => $request->view[$id] ?? 'N',
                    'update_action' => $request->update[$id] ?? 'N',
                    'delete_action' => $request->delete[$id] ?? 'N',
                    'upload_action' => $request->upload[$id] ?? 'N',
                    'download_action' => $request->download[$id] ?? 'N',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                // dd( $module_permissions, $user_id);
                DB::connection('second_db')->table('permission_module')->insert($module_permissions);
            }
            
            //update HR User Role to Admin
            DB::connection('mysql')->table('users')->where('id', $user_id)->update(['hr_user_role' => 'admin']);

            //Input activity Logs
            // $dt = Carbon::now();
            // $todayDate  = $dt->toDayDateTimeString();
            // $activityLog = [
            //     'user_id' => Session::get('user_id'),
            //     'app_id' => '1',
            //     'activities' => 'Add Application Access - ' . $request->fname . ' ' . $request->lname,
            //     'date_time' => $todayDate,
            // ];
            // DB::table('activity_logs')->insert($activityLog);

            DB::commit();
            Toastr::success('Added successfully','Success');
            return redirect()->route('all/user/permission');

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }
    }

    // delete employee access record
    public function deleteUserPermission($user_id)
    {
        
        DB::beginTransaction();
        try{

            DB::connection('second_db')->table('permission_module')->where('user_id',$user_id)->delete();

            DB::commit();
            Toastr::success('Delete record successfully','Success');
            return redirect()->route('all/user/permission');

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Delete record fail','Error');
            return redirect()->back();
        }
    }
    // view edit record
    public function viewEditUserPermission($username)
    {
        $permissions = DB::connection('second_db')
            ->table('permission_module')
            ->where('user_id','=',$username)
            ->get();

            $combinedPermissions = [];

            foreach ($permissions as $permission) {
                $permissionLists = DB::connection('second_db')
                    ->table('permission_lists')
                    ->select('permission_name')
                    ->where('id', '=', $permission->id_count)
                    ->get();
            
                $combinedPermissions[] = [
                    'permission' => $permission,
                    'permission_lists' => $permissionLists
                ];
            }

        // dd($combinedPermissions);

        $employees = DB::table('users')->select('id','username', 'image', 'first_name', 'last_name')->where('id',$username)->get();
        

        return view('edit.edit-permission',compact('employees','combinedPermissions'));
    }

    // update data employee
    public function updateUserPermission(Request $request)
    {

        $user_id = $request->id; //get the value of user_id
      
        DB::beginTransaction();
        try {
            // dd($request->id_count);
            for ($i = 0; $i < count($request->id_count); $i++) {
                $id = $request->id_count[$i];
                $module_permissions = [
                    'user_id' => $user_id,
                    'id_count' => $id,
                    'add_action' => $request->add[$id] ?? 'N',
                    'view_action' => $request->view[$id] ?? 'N',
                    'update_action' => $request->update[$id] ?? 'N',
                    'delete_action' => $request->delete[$id] ?? 'N',
                    'upload_action' => $request->upload[$id] ?? 'N',
                    'download_action' => $request->download[$id] ?? 'N',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                DB::connection('second_db')->table('permission_module')
                ->where('user_id', $user_id)
                ->where('id_count', $id)
                ->update($module_permissions);
            }
          

            //Input activity Logs
            // $dt = Carbon::now();
            // $todayDate  = $dt->toDayDateTimeString();
            // $activityLog = [
            //     'user_id' => Session::get('user_id'),
            //     'app_id' => '1',
            //     'activities' => 'Add Application Access - ' . $request->fname . ' ' . $request->lname,
            //     'date_time' => $todayDate,
            // ];
            // DB::table('activity_logs')->insert($activityLog);

            DB::commit();
            Toastr::success('Added successfully','Success');
            return $this->viewEditUserPermission($user_id);

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }
    }
}
