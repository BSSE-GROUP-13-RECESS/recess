<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\PatientlistController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RegionallistController;
use App\Http\Controllers\NationallistController;
use App\Http\Controllers\GeneralOfficerController;
use App\Http\Controllers\RegionalOfficerController;
use App\Http\Controllers\NationalOfficerController;
use App\Http\Controllers\OfficerRegistrationController;
use App\Http\Controllers\FundsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/promotions', [PromotionsController::class, 'index'])->name('promotions');
Route::get('/patientlist', [PatientlistController::class, 'index'])->name('patientlist');
Route::get('/payments', [PaymentsController::class, 'index'])->name('payments');
Route::get('/regionallist', [RegionallistController::class, 'index'])->name('regionallist');
Route::get('/nationallist', [NationallistController::class, 'index'])->name('nationallist');
Route::get('/generalOfficers', [GeneralOfficerController::class, 'index'])->name('generalOfficers');
Route::get('/regionalOfficers', [RegionalOfficerController::class, 'index'])->name('regionalOfficers');
Route::get('/nationalOfficers', [NationalOfficerController::class, 'index'])->name('nationalOfficers');
Route::get('/officerRegistration', [OfficerRegistrationController::class, 'index'])->name('officerRegistration');
Route::get('/funds', [FundsController::class, 'index'])->name('funds');