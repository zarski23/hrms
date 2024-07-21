<?php

namespace App\Http\Controllers;

use App\Models\DesignationList as ModelsDesignationList;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DesignationList extends Controller
{
    public function viewDesignations(){
        
        $employeeDesignation = (new UserManagementController)->getEmploymentType();
        
        return view('form.designations',compact('employeeDesignation'));
    }

    public function addDesignations(Request $request){
        try{

            $employeeDesignation = ModelsDesignationList::where('employment_type', $request->designation)->first();

            if (!$employeeDesignation) {
                // If the record doesn't exist, create a new one
                $lastDesignation = ModelsDesignationList::orderBy('employment_type_id', 'desc')->first();

                // Extract the numeric part from the designation_id
                $lastDesignationNumber = (int) substr($lastDesignation->employment_type_id, 3);

                // Increment the numeric part
                $newDesignationNumber = $lastDesignationNumber + 1;

                // Pad the numeric part with leading zeros
                $newDesignationNumberPadded = str_pad($newDesignationNumber, 4, '0', STR_PAD_LEFT);

                // Combine with 'ET_' prefix
                $newDesignationID = 'ET_' . $newDesignationNumberPadded;

                $employeeDesignation = new ModelsDesignationList();
                $employeeDesignation->employment_type_id = $newDesignationID;
                $employeeDesignation->employment_type = $request->designation;
                $employeeDesignation->save();

                Toastr::success('Added successfully','Success');
            } else {
                Toastr::info('Designation already exists','Warning');
            }


            $employeeDesignation = (new UserManagementController)->getEmploymentType();
            
            return redirect()->back()->with('employeeDesignation', $employeeDesignation);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }

    public function editDesignations(Request $request){
        try{

            $employeeDesignation = ModelsDesignationList::where('employment_type', $request->designation)
            ->where('employment_type_id', '!=', $request->designation_id) 
            ->first();


            if (!$employeeDesignation) {

                // If the record doesn't exist, update the designation name
                $employeeDesignation = ModelsDesignationList::where('employment_type_id', $request->designation_id)->first();
                $employeeDesignation->employment_type = $request->designation;
                $employeeDesignation->save();

                Toastr::success('Updated successfully','Success');
            } else {
                Toastr::info('Designation already exists','Warning');
            }

            $employeeDesignation = (new UserManagementController)->getEmploymentType();
            
            return redirect()->back()->with('employeeDesignation', $employeeDesignation);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }
}
