<?php

use App\Http\Controllers\PoinDosenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\stokcontroller;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaController;

Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter {id}, maka harus berupa angka


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');// New routes for registration

Route::get('/register', [AuthController::class, 'postregister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', [WelcomeController::class, 'landingPage'])->name('landingpage');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix'=>'jenis_pengguna','middleware'=>['authorize:ADM']], function () {
        Route::get('/', [JenisPenggunaController::class, 'index'])->name('jenis_pengguna.index');          // menampilkan halaman awal jenis pengguna
        Route::post('/list', [JenisPenggunaController::class, 'list'])->name('jenis_pengguna.list');      // menampilkan data jenis pengguna dalam json untuk datatables
        Route::get('/create', [JenisPenggunaController::class, 'create'])->name('jenis_pengguna.create');   // menampilkan halaman form tambah jenis pengguna
        Route::post('/', [JenisPenggunaController::class, 'store'])->name('jenis_pengguna.store');         // menyimpan data jenis pengguna baru
        Route::get('/create_ajax', [JenisPenggunaController::class, 'create_ajax'])->name('jenis_pengguna.create_ajax');
        Route::post('/ajax', [JenisPenggunaController::class, 'store_ajax'])->name('jenis_pengguna.store_ajax');
        Route::get('/{id}', [JenisPenggunaController::class, 'show']);       // menampilkan detail jenis pengguna
        Route::get('/{id}/show_ajax', [JenisPenggunaController::class, 'show_ajax']);
        Route::get('/{id}/edit', [JenisPenggunaController::class, 'edit']);  // menampilkan halaman form edit jenis pengguna
        Route::put('/{id}', [JenisPenggunaController::class, 'update']);     // menyimpan perubahan data jenis pengguna
        Route::get('/{id}/edit_ajax', [JenisPenggunaController::class, 'edit_ajax']); // Menampilkan halaman form edit jenis pengguna Ajax
        Route::put('/{id}/update_ajax', [JenisPenggunaController::class, 'update_ajax']); // Menyimpan perubahan data jenis pengguna Ajax
        Route::get('/{id}/delete_ajax', [JenisPenggunaController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete jenis pengguna Ajax
        Route::delete('/{id}/delete_ajax', [JenisPenggunaController::class, 'delete_ajax']); // Untuk hapus data jenis pengguna Ajax
        Route::delete('/{id}', [JenisPenggunaController::class, 'destroy']); // menghapus data jenis pengguna
        Route::get('/import', [JenisPenggunaController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [JenisPenggunaController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [JenisPenggunaController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [JenisPenggunaController::class, 'export_pdf']); // export pdf
    });
    
    Route::group(['prefix' => 'pengguna', 'middleware' => ['authorize:ADM']], function () {
        Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');          // menampilkan halaman awal pengguna
        Route::post('/list', [PenggunaController::class, 'list'])->name('pengguna.list');      // menampilkan data pengguna dalam json untuk datatables
        Route::get('/create', [PenggunaController::class, 'create'])->name('pengguna.create');   // menampilkan halaman form tambah pengguna
        Route::post('/', [PenggunaController::class, 'store'])->name('pengguna.store');         // menyimpan data pengguna baru
        Route::get('/create_ajax', [PenggunaController::class, 'create_ajax'])->name('pengguna.create_ajax'); // Menampilkan halaman form tambah pengguna dengan ajax
        Route::post('/ajax', [PenggunaController::class, 'store_ajax']); // menyimpan data pengguna baru Ajax
        Route::get('/{id}', [PenggunaController::class, 'show']);        // menampilkan detail pengguna
        Route::get('/{id}/show_ajax', [PenggunaController::class, 'show_ajax']); // menampilkan detail pengguna Ajax
        Route::get('/{id}/edit', [PenggunaController::class, 'edit']);   // menampilkan halaman form edit pengguna
        Route::put('/{id}', [PenggunaController::class, 'update']);      // menyimpan perubahan data pengguna
        Route::get('/{id}/edit_ajax', [PenggunaController::class, 'edit_ajax']); // menampilkan halaman form edit pengguna Ajax
        Route::put('/{id}/update_ajax', [PenggunaController::class, 'update_ajax']); // menyimpan perubahan data pengguna Ajax
        Route::get('/{id}/delete_ajax', [PenggunaController::class, 'confirm_ajax']); // menampilkan form konfirmasi hapus pengguna Ajax
        Route::delete('/{id}/delete_ajax', [PenggunaController::class, 'delete_ajax']); // menghapus data pengguna Ajax
        Route::delete('/{id}', [PenggunaController::class, 'destroy']); // menghapus data pengguna
        Route::get('/import', [PenggunaController::class, 'import']);   // menampilkan form upload excel
        Route::post('/import_ajax', [PenggunaController::class, 'import_ajax']); // import excel pengguna Ajax
        Route::get('/export_excel', [PenggunaController::class, 'export_excel']); // export data pengguna ke excel
        Route::get('/export_pdf', [PenggunaController::class, 'export_pdf']);     // export data pengguna ke pdf
        Route::get('/profil/edit', [PenggunaController::class, 'editProfile'])->name('profil.edit');
    });
    

    Route::group(['prefix' => 'kegiatan', 'middleware' => ['authorize:ADM,PMN,DPC,DSA']], function () {
        Route::get('/', [KegiatanController::class, 'index']);               // Display main page for kegiatan
        Route::post('/list', [KegiatanController::class, 'list'])->name('kegiatan.list');           // Display kegiatan data as JSON for DataTables
        Route::get('/create', [KegiatanController::class, 'create']);        // Display form for adding kegiatan
        Route::post('/', [KegiatanController::class, 'store']);              // Store new kegiatan data
        Route::get('/create_ajax', [KegiatanController::class, 'create_ajax'])->name('kegiatan.create_ajax'); // Display form for adding kegiatan via AJAX
        Route::post('/ajax', [KegiatanController::class, 'store_ajax']);     // Store new kegiatan data via AJAX
        Route::get('/{id}', [KegiatanController::class, 'show']);            // Display kegiatan details
        Route::get('/{id}/show_ajax', [KegiatanController::class, 'show_ajax']); // Display kegiatan details via AJAX
        Route::get('/{id}/edit', [KegiatanController::class, 'edit']);       // Display form for editing kegiatan
        Route::put('/{id}', [KegiatanController::class, 'update']);          // Save updates to kegiatan data
        Route::get('/{id}/edit_ajax', [KegiatanController::class, 'edit_ajax']); // Display form for editing kegiatan via AJAX
        Route::put('/{id}/update_ajax', [KegiatanController::class, 'update_ajax']); // Save updates to kegiatan data via AJAX
        Route::get('/{id}/delete_ajax', [KegiatanController::class, 'confirm_ajax']); // Display confirmation form for deleting kegiatan via AJAX
        Route::delete('/{id}/delete_ajax', [KegiatanController::class, 'delete_ajax']); // Delete kegiatan data via AJAX
        Route::delete('/{id}', [KegiatanController::class, 'destroy']);      // Delete kegiatan data
        Route::get('/import', [KegiatanController::class, 'import']);        // Display form for uploading Excel file
        Route::post('/import_ajax', [KegiatanController::class, 'import_ajax']); // Import Excel data via AJAX
        Route::get('/export_excel', [KegiatanController::class, 'export_excel']); // Export kegiatan data to Excel
        Route::get('/export_pdf', [KegiatanController::class, 'export_pdf']); // Export kegiatan data to PDF
    });
    

    Route::group(['prefix' =>'profil'],function(){
        Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
        Route::patch('/{id}', [ProfilController::class, 'update'])->name('profil.update');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
        Route::patch('/profil/{id}', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/profil/upload', [ProfilController::class, 'uploadProfileImage'])->name('profil.upload');
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index')->middleware('auth');
    });

    // Route::middleware(['auth'])->group(function () {
    //     Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    //     Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    // });

});