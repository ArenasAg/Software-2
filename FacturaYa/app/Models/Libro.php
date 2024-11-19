<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'libros';

    protected $fillable = [
        'codigo',
        'nombre',
        'imagen',
        'precio',
        'medida',
        'stock',
        'categoria_id',
        'impuesto_id'
    ];
}
