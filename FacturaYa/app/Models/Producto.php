<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'nombre',
        'imagen',
        'precio',
        'medida',
        'categoria_id',
        'impuesto_id'
    ];
}
