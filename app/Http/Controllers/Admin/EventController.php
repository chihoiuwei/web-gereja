<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest('start_date')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('events', 'public');
        }

        $validated['is_active'] = true;

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        //
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {
            if (
                $event->photo &&
                Storage::disk('public')->exists($event->photo)
            ) {
                Storage::disk('public')->delete($event->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        if (
            $event->photo &&
            Storage::disk('public')->exists($event->photo)
        ) {
            Storage::disk('public')->delete($event->photo);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}