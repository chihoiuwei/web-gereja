
/* ============================================================
   PUBLIC CSS — dimuat melalui Vite
============================================================ */

// Navbar: dimuat untuk semua halaman public
import '../css/public/navbar.css';

// Components (footer): digunakan semua halaman public
import '../css/public/components.css';

// Halaman-halaman public (dimuat global, aman karena
// selector tidak bentrok antar halaman)
import '../css/public/home.css';
import '../css/public/news.css';
import '../css/public/events.css';
import '../css/public/birthdays.css';
import '../css/public/penatalayan.css';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
