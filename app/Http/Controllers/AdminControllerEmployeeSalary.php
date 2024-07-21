<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalary;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminControllerEmployeeSalary extends Controller
{
    public function adminSaveEmployeeSalary(Request $request){
        
        DB::beginTransaction();

        try {

            $employeeSalary = EmployeeSalary::where('user_id',$request->user_id)->first(); // get employee salary
            //dd($employeeSalary);

            if(!empty($employeeSalary)){
                
                DB::table('employee_salaries')
                ->where('user_id', $request->user_id)
                ->update([
                    'salary_grade' => $request->salary_grade,
                    'daily_salary' => $request->salary_rate,
                    'taxable' => $request->tax,
                ]);
            }else{
               
                $employeeSalary = EmployeeSalary::updateOrCreate(
                    ['user_id' => $request->user_id],
                    [
                        'salary_grade' => $request->salary_grade,
                        'daily_salary' => $request->salary_rate,
                        'taxable' => $request->tax,
                    ]
                );
            }

            // dd($employeeSalary);

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return redirect()->back()->with('employeeSalary', $employeeSalary);
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }
}
