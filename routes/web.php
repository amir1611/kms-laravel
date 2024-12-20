<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KioskController;






Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Auth::routes(['verify' => true]);


//ALL ROUTES FOR PUPUK ADMIN
Route::prefix('pupuk-admin')->name('pupuk.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:pupuk-admin']], function () {

        //manageAccount
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('/profile', [HomeController::class, 'indexPupukAdmin'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-staff');
        Route::get('/', [HomeController::class, 'indexPupukAdmin'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
        Route::get('/view-users', [UserController::class, 'viewUsers'])->name('view-users');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        //manageKiosk
        Route::get('/kiosk-application', [KioskController::class, 'viewKioskApplication'])->name('viewKioskApplication');
        Route::get('/view-application-approval/{id}', [KioskController::class, 'viewApplicationApproval'])->name('viewApplicationApproval');
        Route::post('/process-application/{id}', [KioskController::class, 'processApplication'])->name('processApplication');
        Route::get('/view-application/{id}', [KioskController::class, 'viewApplication'])->name('viewApplication');
        Route::get('/kiosk-participant', [KioskController::class, 'viewKioskParticipant'])->name('viewKioskParticipant');
        Route::get('/pupuk/deleteKiosk/{id}', [KioskController::class, 'deleteKiosk'])->name('deleteKiosk');
        Route::get('/pupuk/updateApplicationStatus/{id}', [KioskController::class, 'updateApplicationStatus'])->name('updateApplicationStatus');
   
             
                //manageReport
                Route::get('/viewMonthlyReportList', [ReportController::class, 'viewAllReport'])->name('reportList');
                Route::get('/uploadMonthlyReport', [ReportController::class, 'showKioskListById'])->name('uploadReport');
                Route::post('/uploadReportData', [ReportController::class, 'uploadReportData'])->name('uploadReportData');
                Route::get('/viewMonthReport/{id}', [ReportController::class, 'viewReport'])->name('viewReport');
                Route::get('/updateMonthReport/{id}', [ReportController::class, 'displayEditKioskParticipantReport'])->name('updateReport');
                Route::post('/updateMonthReport/{id}', [ReportController::class, 'editKioskParticipantReport'])->name('editReport');
                Route::get('/filter/{filterData}', [ReportController::class, 'filterTable'])->name('filterSec');
                Route::get('/search', [ReportController::class, 'searchReport'])->name('searchReport');
   
    });
});




//ALL ROUTES FOR KIOSK PARTICIPANT
Route::prefix('user')->name('user.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:user']], function () {

        //manageAccount
        Route::get('/profile', [HomeController::class, 'indexUser'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-user');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');

        //manageKiosk
        Route::get('/applyKiosk', [KioskController::class, 'showApplyKioskForm'])->name('applyKiosk');
        Route::post('/applyKiosk', [KioskController::class, 'applyKiosk'])->name('submitApplyKiosk');
        Route::get('/applyForReject', [KioskController::class, 'rejectApplication'])->name('rejectApplication');
        Route::put('/update-kiosk/{id}', [KioskController::class, 'updateKiosk'])->name('updateKiosk');

        //manageReport
        Route::get('/viewMonthlyReportList', [ReportController::class, 'viewAllKioskParticipantReport'])->name('reportList');
        Route::get('/uploadMonthlyReport', [ReportController::class, 'showKioskListById'])->name('uploadReport');
        Route::post('/uploadReportData', [ReportController::class, 'uploadReportData'])->name('uploadReportData');
        Route::get('/viewMonthReport/{id}', [ReportController::class, 'viewReport'])->name('viewReport');
        Route::get('/updateMonthReport/{id}', [ReportController::class, 'displayEditKioskParticipantReport'])->name('updateReport');
        Route::post('/updateMonthReport/{id}', [ReportController::class, 'editKioskParticipantReport'])->name('editReport');
        Route::get('/deleteMonthReport/{id}', [ReportController::class, 'deleteKioskParticipantReport'])->name('deleteReport');
        Route::get('/filter/{filterData}', [ReportController::class, 'filterTable'])->name('filterSec');
        Route::get('/search', [ReportController::class, 'searchReport'])->name('searchReport');


      
    });
});



