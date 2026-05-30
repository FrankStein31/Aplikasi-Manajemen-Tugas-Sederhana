<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="M-Tugas - Aplikasi Manajemen Tugas">
    <title>M-Tugas | Beranda</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .navbar-brand { font-weight: 800; font-size: 1.4rem; color: #2d3748 !important; }
        .navbar { box-shadow: 0 2px 15px rgba(0,0,0,.07); }
        .btn-login-nav { background: #1cc88a; color: #fff !important; border-radius: 25px; padding: 8px 28px; font-weight: 700; }
        .btn-login-nav:hover { background: #17a673; }
        .hero-section { min-height: 90vh; display: flex; align-items: center; background: #fff; }
        .hero-title { font-size: 3.5rem; font-weight: 800; color: #2d3748; }
        .hero-subtitle { color: #718096; font-size: 1.2rem; }
        .btn-hero { background: #1cc88a; color: #fff; border-radius: 30px; padding: 14px 40px; font-weight: 700; font-size: 1.1rem; border: none; }
        .btn-hero:hover { background: #17a673; color: #fff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(28,200,138,.3); transition: all .3s; }
        .hero-img-wrap { background: linear-gradient(135deg, #e8f5fe 0%, #f0fdf9 100%); border-radius: 20px; padding: 30px; text-align: center; }
        .hero-img-wrap img { max-width: 100%; }
        .section-title { font-size: 2.5rem; font-weight: 800; color: #2d3748; }
        .section-watermark { font-size: 5rem; font-weight: 900; color: rgba(0,0,0,.04); position: absolute; top: 10px; left: 50%; transform: translateX(-50%); white-space: nowrap; z-index: 0; }
        .about-section { background: #f8f9fa; padding: 100px 0; position: relative; overflow: hidden; }
        .about-feature { display: flex; align-items: flex-start; margin-bottom: 16px; }
        .about-feature i { color: #1cc88a; margin-right: 12px; margin-top: 3px; }
        .contact-section { padding: 80px 0; }
        .contact-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 30px rgba(0,0,0,.08); padding: 40px; }
        .contact-item { display: flex; align-items: flex-start; margin-bottom: 28px; }
        .contact-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 18px; flex-shrink: 0; }
        .contact-icon.green { background: rgba(28,200,138,.12); color: #1cc88a; }
        .map-embed { border-radius: 12px; overflow: hidden; margin-top: 24px; }
        .scroll-top { position: fixed; bottom: 30px; right: 30px; width: 44px; height: 44px; background: #1cc88a; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 15px rgba(28,200,138,.4); z-index: 999; text-decoration: none; }
        .scroll-top:hover { background: #17a673; color: #fff; }
        .nav-link-custom { color: #4a5568 !important; font-weight: 600; padding: 8px 16px !important; }
        .nav-link-custom:hover { color: #1cc88a !important; }
        .nav-link-custom.active { color: #1cc88a !important; }
        footer { background: #2d3748; color: #a0aec0; padding: 30px 0; text-align: center; }
    </style>
</head>
<body id="page-top">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">M-Tugas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item"><a class="nav-link nav-link-custom active" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#tentang">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#kontak">Kontak</a></li>
                <li class="nav-item ml-2">
                    @if(session('user_id'))
                        @if(session('jabatan') === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-login-nav">Dashboard</a>
                        @else
                            <a href="{{ route('karyawan.dashboard') }}" class="btn btn-login-nav">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login-nav">Login</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero / Beranda -->
<section class="hero-section" id="beranda">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="hero-title mb-3">M-Tugas</h1>
                <p class="hero-subtitle mb-4">Aplikasi Manajemen Tugas</p>
                @if(session('user_id'))
                    @if(session('jabatan') === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-hero">Dashboard</a>
                    @else
                        <a href="{{ route('karyawan.dashboard') }}" class="btn btn-hero">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-hero">Login</a>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="hero-img-wrap">
                    <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg" style="max-width:100%">
                        <!-- Simplified isometric workspace illustration -->
                        <rect x="100" y="150" width="300" height="180" rx="16" fill="#4e73df" opacity=".15"/>
                        <rect x="120" y="130" width="260" height="160" rx="12" fill="#fff" stroke="#e2e8f0" stroke-width="2"/>
                        <rect x="140" y="150" width="220" height="12" rx="6" fill="#4e73df" opacity=".3"/>
                        <rect x="140" y="172" width="180" height="10" rx="5" fill="#1cc88a" opacity=".4"/>
                        <rect x="140" y="192" width="200" height="10" rx="5" fill="#e2e8f0"/>
                        <rect x="140" y="212" width="160" height="10" rx="5" fill="#e2e8f0"/>
                        <rect x="140" y="232" width="190" height="10" rx="5" fill="#e2e8f0"/>
                        <!-- Floating card 1 -->
                        <rect x="60" y="80" width="110" height="70" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
                        <circle cx="85" cy="103" r="14" fill="#4e73df" opacity=".2"/>
                        <rect x="105" y="97" width="50" height="8" rx="4" fill="#4e73df" opacity=".3"/>
                        <rect x="105" y="112" width="40" height="7" rx="3.5" fill="#e2e8f0"/>
                        <rect x="70" y="127" width="90" height="7" rx="3.5" fill="#1cc88a" opacity=".4"/>
                        <!-- Floating card 2 -->
                        <rect x="330" y="70" width="110" height="70" rx="10" fill="#fff" stroke="#e2e8f0" stroke-width="1.5"/>
                        <circle cx="355" cy="93" r="14" fill="#1cc88a" opacity=".2"/>
                        <rect x="375" y="87" width="50" height="8" rx="4" fill="#1cc88a" opacity=".4"/>
                        <rect x="375" y="102" width="40" height="7" rx="3.5" fill="#e2e8f0"/>
                        <rect x="340" y="118" width="90" height="7" rx="3.5" fill="#4e73df" opacity=".3"/>
                        <!-- Checkmarks -->
                        <circle cx="250" cy="340" r="30" fill="#1cc88a" opacity=".15"/>
                        <text x="250" y="348" text-anchor="middle" font-size="22" fill="#1cc88a">✓</text>
                        <circle cx="170" cy="360" r="20" fill="#4e73df" opacity=".15"/>
                        <text x="170" y="368" text-anchor="middle" font-size="16" fill="#4e73df">✓</text>
                        <circle cx="330" cy="355" r="22" fill="#f6c23e" opacity=".2"/>
                        <text x="330" y="363" text-anchor="middle" font-size="17" fill="#f6c23e">⏰</text>
                        <!-- People icons -->
                        <circle cx="200" cy="200" r="18" fill="#4e73df" opacity=".2"/>
                        <circle cx="300" cy="200" r="18" fill="#1cc88a" opacity=".2"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<section class="about-section" id="tentang">
    <div class="container" style="position:relative; z-index:1;">
        <div class="text-center mb-5">
            <span class="section-watermark">TENTANG KAMI</span>
            <h2 class="section-title" style="position:relative; z-index:1;">TENTANG KAMI</h2>
            <p class="text-muted mt-3 mx-auto" style="max-width:700px;">
                M-Tugas adalah platform manajemen tugas berbasis web yang dirancang untuk memudahkan koordinasi pekerjaan antara admin dan karyawan secara efisien, terstruktur, dan transparan.
            </p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                <svg viewBox="0 0 400 320" xmlns="http://www.w3.org/2000/svg" style="max-width:90%">
                    <ellipse cx="200" cy="290" rx="160" ry="20" fill="#1cc88a" opacity=".1"/>
                    <!-- Group of people -->
                    <circle cx="120" cy="140" r="36" fill="#4e73df" opacity=".2"/>
                    <circle cx="200" cy="120" r="40" fill="#1cc88a" opacity=".2"/>
                    <circle cx="280" cy="140" r="36" fill="#f6c23e" opacity=".2"/>
                    <circle cx="120" cy="140" r="22" fill="#4e73df" opacity=".5"/>
                    <circle cx="200" cy="120" r="25" fill="#1cc88a" opacity=".5"/>
                    <circle cx="280" cy="140" r="22" fill="#f6c23e" opacity=".5"/>
                    <!-- Bodies -->
                    <rect x="88" y="170" width="64" height="80" rx="20" fill="#4e73df" opacity=".3"/>
                    <rect x="168" y="153" width="64" height="90" rx="20" fill="#1cc88a" opacity=".3"/>
                    <rect x="248" y="170" width="64" height="80" rx="20" fill="#f6c23e" opacity=".3"/>
                    <!-- Hands raised -->
                    <line x1="120" y1="195" x2="90" y2="170" stroke="#4e73df" stroke-width="6" stroke-linecap="round" opacity=".5"/>
                    <line x1="200" y1="175" x2="175" y2="145" stroke="#1cc88a" stroke-width="6" stroke-linecap="round" opacity=".5"/>
                </svg>
            </div>
            <div class="col-lg-7">
                <h3 class="font-weight-bold mb-3" style="color:#2d3748; font-size:1.8rem;">
                    Solusi Cerdas untuk Manajemen Tugas Tim Anda
                </h3>
                <p class="text-muted mb-4">
                    M-Tugas hadir sebagai solusi digital yang membantu perusahaan Anda dalam mendistribusikan, memantau, dan mengelola tugas karyawan dengan lebih mudah dan transparan.
                </p>
                <div class="about-feature">
                    <i class="fas fa-check-circle fa-lg mt-1"></i>
                    <div><strong>Manajemen Tugas Mudah</strong> — Distribusikan tugas kepada karyawan dengan mudah dan pantau progresnya secara real-time.</div>
                </div>
                <div class="about-feature">
                    <i class="fas fa-check-circle fa-lg mt-1"></i>
                    <div><strong>Kontrol Akses Berlapis</strong> — Sistem hak akses terpisah antara Admin dan Karyawan untuk keamanan data yang lebih baik.</div>
                </div>
                <div class="about-feature">
                    <i class="fas fa-check-circle fa-lg mt-1"></i>
                    <div><strong>Laporan Instan</strong> — Ekspor data tugas dan pengguna ke format PDF maupun Excel kapan saja.</div>
                </div>
                <div class="about-feature">
                    <i class="fas fa-check-circle fa-lg mt-1"></i>
                    <div><strong>Antarmuka Intuitif</strong> — Desain modern yang mudah digunakan oleh semua kalangan pengguna.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kontak -->
<section class="contact-section" id="kontak">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Kontak</h2>
            <p class="text-muted">Hubungi kami untuk informasi lebih lanjut.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-card">
                    <div class="contact-item">
                        <div class="contact-icon green">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-1">Alamat :</h6>
                            <p class="text-muted mb-0">Jl. Teknologi No. 42, Kota Digital, Indonesia 12345</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon green">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-1">WhatsApp</h6>
                            <p class="text-muted mb-0">+62 812-3456-7890</p>
                        </div>
                    </div>
                    <div class="contact-item mb-0">
                        <div class="contact-icon green">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-1">Email</h6>
                            <p class="text-muted mb-0">info@mtugas.com</p>
                        </div>
                    </div>
                    <div class="map-embed">
                        <iframe
                            src="https://maps.google.com/maps?q=Jakarta+Pusat&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p class="mb-0">&copy; {{ date('Y') }} M-Tugas — Aplikasi Manajemen Tugas. All rights reserved.</p>
</footer>

<!-- Scroll to Top -->
<a href="#page-top" class="scroll-top">
    <i class="fas fa-arrow-up"></i>
</a>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    // Smooth scroll & active nav
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Show/hide scroll top
    window.addEventListener('scroll', function() {
        const btn = document.querySelector('.scroll-top');
        btn.style.display = window.scrollY > 300 ? 'flex' : 'none';
    });
    document.querySelector('.scroll-top').style.display = 'none';

    // Active nav link on scroll
    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            if (window.scrollY >= section.offsetTop - 80) current = section.getAttribute('id');
        });
        document.querySelectorAll('.nav-link-custom').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) link.classList.add('active');
        });
    });
</script>
</body>
</html>
