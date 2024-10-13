<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'fecha',
        'subtotal',
        'total_impuestos',
        'total',
        'estado',
        'cliente_id',
        'metodo_pago_id'
    ];
}
