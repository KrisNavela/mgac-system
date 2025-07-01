<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Http\Requests\StorebranchRequest;
use App\Http\Requests\UpdatebranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::paginate(10); // or any number per page
        
        return view('branches.index', [
            'branches' => $branches
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_code' => ['required'],
            'branch_name' => ['required'],
            'manager_name' => ['required'],
            'manager_position' => ['required'],
            'address1' => ['required'],
            'address2' => ['required'],
            'type_office' => ['required'],
        ]);

        branch::create($request->all());
        
        return redirect(route('branches.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(branch $branch)
    {
        return view('branches.show', [
            'branch' => $branch
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(branch $branch)
    {
        return view('branches.edit', [
            'branch' => $branch
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebranchRequest $request, branch $branch)
    {
        $branch->update($request->all());
        
        return redirect(route('branches.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(branch $branch)
    {
        $branch->delete();

        return redirect(route('branches.index'));
    }
}
