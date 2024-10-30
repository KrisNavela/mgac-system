<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Requisition;
use App\Models\Item;
use App\Models\branch;
use App\Models\RequisitionRemarks;
use App\Models\User;
use App\Models\RequisitionAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForBondApprovalRequisitionController extends Controller
{
    public function index(Request $request)
    {

        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $roleId = $user->role_id;
        
        //Admin Access
        if ($roleId === 1) {
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

            $approvedrequisitionsCount = Requisition::withCount('items')
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $requisitions = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('forbondapprovalrequisitions.index', [
                'requisitions' => $requisitions,
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
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('forbondapprovalrequisitions.index', [
                'requisitions' => $requisitions,
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

    public function show(Requisition $forbondapprovalrequisition)
    {
        $requisitionid = $forbondapprovalrequisition->id;
        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $forbondapprovalrequisition->items->pluck('pivot');

        return view('forbondapprovalrequisitions.show', [
            'requisition' => $forbondapprovalrequisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }

    public function edit(Requisition $forbondapprovalrequisition)
    {
        $requisitionid = $forbondapprovalrequisition->id;

        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $forbondapprovalrequisition->items->pluck('pivot');

        return view('forbondapprovalrequisitions.edit', [
            'requisition' => $forbondapprovalrequisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }


    public function update(UpdateRequisitionRequest $request, Requisition $forbondapprovalrequisition)
    {
        $forbondapprovalrequisition->update([
            'branch_code'=> $request->branch_code,
            'req_no' => $request->req_no,
            'req_date' => $request->req_date,
            'status' => $request->status,
            'bonds_status' => $request->bonds_status,
            //'uw_status' => $request->uw_status,
        ]);
        
        $forbondapprovalrequisition->items()->detach();

        foreach($request->items as $item) {
            $forbondapprovalrequisition->items()->attach($item['item_id'], ['quantity' => $item['quantity']]);
        }
        
        return redirect()->route('forbondapprovalrequisitions.index')->with('success', 'Requisition created successfully');
    }

    // Method to update additional user information (password, profile picture)
    public function updatebondapproval(UpdateRequisitionRequest $request, Requisition $forbondapprovalrequisition, RequisitionRemarks $remarks, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'bonds_status_modal' => 'required|string|max:255', // Password is optional, but must be confirmed
            'uw_status_modal' => 'required|string|max:255', // Password is optional, but must be confirmed
        ]);

        // Find the user record in the database
        $forbondapprovalrequisition = Requisition::findOrFail($id);

        // Update the user's basic information
        $forbondapprovalrequisition->bonds_status = $validatedData['bonds_status_modal'];
        $forbondapprovalrequisition->uw_status = $validatedData['uw_status_modal'];
        $forbondapprovalrequisition->save(); // Save the changes

        RequisitionRemarks::create([
            'requisition_id' => $forbondapprovalrequisition->id,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

         return redirect()->route('forbondapprovalrequisitions.index')->with('success', 'Requisition created successfully');
    }
}
