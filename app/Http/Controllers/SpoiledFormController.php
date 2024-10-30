<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\SpoiledForm;
use Illuminate\Support\Facades\Auth;

class SpoiledFormController extends Controller
{
    public function index(Request $request)
    {
        //$user = auth()->user(); // Get the authenticated user
        //$userId = $user->id;
        //$roleId = $user->role_id;

        $user = User::all();
        $spoiledforms = SpoiledForm::All();
        $items = Item::all();

        return view('spoiledforms.index', [
            'spoiledforms' => $spoiledforms,
            'items' => $items,
            'user' => $user,
        ]);
    }

    public function create()
    {
        $items = Item::all();
        return view('spoiledforms.create',
        [
            'items' => $items,
        ]);
    }

    public function store(Request $request)
    {

        $spoiledform = SpoiledForm::create([
            'spoiled_date' => $request->spoiled_date,
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'spoiled_reason' => $request->spoiled_reason,
        ]);

        return redirect(route('spoiledforms.index'));

    }

    public function show(SpoiledForm $spoiledform)
    {
        $items = Item::all();
        return view('spoiledforms.show', [
            'spoiledform' => $spoiledform,
            'items' => $items,
        ]);
    }

    public function edit(SpoiledForm $spoiledform)
    {
        $items = Item::all();
        return view('spoiledforms.edit', [
            'spoiledform' => $spoiledform,
            'items' => $items,
        ]);

    
    }

    public function update(Request $request, SpoiledForm $spoiledform)
    {
        $spoiledform->update($request->all());
        
        return redirect(route('spoiledforms.index'));
    }
}
