<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllerOvertime extends Controller
{
    public function adminViewOvertime(){

        return view('admin.admin_overtime');
    }
}
