<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\UploadProposal;
use App\Models\User;

class UploadProposalController extends Controller
{
    private $rules = [
        'NIM' => 'required|unique:mahasiswa,NIM',
        'judul' => 'required',
        'dosen_pembimbing' => 'required',
        'jenis_sidang' => 'required',
        'berkas' => 'required|mimes:pdf|max:5120',
        'user_email' => 'required|unique:email'
    ];

    private $messageRules = [
        'NIM.required' => 'NIM Wajib Diisi',
        'judul.required' => 'Judul Wajib Diisi',
        'dosen_pembimbing.required' => 'Dosen Pembimbing Wajib Diisi',
        'jenis_sidang.required' => 'Jenis Sidang Wajib Diisi',
        'berkas.required' => 'Berkas Wajib Diisi',
        'berkas.mimes' => 'Format File Salah',
        'berkas.max' => 'Maximum Size File 5MB',
        'user_email.required' => 'Email User Wajib Diisi' 
    ];

    public function index() {
        return view('proposal.index', [
            'proposals' => UploadProposal::all()
        ]);
    }

    public function create()
    {
        return view('proposal.create');
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules, $this->messageRules);

        $extension_berkas = $request->berkas->getClientOriginalExtensions();
        $berkas = 'Proposal'.Str::replaceFirst('.', '', Session::get('email')).'-'.date('His');
        $request->berkas->move_uploaded_file($berkas . '.' . $extension_berkas, public_path('/upload/pengajuan/proposal'));

        try {
            UploadProposal::create([
                'NIM' => $request->NIM,
                'judul' => $request->judul,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'jenis_sidang' => $request->jenis_sidang,
                'berkas' => $berkas . '.' . $extension_berkas,
                'user_email' => $request->user_email
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('proposal_admin.index')->with('error', 'Proposal gagal diupload');
        }

        return redirect()->route('proposal_admin.index')->with('success', 'Data proposal berhasil diupload');
    }

    
}
