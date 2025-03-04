<?php

namespace App\Http\Controllers;

use App\Models\ApplicantApplication;
use App\Models\ApplicantEducation;
use App\Models\ApplicantExperience;
use App\Models\ApplicantInformation;
use App\Models\ApplicantRatingsSpet;
use App\Models\ApplicantTraining;
use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class ElementaryApplicantController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    
    public function viewElementaryApplicants()
    {

        session(['withTotalRating' => false]);
        session(['ViewPage' => 'viewElementaryApplicants']);
        $action = session('action');
        
        if(empty($action)){
            session(['action' => 'Add Score']);
        }


            $applicantInformation = DB::connection('second_db')
                ->table('applicant_information')
                ->leftJoin('application', 'applicant_information.application_code', '=', 'application.application_code')
                ->select(
                    'applicant_information.*',
                    'application.*'
                )
                ->get();

            if(session('hr_user_role') == 'Evaluator'){
                // First query: Get the criteria IDs from evaluator_table for user 32 with permission 1
                $evaluatorCriteriaIds = DB::connection('mysql')
                ->table('evaluator_table')
                ->where('user_id', session('user_id'))
                ->where('permission', 1)
                ->pluck('criteria_id');

                // Second query: Get all application codes and criteria IDs from applicant_ratings_spet
                // and filter out the entire application_code if any criteria_id matches the evaluator's criteria
                $applicantRatings = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->whereIn('criteria_id', $evaluatorCriteriaIds)  // Match evaluator_table.criteria_id with applicant_ratings_spet.criteria_id
                ->wherenotNull('criteria_points')                   // Only get records where criteria_points is NULL
                ->select('application_code', 'criteria_id', 'criteria_points')
                ->get();
            }

            // Get application_codes where at least one criteria_points is NULL and sum up non-null criteria_points
            $applicationCodesWithNull = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->select(
                    'application_code',
                    DB::raw('SUM(CASE WHEN criteria_points IS NOT NULL THEN criteria_points ELSE 0 END) as total_criteria_points')
                )
                ->groupBy('application_code')
                ->havingRaw('SUM(CASE WHEN criteria_points IS NULL THEN 1 ELSE 0 END) > 0') // Ensure at least one NULL value exists
                ->get()
                ->keyBy('application_code'); // Key by application_code for easy lookup

            // Sum of criteria_points for application_codes where all values are not NULL           
            $criteriaPointsSum = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->select(
                    'application_code',
                    DB::raw('SUM(criteria_points) as total_criteria_points')
                )
                ->whereNotNull('criteria_points')
                ->whereNotIn('application_code', $applicationCodesWithNull->keys()) // Exclude codes with NULL criteria_points
                ->groupBy('application_code')
                ->get()
                ->keyBy('application_code'); // Key by application_code for easy lookup

            // Filter out records from applicantInformation that exist in criteriaPointsSum
            $filteredApplicantInformation = $applicantInformation->filter(function ($applicant) use ($criteriaPointsSum) {
                // Keep only those that do not exist in criteriaPointsSum
                return !$criteriaPointsSum->has($applicant->application_code);
            });

            if(session('hr_user_role') == 'Evaluator'){
                // Fetch the application codes from $applicantRatings to filter out
                $applicationCodesToRemove = $applicantRatings->pluck('application_code')->toArray();

                // Modify the $applicantInformationWithPoints map to exclude records with matching application_code
                $applicantInformationWithPoints = $filteredApplicantInformation->reject(function ($applicant) use ($applicationCodesToRemove, $applicationCodesWithNull) {
                    // Check if the application_code exists in $applicationCodesToRemove
                    if (in_array($applicant->application_code, $applicationCodesToRemove)) {
                        return true; // Remove this record if application_code matches
                    }
                    
                    // Find the total criteria points for this applicant's application_code
                    $totalPoints = $applicationCodesWithNull->get($applicant->application_code)->total_criteria_points ?? 0;
                    
                    // Add the total_criteria_points to the applicant's data
                    $applicant->total_criteria_points = $totalPoints;
                    
                    return false; // Keep this record if application_code doesn't match
                });
            }
            else{
                // Combine the remaining applicant information with applicationCodesWithNull
                $applicantInformationWithPoints = $filteredApplicantInformation->map(function ($applicant) use ($applicationCodesWithNull) {
                    // Find the total criteria points for this applicant's application_code
                    $totalPoints = $applicationCodesWithNull->get($applicant->application_code)->total_criteria_points ?? 0;
                    
                    // Add the total_criteria_points to the applicant's data
                    $applicant->total_criteria_points = $totalPoints;
                    
                    return $applicant;
                });
            }
                
        return view('teaching.elementary_applicant', compact('applicantInformationWithPoints'));

    }

    
    public function viewElementaryApplicantsDoneAssessment()
    {
        session(['ViewPage' => 'viewElementaryApplicantsDoneAssessment']);
        session(['withTotalRating' => true]);
        $action = session('action');
        $applicantInformationWithPoints = [];
        
        if($action == null){
            $action = "Add Score";
        }

        // dd($applicationCodesWithNull, $criteriaPointsSum);
        if(session('hr_user_role') == 'Evaluator'){
            // First query: Get the criteria IDs from evaluator_table for user 32 with permission 1
            $evaluatorCriteriaIds = DB::connection('mysql')
                ->table('evaluator_table')
                ->where('user_id', session('user_id'))
                ->where('permission', 1)
                ->pluck('criteria_id');

            // Second query: Get all application codes and criteria IDs from applicant_ratings_spet
            // and filter out the entire application_code if any criteria_id matches the evaluator's criteria
            $applicantRatings = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->whereIn('criteria_id', $evaluatorCriteriaIds)  // Match evaluator_table.criteria_id with applicant_ratings_spet.criteria_id
                ->wherenotNull('criteria_points')                   // Only get records where criteria_points is NULL
                ->select('application_code', 'criteria_id', 'criteria_points')
                ->get();

            // Extract application codes into an array
            $applicationCodes = $applicantRatings->pluck('application_code');

            $applicantInformation = DB::connection('second_db')
                ->table('applicant_information')
                ->leftJoin('application', 'applicant_information.application_code', '=', 'application.application_code')
                ->whereIn('applicant_information.application_code', $applicationCodes)
                ->select('applicant_information.*', 'application.*')
                ->get();

            // Get application_codes and sum up all criteria_points (treating NULL as 0)
            $applicationCodesWithSum = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->select(
                    'application_code',
                    DB::raw('SUM(IFNULL(criteria_points, 0)) as total_criteria_points')
                )
                ->groupBy('application_code')
                ->get()
                ->keyBy('application_code'); // Key by application_code for easy lookup

            // Filter and combine applicant information with points
            $applicantInformationWithPoints = $applicantInformation->filter(function ($applicant) use ($applicationCodesWithSum) {
                // Check if application_code exists in summed criteria points
                return $applicationCodesWithSum->has($applicant->application_code);
            })->map(function ($applicant) use ($applicationCodesWithSum) {
                // Add total_criteria_points to the applicant object
                $applicant->total_criteria_points = $applicationCodesWithSum[$applicant->application_code]->total_criteria_points ?? 0;
                return $applicant;
            });

        }else{
            $applicantInformation = DB::connection('second_db')
            ->table('applicant_information')
            ->leftJoin('application', 'applicant_information.application_code', '=', 'application.application_code')
            ->select(
                'applicant_information.*',
                'application.*'
            )
            ->get();

            // Get application_codes where at least one criteria_points is NULL and sum up non-null criteria_points
            $applicationCodesWithNull = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->select(
                    'application_code',
                    DB::raw('SUM(CASE WHEN criteria_points IS NOT NULL THEN criteria_points ELSE 0 END) as total_criteria_points')
                )
                ->groupBy('application_code')
                ->havingRaw('SUM(CASE WHEN criteria_points IS NULL THEN 1 ELSE 0 END) > 0') // Ensure at least one NULL value exists
                ->get()
                ->keyBy('application_code'); // Key by application_code for easy lookup

            // Sum of criteria_points for application_codes where all values are not NULL
            $criteriaPointsSum = DB::connection('second_db')
                ->table('applicant_ratings_spet')
                ->select(
                    'application_code',
                    DB::raw('SUM(criteria_points) as total_criteria_points')
                )
                ->whereNotNull('criteria_points')
                ->whereNotIn('application_code', $applicationCodesWithNull->keys()) // Exclude codes with NULL criteria_points
                ->groupBy('application_code')
                ->get()
                ->keyBy('application_code'); // Key by application_code for easy lookup

            // Combine only the data in applicantInformation and criteriaPointsSum
            $applicantInformationWithPoints = $applicantInformation->filter(function ($applicant) use ($criteriaPointsSum) {
                // Keep only those records where application_code exists in criteriaPointsSum
                return $criteriaPointsSum->has($applicant->application_code);
            })->map(function ($applicant) use ($criteriaPointsSum) {
                // Find the total criteria points for this applicant's application_code
                $totalPoints = $criteriaPointsSum->get($applicant->application_code)->total_criteria_points ?? 0;
                
                // Add the total_criteria_points to the applicant's data
                $applicant->total_criteria_points = $totalPoints;
                
                return $applicant;
            });
        }

        return view('teaching.elementary_applicant', compact('applicantInformationWithPoints'));

    }

    public function updateApplicantInfoScore(Request $request, $application_code)
    {
        $action = $request->query('action'); // Get the action parameter from the query string

        session(['action' => $action]);

        $applicant = DB::connection('second_db')
            ->table('applicant_information')
            ->leftJoin('application', 'applicant_information.application_code', '=', 'application.application_code')
            ->select(
                'applicant_information.id as applicant_id',
                'applicant_information.application_code as applicant_code',
                'applicant_information.*',
                'application.*'
            )
            ->where('applicant_information.application_code', $application_code)
            ->first();

        $applicantEducation = DB::connection('second_db')
            ->table('applicant_education')
            ->where('application_code', $application_code)
            ->get();

        $applicantExperience = DB::connection('second_db')
            ->table('applicant_experience')
            ->where('application_code', $application_code)
            ->get();

        $applicantTraining = DB::connection('second_db')
            ->table('applicant_training')
            ->where('application_code', $application_code)
            ->get();

        $applicantRating = DB::connection('second_db')
            ->table('applicant_ratings_spet')
            ->select('*')
            ->where('application_code', $application_code)
            ->get();

        if(Session::get('hr_user_role') == "Super Admin"){
            $criteriaPermissionWithoutRating = DB::table('criteria_spet')
            ->select('*')
            ->orderBy('criteria_spet.id') // Sorting by criteria_id
            ->get()
            ->map(function($item) {
                $item->permission = 1;  // Set permission to 1
                $item->name = null;      // Set name to null
                return $item;
            });

            // $criteria = DB::connection('second_db')
            // ->table('applicant_ratings_spet')
            // ->select('*')
            // ->where('application_code', $application_code)
            // ->get();

        }else{
            // $criteria = DB::table('evaluator_table')
            // ->join('criteria_spet', 'criteria_spet.id', '=', 'evaluator_table.criteria_id')
            // ->join('users', 'users.id', '=', 'evaluator_table.user_id')
            // ->select(
            //     'criteria_spet.id as id',
            //     'users.first_name',
            //     'users.middle_name',
            //     'users.last_name',
            //     'criteria_spet.criteria',
            //     'criteria_spet.sub_criteria',
            //     'criteria_spet.standard_points',
            //     'evaluator_table.permission',  
            //     DB::raw("
            //         CONCAT(
            //             LEFT(IFNULL(users.first_name, ''), 1),
            //             LEFT(IFNULL(users.middle_name, ''), 1),
            //             LEFT(IFNULL(users.last_name, ''), 1)
            //         ) AS name
            //     ")
            // )
            // ->where('evaluator_table.user_id', Session::get('user_id'))
            // ->orderBy('criteria_spet.id') // Sorting by criteria_id
            // ->get();

            $criteria = DB::table('applicant_ratings_spet')
                ->where('application_code', $application_code)
                ->get();

            
        }

        // Combine the data
        $applicantRatingswithUserPermission  = $applicantRating->map(function ($rating) use ($criteriaPermissionWithoutRating) {
            // Find the corresponding criteria based on criteria_id
            $criteria = $criteriaPermissionWithoutRating->firstWhere('id', $rating->criteria_id);

            // If a matching criteria is found, combine the data
            if ($criteria) {
                return (object) array_merge((array) $rating, (array) $criteria);
            }

            return $rating; // Return the rating as is if no matching criteria found
        });

        // dd($applicantRating, $criteriaPermissionWithoutRating, $applicantRatingswithUserPermission );


       // Combine the data based on criteria_id
        $combinedData = $criteriaPermissionWithoutRating->map(function($criterion) use ($applicantRating) {
            // Find the corresponding rating
            $rating = $applicantRating->firstWhere('criteria_id', $criterion->id);

            if ($rating) {
                // If matching rating exists, add its details
                $criterion->applicant_ratings_spet_id = $rating->applicant_ratings_spet_id;
                $criterion->criteria_details = $rating->criteria_details;
                $criterion->criteria_increment = $rating->criteria_increment;
                $criterion->criteria_points = $rating->criteria_points;
                $criterion->remarks = $rating->remarks;
            } else {
                // If no matching rating, set details to null
                $criterion->applicant_ratings_spet_id = null;
                $criterion->criteria_details = null;
                $criterion->criteria_increment = null;
                $criterion->criteria_points = null;
                $criterion->remarks = null;
            }

            return $criterion;
        });

        // Calculate total points
        $totalPoints = $combinedData->sum(function($criterion) {
            return $criterion->criteria_points ?? 0;
        });

        // Optional: Convert the combined data to an array or collection as needed
        $combinedData = $combinedData->toArray();

        
        // Check if $criteria is empty
        if ($criteriaPermissionWithoutRating->isEmpty()) {
            $criteriaPermissionWithoutRating = 0; // Assign 0 if the result is an empty collection
        }

        dd();
        // dd($criteria,$applicant, $applicantEducation, $applicantExperience, $applicantTraining);


        
        return view('teaching.applicant_info', compact('applicant','applicantEducation','applicantExperience','applicantTraining','action','combinedData','totalPoints','criteriaPermissionWithoutRating','applicantRatingswithUserPermission'));

    }


    public function uploadElementaryApplicants(Request $request)
    {
        try {
            
            Excel::import(new ExcelUploadNewApplicant(),$request->file);
        
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 2006) {
                // MySQL server has gone away, handle gracefully
                Toastr::info('Database connection lost. Please try again.','Error');
                return back()->with('error', 'Database connection lost. Please try again.');
            } else {
                // Handle other database related errors
                Toastr::info('Database error: ' . $e->getMessage(),'Error');
                return back()->with('error', 'Database error: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('elementary/applicants');
    }

    public function updateApplicantInformation(Request $request){
        try{

            // Applicant Information
            ApplicantInformation::updateOrCreate(['id' => $request->applicant_id], [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'extension_name' => $request->extension_name,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status,
                'date_of_birth' => $request->date_of_birth,
                'age' => $request->age,
                'place_of_birth' => $request->place_of_birth,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality,
                'province' => $request->province,
                'religion' => $request->religion,
                'eligibility' => $request->eligibility,
                'disability' => $request->disability,
                'ethnic_group' => $request->ethnic_group,
                'beneficiary_4ps' => $request->beneficiary_4ps,
                'status' => $request->status,
            ]);

            // Application
            ApplicantApplication::updateOrCreate(['id' => $request->application_id], [
                'application_code' => $request->application_code,
                'application_title' => $request->application_title,
                'school_name' => $request->school_name,
                'school_barangay' => $request->school_barangay,
                'school_municipality' => $request->school_municipality,
            ]);

            // Education
            $educationIds = $request->input('education_id'); 
            $baccalaureates = $request->input('education_baccalaureate');
            $specializations = $request->input('education_specialization'); 
            $awards = $request->input('education_awards'); 
            $post_grads = $request->input('education_post_grad'); 

            foreach ($educationIds as $index => $id) {
                $degree = stripslashes($baccalaureates[$index] ?? ''); 
                $specialization = stripslashes($specializations[$index] ?? '');
                $award = stripslashes($awards[$index] ?? '');
                $post_grad = stripslashes($post_grads[$index] ?? '');

                ApplicantEducation::updateOrCreate(['id' => $id], [
                    'application_code' => $request->application_code,
                    'baccalaureate' => $degree,
                    'specialization' => $specialization,
                    'awards' => $award,
                    'post_grad' => $post_grad,
                ]);
            }

            // Training
            $trainingIds = $request->input('training_id'); 
            $titles = $request->input('training_title');
            $hours = $request->input('training_hours');
            $remarks = $request->input('training_remarks'); 

            foreach ($trainingIds as $index => $id) {
                $title = stripslashes($titles[$index] ?? ''); 
                $hour = stripslashes($hours[$index] ?? '');
                $remark = stripslashes($remarks[$index] ?? '');

                ApplicantTraining::updateOrCreate(['id' => $id], [
                    'application_code' => $request->application_code,
                    'title' => $title,
                    'hours' => $hour,
                    'remarks' => $remark,
                ]);
            }

            // Experience
            $experienceIds = $request->input('experience_id'); 
            $details = $request->input('experience_details');
            $years = $request->input('experience_years'); 
            $remarks = $request->input('experience_remarks'); 

            foreach ($experienceIds as $index => $id) {
                $detail = stripslashes($details[$index] ?? ''); 
                $year = stripslashes($years[$index] ?? '');
                $remark = stripslashes($remarks[$index] ?? '');

                ApplicantExperience::updateOrCreate(['id' => $id], [
                    'application_code' => $request->application_code,
                    'details' => $detail,
                    'years' => $year,
                    'remarks' => $remark,
                ]);
            }


            Toastr::success('Updated successfully!', 'Success');
            return redirect()->back();

        }catch (\Exception $e) {
            dd($e);
            Toastr::error('Update failed!', 'Error');
            return redirect()->back();
        }
    }

    public function addApplicantRating(Request $request)
    {
        try {

            // dd($request->all());

           // Assuming you're inside a controller method and $request is your incoming request
            // $ratings = [
            //     'rating1' => $request->rating1,
            //     'rating2' => $request->rating2,
            //     'rating3' => $request->rating3,
            // ];

            // for ($i = 1; $i <= 3; $i++) {
            //     ApplicantRatingsSpet::updateOrCreate(
            //         [
            //             'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
            //             'application_code' => $request->application_code,
            //             'criteria_id' => $request->performance_criteria_id,
            //         ],
            //         [
            //             'criteria_credits' => $ratings['rating' . $i],
            //         ]
            //     );
            // }

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                ],
                [
                    'criteria_id' => $request->performance_criteria_id,
                    'criteria_credits' => $request->rating_average,
                    'criteria_points' => $request->performance_criteria_points,
                    'criteria_details' => $request->performance_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->experience_criteria_id,
                    'criteria_credits' => $request->experience_credit,
                    'criteria_points' => $request->experience_criteria_points,
                    'criteria_details' => $request->experience_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->outstanding_accomplishment_criteria_id,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->outstanding_criteria_id,
                    'criteria_credits' => $request->outstanding_criteria_credit,
                    'criteria_points' => $request->outstanding_criteria_points,
                    'criteria_details' => $request->outstanding_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->innovations_criteria_id,
                    'criteria_credits' => $request->innovations_criteria_credit,
                    'criteria_points' => $request->innovations_criteria_points,
                    'criteria_details' => $request->innovations_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->research_criteria_id,
                    'criteria_credits' => $request->research_criteria_credit,
                    'criteria_points' => $request->research_criteria_points,
                    'criteria_details' => $request->research_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->publication_criteria_id,
                    'criteria_credits' => $request->publication_criteria_credit,
                    'criteria_points' => $request->publication_criteria_points,
                    'criteria_details' => $request->publication_criteria_details,
                ]
            );
            
            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->consultant_criteria_id,
                    'criteria_credits' => $request->consultant_criteria_credit,
                    'criteria_points' => $request->consultant_criteria_points,
                    'criteria_details' => $request->consultant_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->education_training_criteria_id,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->education_criteria_id,
                    'criteria_credits' => $request->education_criteria_credit,
                    'criteria_points' => $request->education_criteria_points,
                    'criteria_details' => $request->education_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->training_criteria_id,
                    'criteria_credits' => $request->training_criteria_credit,
                    'criteria_points' => $request->training_criteria_points,
                    'criteria_details' => $request->training_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->potential_criteria_id,
                    'criteria_credits' => $request->potential_criteria_crediit,
                    'criteria_points' => $request->potential_criteria_points,
                    'criteria_details' => $request->potential_criteria_details,
                ]
            );

            ApplicantRatingsSpet::updateOrCreate(
                [
                    'applicant_ratings_spet_id' => $request->applicant_ratings_spet_id,
                    'application_code' => $request->application_code,
                    
                ],
                [
                    'criteria_id' => $request->pyschosocial_criteria_id,
                    'criteria_credits' => $request->pyschosocial_criteria_credit,
                    'criteria_points' => $request->pyschosocial_criteria_points,
                    'criteria_details' => $request->pyschosocial_criteria_details,
                ]
            );




            // $applicationCode = $request->input('application_code');
            // $data = [];

            // // Iterate through the request data and prepare the array for insert or update
            // foreach ($request->all() as $key => $value) {
            //     // Check if the key matches the pattern for criteria (e.g., criteria_1_inc, criteria_2_details, etc.)
            //     if (preg_match('/^criteria_(\d+)_inc$/', $key, $matches)) {
            //         $criteriaId = $matches[1]; // Extract the numeric part of the criteria key
            //         $details = $request->input("criteria_{$criteriaId}_details");
            //         $inc = $request->input("criteria_{$criteriaId}_inc");
            //         $points = $request->input("criteria_{$criteriaId}_points");

            //         // Check if the record already exists
            //         $existingRecord = DB::connection('second_db')
            //             ->table('applicant_ratings_spet')
            //             ->where('application_code', $applicationCode)
            //             ->where('criteria_id', $criteriaId)
            //             ->first();

            //         if ($existingRecord) {
            //             // Update existing record
            //             DB::connection('second_db')
            //                 ->table('applicant_ratings_spet')
            //                 ->where('application_code', $applicationCode)
            //                 ->where('criteria_id', $criteriaId)
            //                 ->update([
            //                     'criteria_details' => $details,
            //                     'criteria_increment' => $inc,
            //                     'criteria_points' => $points
            //                 ]);
            //         } else {
            //             // Prepare the data array for insert
            //             $data[] = [
            //                 'application_code' => $applicationCode,
            //                 'criteria_id' => $criteriaId,
            //                 'criteria_details' => $details,
            //                 'criteria_increment' => $inc,
            //                 'criteria_points' => $points
            //             ];
            //         }
            //     }
            // }

            // // Perform bulk insert for new records
            // if (!empty($data)) {
            //     DB::connection('second_db')
            //         ->table('applicant_ratings_spet')->insert($data);
            // }

            Toastr::success('Updated successfully!', 'Success');
            return redirect()->route('elementary/applicants');
        } catch (\Exception $e) {
            dd($e);
            Toastr::error('Update failed!', 'Error');
            return redirect()->back();
        }
    }

    public function downloadRating(Request $request){

        $application_code = $request->query('application_code');

        $action = session('action');

        $applicant = DB::connection('second_db')
            ->table('applicant_information')
            ->leftJoin('application', 'applicant_information.application_code', '=', 'application.application_code')
            ->select(
                'applicant_information.id as applicant_id',
                'applicant_information.application_code as applicant_code',
                'applicant_information.*',
                'application.*'
            )
            ->where('applicant_information.application_code', $application_code)
            ->first();

        $applicantRating = DB::connection('second_db')
            ->table('applicant_ratings_spet')
            ->select('*')
            ->where('application_code', $application_code)
            ->get();

        if(Session::get('hr_user_role') == "Super Admin"){
            $criteria = DB::table('criteria_spet')
            ->select('*')
            ->orderBy('criteria_spet.id') // Sorting by criteria_id
            ->get()
            ->map(function($item) {
                $item->permission = 1;  // Set permission to 1
                $item->name = null;      // Set name to null
                return $item;
            });

        }else{
            $criteria = DB::table('evaluator_table')
            ->join('criteria_spet', 'criteria_spet.id', '=', 'evaluator_table.criteria_id')
            ->join('users', 'users.id', '=', 'evaluator_table.user_id')
            ->select(
                'criteria_spet.id as id',
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'criteria_spet.criteria',
                'criteria_spet.sub_criteria',
                'criteria_spet.standard_points',
                'evaluator_table.permission',  
                DB::raw("
                    CONCAT(
                        LEFT(IFNULL(users.first_name, ''), 1),
                        LEFT(IFNULL(users.middle_name, ''), 1),
                        LEFT(IFNULL(users.last_name, ''), 1)
                    ) AS name
                ")
            )
            ->where('evaluator_table.user_id', Session::get('user_id'))
            ->orderBy('criteria_spet.id') // Sorting by criteria_id
            ->get();
        }

       // Combine the data based on criteria_id
        $combinedData = $criteria->map(function($criterion) use ($applicantRating) {
            // Find the corresponding rating
            $rating = $applicantRating->firstWhere('criteria_id', $criterion->id);

            if ($rating) {
                // If matching rating exists, add its details
                $criterion->criteria_details = $rating->criteria_details;
                $criterion->criteria_increment = $rating->criteria_increment;
                $criterion->criteria_points = $rating->criteria_points;
                $criterion->remarks = $rating->remarks;
            } else {
                // If no matching rating, set details to null
                $criterion->criteria_details = null;
                $criterion->criteria_increment = null;
                $criterion->criteria_points = null;
                $criterion->remarks = null;
            }

            return $criterion;
        });

        // Calculate total points
        $totalPoints = $combinedData->sum(function($criterion) {
            return $criterion->criteria_points ?? 0;
        });

        // Optional: Convert the combined data to an array or collection as needed
        $combinedData = $combinedData->toArray();

        // dd($criteria,$applicant,$combinedData, $totalPoints); 


        return view('download.download-rating', compact('applicant', 'criteria', 'combinedData', 'totalPoints'));
    }

    public function viewAllApplicantsRating(Request $request){

        $applicantInformation = DB::connection('second_db')
            ->table('applicant_information as ai')
            ->join('application as a', 'ai.application_code', '=', 'a.application_code')
            ->join('applicant_ratings_spet as ar', 'ai.application_code', '=', 'ar.application_code')
            ->select(
                'ai.id',
                'ai.application_code',
                DB::raw("CONCAT(ai.first_name, ' ', ai.middle_name, ' ', ai.last_name, ' ', COALESCE(ai.extension_name, '')) AS full_name"),
                'a.application_title',
                'a.school_name',
                'a.school_barangay',
                'a.school_municipality',
                DB::raw('SUM(ar.criteria_points) AS total_points')
            )
            ->groupBy(
                'ai.id',
                'ai.application_code',
                'ai.first_name',
                'ai.middle_name',
                'ai.last_name',
                'ai.extension_name',
                'a.application_title',
                'a.school_name',
                'a.school_barangay',
                'a.school_municipality'
            )
            ->havingRaw('COUNT(ar.criteria_points) = COUNT(*)')
            ->get();
    
        return view('applicants_rating', compact('applicantInformation'));
    }

    public function databaseManagement(Request $request){

        $applicantInformation = [];
    
        return view('download_report', compact('applicantInformation'));
    }

    
    // public function updateApplicantPage()
    // {
    //     $withTotalRating = FALSE;
    //     $isScoreActive = FALSE;

    //     $applicantInformation = DB::connection('second_db')
    //     ->table('applicant_information')
    //     ->leftJoin('applicant_ratings_t1', 'applicant_information.application_code', '=', 'applicant_ratings_t1.application_code')
    //     ->leftJoin('application', 'applicant_information.application_code', '=', 'application.application_code')
    //     ->select(
    //         'applicant_information.id as applicant_id',
    //         'applicant_information.application_code as applicant_code',
    //         'applicant_information.*',
    //         'applicant_ratings_t1.*',
    //         'application.*'
    //     )
    //     ->where(function($query) {
    //         $query->whereNull('applicant_ratings_t1.education_inc')
    //               ->orWhereNull('applicant_ratings_t1.training_inc')
    //               ->orWhereNull('applicant_ratings_t1.experience_inc')
    //               ->orWhereNull('applicant_ratings_t1.pbet_let_lept_rating')
    //               ->orWhereNull('applicant_ratings_t1.ppst_coi_rating')
    //               ->orWhereNull('applicant_ratings_t1.ppst_ncoi_rating');
    //     })
    //     ->get();
        
    //     return view('teaching.elementary_applicant_update_page', compact('applicantInformation', 'withTotalRating','isScoreActive'));

    // }

}
