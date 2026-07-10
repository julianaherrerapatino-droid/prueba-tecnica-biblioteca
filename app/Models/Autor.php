<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'nacionalidad',
        'biografia'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function libros()
    {
        return $this->belongsToMany(
            Libro::class,
            'autor_libro'
        )->withPivot('orden_autor');
    }
}