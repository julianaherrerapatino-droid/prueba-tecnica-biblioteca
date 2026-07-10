<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prestamo;
use App\Models\Libro;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Listar todos los préstamos.
     */
    public function index()
    {
        $prestamos = Prestamo::with(['usuario', 'libro'])->get();

        return response()->json($prestamos);
    }

    /**
     * Registrar un préstamo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'libro_id' => 'required|exists:libros,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion_estimada' => 'required|date'
        ]);

        $libro = Libro::find($request->libro_id);

        if ($libro->stock_disponible <= 0) {
            return response()->json([
                'mensaje' => 'No hay stock disponible para este libro.'
            ], 400);
        }

        $prestamo = Prestamo::create([
            'user_id' => $request->user_id,
            'libro_id' => $request->libro_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_devolucion_estimada' => $request->fecha_devolucion_estimada,
            'estado' => 'Prestado'
        ]);

        $libro->stock_disponible--;
        $libro->save();

        return response()->json([
            'mensaje' => 'Préstamo registrado correctamente.',
            'prestamo' => $prestamo
        ], 201);
    }

    /**
     * Devolver un libro.
     */
    public function devolver($id)
    {
        $prestamo = Prestamo::find($id);

        if (!$prestamo) {
            return response()->json([
                'mensaje' => 'Préstamo no encontrado.'
            ], 404);
        }

        if ($prestamo->estado === 'Devuelto') {
            return response()->json([
                'mensaje' => 'Este préstamo ya fue devuelto.'
            ], 400);
        }

        $prestamo->fecha_devolucion_real = now();
        $prestamo->estado = 'Devuelto';
        $prestamo->save();

        $libro = Libro::find($prestamo->libro_id);
        $libro->stock_disponible++;
        $libro->save();

        return response()->json([
            'mensaje' => 'Libro devuelto correctamente.',
            'prestamo' => $prestamo
        ]);
    }
}