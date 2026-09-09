<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ministry;
use App\Models\MinistryMember;
use App\Models\Jemaat;

class MinistryMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $members = MinistryMember::with(['jemaat', 'ministry'])
        ->latest()
        ->get();

        $jemaats = Jemaat::where('is_active', true)
            ->orderBy('name')
            ->get();

        $ministries = Ministry::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.ministry-members.index', compact(
            'members',
            'jemaats',
            'ministries'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create() {
        $jemaats = Jemaat::where('is_active', true)
            ->orderBy('name')
            ->get();

        $ministries = Ministry::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.ministry-members.create', compact(
            'jemaats',
            'ministries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'jemaat_id' => ['required', 'exists:jemaats,id'],
            'ministry_id' => ['required', 'exists:ministries,id'],
            'position' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_active'] = true;

        MinistryMember::create($validated);

        return redirect()
            ->route('admin.ministry-members.index')
            ->with('success', 'Penatalayan berhasil ditambahkan.');
    }

    public function edit(MinistryMember $ministryMember) {
        $jemaats = Jemaat::where('is_active', true)
        ->orderBy('name')
        ->get();

        $ministries = Ministry::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.ministry-members.edit', compact(
            'ministryMember',
            'jemaats',
            'ministries'
        ));
    }

    public function update(Request $request, MinistryMember $ministryMember) {
        $validated = $request->validate([
            'jemaat_id' => ['required', 'exists:jemaats,id'],
            'ministry_id' => ['required', 'exists:ministries,id'],
            'position' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);

        $ministryMember->update($validated);

        return redirect()
            ->route('admin.ministry-members.index')
            ->with('success', 'Penatalayan berhasil diperbarui.');
    }

    public function destroy(MinistryMember $ministryMember) {
        $ministryMember->delete();

        return redirect()
            ->route('admin.ministry-members.index')
            ->with('success', 'Penatalayan berhasil dihapus.');
    }

  
}
