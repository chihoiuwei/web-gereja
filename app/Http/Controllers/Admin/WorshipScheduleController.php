<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorshipSchedule;
use Illuminate\Support\Facades\Storage;

class WorshipScheduleController extends Controller
{
    /**
     * Menampilkan semua jadwal ibadah.
     */
    public function index()
    {
        $schedules = WorshipSchedule::latest()->get();

        return view(
            'admin.worship-schedules.index',
            compact('schedules')
        );
    }

    /**
     * Menampilkan form tambah jadwal.
     */
    public function create()
    {
        return view('admin.worship-schedules.create');
    }

    /**
     * Menyimpan jadwal baru.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'max:50'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('worship-schedules', 'public');
        }

        $validated['is_active'] = true;

        WorshipSchedule::create($validated);

        return redirect()
            ->route('admin.worship-schedules.index')
            ->with('success', 'Jadwal ibadah berhasil ditambahkan.');
    }

    /**
     * Belum digunakan karena detail/edit akan menggunakan popup.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Belum digunakan karena edit akan menggunakan popup.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Memperbarui jadwal.
     */
    public function update(Request $request, WorshipSchedule $worshipSchedule)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'max:50'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {

            if (
                $worshipSchedule->photo &&
                Storage::disk('public')->exists($worshipSchedule->photo)
            ) {
                Storage::disk('public')->delete($worshipSchedule->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('worship-schedules', 'public');
        }

        $worshipSchedule->update($validated);

        return redirect()
            ->route('admin.worship-schedules.index')
            ->with('success', 'Jadwal ibadah berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal.
     */
    public function destroy(WorshipSchedule $worshipSchedule)
    {
        $worshipSchedule->delete();

        return redirect()
            ->route('admin.worship-schedules.index')
            ->with('success', 'Jadwal ibadah berhasil dihapus.');
    }
}