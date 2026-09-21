@extends('layouts.public')

@section('title', 'Berita & Renungan - GPIJS Jakpus')

@section('content')

<section class="news-page">

    {{-- HEADER --}}
    <div class="news-header">

        <p class="news-label">
            WARTA JEMAAT
        </p>

        <h1>
            Berita & Renungan
        </h1>

        <p class="news-subtitle">
            Kabar, renungan, kegiatan, dan informasi terbaru
            GPI Jalan Suci Jakpus
        </p>

        <a href="{{ url('/#warta') }}" class="birthday-back-button">
            ← Kembali ke Warta Jemaat
        </a>

    </div>


    {{-- DAFTAR BERITA --}}
    <div class="news-carousel-wrapper">

        <div class="news-grid" id="newsGrid">

            @forelse ($news as $item)

                <article
                    class="news-card"
                    onclick="openNewsModal({{ $loop->index }})"
                >

                    {{-- FOTO --}}
                    <div class="news-photo">

                        @if ($item->photo)

                            <img
                                src="{{ asset('storage/' . $item->photo) }}"
                                alt="{{ $item->title }}"
                            >

                        @else

                            <div class="news-no-photo">
                                📰
                            </div>

                        @endif

                    </div>


                    {{-- ISI CARD --}}
                    <div class="news-content">

                        <p class="news-category">
                            {{ $item->category }}
                        </p>

                        <h2>
                            {{ $item->title }}
                        </h2>

                        <p class="news-date">
                            {{ $item->published_at->translatedFormat('d F Y') }}
                        </p>

                        <p class="news-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                        </p>

                        <span class="news-link">
                            Baca Selengkapnya →
                        </span>

                    </div>

                </article>

            @empty

                <div class="news-empty">

                    <div class="news-empty-icon">
                        📰
                    </div>

                    <h2>
                        Belum Ada Berita
                    </h2>

                    <p>
                        Belum ada berita atau renungan yang dipublikasikan.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- TOMBOL CAROUSEL KHUSUS HP --}}
        @if ($news->count() > 1)

            <div class="news-mobile-nav">

                <button
                    type="button"
                    id="newsPagePrev"
                    onclick="previousNewsCard()"
                    aria-label="Berita sebelumnya"
                >
                    &#10094;
                </button>

                <button
                    type="button"
                    id="newsPageNext"
                    onclick="nextNewsCard()"
                    aria-label="Berita berikutnya"
                >
                    &#10095;
                </button>

            </div>

        @endif

    </div>

</section>


{{-- ============================================================
     NEWS MODAL
============================================================ --}}

<div
    id="newsModal"
    class="news-modal"
    onclick="closeNewsModal(event)"
>

    {{-- TOMBOL CLOSE --}}
    <button
        type="button"
        class="news-modal-close"
        onclick="closeNewsModal()"
    >
        &times;
    </button>


    {{-- TOMBOL PREV --}}
    <button
        type="button"
        id="newsPrev"
        class="news-modal-arrow news-modal-prev"
        onclick="previousNews(event)"
    >
        &#10094;
    </button>


    {{-- MODAL CONTENT --}}
    <div
        class="news-modal-box"
        onclick="event.stopPropagation()"
    >

        {{-- FOTO KIRI --}}
        <div class="news-modal-image">

            <img
                id="modalNewsImage"
                class="news-modal-clickable-image"
                src=""
                alt=""
            >

        </div>


        {{-- ISI KANAN --}}
        <div class="news-modal-content">

            <p
                id="modalNewsCategory"
                class="news-modal-category"
            >
            </p>

            <h2 id="modalNewsTitle">
            </h2>

            <p
                id="modalNewsDate"
                class="news-modal-date"
            >
            </p>

            <div
                id="modalNewsBody"
                class="news-modal-body"
            >
            </div>

        </div>

    </div>


    {{-- TOMBOL NEXT --}}
    <button
        type="button"
        id="newsNext"
        class="news-modal-arrow news-modal-next"
        onclick="nextNews(event)"
    >
        &#10095;
    </button>

</div>


{{-- ============================================================
     NEWS IMAGE LIGHTBOX
============================================================ --}}

<div
    id="newsImageLightbox"
    class="news-image-lightbox"
    onclick="closeNewsImageLightbox()"
>

    <button
        type="button"
        class="news-image-lightbox-close"
        onclick="closeNewsImageLightbox(event)"
        aria-label="Tutup foto"
    >
        &times;
    </button>

    <img
        id="newsLightboxImage"
        src=""
        alt=""
        onclick="event.stopPropagation()"
    >

