<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MinistryMember;
use App\Models\WorshipSchedule;
use App\Models\News;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMinistryMembers = MinistryMember::count();
        $totalWorshipSchedules = WorshipSchedule::count();
        $totalNews = News::count();
        $totalEvents = Event::count();

        return view('admin.dashboard', compact(
            'totalMinistryMembers',
            'totalWorshipSchedules',
            'totalNews',
            'totalEvents'
        ));
    }
}