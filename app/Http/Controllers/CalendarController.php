<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Exports\EventExport;
use App\Models\Event;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class CalendarController extends Controller
{
    public function index() {
        return view('event.index', [
            'events' => Event::all()
        ]);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request) {

        try {
            Event::create($request->all());

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('event.index')->with('error', 'Event gagal diupload');
        }

        return redirect()->route('event.index')->with('success', 'Data Event berhasil diupload');
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {


        try {
            $event->update($request->all());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('event.index')->with('error', 'Data Event gagal diubah');
        }

        return redirect()->route('event.index')->with('success', 'Data Event berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            $event->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('event.index')->with('error', 'Data Event gagal dihapus');
        }

        return redirect()->route('event.index')->with('success', 'Data Event berhasil dihapus');
    }

    
    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new EventExport, 'event.xlsx');
    }

    /**
     * The function exports data from a MahasiswaExport object to a PDF file using the DOMPDF library.
     *
     * @return BinaryFileResponse a BinaryFileResponse.
     */
    public function exportPdf(): BinaryFileResponse
    {
        return Excel::download(new EventExport, 'event.pdf', ExcelType::DOMPDF);
    }
}
