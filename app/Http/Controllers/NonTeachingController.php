<?php

namespace App\Http\Controllers;

use App\Models\NonTeaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NonTeachingController extends Controller
{
    public function viewNonTeachingApplicants()
    {
        
        $applicantInformation = DB::connection('second_db')->table('applicant_information')->get();
        
        return view('nonteaching.nonteaching_applicant')->with('applicantInformation', $applicantInformation);

    }
}
