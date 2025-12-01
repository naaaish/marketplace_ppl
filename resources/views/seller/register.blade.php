<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Toko - Step by Step</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Animasi Transisi Step */
        .step-content {
            display: none;
            animation: fadeIn 0.5s;
        }
        .step-content.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Styling Progress Bar */
        .step-indicator {
            position: relative;
            z-index: 1;
        }
        .step-indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            z-index: -1;
            transform: translateY(-50%);
        }
        .step-circle {
            background: white;
            transition: all 0.3s ease;
        }
        .step-circle.active {
            background: #102C54;
            color: white;
            border-color: #102C54;
        }
        .step-circle.completed {
            background: #102C54;
            color: white;
            border-color: #102C54;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
        
        <!-- SIDEBAR (Dekorasi) -->
        <div class="md:w-1/3 bg-[#102C54] text-white p-8 flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-32 mb-6" onerror="this.style.display='none'">
                <h2 class="text-3xl font-bold mb-2">Partner Sukses</h2>
                <p class="text-blue-200">Bergabunglah dengan ribuan penjual lainnya dan kembangkan bisnismu sekarang.</p>
            </div>
            
            <!-- Step Progress di Sidebar (Desktop) -->
            <div class="relative z-10 mt-10 space-y-6 hidden md:block">
                <div class="flex items-center gap-4 step-label opacity-100" id="label-step-1">
                    <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold bg-white text-[#102C54]">1</div>
                    <span>Info Toko & PIC</span>
                </div>
                <div class="flex items-center gap-4 step-label opacity-50" id="label-step-2">
                    <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold">2</div>
                    <span>Alamat Lengkap</span>
                </div>
                <div class="flex items-center gap-4 step-label opacity-50" id="label-step-3">
                    <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold">3</div>
                    <span>Dokumen & Final</span>
                </div>
            </div>

            <!-- Hiasan Background -->
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-600 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute top-10 -left-10 w-40 h-40 bg-blue-400 rounded-full opacity-10 blur-2xl"></div>
        </div>

        <!-- FORM CONTENT -->
        <div class="md:w-2/3 p-8 bg-white relative">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Pendaftaran</h2>

            <!-- Mobile Progress Bar -->
            <div class="md:hidden flex justify-between mb-8 step-indicator">
                <div class="step-circle w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500 active" id="mob-step-1">1</div>
                <div class="step-circle w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500" id="mob-step-2">2</div>
                <div class="step-circle w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500" id="mob-step-3">3</div>
            </div>

            <form method="POST" action="{{ route('seller.store') }}" enctype="multipart/form-data" id="sellerForm">
                @csrf
                
                <!-- INPUT HIDDEN untuk User Data -->
                <input type="hidden" name="name" id="user_name">
                <input type="hidden" name="email" id="user_email">

                <!-- STEP 1: INFO UTAMA -->
                <div class="step-content active" id="step-1">
                    <h3 class="text-lg font-semibold text-[#102C54] mb-4 border-b pb-2">Informasi Toko & Penanggung Jawab</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Toko</label>
                            <input type="text" name="store_name" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-900 focus:outline-none" placeholder="Toko Berkah Jaya" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                            <textarea name="store_description" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-900 focus:outline-none" rows="2" placeholder="Jualan apa?"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama PIC</label>
                                <input type="text" id="pic_name" name="pic_name" class="w-full p-3 border rounded-lg" placeholder="Nama Lengkap" required oninput="syncData()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No HP</label>
                                <input type="text" name="pic_phone" class="w-full p-3 border rounded-lg" placeholder="0812xxx" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email PIC (Untuk Login)</label>
                            <input type="email" id="pic_email" name="pic_email" class="w-full p-3 border rounded-lg" placeholder="email@contoh.com" required oninput="syncData()">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="nextStep(2)" class="bg-[#102C54] text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition flex items-center">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: ALAMAT LENGKAP (API WILAYAH) -->
                <div class="step-content" id="step-2">
                    <h3 class="text-lg font-semibold text-[#102C54] mb-4 border-b pb-2">Alamat Lengkap</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Jalan</label>
                            <input type="text" name="pic_address" class="w-full p-3 border rounded-lg" placeholder="Nama Jalan, No Rumah" required>
                        </div>

                        <!-- PROVINSI -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <select id="select_province" class="w-full p-3 border rounded-lg bg-white" required onchange="loadRegencies(this.value)">
                                <option value="">Pilih Provinsi...</option>
                            </select>
                            <!-- Input Hidden untuk menyimpan NAMA Provinsi (bukan ID) ke database -->
                            <input type="hidden" name="province" id="input_province">
                        </div>

                        <!-- KOTA/KABUPATEN -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <select id="select_regency" class="w-full p-3 border rounded-lg bg-white" required onchange="loadDistricts(this.value)" disabled>
                                <option value="">Pilih Kota/Kab...</option>
                            </select>
                            <input type="hidden" name="regency" id="input_regency">
                        </div>

                        <!-- KECAMATAN (Tambahan biar lengkap, tapi opsional di db kalau ga ada kolomnya) -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                <select id="select_district" class="w-full p-3 border rounded-lg bg-white" required onchange="loadVillages(this.value)" disabled>
                                    <option value="">Pilih Kecamatan...</option>
                                </select>
                            </div>
                            <!-- KELURAHAN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan</label>
                                <select id="select_village" class="w-full p-3 border rounded-lg bg-white" required onchange="updateVillageName(this)" disabled>
                                    <option value="">Pilih Kelurahan...</option>
                                </select>
                                <input type="hidden" name="village" id="input_village">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT</label>
                                <input type="text" name="rt" class="w-full p-3 border rounded-lg" placeholder="001" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW</label>
                                <input type="text" name="rw" class="w-full p-3 border rounded-lg" placeholder="002" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="prevStep(1)" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition">
                            Kembali
                        </button>
                        <button type="button" onclick="nextStep(3)" class="bg-[#102C54] text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition flex items-center">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: DOKUMEN & SUBMIT -->
                <div class="step-content" id="step-3">
                    <h3 class="text-lg font-semibold text-[#102C54] mb-4 border-b pb-2">Dokumen Pendukung</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="pic_ktp_number" class="w-full p-3 border rounded-lg" placeholder="16 Digit NIK" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('pic_photo').click()">
                                <i class="fas fa-user-circle text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Upload Foto PIC</p>
                                <p class="text-xs text-gray-400">Klik untuk upload (JPG/PNG)</p>
                                <input type="file" name="pic_photo" id="pic_photo" class="hidden" onchange="previewFile(this, 'preview_photo')">
                                <p id="preview_photo" class="text-xs text-green-600 mt-2 hidden">File terpilih!</p>
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('pic_ktp_file').click()">
                                <i class="fas fa-id-card text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Upload Scan KTP</p>
                                <p class="text-xs text-gray-400">Klik untuk upload (JPG/PNG)</p>
                                <input type="file" name="pic_ktp_file" id="pic_ktp_file" class="hidden" onchange="previewFile(this, 'preview_ktp')">
                                <p id="preview_ktp" class="text-xs text-green-600 mt-2 hidden">File terpilih!</p>
                            </div>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                            <p class="text-sm text-blue-800">
                                Pastikan seluruh data yang Anda masukkan sudah benar. Setelah mendaftar, Admin akan memverifikasi data Anda dalam 1x24 jam.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="prevStep(2)" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition">
                            Kembali
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-bold shadow-lg transform hover:-translate-y-1">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- SCRIPT LOGIC (STEPPER & API WILAYAH) -->
    <script>
        // --- 1. LOGIC STEPPER ---
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.step-circle').forEach(el => el.classList.remove('active', 'completed'));
            document.querySelectorAll('.step-label').forEach(el => el.classList.add('opacity-50'));
            document.querySelectorAll('.step-label').forEach(el => el.classList.remove('opacity-100'));

            // Show current step
            document.getElementById('step-' + step).classList.add('active');
            
            // Update Sidebar (Desktop)
            for(let i=1; i<=step; i++) {
                 document.getElementById('label-step-' + i).classList.remove('opacity-50');
                 document.getElementById('label-step-' + i).classList.add('opacity-100');
            }

            // Update Mobile Circles
            for(let i=1; i<=step; i++) {
                document.getElementById('mob-step-' + i).classList.add('active');
            }
        }

        function nextStep(step) {
            // Validasi Sederhana (Bisa dikembangkan)
            // const inputs = document.getElementById('step-' + (step-1)).querySelectorAll('input[required], select[required]');
            // let valid = true;
            // inputs.forEach(input => {
            //     if (!input.value) {
            //         input.classList.add('border-red-500');
            //         valid = false;
            //     } else {
            //         input.classList.remove('border-red-500');
            //     }
            // });

            // if (valid) showStep(step);
            // else alert('Harap lengkapi data wajib!');
            showStep(step); // Bypass validasi dulu biar gampang testing
        }

        function prevStep(step) {
            showStep(step);
        }

        function syncData() {
            document.getElementById('user_name').value = document.getElementById('pic_name').value;
            document.getElementById('user_email').value = document.getElementById('pic_email').value;
        }

        function previewFile(input, labelId) {
            if (input.files && input.files[0]) {
                document.getElementById(labelId).classList.remove('hidden');
                document.getElementById(labelId).innerText = "File: " + input.files[0].name;
            }
        }

        // --- 2. LOGIC API WILAYAH INDONESIA ---
        // Menggunakan API dari emsifa (Data sesuai Permendagri)
        const baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

        // Load Provinsi saat halaman dibuka
        fetch(`${baseUrl}/provinces.json`)
            .then(response => response.json())
            .then(provinces => {
                let options = '<option value="">Pilih Provinsi...</option>';
                provinces.forEach(province => {
                    // Value kita simpan ID, tapi text kita ambil juga nanti
                    options += `<option value="${province.id}" data-name="${province.name}">${province.name}</option>`;
                });
                document.getElementById('select_province').innerHTML = options;
            });

        // Load Kota/Kabupaten saat Provinsi dipilih
        function loadRegencies(provinceId) {
            if (!provinceId) return;

            // Simpan NAMA Provinsi ke hidden input
            const select = document.getElementById('select_province');
            const provinceName = select.options[select.selectedIndex].getAttribute('data-name');
            document.getElementById('input_province').value = provinceName;

            // Reset dropdown bawahnya
            document.getElementById('select_regency').innerHTML = '<option value="">Loading...</option>';
            document.getElementById('select_regency').disabled = true;

            fetch(`${baseUrl}/regencies/${provinceId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    let options = '<option value="">Pilih Kota/Kab...</option>';
                    regencies.forEach(regency => {
                        options += `<option value="${regency.id}" data-name="${regency.name}">${regency.name}</option>`;
                    });
                    document.getElementById('select_regency').innerHTML = options;
                    document.getElementById('select_regency').disabled = false;
                });
        }

        // Load Kecamatan saat Kota dipilih
        function loadDistricts(regencyId) {
            if (!regencyId) return;

            // Simpan NAMA Kota
            const select = document.getElementById('select_regency');
            const regencyName = select.options[select.selectedIndex].getAttribute('data-name');
            document.getElementById('input_regency').value = regencyName;

            document.getElementById('select_district').innerHTML = '<option value="">Loading...</option>';
            document.getElementById('select_district').disabled = true;

            fetch(`${baseUrl}/districts/${regencyId}.json`)
                .then(response => response.json())
                .then(districts => {
                    let options = '<option value="">Pilih Kecamatan...</option>';
                    districts.forEach(district => {
                        options += `<option value="${district.id}" data-name="${district.name}">${district.name}</option>`;
                    });
                    document.getElementById('select_district').innerHTML = options;
                    document.getElementById('select_district').disabled = false;
                });
        }

        // Load Kelurahan saat Kecamatan dipilih
        function loadVillages(districtId) {
            if (!districtId) return;

            document.getElementById('select_village').innerHTML = '<option value="">Loading...</option>';
            document.getElementById('select_village').disabled = true;

            fetch(`${baseUrl}/villages/${districtId}.json`)
                .then(response => response.json())
                .then(villages => {
                    let options = '<option value="">Pilih Kelurahan...</option>';
                    villages.forEach(village => {
                        options += `<option value="${village.id}" data-name="${village.name}">${village.name}</option>`;
                    });
                    document.getElementById('select_village').innerHTML = options;
                    document.getElementById('select_village').disabled = false;
                });
        }

        // Simpan Nama Kelurahan Terakhir
        function updateVillageName(selectElement) {
            const villageName = selectElement.options[selectElement.selectedIndex].getAttribute('data-name');
            document.getElementById('input_village').value = villageName;
        }

    </script>
</body>
</html>