<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\User;
use App\Models\NumberSeries;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

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

        if ($roleId == 2){
            // Apply branch code filter if provided
            if ($request->filled('branch_code')) {
                $query->where('branch_code', $branch_code);
            }
        } else {
            // Apply branch code filter if provided
            if ($request->filled('branch_code')) {
                $query->where('branch_code', $request->input('branch_code'));
            }
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
}
