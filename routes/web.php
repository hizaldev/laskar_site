<?php

use App\Http\Controllers\CaptchaValidationController;
use App\Http\Controllers\Keanggotaan\AnggotaController;
use App\Http\Controllers\Keanggotaan\ProcessMemberController;
use App\Http\Controllers\Keanggotaan\RegistrasiController;
use App\Http\Controllers\Master\BankController;
use App\Http\Controllers\Master\CityController;
use App\Http\Controllers\Master\DpcController;
use App\Http\Controllers\Master\DpdController;
use App\Http\Controllers\Master\ReligionController;
use App\Http\Controllers\Master\SizeController;
use App\Http\Controllers\Master\StatusMemberController;
use App\Http\Controllers\Master\TypeBloodController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Settings\PermissionController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use Illuminate\Support\Facades\Route;


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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('reload-captcha', [CaptchaValidationController::class, 'reloadCaptcha']);
Route::resource('register_members', RegistrasiController::class);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('permisions', PermissionController::class);
    Route::resource('users', UserController::class);
    

    // Master
    Route::resource('dpd', DpdController::class);
    Route::resource('dpc', DpcController::class);
    Route::resource('religions', ReligionController::class);
    Route::resource('cities', CityController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('type_bloods', TypeBloodController::class);
    Route::resource('banks', BankController::class);
    Route::resource('status_members', StatusMemberController::class);
    Route::resource('units', UnitController::class);
    
    // keanggotaan
    Route::resource('process_members', ProcessMemberController::class);
    Route::resource('members', AnggotaController::class);
});
