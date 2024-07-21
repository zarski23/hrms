<?php

namespace App\Http\Controllers;

use App\Models\Signatories as ModelsSignatories;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class Signatories extends Controller
{
    public function viewSignatories(){
        
        $employeeSignatories = (new UserManagementController)->getSignatories();
        
        return view('form.signatories',compact('employeeSignatories'));
    }

    public function addSignatories(Request $request){
        try{

            $employeeSignatories = ModelsSignatories::where('complete_name', $request->complete_name)
            ->where('position', $request->position)
            ->where('document_form', $request->document_form)
            ->where('signatory_count', $request->signatory_count)
            ->first();

            if (!$employeeSignatories) {
                // If the record doesn't exist, create a new one

                $employeeSignatories = new ModelsSignatories();
                $employeeSignatories->complete_name = $request->complete_name;
                $employeeSignatories->position = $request->position;
                $employeeSignatories->document_form = $request->document_form;
                $employeeSignatories->signatory_count = $request->signatory_count;
                $employeeSignatories->save();

                Toastr::success('Added successfully','Success');
            } else {
                Toastr::info('Signatories Information already exists','Warning');
            }


            $employeeSignatories = (new UserManagementController)->getSignatories();
            
            return redirect()->back()->with('employeeSignatories', $employeeSignatories);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }

    public function editSignatories(Request $request){
        try{

            $employeeSignatories = ModelsSignatories::where('complete_name', $request->complete_name)
            ->where('position', $request->position)
            ->where('document_form', $request->document_form)
            ->where('signatory_count', $request->signatory_count)
            ->where('id', '!=', $request->id) 
            ->first();

            

            if (!$employeeSignatories) {

                // If the record doesn't exist, update the position name
                $employeeSignatories = ModelsSignatories::where('id', $request->id)->first();
                $employeeSignatories->complete_name = $request->complete_name;
                $employeeSignatories->position = $request->position;
                $employeeSignatories->document_form = $request->document_form;
                $employeeSignatories->signatory_count = $request->signatory_count;
                $employeeSignatories->save();

                Toastr::success('Updated successfully','Success');
            } else {
                Toastr::info('Signatories Information already exists','Warning');
            }

            $employeeSignatories = (new UserManagementController)->getSignatories();
            
            return redirect()->back()->with('employeeSignatories', $employeeSignatories);

        }catch(\Exception $e){
            dd($e);
            Toastr::error('Failed to Add','Error');
            return redirect()->back();
        }
    }
}