</div>


@php

    $newsData = $news->map(function ($item) {

        return [
            'title' => $item->title,

            'category' => $item->category,

            'date' => $item->published_at
                ? $item->published_at->translatedFormat('d F Y')
                : '',

            'content' => strip_tags($item->content),

            'photo' => $item->photo
                ? asset('storage/' . $item->photo)
                : null,
        ];

    })->values();

@endphp


<style>

/* ============================================================
   FOTO MODAL BISA DIKLIK
============================================================ */

.news-modal-clickable-image {
    cursor: zoom-in;
}


/* ============================================================
   NEWS IMAGE LIGHTBOX
============================================================ */

.news-image-lightbox {
    position: fixed;
    inset: 0;
    z-index: 10050;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(0, 0, 0, .92);
}

.news-image-lightbox.active {
    display: flex;
}

.news-image-lightbox img {
    max-width: 95vw;
    max-height: 95vh;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
}

.news-image-lightbox-close {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 46px;
    height: 46px;
    border: none;
    border-radius: 50%;
    background: #ffffff;
    color: #111827;
    font-size: 1.8rem;
    line-height: 1;
    cursor: pointer;
    z-index: 10051;
}


/* ============================================================
   MOBILE
============================================================ */

@media (max-width: 700px) {

    .news-image-lightbox {
        padding: 12px;
    }

    .news-image-lightbox img {
        max-width: 96vw;
        max-height: 92vh;
    }

    .news-image-lightbox-close {
        top: 14px;
        right: 14px;
        width: 42px;
        height: 42px;
        font-size: 1.6rem;
    }

}

</style>


<script>

/* ============================================================
   NEWS CARD CAROUSEL - HP
============================================================ */

let newsPageCurrentIndex = 0;


function getNewsCards() {

    return document.querySelectorAll(
        '#newsGrid .news-card'
    );

}


