<?php

namespace App\Http\Controllers;

use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Models\EmployeeLeaveCredits;

class AttendanceController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    
    // view page salary
    public function viewAttendanceReport()
    {

       // Query on the first database connection (hrms_db)
        $attendanceData = DB::connection('second_db')
        ->table('employee_attendance')
        ->select(
            'employee_profiles.user_id',
            'employee_attendance.dtr_id',
            'employee_attendance.year',
            'employee_attendance.date',
            'employee_attendance.week',
            'employee_attendance.time_in',
            'employee_attendance.break_out',
            'employee_attendance.break_in',
            'employee_attendance.time_out',
            'employee_attendance.late',
            'employee_attendance.days_worked',
            'employee_attendance.status',
            'employment_types.employment_type'
        )
        ->join('hrms_db.employee_profiles', 'employee_attendance.dtr_id', '=', 'employee_profiles.dtr_id')
        ->leftjoin('hrms_db.employment_types', 'employee_profiles.employment_type_id', '=', 'employment_types.employment_type_id')
        ->orderBy('employee_attendance.date', 'desc')
        ->orderBy(DB::raw('CAST(employee_attendance.dtr_id AS SIGNED)'), 'asc')
        ->get();

        // Query on the second database connection (mysql)
        $users = DB::connection('mysql')
        ->table('admin_db.users')
        ->select('id', 'first_name', 'middle_name', 'last_name')
        ->get();

        // Merge the data based on user_id
        $attendance = $attendanceData->map(function ($item) use ($users) {
        $user = $users->firstWhere('id', $item->user_id);
        $item->first_name = $user->first_name;
        $item->middle_name = $user->middle_name;
        $item->last_name = $user->last_name;
        return $item;
        });

        // Now $attendanceWithUsers contains the combined data from both databases
        return view('teaching.elementary_applicant')->with('attendance', $attendance);

    }

    public function uploadAttendanceReport(Request $request)
    {
        try {
            
            Excel::import(new ExcelUploadAttendance(),$request->file);
        
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
        
        return redirect()->route('attendance/report/page');
    }

    public function editEmployeeAttendance(Request $request)
    {
        try {
    
            $fullToShortDayMap = [
                'Sunday' => 'Sun',
                'Monday' => 'Mon',
                'Tuesday' => 'Tue',
                'Wednesday' => 'Wed',
                'Thursday' => 'Thu',
                'Friday' => 'Fri',
                'Saturday' => 'Sat'
            ];

            // Convert full day name to short day name
            $shortWeek = $fullToShortDayMap[$request->week] ?? $request->week;

            $date = $request->date;
            $dateParts = explode('-', $date);

            $year = $dateParts[0];
            $dateWithoutYear = $dateParts[1] . '-' . $dateParts[2];


            
            $attendance = EmployeeAttendance::where('dtr_id', $request->dtr_id)
                                ->where('date', $dateWithoutYear)
                                ->where('year', $year)
                                ->first();

            if (!$attendance) {
                return response()->json(['message' => 'Attendance record not found'], 404);
            }

            $result = (new ExcelUploadAttendance)->computeLateAndDays($request->time_in,$request->break_out,$request->break_in,$request->time_out); //call the compute late function

            $status = (new ExcelUploadAttendance)->attendanceStatus($shortWeek,$request->time_in,$request->time_out); // get the Attendance Status

            $attendance->time_in = $request->time_in;
            $attendance->break_out = $request->break_out;
            $attendance->break_in = $request->break_in;
            $attendance->time_out = $request->time_out;
            $attendance->late = $result['total_late'];
            $attendance->days_worked = $result['days_worked'];
            $attendance->status = $status;
            $attendance->save();
            
            Toastr::success('Updated successfully !','Success');
            return redirect()->back();
        }catch(\Exception $e){
            Toastr::error('Update fail !','Error');
            return redirect()->back();
        }
    }
}
