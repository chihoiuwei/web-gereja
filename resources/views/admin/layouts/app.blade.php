<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') - GPIJS Jakpus</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-200">

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

                <h2 class="text-lg font-semibold">
                    @yield('page-title', 'Dashboard')
                </h2>

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