<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Monitoring</title>
    <!-- Memuat font Poppins dari Google Fonts untuk tampilan modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN untuk tata letak yang responsif dan rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon yang user-friendly -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Vite untuk mengelola aset CSS dan JS -->
    @vite(['resources/css/task.css', 'resources/js/task.js'])
    <!-- ([?resources/css/task.css?, ?resources/js/task.js-->
</head>
<body class="bg-soft text-dark">

    <div class="container mx-auto p-4 sm:p-8">

        <!-- Header dan Kontrol Utama -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
            <h1 class="text-3xl font-bold">Task Monitoring</h1>
        </div>
        
        <!-- Gabungan Kategori Tabel dalam satu Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg">

            <!-- Bilah Pencarian -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Cari tugas..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-light focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200">
                </div>
            </div>

            <div class="table-container">
                <table id="tasksTable" class="min-w-full divide-y divide-border-light text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tugas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ditugaskan Kepada</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prioritas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Batas Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tasksTableBody" class="divide-y divide-border-light"></tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Backdrop untuk memburamkan konten utama saat panel terbuka -->
    <div id="backdrop" class="backdrop fixed inset-0 hidden"></div>

    <!-- Panel Detail Tugas (tersembunyi secara default) -->
    <div id="taskPanel" class="slide-panel fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-lg p-6 overflow-y-auto">
        <!-- Tombol Tutup -->
        <button id="closePanelBtn" class="absolute top-4 left-4 text-gray-400 hover:text-gray-800 transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <h2 id="panelTitle" class="text-xl font-bold mb-2"></h2>
        <p id="panelDescription" class="text-sm text-gray mb-4"></p>
        
        <div class="mb-6">
            <h3 class="text-md font-semibold text-dark mb-2">Progress</h3>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div id="progressBar" class="bg-blue-500 h-2.5 rounded-full transition-all duration-500 ease-in-out" style="width: 0%;"></div>
            </div>
            <p id="progressText" class="text-right text-sm text-gray mt-1 font-medium">0% Selesai</p>
        </div>
        
        <div>
            <h3 class="text-md font-semibold text-dark mb-2">Ditugaskan Kepada</h3>
            <div id="assignedUsersList" class="space-y-4">
                <!-- Daftar pengguna akan dirender di sini -->
            </div>
        </div>
    </div>
</body>
</html>
