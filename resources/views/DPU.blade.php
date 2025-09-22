<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Presensi VEMOS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fc;
            color: #4a5568;
            transition: background-color 0.3s ease;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn {
            color: #ffffff;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn-blue {
            background-color: #3b82f6;
        }

        .btn-blue:hover:not(:disabled) {
            background-color: #2563eb;
        }

        .btn-gray {
            background-color: #9ca3af;
            cursor: not-allowed;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .input-field:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }

        .hover-transition {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }

        .modal {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Modal untuk pesan sukses -->
    <div id="successModal" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 shadow-xl max-w-sm w-full">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl leading-6 font-bold text-gray-900 mt-4" id="successModalTitle">Success</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500" id="successModalMessage">Berhasil masuk!</p>
                </div>
                <div class="mt-4">
                    <button id="closeSuccessModal" class="px-4 py-2 bg-green-500 text-white font-medium rounded-md w-full shadow-sm hover:bg-green-700 transition-colors">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk pesan peringatan -->
    <div id="warningModal" class="modal fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 shadow-xl max-w-sm w-full">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.287 0 1.933-1.464 1.287-2.5l-6.928-12c-.646-1.036-1.928-1.036-2.574 0l-6.928 12c-.646 1.036.001 2.5 1.287 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl leading-6 font-bold text-gray-900 mt-4" id="warningModalTitle">Peringatan!</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500" id="warningModalMessage">Harap isi form terlebih dahulu.</p>
                </div>
                <div class="mt-4">
                    <button id="closeWarningModal" class="px-4 py-2 bg-yellow-500 text-white font-medium rounded-md w-full shadow-sm hover:bg-yellow-700 transition-colors">OK</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="content-area flex-1 p-6 md:p-10 mx-auto max-w-4xl w-full">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Presensi</h1>
            <div class="flex items-center space-x-4">
            </div>
        </header>

        <div class="container-grid grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Presensi -->
            <div class="card card-section md:col-span-2 p-6 space-y-6">
                <h2 class="text-xl font-semibold text-gray-700">Present User</h2>
                <form id="presensiForm" class="space-y-4">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan</label>
                        <input type="text" id="judul" name="judul" class="input-field" placeholder="Input Kegiatan Baru">
                    </div>
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <!-- Mengubah type menjadi 'date' dan menambahkan 'min' dan 'value' secara dinamis -->
                        <input type="date" id="tanggal" name="tanggal" class="input-field" placeholder="dd/mm/yyyy">
                    </div>
                    <div>
                        <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-1">Lampiran (URL)</label>
                        <input type="text" id="lampiran" name="lampiran" class="input-field" placeholder="Masukan link atau URL project">
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Laporan dan kegiatan</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="input-field" placeholder="Tuliskan detail kegiatan hari ini ..."></textarea>
                    </div>
                    <button type="button" id="simpanBtn" class="btn btn-blue w-full">Simpan</button>
                </form>
            </div>

            <!-- Bagian Clock In/Out -->
            <div class="card-section md:col-span-1 flex flex-col gap-6">
                <!-- Clock In/Out -->
                <div class="card p-6 space-y-4 h-full flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Presensi Masuk/Pulang</h2>
                        <p class="text-sm text-gray-500">Kelola absensi harian Anda</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <p id="currentTimeIn" class="text-4xl font-extrabold text-gray-800">--:--:--</p>
                        <p class="text-sm text-gray-500 mt-2">Waktu Sekarang</p>
                    </div>
                    <div class="space-y-4">
                        <button id="presensiMasukBtn" class="btn btn-blue w-full hover-transition">Presensi Masuk</button>
                        <p class="text-center text-sm text-gray-600">Selamat Datang, John Thor</p>
                        <button id="presensiPulangBtn" class="btn btn-blue w-full hover-transition hidden">Presensi Pulang</button>
                        <button id="ajukanCutiBtn" class="btn btn-blue w-full hover-transition">Ajukan Cuti</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="card mt-6 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Aktivitas Terbaru</h2>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline">detail &rarr;</a>
            </div>
            <ul id="activityList" class="space-y-4">
                <!-- Data akan ditambahkan di sini oleh JavaScript -->
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const presensiMasukBtn = document.getElementById('presensiMasukBtn');
            const presensiPulangBtn = document.getElementById('presensiPulangBtn');
            const ajukanCutiBtn = document.getElementById('ajukanCutiBtn');
            const simpanBtn = document.getElementById('simpanBtn');
            const formInputs = document.querySelectorAll('#presensiForm .input-field');
            const judulInput = document.getElementById('judul');
            const tanggalInput = document.getElementById('tanggal');
            const lampiranInput = document.getElementById('lampiran');
            const deskripsiInput = document.getElementById('deskripsi');
            const currentTimeIn = document.getElementById('currentTimeIn');
            const currentTimeOut = document.getElementById('currentTimeOut');
            const activityList = document.getElementById('activityList');
            const successModal = document.getElementById('successModal');
            const successModalMessage = document.getElementById('successModalMessage');
            const closeSuccessModalBtn = document.getElementById('closeSuccessModal');
            const warningModal = document.getElementById('warningModal');
            const warningModalMessage = document.getElementById('warningModalMessage');
            const closeWarningModalBtn = document.getElementById('closeWarningModal');
            
            let isClockedIn = false;

            // Mengatur tanggal hari ini di input tanggal
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;
            tanggalInput.value = formattedDate;
            tanggalInput.min = formattedDate;

            // Fungsi untuk menampilkan modal dengan pesan tertentu
            function showModal(message, isSuccess = true) {
                if (isSuccess) {
                    successModalMessage.textContent = message;
                    successModal.classList.remove('hidden');
                } else {
                    warningModalMessage.textContent = message;
                    warningModal.classList.remove('hidden');
                }
            }

            // Fungsi untuk menyembunyikan modal
            function hideModal(modal) {
                modal.classList.add('hidden');
            }

            // Menutup modal ketika tombol Konfirmasi/OK diklik
            closeSuccessModalBtn.addEventListener('click', () => hideModal(successModal));
            closeWarningModalBtn.addEventListener('click', () => hideModal(warningModal));
            
            // Menutup modal ketika mengklik di luar area modal
            window.addEventListener('click', (event) => {
                if (event.target === successModal) hideModal(successModal);
                if (event.target === warningModal) hideModal(warningModal);
            });

            // Fungsi untuk menambahkan aktivitas baru ke daftar
            function addActivity(judul, deskripsi, status) {
                const li = document.createElement('li');
                li.className = 'flex items-center space-x-4 p-4 rounded-lg bg-gray-50';
                
                const icon = document.createElement('div');
                icon.className = 'w-10 h-10 flex items-center justify-center rounded-full';
                if (status === 'Selesai') {
                    icon.className += ' bg-green-100 text-green-600';
                    icon.innerHTML = '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                } else {
                    icon.className += ' bg-yellow-100 text-yellow-600';
                    icon.innerHTML = '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                }
                
                const content = document.createElement('div');
                content.className = 'flex-grow';
                content.innerHTML = `<h3 class="font-semibold text-gray-800">${judul}</h3><p class="text-sm text-gray-500">${deskripsi}</p>`;
                
                const statusSpan = document.createElement('span');
                statusSpan.className = 'px-3 py-1 text-xs font-semibold rounded-full';
                if (status === 'Selesai') {
                    statusSpan.className += ' bg-green-200 text-green-800';
                } else {
                    statusSpan.className += ' bg-yellow-200 text-yellow-800';
                }
                statusSpan.textContent = status;

                li.appendChild(icon);
                li.appendChild(content);
                li.appendChild(statusSpan);
                activityList.prepend(li); // Tambahkan ke bagian atas daftar
            }

            // Contoh data aktivitas awal
            addActivity('Integrasi API', 'Selesai - 2 jam yang lalu', 'Selesai');
            addActivity('Optimisasi Database', 'Dalam Proses - 100% selesai', 'Aktif');

            function updateTime() {
                const now = new Date();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const seconds = now.getSeconds().toString().padStart(2, '0');
                const timeString = `${hours}:${minutes}:${seconds}`;

                currentTimeIn.textContent = timeString;

                // Logika untuk mengatur status tombol dan form
                if (hours >= 7 && hours < 12 && !isClockedIn) {
                    presensiMasukBtn.disabled = false;
                    presensiMasukBtn.classList.remove('btn-gray');
                    presensiMasukBtn.classList.add('btn-blue');
                } else {
                    presensiMasukBtn.disabled = true;
                    presensiMasukBtn.classList.remove('btn-blue');
                    presensiMasukBtn.classList.add('btn-gray');
                }
            }

            // Panggil fungsi saat halaman dimuat
            updateTime();
            setInterval(updateTime, 1000);

            // Event listener untuk tombol Presensi Masuk
            presensiMasukBtn.addEventListener('click', () => {
                isClockedIn = true;
                showModal("Berhasil masuk!");
                presensiMasukBtn.classList.add('hidden');
                presensiPulangBtn.classList.remove('hidden');
                ajukanCutiBtn.classList.add('hidden');
                
                formInputs.forEach(input => input.disabled = false);
                simpanBtn.disabled = false;
                simpanBtn.classList.remove('btn-gray');
                simpanBtn.classList.add('btn-blue');
            });

            // Event listener untuk tombol Presensi Pulang
            presensiPulangBtn.addEventListener('click', () => {
                isClockedIn = false;
                showModal("Terimakasih!");
                presensiPulangBtn.classList.add('hidden');
                presensiMasukBtn.classList.remove('hidden');
                ajukanCutiBtn.classList.remove('hidden');

                formInputs.forEach(input => input.disabled = true);
                simpanBtn.disabled = true;
                simpanBtn.classList.remove('btn-blue');
                simpanBtn.classList.add('btn-gray');
                
                // Reset form setelah presensi pulang
                judulInput.value = '';
                tanggalInput.value = formattedDate;
                lampiranInput.value = '';
                deskripsiInput.value = '';
            });

            // Event listener untuk tombol Simpan
            simpanBtn.addEventListener('click', () => {
                const judul = judulInput.value.trim();
                const tanggal = tanggalInput.value.trim();
                const lampiran = lampiranInput.value.trim();
                const deskripsi = deskripsiInput.value.trim();

                if (judul === '' || tanggal === '' || lampiran === '' || deskripsi === '') {
                    showModal("Harap isi form terlebih dahulu.", false);
                } else {
                    addActivity(judul, deskripsi, 'Aktif');
                    showModal("Data berhasil disimpan!");
                }
            });
        });
    </script>
</body>
</html>
