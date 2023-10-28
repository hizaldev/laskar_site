<?php

use App\Http\Controllers\API\AbsensiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\master\BankController;
use App\Http\Controllers\API\master\DpcController;
use App\Http\Controllers\API\master\DpdController;
use App\Http\Controllers\API\master\ReligionController;
use App\Http\Controllers\API\master\SizeController;
use App\Http\Controllers\API\master\TypeBloodController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\StatistikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('verify_user', [AuthController::class, 'verifyUser']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('getDataWaitingListMember', [MemberController::class, 'waitingListMember']);
    Route::get('getDataMemberUser', [MemberController::class, 'getDataMemberUser']);
    Route::get('getDataMemberDetail', [MemberController::class, 'getDataMemberDetail']);
    Route::get('getSearchDataMember', [MemberController::class, 'getSearchDataMember']);
    Route::post('prosesRegistrasiAnggota', [MemberController::class, 'prosesRegistrasiAnggota']);

    // Absensi
    Route::get('getDataAbsensiUser', [AbsensiController::class, 'getDataAbsensiUser']);
    Route::post('prosesKehadiran', [AbsensiController::class, 'prosesKehadiran']);
    Route::post('createAbsensi', [AbsensiController::class, 'createAbsensi']);
    Route::post('getDataAbsensiDetail', [AbsensiController::class, 'getDataAbsensiDetail']);
    Route::get('getDataKehadiranUser', [AbsensiController::class, 'getDataKehadiranUser']);
    Route::post('showAbsensiScan', [AbsensiController::class, 'showAbsensiScan']);
    Route::get('printAbsensi', [AbsensiController::class, 'printAbsensi']);

    // Statistik
    Route::get('getDataStatistikAnggota', [StatistikController::class, 'getDataStatistikAnggota']);
    Route::get('getDataStatistikGrade', [StatistikController::class, 'getDataStatistikGrade']);
    Route::get('getDataStatistikUmur', [StatistikController::class, 'getDataStatistikUmur']);


    // master
    Route::get('getDataReligion', [ReligionController::class, 'getDataReligion']);
    Route::get('getDataScize', [SizeController::class, 'getDataSize']);
    Route::get('getDataTypeBlood', [TypeBloodController::class, 'getDataTypeBlood']);
    Route::get('getDataDpd', [DpdController::class, 'getDataDpd']);
    Route::get('getDataDpc', [DpcController::class, 'getDataDpc']);
    Route::get('getDataBank', [BankController::class, 'getDataBank']);

    // news
    Route::get('getDataNewsEvent', [NewsController::class, 'getDataNewsEvent']);
    Route::post('getDataNewsDetail', [NewsController::class, 'getDataNewsDetail']);
});
