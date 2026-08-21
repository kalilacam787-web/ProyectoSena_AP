<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('order')->get();
        return view('Gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/gallery'), $imageName);
            $validated['image_path'] = 'images/gallery/' . $imageName;
        }

        Gallery::create($validated);

        return redirect()->route('galleries.index')->with('success', 'Imagen agregada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('Gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('Gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (file_exists(public_path($gallery->image_path))) {
                unlink(public_path($gallery->image_path));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/gallery'), $imageName);
            $validated['image_path'] = 'images/gallery/' . $imageName;
        }

        $gallery->update($validated);

        return redirect()->route('galleries.index')->with('success', 'Imagen actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if (file_exists(public_path($gallery->image_path))) {
            unlink(public_path($gallery->image_path));
        }

        $gallery->delete();
        return redirect()->route('galleries.index')->with('success', 'Imagen eliminada correctamente.');
    }
}
