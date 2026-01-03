<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi - Masjid Baitul Amal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0b0c0bff;
            --primary: #38bdf8;
            --accent: #f3c33dff;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --glass: rgba(15, 23, 42, 0.8);
            --glass-border: rgba(255, 255, 255, 0.1);
            --nav-height: 18vh;
            --marquee-height: 8vh;
            --main-height: calc(100vh - var(--nav-height) - var(--marquee-height));
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
            background-size: auto 100%;
            background-repeat: no-repeat;
            opacity: 0.15;
            z-index: -1;
            pointer-events: none;
        }

        .bg-ornament-left { left: -5vw; background-position: left center; }
        .bg-ornament-right { right: -5vw; background-position: right center; transform: scaleX(-1); }

        /* Header */
        header {
            height: var(--nav-height);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 1vh;
            z-index: 100;
            background: rgba(11, 12, 11, 0.5);
            backdrop-filter: blur(10px);
        }

        .logo {
            height: 9vh;
            width: 9vh;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.4);
            margin-bottom: 1vh;
        }

        h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 4.5vh;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #fff;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.4);
        }

        /* Main Content Area */
        #content-area {
            flex: 1;
            position: relative;
            height: var(--main-height);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .view-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .view-container.active {
            display: flex;
            opacity: 1;
        }

        /* Menu View */
        .menu-grid {
            display: flex;
            gap: 5vw;
            padding: 0 5vw;
        }

        .menu-card {
            background: var(--glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            width: 30vw;
            height: 40vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            color: inherit;
        }

        .menu-card:hover {
            transform: translateY(-2vh) scale(1.05);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 30px rgba(56, 189, 248, 0.2);
        }

        .menu-icon {
            font-size: 10vh;
            margin-bottom: 2vh;
            filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.5));
        }

        .menu-title {
            font-family: 'Outfit', sans-serif;
            font-size: 4vh;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Photo Slider View */
        .slider-wrapper {
            width: 85vw;
            height: 70vh;
            position: relative;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 24px;
            padding: 2vh;
            border: 8px solid var(--glass-border);
            box-shadow: 0 0 50px rgba(0,0,0,0.5);
            overflow: hidden;
        }

        .photo-slider {
            width: 100%;
            height: 100%;
            display: flex;
            transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1);
        }

        .photo-slide {
            min-width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .photo-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0,0,0,0.8);
        }

        .photo-caption {
            position: absolute;
            bottom: 4vh;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.7);
            padding: 1.5vh 4vh;
            border-radius: 50px;
            font-size: 2.5vh;
            font-weight: 600;
            color: var(--primary);
            border: 1px solid var(--primary);
            backdrop-filter: blur(5px);
        }

        /* Video View */
        .video-wrapper {
            width: 85vw;
            height: 70vh;
            background: #000;
            border-radius: 24px;
            border: 8px solid var(--glass-border);
            box-shadow: 0 0 50px rgba(0,0,0,0.5);
            overflow: hidden;
            position: relative;
        }

        .video-wrapper iframe, .video-wrapper video {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Controls */
        .back-btn {
            position: absolute;
            top: 2vh;
            left: 2vh;
            background: var(--primary);
            color: #000;
            padding: 1vh 3vh;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            z-index: 200;
            border: none;
            font-size: 2vh;
            display: flex;
            align-items: center;
            gap: 1vh;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
        }

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.1);
            color: #fff;
            width: 8vh;
            height: 8vh;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 4vh;
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            z-index: 150;
        }

        .nav-arrow:hover { background: var(--primary); color: #000; }
        .prev-arrow { left: 2vw; }
        .next-arrow { right: 2vw; }

        /* Marquee */
        .marquee-container {
            background: linear-gradient(90deg, rgba(6, 92, 40, 0.9), rgba(15, 23, 42, 0.9));
            backdrop-filter: blur(10px);
            color: #fff;
            height: var(--marquee-height);
            display: flex;
            align-items: center;
            width: 100%;
            overflow: hidden;
            border-top: 1px solid var(--glass-border);
            z-index: 100;
        }

        .marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 30s linear infinite;
            font-size: 3.5vh;
            font-weight: 600;
            text-transform: uppercase;
        }

        @keyframes marquee {
            0% { transform: translate(100%, 0); }
            100% { transform: translate(-100%, 0); }
        }

        .marquee span {
            margin-right: 15vw;
            display: inline-flex;
            align-items: center;
            gap: 2vh;
        }

        .marquee span::before { content: "✦"; color: var(--accent); }

        @media (max-width: 768px) {
            .menu-grid { flex-direction: column; gap: 3vh; }
            .menu-card { width: 80vw; height: 25vh; }
            h1 { font-size: 3.5vh; }
            .slider-wrapper, .video-wrapper { width: 95vw; height: 50vh; }
        }
    </style>
