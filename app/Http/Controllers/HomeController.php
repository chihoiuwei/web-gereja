<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\News;
use App\Models\Event;
use App\Models\MinistryMember;
use App\Models\GalleryAlbum;
use App\Models\WorshipSchedule;

class HomeController extends Controller
{
    public function index() {
        $birthdays = Jemaat::where('is_active', true)
        ->whereNotNull('birth_date')
        ->whereMonth('birth_date', now()->month)
        ->orderByRaw('DAY(birth_date)')
        ->get();

        $weeklyNews = News::where('is_active', true)
            ->whereDate('published_at', '>=', now()->subDays(7)->startOfDay())
            ->whereDate('published_at', '<=', now()->endOfDay())
            ->latest('published_at')
            ->get();

        $upcomingEvents = Event::where('is_active', true)
            ->whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->orderBy('start_time')
            ->take(3)
            ->get();
        
        $jerumAlbum = GalleryAlbum::with('photos')
            ->where('title', 'Jemaat Rumah')
            ->where('is_active', true)
            ->first();

        $pemudaAlbum = GalleryAlbum::with('photos')
            ->where('title', 'Pemuda')
            ->where('is_active', true)
            ->first();

        $penatalayan = MinistryMember::with(['jemaat', 'ministry'])
            ->where('is_active', true)
            ->get();

        $worshipSchedules = WorshipSchedule::where('is_active', true)
            ->orderByRaw("FIELD(day, 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('start_time')
            ->get();

        return view('welcome', compact(
            'birthdays',
            'weeklyNews',
            'upcomingEvents',
            'penatalayan',
            'jerumAlbum',
            'pemudaAlbum',
            'worshipSchedules'
        ));
    }

    public function birthdays()
    {
        $birthdays = Jemaat::where('is_active', true)
            ->whereNotNull('birth_date')
            ->whereMonth('birth_date', now()->month)
            ->orderByRaw('DAY(birth_date)')
            ->get();

        return view('birthdays', compact('birthdays'));
    }

    public function news()
    {
        $news = News::where('is_active', true)
            ->latest('published_at')
            ->get();

        return view('news', compact('news'));
    }

    public function events()
    {
        $events = Event::where('is_active', true)
            ->whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->orderBy('start_time')
            ->get();

        return view('events', compact('events'));
    }

    public function penatalayan() {
        $penatalayan = MinistryMember::with(['jemaat', 'ministry'])
            ->where('is_active', true)
            ->get();

        return view('penatalayan', compact('penatalayan'));
    }

    public function gallery() {
        $albums = GalleryAlbum::with('photos')
            ->where('is_active', true)
            ->latest('taken_at')
            ->get();

        return view('gallery', compact('albums'));
    }
    public function galleryShow(GalleryAlbum $album) {
        if (!$album->is_active) {
            abort(404);
        }

        $album->load('photos');

        return view('gallery-show', compact('album'));
    }

    public function worshipSchedules() {
        $worshipSchedules = WorshipSchedule::where('is_active', true)
            ->orderByRaw("
                CASE day
                    WHEN 'Senin' THEN 1
                    WHEN 'Selasa' THEN 2
                    WHEN 'Rabu' THEN 3
                    WHEN 'Kamis' THEN 4
                    WHEN 'Jumat' THEN 5
                    WHEN 'Sabtu' THEN 6
                    WHEN 'Minggu' THEN 7
                END
            ")
            ->orderBy('start_time')
            ->get();

        return view('worship-schedules', compact('worshipSchedules'));
    }
}