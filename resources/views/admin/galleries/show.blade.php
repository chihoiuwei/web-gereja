@extends('admin.layouts.app')

@section('title', $gallery->title)
@section('page-title', 'Lihat Album')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-6">

        <a href="{{ route('admin.galleries.index') }}"
           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 mb-4">
            ← Kembali ke Gallery
        </a>

        <div class="flex items-start justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold">
                    {{ $gallery->title }}
                </h2>

                @if($gallery->taken_at)
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $gallery->taken_at->format('d M Y') }}
                    </p>
                @endif

                @if($gallery->description)
                    <p class="text-sm text-gray-600 mt-2">
                        {{ $gallery->description }}
                    </p>
                @endif
            </div>

            <div class="shrink-0">
                <span class="px-3 py-1 text-sm rounded-full
                    {{ $gallery->is_active
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-100 text-gray-600' }}">
                    {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>

        </div>

    </div>


    {{-- Jumlah Foto --}}
    <div class="mb-4">

        <p class="text-sm text-gray-500">
            {{ $gallery->photos->count() }} foto dalam album
        </p>

    </div>


    {{-- Photos --}}
    @if($gallery->photos->count())

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">

            @foreach($gallery->photos as $index => $photo)

                <button type="button"
                        onclick="openPhoto({{ $index }})"
                        class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <div class="h-56 bg-gray-100 flex items-center justify-center p-3">

                        <img src="{{ asset('storage/' . $photo->photo) }}"
                             alt="{{ $gallery->title }}"
                             class="max-h-full max-w-full object-contain">

                    </div>

                </button>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-xl shadow-sm p-10 text-center">

            <p class="text-gray-500">
                Album ini belum memiliki foto.
            </p>

        </div>

    @endif

</div>


{{-- =========================
     PHOTO SLIDESHOW
========================= --}}

<div id="photoModal"
     class="fixed inset-0 bg-black/90 hidden items-center justify-center z-50 p-4">

    {{-- Close --}}
    <button type="button"
            onclick="closePhoto()"
            class="absolute top-5 right-6 text-white text-4xl leading-none hover:text-gray-300 z-20">
        &times;
    </button>


    {{-- Previous --}}
    <button type="button"
            onclick="previousPhoto()"
            class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2
                   w-12 h-12 rounded-full
                   bg-white/20 hover:bg-white/30
                   text-white text-3xl
                   flex items-center justify-center
                   z-20">
        &#10094;
    </button>


    {{-- Image --}}
    <div class="flex flex-col items-center justify-center max-w-[90vw]">

        <img id="largePhoto"
             src=""
             alt="Foto Gallery"
             class="max-h-[80vh] max-w-[85vw] object-contain rounded-lg">

        <p id="photoCounter"
           class="text-white text-sm mt-4">
        </p>

    </div>


    {{-- Next --}}
    <button type="button"
            onclick="nextPhoto()"
            class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2
                   w-12 h-12 rounded-full
                   bg-white/20 hover:bg-white/30
                   text-white text-3xl
                   flex items-center justify-center
                   z-20">
        &#10095;
    </button>

</div>


<script>

    const galleryPhotos = [
        @foreach($gallery->photos as $photo)
            "{{ asset('storage/' . $photo->photo) }}",
        @endforeach
    ];

    let currentPhotoIndex = 0;


    function openPhoto(index)
    {
        currentPhotoIndex = index;

        showPhoto();

        const modal = document.getElementById('photoModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function showPhoto()
    {
        const image = document.getElementById('largePhoto');
        const counter = document.getElementById('photoCounter');

        image.src = galleryPhotos[currentPhotoIndex];

        counter.textContent =
            `${currentPhotoIndex + 1} / ${galleryPhotos.length}`;
    }


    function nextPhoto()
    {
        currentPhotoIndex++;

        if (currentPhotoIndex >= galleryPhotos.length) {
            currentPhotoIndex = 0;
        }

        showPhoto();
    }


    function previousPhoto()
    {
        currentPhotoIndex--;

        if (currentPhotoIndex < 0) {
            currentPhotoIndex = galleryPhotos.length - 1;
        }

        showPhoto();
    }


    function closePhoto()
    {
        const modal = document.getElementById('photoModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        document.getElementById('largePhoto').src = '';
    }


    // Klik area luar foto
    document.getElementById('photoModal').addEventListener('click', function(event) {

        if (event.target === this) {
            closePhoto();
        }

    });


    // Keyboard navigation
    document.addEventListener('keydown', function(event) {

        const modal = document.getElementById('photoModal');

        if (modal.classList.contains('hidden')) {
            return;
        }

        if (event.key === 'Escape') {
            closePhoto();
        }

        if (event.key === 'ArrowRight') {
            nextPhoto();
        }

        if (event.key === 'ArrowLeft') {
            previousPhoto();
        }

    });

</script>

@endsection