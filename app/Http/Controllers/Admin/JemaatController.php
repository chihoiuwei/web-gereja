<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaat;
use Illuminate\Support\Facades\Storage;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jemaats = Jemaat::latest()->get();
        return view('admin.jemaats.index', compact('jemaats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jemaats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
       $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'photo' => ['nullable', 'image', 'max:10240'],
        'birth_date' => ['nullable', 'date'],
        'gender' => ['nullable', 'in:male,female'],
        'phone' => ['nullable', 'string', 'max:30'],
        'address' => ['nullable', 'string'],
        'bio' => ['nullable', 'string'],
    ]);

    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')
            ->store('jemaats', 'public');
    }

    $validated['is_active'] = true;

    Jemaat::create($validated);

    return redirect()
        ->route('admin.jemaats.index')
        ->with('success', 'Jemaat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jemaat $jemaat) {
        return view('admin.jemaats.edit', compact('jemaat'));
    }

    public function update(Request $request, Jemaat $jemaat) {

         $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'photo' => ['nullable', 'image', 'max:10240'],
        'birth_date' => ['nullable', 'date'],
        'gender' => ['nullable', 'in:male,female'],
        'phone' => ['nullable', 'string', 'max:30'],
        'address' => ['nullable', 'string'],
        'bio' => ['nullable', 'string'],
        'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {

            if ($jemaat->photo && Storage::disk('public')->exists($jemaat->photo)) {
                Storage::disk('public')->delete($jemaat->photo);
            }

            $validated['photo'] = $request->file('photo')->store('jemaat', 'public');
        }

        $jemaat->update($validated);

        return redirect()
            ->route('admin.jemaats.index')
            ->with('success', 'Data jemaat berhasil diperbarui.');
    }

    public function destroy(Jemaat $jemaat) {
        $jemaat->delete();

        return redirect()
            ->route('admin.jemaats.index')
            ->with('success', 'Data jemaat berhasil dihapus.');
    }
}
