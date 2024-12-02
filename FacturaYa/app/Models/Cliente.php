<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'clientes';

    protected $fillable = [
        'numero_documento',
        'direccion',
        'telefono',
        'email',
        'ciudad',
        'estado'
    ];
}
