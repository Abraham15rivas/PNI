<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = "municipios";

    public function state ()
    {
        return $this->belongsTo(State::class, 'id_estado', 'id_estado');
    }

    public function parishes ()
    {
        return $this->hasMany(Parish::class, 'id_municipio', 'id_municipio');
    }
}
