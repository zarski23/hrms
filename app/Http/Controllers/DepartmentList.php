<?php

namespace App\Http\Controllers;

use App\Models\DepartmentList as ModelsDepartmentList;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DepartmentList extends Controller
{
    public function viewDepartments(){
        
        $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
        
        return view('form.departments',compact('employeeDepartment'));
    }

    public function addDepartments(Request $request){
        try{

            $employeeDepartment = ModelsDepartmentList::where('department_name', $request->department)->first();

            if (!$employeeDepartment) {
                // If the record doesn't exist, create a new one
                $lastDepartment = ModelsDepartmentList::orderBy('department_id', 'desc')->first();

                // Extract the numeric part from the department_id
                $lastDepartmentNumber = (int) substr($lastDepartment->department_id, 2);

                // Increment the numeric part
                $newDepartmentNumber = $lastDepartmentNumber + 1;

                // Pad the numeric part with leading zeros
                $newDepartmentNumberPadded = str_pad($newDepartmentNumber, 4, '0', STR_PAD_LEFT);

                // Combine with 'D_' prefix
                $newDepartmentID = 'D_' . $newDepartmentNumberPadded;

                $employeeDepartment = new ModelsDepartmentList();
                $employeeDepartment->department_id = $newDepartmentID;
                $employeeDepartment->department_name = $request->department;
                $employeeDepartment->save();

                Toastr::success('Added successfully','Success');
            } else {
                Toastr::info('Department already exists','Warning');
            }


            $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
            
            return redirect()->back()->with('employeeDepartment', $employeeDepartment);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }

    public function editDepartments(Request $request){
        try{

            $employeeDepartment = ModelsDepartmentList::where('department_name', $request->department)
            ->where('department_id', '!=', $request->department_id) 
            ->first();


            if (!$employeeDepartment) {

                // If the record doesn't exist, update the department name
                $employeeDepartment = ModelsDepartmentList::where('department_id', $request->department_id)->first();
                $employeeDepartment->department_name = $request->department;
                $employeeDepartment->save();

                Toastr::success('Updated successfully','Success');
            } else {
                Toastr::info('Department already exists','Warning');
            }

            $employeeDepartment = (new UserManagementController)->getEmployeeDepartment();
            
            return redirect()->back()->with('employeeDepartment', $employeeDepartment);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }
}
