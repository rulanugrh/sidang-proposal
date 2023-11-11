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
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/')->with('error', 'Pengumuman gagal dibuat');
        }

        return redirect('/')->with('success', 'Pengumuman berhasil dibuat');
    }
}
