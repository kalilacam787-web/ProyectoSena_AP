<?php

namespace App\Http\Controllers;

use App\Models\Training_Center;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    public function index()
    {
        $trainingCenters = Training_Center::all();

        $officialCenters = collect([
            [
                'name' => 'Centro Agropecuario',
                'location' => 'Km 5 vía al Tambo, Popayán, Cauca',
            ],
            [
                'name' => 'Centro de Comercio y Servicios',
                'location' => 'Calle 4 No. 2-80, Popayán, Cauca',
            ],
            [
                'name' => 'Centro de Teleinformática y Producción Industrial',
                'location' => 'Carrera 9 No. 71N-60, Popayán, Cauca',
            ],
            [
                'name' => 'Centro Industrial del Cauca',
                'location' => 'Carrera 13 No. 3-60, Santander de Quilichao, Cauca',
            ],
            [
                'name' => 'Centro Agroindustrial del Cauca',
                'location' => 'Calle 5 No. 8-20, Puerto Tejada, Cauca',
            ],
        ]);

        return view('Training_Center.index', compact('trainingCenters', 'officialCenters'));
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

        Training_Center::create($validated);

        return redirect()->route('training-centers.index')->with('success', 'Centro de formación registrado correctamente.');
    }
}
