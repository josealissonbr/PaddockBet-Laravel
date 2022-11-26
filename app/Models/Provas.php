<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provas extends Model
{
    use HasFactory;

    protected $primaryKey  = "idProva";

    //const UPDATED_AT = NULL;

    public function evento(){
        return $this->belongsTo(Eventos::class, 'idEvento', 'idEvento');
    }

    public function conjuntos(){
        return $this->hasMany(provasConjuntos::class, 'idProva', 'idProva');
    }

    public function conjuntoVencedor(){
        return $this->belongsTo(provasConjuntos::class, 'idConjuntoVencedor', 'idProvaConjunto');
    }
}
