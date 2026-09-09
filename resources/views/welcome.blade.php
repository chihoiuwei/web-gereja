@extends('layouts.public')

@section('title', 'Home - GPIJS Jakpus')

@section('content')

{{-- ============================================================
     WRAPPER — background biru mencakup navbar + hero
============================================================ --}}
<div style="
    position: relative;
    z-index: 2;
    background: radial-gradient(ellipse at 50% 38%, #1e6ad4 0%, #1248a8 50%, #0b338a 100%);
    color: #fff;
">




    {{-- ============================================================
         HERO SECTION — FA, TH, salib, merpati, teks alkitab
         height = 100vh dikurangi tinggi navbar (78px)
    ============================================================ --}}
    <section id="hero" style="
        position: relative;
        width: 100%;
        height: calc(100vh - 78px);
        overflow: hidden;
    ">

        {{-- ── Cahaya / glow background ─────────────────────────── --}}
        <div style="
            position: absolute;
            width: 900px; height: 900px;
            background: rgba(80,140,255,0.13);
            border-radius: 50%;
            filter: blur(90px);
            top: -10%; left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
        "></div>


        {{-- ── MERPATI ──────────────────────────────────────────── --}}
        <div class="hero-dove">
            <img src="{{ asset('images/merpati.png') }}"
                 alt="Merpati"
                 style="width: 100%; height: auto; display: block;">
        </div>


        {{-- ── AYAT REFERENSI (YES / YOH) ──────────────────────── --}}
        <p class="hero-reference">
            YES 35 : 8 &nbsp;&nbsp; YOH 14 : 6
        </p>


        {{-- ── HURUF "FA" ───────────────────────────────────────── --}}
       <div class="hero-fa
        ">FA</div>


        {{-- ── HURUF "TH" ───────────────────────────────────────── --}}
        <div class="hero-th
        ">TH</div>


        {{-- ── SALIB / HERO IMAGE ────────────────────────────────── --}}
        <div class="hero-cross">
            <img src="{{ asset('images/hero.png') }}"
                 alt="Salib GPIJS"
                 style="width: 100%; height: auto; display: block;">
        </div>


        {{-- ── TEKS ALKITAB KIRI (Yesaya 35:8) ─────────────────── --}}
        <div class="hero-text-left">
            <p style="font-size: 1.05rem; line-height: 1.85; color: rgba(255,255,255,.95);">
                "Di Situ Akan Ada Jalan Raya, Yang Akan
                Disebutkan Jalan Kudus; Orang Yang Tidak
                Tahir Tidak Akan Melintasinya, Dan Orang-
                Orang Pandir Tidak Akan Mengembara Di
                Atasnya."
            </p>
        </div>


        {{-- ── TEKS ALKITAB KANAN (Yohanes 14:6) ──────────────── --}}
        <div class="hero-text-right">
            <p style="font-size: 1.05rem; line-height: 1.85; color: rgba(255,255,255,.95);">
                "Kata Yesus Kepadanya: 'Akulah Jalan Dan
                Kebenaran Dan Hidup. Tidak Ada Seorang
                Pun Yang Datang Kepada Bapa, Kalau Tidak
                Melalui Aku.'"
            </p>
        </div>

    </section>

</div>{{-- end wrapper --}}


{{-- ============================================================
     STRIP BAWAH
============================================================ --}}
<section class="bottom-strip">

    <div class="bottom-strip-track">

        {{-- SET 1 --}}
        <div class="bottom-strip-inner">

            <div class="strip-item">
                <span>SALAM SATU ROH</span>

                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

            <div class="strip-item">
                <span>HIKANOS</span>

                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

            <div class="strip-item">
                <span>TUHAN YESUS BAIK</span>
                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

        </div>


        {{-- SET 2 --}}
        <div class="bottom-strip-inner">

            <div class="strip-item">
                <span>SALAM SATU ROH</span>

                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

            <div class="strip-item">
                <span>HIKANOS</span>

                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

            <div class="strip-item">
                <span>TUHAN YESUS BAIK</span>
                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

        </div>

        {{-- SET 3 --}}
          <div class="bottom-strip-inner">

            <div class="strip-item">
                <span>SALAM SATU ROH</span>

                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

            <div class="strip-item">
                <span>HIKANOS</span>

                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

            <div class="strip-item">
                <span>TUHAN YESUS BAIK</span>
                <img src="{{ asset('images/salib.png') }}"
                     alt="Salib">
            </div>

        </div>

    </div>

</section>


{{-- ============================================================
     SECTION ABOUT (placeholder)
============================================================ --}}
<section id="about"
         class="about-section"
         style="
            background-image: url('{{ asset('images/backgrounds.png') }}');
            background-repeat: no-repeat;
            background-position: center top;
            background-size: cover;
         ">

    <div class="about-content">

        <div class="about-title">
            <span>Sejarah</span>
            <h2>Jalan Suci</h2>
        </div>

        <div class="about-description">
            <p>
                Perjalanan Jalan Suci dimulai pada
                <strong>1965</strong> di Semarang.
                Pada <strong>1966</strong>, pelayanan berkembang
                di Nongkodjadjar dan membentuk generasi muda
                untuk hidup dalam Firman serta melayani.
            </p>

            <p>
                <strong>Bible Training Centre</strong> pertama berdiri
                di Lawang pada <strong>1971</strong>.
                Sejak <strong>1976</strong>, Jalan Suci diteruskan
                oleh generasi muda Indonesia dan terus berkembang
                hingga ke berbagai daerah dan negara.
            </p>
        </div>

        {{-- TIMELINE --}}
        <div class="about-timeline">

            <div class="timeline-item">
                <strong>1965</strong>
                <span>SEMARANG</span>
                <p>Awal perjalanan iman.</p>
            </div>

            <div class="timeline-item">
                <strong>1966</strong>
                <span>NONGKODJADJAR</span>
                <p>
                    Tuhan bekerja dan membentuk
                    generasi muda untuk melayani.
                </p>
            </div>

            <div class="timeline-item">
                <strong>1971</strong>
                <span>LAWANG</span>
                <p>
                    Bible Training Centre
                    pertama berdiri.
                </p>
            </div>

            <div class="timeline-item">
                <strong>1976</strong>
                <span>DITERUSKAN</span>
                <p>
                    Jalan Suci diteruskan oleh
                    generasi muda Indonesia.
                </p>
            </div>

            <div class="timeline-item">
                <strong>HARI INI</strong>
                <span>BERKEMBANG</span>
                <p>
                    Pelayanan terus berkembang
                    ke berbagai daerah dan negara.
                </p>
            </div>

        </div>

        {{-- QUOTE --}}
        <div class="about-quote">
            <span>“</span>
            Dari satu langkah iman, menjadi perjalanan
            yang berlanjut dari generasi ke generasi.
            <span>”</span>
        </div>

    </div>

</section>

{{-- ============================================================
     VISI & MISI
============================================================ --}}

<section id="visi-misi" class="vision-mission-section">

    <div class="vision-mission-container">
        

        {{-- HEADER VISI & MISI --}}
        <div class="vm-header">

            <p class="vm-label">
                VISI & MISI
            </p>

            <h2>
                Bersama Membangun
                <span>Tubuh Kristus</span>
            </h2>

            <div class="vm-divider"></div>

            <p class="vm-subtitle">
                Melaksanakan Amanat Agung, Hidup dalam Persekutuan,
                dan Menjadi Berkat bagi Dunia.
            </p>

        </div>


        {{-- VISI --}}
        <div class="vm-vision-card">

            <div class="vm-vision-title">

                <div class="vm-cross">
                     <img src="{{ asset('images/logo.png') }}"
                    alt="logo"
                    style="width: 100%; height: auto; display: block;">
                </div>

                <h3>
                    VISI
                </h3>

            </div>

            <div class="vm-vision-divider"></div>

            <p>
                Melaksanakan pekabaran Injil sesuai amanat agung
                Tuhan Yesus Kristus (Mat 28:19-20), demi terwujudnya
                pembangunan <strong>Tubuh Kristus.</strong>
            </p>

        </div>

        {{-- ============================================================
     MISI
============================================================ --}}

<div class="vm-mission-heading">

    <div class="vm-heading-line"></div>

    <h3>
        MISI
    </h3>

    <div class="vm-heading-line"></div>

    <p>
        LANGKAH BERSAMA UNTUK TUJUAN MULIA
    </p>

</div>


<div class="vm-mission-grid">

    {{-- MISI 01 --}}
    <article class="vm-mission-card vm-blue">

        <span class="vm-number">
            01
                </span>

                <div class="vm-icon">
                    <img src="{{ asset('images/persekutuan.png') }}"
                    alt="persekutuan"
                    style="width: 100%; height: auto; display: block;">
                </div>

                <h4>
                    Persekutuan
                </h4>

                <p>
                    Membawa semua orang beriman untuk bersekutu menjadi
                    gereja (Tubuh Kristus) yang berpolakan keimamatan
                    yang Rajani, sebagaimana semua orang percaya adalah
                    imam/pelayan.
                </p>

                <small>
                    1 Petrus 2:9; Wahyu 5:9-10; Wahyu 11:15-17
                </small>

            </article>


            {{-- MISI 02 --}}
            <article class="vm-mission-card vm-red">

                <span class="vm-number">
                    02
                </span>

                <div class="vm-icon">
                     <img src="{{ asset('images/pembangunan.png') }}"
                    alt="pembangunan"
                    style="width: 100%; height: auto; display: block;">
                </div>

                <h4>
                    Pembangunan Jemaat
                </h4>

                <p>
                    Pembangunan jemaat ber-Tubuh Kristus melalui pelayanan
                    lima jawatan Roh yang dilaksanakan oleh para rasul,
                    para nabi, para pemberita Injil, para gembala dan
                    para pengajar.
                </p>

            </article>


            {{-- MISI 03 --}}
            <article class="vm-mission-card vm-yellow">

                <span class="vm-number">
                    03
                </span>

                <div class="vm-icon">
                      <img src="{{ asset('images/kepemimpinan.png') }}"
                    alt="persekutuan"
                    style="width: 100%; height: auto; display: block;">
                </div>

                <h4>
                    Kepemimpinan
                </h4>

                <p>
                    Untuk mencapai kepemimpinan yang militan dan Alkitabiah.
                    Dengan pola kepemimpinan yang dilakukan secara
                    kepemimpinan majemuk melalui sistem kepenatuaan.
                </p>

            </article>


            {{-- MISI 04 --}}
            <article class="vm-mission-card vm-blue">

                <span class="vm-number">
                    04
                </span>

                <div class="vm-icon">
                    <img src="{{ asset('images/pilar.png') }}"
                    alt="pilar"
                    style="width: 100%; height: auto; display: block;">
                </div>

                <h4>
                    Empat Pilar
                </h4>

                <p>
                    Memasuki kenyataan dalam pembangunan Tubuh Kristus
                    dengan empat pilar sebagai prinsip yaitu:
                </p>

                <ol>
                    <li>Ibadah bersama.</li>
                    <li>Pelayanan bersama.</li>
                    <li>Kepemimpinan bersama.</li>
                    <li>Kehidupan bersama.</li>
                </ol>

            </article>

        </div>

       {{-- ============================================================
     EMPAT PILAR
============================================================ --}}

<div class="vm-pillars">

    {{-- JUDUL --}}
    <div class="vm-pillars-title">

        <h3>
            Empat Pilar
        </h3>

        <p>
            HIDUP BERSAMA, BERTUMBUH BERSAMA,<br>
            MENJADI BERKAT BERSAMA
        </p>

    </div>


    {{-- PILAR 1 --}}
    <div class="vm-pillar">

        <div class="vm-icon">
            <img src="{{ asset('images/bersama.png') }}"
                 alt="Ibadah Bersama">
        </div>

        <span>
            Ibadah<br>
            Bersama
        </span>

    </div>


    {{-- PILAR 2 --}}
    <div class="vm-pillar">

        <div class="vm-icon vm-red">
            <img src="{{ asset('images/pelayanan.png') }}"
                 alt="Pelayanan Bersama">
        </div>

        <span>
            Pelayanan<br>
            Bersama
        </span>

    </div>


    {{-- PILAR 3 --}}
    <div class="vm-pillar">

        <div class="vm-icon vm-yellow">
            <img src="{{ asset('images/kppp.png') }}"
                 alt="Kepemimpinan Bersama">
        </div>

        <span>
            Kepemimpinan<br>
            Bersama
        </span>

    </div>


    {{-- PILAR 4 --}}
    <div class="vm-pillar">

        <div class="vm-icon">
            <img src="{{ asset('images/kb.png') }}"
                 alt="Kehidupan Bersama">
        </div>

        <span>
            Kehidupan<br>
            Bersama
        </span>

    </div>

</div>

    </div>

</section>

{{-- ============================================================
     WARTA JEMAAT
============================================================ --}}
<section id="warta"
           style="
            background-image: url('{{ asset('images/background-warta.png') }}');
            background-repeat: no-repeat;
            background-position: center top;
            background-size: cover;
            min-height: 850px;
            padding: 80px 0 140px;
         ">

    <div style="
        max-width: 1400px;
        margin: 0 auto;
    ">

        {{-- JUDUL --}}
        <div style="
            text-align: center;
            margin-bottom: 50px;
        ">

            <p style="
                color: #2563eb;
                font-size: .9rem;
                font-weight: 700;
                letter-spacing: .18em;
                margin-bottom: .5rem;
            ">
                INFORMASI GEREJA
            </p>

            <h2 style="
                color: #111827;
                font-size: clamp(2rem, 4vw, 3rem);
                font-weight: 800;
                margin: 0;
            ">
                Warta Jemaat
            </h2>

            <p style="
                color: #6b7280;
                font-size: 1rem;
                margin-top: .8rem;
            ">
                Informasi dan kabar terbaru GPI Jalan Suci Jakpus
            </p>

        </div>


        {{-- CARD WARTA --}}
       <div class="warta-carousel">

        <button type="button"
                class="warta-arrow warta-prev"
                onclick="wartaPrev()">
            &#10094;
        </button>

        <div class="warta-track">

        {{-- CARD 4 — JADWAL IBADAH --}}
        <a href="{{ route('worship-schedules') }}"
        style="
                display: flex;
                flex-direction: column;
                background: #fff;
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 8px 25px rgba(0,0,0,.08);
                text-decoration: none;
                transition: transform .2s, box-shadow .2s;
        ">

            {{-- FOTO / HEADER --}}
            <div style="
                height: 220px;
                background: #e5e7eb;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            ">

                @if ($worshipSchedules->first()?->photo)

                    <img
                        src="{{ asset('storage/' . $worshipSchedules->first()->photo) }}"
                        alt="{{ $worshipSchedules->first()->name }}"
                        style="
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                        "
                    >

                @else

                    <div style="
                        text-align: center;
                        color: #9ca3af;
                    ">
                        <div style="font-size: 3rem;">
                            ⛪
                        </div>

                        <p style="
                            margin-top: 8px;
                            font-size: .85rem;
                        ">
                            Jadwal Ibadah
                        </p>
                    </div>

                @endif

            </div>


            {{-- ISI CARD --}}
            <div style="
                padding: 24px;
                display: flex;
                flex-direction: column;
                flex: 1;
            ">

                <p style="
                    color: #2563eb;
                    font-size: .75rem;
                    font-weight: 700;
                    letter-spacing: .08em;
                    margin: 0 0 8px;
                ">
                    ⛪ IBADAH GEREJA
                </p>


                <h3 style="
                    color: #111827;
                    font-size: 1.2rem;
                    font-weight: 700;
                    margin: 0;
                ">
                    Jadwal Ibadah
                </h3>


                {{-- DAFTAR JADWAL --}}
                <div style="
                    margin-top: 18px;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                ">

                    @forelse ($worshipSchedules->take(3) as $schedule)

                        <div style="
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            padding: 10px 12px;
                            background: #f8fafc;
                            border-radius: 10px;
                        ">

                            <div>

                                <p style="
                                    color: #111827;
                                    font-size: .9rem;
                                    font-weight: 600;
                                    margin: 0;
                                ">
                                    {{ $schedule->name }}
                                </p>

                                <p style="
                                    color: #9ca3af;
                                    font-size: .75rem;
                                    margin: 3px 0 0;
                                ">
                                    {{ $schedule->day }}
                                </p>

                            </div>


                            <span style="
                                color: #2563eb;
                                font-size: .8rem;
                                font-weight: 600;
                            ">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                @if ($schedule->end_time)
                                    - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                @endif
                            </span>

                        </div>

                    @empty

                        <p style="
                            color: #9ca3af;
                            font-size: .85rem;
                            margin: 5px 0;
                        ">
                            Belum ada jadwal ibadah.
                        </p>

                    @endforelse

                </div>


                {{-- LINK --}}
                <div style="
                    margin-top: auto;
                    padding-top: 18px;
                    color: #2563eb;
                    font-size: .9rem;
                    font-weight: 700;
                ">
                    Lihat Jadwal Ibadah →
                </div>

            </div>

        </a>

        {{-- CARD 1 — ULANG TAHUN JEMAAT --}}
        <a href="{{ url('/ulang-tahun') }}"
        style="
                display:flex; 
                flex-direction:column;
                background: #fff;
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 8px 25px rgba(0,0,0,.08);
                text-decoration: none;
                transition: transform .2s, box-shadow .2s;
        ">

            {{-- FOTO UTAMA --}}
            <div style="
                height: 220px;
                background: #e5e7eb;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            ">
                <img src="{{ asset('images/cardultah.png') }}"
                    alt="Ulang Tahun Jemaat"
                    style="
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                    ">
            </div>

            {{-- ISI CARD --}}
            <div style="padding: 24px;display:flex; flex-direction:column; flex:1;">

                <p style="
                    color: #2563eb;
                    font-size: .75rem;
                    font-weight: 700;
                    letter-spacing: .08em;
                    margin: 0 0 8px;
                ">
                    🎂 JEMAAT
                </p>

                <h3 style="
                    color: #111827;
                    font-size: 1.2rem;
                    font-weight: 700;
                    margin: 0;
                ">
                    Ulang Tahun Jemaat
                </h3>

                <p style="
                    color: #6b7280;
                    font-size: .85rem;
                    margin-top: 8px;
                ">
                    Ulang tahun jemaat bulan
                    {{ now()->translatedFormat('F') }}
                </p>

                {{-- DAFTAR ULANG TAHUN BULAN INI --}}
                <div style="
                    margin-top: 18px;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                ">

                    @forelse ($birthdays->take(3) as $jemaat)

                        <div style="
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            padding: 10px 12px;
                            background: #f8fafc;
                            border-radius: 10px;
                        ">

                            <span style="
                                color: #111827;
                                font-size: .9rem;
                                font-weight: 600;
                            ">
                                {{ $jemaat->name }}
                            </span>

                            <span style="
                                color: #6b7280;
                                font-size: .8rem;
                            ">
                                {{ $jemaat->birth_date->format('d') }}
                                {{ $jemaat->birth_date->translatedFormat('F') }}
                            </span>

                        </div>

                    @empty

                        <p style="
                            color: #9ca3af;
                            font-size: .85rem;
                            margin: 5px 0;
                        ">
                            Belum ada ulang tahun bulan ini.
                        </p>

                    @endforelse

                </div>

                {{-- LINK --}}
                <div style="
                    margin-top:auto;
                    color: #2563eb;
                    font-size: .9rem;
                    font-weight: 700;
                ">
                    Lihat Semua Ulang Tahun →
                </div>

            </div>

        </a>


            {{-- CARD 2 — BERITA SEPEKAN --}}
            <a href="{{ url('/berita') }}"
            style="
                    display:flex; 
                    flex-direction:column;
                    background: #fff;
                    border-radius: 18px;
                    overflow: hidden;
                    box-shadow: 0 8px 25px rgba(0,0,0,.08);
                    text-decoration: none;
                    transition: transform .2s, box-shadow .2s;
            ">

                {{-- FOTO UTAMA --}}
                <div style="
                    height: 220px;
                    background: #e5e7eb;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                ">

                    @if ($weeklyNews->first()?->photo)

                        <img src="{{ asset('storage/' . $weeklyNews->first()->photo) }}"
                            alt="{{ $weeklyNews->first()->title }}"
                            style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                            ">

                    @else

                        <span style="
                            color: #9ca3af;
                            font-size: .95rem;
                        ">
                            Foto Berita
                        </span>

                    @endif

                </div>


                {{-- ISI CARD --}}
                <div style="padding: 24px;display:flex; flex-direction:column; flex:1">

                    <p style="
                        color: #2563eb;
                        font-size: .75rem;
                        font-weight: 700;
                        letter-spacing: .08em;
                        margin: 0 0 8px;
                    ">
                        📰 WARTA JEMAAT
                    </p>

                    <h3 style="
                        color: #111827;
                        font-size: 1.2rem;
                        font-weight: 700;
                        margin: 0;
                    ">
                        Berita Sepekan
                    </h3>


                    @if ($weeklyNews->first())

                        {{-- BERITA TERBARU --}}
                        <div style="margin-top: 16px;">

                            <p style="
                                color: #2563eb;
                                font-size: .75rem;
                                font-weight: 700;
                                text-transform: uppercase;
                                letter-spacing: .05em;
                                margin: 0;
                            ">
                                {{ $weeklyNews->first()->category }}
                            </p>

                            <h4 style="
                                color: #111827;
                                font-size: 1rem;
                                font-weight: 700;
                                line-height: 1.4;
                                margin: 6px 0 0;
                            ">
                                {{ $weeklyNews->first()->title }}
                            </h4>

                            <p style="
                                color: #9ca3af;
                                font-size: .8rem;
                                margin-top: 6px;
                            ">
                                {{ $weeklyNews->first()->published_at->translatedFormat('d F Y') }}
                            </p>

                            <p style="
                                color: #6b7280;
                                font-size: .85rem;
                                line-height: 1.6;
                                margin-top: 10px;
                            ">
                                {{ \Illuminate\Support\Str::limit(strip_tags($weeklyNews->first()->content), 100) }}
                            </p>

                        </div>

                    @else

                        <p style="
                            color: #9ca3af;
                            font-size: .85rem;
                            margin-top: 16px;
                        ">
                            Belum ada berita dalam sepekan ini.
                        </p>

                    @endif


                    {{-- LINK --}}
                    <div style="
                        margin-top:auto;
                        color: #2563eb;
                        font-size: .9rem;
                        font-weight: 700;
                    ">
                        Lihat Semua Berita →
                    </div>

                </div>

            </a>


            {{-- CARD 3 — KEGIATAN MENDATANG --}}
            <a href="{{ url('/event') }}"
            style="
                    display: flex;
                    flex-direction: column;
                    background: #fff;
                    border-radius: 18px;
                    overflow: hidden;
                    box-shadow: 0 8px 25px rgba(0,0,0,.08);
                    text-decoration: none;
                    transition: transform .2s, box-shadow .2s;
            ">

                {{-- FOTO UTAMA --}}
                <div style="
                    height: 220px;
                    background: #e5e7eb;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                ">

                    @if ($upcomingEvents->first()?->photo)

                        <img src="{{ asset('storage/' . $upcomingEvents->first()->photo) }}"
                            alt="{{ $upcomingEvents->first()->name }}"
                            style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                            ">

                    @else

                        <img src="{{ asset('images/event-default.png') }}"
                            alt="Kegiatan Gereja"
                            style="
                                width: 100%;
                                height: 100%;
                                object-fit: contain;
                            ">

                    @endif

                </div>


                {{-- ISI CARD --}}
                <div style="
                    padding: 24px;
                    display: flex;
                    flex-direction: column;
                    flex: 1;
                ">

                    <p style="
                        color: #2563eb;
                        font-size: .75rem;
                        font-weight: 700;
                        letter-spacing: .08em;
                        margin: 0 0 8px;
                    ">
                        📅 KEGIATAN GEREJA
                    </p>


                    <h3 style="
                        color: #111827;
                        font-size: 1.2rem;
                        font-weight: 700;
                        margin: 0;
                    ">
                        Kegiatan Mendatang
                    </h3>


                    @if ($upcomingEvents->first())

                        <div style="margin-top: 16px;">

                            <h4 style="
                                color: #111827;
                                font-size: 1rem;
                                font-weight: 700;
                                line-height: 1.4;
                                margin: 0;
                            ">
                                {{ $upcomingEvents->first()->name }}
                            </h4>


                            <p style="
                                color: #2563eb;
                                font-size: .8rem;
                                font-weight: 600;
                                margin-top: 8px;
                            ">
                                {{ $upcomingEvents->first()->start_date->translatedFormat('d F Y') }}
                            </p>


                            @if ($upcomingEvents->first()->start_time)

                                <p style="
                                    color: #6b7280;
                                    font-size: .8rem;
                                    margin-top: 4px;
                                ">
                                    Pukul {{ \Carbon\Carbon::parse($upcomingEvents->first()->start_time)->format('H:i') }}
                                    WIB
                                </p>

                            @endif


                            @if ($upcomingEvents->first()->location)

                                <p style="
                                    color: #6b7280;
                                    font-size: .85rem;
                                    margin-top: 8px;
                                ">
                                    📍 {{ $upcomingEvents->first()->location }}
                                </p>

                            @endif


                            @if ($upcomingEvents->first()->description)

                                <p style="
                                    color: #6b7280;
                                    font-size: .85rem;
                                    line-height: 1.6;
                                    margin-top: 10px;
                                ">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($upcomingEvents->first()->description), 100) }}
                                </p>

                            @endif

                        </div>

                    @else

                        <p style="
                            color: #9ca3af;
                            font-size: .85rem;
                            margin-top: 16px;
                        ">
                            Belum ada kegiatan mendatang.
                        </p>

                    @endif


                    {{-- LINK --}}
                    <div style="
                        margin-top: auto;
                        color: #2563eb;
                        font-size: .9rem;
                        font-weight: 700;
                        padding-top: 18px;
                    ">
                        Lihat Semua Kegiatan →
                    </div>

                </div>

            </a>

        </div>

            <button type="button"
                    class="warta-arrow warta-next"
                    onclick="wartaNext()">
                &#10095;
            </button>

        </div>

    </div>

</section>

        {{-- ============================================================
     PENATALAYAN
============================================================ --}}
<section id="penatalayan"
         style="
            background: #ffffff;
            padding: 90px 2.5rem;
         ">

    <div style="
        max-width: 1250px;
        margin: 0 auto;
    ">

        {{-- HEADER --}}
        <div style="
            text-align: center;
            margin-bottom: 50px;
        ">

            <p style="
                color: #2563eb;
                font-size: .8rem;
                font-weight: 800;
                letter-spacing: .18em;
                margin: 0 0 10px;
            ">
                PENATALAYAN GEREJA 
            </p>

            <h2 style="
                color: #082d66;
                font-family: Georgia, serif;
                font-size: clamp(2rem, 4vw, 3.5rem);
                font-weight: 900;
                margin: 0;
            ">
                SETIAP KITA DIPANGGIL UNTUK MELAYANI TUHAN
            </h2>

            <p style="
                max-width: 650px;
                margin: 15px auto 0;
                color: #64748b;
                font-size: .95rem;
                line-height: 1.7;
            ">
                “Tetapi sekarang, setelah kamu dimerdekakan dari dosa dan setelah kamu menjadi hamba Allah, kamu beroleh buah yang membawa kamu kepada pengudusan dan sebagai kesudahannya ialah hidup yang kekal.”
<br> Roma 6:22
            </p>

                <a href="{{ url('/penatalayan') }}" style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    margin-top: 28px;
                    padding: 12px 24px;
                    border-radius: 999px;
                    background: orange;
                    color: #fff;
                    font-size: .8rem;
                    font-weight: 800;
                    letter-spacing: .08em;
                    text-decoration: none;
                    transition: .2s;
                ">
                    MEET THE TEAM →
                </a>

        </div>


        {{-- CARDS --}}

        </div>


        {{-- CARDS --}}
    <div class="penatalayan-grid" style="
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 24px;
    ">

           @forelse ($penatalayan->take(7) as $member)

                <div style="
                    background: #fff;
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0 10px 30px rgba(0,0,0,.08);
                    border: 1px solid #eef2f7;
                ">

                    {{-- FOTO --}}
                    <div style="
                        height: 280px;
                        background: #f8fafc;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        overflow: hidden;
                    ">

                        @if ($member->jemaat && $member->jemaat->photo)

                            <img
                                src="{{ asset('storage/' . $member->jemaat->photo) }}"
                                alt="{{ $member->jemaat->name }}"
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                                    display: block;
                                "
                            >

                        @else

                            <div style="
                                text-align: center;
                                color: #94a3b8;
                            ">
                                <div style="
                                    font-size: 3.5rem;
                                    margin-bottom: 8px;
                                ">
                                    👤
                                </div>

                                <span style="font-size: .85rem;">
                                    Belum ada foto
                                </span>
                            </div>

                        @endif

                    </div>


                    {{-- ISI CARD --}}
                    <div style="
                        padding: 22px;
                        text-align: center;
                    ">

                        <h3 style="
                            color: #111827;
                            font-size: 1.1rem;
                            font-weight: 800;
                            margin: 0;
                            line-height: 1.4;
                        ">
                            {{ $member->jemaat->name ?? '-' }}
                        </h3>

                        <p style="
                            color: #2563eb;
                            font-size: .8rem;
                            font-weight: 700;
                            margin: 8px 0 0;
                        ">
                            {{ $member->ministry->name ?? '-' }}
                        </p>

                        @if ($member->position)

                            <p style="
                                color: #64748b;
                                font-size: .85rem;
                                margin: 6px 0 0;
                            ">
                                {{ $member->position }}
                            </p>

                        @endif

                    </div>

                </div>

            @empty

                <div style="
                    grid-column: 1 / -1;
                    text-align: center;
                    padding: 50px 20px;
                    color: #94a3b8;
                ">
                    Belum ada penatalayan yang aktif.
                </div>

            @endforelse

        </div>

    </div>

</section>

        </section>


{{-- ============================================================
     JEMAAT RUMAH / JERUM
============================================================ --}}
<section id="jerum"
    style="
        background: #f8fafc;
        padding: 100px 2.5rem;
    ">

    <div style="
        max-width: 1250px;
        margin: 0 auto;
    ">

        <div class="jerum-content">

            {{-- =========================
                 BAGIAN TEKS
            ========================== --}}
            <div class="jerum-text">

                <p style="
                    color: #2563eb;
                    font-size: .8rem;
                    font-weight: 800;
                    letter-spacing: .18em;
                    margin: 0 0 12px;
                ">
                    JEMAAT RUMAH
                </p>

                <h2 style="
                    color: #082d66;
                    font-family: Georgia, serif;
                    font-size: clamp(2.2rem, 4vw, 3.5rem);
                    font-weight: 900;
                    line-height: 1.15;
                    margin: 0;
                ">
                    Bertumbuh Bersama
                    di Dalam Jerum 
                </h2>

                <p style="
                    color: #64748b;
                    font-size: 1rem;
                    line-height: 1.8;
                    margin-top: 24px;
                ">
                    Jemaat Rumah adalah ruang bagi setiap jemaat untuk
                    membangun hubungan, saling menguatkan, dan bertumbuh
                    bersama dalam iman di luar persekutuan ibadah di gereja.
                </p>

                <p style="
                    color: #64748b;
                    font-size: 1rem;
                    line-height: 1.8;
                    margin-top: 14px;
                ">
                    Di dalam Jemaat Rumah, kita belajar untuk tidak hanya
                    menjadi jemaat yang datang dan beribadah, tetapi juga
                    menjadi keluarga yang saling mengenal, memperhatikan,
                    mendoakan, dan bertumbuh bersama dalam kehidupan
                    sehari-hari.
                </p>

                <div style="
                    margin-top: 28px;
                ">
                    <a href="https://wa.me/6281289193033?text=Halo%20GPIJS%20Jakpus%2C%20saya%20ingin%20bertanya%20mengenai%20informasi%20jerum."
                    style="
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        padding: 13px 24px;
                        border-radius: 999px;
                        background: #2563eb;
                        color: #fff;
                        font-size: .85rem;
                        font-weight: 800;
                        text-decoration: none;
                        letter-spacing: .04em;
                        box-shadow: 0 8px 20px rgba(37, 99, 235, .22);
                        transition: all .2s ease;
                    ">
                        BERGABUNG JERUM →
                    </a>
                </div>

            </div>


            {{-- =========================
                 FOTO / VIDEO
            ========================== --}}
            <div class="jerum-media">

                <div style="
                    width: 100%;
                    aspect-ratio: 16 / 10;
                    border-radius: 24px;
                    overflow: hidden;
                    background: #e2e8f0;
                    box-shadow: 0 20px 45px rgba(0,0,0,.12);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">

                    @if ($jerumAlbum && $jerumAlbum->photos->count())

    <div class="jerum-carousel" style="
        position: relative;
        width: 100%;
        height: 100%;
    ">

        {{-- FOTO --}}
        <div id="jerumTrack" style="
            width: 100%;
            height: 100%;
            display: flex;
            overflow: hidden;
        ">

            @foreach ($jerumAlbum->photos as $index => $photo)
                <div class="jerum-slide" style="
                    min-width: 100%;
                    width: 100%;
                    height: 100%;
                    flex: 0 0 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <img
                        src="{{ asset('storage/' . $photo->photo) }}"
                        alt="Jemaat Rumah {{ $index + 1 }}"
                        style="
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                            display: block;
                        "
                    >
                </div>
            @endforeach

        </div>

                {{-- TOMBOL SEBELUMNYA --}}
                @if ($jerumAlbum->photos->count() > 1)
                    <button
                        type="button"
                        onclick="jerumPrev()"
                        style="
                            position: absolute;
                            left: 14px;
                            top: 50%;
                            transform: translateY(-50%);
                            width: 42px;
                            height: 42px;
                            border: none;
                            border-radius: 50%;
                            background: rgba(255,255,255,.92);
                            color: #082d66;
                            font-size: 22px;
                            font-weight: 800;
                            cursor: pointer;
                            box-shadow: 0 4px 12px rgba(0,0,0,.15);
                            z-index: 5;
                        "
                        aria-label="Foto sebelumnya"
                    >
                        ‹
                    </button>

                    {{-- TOMBOL BERIKUTNYA --}}
                    <button
                        type="button"
                        onclick="jerumNext()"
                        style="
                            position: absolute;
                            right: 14px;
                            top: 50%;
                            transform: translateY(-50%);
                            width: 42px;
                            height: 42px;
                            border: none;
                            border-radius: 50%;
                            background: rgba(255,255,255,.92);
                            color: #082d66;
                            font-size: 22px;
                            font-weight: 800;
                            cursor: pointer;
                            box-shadow: 0 4px 12px rgba(0,0,0,.15);
                            z-index: 5;
                        "
                        aria-label="Foto berikutnya"
                    >
                        ›
                    </button>

                    {{-- INDIKATOR --}}
                    <div id="jerumDots" style="
                        position: absolute;
                        bottom: 14px;
                        left: 50%;
                        transform: translateX(-50%);
                        display: flex;
                        gap: 7px;
                        z-index: 5;
                    "></div>
                @endif

            </div>

        @else

            <span style="
                color: #94a3b8;
                font-size: .9rem;
            ">
                Foto / Video Jemaat Rumah
            </span>

        @endif
                </div>

            </div>

        </div>

    </div>

</section>

{{-- ============================================================
     PEMUDA
============================================================ --}}
<section id="pemuda"
    style="
        background: #ffffff;
        padding: 100px 2.5rem;
    ">

    <div style="
        max-width: 1250px;
        margin: 0 auto;
    ">

        <div class="pemuda-content">

            {{-- =========================
                 FOTO / VIDEO
            ========================== --}}
            <div class="pemuda-media">

                <div style="
                    width: 100%;
                    aspect-ratio: 16 / 10;
                    border-radius: 24px;
                    overflow: hidden;
                    background: #e2e8f0;
                    box-shadow: 0 20px 45px rgba(0,0,0,.12);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">

                    @if ($pemudaAlbum && $pemudaAlbum->photos->count())

                    <div class="pemuda-carousel" style="
                        position: relative;
                        width: 100%;
                        height: 100%;
                    ">

                        {{-- FOTO --}}
                        <div id="pemudaTrack" style="
                            width: 100%;
                            height: 100%;
                            display: flex;
                            overflow: hidden;
                        ">

                            @foreach ($pemudaAlbum->photos as $index => $photo)
                                <div style="
                                    min-width: 100%;
                                    width: 100%;
                                    height: 100%;
                                    flex: 0 0 100%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">
                                    <img
                                        src="{{ asset('storage/' . $photo->photo) }}"
                                        alt="Pemuda {{ $index + 1 }}"
                                        style="
                                            width: 100%;
                                            height: 100%;
                                            object-fit: contain;
                                            display: block;
                                        "
                                    >
                                </div>
                            @endforeach

                        </div>

                        {{-- TOMBOL CAROUSEL --}}
                        @if ($pemudaAlbum->photos->count() > 1)

                            <button
                                type="button"
                                onclick="pemudaPrev()"
                                style="
                                    position: absolute;
                                    left: 14px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    width: 42px;
                                    height: 42px;
                                    border: none;
                                    border-radius: 50%;
                                    background: rgba(255,255,255,.92);
                                    color: #082d66;
                                    font-size: 22px;
                                    font-weight: 800;
                                    cursor: pointer;
                                    box-shadow: 0 4px 12px rgba(0,0,0,.15);
                                    z-index: 5;
                                "
                                aria-label="Foto sebelumnya"
                            >
                                ‹
                            </button>

                            <button
                                type="button"
                                onclick="pemudaNext()"
                                style="
                                    position: absolute;
                                    right: 14px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                    width: 42px;
                                    height: 42px;
                                    border: none;
                                    border-radius: 50%;
                                    background: rgba(255,255,255,.92);
                                    color: #082d66;
                                    font-size: 22px;
                                    font-weight: 800;
                                    cursor: pointer;
                                    box-shadow: 0 4px 12px rgba(0,0,0,.15);
                                    z-index: 5;
                                "
                                aria-label="Foto berikutnya"
                            >
                                ›
                            </button>

                            {{-- INDIKATOR --}}
                            <div id="pemudaDots" style="
                                position: absolute;
                                bottom: 14px;
                                left: 50%;
                                transform: translateX(-50%);
                                display: flex;
                                gap: 7px;
                                z-index: 5;
                            "></div>

                        @endif

                    </div>

                @else

                    <span style="
                        color: #94a3b8;
                        font-size: .9rem;
                    ">
                        Foto / Video Pemuda
                    </span>

                @endif

                </div>

            </div>


            {{-- =========================
                 BAGIAN TEKS
            ========================== --}}
            <div class="pemuda-text">

                <p style="
                    color: #2563eb;
                    font-size: .8rem;
                    font-weight: 800;
                    letter-spacing: .18em;
                    margin: 0 0 12px;
                ">
                    PEMUDA GEREJA
                </p>

                <h2 style="
                    color: #082d66;
                    font-family: Georgia, serif;
                    font-size: clamp(2.2rem, 4vw, 3.5rem);
                    font-weight: 900;
                    line-height: 1.15;
                    margin: 0;
                ">
                    Bertumbuh,
                    Berkarya,
                    dan Berdampak
                </h2>

                <p style="
                    color: #64748b;
                    font-size: 1rem;
                    line-height: 1.8;
                    margin-top: 24px;
                ">
                    Pemuda adalah bagian penting dari perjalanan gereja.
                    Bersama-sama kita belajar untuk bertumbuh dalam iman,
                    membangun persahabatan, dan menemukan panggilan Tuhan
                    dalam kehidupan kita.
                </p>

                <p style="
                    color: #64748b;
                    font-size: 1rem;
                    line-height: 1.8;
                    margin-top: 14px;
                ">
                    Melalui persekutuan, pelayanan, kreativitas, dan berbagai
                    kegiatan bersama, pemuda diajak untuk menjadi generasi
                    yang hidup dalam Kristus dan membawa dampak bagi
                    lingkungan sekitar.
                </p>

                {{-- BUTTON --}}
                <div style="
                    margin-top: 28px;
                ">
                    <a href="https://wa.me/6282198948311?text=Halo%20GPIJS%20Jakpus%2C%20saya%20ingin%20bertanya%20mengenai%20informasi%20pemuda."
                       style="
                           display: inline-flex;
                           align-items: center;
                           justify-content: center;
                           padding: 13px 24px;
                           border-radius: 999px;
                           background: #2563eb;
                           color: #fff;
                           font-size: .85rem;
                           font-weight: 800;
                           text-decoration: none;
                           letter-spacing: .04em;
                           box-shadow: 0 8px 20px rgba(37, 99, 235, .22);
                           transition: all .2s ease;
                       "
                        target="_blank"
                        rel="noopener noreferrer"
                        class="footer-social"
                    >
                        BERGABUNG PEMUDA →
                    </a>
                </div>

            </div>

        </div>

    </div>

</section>



@include('components.public.footer')

@endsection



<script>

    let pemudaIndex = 0;

    function pemudaShow(index) {
        const track = document.getElementById('pemudaTrack');
        const dots = document.getElementById('pemudaDots');

        if (!track) return;

        const total = track.children.length;

        if (total <= 1) return;

        pemudaIndex = (index + total) % total;

        track.scrollTo({
            left: track.clientWidth * pemudaIndex,
            behavior: 'smooth'
        });

        if (dots) {
            [...dots.children].forEach((dot, i) => {
                dot.style.opacity = i === pemudaIndex ? '1' : '.35';
            });
        }
    }

    function pemudaPrev() {
        pemudaShow(pemudaIndex - 1);
    }

    function pemudaNext() {
        pemudaShow(pemudaIndex + 1);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('pemudaTrack');
        const dots = document.getElementById('pemudaDots');

        if (!track || !dots) return;

        const total = track.children.length;

        for (let i = 0; i < total; i++) {
            const dot = document.createElement('span');

            dot.style.width = '8px';
            dot.style.height = '8px';
            dot.style.borderRadius = '50%';
            dot.style.background = '#fff';
            dot.style.opacity = i === 0 ? '1' : '.35';
            dot.style.cursor = 'pointer';

            dot.onclick = function () {
                pemudaShow(i);
            };

            dots.appendChild(dot);
        }
    });

