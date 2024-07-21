<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManual extends Controller
{
    public function viewUserManual(){

        return view('user_manual');
    }
}
