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
use App\Models\NumberSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RequisitionCreatedMail;
use App\Mail\ForApprovalRequisitionAgencyMail;
use App\Mail\ForApprovalRequisitionBranchMail;
use App\Mail\ForApprovalCollAsstMail;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
            //->where('finalapproval_status', '=', 'approved')
            ->where('treasuryapproval_status', '=', 'for approval')
            ->count();

            $cocapprovalCount = Requisition::withCount('items')
            //->where('finalapproval_status', '=', 'approved')
            ->where('cocapproval_status', '=', 'for approval')
            ->count();

            //$requisitions = Requisition::withCount('items')
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $search = request('search');

            $requisitions = Requisition::withCount('items')
                ->when($search, function ($query) use ($search) {
                    $query->where('req_no', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%");
                })
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
                'search' => $search,

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
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->whereIn('type_office', ['Branch', 'TMEC']);}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            //$requisitions = Requisition::withCount('items')
            //->whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->where('type_office', 'Branch');}
            //);})
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $search = request('search');

            $requisitions = Requisition::withCount('items')
                ->whereHas('user', function ($query) {
                    $query->whereHas('branch', function ($query1) {
                        $query1->whereIn('type_office', ['Branch', 'TMEC']);
                    });
                })
                ->when($search, function ($query) use ($search) {
                    $query->where('req_no', 'like', "%$search%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%"); // Searching by user name
                        })
                        ->orWhere('status', 'like', "%$search%"); // Searching by status
                })
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
                'search' => $search,
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
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'Agency');}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            //$requisitions =  Requisition::withCount('items')
            //->whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->where('type_office', 'Agency');}
            //);})
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $search = request('search');

            $requisitions = Requisition::withCount('items')
                ->whereHas('user', function ($query) {
                    $query->whereHas('branch', function ($query1) {
                        $query1->where('type_office', 'Agency');
                    });
                })
                ->when($search, function ($query) use ($search) {
                    $query->where('req_no', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%"); // Adjust based on your column
                        });
                })
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
                'search' => $search,
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
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            $cocapprovalCount = Requisition::whereHas('user', function ($query) {
                $query->whereHas('branch', function ($query1) {
                    $query1->where('type_office', 'TMEC');}
            );})
            ->where('cocapproval_status', '=', 'for approval')
            //->where('finalapproval_status', '=', 'approved')
            ->count();

            //$requisitions =  Requisition::withCount('items')
            //->whereHas('user', function ($query) {
            //    $query->whereHas('branch', function ($query1) {
            //        $query1->where('type_office', 'Agency');}
            //);})
            //->orderBy('id', 'desc')
            //->paginate(10)
            //->withQueryString();

            $search = request('search');

            $requisitions = Requisition::withCount('items')
                ->whereHas('user', function ($query) {
                    $query->whereHas('branch', function ($query1) {
                        $query1->where('type_office', 'TMEC');
                    });
                })
                ->when($search, function ($query) use ($search) {
                    $query->where('req_no', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%$search%"); // Adjust based on your column
                        });
                })
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
                'search' => $search,
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

        //$requisitions = Requisition::withCount('items')
        //    ->where('user_id', $userId)
        //    ->orderBy('id', 'desc')
        //    ->paginate(5)
        //    ->withQueryString();

        $search = request('search');

        $requisitions = Requisition::withCount('items')
            ->where('user_id', $userId)
            ->when($search, function ($query) use ($search) {
                $query->where('req_no', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");
            })
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
                'search' => $search,
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
        $coc_request_status = $request->coc_request_status;
        
        if ($type_request === 'Replenishment'){
            
            $requisition = Requisition::create([
                'req_date' => Carbon::now('Asia/Manila')->format('Y-m-d H:i:s'),
                'type_request' => $request->type_request,
                'coc_request_status' => $request->coc_request_status,
                'collasst_status' => 'for approval',
                'collmanager_status' => 'for approval',
                'replenishment_month' => $request->replenishment_month,
                'replenishment_year' => $request->replenishment_year,
                'cocapproval_status' =>  'no',
                'treasuryapproval_status' => 'no',
                'user_id' => Auth::id(),
                'remarks' => $request->remarks,
            ]);


        } else {

            if ($roleId === 14){

                $requisition = Requisition::create([
                    'req_date' => Carbon::now('Asia/Manila')->format('Y-m-d H:i:s'),
                    'type_request' => $request->type_request,
                    'coc_request_status' => $request->coc_request_status,
                    'replenishment_month' => $request->replenishment_month,
                    'replenishment_year' => $request->replenishment_year,
                    'collasst_status' => 'no',
                    'collmanager_status' => 'no',
                    'cocapproval_status' =>  'no',
                    'treasuryapproval_status' => 'for approval',
                    'user_id' => Auth::id(),
                    'remarks' => $request->remarks,
                ]);

            } else {

                $requisition = Requisition::create([
                    'req_date' => Carbon::now('Asia/Manila')->format('Y-m-d H:i:s'),
                    'type_request' => $request->type_request,
                    'coc_request_status' => $request->coc_request_status,
                    'replenishment_month' => $request->replenishment_month,
                    'replenishment_year' => $request->replenishment_year,
                    'collasst_status' => 'no',
                    'collmanager_status' => 'no',
                    'cocapproval_status' =>  'no',
                    'treasuryapproval_status' => 'no',
                    'user_id' => Auth::id(),
                    'remarks' => $request->remarks,
                ]);
            }

        }

        foreach($request->items as $item) {

            if ($item['quantity_unit'] === 'Pad'){
                $requisition->items()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'quantity_unit'  => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'] * 50,
                    'unreported'  => $item['unreportedCount']
                ]);
            } else {

                $requisition->items()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'quantity_unit'  => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'],
                    'unreported'  => $item['unreportedCount']
                ]);
            }
        }

        //For Reviewer Email Notification
        if ($typeOffice === 'Branch' || $typeOffice === 'TMEC'){
            Mail::to('hannahfaith.yamano@milestoneguaranty.com')->send(new RequisitionCreatedMail($requisition));
        } else {
            Mail::to('hazel.cruz@milestoneguaranty.com')->send(new RequisitionCreatedMail($requisition));
        }

        //For Final Approval Email Notification
        //if ($typeOffice === 'Branch'){
        //    Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalRequisitionBranchMail($requisition));
        //    Mail::to('cj.soriano@milestoneguaranty.com')->send(new ForApprovalRequisitionAgencyMail($requisition));
        //} else {
        //    Mail::to('cj.soriano@milestoneguaranty.com')->send(new ForApprovalRequisitionAgencyMail($requisition));
        //}

        //if ($type_request === 'Replenishment'){
        //    Mail::to('knavela@milestoneguaranty.com')->send(new ForApprovalCollAsstMail($requisition));
        //}


        

        //return redirect()->route('requisitions.index')->with('success', 'Requisition created successfully');
        // Redirect to the edit page for the newly created requisition
        return redirect()->route('requisitions.edit', $requisition->id);
    }


    public function storeattachment(Request $request, Requisition $requisition)
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
        $requisitionAttachment = RequisitionAttachment::create([
            'requisition_id' => $request->req_id,
            'file_path' => $filePath ?? null, // Save the file path in the database
        ]);

        return back()->with('success', 'File has been uploaded successfully!');
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
            'coc_request_status' => $request->coc_request_status,
            'type_request' => $request->type_request,
            'replenishment_month' => $request->replenishment_month,
            'replenishment_year' => $request->replenishment_year,
            'remarks' => $request->remarks,
        ]);
        
        $requisition->items()->detach();

        foreach($request->items as $item) {

            if ($item['quantity_unit'] === 'Pad'){
                $requisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'] * 50,
                    'unreported'  => $item['unreported']
                ]);
            } else {
                $requisition->items()->attach($item['item_id'], [
                    'quantity' => $item['quantity'], 
                    'quantity_unit' => $item['quantity_unit'],
                    'in_pcs' => $item['quantity'],
                    'unreported'  => $item['unreported']
                ]);
            }
        }
        
        session()->flash('success', 'Requisition Sucessfully Created!');
        
        return redirect()->route('requisitions.index');
    }

    public function getUnreportedCount(Request $request)
    {
        $itemId = $request->input('item_id');

        $user = auth()->user(); // Get the authenticated user
        $branchcode = $user->branch->branch_code; // Get the user's branch code

        if (!$itemId) {
            return response()->json(['count' => 0]);
        }

        $count = NumberSeries::where('item_id', $itemId)
            ->where('branch_code', $branchcode)
            ->where('number_status', '=', 'Unused')
            ->count();

        return response()->json(['count' => $count]);
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
