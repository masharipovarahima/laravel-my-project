<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Seminar;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    // Barcha konferensiyalarni ko'rsatish
    public function index()
    {
        $conferences = Conference::with('seminars')->paginate(10);
        return view('conferences.index', compact('conferences'));
    }

    // Yangi konferensiya yaratish formasi
    public function create()
    {
        $seminars = Seminar::all();
        return view('conferences.create', compact('seminars'));
    }

    // Konferensiya va seminarlarni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'seminars' => 'nullable|array',
            'seminars.*.title' => 'required_with:seminars|string|max:255',
            'seminars.*.start_time' => 'required_with:seminars|date',
            'seminars.*.end_time' => 'nullable|date|after_or_equal:seminars.*.start_time',
            'seminars.*.speaker' => 'required_with:seminars|string|max:255',
            'seminars.*.details' => 'nullable|string',
        ]);

        $conference = Conference::create($request->only(['name', 'start_date', 'end_date', 'location', 'description']));

        if ($request->has('seminars')) {
            foreach ($request->seminars as $seminar) {
                $conference->seminars()->create($seminar);
            }
        }

        return redirect()->route('conferences.index')->with('success', 'Konferensiya va seminarlar saqlandi!');
    }

    // Bitta konferensiyani ko'rish
    public function show(Conference $conference)
    {
        $conference->load('seminars');
        return view('conference.show', compact('conference'));
    }

    // Tahrirlash formasi
    public function edit(Conference $conference)
    {
        $conference->load('seminars');
        return view('conferences.edit', compact('conference'));
    }

    // Konferensiyani yangilash
    public function update(Request $request, Conference $conference)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'seminars' => 'nullable|array',
            'seminars.*.title' => 'required_with:seminars|string|max:255',
            'seminars.*.start_time' => 'required_with:seminars|date',
            'seminars.*.end_time' => 'nullable|date|after_or_equal:seminars.*.start_time',
            'seminars.*.speaker' => 'required_with:seminars|string|max:255',
            'seminars.*.details' => 'nullable|string',
        ]);

        $conference->update($request->only(['name', 'start_date', 'end_date', 'location', 'description']));

        // Eski seminarlarni o'chirib, yangilarini yaratish
        $conference->seminars()->delete();

        if ($request->has('seminars')) {
            foreach ($request->seminars as $seminar) {
                $conference->seminars()->create($seminar);
            }
        }

        return redirect()->route('conferences.index')->with('success', 'Konferensiya va seminarlar yangilandi!');
    }

    // Konferensiyani o'chirish
    public function destroy(Conference $conference)
    {
        $conference->delete();

        return redirect()->route('conferences.index')->with('success', 'Konferensiya va bogliq seminarlar ochirildi!');
    }
}
