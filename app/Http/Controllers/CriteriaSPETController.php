<?php

namespace App\Http\Controllers;

use App\Models\CriteriaSPET;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CriteriaSPETController extends Controller
{
    public function viewCriteriaSPET(){
        
        $criteria = (new UserManagementController)->getCriteriaSPET();

        $uniqueCriteria = $criteria->pluck('criteria')->unique();

        return view('list.criteria_spet',compact('criteria','uniqueCriteria'));
    }

    public function addCriteria(Request $request){
        try{

            $criteria_form = null;
            $sub_criteria_form = null;
            $points = null;

            if($request->criteria_form != null){
                $criteria_form = $request->criteria_form;
                $points = $request->standard_points;
            }else{
                $criteria_form = $request->criteria_form1;
                $sub_criteria_form = $request->sub_criteria_form1;
                $points = $request->standard_points1;
            }

            $criteria = CriteriaSPET::where('criteria', $criteria_form)
            ->where('sub_criteria', $sub_criteria_form)
            ->where('standard_points', $points)
            ->first();

            if (!$criteria) {
                // If the record doesn't exist, create a new one

                $criteria = new CriteriaSPET();
                $criteria->criteria = $criteria_form;
                $criteria->sub_criteria = $sub_criteria_form;
                $criteria->standard_points = $points;
                $criteria->save();

                Toastr::success('Added successfully','Success');
            } else {
                Toastr::info('Criteria already exists','Warning');
            }


            $criteria = (new UserManagementController)->getCriteriaSPET();
            
            return redirect()->back()->with('criteria', $criteria);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }

}
