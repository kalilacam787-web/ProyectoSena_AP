<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index(Request $request)
    {
        $computer = Computer::all();

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $computer,
            ], 200);
        }

        return view('Computer.index', compact('computer'));
    }

    public function create()
    {
        $computers = Computer::all();

        return view('Computer.create', compact('computers'));
    }

    public function edit(Computer $computer)
    {
        return view('Computer.edit', compact('computer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:50|unique:computers,number',
            'brand' => 'required|string|max:100',
            'assigned_name' => 'nullable|string|max:255',
            'assigned_document' => 'nullable|string|max:30',
            'assigned_email' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $computer = Computer::create($validated);
        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $computer->urlFoto = $nombreArchivo;
            $computer->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Computador registrado correctamente.',
                'data' => $computer->fresh(),
            ], 201);
        }

        return redirect()->route('computers.index')->with('success', 'Computador registrado correctamente.');
    }

    public function update(Request $request, Computer $computer)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:50|unique:computers,number,' . $computer->id,
            'brand' => 'required|string|max:100',
            'assigned_name' => 'nullable|string|max:255',
            'assigned_document' => 'nullable|string|max:30',
            'assigned_email' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $computer->update($validated);

        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $computer->urlFoto = $nombreArchivo;
            $computer->save();
        }

        return redirect()->route('computers.index')->with('success', 'Computador actualizado correctamente.');
    }
    
    public function destroy(Computer $computer)
    {
        $computer->delete();
        
        return redirect()->route('computers.index')->with('success', 'Computador eliminado correctamente.');
    }
}