<?php

namespace App\Exports;

use App\Models\Zakat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ZakatExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('zakat.excel', [
            'zakat' => Zakat::orderBy('id', 'DESC')->get()
        ]);
    }
}
