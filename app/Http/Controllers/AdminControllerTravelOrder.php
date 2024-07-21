<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllerTravelOrder extends Controller
{
    public function adminViewTravelOrder(){

        return view('admin.admin_travel_order');
    }
}
