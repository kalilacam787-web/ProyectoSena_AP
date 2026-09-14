<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Computer;
use App\Models\Course;
use Illuminate\Http\Request;

class ApprenticeController extends Controller
{
    public function index(Request $request)
    {
        $apprentices = Apprentice::with(['course.trainingCenter', 'computer'])->get();

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $apprentices,
            ], 200);
        }

        return view('Apprentice.index', compact('apprentices'));
    }

    public function create()
    {
        $courses = Course::all();
        $computers = Computer::all();
        $apprentices = Apprentice::all();

        return view('Apprentice.create', compact('courses', 'computers', 'apprentices'));
    }

    public function enrollmentForm(Course $course)
    {
        return view('Apprentice.enroll', compact('course'));
    }

    public function enroll(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_type' => 'required|in:CC,TI,PAS',
            'document_number' => 'required|string|max:30|unique:apprentices,document_number',
            'email' => 'required|email|max:255',
        ]);

        Apprentice::create([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'document_type' => $validated['document_type'],
            'document_number' => $validated['document_number'],
            'email' => $validated['email'],
            'cell_number' => '',
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Inscripción enviada correctamente.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_type' => 'required|in:CC,TI,PAS',
            'document_number' => 'required|string|max:30|unique:apprentices,document_number',
            'email' => 'required|email|max:255',
            'cell_number' => 'required|string|max:20',
            'course_id' => 'nullable|exists:courses,id',
            'computer_id' => 'nullable|exists:computers,id',
        ]);
        $apprentice = Apprentice::create($validated);
        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $apprentice->urlFoto = $nombreArchivo;
            $apprentice->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Aprendiz registrado correctamente.',
                'data' => $apprentice->fresh(),
            ], 201);
        }

        return redirect()->route('apprentices.index')->with('success', 'Aprendiz registrado correctamente.');
    }
    
    public function destroy(Apprentice $apprentice)
    {
        $apprentice->delete();
        
        return redirect()->route('apprentices.index')->with('success', 'Aprendiz eliminado correctamente.');
    }
}


