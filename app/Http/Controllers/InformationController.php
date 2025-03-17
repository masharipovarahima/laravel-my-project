<?php

// InformationController
namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    // Ma'lumotlar ro'yxati
    public function index()
    {
        $informations = Information::all();
        return view('information.index', compact('informations'));
    }

    // Yangi ma'lumot yaratish
    public function create()
    {
        return view('information.create');
    }

    // Ma'lumotni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'directions_info' => 'nullable|string',
            'position_title' => 'nullable|string|max:255',
            'position_description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'group_address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Information::create($request->all());

        return redirect()->route('information.index')->with('success', 'Malumot muvaffaqiyatli qoshildi!');
    }

    // Ma'lumotni tahrirlash
    public function edit($id)
    {
        $information = Information::findOrFail($id);
        return view('information.edit', compact('information'));
    }

    // Ma'lumotni yangilash
    public function update(Request $request, $id)
    {
        $information = Information::findOrFail($id);
        $request->validate([
            'directions_info' => 'nullable|string',
            'position_title' => 'nullable|string|max:255',
            'position_description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'group_address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90', // Restrict latitude to -90 to 90
            'longitude' => 'nullable|numeric|between:-180,180', // Restrict longitude to -180 to 180
        ]);

        $information->update($request->all());

        return redirect()->route('information.index')->with('success', 'Malumot muvaffaqiyatli yangilandi!');
    }
    // Ma'lumotni o'chirish
    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return redirect()->route('information.index')->with('success', 'Malumot muvaffaqiyatli ochirildi!');
    }
}
