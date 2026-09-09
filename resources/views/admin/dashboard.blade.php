@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Selamat datang, {{ auth()->user()->name }} 👋
        </h1>

        <p class="text-gray-500 mt-1">
            Selamat datang di Dashboard Admin Website GPIJS Jakpus.
        </p>
    </div>


    {{-- Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Penatalayan --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Penatalayan
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalMinistryMembers }}
                    </p>

                    <a href="{{ route('admin.ministry-members.index') }}"
                       class="inline-block text-sm text-blue-600 hover:text-blue-800 mt-3">
                        Kelola penatalayan →
                    </a>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-10a4 4 0 110 8 4 4 0 010-8zm6 4a3 3 0 100-6 3 3 0 000 6zM9 14a4 4 0 014-4 4 4 0 014 4v2H9v-2z" />
                    </svg>
                </div>

            </div>
        </div>


        {{-- Jadwal Ibadah --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Jadwal Ibadah
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalWorshipSchedules }}
                    </p>

                    <a href="{{ route('admin.worship-schedules.index') }}"
                       class="inline-block text-sm text-blue-600 hover:text-blue-800 mt-3">
                        Kelola jadwal →
                    </a>
                </div>

                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                    </svg>
                </div>

            </div>
        </div>


        {{-- Berita --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Berita
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalNews }}
                    </p>

                    <a href="{{ route('admin.news.index') }}"
                       class="inline-block text-sm text-blue-600 hover:text-blue-800 mt-3">
                        Kelola berita →
                    </a>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 002-2V8a2 2 0 00-2-2h-6m-4 8h8m-8 4h5" />
                    </svg>
                </div>

            </div>
        </div>


        {{-- Event --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Event
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalEvents }}
                    </p>

                    <a href="{{ route('admin.events.index') }}"
                       class="inline-block text-sm text-blue-600 hover:text-blue-800 mt-3">
                        Kelola event →
                    </a>
                </div>

                <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

            </div>
        </div>

    </div>


    {{-- Quick Access --}}
    <div class="mt-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Akses Cepat
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <a href="{{ route('admin.ministry-members.index') }}"
               class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
                <p class="font-semibold text-gray-800">
                    Penatalayan
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola data penatalayan
                </p>
            </a>

            <a href="{{ route('admin.worship-schedules.index') }}"
               class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
                <p class="font-semibold text-gray-800">
                    Jadwal Ibadah
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola jadwal ibadah
                </p>
            </a>

            <a href="{{ route('admin.news.index') }}"
               class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
                <p class="font-semibold text-gray-800">
                    Berita
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola berita gereja
                </p>
            </a>

            <a href="{{ route('admin.events.index') }}"
               class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
                <p class="font-semibold text-gray-800">
                    Event
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola kegiatan gereja
                </p>
            </a>

        </div>
    </div>

@endsection