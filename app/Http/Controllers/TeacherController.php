<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    // 📌 O‘qituvchilar ro‘yxati
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('surname', 'LIKE', "%{$search}%")
                    ->orWhere('birthday', 'LIKE', "%{$search}%")
                    ->orWhere('specialist', 'LIKE', "%{$search}%")
                    ->orWhere('diplom_number', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%");
            });
        }

        $teachers = $query->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    // 📌 O‘qituvchi qo‘shish formasi
    public function create()
    {
        return view('teachers.create');
    }

    // 📌 O‘qituvchini saqlash
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'birthday' => 'required|date',
                'specialist' => 'required|string|max:255',
                'diplom_number' => 'required|string|max:50',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|unique:teachers,email',
                'address' => 'required|string|max:255',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $teacher = new Teacher();
            $teacher->fill($request->except('image_url'));

            // ✅ Rasmni yuklash va saqlash
            if ($request->hasFile('image_url')) {
                $imagePath = $request->file('image_url')->store('teachers', 'public');
                $teacher->image_url = $imagePath;
            }

            $teacher->save();

            return redirect()->route('teachers.index')->with('success', 'O‘qituvchi muvaffaqiyatli qo‘shildi!');
        } catch (\Exception $e) {
            Log::error('O‘qituvchi saqlashda xatolik: ' . $e->getMessage());
            return back()->withErrors('Xatolik yuz berdi. Iltimos, qayta urinib ko‘ring.')->withInput();
        }
    }

    // 📌 O‘qituvchini ko‘rsatish
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    // 📌 O‘qituvchini tahrirlash formasi
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    // 📌 O‘qituvchini yangilash
    public function update(Request $request, Teacher $teacher)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'birthday' => 'required|date',
                'specialist' => 'required|string|max:255',
                'diplom_number' => 'required|string|max:50',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|unique:teachers,email,' . $teacher->id,
                'address' => 'required|string|max:255',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $teacher->fill($request->except('image_url'));

            // ✅ Eski rasmni o‘chirish va yangi rasm yuklash
            if ($request->hasFile('image_url')) {
                if ($teacher->image_url) {
                    Storage::disk('public')->delete($teacher->image_url);
                }
                $imagePath = $request->file('image_url')->store('teachers', 'public');
                $teacher->image_url = $imagePath;
            }

            $teacher->save();

            return redirect()->route('teachers.index')->with('success', 'O‘qituvchi yangilandi.');
        } catch (\Exception $e) {
            Log::error('O‘qituvchi yangilashda xatolik: ' . $e->getMessage());
            return back()->withErrors('Xatolik yuz berdi. Iltimos, qayta urinib ko‘ring.')->withInput();
        }
    }

    // 📌 O‘qituvchini o‘chirish
    public function destroy(Teacher $teacher)
    {
        try {
            if ($teacher->image_url) {
                Storage::disk('public')->delete($teacher->image_url);
            }

            $teacher->delete();
            return redirect()->route('teachers.index')->with('success', 'O‘qituvchi muvaffaqiyatli o‘chirildi.');
        } catch (\Exception $e) {
            Log::error('O‘qituvchi o‘chirishda xatolik: ' . $e->getMessage());
            return back()->withErrors('Xatolik yuz berdi. Iltimos, qayta urinib ko‘ring.');
        }
    }
}