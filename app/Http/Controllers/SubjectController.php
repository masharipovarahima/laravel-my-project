<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Barcha fanlarni (subject) chiqarish.
     */
    public function index()
    {
        // O'qituvchilar bilan birga barcha fanni olish
        $subjects = Subject::with('teacher')->get();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Yangi fan qo'shish formasi.
     */
    public function create()
    {
        // Yangi fan qo'shishda foydalanish uchun barcha o'qituvchilar ro'yxatini olish
        $teachers = Teacher::all();
        return view('subjects.create', compact('teachers'));
    }

    /**
     * Yangi fanni saqlash.
     */
    public function store(Request $request)
    {
        // Ma'lumotlarni validatsiya qilamiz
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'specialist'  => 'required|string|max:255',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        // Yangi fanni bazaga saqlaymiz
        Subject::create($validatedData);

        return redirect()->route('subjects.index')
                         ->with('success', 'Fan muvaffaqiyatli qo‘shildi.');
    }

    /**
     * Bitta fanni ko'rsatish.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Fanni tahrirlash formasi.
     */
    public function edit(Subject $subject)
    {
        // Tahrirlash formasi uchun barcha o'qituvchilar ro'yxatini ham olish
        $teachers = Teacher::all();
        return view('subjects.edit', compact('subject', 'teachers'));
    }

    /**
     * Fanni yangilash.
     */
    public function update(Request $request, Subject $subject)
    {
        // Yangilanish uchun validatsiya qoidalari
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'specialist'  => 'required|string|max:255',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        // Fanni yangilaymiz
        $subject->update($validatedData);

        return redirect()->route('subjects.index')
                         ->with('success', 'Fan muvaffaqiyatli yangilandi.');
    }

    /**
     * Fanni o'chirish.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')
                         ->with('success', 'Fan muvaffaqiyatli o‘chirildi.');
    }
}
