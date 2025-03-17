<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Yangiliklar ro'yxatini ko'rsatish
     */
    public function index()
    {
        // 'date' o'rniga 'published_at' dan foydalanamiz
        $news = News::orderBy('published_at', 'desc')->where('title', 'like', '%' . request('search') . '%')->get();
        return view('news.index', compact('news'));
    }

    /**
     * Yangilik qo'shish sahifasini ko'rsatish
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Yangilikni saqlash
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'published_at' => 'required|date',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Rasmni saqlash
        $imagePath = $this->uploadPhoto($request->file('image'), 'news_images');

        // Yangilikni yaratish
        News::create([
            'title' => $request->title,
            'published_at' => $request->published_at,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'Yangilik muvaffaqiyatli qo\'shildi!');
    }

    /**
     * Yangilikni ko'rish
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Yangilikni tahrirlash sahifasi
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Yangilikni yangilash
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'published_at' => 'required|date',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Rasmni yangilash
        if ($request->hasFile('image')) {
            $this->deletePhoto($news->image);
            $imagePath = $this->uploadPhoto($request->file('image'), 'news_images');
            $news->image = $imagePath;
        }

        // Yangilikni yangilash
        $news->update([
            'title' => $request->title,
            'published_at' => $request->published_at,
            'content' => $request->content,
        ]);

        return redirect()->route('news.index')->with('success', 'Yangilik yangilandi!');
    }

    /**
     * Yangilikni o'chirish
     */
    public function destroy(News $news)
    {
        // Rasmni o'chirish
        $this->deletePhoto($news->image);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Yangilik o\'chirildi!');
    }
}
