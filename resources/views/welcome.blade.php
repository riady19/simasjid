<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Baitul Amal - Sistem Informasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0b0c0bff;
            --bg-card: #0f172a;
            --primary: #38bdf8;
            --accent: #f3c33dff;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --success: #10b981;
            --danger: #ef4444;
            --glass: rgba(15, 23, 42, 0.8);
            --glass-border: rgba(255, 255, 255, 0.1);
            
            --nav-height: 12vh; /* Increased for spacing */
            --marquee-height: 6vh;
            --main-height: calc(100vh - var(--nav-height) - var(--marquee-height));
            --gap: 2vh;
            --padding: 2vh;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        /* Background Ornaments */
        .bg-ornament {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 40vw;
            background-image: url('{{ asset('images/mosque_ornament.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.20;
            z-index: -1;
            pointer-events: none;
        }

        .bg-ornament-left {
            left: -5vw;
            background-position: left center;
        }

        .bg-ornament-right {
            right: -5vw;
            background-position: right center;
            transform: scaleX(-1); /* Flip for symmetry */
        }

        /* Navbar */
        nav {
            background: rgba(6, 92, 40, 0.85); /* Dark Green (Emerald 900) with glass effect */
            backdrop-filter: blur(16px);
            height: var(--nav-height);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            margin: 0.5vh 0vw 0;
            border-radius: 0px;
            border: 1px solid var(--glass-border);
            padding: 0 5%;
        }

        .nav-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left {
            display: flex;
            flex-direction: column;
        }

        .nav-right {
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 0vh;
            margin-top: 0.5vh;
        }

        #clock {
            font-family: 'Outfit', sans-serif;
            font-size: 5.5vh;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.4);
        }

        #date {
            font-size: 2.8vh;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        nav h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 5.5vh; /* Increased from 3.2vh */
            font-weight: 800;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.4);
            line-height: 1;
        }

        nav p {
            font-size: 2.6vh;
            color: var(--text-muted);
            font-weight: 500;
            letter-spacing: 1px;
            margin-top: 0.5vh;
        }

        /* Zakat Specific Styles */
        .zakat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2vh;
            flex: 1;
        }

        .zakat-card-inner {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2vh;
            border: 1px solid var(--glass-border);
        }

        .zakat-title {
            color: var(--accent);
            font-size: 2.6vh;
            font-weight: 700;
            margin-bottom: 1.5vh;
            display: flex;
            align-items: center;
            gap: 1vh;
        }

        .zakat-content {
            font-size: 2.2vh;
            line-height: 1.6;
            color: var(--text-main);
        }

        .zakat-content ul {
            list-style: none;
            padding-left: 0;
        }

        .zakat-content li {
            margin-bottom: 1vh;
            display: flex;
            gap: 1vh;
        }

        .zakat-content li::before {
            content: "•";
            color: var(--primary);
            font-weight: bold;
        }

        .procedure-step {
            display: flex;
            gap: 2vh;
            margin-bottom: 2vh;
            align-items: flex-start;
        }

        .step-number {
            background: var(--primary);
            color: #000;
            width: 5vh;
            height: 5vh;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 2.4vh;
            flex-shrink: 0;
        }

        .step-text {
            font-size: 2.2vh;
            font-weight: 500;
        }
        /* Main Carousel */
        .page-carousel {
            flex: 1;
            display: flex;
            transition: transform 1s cubic-bezier(0.65, 0, 0.35, 1);
            width: 400%;
            height: var(--main-height);
        }

        .page {
            width: 25%;
            height: 100%;
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: var(--gap);
            padding: var(--padding) 3.5%;
            align-items: stretch;
        }

        /* Common Card Styles */
        .card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 2vh;
            border: 1px solid var(--glass-border);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1vh;
            margin-bottom: 1.5vh;
            padding-bottom: 0.8vh;
            border-bottom: 1px solid var(--glass-border);
        }
        .card.prayer-card {
            background: rgba(28, 93, 7, 0.85); /* Black with glass effect */
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .card-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5vh;
            color: var(--accent);
            text-transform: uppercase;
        }

        .card-header svg {
            width: 2.8vh;
            height: 2.8vh;
            fill: var(--accent);
        }

        /* Slide 1: Image Slider */
        .slider-container {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            height: 100%;
            width: 100%;
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
        }

        .image-slider {
            display: flex;
            transition: transform 0.8s ease;
            height: 100%;
            width: 100%;
        }

        .image-slide {
            min-width: 100%;
            height: 100%;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: var(--bg-card);
        }

        .image-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 4vh;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.95));
        }

        .image-overlay h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 5.5vh;
            color: var(--primary);
            text-shadow: 2px 2px 15px rgba(0, 0, 0, 0.9);
            margin-bottom: 1vh;
        }

        .image-overlay p {
            font-size: 2.8vh;
            color: #ffffff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.9);
            font-weight: 500;
        }

        /* Slide 2: Financial Reports */
        .financial-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5vh;
            flex: 1;
        }

        .financial-item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2vh;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 20px;
            border-left: 5px solid var(--accent);
        }

        .financial-item.full-width {
            grid-column: span 2;
        }

        .financial-item.success { border-left-color: var(--success); background: rgba(16, 185, 129, 0.05); }
        .financial-item.danger { border-left-color: var(--danger); background: rgba(239, 68, 68, 0.05); }
        .financial-item.primary { border-left-color: var(--primary); background: rgba(56, 189, 248, 0.05); }

        .financial-label {
            font-size: 2.6vh;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 0.5vh;
        }

        .financial-value {
            font-family: 'Outfit', sans-serif;
            font-size: 3vh;
            font-weight: 800;
            color: var(--text-main);
        }

        .financial-item.success .financial-value { color: var(--success); }
        .financial-item.danger .financial-value { color: var(--danger); }
        .financial-item.primary .financial-value { color: var(--primary); }

        /* Prayer Times (Shared) */
        .prayer-grid {
            display: flex;
            flex-direction: column;
            gap: 0.8vh;
            flex: 1;
            justify-content: center;
        }

        .prayer-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2vh 2vh;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid transparent;
        }

        .prayer-item.active {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(56, 189, 248, 0.05));
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.1);
        }

        .prayer-name {
            font-weight: 600;
            font-size: 2vh;
        }

        .prayer-time {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8vh;
            font-weight: 800;
            color: var(--primary);
        }

        /* Marquee */
        .marquee-container {
            background: linear-gradient(100deg, var(--accent), #0b056aff);
            color: var(--bg-white);
            height: var(--marquee-height);
            display: flex;
            align-items: center;
            width: 100%;
            overflow: hidden;
            font-weight: 800;
            text-transform: uppercase;
        }

        .marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 40s linear infinite;
            padding-left: 100%;
            font-size: 4vh;
        }

        @keyframes marquee {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }

        .marquee span {
            margin-right: 10vh;
        }

        .card-header.centered {
            flex-direction: column;
            text-align: center;
            gap: 0.2vh;
            padding-bottom: 0.8vh;
        }

        .header-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 4vh;
        }

        .location-subtitle {
            font-size: 1.8vh;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .prayer-grid.compact {
            gap: 0.3vh;
            margin-bottom: 1vh;
        }

        .prayer-grid.compact .prayer-item {
            padding: 0.8vh 2vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .prayer-info {
            display: flex;
            align-items: center;
            gap: 1.5vh;
        }

        .prayer-icon {
            width: 3.5vh;
            height: 3.5vh;
            fill: var(--primary);
            opacity: 0.8;
        }

        .active .prayer-icon {
            fill: #ffffff;
            opacity: 1;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .prayer-grid.compact .prayer-name {
            font-size: 2.4vh;
        }

        .prayer-grid.compact .prayer-time {
            font-size: 3.5vh;
        }

        /* Activity Slider */
        .activity-section {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 1.5vh;
            border: 1px solid var(--glass-border);
        }

        .activity-header {
            display: flex;
            align-items: center;
            gap: 1vh;
            margin-bottom: 0.8vh;
            color: var(--accent);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 2vh;
        }

        .activity-header svg {
            width: 2vh;
            height: 2vh;
            fill: var(--accent);
        }

        .activity-slider-container {
            height: 10vh;
            overflow: hidden;
            position: relative;
        }

        .activity-slider {
            display: flex;
            flex-direction: column;
            transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1);
        }

        .activity-item {
            height: 10vh;
            display: flex;
            align-items: center;
            font-size: 2.4vh;
            font-weight: 500;
            color: var(--text-main);
            line-height: 1.2;
        }

        /* Dots Indicator */
        .dots {
            position: absolute;
            bottom: 8vh;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 1vh;
            z-index: 10;
        }

        .dot {
            width: 1.2vh;
            height: 1.2vh;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .dot.active {
            background: var(--primary);
            width: 3vh;
            border-radius: 1vh;
        }
        /* Friday Officers Grid */
        .friday-officers-grid {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex: 1;
            gap: 3vh;
            padding: 3vh;
        }

        .officer-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.03);
            padding: 3vh;
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            flex: 1;
            width: 100%;
        }

        .officer-img-container {
            width: 16vh;
            height: 16vh;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 2vh;
            border: 4px solid;
        }

        .officer-img-container.khotib { border-color: var(--accent); box-shadow: 0 0 30px rgba(243, 195, 61, 0.3); }
        .officer-img-container.imam { border-color: var(--primary); box-shadow: 0 0 30px rgba(56, 189, 248, 0.3); }
        .officer-img-container.bilal { border-color: var(--success); box-shadow: 0 0 30px rgba(16, 185, 129, 0.3); }

        .officer-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .officer-role {
            font-size: 2.8vh;
            font-weight: 700;
            margin-bottom: 0.5vh;
        }

        .officer-role.khotib-text { color: var(--accent); }
        .officer-role.imam-text { color: var(--primary); }
        .officer-role.bilal-text { color: var(--success); }

        .officer-name {
            color: var(--text-main);
            font-size: 2.4vh;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .friday-officers-grid {
                flex-direction: column;
                gap: 1.5vh;
                padding: 1.5vh;
            }

            .officer-card {
                flex-direction: row;
                text-align: left;
                padding: 1.5vh;
                gap: 2vh;
            }

            .officer-img-container {
                width: 8vh;
                height: 8vh;
                margin-bottom: 0;
            }

            .officer-role {
                font-size: 2vh;
                margin-bottom: 0;
            }

            .officer-name {
                font-size: 1.8vh;
            }
        }
    </style>
</head>
<body>
    <div class="bg-ornament bg-ornament-left"></div>
    <div class="bg-ornament bg-ornament-right"></div>

    <nav>
        <div class="nav-container">
            <div class="nav-left" style="display: flex; flex-direction: row; align-items: center; gap: 2vh; text-align: left;">
                <img src="{{ asset('images/logo_masjid.jpg') }}" alt="Logo Masjid" style="height: 8vh; width: 8vh; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 0 15px rgba(255,255,255,0.3);">
                <div>
                    <h1>Masjid Baitul Amal</h1>
                    <p>Jalan Telaga Harapan, Kel. Sei Lakam Barat, Karimun - Kepri</p>
                </div>
            </div>
            <div class="nav-right">
                <div id="clock" onclick="testIqomah()" style="cursor: pointer;">00:00:00</div>
                <div id="hijri-date" style="font-size: 2.8vh; color: var(--accent); font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">Memuat Hijriah...</div>
                <div id="date" style="font-size: 2.0vh; color: var(--text-muted); opacity: 0.9;">Memuat tanggal...</div>
            </div>
        </div>
    </nav>

    <div class="page-carousel" id="mainCarousel">
        <!-- Page 1: Slider + Prayer -->
        <div class="page">
            <div class="slider-container">
                <div class="image-slider" id="imageSlider">
                    @forelse($sliders as $slider)
                        <div class="image-slide">
                            <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                            <div class="image-overlay">
                                <h3>{{ $slider->title }}</h3>
                                <p>{{ $slider->description }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="image-slide">
                            <img src="{{ asset('images/slider1.png') }}" alt="Default Slider">
                            <div class="image-overlay">
                                <h3>Selamat Datang</h3>
                                <p>Masjid Baitul Amal, Kabupaten Karimun.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card">
                <div class="card-header centered">
                    <svg viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" /></svg>
                    <div class="header-text">
                        <h2>Jadwal Sholat</h2>
                        <span class="location-subtitle">Kab. Karimun - Kepri</span>
                    </div>
                </div>
                <div class="prayer-grid compact">
                    <div class="prayer-item" id="subuh-row">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,18V15H10V18H12M14,18V13H16V18H14M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,7H13V11H11V7M11,13H13V15H11V13Z" /></svg>
                            <span class="prayer-name">Subuh</span>
                        </div>
                        <span class="prayer-time" id="subuh-time">{{ $prayerTime->subuh ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="dzuhur-row">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,7L11,10H13L12,7M12,2L14.39,4.39L12,6.78L9.61,4.39L12,2M3.39,10.61L5.78,13L3.39,15.39L1,13L3.39,10.61M20.61,10.61L23,13L20.61,15.39L18.22,13L20.61,10.61M12,18L14.39,20.39L12,22.78L9.61,20.39L12,18M12,12A3,3 0 0,1 9,9A3,3 0 0,1 12,6A3,3 0 0,1 15,9A3,3 0 0,1 12,12Z" /></svg>
                            <span class="prayer-name">Dzuhur</span>
                        </div>
                        <span class="prayer-time" id="dzuhur-time">{{ $prayerTime->dzuhur ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="ashar-row">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,2L4.5,20.29L5.21,21L12,18L18.79,21L19.5,20.29L12,2Z" /></svg>
                            <span class="prayer-name">Ashar</span>
                        </div>
                        <span class="prayer-time" id="ashar-time">{{ $prayerTime->ashar ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="maghrib-row">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,22L16,18H13V12H11V18H8L12,22M12,2L8,6H11V10H13V6H16L12,2Z" /></svg>
                            <span class="prayer-name">Maghrib</span>
                        </div>
                        <span class="prayer-time" id="maghrib-time">{{ $prayerTime->maghrib ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="isya-row">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4.09L13.5,1L14.56,4.09L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,11L18.5,9.06L19.19,11L21.25,11M18.97,15.95C17.29,15.95 15.69,15.34 14.43,14.22C13.17,13.1 12.31,11.58 12,9.91C11.69,8.24 11.95,6.52 12.72,5C10.59,5.45 8.69,6.73 7.44,8.58C6.19,10.43 5.7,12.7 6.08,14.88C6.46,17.06 7.68,19 9.47,20.28C11.26,21.56 13.48,22.09 15.66,21.75C17.84,21.41 19.82,20.24 21.14,18.47C22.46,16.7 23.01,14.5 22.67,12.33C21.6,14.5 19.38,15.95 16.97,15.95H18.97Z" /></svg>
                            <span class="prayer-name">Isya</span>
                        </div>
                        <span class="prayer-time" id="isya-time">{{ $prayerTime->isya ?? '--:--' }}</span>
                    </div>
                </div>
                
                <div class="activity-section">
                    <div class="activity-header">
                        <svg viewBox="0 0 24 24"><path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" /></svg>
                        <span>Informasi Kegiatan</span>
                    </div>
                    <div class="activity-slider-container">
                        <div class="activity-slider" id="activitySlider1">
                            @forelse($activities as $activity)
                                <div class="activity-item">{{ $activity->title }}</div>
                            @empty
                                <div class="activity-item">Belum ada kegiatan yang dijadwalkan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 1vh; padding: 0 1vh;">
                    <p style="color: var(--text-muted); font-size: 1.4vh;" class="current-date"></p>
                    <p style="color: var(--text-muted); font-size: 1.4vh;" class="last-updated">Update: --:--</p>
                </div>
            </div>
        </div>

        <!-- Page 2: Financial + Prayer -->
        <div class="page">
            <div class="card">
                <div class="card-header">
                    <svg viewBox="0 0 24 24"><path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M15,13V17H13V13H9V11H13V7H15V11H19V13H15Z" /></svg>
                    <h2>Laporan Kas Masjid</h2>
                </div>
                <div class="financial-grid">
                    <div class="financial-item">
                        <h2 class="financial-label">Infaq Hari Ini</h2>
                        <span class="financial-value">Rp {{ number_format($incomeToday, 0, ',', '.') }}</span>
                    </div>
                    <div class="financial-item">
                        <h2 class="financial-label">Infaq Bulan Ini</h2>
                        <span class="financial-value">Rp {{ number_format($incomeMonth, 0, ',', '.') }}</span>
                    </div>
                    <div class="financial-item success">
                        <span class="financial-label">Infaq Jumat Terakhir</span>
                        <span class="financial-value">
                            @if($fridayInfaq)
                                Rp {{ number_format($fridayInfaq->amount, 0, ',', '.') }}
                            @else
                                Rp 0
                            @endif
                        </span>
                    </div>
                    <div class="financial-item primary">
                        <span class="financial-label">Saldo Kas Masjid & Yatim Piatu</span>
                        <span class="financial-value">Rp {{ number_format($balance, 0, ',', '.') }}</span>
                    </div>
                    <div class="financial-item danger">
                        <span class="financial-label">Laporan Pengeluaran</span>
                        <span class="financial-value">Rp {{ number_format($expenseMonth, 0, ',', '.') }}</span>
                    </div>
                    <div class="financial-item success full-width">
                        <span class="financial-label">Sisa Saldo Kas Masjid & Yatim Piatu</span>
                        <span class="financial-value">Rp {{ number_format($balance, 0, ',', '.') }}</span>
                    </div>
                    <div class="financial-item primary full-width" style="background: rgba(243, 195, 61, 0.1); border-left-color: var(--accent);">
                        <span class="financial-label" style="color: var(--accent);">Total Kas Anak Yatim Piatu</span>
                        <span class="financial-value" style="color: var(--accent);">Rp {{ number_format($orphanBalance, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="card prayer-card">
                <div class="card-header centered">
                    <svg viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" /></svg>
                    <div class="header-text">
                        <h2>Jadwal Sholat</h2>
                        <span class="location-subtitle">Kab. Karimun - Kepri</span>
                    </div>
                </div>
                <div class="prayer-grid compact">
                    <div class="prayer-item" id="subuh-row-2">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,18V15H10V18H12M14,18V13H16V18H14M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,7H13V11H11V7M11,13H13V15H11V13Z" /></svg>
                            <span class="prayer-name">Subuh</span>
                        </div>
                        <span class="prayer-time" id="subuh-time-2">{{ $prayerTime->subuh ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="dzuhur-row-2">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,7L11,10H13L12,7M12,2L14.39,4.39L12,6.78L9.61,4.39L12,2M3.39,10.61L5.78,13L3.39,15.39L1,13L3.39,10.61M20.61,10.61L23,13L20.61,15.39L18.22,13L20.61,10.61M12,18L14.39,20.39L12,22.78L9.61,20.39L12,18M12,12A3,3 0 0,1 9,9A3,3 0 0,1 12,6A3,3 0 0,1 15,9A3,3 0 0,1 12,12Z" /></svg>
                            <span class="prayer-name">Dzuhur</span>
                        </div>
                        <span class="prayer-time" id="dzuhur-time-2">{{ $prayerTime->dzuhur ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="ashar-row-2">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,2L4.5,20.29L5.21,21L12,18L18.79,21L19.5,20.29L12,2Z" /></svg>
                            <span class="prayer-name">Ashar</span>
                        </div>
                        <span class="prayer-time" id="ashar-time-2">{{ $prayerTime->ashar ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="maghrib-row-2">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M12,22L16,18H13V12H11V18H8L12,22M12,2L8,6H11V10H13V6H16L12,2Z" /></svg>
                            <span class="prayer-name">Maghrib</span>
                        </div>
                        <span class="prayer-time" id="maghrib-time-2">{{ $prayerTime->maghrib ?? '--:--' }}</span>
                    </div>
                    <div class="prayer-item" id="isya-row-2">
                        <div class="prayer-info">
                            <svg class="prayer-icon" viewBox="0 0 24 24"><path d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4.09L13.5,1L14.56,4.09L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,11L18.5,9.06L19.19,11L21.25,11M18.97,15.95C17.29,15.95 15.69,15.34 14.43,14.22C13.17,13.1 12.31,11.58 12,9.91C11.69,8.24 11.95,6.52 12.72,5C10.59,5.45 8.69,6.73 7.44,8.58C6.19,10.43 5.7,12.7 6.08,14.88C6.46,17.06 7.68,19 9.47,20.28C11.26,21.56 13.48,22.09 15.66,21.75C17.84,21.41 19.82,20.24 21.14,18.47C22.46,16.7 23.01,14.5 22.67,12.33C21.6,14.5 19.38,15.95 16.97,15.95H18.97Z" /></svg>
                            <span class="prayer-name">Isya</span>
                        </div>
                        <span class="prayer-time" id="isya-time-2">{{ $prayerTime->isya ?? '--:--' }}</span>
                    </div>
                </div>

                <div class="activity-section">
                    <div class="activity-header">
                        <svg viewBox="0 0 24 24"><path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" /></svg>
                        <span>Informasi Kegiatan</span>
                    </div>
                    <div class="activity-slider-container">
                        <div class="activity-slider" id="activitySlider2">
                            @forelse($activities as $activity)
                                <div class="activity-item">{{ $activity->title }}</div>
                            @empty
                                <div class="activity-item">Belum ada kegiatan yang dijadwalkan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 1vh; padding: 0 1vh;">
                    <p style="color: var(--text-muted); font-size: 1.4vh;" class="current-date"></p>
                    <p style="color: var(--text-muted); font-size: 1.4vh;" class="last-updated">Update: --:--</p>
                </div>
            </div>
        </div>
        <!-- Page 3: Zakat Information -->
        <div class="page">
            <!-- Informasi Zakat -->
            <div class="card">
                <div class="card-header">
                    <svg viewBox="0 0 24 24"><path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M11,7H13V13H11V7M11,15H13V17H11V15Z" /></svg>
                    <h2>Informasi Zakat</h2>
                </div>
                <div class="zakat-grid">
                    <div class="zakat-card-inner">
                        <div class="zakat-title">
                            <svg style="width:2.5vh;height:2.5vh" viewBox="0 0 24 24"><path d="M12,2L4.5,20.29L5.21,21L12,18L18.79,21L19.5,20.29L12,2Z" /></svg>
                            Zakat Fitrah
                        </div>
                        <div class="zakat-content">
                            <p style="margin-bottom: 1vh;">Total Zakat Fitrah Terkumpul Tahun Ini:</p>
                            <h3 style="font-size: 3.5vh; color: var(--accent); margin: 1vh 0; font-weight: 800;">Rp {{ number_format($zakatFitrah, 0, ',', '.') }}</h3>
                            <p style="margin-top: 2vh;">Wajib bagi setiap Muslim yang menemui bulan Ramadhan dan Syawal.</p>
                        </div>
                    </div>
                    <div class="zakat-card-inner">
                        <div class="zakat-title">
                            <svg style="width:2.5vh;height:2.5vh" viewBox="0 0 24 24"><path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M15,13V17H13V13H9V11H13V7H15V11H19V13H15Z" /></svg>
                            Zakat Maal
                        </div>
                        <div class="zakat-content">
                            <p style="margin-bottom: 1vh;">Total Zakat Maal Terkumpul Tahun Ini:</p>
                            <h3 style="font-size: 3.5vh; color: var(--accent); margin: 1vh 0; font-weight: 800;">Rp {{ number_format($zakatMaal, 0, ',', '.') }}</h3>
                            <p style="margin-top: 2vh; margin-bottom: 1.5vh;">Zakat harta yang telah mencapai nisab dan haul (1 tahun).</p>
                            <ul style="font-size: 2.0vh; margin-top: 1vh; color: var(--text-muted); padding-left: 0; list-style-type: none;">
                                <li style="margin-bottom: 0.8vh;"><strong>• Nisab:</strong> Setara 85 gram emas.</li>
                                <li style="margin-bottom: 0.8vh;"><strong>• Haul:</strong> Kepemilikan sudah mencapai 1 tahun.</li>
                                <li style="margin-bottom: 0.8vh;"><strong>• Kadar:</strong> 2.5% dari total harta.</li>
                            </ul>
                            <p style="font-size: 1.8vh; margin-top: 1.5vh; color: var(--accent); font-style: italic;">* Rumus: (Total Harta - Hutang) x 2.5%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tata Cara Pembayaran -->
            <div class="card">
                <div class="card-header">
                    <svg viewBox="0 0 24 24"><path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M11,7H13V13H11V7M11,15H13V17H11V15Z" /></svg>
                    <h2>Tata Cara Pembayaran</h2>
                </div>
                <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="procedure-step">
                            <div class="step-number">1</div>
                            <div class="step-text">Menghitung jumlah zakat yang wajib dikeluarkan sesuai ketentuan.</div>
                        </div>
                        <div class="procedure-step">
                            <div class="step-number">2</div>
                            <div class="step-text">Mendatangi Unit Pengumpul Zakat (UPZ) Masjid Baitul Amal.</div>
                        </div>
                        <div class="procedure-step">
                            <div class="step-number">3</div>
                            <div class="step-text">Membaca Niat Zakat (Fitrah/Maal) saat menyerahkan kepada Amil.</div>
                        </div>
                        <div class="procedure-step">
                            <div class="step-number">4</div>
                            <div class="step-text">Menerima doa dari Amil dan mendapatkan bukti setor zakat.</div>
                        </div>
                    </div>
                    
                    <!-- Quote Al-Quran -->
                    <div style="margin-top: auto; padding: 2vh; background: rgba(56, 189, 248, 0.1); border-radius: 16px; border: 2px dashed var(--primary); margin-top: 3vh;">
                        <p style="color: var(--primary); font-size: 2vh; line-height: 1.6; text-align: center; font-style: italic;">
                            "Ambilah zakat dari sebagian harta mereka, dengan zakat itu kamu membersihkan dan mensucikan mereka."
                        </p>
                        <p style="color: var(--accent); font-size: 1.8vh; text-align: center; margin-top: 1vh; font-weight: 600;">
                            (QS. At-Taubah: 103)
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page 4: Friday Prayer Information -->
        <div class="page">
            <!-- Petugas Sholat Jumat -->
            <div class="card" style="position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('{{ asset('images/mosque_bg.jpg') }}'); background-size: cover; background-position: center; opacity: 0.2; z-index: 0;"></div>
                <div style="position: relative; z-index: 1; display: flex; flex-direction: column; height: 100%;">
                <div class="card-header centered">
                    <svg viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" /></svg>
                    <div class="header-text">
                        <h2>Petugas Sholat Jumat</h2>
                        <span class="location-subtitle">
                            @if($fridaySchedule)
                                {{ \Carbon\Carbon::parse($fridaySchedule->date)->translatedFormat('l, d F Y') }}
                            @else
                                Jadwal Belum Tersedia
                            @endif
                        </span>
                    </div>
                </div>
                
                <div class="friday-officers-grid">
                    <!-- Khotib -->
                    <div class="officer-card">
                        <div class="officer-img-container khotib">
                            <img src="{{ $fridaySchedule && $fridaySchedule->khotib_photo ? Storage::url($fridaySchedule->khotib_photo) : asset('images/logo_masjid.jpg') }}" 
                                 alt="Khotib" 
                                 class="officer-img">
                        </div>
                        <h3 class="officer-role khotib-text">KHOTIB</h3>
                        <p class="officer-name">{{ $fridaySchedule->khotib ?? '-' }}</p>
                    </div>

                    <!-- Imam -->
                    <div class="officer-card">
                        <div class="officer-img-container imam">
                            <img src="{{ $fridaySchedule && $fridaySchedule->imam_photo ? Storage::url($fridaySchedule->imam_photo) : asset('images/logo_masjid.jpg') }}" 
                                 alt="Imam" 
                                 class="officer-img">
                        </div>
                        <h3 class="officer-role imam-text">IMAM</h3>
                        <p class="officer-name">{{ $fridaySchedule->imam ?? '-' }}</p>
                    </div>

                    <!-- Bilal -->
                    <div class="officer-card">
                        <div class="officer-img-container bilal">
                            <img src="{{ $fridaySchedule && $fridaySchedule->bilal_photo ? Storage::url($fridaySchedule->bilal_photo) : asset('images/logo_masjid.jpg') }}" 
                                 alt="Bilal" 
                                 class="officer-img">
                        </div>
                        <h3 class="officer-role bilal-text">BILAL</h3>
                        <p class="officer-name">{{ $fridaySchedule->bilal ?? '-' }}</p>
                    </div>
                </div>
                </div>
            </div>

            <!-- Laporan Infaq Jumat -->
            <div class="card">
                <div class="card-header">
                    <svg viewBox="0 0 24 24"><path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M15,13V17H13V13H9V11H13V7H15V11H19V13H15Z" /></svg>
                    <h2>Laporan Infaq Jumat</h2>
                </div>
                <div class="financial-grid">
                    <div class="financial-item full-width">
                        <span class="financial-label">
                            Tanggal
                            <span style="font-size: 1.8vh; color: var(--text-muted); display: block; margin-top: 0.5vh;">
                                @if($fridayInfaq)
                                    {{ \Carbon\Carbon::parse($fridayInfaq->date)->translatedFormat('l, d F Y') }}
                                @else
                                    -
                                @endif
                            </span>
                        </span>
                    </div>
                    <div class="financial-item success full-width">
                        <span class="financial-label">Total Infaq Jumat</span>
                        <span class="financial-value">
                            @if($fridayInfaq)
                                Rp {{ number_format($fridayInfaq->amount, 0, ',', '.') }}
                            @else
                                Rp 0
                            @endif
                        </span>
                    </div>
                    
                    @if($fridayInfaq && $fridayInfaq->description)
                    <div class="financial-item primary full-width" style="margin-top: 1vh;">
                        <span class="financial-label">Keterangan</span>
                        <p style="color: var(--text-main); font-size: 2vh; margin-top: 0.5vh;">
                            {{ $fridayInfaq->description }}
                        </p>
                    </div>
                    @endif
                </div>
                
                <!-- Info Tambahan -->
                <div style="margin-top: auto; padding: 2vh; background: rgba(243, 195, 61, 0.1); border-radius: 16px; border: 1px solid var(--accent); margin-top: 3vh;">
                    <p style="color: var(--accent); font-size: 2vh; line-height: 1.6; text-align: center; font-weight: 600;">
                        📊 Laporan lengkap tersedia di pengurus masjid
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="dots">
        <div class="dot active" id="dot1"></div>
        <div class="dot" id="dot2"></div>
        <div class="dot" id="dot3"></div>
        <div class="dot" id="dot4"></div>
    </div>

    <div class="marquee-container">
        <div class="marquee">
            @forelse($runningTexts as $text)
                <span>{{ $text->text }}</span>
            @empty
                <span>SELAMAT DATANG DI MASJID BAITUL AMAL - KABUPATEN KARIMUN</span>
            @endforelse
            <span style="color: var(--accent);">LAPORAN KAS: Infaq Hari Ini: Rp {{ number_format($incomeToday, 0, ',', '.') }} | Saldo Kas: Rp {{ number_format($balance, 0, ',', '.') }} | Saldo Yatim: Rp {{ number_format($orphanBalance, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Iqomah Overlay -->
    <div id="iqomahOverlay" class="iqomah-overlay">
        <div class="iqomah-content">
            <h2 id="iqomahTitle">MENUNGGU IQOMAH</h2>
            <div id="iqomahTimer">10:00</div>
            <p>Luruskan dan rapatkan shaf sholat kita</p>
        </div>
    </div>

    <style>
        .iqomah-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(2, 6, 23, 0.95);
            backdrop-filter: blur(20px);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .iqomah-content {
            padding: 5vh;
            border: 2px solid var(--primary);
            border-radius: 40px;
            background: rgba(15, 23, 42, 0.5);
            box-shadow: 0 0 50px rgba(56, 189, 248, 0.2);
        }

        #iqomahTitle {
            font-family: 'Outfit', sans-serif;
            font-size: 6vh;
            color: var(--accent);
            margin-bottom: 2vh;
            letter-spacing: 4px;
        }

        #iqomahTimer {
            font-family: 'Outfit', sans-serif;
            font-size: 25vh;
            font-weight: 800;
            color: #ffffff;
            line-height: 1;
            text-shadow: 0 0 40px rgba(56, 189, 248, 0.5);
        }

        .iqomah-content p {
            font-size: 3vh;
            color: var(--text-muted);
            margin-top: 2vh;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .page {
                grid-template-columns: 1fr;
                padding: var(--padding) 2%;
                overflow-y: auto;
            }
            
            .slider-container {
                height: 40vh;
            }

            .card {
                height: auto;
                min-height: 40vh;
            }

            nav h1 {
                font-size: 3vh;
            }

            nav p {
                font-size: 1.5vh;
            }
            
            .nav-left img {
                height: 6vh !important;
                width: 6vh !important;
            }

            #clock {
                font-size: 5vh !important; /* Slightly smaller than desktop but readable */
            }

            #hijri-date {
                font-size: 2.2vh !important;
            }

            #date {
                font-size: 1.8vh !important;
            }
        }

        @media (max-width: 768px) {
            :root {
                --nav-height: auto;
                --marquee-height: 8vh;
            }

            body {
                overflow-y: auto;
                height: auto;
                min-height: 100vh;
            }

            nav {
                padding: 2vh 5%;
            }

            .nav-container {
                flex-direction: column;
                gap: 2vh;
                text-align: center;
            }

            .nav-left, .nav-right {
                text-align: center;
                align-items: center;
                width: 100%;
                justify-content: center;
            }
            
            .nav-left {
                flex-direction: row !important; /* Force row even if inline style is somehow overridden, though inline usually wins. This is just for clarity in CSS */
                text-align: left; /* Keep text aligned left inside the block */
            }

            nav h1, #clock {
                font-size: 4vh;
            }

            nav p, #date {
                font-size: 1.8vh;
            }

            .page-carousel {
                height: auto;
                min-height: calc(100vh - 15vh - var(--marquee-height));
            }

            .page {
                padding: 2vh;
                gap: 2vh;
            }

            .slider-container {
                height: 50vh;
            }

            .financial-grid {
                grid-template-columns: 1fr;
            }

            .financial-value {
                font-size: 2.5vh;
            }

            .marquee {
                font-size: 2.5vh;
            }

            #iqomahTimer {
                font-size: 15vh;
            }

            #iqomahTitle {
                font-size: 4vh;
            }

            .iqomah-content {
                width: 90%;
                padding: 3vh;
            }
        }

        @media (max-width: 480px) {
            nav h1, #clock {
                font-size: 3vh;
            }

            .slider-container {
                height: 45vh;
            }

            .prayer-time {
                font-size: 2.2vh;
            }

            .prayer-name {
                font-size: 1.8vh;
            }
        }
    </style>

    <script>
        // Main Carousel Logic
        const carousel = document.getElementById('mainCarousel');
        const dots = [
            document.getElementById('dot1'),
            document.getElementById('dot2'),
            document.getElementById('dot3'),
            document.getElementById('dot4')
        ];
        let currentPage = 0;
        const totalPages = 4;

        function nextPage() {
            currentPage++;
            if (currentPage >= totalPages) {
                currentPage = 0;
            }
            
            carousel.style.transform = `translateX(-${currentPage * 25}%)`;
            
            // Update dots
            dots.forEach((dot, i) => {
                if (i === currentPage) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        setInterval(nextPage, 15000); // Switch page every 15 seconds

        // Image Slider Logic (Inside Page 1)
        const imageSlider = document.getElementById('imageSlider');
        const imageSlides = document.querySelectorAll('.image-slide');
        let imageIndex = 0;

        function nextImage() {
            imageIndex++;
            if (imageIndex >= imageSlides.length) {
                imageIndex = 0;
            }
            imageSlider.style.transform = `translateX(-${imageIndex * 100}%)`;
        }

        setInterval(nextImage, 5000); // Switch image every 5 seconds

        // Clock and Date Logic
        function updateClock() {
            const now = new Date();
            
            // Time
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeStr = `${hours}:${minutes}`;
            const timeWithSeconds = `${timeStr}:${seconds}`;
            
            document.getElementById('clock').innerText = timeWithSeconds;
            
            // Date
            // Hijri Date Fallback (Local Calculation)
            const hijriOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            let hijriStr = now.toLocaleDateString('id-ID-u-ca-islamic', hijriOptions);
            hijriStr = hijriStr.replace('Minggu', 'Ahad');
            
            // Only update if not already set by API
            const hijriEl = document.getElementById('hijri-date');
            if (hijriEl && (hijriEl.innerText === 'Memuat Hijriah...' || hijriEl.getAttribute('data-source') === 'local')) {
                hijriEl.innerText = hijriStr;
                hijriEl.setAttribute('data-source', 'local');
            }

            // Gregorian Date
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = now.toLocaleDateString('id-ID', options);
            document.getElementById('date').innerText = dateStr;

            // Update other date elements if any
            const dateElements = document.querySelectorAll('.current-date');
            dateElements.forEach(el => {
                if (el.innerText === '' || el.getAttribute('data-source') === 'local') {
                    el.innerText = hijriStr;
                    el.setAttribute('data-source', 'local');
                }
            });

            // Update active prayer highlight
            highlightActivePrayer(timeStr);

            // Check for prayer time trigger
            checkPrayerTrigger(timeStr, seconds);
        }

        // Prayer Times Logic
        let prayerTimes = {};
        let lastTriggeredPrayer = '';
        let lastFetchDay = '';

        const CITY_ID = '0502'; // Kabupaten Karimun

        async function fetchPrayerTimes() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const todayStr = `${year}-${month}-${day}`;
            const cacheKey = `prayer_schedule_${year}_${month}`;
            
            try {
                // 1. Check LocalStorage Cache first
                const cachedData = localStorage.getItem(cacheKey);
                if (cachedData) {
                    try {
                        const parsed = JSON.parse(cachedData);
                        const todayData = parsed.find(j => j.date === todayStr);
                        if (todayData) {
                            console.log('Using cached prayer times for today');
                            prayerTimes = todayData;
                            lastFetchDay = todayStr;
                            updatePrayerUI(prayerTimes, true);
                            // Still fetch monthly in background to keep it fresh
                            fetchMonthlyInBackground(year, month, cacheKey, todayStr);
                            return;
                        }
                    } catch (e) {
                        console.error('Cache parse error:', e);
                        localStorage.removeItem(cacheKey);
                    }
                }

                // 2. If no cache, fetch TODAY'S data immediately for speed
                console.log(`Fetching daily prayer times for ${todayStr}...`);
                const dailyResponse = await fetch(`https://api.myquran.com/v2/sholat/jadwal/${CITY_ID}/${year}/${month}/${day}`);
                if (dailyResponse.ok) {
                    const dailyResult = await dailyResponse.json();
                    if (dailyResult.status && dailyResult.data && dailyResult.data.jadwal) {
                        prayerTimes = dailyResult.data.jadwal;
                        lastFetchDay = todayStr;
                        updatePrayerUI(prayerTimes, false);
                    }
                }

                // 3. Fetch Monthly Data for future resilience
                fetchMonthlyInBackground(year, month, cacheKey, todayStr);

            } catch (error) {
                console.error('Error in fetchPrayerTimes:', error);
                // Fallback to any available cache
                tryFallbackCache(todayStr);
                setTimeout(fetchPrayerTimes, 60000);
            }
        }

        async function fetchHijriDate(day, month, year) {
            try {
                const response = await fetch(`https://api.aladhan.com/v1/gToH/${day}-${month}-${year}`);
                if (response.ok) {
                    const result = await response.json();
                    if (result.code === 200 && result.data && result.data.hijri) {
                        const h = result.data.hijri;
                        const months = [
                            '', 'Muharram', 'Safar', 'Rabiul Awal', 'Rabiul Akhir', 
                            'Jumadil Awal', 'Jumadil Akhir', 'Rajab', 'Syaban', 
                            'Ramadhan', 'Syawal', 'Dzulqaidah', 'Dzulhijjah'
                        ];
                        const dayNames = {
                            'Al Sabt': 'Sabtu',
                            'Al Ahad': 'Ahad',
                            'Al Ithnayn': 'Senin',
                            'Al Thulatha': 'Selasa',
                            'Al Arba\'a': 'Rabu',
                            'Al Khamis': 'Kamis',
                            'Al Jumu\'ah': 'Jumat'
                        };
                        
                        const dayName = dayNames[h.weekday.en] || h.weekday.en;
                        const monthName = months[h.month.number];
                        const hijriStr = `${dayName}, ${h.day} ${monthName} ${h.year}`;
                        
                        const updateHijri = () => {
                            const hijriEl = document.getElementById('hijri-date');
                            if (hijriEl) {
                                hijriEl.innerText = hijriStr;
                                hijriEl.setAttribute('data-source', 'api');
                            }
                            document.querySelectorAll('.current-date').forEach(el => {
                                el.innerText = hijriStr;
                                el.setAttribute('data-source', 'api');
                            });
                        };

                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', updateHijri);
                        } else {
                            updateHijri();
                        }
                    }
                }
            } catch (e) {
                console.error('Error fetching Hijri date:', e);
            }
        }

        async function fetchMonthlyInBackground(year, month, cacheKey, todayStr) {
            try {
                const response = await fetch(`https://api.myquran.com/v2/sholat/jadwal/${CITY_ID}/${year}/${month}`);
                if (response.ok) {
                    const result = await response.json();
                    if (result.status && result.data && result.data.jadwal) {
                        localStorage.setItem(cacheKey, JSON.stringify(result.data.jadwal));
                        // If we didn't have prayerTimes yet, populate it
                        if (!prayerTimes.subuh) {
                            const todayData = result.data.jadwal.find(j => j.date === todayStr);
                            if (todayData) {
                                prayerTimes = todayData;
                                lastFetchDay = todayStr;
                                updatePrayerUI(prayerTimes, false);
                            }
                        }
                    }
                }
            } catch (e) {
                console.error('Background fetch error:', e);
            }
        }

        function tryFallbackCache(todayStr) {
            try {
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    if (key.startsWith('prayer_schedule_')) {
                        const data = JSON.parse(localStorage.getItem(key));
                        const match = data.find(j => j.date === todayStr);
                        if (match) {
                            prayerTimes = match;
                            updatePrayerUI(prayerTimes, true);
                            return;
                        }
                    }
                }
            } catch (e) {
                console.error('Fallback cache error:', e);
            }
        }

        function updatePrayerUI(times, isFromCache) {
            if (!times) return;
            const prayers = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
            
            // Ensure DOM is ready
            const updateElements = () => {
                prayers.forEach(p => {
                    const timeStr = times[p];
                    if (timeStr) {
                        const el1 = document.getElementById(`${p}-time`);
                        const el2 = document.getElementById(`${p}-time-2`);
                        if (el1) el1.innerText = timeStr;
                        if (el2) el2.innerText = timeStr;
                    }
                });

                const now = new Date();
                const timeStr = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
                document.querySelectorAll('.last-updated').forEach(el => {
                    el.innerText = `${isFromCache ? 'Cached' : 'Update'}: ${timeStr}`;
                });
            };

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', updateElements);
            } else {
                updateElements();
            }
        }

        function highlightActivePrayer(currentTime) {
            if (!prayerTimes || !prayerTimes.subuh) return;

            // Auto-refresh if day has changed
            const now = new Date();
            const todayStr = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;
            if (lastFetchDay && lastFetchDay !== todayStr) {
                fetchPrayerTimes();
            }

            const prayers = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
            let activePrayer = '';

            for (let i = 0; i < prayers.length; i++) {
                const p = prayers[i];
                const nextP = prayers[i + 1];
                
                if (currentTime >= prayerTimes[p] && (!nextP || currentTime < prayerTimes[nextP])) {
                    activePrayer = p;
                }
            }

            if (currentTime >= prayerTimes.isya || currentTime < prayerTimes.subuh) {
                activePrayer = 'isya';
            }

            prayers.forEach(p => {
                const row1 = document.getElementById(`${p}-row`);
                const row2 = document.getElementById(`${p}-row-2`);
                if (p === activePrayer) {
                    if (row1) row1.classList.add('active');
                    if (row2) row2.classList.add('active');
                } else {
                    if (row1) row1.classList.remove('active');
                    if (row2) row2.classList.remove('active');
                }
            });
        }

        // Iqomah Timer Logic
        let iqomahInterval;
        let iqomahSeconds = 600; // 10 minutes
        let isIqomahActive = false;

        function checkPrayerTrigger(currentTime, seconds) {
            if (!prayerTimes || !prayerTimes.subuh || isIqomahActive) return;

            const prayers = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
            const today = new Date().toDateString();
            
            prayers.forEach(p => {
                if (currentTime === prayerTimes[p] && lastTriggeredPrayer !== (today + p)) {
                    startIqomahTimer(p);
                }
            });
        }

        let audioCtx = null;

        async function initAudio() {
            try {
                if (!audioCtx) {
                    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    console.log('AudioContext created');
                }
                if (audioCtx.state === 'suspended') {
                    console.log('Resuming AudioContext...');
                    await audioCtx.resume();
                }
                console.log('AudioContext state:', audioCtx.state);
                return audioCtx.state === 'running';
            } catch (e) {
                console.error('AudioContext initialization failed:', e);
                return false;
            }
        }

        async function playBeep() {
            try {
                const isReady = await initAudio();
                if (!isReady) {
                    console.warn('Audio not ready, skipping beep');
                    return;
                }

                console.log('Playing beep...');
                const playSingleBeep = (startTime) => {
                    const oscillator = audioCtx.createOscillator();
                    const gainNode = audioCtx.createGain();

                    oscillator.type = 'sine';
                    oscillator.frequency.setValueAtTime(1000, startTime); // 1000Hz for better audibility
                    
                    gainNode.gain.setValueAtTime(0, startTime);
                    gainNode.gain.linearRampToValueAtTime(0.5, startTime + 0.01); // Faster attack, slightly louder
                    gainNode.gain.exponentialRampToValueAtTime(0.01, startTime + 0.1);

                    oscillator.connect(gainNode);
                    gainNode.connect(audioCtx.destination);

                    oscillator.start(startTime);
                    oscillator.stop(startTime + 0.1);
                };

                // Play two beeps ("tit.. tit..")
                const now = audioCtx.currentTime;
                playSingleBeep(now);
                playSingleBeep(now + 0.15); // Slightly faster interval
            } catch (e) {
                console.error('Error playing beep:', e);
            }
        }

        function startIqomahTimer(prayerName, duration = 600) {
            const today = new Date().toDateString();
            lastTriggeredPrayer = today + prayerName;
            isIqomahActive = true;
            iqomahSeconds = duration;
            
            const overlay = document.getElementById('iqomahOverlay');
            const timerDisplay = document.getElementById('iqomahTimer');
            const titleDisplay = document.getElementById('iqomahTitle');
            
            if (titleDisplay) titleDisplay.innerText = `MENUNGGU IQOMAH ${prayerName.toUpperCase()}`;
            if (overlay) overlay.style.display = 'flex';
            
            clearInterval(iqomahInterval);
            iqomahInterval = setInterval(() => {
                iqomahSeconds--;
                
                const mins = Math.floor(iqomahSeconds / 60);
                const secs = iqomahSeconds % 60;
                if (timerDisplay) timerDisplay.innerText = `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                
                if (iqomahSeconds <= 10 && iqomahSeconds > 0) {
                    playBeep();
                }
                
                if (iqomahSeconds <= 0) {
                    clearInterval(iqomahInterval);
                    setTimeout(() => {
                        if (overlay) overlay.style.display = 'none';
                        isIqomahActive = false;
                    }, 5000);
                }
            }, 1000);
        }

        async function testIqomah() {
            await initAudio();
            if (!isIqomahActive) {
                startIqomahTimer('TEST', 20);
            } else {
                clearInterval(iqomahInterval);
                const overlay = document.getElementById('iqomahOverlay');
                if (overlay) overlay.style.display = 'none';
                isIqomahActive = false;
            }
        }

        // Activity Slider Logic
        function initActivitySlider(sliderId) {
            const slider = document.getElementById(sliderId);
            if (!slider) return;
            const items = slider.querySelectorAll('.activity-item');
            let index = 0;

            function nextActivity() {
                index++;
                if (index >= items.length) {
                    index = 0;
                }
                slider.style.transform = `translateY(-${index * 10}vh)`;
            }

            setInterval(nextActivity, 4000);
        }

        // Initialize everything when DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            initActivitySlider('activitySlider1');
            initActivitySlider('activitySlider2');
            
            setInterval(updateClock, 1000);
            updateClock();
            
            const now = new Date();
            fetchHijriDate(now.getDate(), now.getMonth() + 1, now.getFullYear());
            
            fetchPrayerTimes();
            setInterval(fetchPrayerTimes, 1800000);

            // Global audio unlock
            document.addEventListener('click', async () => {
                await initAudio();
            }, { once: true });
        });
    </script>
</body>
</html>
