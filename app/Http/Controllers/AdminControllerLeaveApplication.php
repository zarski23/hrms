<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllerLeaveApplication extends Controller
{
    public function adminViewLeaveApplication(){

        return view('admin.admin_leave_application');
    }
}
