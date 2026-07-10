<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titulo',
        'isbn',
        'anio_publicacion',
        'numero_paginas',
        'descripcion',
        'stock_disponible'
    ];

    protected $casts = [
        'anio_publicacion' => 'integer',
        'numero_paginas' => 'integer',
        'stock_disponible' => 'integer',
    ];

   
    public function autores()
    {
        return $this->belongsToMany(
            Autor::class,
            'autor_libro'
        )->withPivot('orden_autor');
    }

   
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

   
    public function scopeDisponibles($query)
    {
        return $query->where('stock_disponible', '>', 0);
    }

    
    public function scopePorAnio($query, $anio)
    {
        return $query->where('anio_publicacion', $anio);
    }

   
    public function scopePorAutor($query, $autorId)
    {
        return $query->whereHas('autores', function ($q) use ($autorId) {
            $q->where('autores.id', $autorId);
        });
    }
}