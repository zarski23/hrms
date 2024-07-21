<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserControllerTravelOrder extends Controller
{
    public function viewTravelOrder(){


        return view('user.user_travelorder');
    }
}
