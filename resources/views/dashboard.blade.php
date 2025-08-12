<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        .modal {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease;
        }
        .modal-content {
            transform: translateY(-20px);
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }
        .modal.open .modal-content {
            transform: translateY(0);
        }
        /* Style untuk menu yang sedang aktif */
        .sidebar a.active, .sidebar a:focus {
            background-color: #EC6A28;
            color: #FFFFFF;
        }
        .sidebar a.active span, .sidebar a.active i {
            color: #FFFFFF;
        }
        /* Rotasi panah dropdown */
        .sidebar a .fa-chevron-down.rotate-180 {
            transform: rotate(180deg);
        }
        .sidebar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <!-- Perubahan utama: menambahkan overflow-y-auto ke seluruh sidebar -->
        <aside id="sidebar" class="sidebar w-64 bg-[#2D2A6C] text-white flex flex-col shadow-xl overflow-y-auto">
            <div class="p-6 flex items-center justify-center border-b border-white/10">
                <img src="https://placehold.co/150x50/ffffff/2D2A6C?text=LOGO" alt="Logo" class="h-10">
            </div>
            <!-- Navigasi Utama, kini di dalam sidebar yang bisa di-scroll -->
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" data-page="dashboard" class="sidebar-link active flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-home mr-3 text-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="task" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-tasks mr-3 text-lg"></i>
                            <span>Task</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="users-dropdown-btn" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-users mr-3 text-lg"></i>
                            <span>Users</span>
                            <i class="fas fa-chevron-down ml-auto text-sm transition-transform duration-200"></i>
                        </a>
                        <ul id="users-dropdown" class="ml-6 mt-2 space-y-1 hidden">
                            <li><a href="#" data-page="user-list" class="sidebar-link block p-2 rounded-md text-sm text-gray-300 hover:bg-[#EC6A28]/20 transition duration-200">User</a></li>
                            <li><a href="#" data-page="add-user" class="sidebar-link block p-2 rounded-md text-sm text-gray-300 hover:bg-[#EC6A28]/20 transition duration-200">Tambah User</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-page="report" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-file-alt mr-3 text-lg"></i>
                            <span>Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="presensi" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-clock mr-3 text-lg"></i>
                            <span>Presensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="list-kegiatan" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-list-check mr-3 text-lg"></i>
                            <span>List Kegiatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-page="izin" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                            <i class="fas fa-calendar-check mr-3 text-lg"></i>
                            <span>Izin</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-white/10">
                <a href="#" data-page="profile" class="sidebar-link flex items-center p-3 rounded-lg text-white font-medium hover:bg-[#EC6A28]/20 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-[#EC6A28] transition duration-200">
                    <i class="fas fa-user-circle mr-3 text-lg"></i>
                    <span>Profile</span>
                </a>
                <a href="#" data-page="logout" class="sidebar-link flex items-center p-3 mt-2 rounded-lg text-white font-medium hover:bg-red-600/50 focus:outline-none focus:ring-2 focus:ring-white/50 active:bg-red-700 transition duration-200">
                    <i class="fas fa-sign-out-alt mr-3 text-lg"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col bg-gray-100 rounded-l-2xl overflow-hidden">
            <!-- Navbar -->
            <header class="bg-white shadow-sm p-4 flex items-center justify-between">
                <h1 id="page-title" class="text-2xl font-bold text-[#2D2A6C]">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#EC6A28] transition-all">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <button class="relative p-2 text-[#2D2A6C] hover:text-[#EC6A28] transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-1 right-1 h-3 w-3 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
            </header>

            <!-- Content Container -->
            <div id="content-container" class="flex-grow p-6 overflow-y-auto">
                
                <!-- Dashboard Content -->
                <div id="dashboard" class="page-content grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="bg-white rounded-xl shadow p-6">
                            <h2 class="text-xl font-semibold mb-4 text-[#2D2A6C]">List Izin</h2>
                            <ul class="divide-y divide-gray-200">
                                <li class="py-3 flex items-center justify-between">
                                    <span>Budi Santoso mengajukan izin cuti</span>
                                    <span class="px-3 py-1 text-sm font-semibold text-orange-700 bg-orange-100 rounded-full">Pending</span>
                                </li>
                                <li class="py-3 flex items-center justify-between">
                                    <span>Siti Aminah mengajukan izin sakit</span>
                                    <span class="px-3 py-1 text-sm font-semibold text-orange-700 bg-orange-100 rounded-full">Pending</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
                        <h2 class="text-xl font-semibold mb-4 text-[#2D2A6C]">Total Masuk Hari Ini</h2>
                        <div class="w-full max-w-xs chart-container">
                            <canvas id="donutChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 lg:col-span-2">
                        <h2 class="text-xl font-semibold mb-4 text-[#2D2A6C]">Jumlah Karyawan per Vendor</h2>
                        <div class="chart-container">
                            <canvas id="vendorChart" width="400" height="200" class="w-full max-w-xl" ></canvas>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-semibold mb-4 text-[#2D2A6C]">Jumlah Karyawan per Posisi</h2>
                        <div class="chart-container">
                            <canvas id="posisiChart" width="400" height="378" class="w-full max-w-xl"></canvas>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6 lg:col-span-2">
                        <h2 class="text-xl font-semibold mb-4 text-[#2D2A6C]">Jumlah Karyawan per Unit</h2>
                        <div class="chart-container">
                            <canvas id="unitChart" width="400" height="200" class="w-full max-w-xl"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Izin Content (hidden by default) -->
                <div id="izin" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-[#2D2A6C]">Daftar Izin</h2>
                            <button onclick="openModal('Izin')" class="bg-[#EC6A28] text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-600 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Tambah Izin
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Izin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">1</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rudi Hermawan</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Cuti Tahunan</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="openModal('Edit Izin')" class="text-indigo-600 hover:text-indigo-900 mr-2"><i class="fas fa-edit"></i> Edit</button>
                                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">2</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Diana Puspita</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Sakit</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="openModal('Edit Izin')" class="text-indigo-600 hover:text-indigo-900 mr-2"><i class="fas fa-edit"></i> Edit</button>
                                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Presensi Content (hidden by default) -->
                <div id="presensi" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6 flex flex-col lg:flex-row gap-6">
                        <!-- Profile User -->
                        <div class="flex-grow bg-gray-50 rounded-xl p-6 border border-gray-200">
                            <h2 class="text-xl font-semibold mb-4 text-[#2D2A6C]">Profil Pengguna</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                                <div><span class="font-medium">NIPP:</span> 123456789</div>
                                <div><span class="font-medium">Nama:</span> Budi Santoso</div>
                                <div><span class="font-medium">Organisasi Unit:</span> Marketing</div>
                                <div><span class="font-medium">Posisi:</span> Staff Marketing</div>
                                <div class="sm:col-span-2"><span class="font-medium">Keterangan:</span> Aktif</div>
                            </div>
                        </div>

                        <!-- Presensi Buttons -->
                        <div class="w-full lg:w-1/2 flex flex-col justify-between items-center gap-4">
                            <h2 class="text-xl font-semibold text-[#2D2A6C]">Presensi Hari Ini</h2>
                            <div id="presensi-buttons" class="flex flex-col space-y-4 w-full">
                                <button id="presensi-masuk-btn" class="bg-green-600 text-white font-bold py-4 rounded-xl shadow-md hidden hover:bg-green-700 transition-colors">
                                    Presensi Masuk
                                </button>
                                <button id="presensi-pulang-btn" class="bg-red-600 text-white font-bold py-4 rounded-xl shadow-md hidden hover:bg-red-700 transition-colors">
                                    Presensi Pulang
                                </button>
                            </div>
                            <!-- Quick Menu -->
                            <div class="w-full mt-4">
                                <h3 class="font-medium text-gray-700 mb-2">Menu Cepat</h3>
                                <div class="grid grid-cols-2 gap-2">
                                    <button onclick="openModal('Form Izin Terlambat')" class="bg-gray-200 text-gray-700 text-sm py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                        Izin Terlambat
                                    </button>
                                    <button onclick="openModal('Form Dinas Luar')" class="bg-gray-200 text-gray-700 text-sm py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                        Dinas Luar
                                    </button>
                                    <button onclick="openModal('Form Cuti')" class="bg-gray-200 text-gray-700 text-sm py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                        Cuti
                                    </button>
                                    <button onclick="openModal('Form Daftar Dinasan')" class="bg-gray-200 text-gray-700 text-sm py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                        Daftar Dinasan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List Kegiatan Content (hidden by default) -->
                <div id="list-kegiatan" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-[#2D2A6C]">Daftar Kegiatan</h2>
                            <div class="flex space-x-2">
                                <button onclick="openModal('Kegiatan')" class="bg-[#EC6A28] text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-600 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
                                </button>
                                <button class="bg-[#2D2A6C] text-white px-4 py-2 rounded-lg font-medium hover:bg-[#2D2A6C]/80 transition-colors">
                                    <i class="fas fa-print mr-2"></i>Cetak Laporan
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">1</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rapat Bulanan Divisi</td>
                                        <td class="px-6 py-4 whitespace-nowrap">12 Agustus 2025</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="openModal('Edit Kegiatan')" class="text-indigo-600 hover:text-indigo-900 mr-2"><i class="fas fa-edit"></i> Edit</button>
                                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Empty pages (for demonstration) -->
                <div id="task" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-semibold text-[#2D2A6C]">Halaman Task</h2>
                        <p class="mt-2 text-gray-600">Konten untuk halaman Task akan ditampilkan di sini.</p>
                    </div>
                </div>
                <div id="user-list" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-semibold text-[#2D2A6C]">Halaman Daftar Pengguna</h2>
                        <p class="mt-2 text-gray-600">Konten untuk halaman daftar pengguna akan ditampilkan di sini.</p>
                    </div>
                </div>
                <div id="add-user" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-semibold text-[#2D2A6C]">Halaman Tambah Pengguna</h2>
                        <p class="mt-2 text-gray-600">Konten untuk halaman tambah pengguna akan ditampilkan di sini.</p>
                    </div>
                </div>
                <div id="report" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-semibold text-[#2D2A6C]">Halaman Laporan</h2>
                        <p class="mt-2 text-gray-600">Konten untuk halaman laporan akan ditampilkan di sini.</p>
                    </div>
                </div>
                <div id="profile" class="page-content hidden">
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-semibold text-[#2D2A6C]">Halaman Profil</h2>
                        <p class="mt-2 text-gray-600">Konten untuk halaman profil akan ditampilkan di sini.</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Modal Pop-up -->
    <div id="modal" class="modal fixed inset-0 flex items-center justify-center hidden z-50">
        <div class="modal-content bg-white p-8 rounded-xl shadow-2xl w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-xl font-semibold text-[#2D2A6C]">Judul Modal</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div id="modal-body">
                <!-- Form akan di-inject di sini -->
                <form>
                    <div class="mb-4">
                        <label for="input-nama" class="block text-gray-700 font-medium mb-1">Nama</label>
                        <input type="text" id="input-nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#EC6A28]">
                    </div>
                    <div class="mb-4">
                        <label for="input-jenis" class="block text-gray-700 font-medium mb-1">Jenis Izin</label>
                        <select id="input-jenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#EC6A28]">
                            <option>Cuti</option>
                            <option>Sakit</option>
                            <option>Dinas Luar</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                        <button type="submit" class="bg-[#2D2A6C] text-white px-4 py-2 rounded-lg hover:bg-[#2D2A6C]/80 transition-colors">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Data dummy untuk chart
        const dummyChartData = {
            masuk: 150,
            terlambat: 20,
            tidakMasuk: 5,
            vendors: { 'Vendor A': 50, 'Vendor B': 75, 'Vendor C': 25 },
            posisi: { 'Staff': 100, 'Manager': 50, 'Supervisor': 30 },
            unit: { 'IT': 40, 'Marketing': 60, 'HRD': 30, 'Finance': 50 }
        };

        // Fungsi untuk menginisialisasi chart
        function initCharts() {
            // Donut Chart
            const donutCtx = document.getElementById('donutChart').getContext('2d');
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Masuk', 'Terlambat', 'Tidak Masuk'],
                    datasets: [{
                        data: [dummyChartData.masuk, dummyChartData.terlambat, dummyChartData.tidakMasuk],
                        backgroundColor: ['#2D2A6C', '#EC6A28', '#ef4444'],
                        borderColor: '#ffffff',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });

            // Vendor Chart
            const vendorCtx = document.getElementById('vendorChart').getContext('2d');
            new Chart(vendorCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(dummyChartData.vendors),
                    datasets: [{
                        label: 'Jumlah Karyawan',
                        data: Object.values(dummyChartData.vendors),
                        backgroundColor: '#2D2A6C',
                        borderColor: '#2D2A6C',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
            
            // Posisi Chart
            const posisiCtx = document.getElementById('posisiChart').getContext('2d');
            new Chart(posisiCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(dummyChartData.posisi),
                    datasets: [{
                        label: 'Jumlah Karyawan',
                        data: Object.values(dummyChartData.posisi),
                        backgroundColor: '#EC6A28',
                        borderColor: '#EC6A28',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Unit Chart
            const unitCtx = document.getElementById('unitChart').getContext('2d');
            new Chart(unitCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(dummyChartData.unit),
                    datasets: [{
                        label: 'Jumlah Karyawan',
                        data: Object.values(dummyChartData.unit),
                        backgroundColor: '#2D2A6C',
                        borderColor: '#2D2A6C',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        }
        
        // Fungsi untuk menangani dropdown sidebar
        document.getElementById('users-dropdown-btn').addEventListener('click', function() {
            const dropdown = document.getElementById('users-dropdown');
            const icon = this.querySelector('i.fa-chevron-down');
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });

        // Fungsi untuk mengganti konten halaman
        const pageContents = document.querySelectorAll('.page-content');
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        const pageTitle = document.getElementById('page-title');

        function switchPage(pageId) {
            // Sembunyikan semua konten
            pageContents.forEach(content => {
                content.classList.add('hidden');
            });
            // Tampilkan konten yang dipilih
            const currentPage = document.getElementById(pageId);
            if (currentPage) {
                currentPage.classList.remove('hidden');
                pageTitle.textContent = pageId.charAt(0).toUpperCase() + pageId.slice(1).replace('-', ' ');
            }
        }
        
        // Menambahkan event listener ke semua link sidebar
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                // Hapus kelas 'active' dari semua link
                sidebarLinks.forEach(item => item.classList.remove('active'));
                
                // Tambahkan kelas 'active' ke link yang diklik
                this.classList.add('active');
                
                const pageId = this.dataset.page;
                if (pageId) {
                    switchPage(pageId);
                }
            });
        });

        // Fungsi untuk presensi
        function updatePresensiButtons() {
            const presensiMasukBtn = document.getElementById('presensi-masuk-btn');
            const presensiPulangBtn = document.getElementById('presensi-pulang-btn');
            const now = new Date();
            const currentHour = now.getHours();

            // Sembunyikan semua tombol
            presensiMasukBtn.classList.add('hidden');
            presensiPulangBtn.classList.add('hidden');

            // Tampilkan tombol sesuai waktu
            if (currentHour >= 8 && currentHour < 13) {
                presensiMasukBtn.classList.remove('hidden');
            } else if (currentHour >= 13) {
                presensiPulangBtn.classList.remove('hidden');
            }
        }

        // Fungsi untuk modal pop-up
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        function openModal(title) {
            modalTitle.textContent = title;
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('open'), 10);
        }

        function closeModal() {
            modal.classList.remove('open');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // Panggil fungsi saat halaman dimuat
        window.onload = function() {
            initCharts();
            // Tampilkan halaman dashboard secara default
            const dashboardLink = document.querySelector('[data-page="dashboard"]');
            dashboardLink.click();
            
            updatePresensiButtons();
            // Perbarui tombol presensi setiap menit
            setInterval(updatePresensiButtons, 60000); 
        };

    </script>
</body>
</html>
