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
use App\Http\Controllers\NumberSeriesController;
use App\Http\Controllers\ImportSeriesController;
use App\Http\Controllers\DoneRequisitionController;


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
    Route::resource('numberseries', NumberSeriesController::class);
    Route::resource('donerequisitions', DoneRequisitionController::class);
    
    Route::put('/numberseries/{id}/update-forreported', [NumberSeriesController::class, 'updateforreported'])->name('numberseries.update.forreported');

    Route::put('/pendingrequisitions/{id}/update-forapproval', [PendingRequisitionController::class, 'updateforapproval'])->name('pendingrequisitions.update.forapproval');
    Route::get('/pendingrequisitions/{id}/update-forcancel', [PendingRequisitionController::class, 'updateforcancel'])->name('pendingrequisitions.update.forcancel');

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
    
    Route::get('/get-unreported-count', [RequisitionController::class, 'getUnreportedCount']);
    Route::get('/get-unreported-count-reviewer', [PendingRequisitionController::class, 'getUnreportedCountReviewer']);
    Route::post('/import-series', [ImportSeriesController::class, 'importSeries'])->name('import.series');
    Route::get('/foruwapprovalrequisitions/{id}/approved-uwapproval', [ForUWApprovalRequisitionController::class, 'approveduwapproval'])->name('foruwapprovalrequisitions.approved.uwapproval');
    Route::get('/forbondapprovalrequisitions/{id}/approved-bondapproval', [ForBondApprovalRequisitionController::class, 'approvedbondapproval'])->name('forbondapprovalrequisitions.approved.bondapproval');
    Route::get('/approvedrequisitions/{id}/approved-finalapproval', [ApprovedRequisitionController::class, 'approvedfinalapproval'])->name('approvedrequisitions.approved.finalapproval');
});

require __DIR__.'/auth.php';
