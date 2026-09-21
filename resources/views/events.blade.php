@extends('layouts.public')

@section('title', 'Kegiatan Gereja - GPIJS Jakpus')

@section('content')

<section class="events-page">

    {{-- HEADER --}}
    <div class="events-header">

        <p class="events-label">KEGIATAN GEREJA</p>

        <h1>Kegiatan Mendatang</h1>

        <p class="events-subtitle">
            Temukan berbagai kegiatan dan acara
            yang akan berlangsung di GPIJS Jakpus.
        </p>

        <a href="{{ url('/#warta') }}" class="birthday-back-button">
            ← Kembali ke Warta Jemaat
        </a>

    </div>


    {{-- EVENT CARDS --}}
    <div class="events-carousel-wrapper">

        <div class="events-grid" id="eventsGrid">

            @forelse ($events as $item)

                <article
                    class="event-card"
                    onclick="openEventModal({{ $item->id }})"
                    style="cursor: pointer;"
                >

                    {{-- FOTO --}}
                    <div class="event-photo">

                        @if ($item->photo)

                            <img
                                src="{{ asset('storage/' . $item->photo) }}"
                                alt="{{ $item->name }}"
                            >

                        @else

                            <img
                                src="{{ asset('images/event-default.png') }}"
                                alt="Kegiatan Gereja"
                            >

                        @endif

                    </div>


                    {{-- CONTENT --}}
                    <div class="event-content">

                        <p class="event-category">
                            📅 KEGIATAN
                        </p>

                        <h2>
                            {{ $item->name }}
                        </h2>


                        {{-- TANGGAL --}}
                        <p class="event-date">

                            {{ $item->start_date->translatedFormat('d F Y') }}

                            @if (
                                $item->end_date &&
                                $item->end_date->ne($item->start_date)
                            )
                                —
                                {{ $item->end_date->translatedFormat('d F Y') }}
                            @endif

                        </p>


                        {{-- WAKTU --}}
                        @if ($item->start_time)

                            <p class="event-info">

                                🕐
                                {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}

                                @if ($item->end_time)
                                    -
                                    {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                @endif

                                WIB

                            </p>

                        @endif


                        {{-- LOKASI --}}
                        @if ($item->location)

                            <p class="event-info">
                                📍 {{ $item->location }}
                            </p>

                        @endif


                        {{-- DESKRIPSI SINGKAT --}}
                        @if ($item->description)

                            <p class="event-excerpt">

                                {{
                                    \Illuminate\Support\Str::limit(
                                        strip_tags($item->description),
                                        120
                                    )
                                }}

                            </p>

                        @endif


                        <span class="event-link">
                            Lihat Detail →
                        </span>

                    </div>

                </article>

            @empty

                <div class="event-empty">

                    <div class="event-empty-icon">
                        📅
                    </div>

                    <h2>
                        Belum Ada Kegiatan
                    </h2>

                    <p>
                        Belum ada kegiatan gereja yang dapat ditampilkan.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- MOBILE NAVIGATION --}}
        @if ($events->count() > 1)

            <div class="events-mobile-nav">

                <button
                    type="button"
                    id="eventsPagePrev"
                    onclick="previousEventCard()"
                    aria-label="Event sebelumnya"
                >
                    &#10094;
                </button>

                <button
                    type="button"
                    id="eventsPageNext"
                    onclick="nextEventCard()"
                    aria-label="Event berikutnya"
                >
                    &#10095;
                </button>

            </div>

        @endif

    </div>

</section>


{{-- ========================================================= --}}
{{-- MODAL DETAIL EVENT --}}
{{-- ========================================================= --}}

<div
    id="eventModal"
    class="event-modal"
    onclick="closeEventModal(event)"
>

    <div
        class="event-modal-box"
        onclick="event.stopPropagation()"
    >

        {{-- CLOSE --}}
        <button
            type="button"
            class="event-modal-close"
            onclick="closeEventModal()"
            aria-label="Tutup detail event"
        >
            &times;
        </button>


        {{-- FOTO --}}
        <div class="event-modal-photo">

            <img
                id="modalEventPhoto"
                class="event-modal-clickable-image"
                src=""
                alt=""
            >

        </div>


        {{-- CONTENT --}}
        <div class="event-modal-content">

            <p class="event-category">
                📅 KEGIATAN GEREJA
            </p>

            <h2 id="modalEventName"></h2>

            <p
                id="modalEventDate"
                class="event-date"
            ></p>

            <p
                id="modalEventTime"
                class="event-info"
            ></p>

            <p
                id="modalEventLocation"
                class="event-info"
            ></p>

            <div
                id="modalEventDescription"
                class="event-excerpt"
            ></div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- LIGHTBOX FOTO EVENT --}}
{{-- ========================================================= --}}

