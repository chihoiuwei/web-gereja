@extends('layouts.public')

@section('title', 'Jadwal Ibadah - GPIJS Jakpus')

@section('content')

<section class="worship-page">

    {{-- HEADER --}}
    <div class="worship-header">

        <p class="worship-label" style="
            margin-top: 80px;
        ">
            IBADAH GEREJA
        </p>

        <h1>
            Jadwal Ibadah
        </h1>

        <p class="worship-subtitle">
            Jadwal ibadah dan kegiatan persekutuan
            GPI Jalan Suci Jakpus
        </p>

        <a href="{{ url('/#warta') }}" class="birthday-back-button">
            ← Kembali ke Warta Jemaat
        </a>

    </div>


    {{-- DAFTAR JADWAL --}}
    <div class="worship-grid" id="worshipGrid">

        @forelse ($worshipSchedules as $schedule)

            <article
                class="worship-card"
                onclick="openWorshipModal({{ $loop->index }})"
            >

                {{-- FOTO --}}
                <div class="worship-photo">

                    @if ($schedule->photo)

                        <img
                            src="{{ asset('storage/' . $schedule->photo) }}"
                            alt="{{ $schedule->name }}"
                        >

                    @else

                        <div class="worship-no-photo">
                            ⛪
                        </div>

                    @endif

                </div>


                {{-- ISI CARD --}}
                <div class="worship-content">

                    <p class="worship-category">
                        IBADAH GEREJA
                    </p>

                    <h2>
                        {{ $schedule->name }}
                    </h2>

                    <p class="worship-day">
                        {{ $schedule->day }}
                    </p>

                    <p class="worship-time">

                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                        @if ($schedule->end_time)
                            - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        @endif

                    </p>

                    <p class="worship-excerpt">
                        {{ \Illuminate\Support\Str::limit($schedule->description ?? 'Jadwal ibadah gereja.', 100) }}
                    </p>

                    <span class="worship-link">
                        Lihat Detail →
                    </span>

                </div>

            </article>

        @empty

            <div class="worship-empty">

                <div class="worship-empty-icon">
                    ⛪
                </div>

                <h2>
                    Belum Ada Jadwal Ibadah
                </h2>

                <p>
                    Belum ada jadwal ibadah yang dipublikasikan.
                </p>

            </div>

        @endforelse

    </div>

    {{-- TOMBOL CAROUSEL KHUSUS HP --}}
@if ($worshipSchedules->count() > 1)

    <div class="worship-mobile-nav">

        <button
            type="button"
            id="worshipPagePrev"
            onclick="previousWorshipCard()"
            aria-label="Jadwal sebelumnya">
            &#10094;
        </button>

        <button
            type="button"
            id="worshipPageNext"
            onclick="nextWorshipCard()"
            aria-label="Jadwal berikutnya">
            &#10095;
        </button>

    </div>

@endif

</section>



{{-- ============================================================
     WORSHIP MODAL
============================================================ --}}

<div
    id="worshipModal"
    class="worship-modal"
    onclick="closeWorshipModal(event)"
>

    {{-- CLOSE --}}
    <button
        type="button"
        class="worship-modal-close"
        onclick="closeWorshipModal()"
    >
        &times;
    </button>


    {{-- PREV --}}
    <button
        type="button"
        id="worshipPrev"
        class="worship-modal-arrow worship-modal-prev"
        onclick="previousWorship(event)"
    >
        &#10094;
    </button>


    {{-- MODAL --}}
    <div
        class="worship-modal-box"
        onclick="event.stopPropagation()"
    >

        {{-- FOTO KIRI --}}
        <div class="worship-modal-image">

            <img
                id="modalWorshipImage"
                src=""
                alt=""
            >

        </div>


        {{-- INFORMASI KANAN --}}
        <div class="worship-modal-content">

            <p
                id="modalWorshipCategory"
                class="worship-modal-category"
            >
                IBADAH GEREJA
            </p>

            <h2 id="modalWorshipTitle">
            </h2>

            <div class="worship-modal-info">

                <p>
                    <strong>Hari</strong>
                    <span id="modalWorshipDay"></span>
                </p>

                <p>
                    <strong>Waktu</strong>
                    <span id="modalWorshipTime"></span>
                </p>

            </div>

            <div class="worship-modal-body">

                <h3>
                    Deskripsi
                </h3>

                <p id="modalWorshipDescription">
                </p>

            </div>

        </div>

    </div>


    {{-- NEXT --}}
    <button
        type="button"
        id="worshipNext"
        class="worship-modal-arrow worship-modal-next"
        onclick="nextWorship(event)"
    >
        &#10095;
    </button>

