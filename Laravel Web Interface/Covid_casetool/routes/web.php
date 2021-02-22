<?php

use App\Http\Controllers\Covid19ConsultantController;
use App\Http\Controllers\Covid19HealthController;
use App\Http\Controllers\DirectorForm;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DonationsController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SenCovid19HealthController;
use App\Http\Controllers\Waitinglist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientlistController;

use App\Http\Controllers\OfficerRegistrationController;
use App\Http\Controllers\FundsRegistrationController;
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
Route::get('/enrollmentGraphs',[EnrollmentController::class, 'index'])->name('enrollment');
Route::get('/patientlist', [PatientlistController::class, 'index'])->name('patientlist');
Route::get('/covid19_Health_Officers', [Covid19HealthController::class, 'index'])->name('covid19Health');
Route::get('/Senior_Covid19_Health_Officers',[SenCovid19HealthController::class, 'index'])->name('seniors');
Route::get('/Covid19_Consultants',[Covid19ConsultantController::class, 'index'])->name('consultants');
Route::get('/donations', [DonationsController::class, 'index'])->name('donations');
Route::get('/officerRegistration', [OfficerRegistrationController::class, 'displayForm'])->name('officerRegistration');
Route::get('/getdrs', [OfficerRegistrationController::class, 'getDoctors']);
Route::get('/promote', [OfficerRegistrationController::class, 'promote']);
Route::get('/regOfficer',[OfficerRegistrationController::class, 'index']);
Route::get('/inpOfficer',[OfficerRegistrationController::class, 'keep']);
Route::get('/directorRegistration', [DirectorForm::class, 'form'])->name('directorRegistration');
Route::post('/directorRegistration',[DirectorForm::class, 'change']);
Route::get('/staff_salaries', [DistributionController::class, 'staff'])->name('staff_salaries');
Route::get('/doctor_salaries', [DistributionController::class, 'doctors'])->name('doctor_salaries');
Route::get('/fundsRegistration', function (){return view('funds');})->name('fundsRegistration');
Route::get('/fundRegistration', [FundsRegistrationController::class, 'index']);
Route::get('/distribute', [FundsRegistrationController::class, 'distribute']);
Route::get('/waiting_list',[Waitinglist::class, 'getlist'])->name('getlist');
Route::get('/registerPosition',[Waitinglist::class, 'registerPosition'])->name('registerPosition');
Route::get('/hierarchy', [\App\Http\Controllers\HierarchyController::class, 'index'])->name('hierarchy');