<div
    id="eventImageLightbox"
    class="event-image-lightbox"
    onclick="closeEventImageLightbox()"
>

    <button
        type="button"
        class="event-image-lightbox-close"
        onclick="closeEventImageLightbox(event)"
        aria-label="Tutup foto"
    >
        &times;
    </button>


    <img
        id="eventLightboxImage"
        src=""
        alt=""
        onclick="event.stopPropagation()"
    >

</div>


{{-- ========================================================= --}}
{{-- LIGHTBOX STYLE --}}
{{-- ========================================================= --}}

<style>

.event-modal-clickable-image {
    cursor: zoom-in;
}


/* =========================
   EVENT IMAGE LIGHTBOX
========================= */

.event-image-lightbox {
    position: fixed;
    inset: 0;

    z-index: 10050;

    display: none;

    align-items: center;
    justify-content: center;

    padding: 20px;

    background: rgba(0, 0, 0, .92);
}


.event-image-lightbox.active {
    display: flex;
}


.event-image-lightbox img {
    max-width: 95vw;
    max-height: 95vh;

    width: auto;
    height: auto;

    object-fit: contain;

    display: block;
}


.event-image-lightbox-close {
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


@media (max-width: 700px) {

    .event-image-lightbox {
        padding: 12px;
    }


    .event-image-lightbox img {
        max-width: 96vw;
        max-height: 92vh;
    }


    .event-image-lightbox-close {
        top: 14px;
        right: 14px;

        width: 42px;
        height: 42px;

        font-size: 1.6rem;
    }

}

</style>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

const eventsData = @json($events->values());


/* =========================================================
   OPEN EVENT MODAL
========================================================= */

function openEventModal(id) {

    const event = eventsData.find(
        item => item.id == id
    );

    if (!event) {
        return;
    }


    const modal = document.getElementById('eventModal');

    const photo = document.getElementById('modalEventPhoto');


    /* =========================
       TEXT
    ========================= */

    document.getElementById('modalEventName').textContent =
        event.name;


    document.getElementById('modalEventDate').textContent =
        formatEventDate(
            event.start_date,
            event.end_date
        );


    document.getElementById('modalEventTime').textContent =
        event.start_time
            ? '🕐 ' +
              formatEventTime(
                  event.start_time,
                  event.end_time
              ) +
              ' WIB'
            : '';


    document.getElementById('modalEventLocation').textContent =
        event.location
            ? '📍 ' + event.location
            : '';


    document.getElementById('modalEventDescription').textContent =
        event.description || '';


    /* =========================
       PHOTO
    ========================= */

    const photoUrl = event.photo
        ? "{{ asset('storage') }}/" + event.photo
        : "{{ asset('images/event-default.png') }}";


    photo.src = photoUrl;

    photo.alt = event.name;

    photo.style.display = 'block';


    /* =========================
       CLICK PHOTO → LIGHTBOX
    ========================= */

    photo.onclick = function () {

        openEventImageLightbox(
            photoUrl,
            event.name
        );

    };


    /* =========================
       OPEN MODAL
    ========================= */

    modal.classList.add('active');

    document.body.style.overflow = 'hidden';

}


/* =========================================================
   CLOSE EVENT MODAL
========================================================= */

function closeEventModal(event = null) {

    if (
        event &&
        event.target !== event.currentTarget
    ) {
        return;
    }


    const modal =
        document.getElementById('eventModal');


    modal.classList.remove('active');


    document.body.style.overflow = '';

}


/* =========================================================
   FORMAT EVENT DATE
========================================================= */

function formatEventDate(start, end) {

    const startDate =
        new Date(start);


    const startText =
        startDate.toLocaleDateString(
            'id-ID',
            {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }
        );


    if (
        !end ||
        end === start
    ) {

        return '📅 ' + startText;

    }


    const endDate =
        new Date(end);


    const endText =
        endDate.toLocaleDateString(
            'id-ID',
            {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }
        );


    return (
        '📅 ' +
        startText +
        ' — ' +
        endText
    );

}


/* =========================================================
   FORMAT EVENT TIME
========================================================= */

function formatEventTime(start, end) {

    const startText =
        start.substring(0, 5);


    if (!end) {

        return startText;

    }


    return (
        startText +
        ' - ' +
        end.substring(0, 5)
    );

}


/* =========================================================
   OPEN EVENT IMAGE LIGHTBOX
========================================================= */

function openEventImageLightbox(
    photo,
    name
) {

    const lightbox =
        document.getElementById(
            'eventImageLightbox'
        );


    const image =
        document.getElementById(
            'eventLightboxImage'
        );


    if (
        !lightbox ||
        !image
    ) {
        return;
    }


    image.src = photo;

    image.alt = name || '';


    lightbox.classList.add('active');


    document.body.style.overflow = 'hidden';

}


/* =========================================================
   CLOSE EVENT IMAGE LIGHTBOX
========================================================= */

function closeEventImageLightbox(
    event = null
) {

    if (event) {

        event.stopPropagation();

    }


    const lightbox =
        document.getElementById(
            'eventImageLightbox'
        );


    if (!lightbox) {

        return;

    }


    lightbox.classList.remove('active');


    /*
     * Kalau modal event masih terbuka,
     * body tetap dikunci.
     */
    const modal =
        document.getElementById(
            'eventModal'
        );


    if (
        modal &&
        modal.classList.contains('active')
    ) {

        document.body.style.overflow =
            'hidden';

    } else {

        document.body.style.overflow =
            '';

    }

}


/* =========================================================
   KEYBOARD
========================================================= */

document.addEventListener(
    'keydown',
    function (event) {

        const lightbox =
            document.getElementById(
                'eventImageLightbox'
            );


        /*
         * Kalau lightbox sedang terbuka,
         * ESC menutup lightbox dulu.
         */
        if (
            lightbox &&
            lightbox.classList.contains('active')
        ) {

            if (event.key === 'Escape') {

                closeEventImageLightbox();

            }

            return;

        }


        const modal =
            document.getElementById(
                'eventModal'
            );


        if (
            !modal ||
            !modal.classList.contains('active')
        ) {

            return;

        }


        if (event.key === 'Escape') {

            closeEventModal();

        }

    }
);


/* =========================================================
   EVENT CARD CAROUSEL - HP
========================================================= */

let eventPageCurrentIndex = 0;


function getEventCards() {

    return document.querySelectorAll(
        '#eventsGrid .event-card'
    );

}


/* =========================================================
   UPDATE MOBILE CAROUSEL
========================================================= */

function updateEventCardCarousel() {

    const cards =
        getEventCards();


    if (!cards.length) {

        return;

    }


    /*
     * Desktop:
     * semua card tampil.
     */
    if (window.innerWidth > 600) {

        cards.forEach(
            card => {

                card.style.display = '';

            }
        );

        return;

    }


    /*
     * Mobile:
     * hanya satu card tampil.
     */
    cards.forEach(
        (card, index) => {

            if (
                index ===
                eventPageCurrentIndex
            ) {

                card.style.display = '';

            } else {

                card.style.display = 'none';

            }

        }
    );


    const prev =
        document.getElementById(
            'eventsPagePrev'
        );


    const next =
        document.getElementById(
            'eventsPageNext'
        );


    if (prev) {

        prev.disabled =
            eventPageCurrentIndex === 0;

    }


    if (next) {

        next.disabled =
            eventPageCurrentIndex ===
            cards.length - 1;

    }

}


/* =========================================================
   PREVIOUS EVENT
========================================================= */

function previousEventCard() {

    const cards =
        getEventCards();


    if (!cards.length) {

        return;

    }


    if (
        eventPageCurrentIndex > 0
    ) {

        eventPageCurrentIndex--;

        updateEventCardCarousel();

    }

}


/* =========================================================
   NEXT EVENT
========================================================= */

function nextEventCard() {

    const cards =
        getEventCards();


    if (!cards.length) {

        return;

    }


    if (
        eventPageCurrentIndex <
        cards.length - 1
    ) {

        eventPageCurrentIndex++;

        updateEventCardCarousel();

    }

}


/* =========================================================
   INITIAL LOAD
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        updateEventCardCarousel();

    }
);


/* =========================================================
   RESIZE
========================================================= */

window.addEventListener(
    'resize',
    function () {

        updateEventCardCarousel();

    }
);

</script>

@endsection