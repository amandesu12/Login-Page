<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistik Tugas (Responsive)</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Chart.js for visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <style>
        /* Menggunakan font Inter secara default */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light background: gray-100 */
        }
        /* Style untuk chart simulasi */
        .chart-bar {
            height: 10px;
            border-radius: 9999px;
            transition: width 0.5s ease-out;
        }
        /* Warna untuk chart */
        .color-primary { background-color: #3b82f6; } /* Biru */
        .color-secondary { background-color: #10b981; } /* Hijau */
        .color-tertiary { background-color: #f59e0b; } /* Kuning */
        /* Custom divider tidak diperlukan lagi karena menggunakan card */
    </style>
</head>
<body class="p-4 md:p-8 text-gray-900">

    <!-- HEADER -->
    <header class="mb-8 pb-4">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Dashboard Analisis Penyelesaian Tugas</h1>
        <p class="text-gray-600 mt-1">Statistik pekerjaan yang diselesaikan oleh pengguna secara *real-time* dan presisi.</p>
    </header>

    <!-- Pilihan Periode Waktu - DIBERI CARD dan SHADOW -->
    <div class="flex flex-wrap gap-2 mb-8 bg-white p-3 rounded-xl shadow-lg">
        <button id="btn-daily" class="time-filter px-4 py-2 text-sm font-semibold rounded-lg bg-blue-600 text-white shadow-md transition duration-150 hover:bg-blue-700" data-period="daily">Harian</button>
        <!-- Inactive buttons updated for light theme -->
        <button id="btn-weekly" class="time-filter px-4 py-2 text-sm font-semibold rounded-lg bg-gray-200 text-gray-700 transition duration-150 hover:bg-gray-300" data-period="weekly">Mingguan</button>
        <button id="btn-monthly" class="time-filter px-4 py-2 text-sm font-semibold rounded-lg bg-gray-200 text-gray-700 transition duration-150 hover:bg-gray-300" data-period="monthly">Bulanan</button>
    </div>

    <!-- Kontainer Grid Utama - Responsif -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- METRIK KUNCI (Key Metrics) - DIBERI CARD dan SHADOW -->
        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm font-medium text-gray-500">Total Tugas Selesai</p>
            <p id="total-completed" class="text-4xl font-bold mt-1 text-gray-900">24.580</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="total-change" class="text-green-600 font-semibold mr-1">+4.25%</span>
                <span class="text-gray-500">dari periode lalu</span>
            </div>
        </div>

        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm font-medium text-gray-500">Tingkat Penyelesaian</p>
            <p id="completion-rate" class="text-4xl font-bold mt-1 text-green-600">85.90%</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="completion-change" class="text-red-600 font-semibold mr-1">-1.12%</span>
                <span class="text-gray-500">dibanding kemarin</span>
            </div>
        </div>

        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm font-medium text-gray-500">Rata-rata Waktu Selesai</p>
            <p id="avg-time" class="text-4xl font-bold mt-1 text-gray-900">3 jam 45 mnt</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="avg-time-change" class="text-green-600 font-semibold mr-1">+15.70%</span>
                <span class="text-gray-500">lebih cepat</span>
            </div>
        </div>

        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <p class="text-sm font-medium text-gray-500">Tugas Terbuka (Total)</p>
            <p id="open-tasks" class="text-4xl font-bold mt-1 text-yellow-600">1.120</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="open-tasks-change" class="text-green-600 font-semibold mr-1">+0.41%</span>
                <span class="text-gray-500">dibanding periode lalu</span>
            </div>
        </div>

        <!-- GRAFIK PERTUMBUHAN PENYELESAIAN TUGAS - DIBERI CARD dan SHADOW -->
        <div class="md:col-span-3 bg-white p-6 rounded-xl shadow-lg"> 
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Tren Penyelesaian Tugas Harian (30 Hari)</h2>
            <!-- CANVAS untuk Chart.js -->
            <div class="h-64">
                <canvas id="completionChart"></canvas>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-center">Garis mulus menunjukkan tren jumlah tugas yang diselesaikan.</p>
        </div>

        <!-- DISTRIBUSI STATUS TUGAS - DIBERI CARD dan SHADOW -->
        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Distribusi Status Tugas</h2>
            <div class="space-y-4">
                <div id="status-completed">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Selesai (Completed)</span>
                        <span class="font-bold text-green-600">85.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="chart-bar color-secondary w-[85.00%]" style="width: 85.00%;"></div>
                    </div>
                </div>
                <div id="status-in-progress">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Dalam Proses (In Progress)</span>
                        <span class="font-bold text-blue-600">10.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="chart-bar color-primary w-[10.00%]" style="width: 10.00%;"></div>
                    </div>
                </div>
                <div id="status-on-hold">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Tertunda (On Hold)</span>
                        <span class="font-bold text-yellow-600">5.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="chart-bar color-tertiary w-[5.00%]" style="width: 5.00%;"></div>
                    </div>
                </div>
                <div id="status-open">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Belum Dimulai (To Do)</span>
                        <span class="font-bold text-gray-600">0.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="chart-bar bg-gray-400 w-[0.00%]" style="width: 0.00%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL DATA TERBARU - Lebar Penuh - DIBERI CARD dan SHADOW -->
        <div class="md:col-span-4 bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Penyelesaian Tugas Terbaru (Presisi Waktu)</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-4 py-3">ID Tugas</th>
                            <th class="px-4 py-3">Judul Tugas</th>
                            <th class="px-4 py-3">Waktu Selesai (WIB)</th>
                            <th class="px-4 py-3 text-right">Prioritas</th>
                        </tr>
                    </thead>
                    <tbody id="latest-tasks-table" class="divide-y divide-gray-200 text-sm">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <footer class="mt-8 text-center text-gray-500 text-sm">
        Data diperbarui pada <span id="last-updated"></span>
    </footer>

    <script>
        // Data Statis untuk Simulasi Tugas
        const mockData = {
            daily: {
                totalCompleted: 987, // Total Tugas Selesai Harian
                completionRate: 0.8590, // Tingkat Penyelesaian
                avgCompletionTime: '3 jam 45 mnt', // Rata-rata Waktu Selesai
                openTasks: 1120, // Tugas Terbuka
            },
            weekly: {
                totalCompleted: 6598,
                completionRate: 0.8250,
                avgCompletionTime: '4 jam 10 mnt',
                openTasks: 1250,
            },
            monthly: {
                totalCompleted: 27500,
                completionRate: 0.8810,
                avgCompletionTime: '3 jam 20 mnt',
                openTasks: 980,
            }
        };

        // Data Penyelesaian Terbaru (Simulasi presisi)
        const latestCompletedJobs = [
            { id: 'TUGAS_431', title: 'Perbaikan bug pembayaran', time: '2025-09-28T11:15:21.345Z', priority: 'High' },
            { id: 'TUGAS_430', title: 'Review laporan Q3', time: '2025-09-28T11:10:59.987Z', priority: 'Medium' },
            { id: 'TUGAS_429', title: 'Update dokumentasi API', time: '2025-09-28T11:05:30.120Z', priority: 'Medium' },
            { id: 'TUGAS_428', title: 'Meeting koordinasi tim', time: '2025-09-28T10:59:02.001Z', priority: 'Low' },
            { id: 'TUGAS_427', title: 'Desain banner promosi', time: '2025-09-28T10:51:15.789Z', priority: 'High' },
        ];
        
        // Data Simulasi untuk Grafik 30 Hari (Contoh data acak)
        const dailyTrendData = Array.from({ length: 30 }, () => Math.floor(Math.random() * (1000 - 500 + 1)) + 500);
        const dailyLabels = Array.from({ length: 30 }, (_, i) => `H-${30 - i}`); // Label dari H-30 hingga H-1

        let completionChartInstance = null; // Variable untuk menampung instance Chart

        // Fungsi untuk format angka (digunakan di metrik dan tooltip chart)
        const formatNumber = (num) => new Intl.NumberFormat('id-ID').format(num);

        // Fungsi untuk merender Chart.js
        function renderChart(data, labels) {
            const ctx = document.getElementById('completionChart').getContext('2d');

            // Hancurkan instance chart yang ada (jika ada) sebelum membuat yang baru
            if (completionChartInstance) {
                completionChartInstance.destroy();
            }

            // --- Efek Keren: Gradient untuk area di bawah garis ---
            const gradient = ctx.createLinearGradient(0, 0, 0, 256);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Hijau semi-transparan di atas
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');   // Transparan di bawah
            // ----------------------------------------------------

            completionChartInstance = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tugas Selesai',
                        data: data,
                        // Styling untuk Line Chart
                        backgroundColor: gradient, // Gunakan gradient untuk area di bawah garis
                        borderColor: '#10b981', // Garis utama berwarna hijau
                        borderWidth: 3,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#f3f4f6', // Warna latar belakang terang (gray-100)
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true, 
                        tension: 0.4, // Membuat garis menjadi melengkung (smooth)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)', // Garis grid abu-abu terang
                                drawBorder: false 
                            },
                            ticks: {
                                color: '#4b5563', // Warna teks sumbu Y (gray-600)
                                callback: function(value) {
                                    return formatNumber(value); 
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#4b5563', // Warna teks sumbu X (gray-600)
                                maxRotation: 45,
                                minRotation: 45,
                                autoSkip: true,
                                maxTicksLimit: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false 
                        },
                        tooltip: {
                            backgroundColor: '#1f2937', // Tetap gelap untuk kontras
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            cornerRadius: 6, 
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return ` Selesai: ${formatNumber(context.parsed.y)} tugas`;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Fungsi untuk mengupdate metrik utama
        function updateMetrics(period) {
            const data = mockData[period];
            if (!data) return;

            // Metrik Tugas Selesai
            document.getElementById('total-completed').textContent = formatNumber(data.totalCompleted);
            
            // Metrik Tingkat Penyelesaian (format persentase)
            document.getElementById('completion-rate').textContent = (data.completionRate * 100).toFixed(2) + '%';

            // Metrik Rata-rata Waktu Selesai (format string)
            document.getElementById('avg-time').textContent = data.avgCompletionTime;
            
            // Metrik Tugas Terbuka (format angka)
            document.getElementById('open-tasks').textContent = formatNumber(data.openTasks);
        }

        // Fungsi untuk membuat tabel penyelesaian tugas terbaru
        function createLatestTasksTable() {
            const tableBody = document.getElementById('latest-tasks-table');
            tableBody.innerHTML = ''; // Bersihkan

            latestCompletedJobs.forEach(job => {
                // Konversi waktu UTC ke Waktu Lokal (WIB) dengan presisi milidetik
                const date = new Date(job.time);
                // Opsi format waktu yang detail dan presisi
                const timeOptions = {
                    year: 'numeric', month: 'short', day: '2-digit',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    hour12: false,
                    timeZoneName: 'short'
                };
                const formattedTime = date.toLocaleTimeString('id-ID', timeOptions);
                // Menambahkan milidetik secara manual untuk presisi
                const milliseconds = String(date.getMilliseconds()).padStart(3, '0');
                const preciseTime = `${formattedTime}.${milliseconds}`;

                let priorityClass;
                switch(job.priority) {
                    case 'High':
                        priorityClass = 'bg-red-50 text-red-700'; // Light theme color
                        break;
                    case 'Medium':
                        priorityClass = 'bg-yellow-50 text-yellow-700'; // Light theme color
                        break;
                    case 'Low':
                        priorityClass = 'bg-blue-50 text-blue-700'; // Light theme color
                        break;
                    default:
                        priorityClass = 'bg-gray-50 text-gray-700';
                }

                const row = `
                    <tr class="hover:bg-gray-100 transition duration-150">
                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">${job.id}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-600">${job.title}</td>
                        <td class="px-4 py-3 whitespace-nowrap font-mono text-gray-700">${preciseTime}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-right">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${priorityClass}">
                                ${job.priority}
                            </span>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Inisialisasi dan Event Listeners
        document.addEventListener('DOMContentLoaded', () => {
            const timeFilters = document.querySelectorAll('.time-filter');

            // Handle klik filter waktu
            timeFilters.forEach(button => {
                button.addEventListener('click', function() {
                    // Reset styling for light theme
                    timeFilters.forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                        btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300'); // Light inactive state
                    });

                    // Set active styling
                    this.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                    this.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');

                    updateMetrics(this.dataset.period);
                });
            });

            // Set waktu update terakhir (Presisi)
            const now = new Date();
            const updateOptions = {
                year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit',
                hour12: false
            };
            const lastUpdatedElement = document.getElementById('last-updated');
            lastUpdatedElement.textContent = now.toLocaleDateString('id-ID', updateOptions);
            
            // Inisialisasi: Tampilkan data harian dan render chart
            updateMetrics('daily');
            createLatestTasksTable();
            renderChart(dailyTrendData, dailyLabels); // Memanggil fungsi untuk menampilkan chart
        });
    </script>

</body>
</html>
