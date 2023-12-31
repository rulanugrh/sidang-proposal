<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\UploadProposal;
use App\Models\User;
use App\Exports\ProposalExport;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class NotifikasiController extends Controller
{
    private $rules = [
        'judul_pengumuman' => 'required',
        'isi' => 'required',
    ];
    
    public function index() {
        return view('notifikasi.index', [
            'notifikasis' => NotifikasiModel::all(),
        ]);
    }

    public function getByNIM() {
        $notifikasi = NotifikasiModel::where('nim', auth()->user()->email)->orderBy('created_at', 'desc')->limit(1)->get();
        return view('info.index', compact('notifikasi'));
    }
    
    public function create()
    {
        return view('notifikasi.create');
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules);

        $extension_berkas = $request->file('berkas')->getClientOriginalExtension();
        $berkas = 'Proposal '.Str::replaceFirst('.', '-',auth()->user()->name).'-'.date('His');
        $request->berkas->move(public_path('/upload/berkas/penting'), $berkas . '.' . $extension_berkas);

        try {
            NotifikasiModel::create([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi' => $request->isi,
                'berkas' => $berkas . '.' . $extension_berkas,
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('notifikasi.index')->with('error', 'Pengumuman gagal dibuat');
        }

        return redirect()->route('notifikasi.index')->with('success', 'Pengumuman berhasil dibuat');
    }

    public function edit(NotifikasiModel $notifikasi) {
        return view('notifikasi.edit', compact('notifikasi'));
    }

    public function update(Request $request, NotifikasiModel $notifikasi) {
        $this->validate($request, $this->rules);

        $extension_berkas = $request->file('berkas')->getClientOriginalExtension();
        $berkas = 'Proposal '.Str::replaceFirst('.', '-',auth()->user()->name).'-'.date('His');
        $request->berkas->move(public_path('/upload/berkas/penting'), $berkas . '.' . $extension_berkas);


        try {
            $notifikasi->update([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi' => $request->isi,
                'berkas' => $berkas . '.' . $extension_berkas,
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('notifikasi.index')->with('error', 'Pengumuman gagal diupdate');
        }

        return redirect()->route('notifikasi.index')->with('success', 'Pengumuman berhasil diupdate');
    }


    public function destroy(NotifikasiModel $notifikasi) {

        try {
            $notifikasi->delete();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('notifikasi.index')->with('error', 'Pengumuman gagal dihapus');
        }

        return redirect()->route('notifikasi.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}
