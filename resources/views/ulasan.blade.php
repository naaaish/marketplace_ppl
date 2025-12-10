<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Produk - Ulasan Tukutuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Mengatur agar container selalu di tengah */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6; /* bg-gray-100 */
        }
        /* Warna utama Tukutuku (Biru Tua) */
        .primary-color {
            color: #102C54;
        }
        .bg-primary {
            background-color: #102C54;
        }
        /* Styling untuk textarea */
        .comment-input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #d1d5db; /* border-gray-300 */
            padding: 8px 0;
            margin-bottom: 20px;
            background: transparent;
            outline: none;
            min-height: 80px;
            resize: vertical;
            font-size: 1rem;
        }
        .comment-input:focus {
            border-bottom-color: #102C54; /* Fokus ke warna primer */
        }
        /* Menyembunyikan input file standar */
        .hidden-input {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

<div class="review-container w-full max-w-lg bg-white shadow-xl rounded-xl overflow-hidden">
    
    <form id="reviewForm" method="POST" action="/submit-ulasan" enctype="multipart/form-data">
        @csrf

        <div class="bg-primary text-white p-5 flex justify-between items-center">
            <h2 class="text-2xl font-bold tracking-tight">Nilai Produk</h2>
            
            {{-- Logo Tukutuku (img/logo.png) --}}
            <div class="logo-section">
                <img src="{{ asset('img/logo.png') }}" 
                     alt="Logo Tukutuku" 
                     class="h-10 w-auto object-contain" 
                     onerror="this.style.display='none'">
            </div>
            
        </div>

        <div class="p-6">

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="alert-success bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-5" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif
            
            {{-- Pesan Error --}}
            @if($errors->any())
                <div class="alert-error bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-5" role="alert">
                    <p class="font-bold">Gagal!</p>
                    <p class="text-sm">Terjadi kesalahan input.</p>
                </div>
            @endif


            <div class="product-info flex items-start pb-4 mb-4 border-b border-gray-200">
                
                <div class="w-16 h-16 mr-4 flex-shrink-0">
                    {{-- **PERBAIKAN DISINI: Menggunakan path yang BENAR 'img/headphone.png'** --}}
                    <img src="{{ asset('img/headphone.png') }}" 
                         alt="Gambar Produk Soundcore Q20i" 
                         class="w-full h-full object-contain rounded-md border border-gray-200 p-1"
                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 64 64\'%3E%3Crect width=\'64\' height=\'64\' fill=\'%23f3f4f6\'/%3E%3Ctext x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'10\' text-anchor=\'middle\' dominant-baseline=\'middle\' fill=\'%236b7280\'%3EGAMBAR%3C/text%3E%3C/svg%3E'">
                    {{-- ---------------------------------------------------------------------- --}}
                </div>
                
                <div class="product-details flex-grow">
                    <p class="font-semibold text-gray-900 leading-snug text-sm">
                        Soundcore by Anker Q20i Bluetooth Headphones with Mic Hi-Res Hybrid ANC Headset with Noise Cancelling Wireless Headphone Over-the-Ear Headphones - A3004 - Black
                    </p>
                    <input type="hidden" name="product_id" value="A3004">
                </div>
            </div>

            <div class="rating-section mb-6 p-4 bg-blue-50/70 rounded-lg">
                <label class="font-semibold text-gray-700 block mb-2">Kualitas Produk:</label>
                <div class="flex items-center">
                    <div class="stars text-3xl tracking-widest leading-none">
                        <span id="starRating" class="primary-color cursor-pointer select-none">★★★★☆</span>
                    </div>
                    <div id="ratingText" class="rating-text ml-4 text-sm font-bold primary-color uppercase">sangat baik</div>
                    <input type="hidden" name="rating" id="ratingValue" value="4">
                </div>
            </div>

            <div class="comment-area mb-6">
                <label for="comment-input" class="font-semibold text-gray-700 block mb-2">Komentar:</label>
                <textarea id="comment-input" class="comment-input text-gray-800" name="comment" placeholder="Tulis ulasan Anda tentang produk ini..."></textarea>
                
                <div class="media-buttons flex flex-wrap gap-3 mt-2">
                    <button id="addFotoBtn" class="media-button bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-800 transition flex items-center text-sm" type="button">
                        <i class="fas fa-camera mr-2"></i> Tambah Foto
                    </button>
                    <button id="addVideoBtn" class="media-button bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-800 transition flex items-center text-sm" type="button">
                        <i class="fas fa-video mr-2"></i> Tambah Video
                    </button>
                    
                    <input type="file" id="fotoInput" name="foto" class="hidden-input" accept="image/*">
                    <input type="file" id="videoInput" name="video" class="hidden-input" accept="video/*">

                    <div id="fileIndicator" class="flex items-center gap-4 text-xs text-gray-600 mt-2">
                        <span id="fotoStatus" class="flex items-center gap-1 text-gray-500">
                            <i class="fas fa-image"></i> Belum ada foto.
                        </span>
                        <span id="videoStatus" class="flex items-center gap-1 text-gray-500">
                            <i class="fas fa-video"></i> Belum ada video.
                        </span>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="bg-gray-50 p-5 flex justify-end gap-3 border-t border-gray-200">
            <button id="cancelBtn" class="btn-batal bg-white primary-color border border-primary px-6 py-2.5 rounded-lg font-bold uppercase hover:bg-blue-50 transition" type="button">Batalkan</button>
            <button class="btn-ok bg-primary text-white px-6 py-2.5 rounded-lg font-bold uppercase hover:bg-blue-800 transition shadow-md" type="submit">OK</button>
        </div>

    </form>

</div>

<script>
    const starRating = document.getElementById('starRating');
    const ratingText = document.getElementById('ratingText');
    const ratingValue = document.getElementById('ratingValue');
    const fotoInput = document.getElementById('fotoInput');
    const videoInput = document.getElementById('videoInput');
    const fotoStatus = document.getElementById('fotoStatus');
    const videoStatus = document.getElementById('videoStatus');
    
    const primaryColorClass = 'primary-color';
    
    const ratingLabels = {
        1: 'buruk', 2: 'cukup', 3: 'baik', 4: 'sangat baik', 5: 'sempurna'
    };

    function updateRatingDisplay(rating) {
        const fullStar = '★';
        const emptyStar = '☆';
        const displayStars = fullStar.repeat(rating) + emptyStar.repeat(5 - rating);
        starRating.textContent = displayStars;
        ratingValue.value = rating;
        ratingText.textContent = ratingLabels[rating];
        starRating.classList.add(primaryColorClass);
    }
    
    updateRatingDisplay(4);

    starRating.addEventListener('click', function(event) {
        const rect = starRating.getBoundingClientRect();
        const clickX = event.clientX - rect.left;
        const totalWidth = rect.width;
        const starWidth = totalWidth / 5;
        let newRating = Math.ceil(clickX / starWidth);
        
        newRating = Math.max(1, Math.min(5, newRating));
        updateRatingDisplay(newRating);
    });

    document.getElementById('addFotoBtn').addEventListener('click', function() {
        fotoInput.click();
    });

    document.getElementById('addVideoBtn').addEventListener('click', function() {
        videoInput.click();
    });

    // Handle perubahan input file Foto
    fotoInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            const fileName = this.files[0].name;
            fotoStatus.innerHTML = '<i class="fas fa-check-circle text-green-600"></i> ' + fileName;
            fotoStatus.className = 'flex items-center gap-1 text-green-600 font-medium';
        } else {
            fotoStatus.innerHTML = '<i class="fas fa-image text-gray-500"></i> Belum ada foto.';
            fotoStatus.className = 'flex items-center gap-1 text-gray-500';
        }
    });

    // Handle perubahan input file Video
    videoInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            const fileName = this.files[0].name;
            videoStatus.innerHTML = '<i class="fas fa-check-circle text-green-600"></i> ' + fileName;
            videoStatus.className = 'flex items-center gap-1 text-green-600 font-medium';
        } else {
            videoStatus.innerHTML = '<i class="fas fa-video text-gray-500"></i> Belum ada video.';
            videoStatus.className = 'flex items-center gap-1 text-gray-500';
        }
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        if (window.history.length > 1) {
            window.history.back();
        } else {
            alert("Ulasan dibatalkan. Mengarahkan ke halaman utama.");
            window.location.href = "/";
        }
    });

    document.getElementById('reviewForm').addEventListener('submit', function(event) {
        const comment = document.getElementById('comment-input').value.trim();

        if (comment === "" || ratingValue.value === "0") {
            event.preventDefault(); 
            alert("Mohon berikan rating dan tulis ulasan Anda sebelum mengirim.");
            return false;
        }
    });
</script>
</body>
</html>