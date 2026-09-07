<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Teacher;
use App\Models\Training_Center;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return view('Teacher.index', compact('teachers'));
    }

    public function create()
    {
        $areas = Area::all();
        $trainingCenters = Training_Center::all();
        $teachers = Teacher::all();

        return view('Teacher.create', compact('areas', 'trainingCenters', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document_number' => 'required|string|max:30|unique:teachers,document_number',
            'email' => 'required|email|max:255',
            'access_code' => 'required|string|max:100|unique:teachers,access_code',
            'area_id' => 'nullable|exists:areas,id',
            'training_center_id' => 'nullable|exists:training__centers,id',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Instructor registrado correctamente.');
    }
}

