<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SeriesImport; // Import your import class
use Maatwebsite\Excel\Facades\Excel; // Import the Excel facade



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
