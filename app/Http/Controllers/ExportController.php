<?php

namespace App\Http\Controllers;

use App\Exports\CitasExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function citasExcel()
    {
        return Excel::download(new CitasExport, 'citas-' . date('Y-m-d') . '.xlsx');
    }

    public function citasCSV()
    {
        return Excel::download(new CitasExport, 'citas-' . date('Y-m-d') . '.csv');
    }
}
