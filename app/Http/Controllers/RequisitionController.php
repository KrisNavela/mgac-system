<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Requisition;
use App\Models\Item;
use App\Models\branch;
use App\Models\User;
use App\Models\RequisitionRemarks;
use App\Models\RequisitionAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RequisitionCreatedMail;
use App\Mail\ForApprovalRequisitionAgencyMail;
use App\Mail\ForApprovalRequisitionBranchMail;
use Illuminate\Support\Facades\Mail;


class RequisitionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $roleId = $user->role_id;
        
        //Admin Access
        if ($roleId === 1 || $roleId === 5) {
            $branches = branch::all();
            $users = User::all();

            $requisitionsCount = Requisition::withCount('items')
            ->orderBy('id', 'desc')
            ->count();

            $pendingrequisitionCount = Requisition::where('status', '=', 'pending')->count();

            $uwapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->count();

            $collmngapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->count();

            $cancelrequisitionsCount = Requisition::withCount('items')
            ->where('status', '=', 'Cancelled')
            ->count();

            //$approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->where('type_office', 'Agency');}
            //);})
            //->where('finalapproval_status', '=', 'for approval')
            //->count();

            $approvedrequisitionsCount = Requisition::withCount('items')
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $requisitions = Requisition::withCount('items')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

            return view('requisitions.index', [
                'requisitions' => $requisitions,
                'branches'=> $branches,
                'users'=> $users,
                'requisitionsCount' => $requisitionsCount,
                'pendingrequisitionCount' => $pendingrequisitionCount,
                'uwapprovalCount' => $uwapprovalCount,
                'bondsapprovalCount' => $bondsapprovalCount,
                'collasstapprovalCount' => $collasstapprovalCount,
                'collmngapprovalCount' => $collmngapprovalCount,
                'cancelrequisitionsCount' => $cancelrequisitionsCount,
                'approvedrequisitionsCount' => $approvedrequisitionsCount,
                'roleId' => $roleId,
            ]);
        } elseif ($roleId === 4 || $roleId === 6){
            $branches = branch::all();
            $users = User::all();

            $requisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->count();

            $pendingrequisitionCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('status', '=', 'pending')
            ->count();

            $uwapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->count();

            $collmngapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->count();

            $cancelrequisitionsCount = Requisition::withCount('items')
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $requisitions = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();


            return view('requisitions.index', [
                'requisitions' => $requisitions,
                'branches'=> $branches,
                'users'=> $users,
                'requisitionsCount' => $requisitionsCount,
                'pendingrequisitionCount' => $pendingrequisitionCount,
                'uwapprovalCount' => $uwapprovalCount,
                'bondsapprovalCount' => $bondsapprovalCount,
                'collasstapprovalCount' => $collasstapprovalCount,
                'collmngapprovalCount' => $collmngapprovalCount,
                'cancelrequisitionsCount' => $cancelrequisitionsCount,
                'approvedrequisitionsCount' => $approvedrequisitionsCount,
            ]);

        } elseif ($roleId === 3){
            $branches = branch::all();
            $users = User::all();

            $requisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->count();

            $pendingrequisitionCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('status', '=', 'pending')
            ->count();

            $uwapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->count();

            $collmngapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->count();

            $cancelrequisitionsCount = Requisition::withCount('items')
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $requisitions = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();


            return view('requisitions.index', [
                'requisitions' => $requisitions,
                'branches'=> $branches,
                'users'=> $users,
                'requisitionsCount' => $requisitionsCount,
                'pendingrequisitionCount' => $pendingrequisitionCount,
                'uwapprovalCount' => $uwapprovalCount,
                'bondsapprovalCount' => $bondsapprovalCount,
                'collasstapprovalCount' => $collasstapprovalCount,
                'collmngapprovalCount' => $collmngapprovalCount,
                'cancelrequisitionsCount' => $cancelrequisitionsCount,
                'approvedrequisitionsCount' => $approvedrequisitionsCount,
            ]);
        }
        
        //User Access
        $branches = branch::all();
        $users = User::all();

        $requisitionsCount = Requisition::withCount('items')
            ->where('user_id', $userId)
            ->count();

        $pendingrequisitionCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('user_id', $userId)
            ->count();

        $uwapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->count();

        $bondsapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->count();

        $collasstapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->count();
        
        $collmngapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->count();

        $cancelrequisitionsCount = Requisition::withCount('items')
            ->where('status', '=', 'Cancelled')
            ->where('user_id', $userId)
            ->count();

        $approvedrequisitionsCount = Requisition::withCount('items')
            ->where('finalapproval_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->count();

        $requisitions = Requisition::withCount('items')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('requisitions.index', [
                'requisitions' => $requisitions,
                'branches'=> $branches,
                'users'=> $users,
                'requisitionsCount' => $requisitionsCount,
                'pendingrequisitionCount' => $pendingrequisitionCount,
                'uwapprovalCount' => $uwapprovalCount,
                'bondsapprovalCount' => $bondsapprovalCount,
                'collasstapprovalCount' => $collasstapprovalCount,
                'collmngapprovalCount' => $collmngapprovalCount,
                'cancelrequisitionsCount' => $cancelrequisitionsCount,
                'approvedrequisitionsCount' => $approvedrequisitionsCount,
                'roleId' => $roleId,
            ]);
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $items = Item::all();

        return view('requisitions.create', [
            'items'=> $items,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequisitionRequest $request) 
    {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $roleId = $user->role_id;
        $typeOffice = $user->branch->type_office;


        $type_request = $request->type_request;

        if ($type_request === 'Replenishment'){
            $requisition = Requisition::create([
                'req_date' => $request->req_date,
                'type_request' => $request->type_request,
                'collasst_status' => 'for approval',
                'collmanager_status' => 'for approval',
                'replenishment_month' => $request->replenishment_month,
                'replenishment_year' => $request->replenishment_year,
                'user_id' => Auth::id(),
            ]);
        } else {
            $requisition = Requisition::create([
                'req_date' => $request->req_date,
                'type_request' => $request->type_request,
                'collasst_status' => 'no',
                'collmanager_status' => 'no',
                'replenishment_month' => $request->replenishment_month,
                'replenishment_year' => $request->replenishment_year,
                'user_id' => Auth::id(),
            ]);
        }

        foreach($request->items as $item) {

            if ($item['quantity_unit'] === 'Pad'){
                $requisition->items()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'quantity_unit'  => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'] * 50
                ]);
            } else {

                $requisition->items()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'quantity_unit'  => $item['quantity_unit'],
                    'in_pcs' => $item['quantity']
                ]);
            }
        }

        if ($typeOffice === 'Branch'){
            Mail::to('knavela@milestoneguaranty.com')->send(new RequisitionCreatedMail($requisition));
        } else {
            Mail::to('cj.soriano@milestoneguaranty.com')->send(new RequisitionCreatedMail($requisition));
        }

        if ($typeOffice === 'Branch'){
            Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalRequisitionBranchMail($requisition));
        }
            Mail::to('cj.soriano@milestoneguaranty.com')->send(new ForApprovalRequisitionAgencyMail($requisition));
        




        //return redirect()->route('requisitions.index')->with('success', 'Requisition created successfully');
        // Redirect to the edit page for the newly created requisition
        return redirect()->route('requisitions.edit', $requisition->id)
                         ->with('success', 'Requisition created successfully! You can now update it.');

        
    }


    public function storeattachment(Request $request, Requisition $requisition)
    {
        // Validate the request data, including the file
        $validated = $request->validate([
            'file_path' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',  // Validate file type and size
        ]);

        // Handle the file upload
        if ($request->hasFile('file_path')) {
            // Store the file in the 'uploads' folder in the 'public' disk
            $filePath = $request->file('file_path')->store('uploads', 'public');
        }

        // Create the requisition with the file path
        $requisitionAttachment = RequisitionAttachment::create([
            'requisition_id' => $request->req_id,
            'file_path' => $filePath ?? null, // Save the file path in the database
        ]);

        return back()->with('success', 'Data has been saved successfully!');
    }





    /**
     * Display a listing of the resource.
     */

    public function show(Requisition $requisition)
    {

        $requisitionid = $requisition->id;

        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $requisition->items->pluck('pivot');

        return view('requisitions.show', [
            'requisition' => $requisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requisition $requisition)
    {

        $requisitionid = $requisition->id;

        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $requisition->items->pluck('pivot');

        return view('requisitions.edit', [
            'requisition' => $requisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'attachments' => $attachments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequisitionRequest $request, Requisition $requisition)
    {
        $requisition->update([
            'req_no' => $request->req_no,
            'req_date' => $request->req_date,
            'status' => $request->status,
            'type_request' => $request->type_request,
            'replenishment_month' => $request->replenishment_month,
            'replenishment_year' => $request->replenishment_year,
        ]);
        
        $requisition->items()->detach();

        foreach($request->items as $item) {

            if ($item['quantity_unit'] === 'Pad'){
                $requisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'] * 50
                ]);
            } else {
                $requisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity']
                ]);
            }
        }
        
        return redirect()->route('requisitions.index')->with('success', 'Requisition created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();

        return redirect()->route('requisitions.index')->with('success', 'Requisition created successfully');
    }
}
