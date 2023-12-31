<?php

use App\Http\Controllers\AnggotaUKMController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ManageProposal;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SubmissionProposal;
use App\Http\Controllers\UnitKegiatanMahasiswaController;
use App\Http\Controllers\UploadProposalController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Models\AnggotaUKM;
use App\Models\Event;
use App\Models\Mahasiswa;
use App\Models\NotifikasiModel;
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
    // if (!auth()->guest()) {
    //     $notifikasi = NotifikasiModel::select();
    //     if (auth()->user()->authGroup->auth_group_id === 2) {
    //         $notifikasi = $notifikasi->where('nim', auth()->user()->email);
    //     }

    //     return view('dashboard', [
    //         'mahasiswa' => Mahasiswa::count(),
    //         'proposal' => UploadProposal::count(),
    //         'notifikasi' => $notifikasi->orderBy('created_at', 'desc')->limit(5)->get(),
    //         'events' => Event::all(),
    //     ]);
    // }

    return view('dashboard', [
        'mahasiswa' => Mahasiswa::count(),
        'proposal' => UploadProposal::count(),
        'notifikasi' => NotifikasiModel::orderBy('created_at', 'desc')->limit(10)->get(),
        'events' => Event::all(),
    ]);
});

Route::middleware(['admin'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
    Route::get('mahasiswa/export/pdf', [MahasiswaController::class, 'exportPdf'])->name('mahasiswa.pdf');
    Route::get('mahasiswa/export/excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.excel');
    
    Route::resource('unit_kegiatan_mahasiswa', UnitKegiatanMahasiswaController::class)->except(['show']);
    Route::get('unit_kegiatan_mahasiswa/export/pdf', [UnitKegiatanMahasiswaController::class, 'exportPdf'])->name('unit_kegiatan_mahasiswa.pdf');
    Route::get('unit_kegiatan_mahasiswa/export/excel', [UnitKegiatanMahasiswaController::class, 'exportExcel'])->name('unit_kegiatan_mahasiswa.excel');
    
    Route::resource('anggota_ukm', AnggotaUKMController::class)->except(['show']);
    Route::get('anggota_ukm/export/pdf', [AnggotaUKMController::class, 'exportPdf'])->name('anggota_ukm.pdf');
    Route::get('anggota_ukm/export/excel', [AnggotaUKMController::class, 'exportExcel'])->name('anggot_ukm.excel');
    
    Route::resource('admin-proposal', ManageProposal::class)->except(['show']);
    Route::get('admin-proposal/export/pdf', [ManageProposal::class, 'exportPdf'])->name('admin-proposal.pdf');
    Route::get('admin-proposal/export/excel', [ManageProposal::class, 'exportExcel'])->name('admin-proposal.excel');

    Route::resource('event', CalendarController::class)->except(['show']);
    Route::get('event/export/pdf', [CalendarController::class, 'exportPdf'])->name('event.pdf');
    Route::get('event/export/excel', [CalendarController::class, 'exportExcel'])->name('event.excel');
    
    Route::resource('proposal', SubmissionProposal::class)->except(['show']);
    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('notifikasi', NotifikasiController::class)->except(['show']);
    Route::resource('event', CalendarController::class)->except(['show']);

});
