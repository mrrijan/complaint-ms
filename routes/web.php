<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplaintStatusLogController;
use App\Http\Controllers\ComplaintTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum"])->get('/', [DashboardController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::get('/dashboard', function () {
    return view('frontend.pages.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//for customers
Route::middleware(["auth:sanctum"])->get("/complaints", [ComplaintController::class, 'index']);
Route::middleware(["auth:sanctum"])->post("/complaint/store", [ComplaintController::class, 'store']);
Route::middleware(["auth:sanctum"])->get("/complaint/view/{complaint_id}", [ComplaintController::class, 'show']);
Route::middleware(["auth:sanctum"])->post("/complaint/update/{complaint_id}", [ComplaintController::class, 'update']);
Route::middleware(["auth:sanctum"])->delete("/complaint/delete/{complaint_id}", [ComplaintController::class, 'destroy']);
Route::middleware(["auth:sanctum"])->get("/profile", [DashboardController::class, 'profile']);
Route::middleware(["auth:sanctum"])->post("/password-change", [PasswordController::class, 'update']);
Route::middleware(["auth:sanctum"])->post('/set-password', [PasswordController::class, 'setPassword']);


//for oauth
Route::get('auth/google', [OAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OAuthController::class, 'handleGoogleCallback']);

//for admin
// Route::get("/admin/dashboard", [DashboardController::class, "adminDashboard"]);
Route::middleware(["auth:sanctum"])->get("/admin/complaints", [ComplaintController::class, 'getAdminComplaints']);
Route::middleware(["auth:sanctum"])->get("/admin/complaint/change-status/{complaint_id}", [ComplaintController::class, 'viewComplaint']);
Route::middleware(["auth:sanctum"])->put("/admin/complaint/update", [ComplaintController::class, 'updateComplaint']);

//for admin complaint types
Route::middleware(["auth:sanctum"])->get("/admin/complaint-types", [ComplaintTypeController::class, 'index']);
Route::middleware(["auth:sanctum"])->post("/admin/complaint-types/store", [ComplaintTypeController::class, 'store']);
Route::middleware(["auth:sanctum"])->put("/admin/complaint-types/update/{complaint_type_id}", [ComplaintTypeController::class, 'update']);
Route::middleware(["auth:sanctum"])->delete("/admin/complaint-type/delete/{complaint_type_id}", [ComplaintTypeController::class, 'destroy']);
Route::middleware(["auth:sanctum"])->get("/admin/complaint-logs", [ComplaintStatusLogController::class, 'index']);
Route::get('/admin/logs/export', [ComplaintStatusLogController::class, 'exportLogs'])->name('admin.logs.export');
