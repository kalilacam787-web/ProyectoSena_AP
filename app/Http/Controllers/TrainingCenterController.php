<?php

namespace App\Http\Controllers;

use App\Models\Training_Center;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('location', ''));
        $locationOptions = Training_Center::query()
            ->get(['name', 'location'])
            ->flatMap(fn ($center) => [$center->name, $center->location])
            ->unique()
            ->values();
        $trainingCenters = Training_Center::with('courses')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->get();
        $trainingCentersByLocation = $trainingCenters->groupBy(function ($center) {
            $parts = collect(explode(',', $center->location))
                ->map(fn ($part) => trim($part))
                ->filter()
                ->values();

            if ($parts->count() >= 2) {
                return $parts->slice(-2)->implode(', ');
            }

            return $center->location;
        });

        if ($request->expectsJson()) {
            return response()->json([
                'data' => $trainingCenters,
            ], 200);
        }

        return view('Training_Center.index', compact('trainingCenters', 'trainingCentersByLocation', 'search', 'locationOptions'));
    }

    public function create()
    {
        $trainingCenters = Training_Center::all();

        return view('Training_Center.create', compact('trainingCenters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $trainingCenter = Training_Center::create($validated);
        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $nombreArchivo = 'foto_' . time() . '.' . $file->guessExtension();
            $file->storeAs('public/images', $nombreArchivo);
            $trainingCenter->urlFoto = $nombreArchivo;
            $trainingCenter->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Centro de formación registrado correctamente.',
                'data' => $trainingCenter->fresh(),
            ], 201);
        }

        return redirect()->route('training-centers.index')->with('success', 'Centro de formación registrado correctamente.');
    }
}
