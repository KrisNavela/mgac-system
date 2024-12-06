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

        //$user = auth()->user(); // Get the authenticated user
        //$userId = $user->id;
        //$roleId = $user->role_id;
        //$branches = branch::all();
        //$users = User::all();
        //$requisitions = Requisition::all();
        //$items = Item::all();
        

        //$numberseries = NumberSeries::paginate(30);
        //->orderBy('id', 'desc')
        //->paginate(20)
        //->withQueryString();

        //return view('numberseries.index', [
        //    'numberseries' => $numberseries,
        //    'requisitions' => $requisitions,
        //    'branches' => $branches,
        //    'users' => $users,
        //    'items' => $items,

        //]);

        // Start the query builder
        $query = NumberSeries::query();
        $branches = branch::all();
        $users = User::all();
        $requisitions = Requisition::all();
        $items = Item::all();

        // Apply name filter if provided
        if ($request->filled('item_id')) {
            $query->where('item_id', $request->input('item_id'));
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

    public function updateforreported($id)
    {
        $numberseries = NumberSeries::findOrFail($id);
        $numberseries->number_status = 'Used';
        $numberseries->save(); // Save the changes
        

        return redirect()->route('numberseries.index')->with('success', 'Reported successfully');
    }
}
