{{-- ============================================================
     FOOTER
============================================================ --}}

<footer id="contact" class="site-footer">

    <div class="footer-container">

        {{-- IDENTITAS GEREJA --}}
        <div class="footer-column">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="GPIJS Jakpus"
                class="footer-logo"
            >

            <p class="footer-description">
                Gereja Pekabaran Injil Jalan Suci Jemaat Jakarta Pusat.
            </p>
        </div>


        {{-- LOKASI --}}
        <div class="footer-column">
            <h3>Lokasi Gereja</h3>

            <p>
                GPIJS Jakarta Pusat
            </p>

            <a
                href="https://www.google.com/maps/search/?api=1&query=GPIJS+Jakarta+Pusat"
                target="_blank"
                rel="noopener noreferrer"
                class="footer-location-link"
            >
                Lihat di Google Maps →
            </a>
        </div>


        {{-- KONTAK & SOSIAL MEDIA --}}
        <div class="footer-column">
            <h3>Hubungi Kami</h3>

            <div class="footer-socials">

                <a
                    href="https://wa.me/6282198948311?text=Halo%20GPIJS%20Jakpus%2C%20saya%20ingin%20bertanya%20mengenai%20informasi%20gereja."
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-social"
                >
                    WhatsApp
                </a>

                <a
                    href="https://www.instagram.com/gpijs.jakpus?utm_source=ig_web_button_share_sheet&stkn=ZDNlZDc0MzIxNw=="
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-social"
                >
                    Instagram
                </a>

                <a
                    href="https://www.youtube.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="footer-social"
                >
                    YouTube
                </a>

            </div>
        </div>

    </div>


    {{-- COPYRIGHT --}}
    <div class="footer-bottom">
        <p>
            © {{ date('Y') }} GPIJS Jakarta Pusat. All rights reserved.
        </p>
    </div>

</footer>