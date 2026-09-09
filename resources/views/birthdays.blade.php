@extends('layouts.public')

@section('title', 'Ulang Tahun Jemaat - GPIJS Jakpus')

@section('content')

<section class="birthday-page">

    {{-- HEADER --}}
    <div class="birthday-header">

        <p class="birthday-label">
            WARTA JEMAAT
        </p>

        <h1>
            Ulang Tahun Jemaat
        </h1>

        <p class="birthday-subtitle">
            Selamat ulang tahun bagi jemaat GPIJS Jakpus
            yang berulang tahun di bulan
            <strong>{{ now()->translatedFormat('F') }}</strong>
        </p>

        <a href="{{ url('/#warta') }}" class="birthday-back-button">
            ← Kembali ke Warta Jemaat
        </a>

    </div>


   {{-- CARD ULANG TAHUN --}}
<div class="birthday-carousel-wrapper">

    <div class="birthday-grid" id="birthdayGrid">

        @forelse ($birthdays as $jemaat)

            <article class="birthday-card">

                {{-- FOTO --}}
                <div class="birthday-photo">

                    @if ($jemaat->photo)

                        <img src="{{ asset('storage/' . $jemaat->photo) }}"
                             alt="{{ $jemaat->name }}">

                    @else

                        <div class="birthday-no-photo">
                            👤
                        </div>

                    @endif

                </div>


                {{-- ISI CARD --}}
                <div class="birthday-content">

                    <div class="birthday-icon">
                        🎂
                    </div>

                    <p class="birthday-wish">
                        Selamat Ulang Tahun
                    </p>

                    @php
                    $displayName = $jemaat->name;

                    if ($jemaat->birth_date) {
                        $age = $jemaat->birth_date->age;

                        if ($age > 40) {
                            if ($jemaat->gender === 'male') {
                                $displayName = 'Pak ' . $jemaat->name;
                            } elseif ($jemaat->gender === 'female') {
                                $displayName = 'Bu ' . $jemaat->name;
                            }
                        } elseif ($age > 20) {
                            $displayName = 'Kak ' . $jemaat->name;
                        }
                    }
                @endphp

                <h2>
                    {{ $displayName }}
                </h2>

                    <div class="birthday-date">
                        {{ $jemaat->birth_date->translatedFormat('d F Y') }}
                    </div>

                    <p class="birthday-message">
                        Kiranya Tuhan Yesus senantiasa
                        menyertai, memberkati, memberikan
                        kesehatan, sukacita, dan kekuatan
                        dalam setiap langkah kehidupan.
                    </p>

                </div>

            </article>

        @empty

            <div class="birthday-empty">

                <div class="birthday-empty-icon">
                    🎂
                </div>

                <h2>
                    Belum Ada Ulang Tahun
                </h2>

                <p>
                    Belum ada jemaat yang berulang tahun
                    pada bulan {{ now()->translatedFormat('F') }}.
                </p>

            </div>

        @endforelse

    </div>


    {{-- TOMBOL CAROUSEL KHUSUS HP --}}
    @if ($birthdays->count() > 1)

        <div class="birthday-mobile-nav">

            <button type="button"
                    id="birthdayPrev"
                    onclick="birthdayPrev()"
                    aria-label="Ulang tahun sebelumnya">
                &#10094;
            </button>

            <button type="button"
                    id="birthdayNext"
                    onclick="birthdayNext()"
                    aria-label="Ulang tahun berikutnya">
                &#10095;
            </button>

        </div>

    @endif

</div>

</section>




<script>

    let birthdayCurrent = 0;

    function birthdayCards() {
        return document.querySelectorAll('.birthday-card');
    }


    function birthdayUpdate() {

        const cards = birthdayCards();

        if (!cards.length) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Desktop
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
        | Mobile
        |--------------------------------------------------------------------------
        */

        cards.forEach((card, index) => {

            if (index === birthdayCurrent) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }

        });


        /*
        |--------------------------------------------------------------------------
        | Tombol
        |--------------------------------------------------------------------------
        */

        const prev = document.getElementById('birthdayPrev');
        const next = document.getElementById('birthdayNext');

        if (prev) {
            prev.disabled = birthdayCurrent === 0;
        }

        if (next) {
            next.disabled = birthdayCurrent === cards.length - 1;
        }

    }


    function birthdayPrev() {

        const cards = birthdayCards();

        if (!cards.length) {
            return;
        }

        if (birthdayCurrent > 0) {
            birthdayCurrent--;
            birthdayUpdate();
        }

    }


    function birthdayNext() {

        const cards = birthdayCards();

        if (!cards.length) {
            return;
        }

        if (birthdayCurrent < cards.length - 1) {
            birthdayCurrent++;
            birthdayUpdate();
        }

    }


    window.addEventListener('resize', birthdayUpdate);

    document.addEventListener('DOMContentLoaded', birthdayUpdate);

</script>

@endsection