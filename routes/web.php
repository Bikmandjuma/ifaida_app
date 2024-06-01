<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SheikhController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[AdminController::class,'login_form'])->name('login.form');
Route::get('forgot-password',[AdminController::class,'forgot_password'])->name('ForgotPasswordForm');
Route::post('login-functionality',[AdminController::class,'login_functionality'])->name('login-functionality');

//sheikh verify email before registration
Route::get('sheikh/verify-email-before-registration/{email}',[SheikhController::class,'verify_email'])->name('sheikh.verify.email');
Route::post('sheikh/submit_verify-email',[SheikhController::class,'submit_verify_email'])->name('Sheikh.Verify.Email.Before.Registration');
Route::get('sheikh/Sheikh_self_registration_form',[SheikhController::class,'Sheikh_self_registration_form'])->name('Sheikh_self_registration_form');
Route::post('sheikh/sheikh_submit_form_data',[SheikhController::class,'sheikh_submit_form_data'])->name('sheikh_submit_form_data');

Route::group(['middleware'=>'admin'],function(){
    Route::get('logout',[AdminController::class,'logout'])->name('logout');
    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('admin/SheikhManagement',[AdminController::class,'manageSheikh'])->name('manage-sheikh');
    Route::post('admin/send_email_to_sheikh_to_register',[AdminController::class,'send_email_to_sheikh_to_register'])->name('send_email_to_sheikh');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');