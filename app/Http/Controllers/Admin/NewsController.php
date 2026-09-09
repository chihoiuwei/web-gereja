<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest('published_at')->get();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'category' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'published_at' => ['required', 'date'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('news', 'public');
        }

        $validated['is_active'] = true;

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(News $news)
    {
        //
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'category' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'published_at' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {
            if (
                $news->photo &&
                Storage::disk('public')->exists($news->photo)
            ) {
                Storage::disk('public')->delete($news->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('news', 'public');
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if (
            $news->photo &&
            Storage::disk('public')->exists($news->photo)
        ) {
            Storage::disk('public')->delete($news->photo);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}