</div>


<style>

.worship-page {
    min-height: 80vh;
    padding: 70px 40px 100px;
}

.worship-header {
    text-align: center;
    margin-bottom: 50px;
}

.worship-label {
    color: #2563eb;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .15em;
    margin-bottom: 10px;
}

.worship-header h1 {
    color: #111827;
    font-size: 2.8rem;
    font-weight: 800;
    margin: 0;
}

.worship-subtitle {
    color: #6b7280;
    margin-top: 12px;
}


/* ============================================================
   CARD
============================================================ */

.worship-grid {
    max-width: 1200px;
    margin: 0 auto;

    display: grid;
    grid-template-columns: repeat(auto-fit, 240px);
    justify-content: center;
    gap: 24px;
}

.worship-card {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;

    box-shadow: 0 8px 25px rgba(0,0,0,.08);

    cursor: pointer;

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.worship-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 35px rgba(0,0,0,.12);
}


/* FOTO */

.worship-photo {
    height: 230px;

    background: #f3f4f6;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;
}

.worship-photo img {
    width: 100%;
    height: 100%;

    object-fit: contain;
}

.worship-no-photo {
    font-size: 3rem;
    color: #9ca3af;
}


/* CONTENT */

.worship-content {
    padding: 20px;
}

.worship-category {
    color: #2563eb;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .08em;
}

.worship-content h2 {
    color: #111827;
    font-size: 1.1rem;
    font-weight: 700;

    margin-top: 8px;
}

.worship-day {
    color: #6b7280;
    font-size: .85rem;

    margin-top: 10px;
}

.worship-time {
    color: #2563eb;
    font-size: .9rem;
    font-weight: 700;

    margin-top: 5px;
}

.worship-excerpt {
    color: #6b7280;
    font-size: .8rem;
    line-height: 1.5;

    margin-top: 12px;
}

.worship-link {
    display: block;

    color: #2563eb;
    font-size: .85rem;
    font-weight: 700;

    margin-top: 18px;
}


/* ============================================================
   MODAL
============================================================ */

.worship-modal {
    position: fixed;
    inset: 0;

    z-index: 9999;

    display: none;
    align-items: center;
    justify-content: center;

    padding: 40px;

    background: rgba(15, 23, 42, .75);
}

.worship-modal.active {
    display: flex;
}

.worship-modal-box {
    width: min(1000px, 90vw);
    height: min(600px, 80vh);

    display: grid;
    grid-template-columns: 1fr 1fr;

    background: #ffffff;

    border-radius: 20px;
    overflow: hidden;

    box-shadow: 0 25px 70px rgba(0,0,0,.3);
}


/* FOTO KIRI */

.worship-modal-image {
    background: #f3f4f6;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;
}

.worship-modal-image img {
    width: 100%;
    height: 100%;

    object-fit: contain;
}


/* KANAN */

.worship-modal-content {
    padding: 45px;

    overflow-y: auto;
}

.worship-modal-category {
    color: #2563eb;

    font-size: .75rem;
    font-weight: 700;

    letter-spacing: .1em;
}

.worship-modal-content h2 {
    color: #111827;

    font-size: 2rem;
    font-weight: 800;

    margin-top: 10px;
}

