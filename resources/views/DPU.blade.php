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
        }

        .btn-green {
            background-color: #22c55e;
        }

        .btn-green:hover:not(:disabled) {
            background-color: #16a34a;
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
            border-color: #4c51bf;
            box-shadow: 0 0 0 2px rgba(76, 81, 191, 0.2);
        }

        .input-field:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }

        /* Styling untuk transisi hover */
        .hover-transition {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }

        @media (max-width: 768px) {
            .container-grid {
                flex-direction: column;
            }
            .card-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Modal untuk pesan sukses -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2" id="successModalTitle">Success</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="successModalMessage">Berhasil masuk!</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeSuccessModal" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk pesan peringatan -->
    <div id="warningModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.287 0 1.933-1.464 1.287-2.5l-6.928-12c-.646-1.036-1.928-1.036-2.574 0l-6.928 12c-.646 1.036.001 2.5 1.287 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2" id="warningModalTitle">Peringatan!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="warningModalMessage">Harap isi form terlebih dahulu.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeWarningModal" class="px-4 py-2 bg-yellow-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 md:p-10">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Presensi</h1>
            <div class="flex items-center space-x-2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
        </header>

        <div class="container-grid flex flex-col md:flex-row gap-6">
            <!-- Form Presensi -->
            <div class="card card-section w-full md:w-3/5 p-6 space-y-6">
                <h2 class="text-xl font-semibold text-gray-700">Present User</h2>
                <form id="presensiForm" class="space-y-4">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan</label>
                        <input type="text" id="judul" name="judul" class="input-field" placeholder="Input Kegiatan Baru">
                    </div>
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="text" id="tanggal" name="tanggal" class="input-field" placeholder="dd/mm/yyyy">
                    </div>
                    <div>
                        <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-1">Lampiran (URL)</label>
                        <input type="text" id="lampiran" name="lampiran" class="input-field" placeholder="Masukan link atau URL project">
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Laporan dan kegiatan</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="input-field" placeholder="Tuliskan detail kegiatan hari ini ..."></textarea>
                    </div>
                    <button type="submit" id="simpanBtn" class="btn btn-gray w-full">Simpan</button>
                </form>
            </div>

            <!-- Bagian Clock In/Out -->
            <div class="card-section w-full md:w-2/5 flex flex-col gap-6">
                <!-- Clock In -->
                <div class="card p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700">Clock In/Out</h2>
                    <p class="text-sm text-gray-500">Manage your daily attendance</p>
                    <p id="currentTimeIn" class="text-2xl font-bold text-gray-800">--:--:--</p>
                    <p class="text-sm text-gray-500">Waktu Sekarang</p>
                    <button id="presensiMasuk" class="btn btn-gray w-full hover-transition">Presensi Masuk</button>
                    <p class="text-center text-sm text-gray-600">Welcome, John Doe</p>
                </div>
                <!-- Clock Out -->
                <div class="card p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700">Clock In/Out</h2>
                    <p class="text-sm text-gray-500">Manage your daily attendance</p>
                    <p id="currentTimeOut" class="text-2xl font-bold text-gray-800">--:--:--</p>
                    <p class="text-sm text-gray-500">Waktu Sekarang</p>
                    <button id="presensiPulang" class="btn btn-gray w-full hover-transition">Presensi Pulang</button>
                    <p class="text-center text-sm text-gray-600">Welcome, John Doe</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const presensiMasukBtn = document.getElementById('presensiMasuk');
            const presensiPulangBtn = document.getElementById('presensiPulang');
            const simpanBtn = document.getElementById('simpanBtn');
            const formInputs = document.querySelectorAll('.input-field');
            const currentTimeIn = document.getElementById('currentTimeIn');
            const currentTimeOut = document.getElementById('currentTimeOut');

            const successModal = document.getElementById('successModal');
            const successModalMessage = document.getElementById('successModalMessage');
            const closeSuccessModalBtn = document.getElementById('closeSuccessModal');
            
            const warningModal = document.getElementById('warningModal');
            const warningModalMessage = document.getElementById('warningModalMessage');
            const closeWarningModalBtn = document.getElementById('closeWarningModal');

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

            // Menutup modal ketika tombol Confirm/OK diklik
            closeSuccessModalBtn.addEventListener('click', () => {
                hideModal(successModal);
            });
            closeWarningModalBtn.addEventListener('click', () => {
                hideModal(warningModal);
            });
            
            // Menutup modal ketika mengklik di luar area modal
            window.addEventListener('click', (event) => {
                if (event.target === successModal) {
                    hideModal(successModal);
                }
                if (event.target === warningModal) {
                    hideModal(warningModal);
                }
            });

            function updateTime() {
                const now = new Date();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const seconds = now.getSeconds().toString().padStart(2, '0');
                const timeString = `${hours}:${minutes}:${seconds}`;

                currentTimeIn.textContent = timeString;
                currentTimeOut.textContent = timeString;

                // Logika untuk mengatur status tombol dan form
                if (hours >= 7 && hours < 12) {
                    // Waktu Presensi Masuk (07:00 - 11:59)
                    presensiMasukBtn.disabled = false;
                    presensiMasukBtn.classList.remove('btn-gray');
                    presensiMasukBtn.classList.add('btn-green');

                    presensiPulangBtn.disabled = true;
                    presensiPulangBtn.classList.remove('btn-green');
                    presensiPulangBtn.classList.add('btn-gray');

                    formInputs.forEach(input => input.disabled = true);
                    simpanBtn.disabled = true;
                    simpanBtn.classList.add('btn-gray');

                } else if (hours >= 12 && hours < 18) {
                    // Waktu Presensi Pulang (12:00 - 17:59)
                    presensiMasukBtn.disabled = true;
                    presensiMasukBtn.classList.remove('btn-green');
                    presensiMasukBtn.classList.add('btn-gray');

                    presensiPulangBtn.disabled = false;
                    presensiPulangBtn.classList.remove('btn-gray');
                    presensiPulangBtn.classList.add('btn-green');
                    
                    formInputs.forEach(input => input.disabled = false);
                    simpanBtn.disabled = false;
                    simpanBtn.classList.remove('btn-gray');

                } else {
                    // Di luar jam presensi
                    presensiMasukBtn.disabled = true;
                    presensiMasukBtn.classList.remove('btn-green');
                    presensiMasukBtn.classList.add('btn-gray');

                    presensiPulangBtn.disabled = true;
                    presensiPulangBtn.classList.remove('btn-green');
                    presensiPulangBtn.classList.add('btn-gray');

                    formInputs.forEach(input => input.disabled = true);
                    simpanBtn.disabled = true;
                    simpanBtn.classList.add('btn-gray');
                }
            }

            // Panggil fungsi saat halaman dimuat
            updateTime();

            // Panggil fungsi setiap detik untuk update otomatis
            setInterval(updateTime, 1000);
            
            // Event listener untuk tombol Presensi Masuk
            presensiMasukBtn.addEventListener('click', () => {
                showModal("Berhasil masuk!");
            });

            // Event listener untuk tombol Presensi Pulang
            presensiPulangBtn.addEventListener('click', () => {
                const judul = document.getElementById('judul').value.trim();
                const tanggal = document.getElementById('tanggal').value.trim();
                const lampiran = document.getElementById('lampiran').value.trim();
                const deskripsi = document.getElementById('deskripsi').value.trim();

                if (judul === '' || tanggal === '' || lampiran === '' || deskripsi === '') {
                    showModal("Harap isi form terlebih dahulu.", false);
                } else {
                    showModal("Terimakasih!");
                }
            });
        });
    </script>
</body>
</html>
