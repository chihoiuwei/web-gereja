{{-- ============================================================
         NAVBAR (section terpisah)
    ============================================================ --}}
   <header class="site-header">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="site-logo">
            <img src="{{ asset('images/logo.png') }}"
                alt="GPIJS Jakpus">
        </a>

        {{-- MENU DESKTOP --}}
        <nav class="desktop-nav">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ url('/#about') }}" class="nav-link">About Us</a>
            <a href="{{ url('/#visi-misi') }}" class="nav-link">Visi & Misi</a>
            <a href="{{ url('/#warta') }}" class="nav-link">Warta Jemaat</a>
            <a href="{{ url('/#penatalayan') }}" class="nav-link">Penatalayan</a>
            <a href="{{ url('/#jerum') }}" class="nav-link">Jerum</a>
            <a href="{{ url('/#pemuda') }}" class="nav-link">Pemuda</a>
            <a href="{{ route('gallery') }}" class="nav-link">Galeri</a>
            <a href="{{ url('/#contact') }}" class="nav-link">Contact Us</a>
            <a href="{{ route('login') }}" class="nav-link">Login Admin</a>
        </nav>

        {{-- BURGER MOBILE --}}
       <button type="button"
                id="mobileMenuButton"
                class="mobile-menu-button"
                onclick="toggleMobileMenu()"
                aria-label="Buka menu">

            <span></span>
            <span></span>
            <span></span>

        </button>

    </header>


    {{-- MENU MOBILE --}}
    <div id="mobileMenu" class="mobile-menu">

        <a href="{{ url('/') }}">Home</a>
        <a href="#about">About Us</a>
        <a href="#visi-misi">Visi & Misi</a>
        <a href="#warta">Warta Jemaat</a>
        <a href="#penatalayan">Penatalayan</a>
        <a href="#jerum">Jerum</a>
        <a href="#pemuda">Pemuda</a>
        <a href="{{ route('gallery') }}">Galeri</a>
        <a href="#contact">Contact Us</a>
        <a href="{{ route('login') }}">Login Admin</a>

    </div>

    <script>

function toggleMobileMenu() {

    const menu = document.getElementById('mobileMenu');
    const button = document.getElementById('mobileMenuButton');

    if (!menu || !button) {
        return;
    }

    menu.classList.toggle('active');
    button.classList.toggle('active');

    const isOpen = menu.classList.contains('active');

    button.setAttribute(
        'aria-label',
        isOpen ? 'Tutup menu' : 'Buka menu'
    );

}

</script>
