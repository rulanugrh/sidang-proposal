<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiModel;
use Illuminate\Http\Request;

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
        $notifikasi = NotifikasiModel::where('nim', auth()->user()->email)->first();
        return view('info.index', compact('notifikasi'));
    }
    
    public function create()
    {
        return view('notifikasi.create');
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules);

        try {
            NotifikasiModel::create([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi' => $request->isi,
                'nim' => $request->nim,
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

        try {
            $notifikasi->update($request->all());

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
