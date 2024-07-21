<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllerHRForms extends Controller
{
    public  function adminOvertimeForm(){

        return view('form.travel-order-form');
    }

    public  function adminOvertimeFormPrint(){

        return view('form.download-travel-order-form');
    }
}
