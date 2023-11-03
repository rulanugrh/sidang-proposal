<?php

namespace App\Exports;

use App\Models\UploadProposal;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProposalExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return UploadProposal::all();
    }
}
