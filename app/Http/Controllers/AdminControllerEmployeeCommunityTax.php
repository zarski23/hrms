<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCommunityTax;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminControllerEmployeeCommunityTax extends Controller
{
    public function adminSaveEmployeeCommunityTax(Request $request){
        DB::beginTransaction();

        try {

            $employeeCommunityTax = EmployeeCommunityTax::where('user_id',$request->user_id)->first(); // get employee community tax
            //dd($employeeCommunityTax);

            if(!empty($employeeCommunityTax)){
                
                DB::table('employee_community_taxes')
                ->where('user_id', $request->user_id)
                ->update([
                    'number' => $request->tax_num,
                    'date' => $request->tax_date,
                    'place_issued' => $request->tax_place_issued,
                ]);
            }else{
               
                $employeeCommunityTax = EmployeeCommunityTax::updateOrCreate(
                    ['user_id' => $request->user_id],
                    [
                        'number' => $request->tax_num,
                        'date' => $request->tax_date,
                        'place_issued' => $request->tax_place_issued,
                    ]
                );
            }

            // dd($employeeCommunityTax);

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->back()->with('employeeCommunityTax', $employeeCommunityTax);
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }
}
