<?php

use App\Http\Controllers\AnggotaUKMController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ManageProposal;
use App\Http\Controllers\UnitKegiatanMahasiswaController;
use App\Http\Controllers\UploadProposalController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Models\AnggotaUKM;
use App\Models\Mahasiswa;
use App\Models\UnitKegiatanMahasiswa;
use App\Models\UploadProposal;
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
    return view('dashboard', [
        'mahasiswa' => Mahasiswa::count(),
        'proposal' => UploadProposal::count(),
        'anggota_ukm' => AnggotaUKM::count(),
    ]);
});

Route::resource('admin-proposal', ManageProposal::class)->except(['show']);
Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
Route::middleware(['admin'])->group(function () {
    Route::get('mahasiswa/export/pdf', [MahasiswaController::class, 'exportPdf'])->name('mahasiswa.pdf');
    Route::get('mahasiswa/export/excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.excel');
    
    Route::resource('unit_kegiatan_mahasiswa', UnitKegiatanMahasiswaController::class)->except(['show']);
    Route::get('unit_kegiatan_mahasiswa/export/pdf', [UnitKegiatanMahasiswaController::class, 'exportPdf'])->name('unit_kegiatan_mahasiswa.pdf');
    Route::get('unit_kegiatan_mahasiswa/export/excel', [UnitKegiatanMahasiswaController::class, 'exportExcel'])->name('unit_kegiatan_mahasiswa.excel');
    
    Route::resource('anggota_ukm', AnggotaUKMController::class)->except(['show']);
    Route::get('anggota_ukm/export/pdf', [AnggotaUKMController::class, 'exportPdf'])->name('anggota_ukm.pdf');
    Route::get('anggota_ukm/export/excel', [AnggotaUKMController::class, 'exportExcel'])->name('anggot_ukm.excel');
    
    Route::get('admin-proposal/export/pdf', [UploadProposalController::class, 'exportPdf'])->name('admin-proposal.pdf');
    Route::get('admin-proposal/export/excel', [UploadProposalController::class, 'exportExcel'])->name('admin-proposal.excel');

});
