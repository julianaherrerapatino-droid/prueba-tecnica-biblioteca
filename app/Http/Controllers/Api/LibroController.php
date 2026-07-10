<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Mostrar todos los libros.
     */
    public function index(Request $request)
    {
        $query = Libro::query();

        // Filtrar por título
        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        // Filtrar por año
        if ($request->filled('anio')) {
            $query->porAnio($request->anio);
        }

        // Filtrar por autor
        if ($request->filled('autor')) {
            $query->porAutor($request->autor);
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Guardar un nuevo libro.
     */
public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'isbn' => 'required|string|unique:libros,isbn',
        'anio_publicacion' => 'required|integer',
        'numero_paginas' => 'required|integer',
        'descripcion' => 'nullable|string',
        'stock_disponible' => 'required|integer|min:0',
    ]);

    $libro = Libro::create($request->all());

    return response()->json([
        'mensaje' => 'Libro creado correctamente',
        'libro' => $libro
    ], 201);

}

    /**
     * Mostrar un libro por ID.
     */
public function show(string $id)
    {
        $libro = Libro::find($id);

        if (!$libro) {
            return response()->json([
                'mensaje' => 'Libro no encontrado'
            ], 404);
        }

        return response()->json($libro);
    }

    /**
     * Actualizar un libro.
     */
    public function update(Request $request, string $id)
    {
        $libro = Libro::find($id);

        if (!$libro) {
            return response()->json([
                'mensaje' => 'Libro no encontrado'
            ], 404);
        }

        $libro->update($request->all());

        return response()->json([
            'mensaje' => 'Libro actualizado correctamente',
            'libro' => $libro
        ]);
    }

    /**
     * Eliminar un libro.
     */
    public function destroy(string $id)
    {
        $libro = Libro::find($id);

        if (!$libro) {
            return response()->json([
                'mensaje' => 'Libro no encontrado'
            ], 404);
        }

        $libro->delete();

        return response()->json([
            'mensaje' => 'Libro eliminado correctamente'
        ]);
    }
}