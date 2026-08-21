<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Computer;
use App\Models\Course;
use Illuminate\Http\Request;

class ApprenticeController extends Controller
{
    public function index()
    {
        $apprentices = Apprentice::all();

        return view('Apprentice.index', compact('apprentices'));
    }

    public function create()
    {
        $courses = Course::all();
        $computers = Computer::all();
        $apprentices = Apprentice::all();

        return view('Apprentice.create', compact('courses', 'computers', 'apprentices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document_number' => 'required|string|max:30|unique:apprentices,document_number',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
            'cell_number' => 'nullable|string|max:30',
            'course_id' => 'nullable|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);

        Apprentice::create($validated);

        return redirect()->route('apprentices.index')->with('success', 'Aprendiz registrado correctamente.');
    }
    
    public function destroy(Apprentice $apprentice)
    {
        $apprentice->delete();
        
        return redirect()->route('apprentices.index')->with('success', 'Aprendiz eliminado correctamente.');
    }
}


