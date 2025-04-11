<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Yangiliklar ro'yxatini ko'rsatish
     */
    public function index()
    {
        $search = request('search');
        $news = News::orderBy('published_at', 'desc')
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->get();

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

        $imagePath = $this->uploadPhoto($request->file('image'), 'news_images');

        News::create([
            'title' => $request->title,
            'published_at' => $request->published_at,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'Yangilik muvaffaqiyatli qo‘shildi!');
    }

    /**
     * Yangilikni ko‘rsatish
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

        if ($request->hasFile('image')) {
            $this->deletePhoto($news->image);
            $news->image = $this->uploadPhoto($request->file('image'), 'news_images');
        }

        $news->update([
            'title' => $request->title,
            'published_at' => $request->published_at,
            'content' => $request->content,
            'image' => $news->image,
        ]);

        return redirect()->route('news.index')->with('success', 'Yangilik yangilandi!');
    }

    /**
     * Yangilikni o‘chirish
     */
    public function destroy(News $news)
    {
        $this->deletePhoto($news->image);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Yangilik o‘chirildi!');
    }

   /**
 * Rasmni yuklash
 */
public function handlePhotoUpload($image, $folder): mixed
{
    if ($image) {
        return $image->store($folder, 'public');
    }
    return null;
}


/**
 * Rasmni o‘chirish
 */
public function deletePhoto($path): void
{
    if ($path && \Storage::disk('public')->exists($path)) {
        \Storage::disk('public')->delete($path);
    }
}

}
