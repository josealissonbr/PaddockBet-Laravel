<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provas extends Model
{
    use HasFactory;

    protected $primaryKey  = "idProva";

    public function evento(){
        return $this->belongsTo(Eventos::class, 'idEvento', 'idEvento');
    }
}
