<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informations = Information::all(); // Barcha ma'lumotlarni olish
        return view('information.index', compact('informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('information.create'); // 'create.blade.php' ni qaytarish
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ma'lumotlarni validatsiya qilish
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Ma'lumotni yaratish
        Information::create($validated);

        return redirect()->route('information.index')->with('success', 'Malumot muvaffaqiyatli qoshildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        return view('information.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        return view('information.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Ma'lumotni yangilash
        $information->update($validated);

        return redirect()->route('information.index')->with('success', 'Malumot muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        $information->delete();

        return redirect()->route('information.index')->with('success', 'Malumot muvaffaqiyatli ochirildi!');
    }
}
