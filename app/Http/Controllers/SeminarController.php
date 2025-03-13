<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Seminar;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    // Barcha seminarlarni ko'rsatish
    public function index()
    {
        $seminars = Seminar::with('conference')->paginate(10);
        $conferences = Conference::all();
        return view('seminars.index', compact('seminars', 'conferences'));
    }

    // Yangi seminar yaratish formasi
    public function create()
    {
        $conferences = Conference::all(); // Barcha konferensiyalarni olish
        return view('seminars.create', compact('conferences'));
    }

    // Seminarni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'conference_id' => 'required|exists:conferences,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'speaker' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        Seminar::create($request->only(['conference_id', 'title', 'start_time', 'end_time', 'speaker', 'details']));

        return redirect()->route('seminars.index')->with('success', 'Seminar muvaffaqiyatli qoshildi!');
    }

    // Bitta seminarni ko'rsatish
    public function show(Seminar $seminar)
    {
        return view('seminars.show', compact('seminar'));
    }

    // Seminarni tahrirlash formasi
    public function edit(Seminar $seminar)
    {
        $conferences = Conference::all(); // Tahrirlash uchun konferensiyalar ro'yxati
        return view('seminars.edit', compact('seminar', 'conferences'));
    }

    // Seminarni yangilash
    public function update(Request $request, Seminar $seminar)
    {
        $request->validate([
            'conference_id' => 'required|exists:conferences,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'speaker' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $seminar->update($request->only(['conference_id', 'title', 'start_time', 'end_time', 'speaker', 'details']));

        return redirect()->route('seminars.index')->with('success', 'Seminar muvaffaqiyatli yangilandi!');
    }

    // Seminarni o'chirish
    public function destroy(Seminar $seminar)
    {
        $seminar->delete();

        return redirect()->route('seminars.index')->with('success', 'Seminar ochirildi!');
    }
}
