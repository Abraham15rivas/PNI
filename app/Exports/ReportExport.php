<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $value;

    public function __construct(array $value){
        $this->value = $value;
    }
    
    public function view(): View
    {
        return view('reports.partials-pdf.main', $this->value);
    }
}
