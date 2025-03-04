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

            if($hr_user_role=='Super Admin')
            {

                $permissions = DB::table('permission_module')
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
            else if($hr_user_role=='Data Admin')
            {

                $permissions = DB::table('permission_module')
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
            else if($hr_user_role=='Evaluator')
            {

                $permissions = DB::table('permission_module')
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