.worship-modal-info {
    margin-top: 30px;

    display: flex;
    flex-direction: column;
    gap: 15px;
}

.worship-modal-info p {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.worship-modal-info strong {
    color: #9ca3af;
    font-size: .8rem;
}

.worship-modal-info span {
    color: #111827;
    font-weight: 600;
}

.worship-modal-body {
    margin-top: 30px;

    padding-top: 25px;

    border-top: 1px solid #e5e7eb;
}

.worship-modal-body h3 {
    color: #111827;

    font-size: 1rem;
    font-weight: 700;
}

.worship-modal-body p {
    color: #6b7280;

    font-size: .95rem;
    line-height: 1.8;

    margin-top: 10px;
}


/* CLOSE */

.worship-modal-close {
    position: fixed;

    top: 25px;
    right: 30px;

    width: 45px;
    height: 45px;

    border: none;
    border-radius: 50%;

    background: #ffffff;
    color: #111827;

    font-size: 1.8rem;

    cursor: pointer;

    z-index: 10001;
}


/* ARROW */

.worship-modal-arrow {
    position: fixed;

    top: 50%;

    transform: translateY(-50%);

    width: 45px;
    height: 45px;

    border: none;
    border-radius: 50%;

    background: #ffffff;
    color: #2563eb;

    font-size: 1.2rem;

    cursor: pointer;

    box-shadow: 0 5px 20px rgba(0,0,0,.2);

    z-index: 10001;
}

.worship-modal-prev {
    left: 25px;
}

.worship-modal-next {
    right: 25px;
}


/* ============================================================
   MOBILE
============================================================ */

@media (max-width: 900px) {

    .worship-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 700px) {

    .worship-page {
        padding: 50px 20px 80px;
    }

    .worship-header h1 {
        font-size: 2rem;
    }
    .worship-grid {
        grid-template-columns: 1fr;
    }

    .worship-mobile-nav {
    display: flex;
    justify-content: center;
    gap: 14px;
    margin-top: 24px;
}

.worship-mobile-nav button {
    width: 42px;
    height: 42px;

    border: none;
    border-radius: 50%;

    background: #2563eb;
    color: #ffffff;

    font-size: 1.1rem;
    cursor: pointer;

    box-shadow: 0 5px 15px rgba(0,0,0,.15);
}

.worship-mobile-nav button:disabled {
    opacity: .35;
    cursor: default;
}
    .worship-modal {
        padding: 20px;
    }

    .worship-modal-box {
        width: 100%;
        height: auto;
        max-height: 90vh;

        display: flex;
        flex-direction: column;
    }

    .worship-modal-image {
        height: 300px;
        flex-shrink: 0;
    }

    .worship-modal-content {
        padding: 25px;
    }

    .worship-modal-content h2 {
        font-size: 1.5rem;
    }

    .worship-modal-prev {
        left: 8px;
    }

    .worship-modal-next {
        right: 8px;
    }

}

</style>


@php

$worshipData = $worshipSchedules->map(function ($schedule) {

    return [

        'name' => $schedule->name,

        'day' => $schedule->day,

        'time' =>
            \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
            .
            (
                $schedule->end_time
                    ? ' - ' . \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
                    : ''
            ),

        'description' =>
            strip_tags(
                $schedule->description ?? 'Jadwal ibadah gereja.'
            ),

        'photo' =>
            $schedule->photo
                ? asset('storage/' . $schedule->photo)
                : null,

    ];

})->values();

@endphp


<script>

    /* ============================================================
   WORSHIP CARD CAROUSEL - HP
============================================================ */

let worshipPageCurrentIndex = 0;

function getWorshipCards() {
    return document.querySelectorAll(
        '#worshipGrid .worship-card'
    );
}

function updateWorshipCardCarousel() {

    const cards = getWorshipCards();

    if (!cards.length) {
        return;
    }

    /* DESKTOP */
    if (window.innerWidth > 700) {

        cards.forEach(card => {
            card.style.display = '';
        });

        return;
    }

    /* MOBILE */
    cards.forEach((card, index) => {

        if (index === worshipPageCurrentIndex) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }

    });

    const prev =
        document.getElementById('worshipPagePrev');

    const next =
        document.getElementById('worshipPageNext');

    if (prev) {
        prev.disabled =
            worshipPageCurrentIndex === 0;
    }

    if (next) {
        next.disabled =
            worshipPageCurrentIndex === cards.length - 1;
    }
}

