<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Barcha loyihalarni chiqarish
    public function index()
    {
        $query = Project::query();

        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('about', 'LIKE', "%{$search}%")
                    ->orWhere('result', 'LIKE', "%{$search}%");
            });
        }

        $projects = $query->paginate(10);
        return view('projects.index', compact('projects'));
    }

    // Yangi loyiha qo‘shish formasi
    public function create()
    {
        return view('projects.create');
    }

    // Loyihani saqlash
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'begin_time' => 'required|date',
            'end_time' => 'required|date|after:begin_time',
            'image_url' => 'nullable|image|max:2048',
            'about' => 'nullable|string',
            'result' => 'nullable|string',
        ]);

        $imagePath = $request->file('image_url') ? $request->file('image_url')->store('project_images', 'public') : null;

        Project::create([
            'name' => $request->name,
            'begin_time' => $request->begin_time,
            'end_time' => $request->end_time,
            'image_url' => $imagePath,
            'about' => $request->about,
            'result' => $request->result,
        ]);

        return redirect()->route('projects.index')->with('success', 'Loyiha muvaffaqiyatli yaratildi.');
    }

    // Bitta loyihani ko‘rsatish
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Loyihani tahrirlash formasi
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Loyihani yangilash
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'begin_time' => 'required|date',
            'end_time' => 'required|date|after:begin_time',
            'image_url' => 'nullable|image|max:2048',
            'about' => 'nullable|string',
            'result' => 'nullable|string',
        ]);

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('project_images', 'public');
            $project->image_url = $imagePath;
        }

        $project->update($request->except('image_url'));

        return redirect()->route('projects.index')->with('success', 'Loyiha yangilandi.');
    }

    // Loyihani o‘chirish
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Loyiha muvaffaqiyatli o‘chirildi.');
    }
}
