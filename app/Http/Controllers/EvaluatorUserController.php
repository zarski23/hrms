<?php

namespace App\Http\Controllers;

use App\Models\EvaluatorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class EvaluatorUserController extends Controller
{
    public function viewAllEvaluator()
    {
        $criteria = (new UserManagementController)->getCriteriaSPET();

        $userList = DB::connection('mysql')
            ->table('users')
            ->where('hr_user_role', 'Evaluator')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('evaluator_table')
                    ->whereColumn('evaluator_table.user_id', 'users.id');
            })
            ->get();

            $userEvaluator = DB::connection('mysql')
            ->table('users')
            ->join('evaluator_table', 'users.id', '=', 'evaluator_table.user_id')
            ->join('criteria_spet', 'criteria_spet.id', '=', 'evaluator_table.criteria_id')
            ->select(
                'users.id as user_id', 
                'users.username', 
                'users.image', 
                'users.first_name', 
                'users.middle_name', 
                'users.last_name', 
                'users.hr_user_role',
                DB::raw('GROUP_CONCAT(DISTINCT criteria_spet.id ORDER BY criteria_spet.id ASC) as criteria_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT criteria_spet.criteria ORDER BY criteria_spet.id ASC) as criteria_list'),
                DB::raw('GROUP_CONCAT(DISTINCT criteria_spet.sub_criteria ORDER BY criteria_spet.id ASC) as sub_criteria_list')
            )
            ->where('evaluator_table.permission', 1)  // Add the condition here
            ->groupBy('users.id', 'users.username', 'users.image', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.hr_user_role')
            ->get();
        
        

        $applications_lists  = [];
       
        return view('usercontroller.evaluator',compact('criteria','userEvaluator','userList','applications_lists'));
    }

    // save data employee
    public function saveEvaluatorPermission(Request $request)
    {
        $user_id = $request->user; // Get the value of user_id
        $checkedIds = $request->input('read', []); // Get the IDs of checked checkboxes
        $uncheckedIds = $request->input('unchecked', []); // Get the IDs of unchecked checkboxes

        DB::beginTransaction();
        try{

            // Process checked checkboxes
            foreach ($checkedIds as $id) {
                // Save the checked permission (1) to the database

                $evaluator_access = [
                    'user_id' => $user_id,
                    'criteria_id' => $id,
                    'permission' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                DB::table('evaluator_table')->insert($evaluator_access);
                
            }

            // Process unchecked checkboxes
            foreach ($uncheckedIds as $id) {
                if (!in_array($id, $checkedIds)) {
                    // Save the unchecked permission (0) to the database

                    $evaluator_access = [
                        'user_id' => $user_id,
                        'criteria_id' => $id,
                        'permission' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    DB::table('evaluator_table')->insert($evaluator_access);
                }
            }

            //Input activity Logs
            // $dt = Carbon::now();
            // $todayDate  = $dt->toDayDateTimeString();
            // $activityLog = [
            //     'user_id' => Session::get('user_id'),
            //     'app_id' => '1',
            //     'activities' => 'Add Application Access - ' . $request->fname . ' ' . $request->lname,
            //     'date_time' => $todayDate,
            // ];
            // DB::table('activity_logs')->insert($activityLog);

            DB::commit();
            Toastr::success('Added successfully','Success');
            return redirect()->route('all/user/evaluator');

        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }
    }
}
