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
use App\Mail\ForApprovalCollAsstMail;
use App\Mail\ForTransmittalMail;
use App\Mail\ForApprovalTreasuryMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ApprovedRequisitionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $roleId = $user->role_id;
        
        //Admin, Final Approver Agencies and Branches, Coll Assistant and Collection Manager Access
        if ($roleId === 1 || $roleId === 5 || $roleId === 7 || $roleId === 8 || $roleId === 9 || $roleId === 10 || $roleId === 11 || $roleId === 12 || $roleId === 13) {
            $branches = branch::all();
            $users = User::all();

            $requisitionsCount = Requisition::withCount('items')
            ->orderBy('id', 'desc')
            ->count();

            $pendingrequisitionCount = Requisition::withCount('items')
            ->where(function ($query) {
                $query->where('status', '=', 'pending')
                    ->where('finalapproval_status', '=', 'no');
            })->orWhere(function ($query) {
                $query->where('status', '=', 'pending')
                ->where('finalapproval_status', '=', 'return');
            })
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
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $collmngapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $cancelrequisitionsCount = Requisition::withCount('items')
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::withCount('items')
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $fortransmittalCount = Requisition::withCount('items')
            ->where('status', '=', 'approved')
            ->count();

            $treasuryapprovalCount = Requisition::withCount('items')
            //->where('finalapproval_status', '=', 'approved')
            ->where('treasuryapproval_status', '=', 'for approval')
            ->count();

            $cocapprovalCount = Requisition::withCount('items')
            //->where('finalapproval_status', '=', 'approved')
            ->where('cocapproval_status', '=', 'for approval')
            ->count();

            $requisitions = Requisition::withCount('items')
            ->where('finalapproval_status', '=', 'for approval')
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('approvedrequisitions.index', [
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
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        //Initial approver Branches and Final approver Branches Access
        } elseif ($roleId === 4 || $roleId === 6) {
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
            ->where('finalapproval_status', '=', 'no')
            ->orWhere('finalapproval_status', '=', 'return')
            ->count();

            $uwapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $collmngapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $cancelrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $fortransmittalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('status', '=', 'approved')
            ->count();

            $treasuryapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('treasuryapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();
            
            $requisitions = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Branch');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('approvedrequisitions.index', [
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
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        //Initial Approver Agencies Access
        } elseif ($roleId === 3) {
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
            ->where('finalapproval_status', '=', 'no')
            ->orWhere('finalapproval_status', '=', 'return')
            ->count();

            $uwapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $collmngapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $cancelrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $fortransmittalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('status', '=', 'approved')
            ->count();

            $treasuryapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('treasuryapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            $requisitions = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('approvedrequisitions.index', [
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
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        }


        $branches = branch::all();
        $users = User::all();
        
        $requisitionsCount = Requisition::withCount('items')
            ->where('user_id', $userId)
            ->count();

        $pendingrequisitionCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('finalapproval_status', '=', 'no')
            ->orWhere('finalapproval_status', '=', 'return')
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
            ->where('finalapproval_status', '=', 'approved')
            ->where('user_id', $userId)
            ->count();
        
        $collmngapprovalCount = Requisition::withCount('items')
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
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

        $fortransmittalCount = Requisition::withCount('items')
            ->where('status', '=', 'approved')
            ->where('user_id', $userId)
            ->count();

        $treasuryapprovalCount = Requisition::withCount('items')
            ->where('treasuryapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->where('user_id', $userId)
            ->count();

        $cocapprovalCount = Requisition::withCount('items')
            ->where('cocapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->where('user_id', $userId)
            ->count();

        $requisitions = Requisition::withCount('items')
            ->where('finalapproval_status', '=', 'for approval')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

            return view('approvedrequisitions.index', [
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
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);

    }

    public function show(Requisition $approvedrequisition)
    {
        $requisitionid = $approvedrequisition->id;
        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $approvedrequisition->items->pluck('pivot');

        return view('approvedrequisitions.show', [
            'requisition' => $approvedrequisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }

    public function edit(Requisition $approvedrequisition)
    {
        $requisitionid = $approvedrequisition->id;

        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $approvedrequisition->items->pluck('pivot');

        return view('approvedrequisitions.edit', [
            'requisition' => $approvedrequisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }


    public function update(UpdateRequisitionRequest $request, Requisition $approvedrequisition)
    {
        $approvedrequisition->update([
            //'branch_code'=> $request->branch_code,
            //'req_no' => $request->req_no,
            //'req_date' => $request->req_date,
            //'status' => $request->status,
        ]);
        
        $approvedrequisition->items()->detach();

        foreach($request->items as $item) {

            if ($item['quantity_unit'] === 'Pad'){
                $approvedrequisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'] * 50
                ]);
            } else {
                $approvedrequisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity']
                ]);
            }
        }
        
        session()->flash('success', 'Requisition Sucessfully Created!');
        
        return redirect()->back()->with('success', 'Action was successful!');

        //return redirect()->route('approvedrequisitions.index')->with('success', 'Requisition created successfully');
    }

    
    public function updateapproval(UpdateRequisitionRequest $request, Requisition $approvedrequisition, RequisitionRemarks $remarks, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'finalapproval_status_modal' => 'required|string|max:255', // Password is optional, but must be confirmed
        ]);

        // Find the user record in the database
        $approvedrequisition = Requisition::findOrFail($id);

        $coc_request_status = $approvedrequisition->coc_request_status;

        if ($coc_request_status == 'no'){

            if ($approvedrequisition->type_request === 'Replenishment' ) {
                // Update the user's basic information
                //$approvedrequisition->status = $validatedData['status_modal'];
                $approvedrequisition->finalapproval_status = $validatedData['finalapproval_status_modal'];
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes
                
                Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalCollAsstMail($approvedrequisition));
            
            } else {

                if ($validatedData['finalapproval_status_modal'] == 'return') {
                    $approvedrequisition->status = 'pending';
                } else {
                    $approvedrequisition->status = $validatedData['finalapproval_status_modal'];
                }
                
                $approvedrequisition->finalapproval_status = $validatedData['finalapproval_status_modal'];
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes

                Mail::to('knavela@milestoneguaranty.com')->send(new ForTransmittalMail($approvedrequisition));

            }

        } else {

            if ($approvedrequisition->type_request === 'Replenishment' ) {
                // Update the user's basic information
                //$approvedrequisition->status = $validatedData['status_modal'];
                $approvedrequisition->finalapproval_status = $validatedData['finalapproval_status_modal'];
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes

                Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalCollAsstMail($approvedrequisition));
            
            } else {
                $approvedrequisition->treasuryapproval_status = 'for approval';
                $approvedrequisition->finalapproval_status = $validatedData['finalapproval_status_modal'];
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes
                
                Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalTreasuryMail($approvedrequisition));

            }    

        } 

        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $rolename = $user->role->name;

        RequisitionRemarks::create([
            'requisition_id' => $approvedrequisition->id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'role_name' => $rolename,
        ]);

         return redirect()->route('approvedrequisitions.index')->with('success', 'Requisition created successfully');
    }

    public function approvedfinalapproval(UpdateRequisitionRequest $request, Requisition $approvedrequisition, RequisitionRemarks $remarks, $id)
    {
        // Find the user record in the database
        $approvedrequisition = Requisition::findOrFail($id);






        // Update the user's basic information
        //$foruwapprovalrequisition->bonds_status = $validatedData['bonds_status_modal'];
        //$approvedrequisition->finalapproval_status = 'approved';
        //$approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
        //$approvedrequisition->save(); // Save the changes



        $coc_request_status = $approvedrequisition->coc_request_status;

        if ($coc_request_status == 'no'){

            if ($approvedrequisition->type_request === 'Replenishment' ) {
                // Update the user's basic information
                //$approvedrequisition->status = $validatedData['status_modal'];
                $approvedrequisition->finalapproval_status = 'approved';
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes
                
                Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalCollAsstMail($approvedrequisition));
            
            } else {

                $approvedrequisition->status = 'approved';
                $approvedrequisition->finalapproval_status = 'approved';
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes

                Mail::to('knavela@milestoneguaranty.com')->send(new ForTransmittalMail($approvedrequisition));

            }

        } else {

            if ($approvedrequisition->type_request === 'Replenishment' ) {
                // Update the user's basic information
                //$approvedrequisition->status = $validatedData['status_modal'];
                $approvedrequisition->finalapproval_status = 'approved';
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes

                Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalCollAsstMail($approvedrequisition));
            
            } else {
                $approvedrequisition->treasuryapproval_status = 'for approval';
                $approvedrequisition->finalapproval_status = 'approved';
                $approvedrequisition->finalapproval_date = Carbon::now('Asia/Manila')->format('Y-m-d H:i:s');
                $approvedrequisition->save(); // Save the changes
                
                Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalTreasuryMail($approvedrequisition));

            }    

        }

        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $rolename = $user->role->name;

        RequisitionRemarks::create([
            'requisition_id' => $approvedrequisition->id,
            'content' => 'Approved.',
            'user_id' => Auth::id(),
            'role_name' => $rolename,
        ]);

         return redirect()->route('approvedrequisitions.index')->with('success', 'Requisition created successfully');
    }
}
