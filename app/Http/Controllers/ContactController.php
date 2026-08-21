<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('Contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_fixed' => 'nullable|string',
            'phone_mobile' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        Contact::create($validated);

        return redirect()->route('contacts.index')->with('success', 'Contacto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('Contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('Contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_fixed' => 'nullable|string',
            'phone_mobile' => 'nullable|string',
            'message' => 'nullable|string',
            'status' => 'in:pending,resolved'
        ]);

        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contacto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contacto eliminado correctamente.');
    }
}
