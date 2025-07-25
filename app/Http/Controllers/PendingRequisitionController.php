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
use App\Models\NumberSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ForApprovalBondsMail;
use App\Mail\ForApprovalUwMail;
use App\Mail\ForApprovalRequisitionAgencyMail;
use App\Mail\ForApprovalRequisitionBranchMail;
use App\Mail\CancelRequisitionMail;
use Illuminate\Support\Facades\Mail;

class PendingRequisitionController extends Controller
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

            //$requisitions = Requisition::withCount('items')
            //->where(function ($query) {
            //    $query->where('status', '=', 'pending')
            //        ->where('finalapproval_status', '=', 'no');
            //})->orWhere(function ($query) {
            //    $query->where('status', '=', 'pending')
            //    ->where('finalapproval_status', '=', 'return');
            //})
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $requisitions = Requisition::withCount('items')
                ->whereIn('status', ['pending', 'return'])
                ->where(function ($query) {
                    $query->where('finalapproval_status', 'no')
                        ->orWhere('finalapproval_status', 'return')
                        ->orWhere('finalapproval_status', 'approved');
                })
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->withQueryString();

            return view('pendingrequisitions.index', [
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

            //$requisitions = Requisition::withCount('items')
            //->whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            //);})
            //->where('status', '=', 'pending')
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $requisitions = Requisition::withCount('items')
            ->whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);
                });
            })
            ->whereIn('status', ['pending', 'return'])
            ->where(function ($query) {
                $query->where('finalapproval_status', 'no')
                    ->orWhere('finalapproval_status', 'return')
                    ->orWhere('finalapproval_status', 'approved');
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

            return view('pendingrequisitions.index', [
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
            ->count();;

            //$requisitions = Requisition::withCount('items')
            //->whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->where('type_office', 'Agency');}
            //);})
            //->where('status', '=', 'pending')
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $requisitions = Requisition::withCount('items')
            ->whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');
                });
            })
            ->whereIn('status', ['pending', 'return'])
            ->where(function ($query) {
                $query->where('finalapproval_status', 'no')
                    ->orWhere('finalapproval_status', 'return')
                    ->orWhere('finalapproval_status', 'approved');
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();


            return view('pendingrequisitions.index', [
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

        //Initial Approver TMEC Access
         elseif ($roleId === 15){
            $branches = branch::all();
            $users = User::all();

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
            ->count();;

            //$requisitions = Requisition::withCount('items')
            //->whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->where('type_office', 'TMEC');}
            //);})
            //->where('status', '=', 'pending')
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $requisitions = Requisition::withCount('items')
            ->whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');
                });
            })
            ->whereIn('status', ['pending', 'return'])
            ->where(function ($query) {
                $query->where('finalapproval_status', 'no')
                    ->orWhere('finalapproval_status', 'return')
                    ->orWhere('finalapproval_status', 'approved');
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();


            return view('pendingrequisitions.index', [
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
            ->where('status', '=', 'pending')
            ->where('user_id', $userId)
            ->count();

        $cocapprovalCount = Requisition::withCount('items')
            ->where('cocapproval_status', '=', 'for approval')
            ->where('status', '=', 'pending')
            ->where('user_id', $userId)
            ->count();

        $requisitions = Requisition::withCount('items')
            ->where('status', '=', 'pending')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

            return view('pendingrequisitions.index', [
                'requisitions' => $requisitions,
                'branches'=> $branches,
                'users'=> $users,
                'pendingrequisitionCount' => $pendingrequisitionCount,
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

    public function show(Requisition $pendingrequisition)
    {
        $requisitionid = $pendingrequisition->id;
        
        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $pendingrequisition->items->pluck('pivot');

        return view('pendingrequisitions.show', [
            'requisition' => $pendingrequisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }

    public function edit(Requisition $pendingrequisition)
    {
        $requisitionid = $pendingrequisition->id;

        $attachments = RequisitionAttachment::where('requisition_id',$requisitionid)->get();
        $remarks = RequisitionRemarks::where('requisition_id',$requisitionid)->get();
        $items = Item::all();
        $requisitionItems = $pendingrequisition->items->pluck('pivot');

        return view('pendingrequisitions.edit', [
            'requisition' => $pendingrequisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
            'remarks' => $remarks,
            'attachments' => $attachments,
        ]);
    }


    public function update(UpdateRequisitionRequest $request, Requisition $pendingrequisition)
    {
        $pendingrequisition->update([
            //'branch_code'=> $request->branch_code,
            //'req_no' => $request->req_no,
            //'req_date' => $request->req_date,
            //'status' => $request->status,
            //'bonds_status' => $request->bonds_status,
            //'uw_status' => $request->uw_status,
            'type_request' => $request->type_request,
            'replenishment_month' => $request->replenishment_month,
            'replenishment_year' => $request->replenishment_year,
        ]);
        
        $pendingrequisition->items()->detach();

        foreach($request->items as $item) {

            if ($item['quantity_unit'] === 'Pad'){
                $pendingrequisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'] * 50,
                    'unreported'  => $item['unreported']
                ]);
            } else {
                $pendingrequisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'],
                    'unreported'  => $item['unreported']
                ]);
            }
        }
        
        session()->flash('success', 'Requisition Sucessfully Created!');
        
        return redirect()->back()->with('success', 'Action was successful!');

        //return redirect()->route('pendingrequisitions.index')->with('success', 'Requisition created successfully');
    }



    
    public function updateforapproval(UpdateRequisitionRequest $request, Requisition $pendingrequisition, RequisitionRemarks $remarks, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'bonds_status_modal' => 'required|string|max:255', // Password is optional, but must be confirmed
            'uw_status_modal' => 'required|string|max:255', // Password is optional, but must be confirmed
            'finalapproval_status_modal' => 'required|string|max:255', // Password is optional, but must be confirmed
        ]);

        $bondStatus = $request->bonds_status_modal;
        $uwStatus = $request->uw_status_modal;
        $finalapproval_status = $request->finalapproval_status_modal;

        

        // Find the user record in the database
        $pendingrequisition = Requisition::findOrFail($id);
        $type_office = $pendingrequisition->user->branch->type_office;
        
        // Update the user's basic information
        $pendingrequisition->bonds_status = $validatedData['bonds_status_modal'];
        $pendingrequisition->uw_status = $validatedData['uw_status_modal'];
        $pendingrequisition->finalapproval_status = $validatedData['finalapproval_status_modal'];
        $pendingrequisition->save(); // Save the changes

        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $rolename = $user->role->name;

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        RequisitionRemarks::create([
            'requisition_id' => $pendingrequisition->id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'role_name' => $rolename,
        ]);

        if ($bondStatus === 'for approval'){
            Mail::to('ronald.ladion@milestoneguaranty.com')->send(new ForApprovalBondsMail($pendingrequisition));
        } 
        
        if ($uwStatus === 'for approval'){
            Mail::to('allan.quing@milestoneguaranty.com')->send(new ForApprovalUwMail($pendingrequisition));
        }

        //For Final Approval Email Notification
        if ($finalapproval_status === 'for approval') {
            if ($type_office === 'Branch' || $type_office === 'TMEC'){
                Mail::to('victor.peco@milestoneguaranty.com')->send(new ForApprovalRequisitionBranchMail($pendingrequisition));
                Mail::to('jairo.aquino@milestoneguaranty.com')->send(new ForApprovalRequisitionAgencyMail($pendingrequisition));
            } else {
                Mail::to('victor.peco@milestoneguaranty.com')
                ->cc('hazel.cruz@milestoneguaranty.com')
                ->send(new ForApprovalRequisitionAgencyMail($pendingrequisition));
            }
        }
        
        

        return redirect()->route('pendingrequisitions.index')->with('success', 'Requisition created successfully');
    }

    public function updateforcancel(UpdateRequisitionRequest $request, $id)
    {
        $pendingrequisition = Requisition::findOrFail($id);
        $pendingrequisition->status = 'cancelled';
        $pendingrequisition->save(); // Save the changes


        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $rolename = $user->role->name;

        RequisitionRemarks::create([
            'requisition_id' => $pendingrequisition->id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'role_name' => $rolename,
        ]);
        
        //$emailto = $pendingrequisition->user->email;
        //Mail::to($emailto )->send(new CancelRequisitionMail($pendingrequisition));

        return redirect()->route('pendingrequisitions.index')->with('success', 'Requisition cancelled successfully');
    }

    public function resubmitcoll(UpdateRequisitionRequest $request, $id)
    {

        $type_request = $request->type_request;

        $pendingrequisition = Requisition::findOrFail($id);
        $pendingrequisition->status = 'pending';
        $pendingrequisition->collasst_status = 'for approval';
        $pendingrequisition->collmanager_status = 'for approval';
        $pendingrequisition->save(); // Save the changes


        $user = auth()->user(); // Get the authenticated user
        $userId = $user->id;
        $rolename = $user->role->name;

        RequisitionRemarks::create([
            'requisition_id' => $pendingrequisition->id,
            'content' => $request->content, // now coming from the hidden input
            'user_id' => Auth::id(),
            'role_name' => $rolename,
        ]);
        
        //$emailto = $pendingrequisition->user->email;
        //Mail::to($emailto )->send(new CancelRequisitionMail($pendingrequisition));

        return redirect()->route('pendingrequisitions.index')->with('success', 'Requisition Re-submit successfully');
    }

    public function getUnreportedCountReviewer(Request $request)
    {
        $itemId = $request->input('item_id');

        //$user = auth()->user(); // Get the authenticated user
        $branchcode = $pendingrequisition->user->branch->branch_code; // Get the user's branch code
       
        if (!$itemId) {
            return response()->json(['count' => 0]);
        }

        $count = NumberSeries::where('item_id', $itemId)
            ->where('branch_code', $branchcode)
            ->where('number_status', '=', 'Unused')
            ->count();

        return response()->json(['count' => $count]);
    }

    public function iastoreattachment(Request $request, Requisition $requisition)
    {
        // Validate the request data, including the file
        $validated = $request->validate([
            'file_path' => 'required|mimes:xlsx,xls,csv,pdf|max:2048',  // Validate file type and size
        ]);

        // Handle the file upload
        if ($request->hasFile('file_path')) {
            // Store the file in the 'uploads' folder in the 'public' disk
            $filePath = $request->file('file_path')->store('uploads', 'public');
        }

        // Create the requisition with the file path
        $pendingrequisitionAttachment = RequisitionAttachment::create([
            'requisition_id' => $request->req_id,
            'file_path' => $filePath ?? null, // Save the file path in the database
        ]);

        return back()->with('success', 'File has been uploaded successfully!');
    }

}
