<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/dashboardthree.css', 'resources/js/dashboardthree.js'])

</head>
<body class="bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <header class="flex flex-col sm:flex-row items-center justify-between mb-6">
            <div class="flex items-center w-full sm:w-auto mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-800 mr-4">Dashboard</h1>
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Cari apa saja..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <select class="block appearance-none bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm">
                        <option>Hari ini</option>
                        <option>7 hari terakhir</option>
                        <option>Bulan ini</option>
                    </select>
                </div>
            </div>
        </header>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
            <!-- Total Task Card -->
            <div class="card bg-white p-6 flex flex-col items-start">
                <div class="flex justify-between w-full items-center mb-4">
                    <span class="text-gray-500 text-sm font-semibold">Total Task</span>
                    <i class="fas fa-tasks text-gray-400 text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-blue-600">124</p>
            </div>
            
            <!-- In Progress Card -->
            <div class="card bg-white p-6 flex flex-col items-start">
                <div class="flex justify-between w-full items-center mb-4">
                    <span class="text-gray-500 text-sm font-semibold">Dalam Proses</span>
                    <i class="fas fa-spinner fa-spin text-yellow-600 text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-yellow-600">124</p>
            </div>
            
            <!-- Complete Card -->
            <div class="card bg-white p-6 flex flex-col items-start">
                <div class="flex justify-between w-full items-center mb-4">
                    <span class="text-gray-500 text-sm font-semibold">Selesai</span>
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-green-600">124</p>
            </div>
            
            <!-- Overdue Card -->
            <div class="card bg-white p-6 flex flex-col items-start">
                <div class="flex justify-between w-full items-center mb-4">
                    <span class="text-gray-500 text-sm font-semibold">Lewat Batas</span>
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-red-600">124</p>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Total Entries Today Chart -->
            <div class="card bg-white p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Total Entri Hari Ini</h3>
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-2/3 h-64 md:h-80 flex items-center justify-center">
                        <canvas id="entriesChart"></canvas>
                    </div>
                    <div class="w-full md:w-1/3 mt-6 md:mt-0 md:ml-6 space-y-2">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: #ef4444;"></span>
                            <span class="text-gray-600 text-sm">Sakit</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: #f97316;"></span>
                            <span class="text-gray-600 text-sm">Izin</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: #22c55e;"></span>
                            <span class="text-gray-600 text-sm">Tidak Hadir</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: #3b82f6;"></span>
                            <span class="text-gray-600 text-sm">Hadir</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: #fde047;"></span>
                            <span class="text-gray-600 text-sm">Kantor</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Jumlah Unit Chart -->
            <div class="card bg-white p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Jumlah Unit</h3>
                    <select class="text-gray-700 py-1 px-2 rounded border border-gray-300 focus:outline-none text-sm">
                        <option>6 bulan</option>
                        <option>12 bulan</option>
                    </select>
                </div>
                <div class="h-80">
                    <canvas id="unitChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Aktivitas Terbaru -->
        <div class="card bg-white p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                <a href="#" class="text-blue-500 hover:underline text-sm font-medium">Lihat detail <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="space-y-4">
                <!-- Activity Item 1 -->
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center bg-gray-200">
                            <i class="fas fa-code text-gray-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Integrasi API</p>
                            <p class="text-sm text-gray-500">Selesai - 2 jam yang lalu</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Selesai</span>
                </div>
                
                <!-- Activity Item 2 -->
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center bg-gray-200">
                            <i class="fas fa-database text-gray-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Optimasi Database</p>
                            <p class="text-sm text-gray-500">Dalam Proses - 60% selesai</p>
                        </div>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Aktif</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
