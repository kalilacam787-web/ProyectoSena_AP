<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $areas,
            ], 200);
        }

        return view('Area.index', compact('areas'));
    }

    public function create()
    {

        $areas = Area::all();

        return view('Area.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $area = Area::create($validated);

        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $area->urlFoto = $nombreArchivo;
            $area->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Área registrada correctamente.',
                'data' => $area->fresh(),
            ], 201);
        }

        return redirect()->route('areas.index')->with('success', 'Área registrada correctamente.');
    }
}