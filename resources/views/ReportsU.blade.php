<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kegiatan</title>
    <!-- Memuat font Poppins dari Google Fonts untuk tampilan modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN untuk tata letak yang responsif dan rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon yang user-friendly -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Mencegah scrolling pada seluruh halaman dan memastikan tinggi penuh */
        html, body {
            height: 100%;
            overflow: auto;
        }

        /* Gaya font kustom */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Palet warna kustom yang lembut, disamakan dengan Task Monitoring */
        :root {
            --color-primary: #004A9F; /* Biru gelap untuk tombol utama */
            --color-bg-soft: #F5F6FA; /* Latar belakang yang sangat terang */
            --color-text-dark: #2C2C2C; /* Teks gelap */
            --color-text-gray: #718096; /* Teks abu-abu untuk deskripsi */
            --color-border-light: #E2E8F0; /* Garis tepi yang lembut */
            --color-card-bg: #FFFFFF; /* Latar belakang kartu */
        }

        .bg-soft { background-color: var(--color-bg-soft); }
        .text-primary { color: var(--color-primary); }
        .text-dark { color: var(--color-text-dark); }
        .text-gray { color: var(--color-text-gray); }
        .border-light { border-color: var(--color-border-light); }
        .card-bg { background-color: var(--color-card-bg); }

        /* Menghilangkan garis outline pada fokus */
        *:focus {
            outline: none;
            box-shadow: none;
        }

        /* Gaya untuk panel slide-in/slide-out dari sisi kanan */
        .slide-panel {
            z-index: 50; /* Pastikan panel berada di atas konten lain */
            transition: transform 0.5s ease-in-out;
            transform: translateX(100%);
        }
        .slide-panel.open {
            transform: translateX(0);
        }

        /* Gaya untuk latar belakang buram saat panel terbuka */
        .backdrop {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 40; /* Di bawah panel, di atas konten utama */
        }

        /* Gaya untuk modal notifikasi */
        .modal-container {
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        /* Gaya tambahan untuk tabel responsif */
        .report-table th, .report-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--color-border-light);
        }
        .report-table th {
            color: var(--color-text-gray);
            font-weight: 500;
            white-space: nowrap;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }
        @media (max-width: 640px) {
            .report-table thead {
                display: none;
            }
            .report-table, .report-table tbody, .report-table tr, .report-table td {
                display: block;
                width: 100%;
            }
            .report-table tr {
                margin-bottom: 0.75rem;
                border: 1px solid var(--color-border-light);
                border-radius: 0.5rem;
            }
            .report-table td {
                text-align: right;
                position: relative;
            }
            .report-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                width: 50%;
                padding-right: 1rem;
                white-space: nowrap;
                text-align: left;
                font-weight: 600;
                color: var(--color-text-dark);
            }
        }
        /* Gaya kustom untuk efek slider */
        .filter-bar-container {
            position: relative;
        }
        .filter-slider {
            position: absolute;
            top: 4px;
            left: 4px;
            height: calc(100% - 8px);
            width: calc(100% / 3 - 8px); /* Lebar dibagi 3 tombol */
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-soft text-dark">

    <div class="container mx-auto p-4 sm:p-8">

        <!-- Header Utama -->
        <h1 class="text-3xl font-bold mb-8">Manajemen Kegiatan</h1>

        <!-- Tata letak dua kolom untuk desktop, menumpuk pada mobile -->
        <div class="flex flex-col lg:flex-row gap-6 h-full">

            <!-- Kolom Kiri: Input Laporan -->
            <div class="lg:w-1/3">
                <div class="card-bg p-6 rounded-xl shadow-lg sticky top-8 h-fit">
                    <h2 class="text-xl font-semibold mb-4">Input Kegiatan Baru</h2>
                    <form id="reportForm">
                        <!-- Input Judul Laporan -->
                        <div class="mb-4">
                            <label for="reportTitle" class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan</label>
                            <input type="text" id="reportTitle" name="reportTitle" placeholder="Misal: Rapat Proyek"
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        </div>

                        <!-- Input Tanggal Laporan -->
                        <div class="mb-4">
                            <label for="reportDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" id="reportDate" name="reportDate"
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        </div>

                        <!-- Input Lampiran Vendor (URL) -->
                        <div class="mb-4">
                            <label for="reportAttachment" class="block text-sm font-medium text-gray-700 mb-1">Lampiran Vendor (URL)</label>
                            <input type="url" id="reportAttachment" name="reportAttachment" placeholder="Misal: https://drive.google.com/file..."
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        </div>
                        
                        <!-- Input Isi Laporan (ukuran baris dikurangi menjadi 4) -->
                        <div class="mb-4">
                            <label for="reportContent" class="block text-sm font-medium text-gray-700 mb-1">Isi Laporan</label>
                            <textarea id="reportContent" name="reportContent" rows="4" placeholder="Tulis detail kegiatan dan hasil pekerjaan di sini..."
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200"></textarea>
                        </div>
                        
                        <!-- Tombol Aksi Form -->
                        <div class="flex flex-col sm:flex-row gap-2 mt-6">
                            <!-- Tombol Simpan Laporan -->
                            <button type="submit" id="submitReportBtn" class="w-full sm:w-1/2 bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Simpan Kegiatan
                            </button>
                            <!-- Tombol Export Laporan Baru -->
                            <button type="button" id="exportReportBtn" class="w-full sm:w-1/2 bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                                <i class="fas fa-file-download mr-2"></i> Export Kegiatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Riwayat Laporan & Log Kerja -->
            <div class="lg:w-2/3 flex flex-col">
                <div class="card-bg p-6 rounded-xl shadow-lg flex-1 overflow-y-auto">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4 sm:gap-0">
                        <h2 class="text-xl font-semibold">Riwayat Kegiatan</h2>
                        <div class="flex gap-2 w-full sm:w-auto mt-4 sm:mt-0">
                            <!-- Bilah Pilihan Filter -->
                           <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Filter Bar</title>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .dropdown-menu {
            transition: all 0.2s ease-in-out;
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: none;
        }

        .dropdown-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-start justify-center p-8">
    <div class="container mx-auto">
        <!-- Filter Bar Container -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Dropdown</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }
        .dropdown-menu {
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
        .dropdown-menu.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<div id="filterBar" class="flex flex-col sm:flex-row p-1 rounded-xl w-full sm:w-auto items-center justify-between">
    <!-- Date Range Dropdown -->
    <div id="dateDropdownContainer" class="relative">
        <div id="dateDropdownTrigger" class="flex items-center bg-white rounded-xl px-4 py-2 text-sm font-semibold m-1 sm:m-2 cursor-pointer transition-transform duration-200 hover:scale-105 shadow-sm">
            <i class="fas fa-calendar-alt text-gray-500 mr-2"></i>
            <span id="dateRangeText" class="text-gray-800 whitespace-nowrap">Oct 17 - Dec 18</span>
            <i class="fas fa-caret-down text-gray-500 ml-2"></i>
        </div>
        <!-- Dropdown Menu for Date Range -->
        <div id="dateDropdownMenu" class="dropdown-menu absolute z-10 top-full left-0 mt-2 w-48 bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 text-xs text-gray-500 border-b">Select a date range</div>
            <ul class="py-1">
                <li><a href="#" data-range="This Week" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">This Week</a></li>
                <li><a href="#" data-range="This Month" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">This Month</a></li>
                <li><a href="#" data-range="Last Month" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Last Month</a></li>
                <li><a href="#" data-range="Oct 17 - Dec 18" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Custom Range</a></li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Pastikan DOM sudah dimuat sebelum menjalankan skrip
    document.addEventListener('DOMContentLoaded', () => {
        // Mendapatkan elemen-elemen yang diperlukan dari DOM
        const dateDropdownTrigger = document.getElementById('dateDropdownTrigger');
        const dateDropdownMenu = document.getElementById('dateDropdownMenu');
        const dateRangeText = document.getElementById('dateRangeText');
        const dateRangeLinks = dateDropdownMenu.querySelectorAll('a');

        // Fungsi untuk mengaktifkan/menonaktifkan tampilan dropdown
        function toggleDropdown() {
            dateDropdownMenu.classList.toggle('show');
        }

        // Menambahkan event listener ke trigger dropdown untuk mengaktifkan toggleDropdown
        dateDropdownTrigger.addEventListener('click', (event) => {
            event.stopPropagation(); // Mencegah klik menyebar ke elemen lain
            toggleDropdown();
        });

        // Menambahkan event listener ke setiap link di dalam dropdown
        dateRangeLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Mencegah tautan untuk navigasi
                const selectedRange = event.target.dataset.range; // Mendapatkan nilai dari atribut data-range
                dateRangeText.textContent = selectedRange; // Mengubah teks pada trigger
                toggleDropdown(); // Menyembunyikan dropdown setelah link diklik
            });
        });

        // Menambahkan event listener ke seluruh dokumen untuk menyembunyikan dropdown saat klik di luar area
        document.addEventListener('click', (event) => {
            // Jika klik terjadi di luar container dropdown, maka sembunyikan dropdown
            if (!dateDropdownMenu.contains(event.target) && !dateDropdownTrigger.contains(event.target)) {
                if (dateDropdownMenu.classList.contains('show')) {
                    toggleDropdown();
                }
            }
        });
    });
