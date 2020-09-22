<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $table = "parroquias";

    public function municipality ()
    {
        return $this->belongsTo(Municipality::class, 'id_municipio', 'id_municipio');
    }
}
