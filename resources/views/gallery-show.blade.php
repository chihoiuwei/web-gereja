@extends('layouts.public')

@section('title', $album->title . ' - Gallery GPIJS Jakpus')

@section('content')

<style>
    /* ============================================================
       GALLERY DETAIL
    ============================================================ */

    .gallery-detail {
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    .gallery-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;

        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .gallery-back:hover {
        color: #1d4ed8;
    }

    .gallery-title {
        font-size: 32px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .gallery-date {
        margin-top: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    .gallery-description {
        margin-top: 12px;
        max-width: 800px;
        color: #4b5563;
        line-height: 1.6;
    }

    .gallery-count {
        margin-top: 10px;
        font-size: 14px;
        color: #6b7280;
    }


    /* ============================================================
       GRID FOTO
    ============================================================ */

    .gallery-photo-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 32px;
    }

    .gallery-photo-button {
        width: 100%;
        padding: 0;
        border: 0;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
        transition: .2s ease;
    }

    .gallery-photo-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
    }

    .gallery-photo-box {
        width: 100%;
        height: 260px;
        background: #f3f4f6;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 12px;
        box-sizing: border-box;
    }

    .gallery-photo-box img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        display: block;
    }


    /* ============================================================
       LIGHTBOX
    ============================================================ */

    .gallery-lightbox {
        display: none;

        position: fixed;
        inset: 0;

        width: 100vw;
        height: 100vh;

        background: rgba(0, 0, 0, .94);

        z-index: 999999;

        align-items: center;
        justify-content: center;
    }

    .gallery-lightbox.active {
        display: flex;
    }


    /* FOTO BESAR */

    .gallery-lightbox-image {
        display: block;

        max-width: 85vw;
        max-height: 80vh;

        width: auto;
        height: auto;

        object-fit: contain;

        border-radius: 8px;
    }


    /* ============================================================
       TOMBOL CLOSE
    ============================================================ */

    .gallery-close {
        position: fixed;

        top: 22px;
        right: 28px;

        width: 48px;
        height: 48px;

        border: 0;
        border-radius: 50%;

        background: rgba(255, 255, 255, .18);

        color: #fff;

        font-size: 34px;
        line-height: 1;

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        z-index: 1000001;
    }

    .gallery-close:hover {
        background: rgba(255, 255, 255, .3);
    }


    /* ============================================================
       TOMBOL PREV / NEXT
    ============================================================ */

    .gallery-prev,
    .gallery-next {

        position: fixed;

        top: 50%;

        transform: translateY(-50%);

        width: 54px;
        height: 54px;

        border: 0;
        border-radius: 50%;

        background: rgba(255, 255, 255, .18);

        color: #fff;

        font-size: 42px;
        line-height: 1;

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        z-index: 1000001;
    }

    .gallery-prev {
        left: 24px;
    }

    .gallery-next {
        right: 24px;
    }

    .gallery-prev:hover,
    .gallery-next:hover {
        background: rgba(255, 255, 255, .3);
    }


    /* ============================================================
       COUNTER
    ============================================================ */

    .gallery-counter {
        position: fixed;

        bottom: 25px;
        left: 50%;

        transform: translateX(-50%);

        color: #fff;

        font-size: 14px;

        z-index: 1000001;
    }


    /* ============================================================
       RESPONSIVE
    ============================================================ */

    @media (max-width: 1024px) {

        .gallery-photo-grid {
            grid-template-columns: repeat(3, 1fr);
        }

    }


    @media (max-width: 768px) {

        .gallery-detail {
            padding: 30px 16px;
        }

        .gallery-title {
            font-size: 28px;
        }

        .gallery-photo-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .gallery-photo-box {
            height: 220px;
        }

        .gallery-lightbox-image {
            max-width: 88vw;
            max-height: 75vh;
        }

        .gallery-prev,
        .gallery-next {
            width: 44px;
            height: 44px;
            font-size: 32px;
        }

        .gallery-prev {
            left: 10px;
        }

        .gallery-next {
            right: 10px;
        }

        .gallery-close {
            top: 12px;
            right: 12px;
        }

    }


    @media (max-width: 480px) {

        .gallery-photo-grid {
            grid-template-columns: 1fr;
        }

        .gallery-photo-box {
            height: 260px;
        }

        .gallery-lightbox-image {
            max-width: 90vw;
            max-height: 70vh;
        }

    }

</style>


{{-- ============================================================
     HALAMAN DETAIL ALBUM
============================================================ --}}

