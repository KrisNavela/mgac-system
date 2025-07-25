<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Requisition;
use App\Models\Item;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\Status;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $roleId = $user->role_id;
        
        //Admin, Final Approver Agencies and Branches, Coll Assistant and Collection Manager Access
        if ($roleId === 1 || $roleId === 5 || $roleId === 7 || $roleId === 8 || $roleId === 9 || $roleId === 10 || $roleId === 11 || $roleId === 12 || $roleId === 13 || $roleId === 14) {
            $branches = branch::all();
            $users = User::all();
            $roleId = $user->role_id;

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
            ->where('status', '=', 'pending')
            ->where('treasuryapproval_status', '=', 'for approval')
            ->count();

            $cocapprovalCount = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('cocapproval_status', '=', 'for approval')
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
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        //Initial approver Branches and Final approver Branches Access
        } elseif ($roleId === 4 || $roleId === 6){
            $branches = branch::all();
            $users = User::all();
            $roleId = $user->role_id;

            $requisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->count();

            $pendingrequisitionCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('status', '=', 'pending')
            ->where('finalapproval_status', '=', 'no')
            ->orWhere('finalapproval_status', '=', 'return')
            ->count();

            $uwapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $collmngapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $cancelrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $fortransmittalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('status', '=', 'approved')
            ->count();

            $treasuryapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('treasuryapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
            ->count();
    
            $requisitions = Requisition::withCount('items')
            ->whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
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
                'roleId' => $roleId,
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
            
        //Initial Approver Agencies Access
        } elseif ($roleId === 3){
            $branches = branch::all();
            $users = User::all();
            $roleId = $user->role_id;

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
            ->where('status', '=', 'pending')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
            ->count();

            $requisitions = Requisition::withCount('items')
            ->whereHas('user', function ($query) {
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
                'roleId' => $roleId,
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        }

        //Initial Approver Agencies Access
        elseif ($roleId === 15){
            $branches = branch::all();
            $users = User::all();
            $roleId = $user->role_id;

            $requisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->count();

            $pendingrequisitionCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('status', '=', 'pending')
            ->where('finalapproval_status', '=', 'no')
            ->orWhere('finalapproval_status', '=', 'return')
            ->count();

            $uwapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('status', '=', 'pending')
            ->where('uw_status', '=', 'for approval')
            ->count();

            $bondsapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('status', '=', 'pending')
            ->where('bonds_status', '=', 'for approval')
            ->count();

            $collasstapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'for approval')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $collmngapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('type_request', '=', 'replenishment')
            ->where('collasst_status', '=', 'approved')
            ->where('collmanager_status', '=', 'for approval')
            ->where('finalapproval_status', '=', 'approved')
            ->count();

            $cancelrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('status', '=', 'Cancelled')
            ->count();

            $approvedrequisitionsCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('finalapproval_status', '=', 'for approval')
            ->count();

            $fortransmittalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('status', '=', 'approved')
            ->count();

            $treasuryapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('treasuryapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
            ->count();

            $requisitions = Requisition::withCount('items')
            ->whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
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
                'roleId' => $roleId,
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        }
        
        //User Access
        $branches = branch::all();
        $users = User::all();
        $roleId = $user->role_id;

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
            ->where('status', '=', 'pending')
            ->where('user_id', $userId)
            ->count();

        $cocapprovalCount = Requisition::withCount('items')
            ->where('cocapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
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
                'fortransmittalCount' => $fortransmittalCount,
                'treasuryapprovalCount' => $treasuryapprovalCount,
                'cocapprovalCount' => $cocapprovalCount,
            ]);
        

    }
}
