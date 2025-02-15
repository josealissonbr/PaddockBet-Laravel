<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacoes extends Model
{
    use HasFactory;

    protected $primaryKey  = "idTransacao";

    public function user(){
        return $this->belongsTo(User::class, 'idCliente', 'id');
    }
}
