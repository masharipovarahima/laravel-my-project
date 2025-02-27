<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Barcha fayllarni ko'rsatish.
     */
    public function index()
    {
        $files = File::all();            // Barcha fayllar
        $subjects = Subject::all();      // Barcha fanlar
        return view('files.index', compact('files', 'subjects'));
    }

    /**
     * Fayl yuklash formasi.
     */
    public function create()
    {
        $subjects = Subject::pluck('name');
        return view('files.create', compact('subjects'));
    }

    /**
     * Faylni saqlash.
     */
    public function store(Request $request)
    {
        // dd(vars: $request->all());
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $filePath = $request->file('file')->store('files', 'public');

        File::create([
            'file_url' => $filePath,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('files.index')->with('success', 'Fayl muvaffaqiyatli yuklandi!');
    }

    /**
     * Faylni tahrirlash formasi.
     */
    public function edit($subject_name)
    {
        $file = File::where('subject_name', $subject_name)->firstOrFail();
        $subjects = Subject::pluck('name');

        return view('files.edit', compact('file', 'subjects'));
    }

    /**
     * Faylni yangilash.
     */
    public function update(Request $request, $subject_name)
    {
        $file = File::where('subject_name', $subject_name)->firstOrFail();

        $validated = $request->validate([
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'subject_name' => 'required|exists:subjects,name',
        ]);

        if ($request->hasFile('file')) {
            if ($file->file_url && Storage::disk('public')->exists($file->file_url)) {
                Storage::disk('public')->delete($file->file_url);
            }
            $file->file_url = $request->file('file')->store('files', 'public');
        }

        $file->subject_name = $request->subject_name;
        $file->save();

        return redirect()->route('files.index')->with('success', 'Fayl muvaffaqiyatli yangilandi!');
    }

    /**
     * Faylni o'chirish.
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id); // Faylni topish
        $subject_name = $file->subject?->name;
        if ($file->file_url && Storage::disk('public')->exists($file->file_url)) {
            Storage::disk('public')->delete($file->file_url);
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', "'{$subject_name}' fani uchun fayl muvaffaqiyatli o'chirildi!");
    }

    /**
     * Faylni yuklab olish.
     */
    public function download($id)
    {
        $file = File::findOrFail($id); // Faylni topish

        if (!Storage::disk('public')->exists($file->file_url)) {
            return redirect()->route('files.index')->with('error', 'Fayl topilmadi!');
        }

        return Storage::disk('public')->download($file->file_url);
    }
}