</head>
<body>
    <div class="bg-ornament bg-ornament-left"></div>
    <div class="bg-ornament bg-ornament-right"></div>

    <header>
        <img src="{{ asset('images/logo_masjid.jpg') }}" alt="Logo Masjid" class="logo">
        <h1>Masjid Baitul Amal</h1>
    </header>

    <div id="content-area">
        <!-- Main Menu View -->
        <div id="menu-view" class="view-container active">
            <div class="menu-grid">
                <div class="menu-card" onclick="showView('photo-view')">
                    <div class="menu-icon">📸</div>
                    <div class="menu-title">Foto</div>
                </div>
                <div class="menu-card" onclick="showView('video-view')">
                    <div class="menu-icon">🎥</div>
                    <div class="menu-title">Video</div>
                </div>
            </div>
        </div>

        <!-- Photo Slider View -->
        <div id="photo-view" class="view-container">
            <button class="back-btn" onclick="showView('menu-view')"><span>←</span> Kembali</button>
            <div class="nav-arrow prev-arrow" onclick="prevPhoto()">‹</div>
            <div class="nav-arrow next-arrow" onclick="nextPhoto()">›</div>
            <div class="slider-wrapper">
                <div class="photo-slider" id="photoSlider">
                    @forelse($galleries as $photo)
                        <div class="photo-slide">
                            <img src="{{ Storage::url($photo->image) }}" alt="{{ $photo->title }}">
                            @if($photo->title)
                                <div class="photo-caption">{{ $photo->title }}</div>
                            @endif
                        </div>
                    @empty
                        <div class="photo-slide">
                            <img src="{{ asset('images/slider1.png') }}" alt="Default Photo">
                            <div class="photo-caption">Belum ada foto dokumentasi.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Video View -->
        <div id="video-view" class="view-container">
            <button class="back-btn" onclick="showView('menu-view')"><span>←</span> Kembali</button>
            <div class="video-wrapper">
                @if($videos->count() > 0)
                    @php $firstVideo = $videos->first(); @endphp
                    @if(str_contains($firstVideo->video_url, 'youtube.com') || str_contains($firstVideo->video_url, 'youtu.be'))
                        @php 
                            $videoId = "";
                            if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $firstVideo->video_url, $match)) {
                                $videoId = $match[1];
                            }
                        @endphp
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&loop=1&playlist={{ $videoId }}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @else
                        <video controls autoplay loop muted>
                            <source src="{{ $firstVideo->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                @else
                    <div style="display: flex; justify-content: center; align-items: center; height: 100%; font-size: 3vh; color: var(--text-muted);">
                        Belum ada video dokumentasi.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="marquee-container">
        <div class="marquee">
            @forelse($runningTexts as $text)
                <span>{{ $text->text }}</span>
            @empty
                <span>Selamat Datang di Masjid Baitul Amal - Dokumentasi Kegiatan Masjid</span>
            @endforelse
        </div>
    </div>

    <script>
        let currentPhotoIndex = 0;
        const photoCount = {{ $galleries->count() > 0 ? $galleries->count() : 1 }};

        function showView(viewId) {
            document.querySelectorAll('.view-container').forEach(view => {
                view.classList.remove('active');
            });
            const targetView = document.getElementById(viewId);
            targetView.style.display = 'flex';
            setTimeout(() => {
                targetView.classList.add('active');
            }, 10);

            // Hide other views after transition
            setTimeout(() => {
                document.querySelectorAll('.view-container').forEach(view => {
                    if (view.id !== viewId) view.style.display = 'none';
                });
            }, 500);
        }

        function updateSlider() {
            const slider = document.getElementById('photoSlider');
            slider.style.transform = `translateX(-${currentPhotoIndex * 100}%)`;
        }

        function nextPhoto() {
            currentPhotoIndex = (currentPhotoIndex + 1) % photoCount;
            updateSlider();
        }

        function prevPhoto() {
            currentPhotoIndex = (currentPhotoIndex - 1 + photoCount) % photoCount;
            updateSlider();
        }

        // Auto slide photos every 5 seconds when photo view is active
        setInterval(() => {
            if (document.getElementById('photo-view').classList.contains('active')) {
                nextPhoto();
            }
        }, 5000);
    </script>
</body>
</html>
