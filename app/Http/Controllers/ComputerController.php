<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index()
    {
        $computer = Computer::all();

        return view('Computer.index', compact('computer'));
    }

    public function create()
    {
        $computers = Computer::all();

        return view('Computer.create', compact('computers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:50|unique:computers,number',
            'brand' => 'required|string|max:100',
            'assigned_name' => 'nullable|string|max:255',
            'assigned_document' => 'nullable|string|max:30',
            'assigned_email' => 'nullable|email|max:255',
        ]);

        Computer::create($validated);

        return redirect()->route('computers.index')->with('success', 'Computador registrado correctamente.');
    }
    
    public function destroy(Computer $computer)
    {
        $computer->delete();
        
        return redirect()->route('computers.index')->with('success', 'Computador eliminado correctamente.');
    }
}