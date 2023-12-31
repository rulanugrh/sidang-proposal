<?php

namespace App\Http\Controllers;


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

class ManageProposal extends Controller
{
    private $rules = [
        'NIM' => 'required',
        'judul' => 'required',
        'dosen_pembimbing' => 'required',
        'jenis_sidang' => 'required',
        'berkas' => 'required|file|mimes:pdf,doc,docx|max:5120',
        'email' => 'required',
    ];

    private $updateRules = [
        'NIM' => 'required',
        'judul' => 'required',
        'dosen_pembimbing' => 'required',
        'jenis_sidang' => 'required',
        'email' => 'required',
        'status' => 'required',
        'link_zoom' => 'required',
    ];

    private $messageRules = [
        'judul.required' => 'Judul Wajib Diisi',
        'dosen_pembimbing.required' => 'Dosen Pembimbing Wajib Diisi',
        'jenis_sidang.required' => 'Jenis Sidang Wajib Diisi',
        'berkas.required' => 'Berkas Wajib Diisi',
        'berkas.max' => 'Maximum Size File 5MB',
    ];

    private $messageRulesUpdate = [
        'judul.required' => 'Judul Wajib Diisi',
        'dosen_pembimbing.required' => 'Dosen Pembimbing Wajib Diisi',
        'jenis_sidang.required' => 'Jenis Sidang Wajib Diisi',
        'berkas.required' => 'Berkas Wajib Diisi',
        'email.required' => 'Email User Wajib Diisi',
        'link_zoom' => 'Link Zoom Diperkenankan'
    ];

    public function index() {
        return view('admin-proposal.index', [
            'proposals' => UploadProposal::all()
        ]);
    }

    public function create()
    {
        return view('admin-proposal.create');
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules, $this->messageRules);

        $extension_berkas = $request->file('berkas')->getClientOriginalExtension();
        $berkas = 'Proposal '.Str::replaceFirst('.', '-',auth()->user()->name).'-'.date('His');
        $request->berkas->move(public_path('/upload/pengajuan/proposal'), $berkas . '.' . $extension_berkas);

        try {
            UploadProposal::create([
                'NIM' => $request->NIM,
                'judul' => $request->judul,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'jenis_sidang' => $request->jenis_sidang,
                'berkas' => $berkas . '.' . $extension_berkas,
                'email' => $request->email,
                'link_zoom' => $request->link_zoom
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin-proposal.index')->with('error', 'Proposal gagal diupload');
        }

        return redirect()->route('admin-proposal.index')->with('success', 'Data proposal berhasil diupload');
    }


    public function edit(UploadProposal $admin_proposal)
    {
        return view('admin-proposal.edit', compact('admin_proposal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UploadProposal $admin_proposal)
    {
        $this->validate($request, $this->updateRules, $this->messageRulesUpdate);
        // dd($request, $admin_proposal);
        // $extension_berkas = $request->file('berkas')->getClientOriginalExtension();
        // $berkas = 'Proposal '.Str::replaceFirst('.', '-',auth()->user()->name).'-'.date('His');
        // $request->berkas->move(public_path('/upload/pengajuan/proposal'), $berkas . '.' . $extension_berkas);

        try {
            $data = $admin_proposal->update([
                'NIM' => $request->NIM,
                'judul' => $request->judul,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'jenis_sidang' => $request->jenis_sidang,
                'email' => $request->email,
                'link_zoom' => $request->link_zoom,
                'pukul' => $request->pukul,
                'jadwal_sidang' => $request->jadwal_sidang,
            ]);
            // dd($data, $request->status);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin-proposal.index')->with('error', 'Data mahasiswa gagal diubah');
        }

        return redirect()->route('admin-proposal.index')->with('success', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UploadProposal $admin_proposal)
    {
        try {
            $admin_proposal->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('admin-proposal.index')->with('error', 'Data mahasiswa gagal dihapus');
        }

        return redirect()->route('admin-proposal.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }

    
    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new ProposalExport, 'admin-proposal.xlsx');
    }

    /**
     * The function exports data from a MahasiswaExport object to a PDF file using the DOMPDF library.
     *
     * @return BinaryFileResponse a BinaryFileResponse.
     */
    public function exportPdf(): BinaryFileResponse
    {
        return Excel::download(new ProposalExport, 'admin-proposal.pdf', ExcelType::DOMPDF);
    }
}
