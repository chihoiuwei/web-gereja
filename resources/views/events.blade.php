@extends('layouts.public')

@section('title', 'Kegiatan Gereja - GPIJS Jakpus')

@section('content')

<section class="events-page">

    {{-- HEADER --}}
    <div class="events-header">

        <p class="events-label">
            KEGIATAN GEREJA
        </p>

        <h1>
            Kegiatan Mendatang
        </h1>

        <p class="events-subtitle">
            Informasi kegiatan dan acara GPI Jalan Suci Jakpus
        </p>

        <a href="{{ url('/#warta') }}" class="birthday-back-button">
            ← Kembali ke Warta Jemaat
        </a>
    </div>


    {{-- DAFTAR EVENT --}}
    <div class="events-carousel-wrapper">

    <div class="events-grid" id="eventsGrid">

        @forelse ($events as $item)

            <article class="event-card"
            onclick="openEventModal({{ $item->id }})"
            style="cursor: pointer;">

                {{-- FOTO --}}
                <div class="event-photo">

                    @if ($item->photo)

                        <img src="{{ asset('storage/' . $item->photo) }}"
                             alt="{{ $item->name }}">

                    @else

                        <img src="{{ asset('images/event-default.png') }}"
                             alt="Kegiatan Gereja">

                    @endif

                </div>


                {{-- ISI CARD --}}
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

                        @if ($item->end_date && $item->end_date->ne($item->start_date))

                            —
                            {{ $item->end_date->translatedFormat('d F Y') }}

                        @endif
                    </p>


                    {{-- JAM --}}
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


                    {{-- DESKRIPSI --}}
                    @if ($item->description)

                        <p class="event-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 120) }}
                        </p>

                    @endif


                    <span class="event-link">
                        Lihat Detail →
                    </span>

                </div>

            </article>

        @empty

            <div class="events-empty">

                <div class="events-empty-icon">
                    📅
                </div>

                <h2>
                    Belum Ada Kegiatan
                </h2>

                <p>
                    Belum ada kegiatan gereja yang akan datang.
                </p>

            </div>

       @endforelse

    </div>


    {{-- TOMBOL CAROUSEL KHUSUS HP --}}
    @if ($events->count() > 1)

        <div class="events-mobile-nav">

            <button type="button"
                    id="eventsPagePrev"
                    onclick="previousEventCard()"
                    aria-label="Event sebelumnya">
                &#10094;
            </button>

            <button type="button"
                    id="eventsPageNext"
                    onclick="nextEventCard()"
                    aria-label="Event berikutnya">
                &#10095;
            </button>

        </div>

    @endif

</div>

</section>




{{-- MODAL DETAIL EVENT --}}
<div id="eventModal"
     class="event-modal"
     onclick="closeEventModal(event)">

    <div class="event-modal-box" onclick="event.stopPropagation()">

        <button type="button"
                class="event-modal-close"
                onclick="closeEventModal()">
            &times;
        </button>

        <div class="event-modal-photo">
            <img id="modalEventPhoto" src="" alt="">
        </div>

        <div class="event-modal-content">
            <p class="event-category">📅 KEGIATAN GEREJA</p>

            <h2 id="modalEventName"></h2>

            <p id="modalEventDate" class="event-date"></p>

            <p id="modalEventTime" class="event-info"></p>

            <p id="modalEventLocation" class="event-info"></p>

            <div id="modalEventDescription" class="event-excerpt"></div>
        </div>

    </div>
</div>

<script>
    const eventsData = @json($events->values());

    function openEventModal(id) {
        const event = eventsData.find(item => item.id == id);

        if (!event) {
            return;
        }

        const modal = document.getElementById('eventModal');
        const photo = document.getElementById('modalEventPhoto');

        document.getElementById('modalEventName').textContent =
            event.name;

        document.getElementById('modalEventDate').textContent =
            formatEventDate(event.start_date, event.end_date);

        document.getElementById('modalEventTime').textContent =
            event.start_time
                ? '🕐 ' + formatEventTime(event.start_time, event.end_time) + ' WIB'
                : '';

        document.getElementById('modalEventLocation').textContent =
            event.location
                ? '📍 ' + event.location
                : '';

        document.getElementById('modalEventDescription').textContent =
            event.description || '';

        if (event.photo) {
            photo.src = "{{ asset('storage') }}/" + event.photo;
        } else {
            photo.src = "{{ asset('images/event-default.png') }}";
        }

        photo.alt = event.name;

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeEventModal(event) {
        if (event && event.target !== event.currentTarget) {
            return;
        }

        const modal = document.getElementById('eventModal');

        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    function formatEventDate(start, end) {
        const startDate = new Date(start);
        const startText = startDate.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        if (!end || end === start) {
            return '📅 ' + startText;
        }

        const endDate = new Date(end);

        const endText = endDate.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        return '📅 ' + startText + ' — ' + endText;
    }

    function formatEventTime(start, end) {
        const startText = start.substring(0, 5);

        if (!end) {
            return startText;
        }

        return startText + ' - ' + end.substring(0, 5);
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEventModal();
        }
    });

    /* ============================================================
       EVENT CARD CAROUSEL - HP
    ============================================================ */

    let eventPageCurrentIndex = 0;


    function getEventCards() {

        return document.querySelectorAll(
            '#eventsGrid .event-card'
        );

    }


    function updateEventCardCarousel() {

        const cards = getEventCards();

        if (!cards.length) {
            return;
        }


        /* DESKTOP */

        if (window.innerWidth > 600) {

            cards.forEach(card => {

                card.style.display = '';

            });

            return;
        }


        /* MOBILE */

        cards.forEach((card, index) => {

            if (index === eventPageCurrentIndex) {

                card.style.display = '';

            } else {

                card.style.display = 'none';

            }

        });


        const prev =
            document.getElementById('eventsPagePrev');

        const next =
            document.getElementById('eventsPageNext');


        if (prev) {

            prev.disabled =
                eventPageCurrentIndex === 0;

        }


        if (next) {

            next.disabled =
                eventPageCurrentIndex === cards.length - 1;

        }

    }


    function previousEventCard() {

        const cards = getEventCards();

        if (!cards.length) {
            return;
        }


        if (eventPageCurrentIndex > 0) {

            eventPageCurrentIndex--;

            updateEventCardCarousel();

        }

    }


    function nextEventCard() {

        const cards = getEventCards();

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


    document.addEventListener(
        'DOMContentLoaded',
        function () {

            updateEventCardCarousel();

        }
    );


    window.addEventListener(
        'resize',
        function () {

            updateEventCardCarousel();

        }
    );
</script>

@endsection