<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authenticationLogs extends Model
{
    use HasFactory;

    protected $table = 'authenticationLogs';

    protected $fillable = [
        'idCliente',
        'ip',
        'agent'
    ];
}