function updateNewsCardCarousel() {

    const cards = getNewsCards();

    if (!cards.length) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | DESKTOP
    |--------------------------------------------------------------------------
    */

    if (window.innerWidth > 600) {

        cards.forEach(card => {

            card.style.display = '';

        });

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    cards.forEach((card, index) => {

        if (index === newsPageCurrentIndex) {

            card.style.display = '';

        } else {

            card.style.display = 'none';

        }

    });


    /*
    |--------------------------------------------------------------------------
    | BUTTON
    |--------------------------------------------------------------------------
    */

    const prev =
        document.getElementById('newsPagePrev');

    const next =
        document.getElementById('newsPageNext');


    if (prev) {

        prev.disabled =
            newsPageCurrentIndex === 0;

    }


    if (next) {

        next.disabled =
            newsPageCurrentIndex === cards.length - 1;

    }

}


function previousNewsCard() {

    const cards = getNewsCards();

    if (!cards.length) {
        return;
    }


    if (newsPageCurrentIndex > 0) {

        newsPageCurrentIndex--;

        updateNewsCardCarousel();

    }

}


function nextNewsCard() {

    const cards = getNewsCards();

    if (!cards.length) {
        return;
    }


    if (
        newsPageCurrentIndex <
        cards.length - 1
    ) {

        newsPageCurrentIndex++;

        updateNewsCardCarousel();

    }

}


document.addEventListener(
    'DOMContentLoaded',
    function () {

        updateNewsCardCarousel();

    }
);


window.addEventListener(
    'resize',
    function () {

        updateNewsCardCarousel();

    }
);


/* ============================================================
   DATA BERITA
============================================================ */

const newsData =
    {{ \Illuminate\Support\Js::from($newsData) }};


let currentNewsIndex = 0;


/* ============================================================
   OPEN NEWS MODAL
============================================================ */

function openNewsModal(index)
{

    currentNewsIndex = index;

    showNews(currentNewsIndex);

    document
        .getElementById('newsModal')
        .classList
        .add('active');

    document.body.style.overflow = 'hidden';

}


/* ============================================================
   CLOSE NEWS MODAL
============================================================ */

function closeNewsModal(event = null)
{

    if (
        event &&
        event.target !== event.currentTarget
    ) {

        return;

    }


    document
        .getElementById('newsModal')
        .classList
        .remove('active');


    document.body.style.overflow = '';

}


/* ============================================================
   SHOW NEWS
============================================================ */

function showNews(index)
{

    if (!newsData.length) {

        return;

    }


    currentNewsIndex = index;


    const news =
        newsData[currentNewsIndex];


    document
        .getElementById('modalNewsCategory')
        .textContent = news.category;


    document
        .getElementById('modalNewsTitle')
        .textContent = news.title;


    document
        .getElementById('modalNewsDate')
        .textContent = news.date;


    document
        .getElementById('modalNewsBody')
        .textContent = news.content;


    const image =
        document.getElementById('modalNewsImage');


    if (news.photo) {

        image.src = news.photo;

        image.alt = news.title;

        image.style.display = 'block';


        /*
        |--------------------------------------------------------------------------
        | KLIK FOTO → LIGHTBOX
        |--------------------------------------------------------------------------
        */

        image.onclick = function () {

            openNewsImageLightbox(
                news.photo,
                news.title
            );

        };


    } else {

        image.src = '';

        image.alt = '';

        image.style.display = 'none';

        image.onclick = null;

    }


    updateNewsArrows();

}


/* ============================================================
   PREVIOUS NEWS
============================================================ */

function previousNews(event)
{

    event.stopPropagation();


    if (newsData.length <= 1) {

        return;

    }


    currentNewsIndex--;


    if (currentNewsIndex < 0) {

        currentNewsIndex =
            newsData.length - 1;

    }


    showNews(currentNewsIndex);

}


/* ============================================================
   NEXT NEWS
============================================================ */

function nextNews(event)
{

    event.stopPropagation();


    if (newsData.length <= 1) {

        return;

    }


    currentNewsIndex++;


    if (
        currentNewsIndex >=
        newsData.length
    ) {

        currentNewsIndex = 0;

    }


    showNews(currentNewsIndex);

}


/* ============================================================
   UPDATE NEWS ARROWS
============================================================ */

function updateNewsArrows()
{

    const prev =
        document.getElementById('newsPrev');


    const next =
        document.getElementById('newsNext');


    if (newsData.length <= 1) {

        prev.style.display = 'none';

        next.style.display = 'none';

    } else {

        prev.style.display = 'block';

        next.style.display = 'block';

    }

}


/* ============================================================
   OPEN IMAGE LIGHTBOX
============================================================ */

function openNewsImageLightbox(
    photo,
    title
)
{

    const lightbox =
        document.getElementById(
            'newsImageLightbox'
        );


    const image =
        document.getElementById(
            'newsLightboxImage'
        );


    if (!lightbox || !image) {

        return;

    }


    image.src = photo;

    image.alt = title || '';


    lightbox
        .classList
        .add('active');


    document.body.style.overflow =
        'hidden';

}


/* ============================================================
   CLOSE IMAGE LIGHTBOX
============================================================ */

function closeNewsImageLightbox(
    event = null
)
{

    if (event) {

        event.stopPropagation();

    }


    const lightbox =
        document.getElementById(
            'newsImageLightbox'
        );


    if (!lightbox) {

        return;

    }


    lightbox
        .classList
        .remove('active');


    /*
    |--------------------------------------------------------------------------
    | KEMBALIKAN SCROLL KE MODAL BERITA
    |--------------------------------------------------------------------------
    */

    const newsModal =
        document.getElementById(
            'newsModal'
        );


    if (
        newsModal &&
        newsModal.classList.contains('active')
    ) {

        document.body.style.overflow =
            'hidden';

    } else {

        document.body.style.overflow =
            '';

    }

}


/* ============================================================
   KEYBOARD
============================================================ */

document.addEventListener(
    'keydown',
    function (event) {

        const lightbox =
            document.getElementById(
                'newsImageLightbox'
            );


        /*
        |--------------------------------------------------------------------------
        | ESC SAAT FOTO FULLSCREEN
        |--------------------------------------------------------------------------
        */

        if (
            lightbox &&
            lightbox.classList.contains('active')
        ) {

            if (event.key === 'Escape') {

                closeNewsImageLightbox();

            }

            return;

        }


        const modal =
            document.getElementById(
                'newsModal'
            );


        if (
            !modal ||
            !modal.classList.contains('active')
        ) {

            return;

        }


        if (event.key === 'Escape') {

            closeNewsModal();

        }


        if (event.key === 'ArrowLeft') {

            previousNews(event);

        }


        if (event.key === 'ArrowRight') {

            nextNews(event);

        }

    }
);

</script>

@endsection