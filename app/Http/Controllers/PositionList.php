<?php

namespace App\Http\Controllers;

use App\Models\PositionList as ModelsPositionList;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PositionList extends Controller
{
    public function viewPositions(){
        
        $employeePositions = (new UserManagementController)->getEmployeePositions();
        
        return view('form.positions',compact('employeePositions'));
    }

    public function addPositions(Request $request){
        try{

            $employeePositions = ModelsPositionList::where('position_name', $request->position)->first();

            if (!$employeePositions) {
                // If the record doesn't exist, create a new one
                $lastPosition = ModelsPositionList::orderBy('position_id', 'desc')->first();

                // Extract the numeric part from the position_id
                $lastPositionNumber = (int) substr($lastPosition->position_id, 2);

                // Increment the numeric part
                $newPositionNumber = $lastPositionNumber + 1;

                // Pad the numeric part with leading zeros
                $newPositionNumberPadded = str_pad($newPositionNumber, 4, '0', STR_PAD_LEFT);

                // Combine with 'P_' prefix
                $newPositionID = 'P_' . $newPositionNumberPadded;

                $employeePositions = new ModelsPositionList();
                $employeePositions->position_id = $newPositionID;
                $employeePositions->position_name = $request->position;
                $employeePositions->save();

                Toastr::success('Added successfully','Success');
            } else {
                Toastr::info('Employee Position already exists','Warning');
            }


            $employeePositions = (new UserManagementController)->getEmployeePositions();
            
            return redirect()->back()->with('employeePositions', $employeePositions);

        }catch(\Exception $e){
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }

    public function editPositions(Request $request){
        try{

            $employeePositions = ModelsPositionList::where('position_name', $request->position)
            ->where('position_id', '!=', $request->position_id) 
            ->first();


            if (!$employeePositions) {

                // If the record doesn't exist, update the position name
                $employeePositions = ModelsPositionList::where('position_id', $request->position_id)->first();
                $employeePositions->position_name = $request->position;
                $employeePositions->save();

                Toastr::success('Updated successfully','Success');
            } else {
                Toastr::info('Employee Position already exists','Warning');
            }

            $employeePositions = (new UserManagementController)->getEmployeePositions();
            
            return redirect()->back()->with('employeePositions', $employeePositions);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }
}
