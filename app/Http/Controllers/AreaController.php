<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();

        return view('Area.index', compact('areas'));
    }

    public function create()
    {
        $areas = Area::all();

        return view('Area.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $area = Area::create($request->all());

        return redirect()->route('areas.index')->with('success', 'Área registrada correctamente.');
    }
}