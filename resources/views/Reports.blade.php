<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Laporan</title>
    <!-- Memuat font Poppins dari Google Fonts untuk tampilan modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN untuk tata letak yang responsif dan rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon yang user-friendly -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
    </style>
</head>
<body class="bg-soft text-dark">

    <div class="container mx-auto p-4 sm:p-8">

        <!-- Header Utama -->
        <h1 class="text-3xl font-bold mb-8">Manajemen Laporan</h1>

        <!-- Tata letak dua kolom untuk desktop, menumpuk pada mobile -->
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Kolom Kiri: Input Laporan -->
            <div class="lg:w-1/3">
                <div class="card-bg p-6 rounded-xl shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Input Laporan Baru</h2>
                    <form id="reportForm">
                        <!-- Input Judul Laporan -->
                        <div class="mb-4">
                            <label for="reportTitle" class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                            <input type="text" id="reportTitle" name="reportTitle" placeholder="Misal: Laporan Harian Proyek 'Gemini'"
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        </div>

                        <!-- Input Tanggal Laporan -->
                        <div class="mb-4">
                            <label for="reportDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" id="reportDate" name="reportDate"
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        </div>
                        
                        <!-- Input Isi Laporan -->
                        <div class="mb-4">
                            <label for="reportContent" class="block text-sm font-medium text-gray-700 mb-1">Isi Laporan</label>
                            <textarea id="reportContent" name="reportContent" rows="8" placeholder="Tulis detail laporan dan hasil pekerjaan di sini..."
                                class="w-full px-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200"></textarea>
                        </div>
                        
                        <!-- Tombol Aksi Form -->
                        <div class="flex flex-col sm:flex-row gap-2 mt-6">
                            <!-- Tombol Simpan Laporan -->
                            <button type="submit" id="submitReportBtn" class="w-full sm:w-1/2 bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Simpan Laporan
                            </button>
                            <!-- Tombol Export Laporan Baru -->
                            <button type="button" id="exportReportBtn" class="w-full sm:w-1/2 bg-gray-200 text-gray-800 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                                <i class="fas fa-file-download mr-2"></i> Export Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Riwayat Laporan & Log Kerja -->
            <div class="lg:w-2/3">
                <div class="card-bg p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Riwayat Laporan & Log Kerja</h2>
                        <!-- Tombol Export Laporan -->
                        <button class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition-opacity duration-200">
                            <i class="fas fa-file-export mr-2"></i> Export Laporan
                        </button>
                    </div>

                    <!-- Filter atau Pencarian Riwayat Laporan -->
                    <div class="relative mb-4">
                        <input type="text" placeholder="Cari laporan atau log..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-light focus:ring-1 focus:ring-primary focus:border-primary transition-colors duration-200">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray"></i>
                    </div>

                    <!-- Daftar Riwayat Laporan -->
                    <div id="reportHistoryList" class="space-y-4">
                        <!-- Konten laporan akan dirender di sini oleh JavaScript -->
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
            <p id="panelContent"></p>
        </div>
        
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
                date: '14 Agustus 2025',
                content: `Melakukan koordinasi tim untuk menentukan prioritas sprint berikutnya. Tim berhasil menyelesaikan 90% tugas yang ditargetkan dan mengatasi bug kritis pada modul pembayaran.`,
                created_at: '2025-08-14T10:00:00Z',
                updated_at: '2025-08-14T10:00:00Z'
            },
            {
                id: 2,
                title: 'Laporan Harian - Perbaikan Bug',
                date: '13 Agustus 2025',
                content: `Fokus pada perbaikan bug pada fitur login yang dilaporkan oleh user. Bug berhasil diidentifikasi dan diperbaiki. Rilis patch sudah dijadwalkan untuk besok pagi.`,
                created_at: '2025-08-13T17:30:00Z',
                updated_at: '2025-08-13T18:00:00Z'
            },
            {
                id: 3,
                title: 'Laporan Progress Desain UI/UX',
                date: '10 Agustus 2025',
                content: `Penyelesaian mockup desain untuk halaman profil pengguna dan halaman dashboard. Tim akan melanjutkan dengan fase prototipe interaktif minggu depan.`,
                created_at: '2025-08-10T09:15:00Z',
                updated_at: '2025-08-10T09:15:00Z'
            },
        ];

        // Mendapatkan elemen DOM
        const reportForm = document.getElementById('reportForm');
        const reportTitleInput = document.getElementById('reportTitle');
        const reportDateInput = document.getElementById('reportDate');
        const reportContentInput = document.getElementById('reportContent');
        const reportHistoryList = document.getElementById('reportHistoryList');
        const reportPanel = document.getElementById('reportPanel');
        const backdrop = document.getElementById('backdrop');
        const closePanelBtn = document.getElementById('closePanelBtn');
        const panelTitle = document.getElementById('panelTitle');
        const panelDate = document.getElementById('panelDate');
        const panelContent = document.getElementById('panelContent');
        const exportReportBtn = document.getElementById('exportReportBtn');
        const notificationModal = document.getElementById('notificationModal');
        const modalIcon = document.getElementById('modalIcon');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const closeModalBtn = document.getElementById('closeModalBtn');

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

        // Event listener untuk tombol Simpan Laporan
        reportForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Mencegah form dikirim secara default

            // Validasi input
            const title = reportTitleInput.value.trim();
            const date = reportDateInput.value.trim();
            const content = reportContentInput.value.trim();

            if (!title || !date || !content) {
                showModal('<i class="fas fa-exclamation-triangle text-yellow-500"></i>', 'Validasi Gagal', 'Mohon lengkapi semua kolom sebelum mengirim laporan.');
                return;
            }

            // Simulasi pengiriman laporan
            console.log('Laporan baru dikirim:', {
                title,
                date,
                content
            });

            // Simulasi menambahkan laporan ke daftar riwayat
            const now = new Date().toISOString();
            const newReport = {
                id: reports.length + 1,
                title: title,
                date: new Date(date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }),
                content: content,
                created_at: now,
                updated_at: now
            };
            reports.unshift(newReport); // Tambahkan di awal array
            renderReports(); // Perbarui tampilan daftar laporan

            // Tampilkan notifikasi sukses
            showModal('<i class="fas fa-check-circle text-green-500"></i>', 'Berhasil', 'Laporan Anda berhasil disimpan!');

            // Bersihkan form
            reportForm.reset();
        });

        // Event listener untuk tombol Export Laporan Baru
        exportReportBtn.addEventListener('click', () => {
            const title = reportTitleInput.value.trim();
            const date = reportDateInput.value.trim();
            const content = reportContentInput.value.trim();

            if (!title || !date || !content) {
                showModal('<i class="fas fa-exclamation-triangle text-yellow-500"></i>', 'Ekspor Gagal', 'Mohon lengkapi laporan Anda terlebih dahulu sebelum mengunduhnya.');
                return;
            }

            const reportData = `Laporan: ${title}\nTanggal: ${date}\n\nIsi Laporan:\n${content}`;
            const blob = new Blob([reportData], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `laporan_${title.replace(/ /g, '_')}_${date}.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            showModal('<i class="fas fa-download text-primary"></i>', 'Unduhan Dimulai', 'Laporan Anda sedang diunduh.');
        });

        // Event listener untuk tombol tutup modal dan juga klik di luar modal
        closeModalBtn.addEventListener('click', hideModal);
        notificationModal.addEventListener('click', (e) => {
            // Periksa jika yang diklik adalah latar belakang modal, bukan kontennya
            if (e.target === notificationModal) {
                hideModal();
            }
        });

        // Fungsi untuk merender daftar laporan
        const renderReports = () => {
            reportHistoryList.innerHTML = ''; // Kosongkan daftar
            reports.forEach(report => {
                const reportDiv = document.createElement('div');
                reportDiv.className = 'bg-gray-50 p-4 rounded-lg border border-border-light flex justify-between items-center';
                reportDiv.innerHTML = `
                    <div>
                        <h3 class="font-medium text-lg">${report.title}</h3>
                        <p class="text-xs text-gray mt-1">
                            <i class="fas fa-clock mr-1"></i> Dibuat: ${new Date(report.created_at).toLocaleString('id-ID')}
                        </p>
                        <p class="text-xs text-gray mt-1">
                            <i class="fas fa-pen mr-1"></i> Diperbarui: ${new Date(report.updated_at).toLocaleString('id-ID')}
                        </p>
                    </div>
                    <button class="text-primary hover:underline font-semibold view-report-btn" data-report-id="${report.id}">
                        Lihat Detail <i class="fas fa-chevron-right ml-1 text-sm"></i>
                    </button>
                `;
                reportHistoryList.appendChild(reportDiv);
            });
        };

        // Fungsi untuk membuka panel detail laporan
        const openPanel = (reportId) => {
            const report = reports.find(r => r.id === reportId);
            if (!report) return;

            // Mengisi konten panel
            panelTitle.textContent = report.title;
            panelDate.innerHTML = `
                <strong>Tanggal Laporan:</strong> ${report.date}<br>
                <strong>Dibuat Pada:</strong> ${new Date(report.created_at).toLocaleString('id-ID')}<br>
                <strong>Diperbarui Pada:</strong> ${new Date(report.updated_at).toLocaleString('id-ID')}
            `;
            panelContent.textContent = report.content;
            
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

        // Event listener menggunakan event delegation untuk tombol "Lihat Detail"
        reportHistoryList.addEventListener('click', (e) => {
            const viewBtn = e.target.closest('.view-report-btn');
            if (viewBtn) {
                e.preventDefault();
                const reportId = parseInt(viewBtn.dataset.reportId);
                openPanel(reportId);
            }
        });

        // Panggil fungsi render saat halaman dimuat
        window.onload = renderReports;
    </script>
</body>
</html>
