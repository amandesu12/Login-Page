<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Use Poppins as a modern, professional sans-serif font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN for a responsive and clean layout -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js for advanced and stylish charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- Vite for managing CSS and JS assets -->
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>
<body class="bg-[#F5F6FA] text-[#2C2C2C]">

    <!-- Overall container for the dashboard layout -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-full color-secondary shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex items-center justify-center h-20 bg-white border-b border-gray-200">
                <a href="#" class="flex items-center space-x-2 text-xl font-bold color-primary-text">
                    <i class="fas fa-tasks text-3xl"></i>
                    <span>Task App</span>
                </a>
            </div>
            <!-- Sidebar Navigation -->
            <nav class="mt-8 space-y-4 px-4">
                <a href="#" class="flex items-center space-x-4 py-3 px-4 rounded-xl font-semibold color-primary-text bg-gray-200">
                    <i class="fas fa-tachometer-alt text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-4 py-3 px-4 rounded-xl font-medium text-gray-500 hover:color-primary-text hover:bg-gray-200">
                    <i class="fas fa-tasks text-lg"></i>
                    <span>Task</span>
                </a>
                <a href="#" class="flex items-center space-x-4 py-3 px-4 rounded-xl font-medium text-gray-500 hover:color-primary-text hover:bg-gray-200">
                    <i class="fas fa-chart-line text-lg"></i>
                    <span>Report</span>
                </a>
                <a href="#" class="flex items-center space-x-4 py-3 px-4 rounded-xl font-medium text-gray-500 hover:color-primary-text hover:bg-gray-200">
                    <i class="fas fa-cog text-lg"></i>
                    <span>Setting</span>
                </a>
            </nav>
            <!-- User Info at the bottom of the sidebar -->
            <div class="absolute bottom-4 left-4 right-4 p-4 flex items-center space-x-4 bg-white rounded-xl shadow-md">
                <img class="w-12 h-12 rounded-full object-cover" src="https://placehold.co/40x40/d4c3f5/333333?text=UN" alt="User Avatar">
                <div>
                    <div class="text-sm font-semibold color-primary-text">Nama User</div>
                    <div class="text-xs text-gray-500">Staff Divisi Keuangan</div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div id="main-content" class="flex-1 flex flex-col lg:ml-64 transition-all duration-300 ease-in-out p-6 md:p-10 scrollbar-hide">

            <!-- Top Navigation Bar (Header) -->
            <header class="fixed top-0 left-0 lg:left-64 right-0 z-30 flex items-center justify-between h-20 px-6 sm:px-10 py-4 bg-white shadow-lg transition-all duration-300 ease-in-out">
                <!-- Hamburger Menu for Mobile -->
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-full color-primary-text hover:bg-gray-200">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex-grow flex items-center space-x-4">
                    <h1 class="text-2xl font-bold color-primary-text">Admin Dashboard</h1>
                    <div class="flex-grow"></div> <!-- Spacer -->
                    <!-- Search Bar -->
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#004A9F] transition duration-200">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <!-- Notification and Profile -->
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 rounded-full color-primary-text hover:bg-gray-200">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-2 right-2 inline-flex items-center justify-center h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        </button>
                        <div class="relative">
                            <img class="h-10 w-10 rounded-full object-cover cursor-pointer hover:ring-2 hover:ring-[#004A9F]" src="https://placehold.co/40x40/f0b4ba/333333?text=LW" alt="User Profile">
                        </div>
                        <button class="px-6 py-3 color-primary text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hidden sm:block">
                            <i class="fas fa-plus mr-2"></i> Add Task
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main content starts here -->
            <div class="pt-20 lg:pt-24 pb-8 w-full max-w-7xl mx-auto">
                <!-- Task Overview (Statistics Cards) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Card 1: Total Task -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-500">Total Task</h3>
                            <i class="fas fa-tasks text-2xl color-primary-text"></i>
                        </div>
                        <p class="text-4xl font-extrabold color-primary-text">124</p>
                    </div>
                    <!-- Card 2: In Progress -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-500">In Progress</h3>
                            <i class="fas fa-spinner text-2xl text-[#FBBF24]"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-[#FBBF24]">25</p>
                    </div>
                    <!-- Card 3: Completed -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-500">Completed</h3>
                            <i class="fas fa-check-circle text-2xl text-[#4CAF50]"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-[#4CAF50]">89</p>
                    </div>
                    <!-- Card 4: Overdue -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-500">Overdue</h3>
                            <i class="fas fa-exclamation-triangle text-2xl text-[#EF4444]"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-[#EF4444]">10</p>
                    </div>
                </div>

                <!-- NEW: Employee Charts and Leave Notifications side by side -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Chart Section -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4 flex-col sm:flex-row sm:space-y-0 space-y-4">
                            <h2 class="text-xl font-bold color-primary-text whitespace-nowrap">Total Masuk Karyawan</h2>
                            <!-- Filter buttons, now more responsive -->
                            <div id="checkin-filter-buttons" class="filter-container">
                                <button class="filter-button active rounded-md" data-filter="day">Hari</button>
                                <button class="filter-button rounded-md" data-filter="week">Minggu</button>
                                <button class="filter-button rounded-md" data-filter="month">Bulan</button>
                                <button class="filter-button rounded-md" data-filter="year">Tahun</button>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-center items-center h-72">
                            <!-- Donut chart on the left -->
                            <div class="relative w-full sm:w-1/2 flex justify-center items-center h-full">
                                <canvas id="checkin-chart" class="h-full w-full"></canvas>
                                <!-- Percentage display in the center of the donut chart -->
                                <div id="checkin-percentage" class="absolute inset-0 flex flex-col justify-center items-center pointer-events-none text-center">
                                    <span class="text-3xl font-bold color-primary-text"></span>
                                    <span class="text-sm text-gray-500">Total</span>
                                </div>
                            </div>
                            <!-- Data list on the right -->
                            <div id="checkin-data-list" class="w-full sm:w-1/2 mt-4 sm:mt-0 sm:pl-8 text-sm">
                                <!-- Data list will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notification Table Section -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4 flex-col sm:flex-row sm:space-y-0 space-y-4">
                            <h2 class="text-xl font-bold color-primary-text whitespace-nowrap">Notifikasi Izin Karyawan</h2>
                            <div id="leave-filter-buttons" class="filter-container">
                                <button class="filter-button active rounded-md" data-filter="week">Minggu</button>
                                <button class="filter-button rounded-md" data-filter="day">Hari</button>
                                <button class="filter-button rounded-md" data-filter="month">Bulan</button>
                                <button class="filter-button rounded-md" data-filter="year">Tahun</button>
                            </div>
                        </div>
                        <div class="overflow-x-auto scrollbar-hide">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Karyawan</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Posisi</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jenis Izin</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="leave-list-body" class="bg-white divide-y divide-gray-200 text-sm">
                                    <tr><td colspan="4" class="text-center text-gray-500 py-4">Loading data...</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- NEW: Bar Charts with Dropdown Filters -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Vendor Chart -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4 flex-col sm:flex-row sm:space-y-0 space-y-4">
                            <h2 class="text-xl font-bold color-primary-text whitespace-nowrap">Jumlah Vendor</h2>
                            <!-- Dropdown filter for Vendor chart -->
                            <select id="vendor-filter" class="filter-dropdown">
                                <option value="day">Hari</option>
                                <option value="week">Minggu</option>
                                <option value="month" selected>Bulan</option>
                                <option value="year">Tahun</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="vendor-chart"></canvas>
                        </div>
                    </div>

                    <!-- Position Chart -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4 flex-col sm:flex-row sm:space-y-0 space-y-4">
                            <h2 class="text-xl font-bold color-primary-text whitespace-nowrap">Jumlah Posisi</h2>
                            <!-- Dropdown filter for Position chart -->
                            <select id="position-filter" class="filter-dropdown">
                                <option value="day">Hari</option>
                                <option value="week">Minggu</option>
                                <option value="month" selected>Bulan</option>
                                <option value="year">Tahun</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="position-chart"></canvas>
                        </div>
                    </div>

                    <!-- Unit Chart -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="flex items-center justify-between mb-4 flex-col sm:flex-row sm:space-y-0 space-y-4">
                            <h2 class="text-xl font-bold color-primary-text whitespace-nowrap">Jumlah Unit</h2>
                            <!-- Dropdown filter for Unit chart -->
                            <select id="unit-filter" class="filter-dropdown">
                                <option value="day">Hari</option>
                                <option value="week">Minggu</option>
                                <option value="month" selected>Bulan</option>
                                <option value="year">Tahun</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="unit-chart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="mt-auto py-4 bg-[#F5F6FA] text-center text-sm text-gray-400">
                    <p>&copy; 2025 Task Management. All rights reserved.</p>
                </footer>
            </div>
        </div>
</body>
</html>
