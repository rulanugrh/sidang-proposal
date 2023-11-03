<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\AuthGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MahasiswaController extends Controller
{
    private $rules = [
        'NIM' => 'required|unique:mahasiswa,NIM',
        'name' => 'required',
        'date_of_birth' => 'required',
        'address' => 'required',
        'email' => 'required|unique:users,email'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.index', [
            'mahasiswas' => Mahasiswa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        
        // DB::beginTransaction();
        try {
            Mahasiswa::create($request->all());
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['NIM'],
                'password' => bcrypt($request['NIM'])

            ]);

            AuthGroupUser::create([
                'auth_group_id' => 2,
                'user_id' => $user->id
            ]);

            // DB::commit();
            

        } catch (\Exception $e) {
            // DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa gagal ditambahkan');
        }
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // $this->validate($request, $this->rules);

        try {
            User::where('email', $mahasiswa->email)->update([
                'email' => $request['email'],
                'name' => $request['name'],
            ]);
            
            $mahasiswa->update($request->all());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa gagal diubah');
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        try {
            $mahasiswa->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa gagal dihapus');
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }

    /**
     * The function exports data from a MahasiswaExport class to an Excel file and returns it as a
     * BinaryFileResponse.
     *
     * @return BinaryFileResponse a BinaryFileResponse.
     */
    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    /**
     * The function exports data from a MahasiswaExport object to a PDF file using the DOMPDF library.
     *
     * @return BinaryFileResponse a BinaryFileResponse.
     */
    public function exportPdf(): BinaryFileResponse
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.pdf', ExcelType::DOMPDF);
    }
}
