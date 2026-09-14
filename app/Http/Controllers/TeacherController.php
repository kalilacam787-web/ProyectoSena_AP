<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Teacher;
use App\Models\Training_Center;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::all();

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $teachers,
            ], 200);
        }

        return view('Teacher.index', compact('teachers'));
    }

    public function create()
    {
        $areas = Area::all();
        $trainingCenters = Training_Center::all();
        $teachers = Teacher::all();

        return view('Teacher.create', compact('areas', 'trainingCenters', 'teachers'));
    }

    public function dashboard(Request $request)
    {
        $teacher = Teacher::with(['area', 'trainingCenter'])
            ->findOrFail($request->session()->get('instructor_id'));

        return view('Teacher.dashboard', compact('teacher'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document_type' => 'required|in:CC,PAS,OTRO',
            'document_number' => 'required|string|max:30|unique:teachers,document_number',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'access_code' => 'required|string|max:100|unique:teachers,access_code',
            'area_id' => 'nullable|exists:areas,id',
            'training_center_id' => 'nullable|exists:training_centers,id',
        ]);
        $teacher = Teacher::create($validated);
        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $teacher->urlFoto = $nombreArchivo;
            $teacher->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Instructor registrado correctamente.',
                'data' => $teacher->fresh(),
            ], 201);
        }

        return redirect()->route('teachers.index')->with('success', 'Instructor registrado correctamente.');
    }
}

