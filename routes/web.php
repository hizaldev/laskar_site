<?php

use App\Http\Controllers\Auth\AuthOtpController;
use App\Http\Controllers\CaptchaValidationController;
use App\Http\Controllers\ContentManagement\CategoryNewsController;
use App\Http\Controllers\ContentManagement\LinksController;
use App\Http\Controllers\ContentManagement\NewsController;
use App\Http\Controllers\Evote\ElectionController;
use App\Http\Controllers\Evote\VoterController;
use App\Http\Controllers\Keanggotaan\AnggotaController;
use App\Http\Controllers\Keanggotaan\ProcessMemberController;
use App\Http\Controllers\Keanggotaan\RegistrasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Master\BankController;
use App\Http\Controllers\Master\CityController;
use App\Http\Controllers\Master\DepartmentController;
use App\Http\Controllers\Master\DpcController;
use App\Http\Controllers\Master\DpdController;
use App\Http\Controllers\Master\GradeController;
use App\Http\Controllers\Master\LevelJabatanController;
use App\Http\Controllers\Master\ReligionController;
use App\Http\Controllers\Master\SerikatPekerjaController;
use App\Http\Controllers\Master\SizeController;
use App\Http\Controllers\Master\StatusMemberController;
use App\Http\Controllers\Master\TypeBloodController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Settings\PermissionController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\WhatsappGroupController;
use App\Models\NewsCategory;
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

Route::get('/', [LandingController::class, 'index']);
Route::get('/signin', function () {
    return view('auth.email_otp');
    // return view('evote.election.get_vote')
})->name('root');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('reload-captcha', [CaptchaValidationController::class, 'reloadCaptcha']);
Route::resource('register_members', RegistrasiController::class);
Route::post('sign-in', [AuthOtpController::class, 'sendOtp'])->name('sign-in');
Route::post('authenticate', [AuthOtpController::class, 'authenticate'])->name('authenticate');
Route::get('/evote/{id}', [ElectionController::class, 'CollectVote'])->name('evotes.CollectVote');
Route::post('store_vote', [ElectionController::class, 'store_vote'])->name('evotes.store_vote');
Route::get('/read_news/{id}', [NewsController::class, 'readNews'])->name('news.read_news');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('permisions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('whatsapp_groups', WhatsappGroupController::class);
    
    // Dashboard
    Route::get('/dashboard_ellection', [ElectionController::class, 'dashboardEvote'])->name('evotes.dashboard_evote');
    Route::get('/dashboard_laskar', [AnggotaController::class, 'dashboardlaskar'])->name('members.dashboard_laskar');

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
    Route::resource('unions', SerikatPekerjaController::class);
    Route::resource('level_positions', LevelJabatanController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('departments', DepartmentController::class);
    
    // keanggotaan
    Route::resource('process_members', ProcessMemberController::class);
    Route::resource('members', AnggotaController::class);
    Route::get('/print_undur_diri/{id}', [AnggotaController::class, 'PrintUndurDiri'])->name('members.PrintUndurDiri');
    Route::get('/print_pendaftaran/{id}', [AnggotaController::class, 'PrintPendaftaran'])->name('members.PrintPendaftaran');
    Route::get('/surat_kuasa/{id}', [AnggotaController::class, 'PrintSuratKuasa'])->name('members.PrintSuratKuasa');
    Route::get('/template_materai/{id}', [AnggotaController::class, 'PrintTemplate'])->name('members.PrintTemplate');
    Route::get('/get_members', [AnggotaController::class, 'getAnggota'])->name('members.getMembers');

    // pemilu
    Route::resource('evotes', ElectionController::class);
    Route::get('/resendInvitation/{id}', [ElectionController::class, 'ResendInvitation'])->name('evotes.ResendInvitation');
    Route::delete('/destro_voter/{id}', [ElectionController::class, 'destroyVoters'])->name('evotes.destroyVoters');
    Route::put('/update_candidate/{id}', [ElectionController::class, 'update_candidate'])->name('evotes.update_candidate');
    Route::post('store_candidate', [ElectionController::class, 'store_candidate'])->name('evotes.store_candidate');

    // Content Management
    Route::resource('links', LinksController::class);
    Route::resource('news_category', CategoryNewsController::class);
    Route::post('storeCategory', [CategoryNewsController::class, 'storeCategory'])->name('news_category.storeCategory');
    Route::resource('news', NewsController::class);
    Route::get('/get_category', [CategoryNewsController::class, 'getCategories'])->name('news_category.getCategories');
    // Route::delete('/destroyDocumentaion/{id}', [NewsController::class, 'destroyDocumentation'])->name('news.destroyDocumentation');
    Route::get('/destroyDocumentaion/{id}', [NewsController::class, 'destroyDocumentation'])->name('news.destroyDocumentation');
    



    // report
    Route::get('report/export/', [AnggotaController::class, 'export'])->name('exportMember');



    // Route::get('/resendNotification/{voter}', [VoterController::class, 'resendNotification']);

});
