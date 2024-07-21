<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSchedule;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftandSchedule extends Controller
{
    public function viewSchedules(){
    
        
        return view('form.shiftscheduling');
    }

    public function updateWorkSchedule(Request $request){
        
        try{
            
            $employeeSchedule = EmployeeSchedule::where('dtr_id', $request->dtr_id)->first();

            if (!$employeeSchedule) {
                // If the record doesn't exist, create a new one
                $employeeSchedule = new EmployeeSchedule();
                $employeeSchedule->dtr_id = $request->dtr_id;
            }
        
            $employeeSchedule->cut_off_date = $request->shift_cut_off;
            $employeeSchedule->schedule_id = $request->shift_type;
        
            $employeeSchedule->save();


            $employeeSchedule = $this->getEmployeeSchedule($request->dtr_id);

            //dd($employeeSchedule);

            Toastr::success('Updated successfully','Success');
            return redirect()->back()->with('employeeSchedule', $employeeSchedule);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Update fail','Error');
            return redirect()->back();
        }
    }

    public function getEmployeeSchedule($dtr_id){
        
        $employeeSchedule = DB::connection('second_db')
        ->table('hrms_db.employee_schedules') 
        ->select(
            'employee_schedules.dtr_id',
            'employee_schedules.schedule_id',
            'employee_schedules.cut_off_date',
            'working_schedules.shift_type',
            'working_schedules.start_day',
            'working_schedules.end_day',
            'working_schedules.start_time',
            'working_schedules.break_out_time',
            'working_schedules.break_in_time',
            'working_schedules.end_time'
        )
        ->join('hrms_db.working_schedules', 'employee_schedules.schedule_id', '=', 'working_schedules.id')
        ->where('employee_schedules.dtr_id', '=', $dtr_id)
        ->get();
       
        return $employeeSchedule;
    }
}
