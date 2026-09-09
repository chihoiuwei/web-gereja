<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') - GPIJS Jakpus</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex">

    {{-- Sidebar --}}
   <aside id="adminSidebar"
       class="hidden lg:block w-64 shrink-0 bg-white border-r border-gray-200
              fixed lg:static inset-y-0 left-0 z-50 lg:z-auto">

            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-blue-700">
                    GPIJS Jakpus
                </h1>
            </div>

            <nav class="p-4 space-y-1">

                <a href="{{ url('/admin') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Dashboard
                </a>

                <a href="{{ route('admin.jemaats.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Jemaat
                </a>

                 <a href="{{ route('admin.ministries.index') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Bidang Pelayanan
                </a>

                <a href="{{ route('admin.ministry-members.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Penatalayan
                </a>

                <a href="{{ route('admin.worship-schedules.index') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Jadwal Ibadah
                </a>

                <a href="{{ route('admin.news.index') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Berita
                </a>

                <a href="{{ route('admin.events.index') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Event
                </a>

                <a href="{{ route('admin.galleries.index') }}"
                   class="block px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    Gallery
                </a>

            </nav>

        </aside>


        {{-- Main Content --}}
        <div class="flex-1">

           {{-- Topbar --}}
                <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">

                    <div class="flex items-center gap-3">

                        {{-- Tombol Menu Mobile --}}
                        <button
                            type="button"
                            onclick="document.getElementById('adminSidebar').classList.toggle('hidden')"
                            class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg hover:bg-gray-100"
                            aria-label="Buka menu">

                            <svg class="w-6 h-6 text-gray-700"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />

                            </svg>

                        </button>

                        <h2 class="text-lg font-semibold">
                            @yield('page-title', 'Dashboard')
                        </h2>

                    </div>

                <div class="flex items-center gap-4">

                    <span class="text-sm text-gray-600">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="text-sm text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>

                </div>

            </header>


            {{-- Content --}}
            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>