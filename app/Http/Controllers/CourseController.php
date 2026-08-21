<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Course;
use App\Models\Training_Center;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('Course.index', compact('courses'));
    }

    public function create()
    {
        $areas = Area::all();
        $training_centers = Training_Center::all();
        $courses = Course::all();

        return view('Course.create', compact('areas', 'training_centers', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|in:Cocina,Inglés,Francés,Costura,Mecánica,Electricidad',
            'schedule' => 'required|string|max:100',
            'duration_months' => 'required|integer|min:1|max:4',
            'course_number' => 'nullable|string|max:50',
            'day' => 'nullable|string|max:100',
            'area_id' => 'nullable|exists:areas,id',
            'training_center_id' => 'nullable|exists:training__centers,id',
        ]);

        $validated['course_number'] = $validated['course_number'] ?? strtoupper(substr($validated['name'], 0, 3));
        $validated['day'] = $validated['day'] ?? $validated['schedule'];
        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Curso registrado correctamente.');
    }
}