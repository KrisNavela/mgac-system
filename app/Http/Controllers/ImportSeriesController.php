<?php

namespace App\Http\Controllers;
use App\Imports\SeriesImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ImportSeriesController extends Controller
{
    public function importSeries(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv',
    ]);

    Excel::import(new SeriesImport, $request->file('file'));

    return redirect()->back()->with('success', 'Series status updated successfully.');
}
}
