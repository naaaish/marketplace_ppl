<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftarkan Toko Anda</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Animasi */
        .step-content { display: none; animation: fadeIn 0.5s; }
        .step-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Indikator */
        .step-indicator { position: relative; z-index: 1; }
        .step-indicator::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 2px; background: #e2e8f0; z-index: -1; transform: translateY(-50%); }
        
        .step-circle { background: white; transition: all 0.3s ease; }
        .step-circle.active { background: #102C54; color: white; border-color: #102C54; }
        
        /* Error Input */
        .input-error { 
            border-color: #ef4444 !important; 
            background-color: #fef2f2 !important; 
            outline: 2px solid #ef4444 !important; 
        }
        .input-success {
            border-color: #22c55e !important;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row min-h-[650px]">
        
        <div class="md:w-1/3 bg-[#102C54] text-white p-8 flex flex-col relative overflow-hidden">
            <div class="relative z-10 flex flex-col">
                <div>
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-28 mb-4 block" onerror="this.style.display='none'">
                    <h2 class="text-3xl font-bold mb-2 leading-tight">Partner Sukses</h2>
                    <p class="text-blue-200 text-sm leading-relaxed">Bergabunglah dengan ribuan penjual lainnya.</p>
                </div>
            </div>
            
            <div class="relative z-10 mt-10 space-y-6 hidden md:block">
                <div class="flex items-center gap-4 step-label opacity-100" id="label-step-1">
                    <div class="step-number-desk w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold bg-white text-[#102C54] flex-shrink-0" id="desk-step-1">1</div>
                    <span class="text-sm font-medium">Info Toko & PIC</span>
                </div>
                <div class="flex items-center gap-4 step-label opacity-50" id="label-step-2">
                    <div class="step-number-desk w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold flex-shrink-0" id="desk-step-2">2</div>
                    <span class="text-sm font-medium">Alamat Lengkap</span>
                </div>
                <div class="flex items-center gap-4 step-label opacity-50" id="label-step-3">
                    <div class="step-number-desk w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold flex-shrink-0" id="desk-step-3">3</div>
                    <span class="text-sm font-medium">Dokumen & Final</span>
                </div>
            </div>

            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-600 rounded-full opacity-20 blur-3xl pointer-events-none"></div>
        </div>

        <div class="md:w-2/3 p-8 bg-white relative flex flex-col">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Pendaftaran</h2>

            <div class="md:hidden flex justify-between mb-8 step-indicator">
                <div class="step-circle w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500 active" id="mob-step-1">1</div>
                <div class="step-circle w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500" id="mob-step-2">2</div>
                <div class="step-circle w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center font-bold text-gray-500" id="mob-step-3">3</div>
            </div>

            <form method="POST" action="{{ route('seller.store') }}" enctype="multipart/form-data" id="sellerForm" class="flex-grow flex flex-col">
                @csrf
                <input type="hidden" name="name" id="user_name">
                <input type="hidden" name="email" id="user_email">

                <div class="step-content active flex-grow" id="step-1">
                    <h3 class="text-lg font-semibold text-[#102C54] mb-4 border-b pb-2">Informasi Toko & Penanggung Jawab</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Toko <span class="text-red-500">*</span></label>
                            <input type="text" name="store_name" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900" placeholder="Toko Berkah Jaya" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Singkat <span class="text-red-500">*</span></label>
                            <textarea name="store_description" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900" rows="2" placeholder="Jualan apa?" required></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama PIC <span class="text-red-500">*</span></label>
                                <input type="text" id="pic_name" name="pic_name" class="w-full p-3 border rounded-lg" placeholder="Nama Lengkap" required oninput="syncData()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No HP <span class="text-red-500">*</span></label>
                                <input type="text" name="pic_phone" class="w-full p-3 border rounded-lg" placeholder="0812xxx" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email PIC (Untuk Login) <span class="text-red-500">*</span></label>
                            <input type="email" id="pic_email" name="pic_email" class="w-full p-3 border rounded-lg" placeholder="email@contoh.com" required oninput="syncData()" onblur="checkUnique('email', this.value, 'error_email')">
                            <p id="error_email" class="text-xs text-red-600 mt-1 hidden font-bold"><i class="fas fa-exclamation-circle"></i> Email sudah terdaftar!</p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ url('/') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition flex items-center font-medium">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                        <button type="button" onclick="nextStep(2)" class="bg-[#102C54] text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition flex items-center">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <div class="step-content flex-grow" id="step-2">
                    <h3 class="text-lg font-semibold text-[#102C54] mb-4 border-b pb-2">Alamat Lengkap</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Jalan <span class="text-red-500">*</span></label>
                            <input type="text" name="pic_address" class="w-full p-3 border rounded-lg" placeholder="Nama Jalan, No Rumah" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi <span class="text-red-500">*</span></label>
                            <select id="select_province" class="w-full p-3 border rounded-lg bg-white" required onchange="loadRegencies(this.value)"><option value="">Pilih Provinsi...</option></select>
                            <input type="hidden" name="province" id="input_province">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <select id="select_regency" class="w-full p-3 border rounded-lg bg-white" required onchange="loadDistricts(this.value)" disabled><option value="">Pilih Kota/Kab...</option></select>
                            <input type="hidden" name="regency" id="input_regency">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan <span class="text-red-500">*</span></label>
                                <select id="select_district" class="w-full p-3 border rounded-lg bg-white" required onchange="loadVillages(this.value)" disabled><option value="">Pilih Kecamatan...</option></select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan <span class="text-red-500">*</span></label>
                                <select id="select_village" class="w-full p-3 border rounded-lg bg-white" required onchange="updateVillageName(this)" disabled><option value="">Pilih Kelurahan...</option></select>
                                <input type="hidden" name="village" id="input_village">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RT <span class="text-red-500">*</span></label>
                                <input type="text" name="rt" class="w-full p-3 border rounded-lg" placeholder="001" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RW <span class="text-red-500">*</span></label>
                                <input type="text" name="rw" class="w-full p-3 border rounded-lg" placeholder="002" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between items-center">
                        <button type="button" onclick="prevStep(1)" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition font-medium">Kembali</button>
                        <button type="button" onclick="nextStep(3)" class="bg-[#102C54] text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition flex items-center">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                    </div>
                </div>

                <div class="step-content flex-grow" id="step-3">
                    <h3 class="text-lg font-semibold text-[#102C54] mb-4 border-b pb-2">Dokumen Pendukung</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
                            <input type="text" name="pic_ktp_number" id="pic_ktp_number" maxlength="16" inputmode="numeric" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900" placeholder="16 Digit NIK" required onblur="checkUnique('nik', this.value, 'error_nik_exist')">
                            <p id="error_nik" class="text-xs text-red-600 mt-1 hidden font-bold"><i class="fas fa-exclamation-circle"></i> NIK harus 16 angka!</p>
                            <p id="error_nik_exist" class="text-xs text-red-600 mt-1 hidden font-bold"><i class="fas fa-exclamation-circle"></i> NIK sudah terdaftar! Mohon cek kembali.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('pic_photo').click()" id="box_pic_photo">
                                    <i class="fas fa-user-circle text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600 font-semibold">Upload Foto PIC <span class="text-red-500">*</span></p>
                                    <input type="file" name="pic_photo" id="pic_photo" class="hidden" required accept="image/*" onchange="previewFile(this, 'preview_photo', 'box_pic_photo')">
                                    <p id="preview_photo" class="text-xs text-green-600 mt-2 hidden font-bold">File terpilih!</p>
                                </div>
                            </div>
                            <div>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('pic_ktp_file').click()" id="box_pic_ktp">
                                    <i class="fas fa-id-card text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600 font-semibold">Upload Scan KTP <span class="text-red-500">*</span></p>
                                    <input type="file" name="pic_ktp_file" id="pic_ktp_file" class="hidden" required accept="image/*" onchange="previewFile(this, 'preview_ktp', 'box_pic_ktp')">
                                    <p id="preview_ktp" class="text-xs text-green-600 mt-2 hidden font-bold">File terpilih!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between items-center">
                        <button type="button" onclick="prevStep(2)" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition font-medium">Kembali</button>
                        <button type="submit" id="btnSubmit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-bold shadow-lg transform hover:-translate-y-1">Daftar Sekarang</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        // --- 1. LOGIC STEPPER & REQUIRED VALIDATION ---
        function showStep(step) {
            // Sembunyikan semua step form
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            // Tampilkan step yang diminta
            document.getElementById('step-' + step).classList.add('active');
            
            // --- UPDATE INDIKATOR MOBILE ---
            document.querySelectorAll('.step-circle').forEach(el => el.classList.remove('active', 'completed'));
            for(let i=1; i<=3; i++) {
                const circle = document.getElementById('mob-step-' + i);
                if(i <= step) {
                    if(circle) circle.classList.add('active');
                }
            }

            // --- UPDATE INDIKATOR SIDEBAR (DESKTOP) ---
            document.querySelectorAll('.step-label').forEach(el => {
                el.classList.add('opacity-50'); 
                el.classList.remove('opacity-100');
            });
            document.querySelectorAll('.step-number-desk').forEach(el => {
                el.classList.remove('bg-white', 'text-[#102C54]'); // Hapus style aktif
            });

            // Logic Aktifkan Step Sidebar yang sesuai
            const label = document.getElementById('label-step-' + step);
            const deskCircle = document.getElementById('desk-step-' + step);
            
            if(label) {
                label.classList.remove('opacity-50');
                label.classList.add('opacity-100');
            }
            if(deskCircle) {
                deskCircle.classList.add('bg-white', 'text-[#102C54]');
            }
        }

        function nextStep(targetStep) {
            const currentStep = targetStep - 1;
            const currentStepDiv = document.getElementById('step-' + currentStep);
            
            // Cek Input Kosong
            const requiredInputs = currentStepDiv.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value || input.value.trim() === "") {
                    isValid = false;
                    input.classList.add('input-error');
                } else {
                    input.classList.remove('input-error');
                }
                input.addEventListener('input', function() {
                    if(this.value.trim() !== "") this.classList.remove('input-error');
                });
            });

            // Blokir jika Email Merah (Step 1)
            if (currentStep === 1) {
                if (!document.getElementById('error_email').classList.contains('hidden')) {
                    isValid = false;
                    Swal.fire({ icon: 'warning', title: 'Email Terpakai', text: 'Mohon gunakan email lain.', confirmButtonColor: '#102C54' });
                }
            }

            if (isValid) showStep(targetStep);
            else Swal.fire({ icon: 'warning', title: 'Lengkapi Data', text: 'Mohon isi semua kolom bertanda (*).', confirmButtonColor: '#102C54' });
        }

        function prevStep(step) { showStep(step); }

        // --- 2. VALIDASI NIK (FORMAT & UNIK) ---
        const nikInput = document.getElementById('pic_ktp_number');
        const nikError = document.getElementById('error_nik');
        const nikExistError = document.getElementById('error_nik_exist');

        // Logic saat ngetik (Hanya Angka)
        nikInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 0 && this.value.length !== 16) {
                this.classList.add('input-error');
                nikError.classList.remove('hidden');
            } else {
                this.classList.remove('input-error');
                nikError.classList.add('hidden');
            }
            nikExistError.classList.add('hidden'); // Reset pesan duplikat saat edit
        });

        // --- 3. AJAX CHECK UNIQUE (NIK & EMAIL) ---
        function checkUnique(type, value, errorId) {
            if (!value) return;
            if (type === 'nik' && value.length !== 16) return;

            fetch('/check-unique', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ type: type, value: value })
            })
            .then(response => response.json())
            .then(data => {
                const errorElement = document.getElementById(errorId);
                const inputElement = (type === 'email') ? document.getElementById('pic_email') : document.getElementById('pic_ktp_number');

                if (data.exists) {
                    errorElement.classList.remove('hidden');
                    inputElement.classList.add('input-error');
                } else {
                    errorElement.classList.add('hidden');
                    inputElement.classList.remove('input-error');
                    inputElement.classList.add('input-success'); 
                }
            })
            .catch(err => console.log('Check unique failed:', err));
        }

        function syncData() {
            document.getElementById('user_name').value = document.getElementById('pic_name').value;
            document.getElementById('user_email').value = document.getElementById('pic_email').value;
        }

        function previewFile(input, labelId, boxId) {
            if (input.files && input.files[0]) {
                document.getElementById(labelId).classList.remove('hidden');
                document.getElementById(labelId).innerText = "File: " + input.files[0].name;
                if(boxId) document.getElementById(boxId).classList.remove('border-red-500', 'bg-red-50', 'input-error');
            }
        }

        // --- 4. FINAL SUBMIT (MENGGUNAKAN AJAX & FORM DATA) ---
        document.getElementById('sellerForm').addEventListener('submit', function(e) {
            e.preventDefault(); // 1. Mencegah Reload Halaman

            let isValid = true;
            
            // Cek File Required
            document.querySelectorAll('input[type="file"][required]').forEach(input => {
                if (input.files.length === 0) {
                    isValid = false;
                    // Tambahkan indikator error visual pada box file
                    if(input.id === 'pic_photo') document.getElementById('box_pic_photo').classList.add('border-red-500', 'bg-red-50');
                    if(input.id === 'pic_ktp_file') document.getElementById('box_pic_ktp').classList.add('border-red-500', 'bg-red-50');
                }
            });
            
            // Cek NIK & Email Error
            if (!nikExistError.classList.contains('hidden') || 
                !document.getElementById('error_email').classList.contains('hidden') || 
                nikInput.value.length !== 16) {
                isValid = false;
            }

            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validasi Gagal',
                    text: 'Pastikan data lengkap, NIK 16 digit, dan file foto sudah diupload.',
                    confirmButtonColor: '#102C54'
                });
                return;
            }

            // Tampilkan Loading
            Swal.fire({
                title: 'Sedang Memproses...',
                text: 'Mohon tunggu, data dan file sedang diupload.',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            // 2. Siapkan Data Form (Termasuk Gambar)
            let formData = new FormData(this);

            // 3. Kirim AJAX
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    
                }
            })
            .then(response => {
                // Kita anggap sukses (karena request "semua regist pasti berhasil")
                if (response.ok) {
                    return response; // Bisa response.json() jika backend return JSON
                }
                // Jika error server, tetap throw agar masuk catch
                throw new Error('Gagal menghubungi server');
            })
            .then(() => {
                // 4. POPUP SUKSES
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil!',
                    text: 'Toko Anda telah terdaftar. Silakan login untuk melanjutkan.',
                    confirmButtonText: 'Ke Halaman Login',
                    confirmButtonColor: '#102C54',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal mengirim data. Silakan coba lagi.',
                    confirmButtonColor: '#102C54'
                });
            });
        });

        // --- 5. API WILAYAH (Tetap Sama) ---
        const baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';
        fetch(baseUrl + '/provinces.json').then(r=>r.json()).then(d=>{
            let o='<option value="">Pilih Provinsi...</option>'; d.forEach(p=>o+=`<option value="${p.id}" data-name="${p.name}">${p.name}</option>`);
            document.getElementById('select_province').innerHTML=o;
        });
        function loadRegencies(id){
            document.getElementById('input_province').value = document.getElementById('select_province').selectedOptions[0].dataset.name;
            document.getElementById('select_regency').disabled=false;
            fetch(`${baseUrl}/regencies/${id}.json`).then(r=>r.json()).then(d=>{
                let o='<option value="">Pilih Kota...</option>'; d.forEach(r=>o+=`<option value="${r.id}" data-name="${r.name}">${r.name}</option>`);
                document.getElementById('select_regency').innerHTML=o;
            });
        }
        function loadDistricts(id){
            document.getElementById('input_regency').value = document.getElementById('select_regency').selectedOptions[0].dataset.name;
            document.getElementById('select_district').disabled=false;
            fetch(`${baseUrl}/districts/${id}.json`).then(r=>r.json()).then(d=>{
                let o='<option value="">Pilih Kec...</option>'; d.forEach(x=>o+=`<option value="${x.id}" data-name="${x.name}">${x.name}</option>`);
                document.getElementById('select_district').innerHTML=o;
            });
        }
        function loadVillages(id){
            document.getElementById('select_village').disabled=false;
            fetch(`${baseUrl}/villages/${id}.json`).then(r=>r.json()).then(d=>{
                let o='<option value="">Pilih Kel...</option>'; d.forEach(x=>o+=`<option value="${x.id}" data-name="${x.name}">${x.name}</option>`);
                document.getElementById('select_village').innerHTML=o;
            });
        }
        function updateVillageName(el){document.getElementById('input_village').value=el.selectedOptions[0].dataset.name;}
    </script>
</body>
</html>