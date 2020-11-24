<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "estados";
    protected $primaryKey = 'id_estado';
    public function municipalities ()
    {
        return $this->hasMany(Municipality::class, 'id_estado', 'id_estado');
    }
}
