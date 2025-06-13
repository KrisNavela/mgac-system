<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Requisition;
use App\Models\Item;
use App\Models\RequisitionItem;
use App\Models\SpoiledForm;
use App\Models\ItemOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        //Don't Delete
        //$items = Item::withSum('requisitions', ('item_requisition.in_pcs'))    
        //->paginate(5)
        //->withQueryString();

        //$items = Item::withSum(['requisitions' => function ($query) 
        //{ $query->where('status', 'done'); }], 'item_requisition.in_pcs')
        //->paginate(5)
        //->withQueryString();

        //$items = Item::withSum('spoiledSeries', 'quantity')
        //->withSum('spoiledSeries', 'quantity')
        //->get();

        $items = Item::withSum(['requisitions' => function ($query) 
        { $query->where('status', 'done'); }], 'item_requisition.in_pcs')
        ->withSum('spoiledForms', 'quantity')
        ->paginate(20)
        ->withQueryString();

        //$itemsspoiled = Item::withSum('spoiledSeries', 'quantity')
        //->paginate(5)
        //->withQueryString();

        return view('items.index', [
            'items' => $items,
        ]);

        //dd($items->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'item_code' => ['required'],
            'item_desc' => ['required'],
            'quantity' => ['required']
        ]);
        
        Item::create($request->all());
        
        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $itemOrders = ItemOrder::where('item_id',$id)->get();
        
        $item = Item::withSum(['requisitions' => function ($query) 
        { $query->where('status', 'done'); }], 'item_requisition.in_pcs')
        ->withSum('spoiledForms', 'quantity')
        ->findOrFail($id);

        return view('items.edit', [
            'item' => $item,
            'itemOrders' => $itemOrders,
            //'requisitionCount' => $requisitionCount,
        ]);

        //dd($count->all());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        
        return redirect(route('items.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect(route('items.index'));
    }

    public function addstock(Request $request, Item $item, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'cv_no' => 'required|string',
            'add_quantity' => 'required|integer',
            'date_purchase' => 'required|date',
            'remarks_purchase' => 'required|string',
        ]);

        $item = Item::findOrFail($id);
        
        // Update the user's basic information
        $item->quantity = $validatedData['add_quantity'] + $item->quantity;
        $item->save(); // Save the changes

        ItemOrder::create([
            'item_id' => $item->id,
            'cv_no' => $validatedData['cv_no'],
            'add_stock' => $validatedData['add_quantity'],
            'date_purchase' => $validatedData['date_purchase'],
            'order_remarks' => $validatedData['remarks_purchase'],
            'user_id' => Auth::id(),
        ]);

        return redirect(route('items.index'));
    }
}
