<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profile()
    {
        return view('Admin.profile', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'document_type' => ['required', 'in:CC,TI,CE,PP,NIT'],
            'document_number' => ['required', 'digits_between:6,15'],
        ], [
            'document_number.digits_between' => 'El documento debe tener entre 6 y 15 números.',
            'document_number.digits' => 'El documento solo puede contener números.',
        ]);

        $request->user()->update($data);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
