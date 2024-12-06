<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Models\branch;
use App\Models\User;
use App\Models\NumberSeries;
use Illuminate\Support\Facades\Auth;

class NumberSeriesController extends Controller
{
    public function index(Request $request)
    {

        //$user = auth()->user(); // Get the authenticated user
        //$userId = $user->id;
        //$roleId = $user->role_id;

        $numberseries = NumberSeries::All()
        //->orderBy('id', 'desc')
        ->paginate(20)
        ->withQueryString();

        return view('numberseries.index', [
            'numberseries' => $numberseries,
        ]);

    }
}
