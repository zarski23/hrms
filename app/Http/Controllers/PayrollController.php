<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttendance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DateTime;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Collection;

class PayrollController extends Controller
{

    public function viewPayrollReport(){
        return view('payroll.employee-dailywagepayroll');
    }

    public function viewPayrollRecord(){
        return view('payroll.payroll-record');
    }

    public function generatePayroll(Request $request){
        try{

            $date_from = $request->date_from;
            $date_to = $request->date_to;

            $dateFrom = Carbon::createFromFormat('m-d-Y', $request->date_from)->format('m-d');
            $dateTo = Carbon::createFromFormat('m-d-Y', $request->date_to)->format('m-d');
            $year = Carbon::createFromFormat('m-d-Y', $request->date_from)->format('Y');

            // dd($dateFrom, $dateTo);

            $results = DB::connection('second_db')
            ->table('employee_profiles')
            ->select(
                'employee_profiles.user_id',
                'employee_attendance.dtr_id',
                'employment_types.employment_type',
                DB::raw('SUM(employee_attendance.days_worked) AS days_worked'),
                'employee_salaries.daily_salary',
                DB::raw('SUM(employee_attendance.days_worked * employee_salaries.daily_salary) AS gross_result'),
                DB::raw('SUM(employee_attendance.late) AS late'),
                DB::raw('SUM((employee_salaries.daily_salary / 8 / 60) * employee_attendance.late) AS late_penalty'),
                DB::raw('(SUM(employee_attendance.days_worked * employee_salaries.daily_salary) - SUM((employee_salaries.daily_salary / 8 / 60) * employee_attendance.late)) AS net_salary'),
                'employee_departments.department_name',
                'employee_community_taxes.number',
                'employee_community_taxes.date',
                'employee_community_taxes.place_issued'
            )
            ->join('employment_types', 'employee_profiles.employment_type_id', '=', 'employment_types.employment_type_id')
            ->join('employee_departments', 'employee_profiles.department_id', '=', 'employee_departments.department_id')
            ->join('employee_salaries', 'employee_profiles.user_id', '=', 'employee_salaries.user_id')
            ->join('employee_attendance', 'employee_profiles.dtr_id', '=', 'employee_attendance.dtr_id')
            ->leftJoin('employee_community_taxes', 'employee_profiles.user_id', '=', 'employee_community_taxes.user_id')
            ->where('employment_types.employment_type', '=', 'Job Order')
            ->where('employee_attendance.year', [$year])
            ->whereBetween('employee_attendance.date', [$dateFrom, $dateTo])
            ->groupBy(
                'employee_profiles.user_id',
                'employee_profiles.dtr_id',
                'employee_attendance.dtr_id',
                'employment_types.employment_type',
                'employee_salaries.daily_salary',
                'employee_departments.department_name',
                'employee_community_taxes.number',
                'employee_community_taxes.date',
                'employee_community_taxes.place_issued'
            )
            ->orderBy('employee_departments.department_name')
            ->get();

            $users = DB::connection('mysql')
                ->table('users')
                ->select('id', 'first_name', 'middle_name', 'last_name')
                ->get();

            // Group users by ID for easier lookup
            $usersById = $users->keyBy('id');

            // Combine data
            foreach ($results as $result) {
                $userId = $result->user_id;
                if ($usersById->has($userId)) {
                    $user = $usersById->get($userId);
                    $result->user = $user;
                }
            }

            $totalGrossResult = number_format($results->sum('gross_result'), 2, '.', ''); // 2 is the number of decimal places
            $totalLatePenalty = number_format($results->sum('late_penalty'), 2, '.', '');
            $totalNetSalary = number_format($results->sum('net_salary'), 2, '.', '');

            // dd($results);
            // dd($totalGrossResult, $totalLatePenalty, $totalNetSalary);
            
            return view('payroll.employee-dailywagepayroll', compact('results','totalGrossResult','totalLatePenalty','totalNetSalary','date_from','date_to'));

        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }
    }

