<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\UploadProposal;

class SubmissionProposal extends Controller
{
    private $rules = [
        'NIM' => 'required',
        'judul' => 'required',
        'dosen_pembimbing' => 'required',
        'jenis_sidang' => 'required',
        'berkas' => 'required|max:5120',
        'email' => 'required',
    ];

    private $messageRules = [
        'judul.required' => 'Judul Wajib Diisi',
        'dosen_pembimbing.required' => 'Dosen Pembimbing Wajib Diisi',
        'jenis_sidang.required' => 'Jenis Sidang Wajib Diisi',
        'berkas.required' => 'Berkas Wajib Diisi',
        'berkas.max' => 'Maximum Size File 5MB',
        'email.required' => 'Email User Wajib Diisi',
    ];

    public function index() {
        $proposal = UploadProposal::where("NIM", auth()->user()->email)->first();
        if ( $proposal === null ) {
            return view('proposal.create');
        };
        return view('proposal.index', compact('proposal'));
    }

    public function create()
    {
        return view('proposal.create');
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules, $this->messageRules);

        $extension_berkas = $request->file('berkas')->getClientOriginalExtension();
        $berkas = 'Proposal'.Str::replaceFirst('.', '-', auth()->user()->email).'-'.date('His');
        $request->berkas->move(public_path('/upload/pengajuan/proposal'), $berkas . '.' . $extension_berkas);

        try {
            UploadProposal::create([
                'NIM' => $request->NIM,
                'judul' => $request->judul,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'jenis_sidang' => $request->jenis_sidang,
                'berkas' => $berkas . '.' . $extension_berkas,
                'email' => $request->email,
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('proposal.index')->with('error', 'Proposal gagal diupload');
        }

        return redirect()->route('proposal.index')->with('success', 'Data proposal berhasil diupload');
    }


    public function edit(UploadProposal $proposal)
    {
        return view('proposal.edit', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UploadProposal $proposal)
    {
        // $this->validate($request, $this->rules);

        try {

            $proposal->where('NIM', auth()->user()->email)->update($request->all());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('proposal.index')->with('error', 'Data mahasiswa gagal diubah');
        }

        return redirect()->route('proposal.index')->with('success', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UploadProposal $proposal)
    {
        try {
            $proposal->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('proposal.index')->with('error', 'Data mahasiswa gagal dihapus');
        }

        return redirect()->route('proposal.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
