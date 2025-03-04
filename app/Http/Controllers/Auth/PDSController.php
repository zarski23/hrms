<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pds\Addresses;
use App\Models\Pds\Children;
use App\Models\Pds\Family;
use App\Models\Pds\Additional;
use App\Models\Pds\Applicant;
use App\Models\Pds\Civil_service_eligibility;
use App\Models\Pds\education;
use App\Models\Pds\Reference;
use App\Models\Pds\Skills;
use App\Models\Pds\TrainingProgram;
use App\Models\Pds\VolunteerWork;
use App\Models\Pds\WorkExperience;
use App\Models\Pds\PdfFile;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class PDSController extends Controller
{
    
    /** regiter page */
    public function register()
    {
        // $role = DB::table('role_type_users')->get();
        // return view('auth.register',compact('role'));


        return view('auth.pds-register');
    }

    /** insert new users */
    public function storeUser(Request $request)
    {
        // $request->validate([
        //     'name'      => 'required|string|max:255',
        //     'email'     => 'required|string|email|max:255|unique:users',
        //     'role_name' => 'required|string|max:255',
        //     'password'  => 'required|string|min:8|confirmed',
        //     'password_confirmation' => 'required',
        // ]);

        try {
            $dt        = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            
            User::create([
                'name'      => $request->name,
                'avatar'    => $request->image,
                'email'     => $request->email,
                'join_date' => $todayDate,
                'last_login'=> $todayDate,
                'role_name' => $request->role_name,
                'status'    => 'Active',
                'password'  => Hash::make($request->password),
            ]);
            Toastr::success('Create new account successfully :)','Success');
            return redirect('login');
        }catch(\Exception $e) {
            \Log::info($e);
            DB::rollback();
            Toastr::error('Add new employee fail :)','Error');
            return redirect()->back();
        }
    }

    //preview PDS
    public function viewPDS($id) {
    $dt = Carbon::now();
    $todayDate = $dt->toDayDateTimeString();
 
    // $pds = $request->all();
    $pds = Applicant::findOrFail($id);

    return view('auth.pds.view', compact('pds', 'todayDate'));
    }

    //STORING PDS
    public function storePDS(Request $request) 
    {
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $pds = $request->all();
      
      $applicant = Applicant::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'name_extension' => $request->name_extension,
        'date_of_birth' => $request->date_of_birth,
        'place_of_birth' => $request->place_of_birth,
        'sex' => $request->sex,
        'civil_status' => $request->civil_status,
        'citizenship' => $request->citizenship,
        'height_cm' => $request->height_cm,
        'weight_kg' => $request->weight_kg,
        'blood_type' => $request->blood_type,
        'mobile_no' => $request->mobile_no,
        'telephone_no' => $request->telephone_no,
        'email_address' => $request->email_address,
        'gsis_no' => $request->gsis_no,
        'pagibig_no' => $request->pagibig_no,
        'philhealth_no' => $request->philhealth_no,
        'sss_no' => $request->sss_no,
        'tin_no' => $request->tin_no,
        'agency_employee_no' => $request->agency_employee_no,
      ]);

    //   dd($pds);

    //   $request->validate([
    //     'spouse_name' => 'required|string|max:255',
    //     'spouse_occupation' => 'nullable|string|max:255',
    //     'spouse_employer' => 'nullable|string|max:255',
    //     'spouse_business_address' => 'nullable|string|max:255',
    //     'spouse_tel_no' => 'nullable|string||regex:',
    // ]);

      Addresses::create([
            'applicant_id' => $applicant->id,
            'house_no' => $request->res_house_no,
            'street' => $request->res_street,
            'subdivision' => $request->res_subdivision,
            'barangay' => $request->res_barangay,
            'city' => $request->res_city,
            'province' => $request->res_province,
            'zip_code' => $request->res_zip,
            'type' => 'residential',
        ]
      );

      Addresses::create([
        'applicant_id' => $applicant->id,
        'house_no' => $request->perm_house_no,
        'street' => $request->perm_street,
        'subdivision' => $request->perm_subdivision,
        'barangay' => $request->perm_barangay,
        'city' => $request->perm_city,
        'province' => $request->perm_province,
        'zip_code' => $request->perm_zip,
        'type' => 'permanent',
      ]);

      Family::create([
        'applicant_id' => $applicant->id,
        'relation' => 'Spouse',
        'full_name' => $request->spouse_name,
        'occupation' => $request->spouse_occupation,
        'employer' => $request->spouse_employer,
        'business_address' => $request->spouse_business_address,
        'telephone_no' => $request->spouse_tel_no,
    ]);

    Family::create([
        'applicant_id' => $applicant->id,
        'relation' => 'Father',
        'full_name' => $request->father_name,
        'occupation' => $request->father_occupation,
        'employer' => $request->father_employer,
        'business_address' => $request->father_business_address,
        'telephone_no' => $request->father_tel_no,
    ]);

    Family::create([
        'applicant_id' => $applicant->id,
        'relation' => 'Mother',
        'full_name' => $request->mother_name,
        'occupation' => $request->mother_occupation,
        'employer' => $request->mother_employer,
        'business_address' => $request->mother_business_address,
        'telephone_no' => $request->mother_tel_no,
    ]);


    $validatedData = $request->validate([
        'children' => 'required|array|min:1',
        'children.*.fullname' => 'required|string|max:255',
        'children.*.birthdate' => 'required|date',
    ]);

    foreach ($validatedData['children'] as $child) {
        Children::create([
            'applicant_id' => $applicant->id,
            'child_name' => $child['fullname'],
            'child_birthdate' => $child['birthdate'],
        ]);
    }

    education::create([
        'applicant_id' => $applicant->id,
        'level' => 'Elementary',
        'school_name' => $request->elementary_school,
        'year_graduated' => $request->elementary_year_graduated,
        'dates_attended' => $request->elementary_dates_attended,
        'academic_honors' => $request->elementary_honors,
    ]);

    Education::create([
        'applicant_id' => $applicant->id,
        'level' => 'Secondary',
        'school_name' => $request->secondary_school,
        'year_graduated' => $request->secondary_year_graduated,
        'dates_attended' => $request->secondary_dates_attended,
        'academic_honors' => $request->secondary_honors,
    ]);

    if ($request->filled('vocational_school')) {
        Education::create([
            'applicant_id' => $applicant->id,
            'level' => 'Vocational',
            'school_name' => $request->vocational_school,
            'course' => $request->vocational_course,
            'year_graduated' => $request->vocational_year_graduated,
            'units_earned' => $request->vocational_units,
            'dates_attended' => $request->vocational_dates_attended,
            'academic_honors' => $request->vocational_honors,
        ]);
    }

    if ($request->filled('college_school')) {
        Education::create([
            'applicant_id' => $applicant->id,
            'level' => 'College',
            'school_name' => $request->college_school,
            'course' => $request->college_course,
            'year_graduated' => $request->college_year_graduated,
            'units_earned' => $request->college_units,
            'dates_attended' => $request->college_dates_attended,
            'academic_honors' => $request->college_honors,
        ]);
    }

    if ($request->filled('graduate_school')) {
        Education::create([
            'applicant_id' => $applicant->id,
            'level' => 'Graduate',
            'school_name' => $request->graduate_school,
            'course' => $request->graduate_course,
            'year_graduated' => $request->graduate_year_graduated,
            'units_earned' => $request->graduate_units,
            'dates_attended' => $request->graduate_dates_attended,
            'academic_honors' => $request->graduate_honors,
        ]);
    }


        if ($request->has('csc_children')) {
            foreach ($request->input('csc_children') as $csc_child) {
                Civil_service_eligibility::create([
                    'applicant_id' => $applicant->id,
                    'eligibility_type' => $csc_child['eligibility_type'],
                    'rating' => $csc_child['eligibility_rating'],
                    'exam_date' => $csc_child['eligibility_exam_date'],
                    'exam_place' => $csc_child['eligibility_exam_place'],
                    'license_number' => $csc_child['eligibility_license_number'],
                    'validity_date' => $csc_child['eligibility_validity_date'],
                ]);
            }
        }


        if ($request->has('workexp_children')) {
            foreach ($request->input('workexp_children') as $workexp_child) {
                WorkExperience::create([
                    'applicant_id' => $applicant->id,
                    'from_date' => $workexp_child['work_exp_from'],
                    'to_date' => $workexp_child['work_exp_to'],
                    'position' => $workexp_child['work_position'],
                    'agency' => $workexp_child['work_agency'],
                    'salary' => $workexp_child['work_salary'],
                    'salary_grade' => $workexp_child['work_salary_grade'],
                    'status' => $workexp_child['work_status'],
                    'government_service' => $workexp_child['work_gov_service'] === "Yes" ? 1 : 0,
                    // 'government_service' => isset($workexp_child['work_gov_service']) && $workexp_child['work_gov_service'] === "Yes" ? 1 : 0,

                ]);
            }
        }


    if ($request->has('volunteerwork_children')) {
        foreach ($request->input('volunteerwork_children') as $volunteerwork_child) {
            VolunteerWork::create([
                'applicant_id' => $applicant->id,
                'organization_name' => $volunteerwork_child['vol_org'],
                'from_date' => $volunteerwork_child['vol_from'],
                'to_date' => $volunteerwork_child['vol_to'],
                'hours_volunteered' => $volunteerwork_child['vol_hours'],
                'position' => $volunteerwork_child['vol_position'],
            ]);
        }
    }

    if ($request->has('trainingprogram_children')) {
        foreach ($request->input('trainingprogram_children') as $trainingprogram_child) {
            TrainingProgram::create([
                'applicant_id' => $applicant->id,
                'title' => $trainingprogram_child['ld_title'],
                'from_date' => $trainingprogram_child['ld_from'],
                'to_date' => $trainingprogram_child['ld_to'],
                'hours' => $trainingprogram_child['ld_hours'],
                'type' => $trainingprogram_child['ld_type'],
                'sponsor' => $trainingprogram_child['ld_sponsor'],
            ]);
        }
    }

    Skills::create([
        'applicant_id' => $applicant->id,
        'skills_hobbies' => $request->skills_hobbies,
        'distinctions' => $request->distinctions,
        'membership' => $request->membership,
    ]);
    
    Additional::create([
        'applicant_id' => $applicant->id,
        'question_1' => $request->q1,
        'question_2' => $request->q2,
        'question_3' => $request->q3,
    ]);



    foreach ($request->references as $ref) {
        Reference::create([
            'applicant_id' => $applicant->id,
            'reference_name' => $ref['reference_name'],
            'reference_address' => $ref['reference_address'],
            'contact_no' => $ref['contact_no'],
        ]);
    }  
    
    // Validate the uploaded files
    // $request->validate([
    //     'pds_file' => 'required|file|',
    //     'appointment_file' => 'required|file|',
    //     'applicant_id' => 'required|exists:applicants,id',
    // ]);

    // $pds_file_name = $request->pdf_file->extension();
    // $app_file_name = $request->appointment_file->extension();

    // // Store files properly
    // $pdsPath = $request->pds_file->storeAs('uploads/pdfs',  $pds_file_name);
    // $appointmentPath = $request->appointment_file->storeAs('uploads/appointments', $app_file_name);

    // // Remove 'public/' from the path for database storage
    // // $pdsPath = str_replace('public/', '', $pdsPath);
    // // $appointmentPath = str_replace('public/', '', $appointmentPath);

    // // ❗ Debugging: Stop execution and display file paths
    // dd("PDS Path:", $pdsPath, "Appointment Path:", $appointmentPath);

    // // Save in the database
    // PdfFile::create([
    //     'applicant_id' => $applicant->id,
    //     'pdf_file' => $pdsPath,
    //     'appointment_file' => $appointmentPath,
    // ]);

    // return redirect()->route(view('auth.pds.view', compact('pds')));
    // return view('auth.pds.view', compact('pds', 'todayDate'));
    // return view('auth.pds.view', compact('pds'));


    //dd($pds);
    // if ($request->hasFile('pds_file')) {
    //     $file = $request->file('pds_file');

    //     // Check if file is valid
    //     if (!$file->isValid()) {
    //         dd("File is not valid:", $file->getErrorMessage());
    //     }
    // }   

    $request->validate([
        'pds_file' => 'required|file|mimes:pdf|max:2048', // Ensures only PDFs, max size 2MB
        'appointment_file' => 'required|file|mimes:pdf|max:2048',
    ]);


    // Generate unique filenames
    $pdsFileName = 'pds_' . time() . '.' . $request->file('pds_file')->extension();
    $appointmentFileName = 'appointment_' . time() . '.' . $request->file('appointment_file')->extension();

    // Store files in private storage (storage/app/private_pds and storage/app/private_appointments)
    $pdsPath = $request->file('pds_file')->storeAs('private_pds', $pdsFileName);
    $appointmentPath = $request->file('appointment_file')->storeAs('private_appointments', $appointmentFileName);

    // Save in the database
    PdfFile::create([
        'applicant_id' => $applicant->id,
        'pdf_file' => $pdsPath,  // Stored path in 'storage/app/public/uploads/pdfs'
        'appointment_file' => $appointmentPath,
    ]);

    return redirect()->route('preview', ['id' => $pds->$applicant->id]);

    }
}
