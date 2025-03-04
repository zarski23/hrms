<?php

namespace App\Http\Controllers;

use App\Exports\ApplicantRatingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelDownloadData extends Controller
{
    public function exportApplicantRatings()
    {
        return Excel::download(new ApplicantRatingsExport, 'applicant_ratings.xlsx');
    }
}
