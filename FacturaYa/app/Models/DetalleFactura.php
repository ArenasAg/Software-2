<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'valor_total',
        'descuento',
        'producto_id',
        'factura_id'
    ];
}
