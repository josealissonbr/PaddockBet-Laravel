<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apostas extends Model
{
    use HasFactory;

    protected $primaryKey  = "idAposta";

    public function prova(){
        return $this->belongsTo(Provas::class, 'idProva', 'idProva')->with('evento');
    }

}
