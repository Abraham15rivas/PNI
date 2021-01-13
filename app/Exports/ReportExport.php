<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $value;

    public function __construct($value){
        $this->value = $value;
    }

    public function collection()
    {
        dd($this->value);
        return $this->value;
    }
}
