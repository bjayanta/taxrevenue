<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AssesseeInput;
use Excel;

class ExcelExportController extends Controller
{
    public function allAssessee(Request $request) {
        $data = collect(["Hello","world"]);

        return Excel::download($data, 'all-assessee.xlsx');
    }
}
