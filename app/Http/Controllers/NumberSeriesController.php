<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\User;
use App\Models\NumberSeries;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class NumberSeriesController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user(); 
        $userId = $user->id;
        $roleId = $user->role_id;
        $branch_code = auth()->user()->branches?->branch_code;

        // Start the query builder
        $query = NumberSeries::query();
        $branches = branch::all();
        $users = User::all();
        $requisitions = Requisition::all();
        $items = Item::all();


        // Apply item id filter if provided
        if ($request->filled('item_id')) {
            $query->where('item_id', $request->input('item_id'));
        }

        
        // Apply branch code filter if provided
        if ($request->filled('branch_code')) {
            $query->where('branch_code', $request->input('branch_code'));
        }

        // Apply branch code filter if provided
        if ($request->filled('number_status')) {
            $query->where('number_status', $request->input('number_status'));
        }
        
        

        // Paginate the results
        $numberseries = $query->paginate(20);

        // Preserve query parameters in pagination links
        $numberseries->appends($request->all());

        return view('numberseries.index', [
            'numberseries' => $numberseries,
            'requisitions' => $requisitions,
            'branches' => $branches,
            'users' => $users,
            'items' => $items,
            'roleId' => $roleId,
        ]);
    }

    public function updateforreported(Request $request, $id)
    {
        $numberseries = NumberSeries::findOrFail($id);
        $numberseries->number_status = 'Used';
        $numberseries->save(); // Save the changes

        return redirect()->route('numberseries.index', $request->query())
                     ->with('success', 'Record updated successfully.');
    }

    public function printSeriesPdf(Request $request)
    {
        $query = NumberSeries::with(['item', 'requisition']);

        // FILTERS
        if ($request->filled('item_id')) {
            $query->where('item_id', $request->item_id);
        }

        if ($request->filled('branch_code')) {
            $query->where('branch_code', $request->branch_code);
        }

        if ($request->filled('number_status')) {
            $query->where('number_status', $request->number_status);
        }

        // IMPORTANT
        // use chunk-safe smaller dataset approach
        $numberseries = $query
            ->orderBy('item_id')
            ->orderBy('number')
            ->get();

        // GROUP BY LINE
        $groupedSeries = $numberseries->groupBy(function ($item) {
            return $item->item->item_desc ?? 'No Line';
        });

        $pdf = Pdf::loadView(
            'numberseries.pdf',
            compact('groupedSeries')
        )->setPaper('a4', 'landscape');

        return $pdf->stream('series-report.pdf');
    }

    public function exportCsv(Request $request)
    {
        $fileName = 'series-report.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($request) {

            $file = fopen('php://output', 'w');

            // CSV HEADER
            fputcsv($file, [
                'Line',
                'Req No',
                'Date',
                'Branch',
                'Series Number',
                'Status',
            ]);

            $query = NumberSeries::with(['item', 'requisition']);

            // FILTERS
            if ($request->filled('item_id')) {
                $query->where('item_id', $request->item_id);
            }

            if ($request->filled('branch_code')) {
                $query->where('branch_code', $request->branch_code);
            }

            if ($request->filled('number_status')) {
                $query->where('number_status', $request->number_status);
            }

            // CHUNKING = MEMORY SAFE
            $query->orderBy('item_id')
                ->chunk(1000, function ($rows) use ($file) {

                    foreach ($rows as $row) {

                        fputcsv($file, [
                            $row->item->item_desc ?? '',
                            $row->requisition->req_no ?? '',
                            $row->requisition->req_date ?? '',
                            $row->branch_name,
                            $row->number,
                            $row->number_status,
                        ]);
                    }
                });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
