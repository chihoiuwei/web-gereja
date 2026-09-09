<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::with('photos')
            ->latest()
            ->get();

        return view('admin.galleries.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photos' => ['required', 'array', 'min:1'],
            'photos.*' => ['required', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'taken_at' => ['nullable', 'date'],
        ]);

        // Buat album
        $album = GalleryAlbum::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'taken_at' => $validated['taken_at'] ?? null,
            'is_active' => true,
        ]);

        // Simpan semua foto ke album
        foreach ($request->file('photos') as $photo) {

            $path = $photo->store('galleries', 'public');

            $album->photos()->create([
                'photo' => $path,
            ]);
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Album gallery berhasil ditambahkan.');
    }

    public function show(GalleryAlbum $gallery)
    {
        $gallery->load('photos');

        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(GalleryAlbum $gallery)
    {
        $gallery->load('photos');

        return response()->json([
            'id' => $gallery->id,
            'title' => $gallery->title,
            'description' => $gallery->description,
            'taken_at' => $gallery->taken_at
                ? $gallery->taken_at->format('Y-m-d')
                : null,
            'is_active' => $gallery->is_active,
            'photos' => $gallery->photos->map(function ($photo) {
                return [
                    'id' => $photo->id,
                    'photo' => $photo->photo,
                ];
            }),
        ]);
    }

    public function update(Request $request, GalleryAlbum $gallery)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'taken_at' => ['nullable', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        $gallery->update($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Album gallery berhasil diperbarui.');
    }

    public function addPhotos(Request $request, GalleryAlbum $gallery)
    {
        $validated = $request->validate([
            'photos' => ['required', 'array', 'min:1'],
            'photos.*' => ['required', 'image', 'max:2048'],
        ]);

        foreach ($request->file('photos') as $photo) {

            $path = $photo->store('galleries', 'public');

            $gallery->photos()->create([
                'photo' => $path,
            ]);
        }

        // Ambil ulang semua foto setelah upload
        $gallery->load('photos');

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil ditambahkan ke album.',
            'photos' => $gallery->photos->map(function ($photo) {
                return [
                    'id' => $photo->id,
                    'photo' => $photo->photo,
                ];
            }),
        ]);
    }


    public function deletePhoto(Request $request, GalleryAlbum $gallery, $photo)
    {
        $galleryPhoto = $gallery->photos()->findOrFail($photo);

        if (
            $galleryPhoto->photo &&
            Storage::disk('public')->exists($galleryPhoto->photo)
        ) {
            Storage::disk('public')->delete($galleryPhoto->photo);
        }

        $galleryPhoto->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus dari album.',
            ]);
        }

        return redirect()
            ->route('admin.galleries.show', $gallery)
            ->with('success', 'Foto berhasil dihapus dari album.');
    }

    public function destroy(GalleryAlbum $gallery)
    {
        $gallery->load('photos');

        foreach ($gallery->photos as $photo) {

            if (
                $photo->photo &&
                Storage::disk('public')->exists($photo->photo)
            ) {
                Storage::disk('public')->delete($photo->photo);
            }
        }

        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Album gallery berhasil dihapus.');
    }
}