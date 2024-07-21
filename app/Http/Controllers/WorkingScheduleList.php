<?php

namespace App\Http\Controllers;

use App\Models\WorkingSchedule;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkingScheduleList extends Controller
{

    public function viewWorkingSchedules(){
        
        $workingSchedules = $this->getWorkingSchedules();
    
        return view('form.working-schedule',compact('workingSchedules'));
    }


    public function addWorkScheduleList(Request $request){
        
        try{

            $workingSchedule = WorkingSchedule::where([
                ['shift_type', $request->shift_type],
                ['start_day', $request->start_day],
                ['end_day', $request->end_day],
                ['start_time', $request->start_time],
                ['break_out_time', $request->break_out_time],
                ['break_in_time', $request->break_in_time],
                ['end_time', $request->end_time]
            ])->first();

            if (!$workingSchedule) {
                // If the record doesn't exist, create a new one
                $workingSchedule = new WorkingSchedule();
                $workingSchedule->shift_type = $request->shift_type;
                $workingSchedule->start_day = $request->start_day;
                $workingSchedule->end_day = $request->end_day;
                $workingSchedule->start_time = $request->start_time;
                $workingSchedule->break_out_time = $request->break_out_time;
                $workingSchedule->break_in_time = $request->break_in_time;
                $workingSchedule->end_time = $request->end_time;
                $workingSchedule->save();

                Toastr::success('Added successfully','Success');
                
            }else{
                Toastr::info('Working Schedule already exists','Warning');
            }

            $workingSchedules = $this->getWorkingSchedules();
            
            return redirect()->back()->with('employeeSchedule', $workingSchedules);

        }catch(\Exception $e){
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }

    public function getWorkingSchedules(){

        $workingSchedules = DB::connection('second_db')
                            ->table('hrms_db.working_schedules')
                            ->get(); // get all work schedules list

        return $workingSchedules;
    }

    
}