</script>

</body>
    </div>
    <script>
        // DOM element references
        const dateDropdownTrigger = document.getElementById('dateDropdownTrigger');
        const dateDropdownMenu = document.getElementById('dateDropdownMenu');
        const dateRangeText = document.getElementById('dateRangeText');
        const frequencyDropdownTrigger = document.getElementById('frequencyDropdownTrigger');
        const frequencyDropdownMenu = document.getElementById('frequencyDropdownMenu');
        const frequencyText = document.getElementById('frequencyText');
        const filterButton = document.getElementById('filterButton');
        const selectedFiltersDisplay = document.getElementById('selectedFilters');

        // State variables to hold the selected values
        let selectedDateRange = dateRangeText.textContent;
        let selectedFrequency = frequencyText.textContent;

        // Function to toggle dropdown menus
        const toggleDropdown = (menu, trigger) => {
            // Close other dropdown if it's open
            if (menu === dateDropdownMenu && frequencyDropdownMenu.classList.contains('active')) {
                frequencyDropdownMenu.classList.remove('active');
            } else if (menu === frequencyDropdownMenu && dateDropdownMenu.classList.contains('active')) {
                dateDropdownMenu.classList.remove('active');
            }
            menu.classList.toggle('active');
        };

        // Event listener for the date range dropdown trigger
        dateDropdownTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown(dateDropdownMenu, dateDropdownTrigger);
        });

        // Event listener for the frequency dropdown trigger
        frequencyDropdownTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown(frequencyDropdownMenu, frequencyDropdownTrigger);
        });

        // Event listener to handle clicks within the date dropdown menu
        dateDropdownMenu.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedLink = e.target.closest('a');
            if (selectedLink) {
                selectedDateRange = selectedLink.dataset.range;
                dateRangeText.textContent = selectedDateRange;
                dateDropdownMenu.classList.remove('active');
            }
        });

        // Event listener to handle clicks within the frequency dropdown menu
        frequencyDropdownMenu.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedLink = e.target.closest('a');
            if (selectedLink) {
                selectedFrequency = selectedLink.dataset.frequency;
                frequencyText.textContent = selectedFrequency;
                frequencyDropdownMenu.classList.remove('active');
            }
        });

        // Event listener for the "Filter" button
        filterButton.addEventListener('click', () => {
            // Update the display area with the selected filters
            const filterInfo = `Date: "${selectedDateRange}", Frequency: "${selectedFrequency}"`;
            selectedFiltersDisplay.textContent = filterInfo;

            // Log the selected values to the console
            console.log('Filters applied:', {
                dateRange: selectedDateRange,
                frequency: selectedFrequency
            });
        });

        // Close dropdowns when clicking outside
        window.addEventListener('click', () => {
            dateDropdownMenu.classList.remove('active');
            frequencyDropdownMenu.classList.remove('active');
        });
    </script>