function previousWorshipCard() {

    const cards = getWorshipCards();

    if (!cards.length) {
        return;
    }

    if (worshipPageCurrentIndex > 0) {

        worshipPageCurrentIndex--;

        updateWorshipCardCarousel();
    }
}

function nextWorshipCard() {

    const cards = getWorshipCards();

    if (!cards.length) {
        return;
    }

    if (
        worshipPageCurrentIndex <
        cards.length - 1
    ) {

        worshipPageCurrentIndex++;

        updateWorshipCardCarousel();
    }
}

document.addEventListener(
    'DOMContentLoaded',
    function () {
        updateWorshipCardCarousel();
    }
);

window.addEventListener(
    'resize',
    function () {
        updateWorshipCardCarousel();
    }
);

const worshipData =
    {{ \Illuminate\Support\Js::from($worshipData) }};

let currentWorshipIndex = 0;


/* OPEN */

function openWorshipModal(index)
{
    currentWorshipIndex = index;

    showWorship(currentWorshipIndex);

    document
        .getElementById('worshipModal')
        .classList
        .add('active');

    document.body.style.overflow = 'hidden';
}


/* CLOSE */

function closeWorshipModal(event = null)
{
    if (
        event &&
        event.target !== event.currentTarget
    ) {
        return;
    }

    document
        .getElementById('worshipModal')
        .classList
        .remove('active');

    document.body.style.overflow = '';
}


/* SHOW */

function showWorship(index)
{
    if (!worshipData.length) {
        return;
    }

    currentWorshipIndex = index;

    const worship =
        worshipData[currentWorshipIndex];


    document
        .getElementById('modalWorshipTitle')
        .textContent = worship.name;


    document
        .getElementById('modalWorshipDay')
        .textContent = worship.day;


    document
        .getElementById('modalWorshipTime')
        .textContent = worship.time;


    document
        .getElementById('modalWorshipDescription')
        .textContent = worship.description;


    const image =
        document.getElementById('modalWorshipImage');


    if (worship.photo) {

        image.src = worship.photo;
        image.alt = worship.name;

        image.style.display = 'block';

    } else {

        image.src = '';
        image.alt = '';

        image.style.display = 'none';

    }

}


/* PREVIOUS */

function previousWorship(event)
{
    event.stopPropagation();

    if (worshipData.length <= 1) {
        return;
    }

    currentWorshipIndex--;

    if (currentWorshipIndex < 0) {
        currentWorshipIndex =
            worshipData.length - 1;
    }

    showWorship(currentWorshipIndex);
}


/* NEXT */

function nextWorship(event)
{
    event.stopPropagation();

    if (worshipData.length <= 1) {
        return;
    }

    currentWorshipIndex++;

    if (
        currentWorshipIndex >=
        worshipData.length
    ) {
        currentWorshipIndex = 0;
    }

    showWorship(currentWorshipIndex);
}


/* KEYBOARD */

document.addEventListener(
    'keydown',
    function(event) {

        const modal =
            document.getElementById(
                'worshipModal'
            );

        if (
            !modal.classList.contains('active')
        ) {
            return;
        }

        if (event.key === 'Escape') {
            closeWorshipModal();
        }

        if (event.key === 'ArrowLeft') {
            previousWorship(event);
        }

        if (event.key === 'ArrowRight') {
            nextWorship(event);
        }

    }
);

</script>

@endsection