<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttendance;
use App\Models\EmployeeLeaveCredits;
use App\Models\EmployeeProfile;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminControllerLeaveCredits extends Controller
{
    public function leaveCredits_getNames(){
        
        // Query on the first database connection (hrms_db)
        $employeeType = DB::connection('second_db')
        ->table('employee_profiles')
        ->select('employee_profiles.user_id')
        ->join('employment_types as e', 'employee_profiles.employment_type_id', '=', 'e.employment_type_id')
        ->where('e.employment_type', '=', 'Regular')
        ->get();

        // Query on the second database connection (admin_db)
        $users = DB::connection('mysql')
        ->table('admin_db.users')
        ->select('id', 'first_name', 'middle_name', 'last_name')
        ->get();

        // Merge the data based on user_id
        $employees = $employeeType->map(function ($item) use ($users) {
            $user = $users->firstWhere('id', $item->user_id);
            $item->first_name = $user->first_name;
            $item->middle_name = $user->middle_name;
            $item->last_name = $user->last_name;
            return $item;
            });

        $totalVLBalance = 0;
        $totalSLBalance = 0;
            
        
        // Get the employee ID from the URL parameter
        $selectedEmployeeId = request()->query('employeeid');

        $name = '';
        $employeeLeaveCredits = [];
        $employeeDetails = '';
    
        return view('form.leave-credits',compact('employees', 'selectedEmployeeId','name','employeeLeaveCredits','employeeDetails','totalVLBalance','totalSLBalance'));
    }
    

    public function viewEmployeeLeaveCredits($employeeId) {

        // Query on the first database connection (hrms_db)
        $employeeType = DB::connection('second_db')
        ->table('employee_profiles')
        ->select('employee_profiles.user_id')
        ->join('employment_types as e', 'employee_profiles.employment_type_id', '=', 'e.employment_type_id')
        ->where('e.employment_type', '=', 'Regular')
        ->get();

        // Query on the second database connection (admin_db)
        $users = DB::connection('mysql')
        ->table('admin_db.users')
        ->select('id', 'first_name', 'middle_name', 'last_name')
        ->get();

        // Merge the data based on user_id
        $employees = $employeeType->map(function ($item) use ($users) {
            $user = $users->firstWhere('id', $item->user_id);
            $item->first_name = $user->first_name;
            $item->middle_name = $user->middle_name;
            $item->last_name = $user->last_name;
            return $item;
            });
        
        $employeeLeaveCredits = EmployeeLeaveCredits::where('user_id', $employeeId)->get();
        $balance = EmployeeLeaveCredits::select('vacation_leave_balance','sick_leave_balance','created_at')
        ->where('user_id', $employeeId)
        ->orderBy('created_at', 'desc')
        ->first();
        if ($balance) {
            $totalVLBalance = $balance->vacation_leave_balance;
            $totalSLBalance = $balance->sick_leave_balance;
        }else{
            $totalVLBalance = 0;
            $totalSLBalance = 0;
        }
        


        $employeeDetails = User::select('id','first_name', 'middle_name', 'last_name')
            ->where('id', $employeeId)
            ->first();

        // Format the name
        $name = $employeeDetails->last_name . ', ' . $employeeDetails->first_name . ' ' . $employeeDetails->middle_name;

        // Get the employee ID from the URL parameter
        $selectedEmployeeId = $employeeId;        

        // dd($selectedEmployeeId);

        return view('form.leave-credits',compact('employees','employeeLeaveCredits','name','employeeDetails','selectedEmployeeId','totalVLBalance','totalSLBalance'));
    }

    // public function getDayHoursMinutes(Request $request){
    //     $employeeId = $request->employeeId;
    //     $month = $request->month;
    //     $year = $request->year;

    //     $totalLate = EmployeeAttendance::where('dtr_id', $dtrId->dtr_id)
    //                         ->where('year', $request->year)
    //                         ->where('date', 'LIKE', $datePattern)
    //                         ->sum('late');
 
    //         // Calculate days, hours, and minutes
    //         $days = intdiv($totalLate, 1440); // 1440 minutes in a day
    //         $remainingMinutesAfterDays = $totalLate % 1440;
    //         $hours = intdiv($remainingMinutesAfterDays, 60); // 60 minutes in an hour
    //         $minutes = $remainingMinutesAfterDays % 60;

    //         $equivalent = $this->conversionOfWorkingHoursAndMinutes($hours, $minutes);
            

    //     return response()->json([
    //         'days' => $days,
    //         'hours' => $hours,
    //         'minutes' => $minutes,
    //         'equivalent' => $equivalent
    //     ]);
        

    // }

    public function adminAddTableRow(Request $request){
        
        try{

            $balance = EmployeeLeaveCredits::select('vacation_leave_balance','sick_leave_balance','created_at')
                        ->where('user_id', $request->employeeId)
                        ->where('year',$request->year)
                        ->orderBy('created_at', 'desc')
                        ->first();
                        
            if ($balance) {
  
                $dtrId = EmployeeProfile::select('dtr_id')->where('user_id', $request->employeeId)->first();
                $month = $this->handleMonthRequest($request->month);
                $datePattern = $month . '-%';
                
                $totalLate = EmployeeAttendance::where('dtr_id', $dtrId->dtr_id)
                            ->where('year', $request->year)
                            ->where('date', 'LIKE', $datePattern)
                            ->sum('late');
 
                // Calculate days, hours, and minutes
                $days = intdiv($totalLate, 1440); // 1440 minutes in a day
                $remainingMinutesAfterDays = $totalLate % 1440;
                $hours = intdiv($remainingMinutesAfterDays, 60); // 60 minutes in an hour
                $minutes = $remainingMinutesAfterDays % 60;

                $equivalent = $this->conversionOfWorkingHoursAndMinutes($hours, $minutes);

                $latestVLBalance = $balance->vacation_leave_balance - $equivalent;                

                $leaveCredit = new EmployeeLeaveCredits();
                $leaveCredit->user_id = $request->employeeId; 
                $leaveCredit->month = $request->month;
                $leaveCredit->year = $request->year;
                $leaveCredit->late_day = $days;
                $leaveCredit->late_hours = $hours;
                $leaveCredit->late_minutes = $minutes;
                $leaveCredit->vacation_leave_earned = $request->vacation_leave_earned;
                $leaveCredit->vacation_leave_deduction = $equivalent;
                $leaveCredit->vacation_leave_balance = $latestVLBalance;
                $leaveCredit->sick_leave_earned = $request->sick_leave_earned;
                $leaveCredit->sick_leave_deduction = 0;
                $leaveCredit->sick_leave_balance = $balance->sick_leave_balance;
                $leaveCredit->save();
            }

            else{
                dd('empty');
            }

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return $this->viewEmployeeLeaveCredits($request->employeeId);
        } catch(\Exception $e){
            DB::rollback();
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }

    public function adminAddLeaveCreditsBeginningBalance(Request $request){

        try{

            $leaveCredit = new EmployeeLeaveCredits();

            $leaveCredit->user_id = $request->employeeId; 
            $leaveCredit->year = $request->year;
            $leaveCredit->vacation_leave_balance = $request->vacation_leave_earned_begginning_balance;
            $leaveCredit->sick_leave_balance = $request->sick_leave_earned_begginning_balance;
            $leaveCredit->save();

            DB::commit();
            Toastr::success('Updated successfully !','Success');
            return $this->viewEmployeeLeaveCredits($request->employeeId);
        } catch(\Exception $e){
            DB::rollback();
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }

    public function handleMonthRequest($month)
    {
        switch ($month) {
            case 'Jan':
                return '01';
            case 'Feb':
                return '02';
            case 'Mar':
                return '03';
            case 'Apr':
                return '04';
            case 'May':
                return '05';
            case 'Jun':
                return '06';
            case 'Jul':
                return '07';
            case 'Aug':
                return '08';
            case 'Sep':
                return '09';
            case 'Oct':
                return '10';
            case 'Nov':
                return '11';
            case 'Dec':
                return '12';
            default:
                return null; // Handle invalid month
        }
    }

    public function conversionOfWorkingHoursAndMinutes($hours, $minutes) {

        // Define the minutes equivalent array
        $minutesEquivalent = [
            1 => 0.002,
            2 => 0.004,
            3 => 0.006,
            4 => 0.008,
            5 => 0.010,
            6 => 0.012,
            7 => 0.014,
            8 => 0.017,
            9 => 0.019,
            10 => 0.021,
            11 => 0.023,
            12 => 0.025,
            13 => 0.027,
            14 => 0.029,
            15 => 0.031,
            16 => 0.033,
            17 => 0.035,
            18 => 0.037,
            19 => 0.040,
            20 => 0.042,
            21 => 0.044,
            22 => 0.046,
            23 => 0.048,
            24 => 0.050,
            25 => 0.052,
            26 => 0.054,
            27 => 0.056,
            28 => 0.058,
            29 => 0.060,
            30 => 0.062,
            31 => 0.065,
            32 => 0.067,
            33 => 0.069,
            34 => 0.071,
            35 => 0.073,
            36 => 0.075,
            37 => 0.077,
            38 => 0.079,
            39 => 0.081,
            40 => 0.083,
            41 => 0.085,
            42 => 0.087,
            43 => 0.090,
            44 => 0.092,
            45 => 0.094,
            46 => 0.096,
            47 => 0.098,
            48 => 0.100,
            49 => 0.102,
            50 => 0.104,
            51 => 0.106,
            52 => 0.108,
            53 => 0.110,
            54 => 0.112,
            55 => 0.115,
            56 => 0.117,
            57 => 0.119,
            58 => 0.121,
            59 => 0.123,
            60 => 0.125,
        ];
    
        // Calculate the total equivalent value
        $equivalent = 0;
    
        // Convert hours to equivalent value (assuming 1 hour = 0.125 * 60)
        $equivalent += $hours * 0.125;
    
        // Convert minutes to equivalent value
        if (isset($minutesEquivalent[$minutes])) {
            $equivalent += $minutesEquivalent[$minutes];
        } else {
            $equivalent = 0;
        }
    
        return $equivalent;
    }
}