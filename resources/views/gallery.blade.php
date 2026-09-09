@extends('layouts.public')

@section('title', 'Galeri - GPIJS Jakpus')

@section('content')

<section class="min-h-screen bg-gray-50 py-12 px-6">

    <div class="max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800" style="margin-top: 80px;">
                    Gallery
                </h1>

                <p class="text-gray-500 mt-1">
                    Dokumentasi foto dan kegiatan GPIJS Jakpus.
                </p>
            </div>

        </div>


        {{-- ALBUM CARDS --}}
        @if($albums->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                @foreach($albums as $album)

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                        {{-- COVER --}}
                        <div class="h-48 bg-gray-100 flex items-center justify-center p-3">

                            @if($album->photos->first())

                                <img
                                    src="{{ asset('storage/' . $album->photos->first()->photo) }}"
                                    alt="{{ $album->title }}"
                                    class="max-h-full max-w-full object-contain"
                                >

                            @else

                                <span class="text-sm text-gray-400">
                                    Tidak ada foto
                                </span>

                            @endif

                        </div>


                        {{-- CONTENT --}}
                        <div class="p-4">

                            <div class="flex items-start justify-between gap-2">

                                <h2 class="font-semibold text-gray-800 line-clamp-2">
                                    {{ $album->title }}
                                </h2>

                            </div>


                            {{-- JUMLAH FOTO --}}
                            <p class="text-sm text-gray-500 mt-2">
                                {{ $album->photos->count() }} foto
                            </p>


                            {{-- TANGGAL --}}
                            @if($album->taken_at)

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $album->taken_at->format('d M Y') }}
                                </p>

                            @endif


                            {{-- DESKRIPSI --}}
                            @if($album->description)

                                <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                    {{ $album->description }}
                                </p>

                            @endif


                            {{-- BUTTON --}}
                            <div class="mt-4">

                                <a
                                    href="{{ route('gallery.show', $album) }}"
                                    class="block w-full text-center px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm"
                                >
                                    Lihat Album
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-xl shadow-sm p-10 text-center">

                <p class="text-gray-500">
                    Belum ada album gallery.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection