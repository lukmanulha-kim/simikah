<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\MasterAnggotaController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\MasterPolisiController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterPimpinanController;
use App\Http\Controllers\MasterPasanganController;

use App\Http\Controllers\TransIzinNikahController;
use App\Http\Controllers\TransIzinCeraiController;

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
    return view('login');
});

Route::post('/ceklogin',[LoginController::class, 'ceklogin']);
Route::get('/logout',[LoginController::class, 'logout']);

Route::group(['middleware' => ['auth', 'ceklevel:Admin_SDM']], function ()
{
    Route::get('home', function () {
        return view('home');
    });

    Route::get('master/user', [MasterUserController::class, 'data']);
    Route::get('master/user/add', function (){
        return view('master/user/add');
    });
    Route::post('user/create',[MasterUserController::class, 'addProsses']);
    Route::get('master/user/edit/{id}', [MasterUserController::class, 'edit']);
    Route::post('user/update',[MasterUserController::class, 'update']);

    Route::get('master/jabatan', [MasterJabatanController::class, 'data']);
    Route::get('master/jabatan/add', function (){
        return view('master/jabatan/add');
    });
    Route::post('jabatan/create',[MasterJabatanController::class, 'addProsses']);
    Route::get('master/jabatan/edit/{id}', [MasterJabatanController::class, 'edit']);
    Route::post('jabatan/update',[MasterJabatanController::class, 'update']);

    Route::get('master/polisi', [MasterPolisiController::class, 'data']);
    Route::get('master/polisi/add', function (){
        return view('master/kepolisian/add');
    });
    Route::get('master/polisi/edit/{id}', [MasterPolisiController::class, 'edit']);
    Route::post('polisi/create',[MasterPolisiController::class, 'addProsses']);
    Route::post('polisi/update',[MasterPolisiController::class, 'update']);

    Route::get('master/pimpinan', [MasterPimpinanController::class, 'data']);
    Route::get('master/pimpinan/add', [MasterPimpinanController::class, 'add']);
    Route::post('pimpinan/create',[MasterPimpinanController::class, 'addProsses']);
    Route::get('master/pimpinan/edit/{id}', [MasterPimpinanController::class, 'edit']);
    Route::post('pimpinan/update',[MasterPimpinanController::class, 'update']);

    Route::get('master/anggota', [MasterAnggotaController::class, 'data']);
    Route::get('master/anggota/add', [MasterAnggotaController::class, 'add']);
    Route::post('anggota/create',[MasterAnggotaController::class, 'addProsses']);
    Route::get('master/anggota/edit/{id}', [MasterAnggotaController::class, 'edit']);
    Route::post('anggota/update',[MasterAnggotaController::class, 'update']);
    Route::get('getDataKepolisian/{id}', [MasterAnggotaController::class, 'getDataKepolisian']);

    ### Route Transaksi

    Route::get('trans/izinnikah', [TransIzinNikahController::class, 'data']);
    Route::get('trans/izinnikah/add', [TransIzinNikahController::class, 'add']);
    Route::post('izinnikah/create',[TransIzinNikahController::class, 'addProsses']);
    Route::get('trans/izinnikah/edit/{id}', [TransIzinNikahController::class, 'edit']);
    Route::post('izinnikah/update',[TransIzinNikahController::class, 'update']);
    Route::get('izinnikah/delete/{id}', [TransIzinNikahController::class, 'delete']);
    Route::get('getDataAnggota/{id}', [TransIzinNikahController::class, 'getDataAnggota']);
    Route::get('getDataCalon/{id}', [TransIzinNikahController::class, 'getDataCalon']);

    Route::get('trans/izincerai', [TransIzinCeraiController::class, 'data']);
    Route::get('trans/izincerai/add', [TransIzinCeraiController::class, 'add']);
    Route::post('izincerai/create',[TransIzinCeraiController::class, 'addProsses']);
    Route::get('trans/izincerai/edit/{id}', [TransIzinCeraiController::class, 'edit']);
    Route::post('izincerai/update',[TransIzinCeraiController::class, 'update']);
    Route::get('izincerai/delete/{id}', [TransIzinCeraiController::class, 'delete']);
    Route::get('getDataCalonCerai/{id}', [TransIzinCeraiController::class, 'get_dataCerai']);
});

Route::group(['middleware' => ['auth', 'ceklevel:pimpinan']], function ()
{
    Route::get('home', function () {
        return view('home');
    });

    Route::get('acc/bagian', [TransIzinNikahController::class, 'acc']);
    Route::get('accbagian/{id}', [TransIzinNikahController::class, 'accbagian']);
    Route::get('acc/izinnikah/{id}', [TransIzinNikahController::class, 'accizinnikah']);

    Route::get('acc/cerai/pimpinan', [TransIzinCeraiController::class, 'accceraipimpinan']);
    Route::get('accceraibagian/{id}', [TransIzinCeraiController::class, 'accceraibagian']);
    Route::get('acc/izincerai/{id}', [TransIzinCeraiController::class, 'accizincerai']);
});

Route::group(['middleware' => ['auth', 'ceklevel:kapolsek']], function ()
{
    Route::get('home', function () {
        return view('home');
    });

    Route::get('acc/nikah/polsek', [TransIzinNikahController::class, 'accnikahpolsek']);
    Route::get('accnikahpolsek/{id}', [TransIzinNikahController::class, 'nikahaccpolsek']);

    Route::get('acc/cerai/polsek', [TransIzinCeraiController::class, 'accceraipolsek']);
    Route::get('accceraipolsek/{id}', [TransIzinCeraiController::class, 'ceraiaccpolsek']);
});

Route::group(['middleware' => ['auth', 'ceklevel:kapolres']], function ()
{
    Route::get('home', function () {
        return view('home');
    });

    Route::get('acc/nikah/polres', [TransIzinNikahController::class, 'accnikahpolres']);
    Route::get('accnikahpolres/{id}', [TransIzinNikahController::class, 'nikahaccpolres']);

    Route::get('acc/cerai/polres', [TransIzinCeraiController::class, 'accceraipolres']);
    Route::get('accceraipolres/{id}', [TransIzinCeraiController::class, 'ceraiaccpolres']);
});

Route::group(['middleware' => ['auth', 'ceklevel:anggota']], function ()
{
    Route::get('home', function () {
        return view('home');
    });

    Route::get('master/pasangan', [MasterPasanganController::class, 'data']);
    Route::get('master/pasangan/add', [MasterPasanganController::class, 'add']);
    Route::post('pasangan/create',[MasterPasanganController::class, 'addProsses']);
    Route::get('master/pasangan/edit/{id}', [MasterPasanganController::class, 'edit']);
    Route::post('pasangan/update',[MasterPasanganController::class, 'update']);
});

### Route ACC


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