<div class="gallery-detail">

    {{-- JUDUL --}}
    <h1 class="gallery-title">
        {{ $album->title }}
    </h1>


    {{-- TANGGAL --}}
    @if($album->taken_at)

        <div class="gallery-date">
            {{ $album->taken_at->format('d M Y') }}
        </div>

    @endif


    {{-- DESKRIPSI --}}
    @if($album->description)

        <div class="gallery-description">
            {{ $album->description }}
        </div>

    @endif


    {{-- JUMLAH FOTO --}}
    <div class="gallery-count">
        {{ $album->photos->count() }} foto dalam album
    </div>

    {{-- KEMBALI --}}
    <a
        href="{{ route('gallery') }}"
        class="gallery-back"
    >
        ← Kembali ke Gallery
    </a>


    {{-- FOTO --}}
    @if($album->photos->count())

        <div class="gallery-photo-grid">

            @foreach($album->photos as $index => $photo)

                <button
                    type="button"
                    class="gallery-photo-button"
                    onclick="openGallery({{ $index }})"
                >

                    <div class="gallery-photo-box">

                        <img
                            src="{{ asset('storage/' . $photo->photo) }}"
                            alt="{{ $album->title }}"
                        >

                    </div>

                </button>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-xl shadow-sm p-10 text-center mt-8">

            <p class="text-gray-500">
                Belum ada foto dalam album ini.
            </p>

        </div>

    @endif

</div>


{{-- ============================================================
     LIGHTBOX
============================================================ --}}

@if($album->photos->count())

<div
    id="galleryLightbox"
    class="gallery-lightbox"
>

    {{-- CLOSE --}}
    <button
        type="button"
        class="gallery-close"
        onclick="closeGallery()"
        aria-label="Tutup"
    >
        ×
    </button>


    {{-- PREVIOUS --}}
    <button
        type="button"
        class="gallery-prev"
        onclick="previousPhoto()"
        aria-label="Foto sebelumnya"
    >
        ‹
    </button>


    {{-- NEXT --}}
    <button
        type="button"
        class="gallery-next"
        onclick="nextPhoto()"
        aria-label="Foto berikutnya"
    >
        ›
    </button>


    {{-- FOTO --}}
    <img
        id="lightboxImage"
        class="gallery-lightbox-image"
        src=""
        alt="{{ $album->title }}"
    >


    {{-- COUNTER --}}
    <div
        id="lightboxCounter"
        class="gallery-counter"
    >
        1/{{ $album->photos->count() }}
    </div>

</div>

@endif


<script>

    const galleryPhotos = @json(
        $album->photos->map(function ($photo) {
            return asset('storage/' . $photo->photo);
        })->values()
    );

    let currentPhotoIndex = 0;


    /* ============================================================
       OPEN
    ============================================================ */

    function openGallery(index)
    {
        currentPhotoIndex = index;

        updateGallery();

        const lightbox =
            document.getElementById('galleryLightbox');

        lightbox.classList.add('active');

        document.body.style.overflow = 'hidden';
    }


    /* ============================================================
       CLOSE
    ============================================================ */

    function closeGallery()
    {
        const lightbox =
            document.getElementById('galleryLightbox');

        lightbox.classList.remove('active');

        document.body.style.overflow = '';
    }


    /* ============================================================
       UPDATE
    ============================================================ */

    function updateGallery()
    {
        const image =
            document.getElementById('lightboxImage');

        const counter =
            document.getElementById('lightboxCounter');

        image.src =
            galleryPhotos[currentPhotoIndex];

        counter.textContent =
            `${currentPhotoIndex + 1}/${galleryPhotos.length}`;
    }


    /* ============================================================
       PREVIOUS
    ============================================================ */

    function previousPhoto()
    {
        currentPhotoIndex--;

        if (currentPhotoIndex < 0) {
            currentPhotoIndex =
                galleryPhotos.length - 1;
        }

        updateGallery();
    }


    /* ============================================================
       NEXT
    ============================================================ */

    function nextPhoto()
    {
        currentPhotoIndex++;

        if (currentPhotoIndex >= galleryPhotos.length) {
            currentPhotoIndex = 0;
        }

        updateGallery();
    }


    /* ============================================================
       KEYBOARD
    ============================================================ */

    document.addEventListener('keydown', function(event)
    {
        const lightbox =
            document.getElementById('galleryLightbox');

        if (
            !lightbox ||
            !lightbox.classList.contains('active')
        ) {
            return;
        }


        if (event.key === 'Escape') {
            closeGallery();
        }


        if (event.key === 'ArrowLeft') {
            previousPhoto();
        }


        if (event.key === 'ArrowRight') {
            nextPhoto();
        }
    });


    /* ============================================================
       KLIK BACKGROUND
    ============================================================ */

    document
        .getElementById('galleryLightbox')
        ?.addEventListener('click', function(event)
        {
            if (event.target === this) {
                closeGallery();
            }
        });

</script>

@endsection