<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // Barcha bo'limlarni ko'rsatish
    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    // Yangi bo'lim yaratish formasi
    public function create()
    {
        return view('sections.create');
    }

    // Yangi bo'limni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'map_embed_code' => 'nullable|string',
        ]);

        Section::create($request->all());

        return redirect()->route('sections.index')->with('success', 'Bo\'lim muvaffaqiyatli qo\'shildi!');
    }

    // Bo'limni tahrirlash
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    // Bo'limni yangilash
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'type' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'map_embed_code' => 'nullable|string',
        ]);

        $section->update($request->all());

        return redirect()->route('sections.index')->with('success', 'Bo\'lim muvaffaqiyatli yangilandi!');
    }

    // Bo'limni o'chirish
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Bo\'lim o\'chirildi!');
    }
}
