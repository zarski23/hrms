<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExcelUploadAttendance extends Controller implements ToCollection
{
    
    public function collection(Collection $rows)
    {
        try {

            DB::connection('second_db')->beginTransaction();

            // Process each row in batches
            $batchSize = 100; // Adjust batch size as needed
            $batch = [];

            //dd('Number of Rows in Excel file :',$rows->count());
            $rowsCount = $rows->count();
            $i = 2; // Row where the ID and Year is located
            $increment = 23;
            $duplicateEntry = False;


            for($x = 7; $x < $rowsCount; $x++){ // loop skip the 1st header of the excel file

                $rowIDandYear = $rows[$i]; //get the row where Biometric ID and Year is located
                $id = $rowIDandYear[0]; //get the Biometric ID
                $year = $rowIDandYear[13]; //get the Year 
            
                if (preg_match('/^ID:(\d+)$/', $id, $matches)) {
                    $id = $matches[1]; // $id will contain the extracted ID value
                } else {
                    // Handle the case where the string does not match the expected format
                    $id = null; // or any other appropriate action
                }

                if (preg_match('/\b(\d{4})-\d{2}-\d{2}\b/', $year, $matches)) {
                    $year = $matches[1]; // $year will contain the extracted year value
                } else {
                    // Handle the case where the string does not match the expected format
                    $year = null; // or any other appropriate action
                }

                $rowData = $rows[$x]; // get the row of excel data

                if($x != $increment){

                    if($rowData[0] != ""){
                        
                        $result = $this->computeLateAndDays($rowData[2],$rowData[3],$rowData[6],$rowData[7]); //call the compute late function
                        
                        $data = [
                            "dtr_id" => $id,
                            "year" => $year,
                            "date" => $rowData[0],
                            "week" => $rowData[1],
                            "time_in" => $rowData[2],
                            "break_out" => $rowData[3],
                            "break_in" => $rowData[6],
                            "time_out" => $rowData[7],
                            "late" => $result['total_late'],
                            "days_worked" => $result['days_worked'],
                        ];
                        
                        // Check if the combination of user_id and date already exists in the database
                        $existingRecord = DB::connection('second_db')
                        ->table("hrms_db.employee_attendance")
                        ->where('dtr_id', $data['dtr_id'])
                        ->where('year', $data['year'])
                        ->where('date', $data['date'])
                        ->first();

                        if (!$existingRecord) {
                            $batch[] = $data;

                            // DB::connection('second_db')
                            // ->table("hrms_db.employee_attendance")->insert($data);
                            
                        }else{
                            $duplicateEntry = TRUE;
                        }
                    }
        
                   if($rowData[8] != ""){

                        $result = $this->computeLateAndDays($rowData[10],$rowData[11],$rowData[14],$rowData[15]); //call the compute late function

                        $data = [
                            "dtr_id" => $id,
                            "year" => $year,
                            "date" => $rowData[8],
                            "week" => $rowData[9],
                            "time_in" => $rowData[10],
                            "break_out" => $rowData[11],
                            "break_in" => $rowData[14],
                            "time_out" => $rowData[15],
                            "late" => $result['total_late'],
                            "days_worked" => $result['days_worked'],
                        ];

                        // Check if the combination of user_id and date already exists in the database
                            $existingRecord = DB::connection('second_db')
                            ->table("hrms_db.employee_attendance")
                            ->where('dtr_id', $data['dtr_id'])
                            ->where('year', $data['year'])
                            ->where('date', $data['date'])
                            ->first();

                        if (!$existingRecord) {
                            $batch[] = $data;
                            // DB::connection('second_db')
                            // ->table("hrms_db.employee_attendance")->insert($data);
                            
                        }else{
                            $duplicateEntry = TRUE;
                        }
                    }

                }else{
                    $x +=5;
                    $increment += 22;
                    $i +=22;
                }          
            }
            
            if($duplicateEntry){
                Toastr::info('With Duplicate Entry !','Warning');
            }

            DB::connection('second_db')->table("hrms_db.employee_attendance")->insert($batch);
            DB::connection('second_db')->commit();
            
            Toastr::success('Upload successfully !','Success');
            
        } catch (\Throwable $e) {
            report($e);
            dd($e);
            Toastr::error('Update fail !','Error');
            
            return false;
        }

    }

    public function computeLateAndDays($timeinValue, $breakoutValue, $breakinValue, $timeoutValue){

        $days_worked = 0;
        $total_late = 0;
        $timein_lateness_minutes = 0;
        $breakin_lateness_minutes = 0;
        $scheduled_time_in = Carbon::parse('08:00'); 
        $scheduled_break_in = Carbon::parse('13:00');

        $timein_without_asterisk = str_replace('*', '', $timeinValue); // if time-in has *, replace with ('')
        $timein_without_asterisk = Carbon::parse($timein_without_asterisk); // parse the time-in value
        $breakin = Carbon::parse($breakinValue); // parse the break-in value


        if(!empty($timeinValue) and $timeinValue != " \t " and !empty($breakoutValue) and $breakoutValue != " \t "){

            if ($timein_without_asterisk >= $scheduled_time_in) {
                $timein_lateness_minutes = max(0, $timein_without_asterisk->diffInMinutes($scheduled_time_in)); // Calculate time-in lateness in minutes
            }
            $days_worked += .5; // halfday count
        }


        if(!empty($breakinValue) and $breakinValue != " \t " and !empty($timeoutValue) and $timeoutValue != " \t "){

            if ($breakin >= $scheduled_break_in) {
                $breakin_lateness_minutes = max(0, $breakin->diffInMinutes($scheduled_break_in)); // Calculate time-in lateness in minutes
            }
            $days_worked += .5; // halfday count
        }

        $total_late = $timein_lateness_minutes + $breakin_lateness_minutes;
        
        return compact ('total_late', 'days_worked');
    }
}
