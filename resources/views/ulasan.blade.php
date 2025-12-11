<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - Tukutuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .primary-color { color: #102C54; }
        .bg-primary { background-color: #102C54; }
        .border-primary { border-color: #102C54; }
        
        /* Animasi Transisi Halus */
        .step-content {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
        }
        .step-content.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Styling Input */
        .input-underline {
            width: 100%;
            border: none;
            border-bottom: 2px solid #e5e7eb;
            padding: 10px 0;
            background: transparent;
            outline: none;
            transition: border-color 0.3s;
        }
        .input-underline:focus {
            border-bottom-color: #102C54;
        }
        
        /* Radio Button Varian Custom */
        .variant-radio:checked + label {
            background-color: #102C54;
            color: white;
            border-color: #102C54;
        }
    </style>
</head>
<body>

<div class="w-full max-w-lg bg-white shadow-2xl rounded-2xl overflow-hidden relative">
    
    <div class="bg-primary text-white p-5 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <a href="javascript:history.back()" class="text-white hover:text-gray-300 transition">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>

            <div>
                <h2 class="text-xl font-bold leading-tight">Beri Ulasan</h2>
                <p class="text-xs opacity-80 mt-1">Bagikan pengalamanmu</p>
            </div>
        </div>

        <img src="{{ asset('img/logo.png') }}" 
             alt="Logo" 
             class="h-14 w-auto object-contain" 
             onerror="this.style.display='none'">
    </div>

    <div class="flex justify-between items-center px-8 py-4 bg-blue-50">
        <div class="flex flex-col items-center step-indicator">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm mb-1" id="ind-1">1</div>
            <span class="text-xs font-semibold text-gray-600">Data</span>
        </div>
        <div class="h-1 flex-1 bg-gray-300 mx-2 rounded relative">
            <div class="h-1 bg-primary transition-all duration-300 w-0" id="progress-1"></div>
        </div>
        <div class="flex flex-col items-center step-indicator">
            <div class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold text-sm mb-1 transition-colors" id="ind-2">2</div>
            <span class="text-xs font-semibold text-gray-600">Varian</span>
        </div>
        <div class="h-1 flex-1 bg-gray-300 mx-2 rounded relative">
            <div class="h-1 bg-primary transition-all duration-300 w-0" id="progress-2"></div>
        </div>
        <div class="flex flex-col items-center step-indicator">
            <div class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold text-sm mb-1 transition-colors" id="ind-3">3</div>
            <span class="text-xs font-semibold text-gray-600">Review</span>
        </div>
    </div>

    <form id="reviewForm" method="POST" action="/submit-ulasan" enctype="multipart/form-data" class="p-6">
        @csrf
        <input type="hidden" name="product_id" value="A3004">

        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
            <img src="{{ asset('img/headphone.png') }}" class="w-14 h-14 object-contain border rounded p-1" onerror="this.src='https://via.placeholder.com/60'">
            <div>
                <h4 class="font-bold text-gray-800 text-sm line-clamp-1">Soundcore Anker Q20i Bluetooth</h4>
                <p class="text-xs text-gray-500">Headphones Over-Ear</p>
            </div>
        </div>

        <div id="step-1" class="step-content active">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Data Diri Kamu</h3>
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-600">Nama Lengkap</label>
                <input type="text" name="nama" id="inputNama" class="input-underline" placeholder="Masukkan nama kamu" required>
            </div>

            <div class="mb-2">
                <label class="block text-sm font-semibold text-gray-600">Alamat Email</label>
                <input type="email" name="email" id="inputEmail" class="input-underline" placeholder="contoh@email.com" required>
            </div>
            
            <div class="flex items-center mt-4">
                <input type="checkbox" name="hide_name" id="hideName" class="mr-2">
                <label for="hideName" class="text-sm text-gray-500">Tampilkan sebagai anonim</label>
            </div>
        </div>

        <div id="step-2" class="step-content">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Varian Apa yang Kamu Beli?</h3>
            <p class="text-xs text-gray-500 mb-6">Pilih varian yang sesuai dengan produk yang kamu terima.</p>

            <label class="block text-sm font-semibold text-gray-600 mb-3">Warna</label>
            <div class="flex gap-3 mb-6">
                <input type="radio" name="varian_warna" id="color1" value="Black" class="hidden variant-radio" checked>
                <label for="color1" class="border border-gray-300 px-4 py-2 rounded-lg cursor-pointer text-sm font-medium hover:bg-gray-50 transition">
                    Hitam (Black)
                </label>

                <input type="radio" name="varian_warna" id="color2" value="Navy" class="hidden variant-radio">
                <label for="color2" class="border border-gray-300 px-4 py-2 rounded-lg cursor-pointer text-sm font-medium hover:bg-gray-50 transition">
                    Biru (Navy)
                </label>
            </div>

            <div class="bg-yellow-50 text-yellow-800 p-3 rounded text-xs border border-yellow-200">
                <i class="fas fa-info-circle mr-1"></i> Jika produk ini tidak memiliki varian, silakan langsung tekan tombol Lanjut.
            </div>
        </div>

        <div id="step-3" class="step-content">
            <h3 class="text-lg font-bold text-gray-800 mb-1 text-center">Berikan Penilaian</h3>
            <p class="text-xs text-gray-500 text-center mb-6">Seberapa puas kamu dengan produk ini?</p>

            <div class="flex justify-center mb-2">
                <div class="stars text-4xl cursor-pointer select-none text-gray-300" id="starContainer">
                    <i class="fas fa-star star-icon" data-value="1"></i>
                    <i class="fas fa-star star-icon" data-value="2"></i>
                    <i class="fas fa-star star-icon" data-value="3"></i>
                    <i class="fas fa-star star-icon" data-value="4"></i>
                    <i class="fas fa-star star-icon" data-value="5"></i>
                </div>
            </div>
            <div id="ratingText" class="text-center font-bold text-primary text-sm uppercase mb-6">-</div>
            <input type="hidden" name="rating" id="ratingValue" value="0">

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-2">Komentar / Ulasan</label>
                <textarea name="comment" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-blue-900 focus:outline-none" rows="3" placeholder="Ceritakan kepuasanmu tentang kualitas produk..."></textarea>
            </div>

            <div class="flex gap-2">
                <button type="button" id="btnFoto" class="flex-1 bg-gray-100 border border-dashed border-gray-400 text-gray-600 py-2 rounded hover:bg-gray-200 text-xs font-semibold flex justify-center items-center gap-2">
                    <i class="fas fa-camera"></i> <span id="txtFoto">Foto</span>
                </button>
                <button type="button" id="btnVideo" class="flex-1 bg-gray-100 border border-dashed border-gray-400 text-gray-600 py-2 rounded hover:bg-gray-200 text-xs font-semibold flex justify-center items-center gap-2">
                    <i class="fas fa-video"></i> <span id="txtVideo">Video</span>
                </button>
            </div>
            
            <input type="file" name="foto" id="inputFoto" class="hidden" accept="image/*">
            <input type="file" name="video" id="inputVideo" class="hidden" accept="video/*">
        </div>

        <div class="flex justify-between mt-8 pt-4 border-t border-gray-100">
            <button type="button" id="prevBtn" class="hidden px-5 py-2 text-gray-600 font-bold text-sm hover:text-gray-900">
                KEMBALI
            </button>
            <button type="button" id="nextBtn" class="ml-auto bg-primary text-white px-8 py-2.5 rounded-lg font-bold shadow-lg hover:bg-blue-900 transition text-sm">
                LANJUT
            </button>
            <button type="submit" id="submitBtn" class="hidden ml-auto bg-primary text-white px-8 py-2.5 rounded-lg font-bold shadow-lg hover:bg-blue-900 transition text-sm">
                KIRIM ULASAN
            </button>
        </div>

    </form>
</div>

<script>
    // === LOGIKA MULTI STEP ===
    let currentStep = 1;
    const totalSteps = 3;

    const btnNext = document.getElementById('nextBtn');
    const btnPrev = document.getElementById('prevBtn');
    const btnSubmit = document.getElementById('submitBtn');

    function updateUI() {
        // Hide all steps
        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        // Show current step
        document.getElementById(`step-${currentStep}`).classList.add('active');

        // Update Progress Bar & Indicators
        for (let i = 1; i <= totalSteps; i++) {
            const ind = document.getElementById(`ind-${i}`);
            if (i <= currentStep) {
                ind.classList.remove('bg-gray-300');
                ind.classList.add('bg-primary');
            } else {
                ind.classList.remove('bg-primary');
                ind.classList.add('bg-gray-300');
            }
            
            // Update line progress
            if (i < totalSteps) {
                const line = document.getElementById(`progress-${i}`);
                if (currentStep > i) {
                    line.classList.remove('w-0');
                    line.classList.add('w-full');
                } else {
                    line.classList.remove('w-full');
                    line.classList.add('w-0');
                }
            }
        }

        // Button Logic
        if (currentStep === 1) {
            btnPrev.classList.add('hidden');
            btnNext.classList.remove('hidden');
            btnSubmit.classList.add('hidden');
        } else if (currentStep === totalSteps) {
            btnPrev.classList.remove('hidden');
            btnNext.classList.add('hidden');
            btnSubmit.classList.remove('hidden');
        } else {
            btnPrev.classList.remove('hidden');
            btnNext.classList.remove('hidden');
            btnSubmit.classList.add('hidden');
        }
    }

    btnNext.addEventListener('click', () => {
        // Validasi Step 1 (Nama & Email Wajib)
        if (currentStep === 1) {
            const nama = document.getElementById('inputNama').value;
            const email = document.getElementById('inputEmail').value;
            if (!nama || !email) {
                alert("Harap isi Nama dan Email terlebih dahulu.");
                return;
            }
        }
        
        if (currentStep < totalSteps) {
            currentStep++;
            updateUI();
        }
    });

    btnPrev.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateUI();
        }
    });

    // === LOGIKA RATING BINTANG ===
    const stars = document.querySelectorAll('.star-icon');
    const ratingValue = document.getElementById('ratingValue');
    const ratingText = document.getElementById('ratingText');
    const labels = {1: 'Buruk', 2: 'Kurang', 3: 'Cukup', 4: 'Baik', 5: 'Sangat Baik'};

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = parseInt(star.getAttribute('data-value'));
            ratingValue.value = val;
            ratingText.innerText = labels[val];
            
            // Warnai bintang
            stars.forEach(s => {
                if (parseInt(s.getAttribute('data-value')) <= val) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });

    // === LOGIKA UPLOAD FILE ===
    document.getElementById('btnFoto').onclick = () => document.getElementById('inputFoto').click();
    document.getElementById('btnVideo').onclick = () => document.getElementById('inputVideo').click();

    document.getElementById('inputFoto').onchange = function() {
        if(this.files[0]) {
            document.getElementById('txtFoto').innerText = "Terpilih: " + this.files[0].name.substring(0, 8) + "...";
            document.getElementById('btnFoto').classList.replace('bg-gray-100', 'bg-green-100');
            document.getElementById('btnFoto').classList.replace('text-gray-600', 'text-green-700');
        }
    };
    
    document.getElementById('inputVideo').onchange = function() {
        if(this.files[0]) {
            document.getElementById('txtVideo').innerText = "Terpilih: " + this.files[0].name.substring(0, 8) + "...";
            document.getElementById('btnVideo').classList.replace('bg-gray-100', 'bg-green-100');
            document.getElementById('btnVideo').classList.replace('text-gray-600', 'text-green-700');
        }
    };

    // Validasi Submit
    document.getElementById('reviewForm').onsubmit = (e) => {
        if (ratingValue.value == "0") {
            e.preventDefault();
            alert("Silakan berikan bintang/rating terlebih dahulu.");
        }
    };

    // Init First Load
    updateUI();
</script>

</body>
</html>