    public function downloadPayrollReport($date_from, $date_to){

        try{

            $dateFrom = Carbon::createFromFormat('m-d-Y', $date_from)->format('m-d');
            $dateTo = Carbon::createFromFormat('m-d-Y', $date_to)->format('m-d');
            $year = Carbon::createFromFormat('m-d-Y', $date_from)->format('Y');


            // dd($dateFrom, $dateTo);

            $results = DB::connection('second_db')
            ->table('employee_profiles')
            ->select(
                'employee_profiles.user_id',
                'employee_attendance.dtr_id',
                'employment_types.employment_type',
                DB::raw('SUM(employee_attendance.days_worked) AS days_worked'),
                'employee_salaries.daily_salary',
                DB::raw('SUM(employee_attendance.days_worked * employee_salaries.daily_salary) AS gross_result'),
                DB::raw('SUM(employee_attendance.late) AS late'),
                DB::raw('SUM((employee_salaries.daily_salary / 8 / 60) * employee_attendance.late) AS late_penalty'),
                DB::raw('(SUM(employee_attendance.days_worked * employee_salaries.daily_salary) - SUM((employee_salaries.daily_salary / 8 / 60) * employee_attendance.late)) AS net_salary'),
                'employee_departments.department_name',
                'employee_community_taxes.number',
                'employee_community_taxes.date',
                'employee_community_taxes.place_issued'
            )
            ->join('employment_types', 'employee_profiles.employment_type_id', '=', 'employment_types.employment_type_id')
            ->join('employee_departments', 'employee_profiles.department_id', '=', 'employee_departments.department_id')
            ->join('employee_salaries', 'employee_profiles.user_id', '=', 'employee_salaries.user_id')
            ->join('employee_attendance', 'employee_profiles.dtr_id', '=', 'employee_attendance.dtr_id')
            ->leftJoin('employee_community_taxes', 'employee_profiles.user_id', '=', 'employee_community_taxes.user_id')
            ->where('employment_types.employment_type', '=', 'Job Order')
            ->where('employee_attendance.year', [$year])
            ->whereBetween('employee_attendance.date', [$dateFrom, $dateTo])
            ->groupBy(
                'employee_profiles.user_id',
                'employee_profiles.dtr_id',
                'employee_attendance.dtr_id',
                'employment_types.employment_type',
                'employee_salaries.daily_salary',
                'employee_departments.department_name',
                'employee_community_taxes.number',
                'employee_community_taxes.date',
                'employee_community_taxes.place_issued'
            )
            ->orderBy('employee_departments.department_name')
            ->get();

            $users = DB::connection('mysql')
                ->table('users')
                ->select('id', 'first_name', 'middle_name', 'last_name')
                ->get();

            // Group users by ID for easier lookup
            $usersById = $users->keyBy('id');

            // Combine data
            foreach ($results as $result) {
                $userId = $result->user_id;
                if ($usersById->has($userId)) {
                    $user = $usersById->get($userId);
                    $result->user = $user;
                }
            }

            $totalGrossResult = $results->sum('gross_result');
            $totalLatePenalty = $results->sum('late_penalty');
            $totalNetSalary = $results->sum('net_salary');

            $dateTimeFrom = DateTime::createFromFormat('m-d-Y', $date_from);
            $dateTimeTo = DateTime::createFromFormat('m-d-Y', $date_to);
            $formattedDateFrom = $dateTimeFrom->format('F j');
            $formattedDateTo = $dateTimeTo->format('j, Y');
            $combinedDate = $formattedDateFrom . ' - ' . $formattedDateTo;

            $signatories = (new UserManagementController)->getSignatories_DailyWagePayroll();

            return view('payroll.download-payroll', compact('results','totalGrossResult','totalLatePenalty','totalNetSalary','date_from','date_to','combinedDate','signatories'));

        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }
    }
}
