<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    // Barcha unvonlarni chiqarish
    public function index()
    {
        $degrees = Degree::all();
        return view('degrees.index', compact('degrees'));
    }

    // Unvon qo'shish formasi
    public function create()
    {
        return view('degrees.create');
    }

    // Yangi unvonni saqlash
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        // 'description' => 'nullable|string',  <-- Ushbu qatordagi validatsiyani olib tashlang
        // Boshqa maydonlar...
    ]);

    // Agar $request->all() ishlatilsa, u description ham yuboradi. Shu sababli,
    // faqat kerakli maydonlarni olish tavsiya etiladi:
    Degree::create([
        'name' => $request->name,
        // description maydoni kiritilmaydi
    ]);

    return redirect()->route('degrees.index')->with('success', 'Unvon muvaffaqiyatli qo‘shildi.');
}


    // Bitta unvonni ko‘rsatish
    public function show(Degree $degree)
    {
        return view('degrees.show', compact('degree'));
    }

    // Unvonni tahrirlash formasi
    public function edit(Degree $degree)
    {
        return view('degrees.edit', compact('degree'));
    }

    // Unvonni yangilash
    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $degree->update($request->all());
        return redirect()->route('degrees.index')->with('success', 'Unvon muvaffaqiyatli yangilandi.');
    }

    // Unvonni o‘chirish
    public function destroy(Degree $degree)
    {
        $degree->delete();
        return redirect()->route('degrees.index')->with('success', 'Unvon muvaffaqiyatli o\'chirildi.');
    }
}
