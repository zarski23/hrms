<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelUploadNewApplicant extends Controller implements ToCollection
{
    public function collection(Collection $rows)
    {
        try {
            DB::connection('second_db')->beginTransaction();

            $batchBasicInfo = [];
            $batchEducInfo = [];
            $batchTrainingInfo = [];
            $batchExperienceInfo = [];
            $batchApplicationInfo = [];

            $rowsCount = $rows->count();
            $duplicateEntry = false;
            $addEntry = false;

            // Skip the header row
            for ($x = 1; $x < $rowsCount; $x++) {
                $rowData = $rows[$x];
                $firstExcelColumn = $rowData[0];

                if ($firstExcelColumn != null) {
                    // Check if the date column contains a valid date (Excel date numbers are numeric)
                    $dateOfBirth = is_numeric($rowData[11])
                        ? Date::excelToDateTimeObject($rowData[11])->format('Y-m-d')
                        : null; // Handle invalid date or leave null if it's not a valid date.

                    $basicInfo = [
                        "application_code" => $rowData[3],
                        "first_name" => $rowData[5],
                        "middle_name" => $rowData[6],
                        "last_name" => $rowData[4],
                        "extension_name" => $rowData[7],
                        "province" => $rowData[8],
                        "municipality" => $rowData[9],
                        "barangay" => $rowData[10],
                        "date_of_birth" => $dateOfBirth, // Only if it's a valid date
                        "place_of_birth" => $rowData[12],
                        "age" => $rowData[13],
                        "sex" => $rowData[14],
                        "civil_status" => $rowData[15],
                        "religion" => $rowData[16],
                        "eligibility" => $rowData[17],
                        "disability" => $rowData[18],
                        "ethnic_group" => $rowData[19],
                        "beneficiary_4ps" => $rowData[20],
                        "email" => $rowData[21],
                        "contact_number" => $rowData[22],
                    ];

                    $educInfo = [
                        "application_code" => $rowData[3],
                        "baccalaureate" => $rowData[23],
                        "specialization" => $rowData[24],
                        "awards" => $rowData[25],
                        "post_grad" => $rowData[26],
                    ];

                    $trainingInfo = [
                        "application_code" => $rowData[3],
                        "title" => $rowData[27],
                        "hours" => $rowData[28],
                    ];

                    $experienceInfo = [
                        "application_code" => $rowData[3],
                        "details" => $rowData[29],
                        "years" => $rowData[30],
                    ];

                    $applicationInfo = [
                        "application_code" => $rowData[3],
                        "application_title" => $rowData[31],
                        "school_name" => $rowData[32],
                        "school_municipality" => $rowData[33],
                        "school_barangay" => $rowData[34],
                    ];

                    $existingRecord = DB::connection('second_db')
                        ->table("applicant_information")
                        ->where('first_name', $rowData[5])
                        ->where('middle_name', $rowData[6])
                        ->where('last_name', $rowData[4])
                        ->first();

                    if (!$existingRecord) {
                        $batchBasicInfo[] = $basicInfo;
                        $batchEducInfo[] = $educInfo;
                        $batchTrainingInfo[] = $trainingInfo;
                        $batchExperienceInfo[] = $experienceInfo;
                        $batchApplicationInfo[] = $applicationInfo;
                        $addEntry = true;
                    } else {
                        $duplicateEntry = true;
                    }
                }
            }

            if ($duplicateEntry) {
                Toastr::warning('With Duplicate Entry!', 'Warning');
            }
            if ($addEntry) {
                Toastr::success('Upload successfully!', 'Success');
            }

            DB::connection('second_db')->table("applicant_information")->insert($batchBasicInfo);
            DB::connection('second_db')->table("applicant_education")->insert($batchEducInfo);
            DB::connection('second_db')->table("applicant_training")->insert($batchTrainingInfo);
            DB::connection('second_db')->table("applicant_experience")->insert($batchExperienceInfo);
            DB::connection('second_db')->table("application")->insert($batchApplicationInfo);
            DB::connection('second_db')->commit();

        } catch (\Throwable $e) {
            DB::connection('second_db')->rollBack();
            Toastr::error('Warning, Upload Failed!', 'Error');
            return false;
        }
    }
}