</body>
</html>

                        </div>
                    </div>

                    <!-- Filter atau Pencarian Riwayat Laporan -->
                    <div class="relative mb-4">
                        <input type="text" id="searchInput" placeholder="Cari kegiatan atau log..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray"></i>
                    </div>

                    <!-- Daftar Riwayat Laporan dalam bentuk tabel -->
                    <!-- Container baru yang membuatnya bisa di-scroll secara independen -->
                    <div class="overflow-y-auto max-h-[60vh]">
                        <div class="overflow-x-auto">
                            <table id="reportHistoryList" class="report-table">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="rounded-l-lg">Judul Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Progress</th>
                                        <th class="rounded-r-lg">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Konten laporan akan dirender di sini oleh JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Backdrop untuk memburamkan konten utama saat panel terbuka -->
    <div id="backdrop" class="backdrop fixed inset-0 hidden"></div>

    <!-- Panel Detail Laporan (tersembunyi secara default) -->
    <div id="reportPanel" class="slide-panel fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-lg p-6 overflow-y-auto">
        <!-- Tombol Tutup -->
        <button id="closePanelBtn" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <h2 id="panelTitle" class="text-xl font-bold mb-2"></h2>
        <p id="panelDate" class="text-sm text-gray-500 mb-4"></p>
        
        <div class="prose max-w-none text-dark">
            <p id="panelContent" class="mb-4"></p>
            <div id="panelAttachment" class="mt-4 border-t border-light pt-4 hidden">
                <h4 class="font-semibold text-sm mb-1">Lampiran Vendor</h4>
                <a id="attachmentLink" href="#" target="_blank" class="text-primary hover:underline break-words text-sm"></a>
            </div>
        </div>
        
        <!-- Tombol Edit di panel detail -->
        <button id="editPanelBtn" class="mt-6 w-full bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
            <i class="fas fa-edit mr-2"></i> Edit Kegiatan
        </button>
    </div>

    <!-- Modal Notifikasi (tersembunyi secara default) -->
    <div id="notificationModal" class="modal-container fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 hidden">
        <div class="bg-white rounded-lg p-8 max-w-sm w-full text-center">
            <div id="modalIcon" class="mb-4 text-3xl"></div>
            <h3 id="modalTitle" class="text-xl font-semibold mb-2"></h3>
            <p id="modalMessage" class="text-gray-600 mb-6"></p>
            <button id="closeModalBtn" class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90">Tutup</button>
        </div>
    </div>

    <script>
        // Data laporan dummy (untuk simulasi)
        const reports = [
            {
                id: 1,
                title: 'Laporan Mingguan Proyek Alpha',
                date: '2025-08-14',
                content: `Melakukan koordinasi tim untuk menentukan prioritas sprint berikutnya. Tim berhasil menyelesaikan 90% tugas yang ditargetkan dan mengatasi bug kritis pada modul pembayaran.`,
                attachmentUrl: 'https://www.google.com/docs/lampiran_proyek_alpha.pdf',
                progress: 75,
                created_at: '2025-08-14T10:00:00Z',
                updated_at: '2025-08-14T10:00:00Z'
            },
            {
                id: 2,
                title: 'Laporan Harian - Perbaikan Bug',
                date: '2025-08-13',
                content: `Fokus pada perbaikan bug pada fitur login yang dilaporkan oleh user. Bug berhasil diidentifikasi dan diperbaiki. Rilis patch sudah dijadwalkan untuk besok pagi.`,
                attachmentUrl: '',
                progress: 100,
                created_at: '2025-08-13T17:30:00Z',
                updated_at: '2025-08-13T18:00:00Z'
            },
            {
                id: 3,
                title: 'Laporan Progress Desain UI/UX',
                date: '2025-08-10',
                content: `Penyelesaian mockup desain untuk halaman profil pengguna dan halaman dashboard. Tim akan melanjutkan dengan fase prototipe interaktif minggu depan.`,
                attachmentUrl: 'https://www.google.com/docs/desain_uiux.zip',
                progress: 50,
                created_at: '2025-08-10T09:15:00Z',
                updated_at: '2025-08-10T09:15:00Z'
            },
            {
                id: 4,
                title: 'Rapat Tim Harian',
                date: '2025-08-16',
                content: `Melakukan daily stand-up meeting untuk sinkronisasi progress pekerjaan harian.`,
                attachmentUrl: '',
                progress: 20,
                created_at: new Date().toISOString(),
                updated_at: new Date().toISOString()
            },
        ];

        // Mendapatkan elemen DOM
        const reportForm = document.getElementById('reportForm');
        const reportTitleInput = document.getElementById('reportTitle');
        const reportDateInput = document.getElementById('reportDate');
        const reportContentInput = document.getElementById('reportContent');
        const reportAttachmentInput = document.getElementById('reportAttachment');
        const reportHistoryList = document.getElementById('reportHistoryList').querySelector('tbody');
        const reportPanel = document.getElementById('reportPanel');
        const backdrop = document.getElementById('backdrop');
        const closePanelBtn = document.getElementById('closePanelBtn');
        const editPanelBtn = document.getElementById('editPanelBtn');
        const panelTitle = document.getElementById('panelTitle');
        const panelDate = document.getElementById('panelDate');
        const panelContent = document.getElementById('panelContent');
        const panelAttachment = document.getElementById('panelAttachment');
        const attachmentLink = document.getElementById('attachmentLink');
        const submitReportBtn = document.getElementById('submitReportBtn');
        const exportReportBtn = document.getElementById('exportReportBtn');
        const notificationModal = document.getElementById('notificationModal');
        const modalIcon = document.getElementById('modalIcon');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const filterBar = document.getElementById('filterBar');
        const filterSlider = document.getElementById('filterSlider');
        const filterButtons = document.querySelectorAll('#filterBar button');
        const searchInput = document.getElementById('searchInput');

        let activeFilter = 'all';
        let currentEditingReportId = null; // ID laporan yang sedang diedit

        // Fungsi untuk menampilkan modal
        const showModal = (icon, title, message) => {
            modalIcon.innerHTML = icon;
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            notificationModal.classList.remove('hidden');
        };

        // Fungsi untuk menyembunyikan modal
        const hideModal = () => {
            notificationModal.classList.add('hidden');
        };

        // Fungsi untuk mendapatkan kelas warna Tailwind berdasarkan persentase
        const getProgressColorClass = (progress) => {
            if (progress >= 76) return 'bg-green-500';
            if (progress >= 51) return 'bg-blue-500';
            if (progress >= 26) return 'bg-yellow-500';
            return 'bg-red-500';
        };

        // Fungsi untuk mereset form ke mode input baru
        const resetForm = () => {
            reportForm.reset();
            submitReportBtn.innerHTML = `<i class="fas fa-save mr-2"></i> Simpan Kegiatan`;
            currentEditingReportId = null;
        };

        // Event listener untuk tombol Simpan/Perbarui Laporan
        reportForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Mencegah form dikirim secara default

            // Validasi input
            const title = reportTitleInput.value.trim();
            const date = reportDateInput.value.trim();
            const content = reportContentInput.value.trim();
            const attachment = reportAttachmentInput.value.trim();

            if (!title || !date || !content) {
                showModal('<i class="fas fa-exclamation-triangle text-yellow-500"></i>', 'Validasi Gagal', 'Mohon lengkapi Judul, Tanggal, dan Isi Kegiatan.');
                return;
            }

            // Jika dalam mode edit
            if (currentEditingReportId) {
                const reportIndex = reports.findIndex(r => r.id === currentEditingReportId);
                if (reportIndex !== -1) {
                    reports[reportIndex].title = title;
                    reports[reportIndex].date = date;
                    reports[reportIndex].content = content;
                    reports[reportIndex].attachmentUrl = attachment;
                    reports[reportIndex].updated_at = new Date().toISOString();
                    showModal('<i class="fas fa-check-circle text-green-500"></i>', 'Berhasil', 'Kegiatan berhasil diperbarui!');
                }
            } else { // Jika mode input baru
                const now = new Date();
                const newReport = {
                    id: reports.length > 0 ? Math.max(...reports.map(r => r.id)) + 1 : 1,
                    title: title,
                    date: date,
                    content: content,
                    attachmentUrl: attachment,
                    progress: 50, // Progres default untuk laporan baru
                    created_at: now.toISOString(),
                    updated_at: now.toISOString()
                };
                reports.unshift(newReport);
                showModal('<i class="fas fa-check-circle text-green-500"></i>', 'Berhasil', 'Kegiatan Anda berhasil disimpan!');
            }
            
            renderReports(activeFilter, searchInput.value);
            resetForm();
        });

        // Event listener untuk tombol Export Laporan Baru
        exportReportBtn.addEventListener('click', () => {
            const title = reportTitleInput.value.trim();
            const date = reportDateInput.value.trim();
            const content = reportContentInput.value.trim();
            const attachment = reportAttachmentInput.value.trim();

            if (!title || !date || !content) {
                showModal('<i class="fas fa-exclamation-triangle text-yellow-500"></i>', 'Ekspor Gagal', 'Mohon lengkapi kegiatan Anda terlebih dahulu sebelum mengunduhnya.');
                return;
            }

            let reportData = `Laporan Kegiatan: ${title}\nTanggal: ${date}\n\nIsi Kegiatan:\n${content}`;
            if (attachment) {
                reportData += `\n\nLampiran Vendor:\n${attachment}`;
            }

            const blob = new Blob([reportData], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `kegiatan_${title.replace(/ /g, '_')}_${date}.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            showModal('<i class="fas fa-download text-primary"></i>', 'Unduhan Dimulai', 'Kegiatan Anda sedang diunduh.');
        });

        // Event listener untuk tombol tutup modal dan juga klik di luar modal
        closeModalBtn.addEventListener('click', hideModal);
        notificationModal.addEventListener('click', (e) => {
            // Periksa jika yang diklik adalah latar belakang modal, bukan kontennya
            if (e.target === notificationModal) {
                hideModal();
            }
        });
        
        // Fungsi untuk memperbarui tampilan tombol filter dan slider
        const updateFilterButtons = (activeFilter) => {
            // Mengubah warna teks semua tombol
            filterButtons.forEach(btn => {
                if (btn.dataset.filter === activeFilter) {
                    btn.classList.add('text-dark');
                    btn.classList.remove('text-gray-500');
                } else {
                    btn.classList.add('text-gray-500');
                    btn.classList.remove('text-dark');
                }
            });

            // Menggerakkan slider
            const activeIndex = Array.from(filterButtons).findIndex(btn => btn.dataset.filter === activeFilter);
            const translateXValue = activeIndex * 100; // 0% untuk All, 100% untuk Weekly, 200% untuk Daily
            filterSlider.style.transform = `translateX(${translateXValue}%)`;
        };

        // Event listener untuk bilah filter (menggunakan event delegation)
        filterBar.addEventListener('click', (e) => {
            const button = e.target.closest('button');
            if (button) {
                activeFilter = button.dataset.filter;
                updateFilterButtons(activeFilter);
                renderReports(activeFilter, searchInput.value);
            }
        });
        
        // Fungsi untuk merender daftar laporan
        const renderReports = (filter = 'all', searchTerm = '') => {
            reportHistoryList.innerHTML = ''; // Kosongkan daftar
            
            let filteredReports = [...reports];

            // Terapkan filter berdasarkan pilihan
            const now = new Date();
            if (filter === 'weekly') {
                const oneWeekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                filteredReports = filteredReports.filter(report => new Date(report.created_at) >= oneWeekAgo);
            } else if (filter === 'daily') {
                const oneDayAgo = new Date(now.getTime() - 24 * 60 * 60 * 1000);
                filteredReports = filteredReports.filter(report => new Date(report.created_at) >= oneDayAgo);
            }

            // Terapkan filter pencarian
            if (searchTerm) {
                const lowerCaseSearchTerm = searchTerm.toLowerCase();
                filteredReports = filteredReports.filter(report =>
                    report.title.toLowerCase().includes(lowerCaseSearchTerm) ||
                    report.content.toLowerCase().includes(lowerCaseSearchTerm)
                );
            }

            if (filteredReports.length === 0) {
                const noResultRow = document.createElement('tr');
                noResultRow.innerHTML = `<td colspan="4" class="text-center text-gray-500 py-8">Tidak ada kegiatan yang ditemukan.</td>`;
                reportHistoryList.appendChild(noResultRow);
                return;
            }

            filteredReports.forEach(report => {
                const reportRow = document.createElement('tr');
                const progressColorClass = getProgressColorClass(report.progress);
                const formattedDate = new Date(report.date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                
                reportRow.innerHTML = `
                    <td data-label="Judul Kegiatan" class="py-4">
                        <h3 class="font-medium text-dark">${report.title}</h3>
                        <p class="text-xs text-gray mt-1">
                            <i class="fas fa-clock mr-1"></i> Dibuat: ${new Date(report.created_at).toLocaleString('id-ID')}
                        </p>
                        <p class="text-xs text-gray mt-1">
                            <i class="fas fa-sync-alt mr-1"></i> Diperbarui: ${new Date(report.updated_at).toLocaleString('id-ID')}
                        </p>
                    </td>
                    <td data-label="Tanggal">${formattedDate}</td>
                    <td data-label="Progress">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="${progressColorClass} h-2.5 rounded-full" style="width: ${report.progress}%"></div>
                        </div>
                        <span class="text-xs text-gray-500">${report.progress}% Selesai</span>
                    </td>
                    <td data-label="Aksi" class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                    <button class="text-blue-500 hover:text-blue-700 font-semibold edit-btn" data-report-id="${report.id}">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button class="text-red-500 hover:text-red-700 font-semibold delete-btn" data-report-id="${report.id}">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </td>
                `;
                reportHistoryList.appendChild(reportRow);
            });
        };

        // Event listener untuk input pencarian
        searchInput.addEventListener('input', (e) => {
            renderReports(activeFilter, e.target.value);
        });


        // Fungsi untuk membuka panel detail laporan
        const openPanel = (reportId) => {
            const report = reports.find(r => r.id === reportId);
            if (!report) return;

            // Mengisi konten panel
            panelTitle.textContent = report.title;
            panelDate.innerHTML = `
                <strong>Tanggal Kegiatan:</strong> ${new Date(report.date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}<br>
                <strong>Dibuat Pada:</strong> ${new Date(report.created_at).toLocaleString('id-ID')}<br>
                <strong>Diperbarui Pada:</strong> ${new Date(report.updated_at).toLocaleString('id-ID')}
            `;
            panelContent.textContent = report.content;
            editPanelBtn.dataset.reportId = report.id; // Menyimpan ID laporan yang sedang dilihat

            // Menampilkan lampiran jika ada
            if (report.attachmentUrl) {
                panelAttachment.classList.remove('hidden');
                attachmentLink.textContent = report.attachmentUrl;
                attachmentLink.href = report.attachmentUrl;
            } else {
                panelAttachment.classList.add('hidden');
            }
            
            // Menampilkan panel dan backdrop
            backdrop.classList.remove('hidden');
            reportPanel.classList.add('open');
        };

        // Fungsi untuk menutup panel
        const closePanel = () => {
            reportPanel.classList.remove('open');
            // Sembunyikan backdrop setelah transisi selesai
            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 500); 
        };
        
        // Event listener untuk menutup panel
        closePanelBtn.addEventListener('click', closePanel);
        backdrop.addEventListener('click', closePanel);

        // Event listener untuk tombol Edit di panel detail
        editPanelBtn.addEventListener('click', (e) => {
            const reportId = parseInt(e.target.dataset.reportId);
            const report = reports.find(r => r.id === reportId);
            if (report) {
                // Mengisi form dengan data laporan yang akan diedit
                reportTitleInput.value = report.title;
                reportDateInput.value = report.date;
                reportContentInput.value = report.content;
                reportAttachmentInput.value = report.attachmentUrl;
                
                // Menyiapkan mode edit
                currentEditingReportId = report.id;
                submitReportBtn.innerHTML = `<i class="fas fa-sync-alt mr-2"></i> Perbarui Kegiatan`;
                
                // Menutup panel detail
                closePanel();
                
                // Gulir ke atas ke form input
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });

  // Event listener untuk tombol "Edit" dan "Hapus" menggunakan event delegation
    document.addEventListener('click', (e) => {
        const editBtn = e.target.closest('.edit-btn');
        const deleteBtn = e.target.closest('.delete-btn');

        if (editBtn) {
            e.preventDefault();
            const reportId = parseInt(editBtn.dataset.reportId);
            const report = reports.find(r => r.id === reportId);
            if (report) {
                // Mengisi form dengan data laporan yang akan diedit
                reportTitleInput.value = report.title;
                reportDateInput.value = report.date;
                reportContentInput.value = report.content;
                reportAttachmentInput.value = report.attachmentUrl;
                
                // Menyiapkan mode edit
                currentEditingReportId = report.id;
                submitReportBtn.innerHTML = `<i class="fas fa-sync-alt mr-2"></i> Perbarui Kegiatan`;
                
                // Gulir ke atas ke form input
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        } else if (deleteBtn) {
            e.preventDefault();
            const reportId = parseInt(deleteBtn.dataset.reportId);
            const reportIndex = reports.findIndex(r => r.id === reportId);
            if (reportIndex > -1) {
                reports.splice(reportIndex, 1);
                renderReports(activeFilter, searchInput.value);
                showModal('<i class="fas fa-trash text-red-500"></i>', 'Berhasil Dihapus', 'Kegiatan berhasil dihapus dari daftar.');
            }
        }
    });

        // Panggil fungsi render saat halaman dimuat
        window.onload = () => {
            renderReports();
            updateFilterButtons(activeFilter); // Set state awal filter
        };
    </script>
</body>
</html>
        