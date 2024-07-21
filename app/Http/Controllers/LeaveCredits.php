<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveCredits extends Controller
{
     public function viewLeaveCredits(){
    
        
        return view('form.leave-credits');
    }
}
