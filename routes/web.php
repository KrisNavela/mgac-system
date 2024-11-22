<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\PendingRequisitionController;
use App\Http\Controllers\ApprovedRequisitionController;
use App\Http\Controllers\CancelledRequisitionController;
use App\Http\Controllers\ForBondApprovalRequisitionController;
use App\Http\Controllers\ForUWApprovalRequisitionController;
use App\Http\Controllers\CollectionAsstRequisitionController;
use App\Http\Controllers\CollectionMngRequisitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForTransmittalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpoiledFormController;
use App\Http\Controllers\COCApprovalController;
use App\Http\Controllers\TreasuryApprovalController;


Route::get('/', function () {
    return redirect()->route('login');  // Redirect root URL to login
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('items', ItemController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('requisitions', RequisitionController::class);
    Route::resource('users', UserController::class);
    Route::resource('spoiledforms', SpoiledFormController::class);


    Route::resource('pendingrequisitions', PendingRequisitionController::class);
    Route::resource('fortransmittal', ForTransmittalController::class);
    Route::resource('approvedrequisitions', ApprovedRequisitionController::class);
    Route::resource('cancelrequisitions', CancelledRequisitionController::class);
    Route::resource('forbondapprovalrequisitions', ForBondApprovalRequisitionController::class);
    Route::resource('foruwapprovalrequisitions', ForUWApprovalRequisitionController::class);
    Route::resource('collasstrequisitions', CollectionAsstRequisitionController::class);
    Route::resource('collmngrequisitions', CollectionMngRequisitionController::class);
    Route::resource('cocapprovalrequisitions', COCApprovalController::class);
    Route::resource('treasuryapprovalrequisitions', TreasuryApprovalController::class);


    Route::put('/pendingrequisitions/{id}/update-forapproval', [PendingRequisitionController::class, 'updateforapproval'])->name('pendingrequisitions.update.forapproval');
    Route::put('/pendingrequisitions/{id}/update-forfinalapproval', [PendingRequisitionController::class, 'updateforfinalapproval'])->name('pendingrequisitions.update.forfinalapproval');

    Route::put('/approvedrequisitions/{id}/update-approval', [ApprovedRequisitionController::class, 'updateapproval'])->name('approvedrequisitions.update.approval');
    Route::put('/foruwapprovalrequisitions/{id}/update-uwapproval', [ForUWApprovalRequisitionController::class, 'updateuwapproval'])->name('foruwapprovalrequisitions.update.uwapproval');
    Route::put('/forbondapprovalrequisitions/{id}/update-bondapproval', [ForBondApprovalRequisitionController::class, 'updatebondapproval'])->name('forbondapprovalrequisitions.update.bondapproval');
    Route::put('/collasstrequisitions/{id}/update-collasstapproval', [CollectionAsstRequisitionController::class, 'updatecollasstapproval'])->name('collasstrequisitions.update.collasstapproval');
    Route::put('/collmngrequisitions/{id}/update-collmngapproval', [CollectionMngRequisitionController::class, 'updatecollmngapproval'])->name('collmngrequisitions.update.collmngapproval');
    Route::put('/cocapprovalrequisitions/{id}/update-cocapproval', [COCApprovalController::class, 'updatecocapproval'])->name('cocapprovalrequisitions.update.cocapproval');
    Route::put('/treasuryapprovalrequisitions/{id}/update-treasuryapproval', [TreasuryApprovalController::class, 'updatetreasuryapproval'])->name('treasuryapprovalrequisitions.update.treasuryapproval');
    
    Route::put('/items/{id}/update-addstock', [ItemController::class, 'addstock'])->name('items.update.addstock');


    Route::post('/requisitions/storeattachment', [RequisitionController::class, 'storeattachment'])->name('requisitions.storeattachment');

    Route::get('/fortransmittal/{id}/print', [ForTransmittalController::class, 'printPDF'])->name('fortransmittal.printPDF');
});

require __DIR__.'/auth.php';