let jerumIndex = 0;

    function jerumShow(index) {
        const track = document.getElementById('jerumTrack');
        const dots = document.getElementById('jerumDots');

        if (!track) return;

        const total = track.children.length;

        if (total <= 1) return;

        jerumIndex = (index + total) % total;

        track.scrollTo({
            left: track.clientWidth * jerumIndex,
            behavior: 'smooth'
        });

        if (dots) {
            [...dots.children].forEach((dot, i) => {
                dot.style.opacity = i === jerumIndex ? '1' : '.35';
            });
        }
    }

    function jerumPrev() {
        jerumShow(jerumIndex - 1);
    }

    function jerumNext() {
        jerumShow(jerumIndex + 1);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('jerumTrack');
        const dots = document.getElementById('jerumDots');

        if (!track || !dots) return;

        const total = track.children.length;

        for (let i = 0; i < total; i++) {
            const dot = document.createElement('span');

            dot.style.width = '8px';
            dot.style.height = '8px';
            dot.style.borderRadius = '50%';
            dot.style.background = '#fff';
            dot.style.opacity = i === 0 ? '1' : '.35';
            dot.style.cursor = 'pointer';

            dot.onclick = function () {
                jerumShow(i);
            };

            dots.appendChild(dot);
        }
    });

document.addEventListener('DOMContentLoaded', function () {

    const track = document.querySelector('.warta-track');
    const cards = document.querySelectorAll('.warta-track > *');

    let currentIndex = 0;


    if (!track || !cards.length) {
        return;
    }


    function showWarta(index) {

        if (index < 0) {
            index = cards.length - 1;
        }

        if (index >= cards.length) {
            index = 0;
        }

        currentIndex = index;

        const cardWidth = track.clientWidth;

        track.scrollTo({
            left: cardWidth * currentIndex,
            behavior: 'smooth'
        });
    }


    window.wartaPrev = function () {
        showWarta(currentIndex - 1);
    };


    window.wartaNext = function () {
        showWarta(currentIndex + 1);
    };

});


    document.addEventListener('DOMContentLoaded', function () {

    const dove = document.querySelector('.hero-dove');

    if (!dove) {
        console.log('MERPATI TIDAK DITEMUKAN');
        return;
    }

    console.log('MERPATI TERDETEKSI');

    let lastScroll = window.scrollY;

    window.addEventListener('scroll', function () {

        const currentScroll = window.scrollY;

        if (currentScroll > lastScroll) {

            // scroll turun
            dove.style.transform =
                'translateY(-15px) rotate(4deg) scale(1.04)';

        } else if (currentScroll < lastScroll) {

            // scroll naik
            dove.style.transform =
                'translateY(15px) rotate(-4deg) scale(0.96)';

        }

        lastScroll = currentScroll;

    });

});

</script>