@extends('layouts.public')

@section('title', 'Meet the Team - GPIJS Jakpus')

@section('content')

<section class="team-page">

    {{-- HEADER --}}
    <div class="team-header">

        <p class="team-label">
            PENATALAYAN GEREJA
        </p>

        <h1>
            Meet the Team
        </h1>

        <p class="team-subtitle">
            Kenali orang-orang yang melayani
            dan mengambil bagian dalam pelayanan
            di GPIJS Jakpus.
        </p>

        <a href="{{ url('/#penatalayan') }}" class="team-back-button">
            ← Kembali ke Penatalayan
        </a>

    </div>


    {{-- TEAM GRID --}}
    <div class="team-grid">

        @forelse ($penatalayan as $member)

            <article class="team-card">

                {{-- FOTO --}}
                <div class="team-photo">

                    @if ($member->jemaat && $member->jemaat->photo)

                        <img
                            src="{{ asset('storage/' . $member->jemaat->photo) }}"
                            alt="{{ $member->jemaat->name }}"
                        >

                    @else

                        <div class="team-no-photo">
                            👤
                        </div>

                    @endif

                </div>


                {{-- CONTENT --}}
                <div class="team-content">

                    <h2>
                        {{ $member->jemaat->name ?? '-' }}
                    </h2>

                    <p class="team-ministry">
                        {{ $member->ministry->name ?? '-' }}
                    </p>

                    @if ($member->position)

                        <p class="team-position">
                            {{ $member->position }}
                        </p>

                    @endif

                </div>

            </article>

        @empty

            <div class="team-empty">

                <div class="team-empty-icon">
                    👥
                </div>

                <h2>
                    Belum Ada Penatalayan
                </h2>

                <p>
                    Belum ada penatalayan aktif yang dapat ditampilkan.
                </p>

            </div>

        @endforelse

    </div>

</section>




@endsection