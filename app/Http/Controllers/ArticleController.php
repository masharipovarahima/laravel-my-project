<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Maqolalar ro'yxatini ko'rsatish.
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Yangi maqola qo'shish formasi.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Yangi maqolani bazaga qo'shish.
     */
    public function store(Request $request)
    {
        // ✅ So'rovni validatsiya qilamiz
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'file'           => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // Maksimal 5MB
            'journal_name'   => 'nullable|string|max:255',
            'published_date' => 'required|date',
        ]);

        // ✅ Fayl yuklangan bo‘lsa, uni saqlaymiz
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('articles', $fileName, 'public'); // Faylni saqlash
            $validated['file_url'] = $filePath; // Bazaga saqlanadigan yo‘l
        }

        // ✅ Ma'lumotlarni bazaga saqlaymiz
        Article::create([
            'name'           => $validated['name'],
            'file_url'       => $validated['file_url'] ?? null,  // ❗️ To‘g‘ri maydon nomi ishlatildi
            'journal_name'   => $validated['journal_name'],
            'published_date' => $validated['published_date'],
        ]);

        return redirect()->route('articles.index')
                         ->with('success', 'Maqola muvaffaqiyatli qo‘shildi!');
    }

    /**
     * Muayyan maqolani ko'rsatish.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Maqolani tahrirlash formasi.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Maqolani yangilash.
     */
    public function update(Request $request, Article $article)
    {
        // ✅ So'rovni validatsiya qilamiz
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'file'           => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // Maksimal 5MB
            'journal_name'   => 'nullable|string|max:255',
            'published_date' => 'required|date',
        ]);

        // ✅ Agar yangi fayl yuklangan bo‘lsa
        if ($request->hasFile('file')) {
            // Eski faylni o‘chiramiz
            if ($article->file_url) {
                Storage::disk('public')->delete($article->file_url);
            }

            // Yangi faylni saqlaymiz
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('articles', $fileName, 'public');
            $validated['file_url'] = $filePath;
        }

        // ✅ Maqolani yangilaymiz
        $article->update([
            'name'           => $validated['name'],
            'file_url'       => $validated['file_url'] ?? $article->file_url,
            'journal_name'   => $validated['journal_name'],
            'published_date' => $validated['published_date'],
        ]);

        return redirect()->route('articles.index')
                         ->with('success', 'Maqola muvaffaqiyatli yangilandi!');
    }

    /**
     * Maqolani o'chirish.
     */
    public function destroy(Article $article)
    {
        // ✅ Agar fayl mavjud bo'lsa, uni o'chiramiz
        if ($article->file_url) {
            Storage::disk('public')->delete($article->file_url);
        }

        // ✅ Maqolani bazadan o'chiramiz
        $article->delete();

        return redirect()->route('articles.index')
                         ->with('success', 'Maqola muvaffaqiyatli o‘chirildi!');
    }
}
