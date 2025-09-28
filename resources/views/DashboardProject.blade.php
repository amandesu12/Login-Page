<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen Proyek (Responsive)</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Chart.js for visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <style>
        /* Menggunakan font Inter secara default */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light background: gray-100 */
        }
        /* Style untuk progress bar simulasi */
        .progress-bar {
            height: 10px;
            border-radius: 9999px;
            transition: width 0.5s ease-out;
        }
        /* Warna untuk chart */
        .color-primary { background-color: #3b82f6; } /* Biru */
        .color-secondary { background-color: #10b981; } /* Hijau */
        .color-tertiary { background-color: #f59e0b; } /* Kuning */
        .color-danger { background-color: #ef4444; } /* Merah */

        /* Override Chart.js default font to match Inter */
        canvas {
            font-family: 'Inter', sans-serif !important;
        }
    </style>
</head>
<body class="p-4 md:p-8 text-gray-900">

    <!-- HEADER -->
    <header class="mb-8 pb-4">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Dashboard Proyek: Analisis Kinerja & Risiko</h1>
        <p class="text-gray-600 mt-1">Metrik inti proyek, beban kerja, dan status penyelesaian tugas.</p>
    </header>

    <!-- Pilihan Periode Waktu - CARD DENGAN SHADOW -->
    <div class="flex flex-wrap gap-2 mb-8 bg-white p-3 rounded-xl shadow-lg border border-gray-200">
        <button id="btn-daily" class="time-filter px-4 py-2 text-sm font-semibold rounded-lg bg-blue-600 text-white shadow-md transition duration-150 hover:bg-blue-700" data-period="daily">Harian</button>
        <button id="btn-weekly" class="time-filter px-4 py-2 text-sm font-semibold rounded-lg bg-gray-200 text-gray-700 transition duration-150 hover:bg-gray-300" data-period="weekly">Mingguan</button>
        <button id="btn-monthly" class="time-filter px-4 py-2 text-sm font-semibold rounded-lg bg-gray-200 text-gray-700 transition duration-150 hover:bg-gray-300" data-period="monthly">Bulanan</button>
    </div>

    <!-- Kontainer Grid Utama - Responsif -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- METRIK KUNCI (Key Metrics) - DIBERI CARD dan SHADOW -->

        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-500">Total Tugas Selesai</p>
            <p id="total-completed" class="text-4xl font-bold mt-1 text-gray-900">24.580</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="total-change" class="text-green-600 font-semibold mr-1">+4.25%</span>
                <span class="text-gray-500">dari periode lalu</span>
            </div>
        </div>

        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-500">Tingkat Penyelesaian</p>
            <p id="completion-rate" class="text-4xl font-bold mt-1 text-green-600">85.90%</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="completion-change" class="text-red-600 font-semibold mr-1">-1.12%</span>
                <span class="text-gray-500">dibanding kemarin</span>
            </div>
        </div>

        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-500">Rata-rata Waktu Selesai</p>
            <p id="avg-time" class="text-4xl font-bold mt-1 text-gray-900">3 jam 45 mnt</p>
            <div class="text-xs mt-3 flex items-center">
                <span id="avg-time-change" class="text-green-600 font-semibold mr-1">+15.70%</span>
                <span class="text-gray-500">lebih cepat</span>
            </div>
        </div>

        <!-- NEW KPI: Waktu Proyek Terpakai -->
        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <p class="text-sm font-medium text-gray-500">Waktu Proyek Terpakai</p>
            <p id="project-time-used" class="text-4xl font-bold mt-1 text-blue-600">75%</p>
            <div class="text-xs mt-3 flex items-center">
                <span class="text-red-600 font-semibold mr-1">Tinggal 25 Hari</span>
                <span class="text-gray-500">dari total 100 hari</span>
            </div>
        </div>

        <!-- GRAFIK TREN (2 KOLOM) -->
        <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200"> 
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Tren Penyelesaian Tugas Harian (30 Hari)</h2>
            <div class="h-64">
                <canvas id="completionChart"></canvas>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-center">Garis mulus menunjukkan tren jumlah tugas yang diselesaikan.</p>
        </div>

        <!-- DISTRIBUSI STATUS TUGAS (1 KOLOM) -->
        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Status Tugas (Global)</h2>
            <div class="space-y-4">
                <div id="status-completed">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Selesai</span>
                        <span class="font-bold text-green-600">85.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-secondary w-[85.00%]" style="width: 85.00%;"></div>
                    </div>
                </div>
                <div id="status-in-progress">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Dalam Proses</span>
                        <span class="font-bold text-blue-600">10.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-primary w-[10.00%]" style="width: 10.00%;"></div>
                    </div>
                </div>
                <div id="status-on-hold">
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Tertunda</span>
                        <span class="font-bold text-yellow-600">5.00%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-tertiary w-[5.00%]" style="width: 5.00%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BEBAN KERJA TIM (1 KOLOM) -->
        <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Beban Kerja Tim (Jam)</h2>
            <div class="space-y-4 text-sm">
                <!-- Data Simulasi Beban Kerja -->
                <div>
                    <div class="flex justify-between text-gray-700">
                        <span>Budi S.</span>
                        <span class="font-semibold text-red-600">95%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-danger w-[95%]" style="width: 95%;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-gray-700">
                        <span>Risa A.</span>
                        <span class="font-semibold text-green-600">60%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-secondary w-[60%]" style="width: 60%;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-gray-700">
                        <span>Andi W.</span>
                        <span class="font-semibold text-yellow-600">78%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-tertiary w-[78%]" style="width: 78%;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-gray-700">
                        <span>Siti N.</span>
                        <span class="font-semibold text-blue-600">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full mt-1">
                        <div class="progress-bar color-primary w-[45%]" style="width: 45%;"></div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 pt-2">Persentase dari alokasi jam kerja maksimum.</p>
            </div>
        </div>

        <!-- TABEL TUGAS KRITIS & TERLAMBAT (4 KOLOM) -->
        <div class="md:col-span-4 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-semibold mb-4 text-gray-900">Tugas Kritis & Berisiko Tinggi (Terlambat)</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-4 py-3">ID Tugas</th>
                            <th class="px-4 py-3">Judul Tugas</th>
                            <th class="px-4 py-3">Assignee</th>
                            <th class="px-4 py-3">Batas Waktu</th>
                            <th class="px-4 py-3 text-right">Keterlambatan</th>
                        </tr>
                    </thead>
                    <tbody id="critical-tasks-table" class="divide-y divide-gray-200 text-sm">
                        <!-- Data Simulasi Tugas Kritis -->
                        <tr class="hover:bg-red-50 transition duration-150">
                            <td class="px-4 py-3 whitespace-nowrap text-red-700 font-semibold">PRJ_101</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">Implementasi Fitur Awal Login SSO</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">Budi S.</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">20 Sep 2025</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-red-700 font-bold">8 Hari</td>
                        </tr>
                        <tr class="hover:bg-yellow-50 transition duration-150">
                            <td class="px-4 py-3 whitespace-nowrap text-yellow-700 font-semibold">PRJ_105</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">Uji Stabilitas Database (Stress Test)</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">Andi W.</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">25 Sep 2025</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-yellow-700 font-bold">3 Hari</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-3 whitespace-nowrap text-gray-700 font-semibold">PRJ_110</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">Persiapan Materi Pelatihan Pengguna</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">Siti N.</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">27 Sep 2025</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-red-700 font-bold">1 Hari</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABEL PENYELESAIAN TERBARU (4 KOLOM) -->
        <div class="md:col-span-4 bg-white p-6 rounded-xl shadow-lg border border-gray-200 mt-6">
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
                totalCompleted: 987,
                completionRate: 0.8590,
                avgCompletionTime: '3 jam 45 mnt',
                openTasks: 1120,
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
        // Data yang dihasilkan bergerak dari data lama (index 0) ke data baru (index 29)
        const dailyTrendDataOriginal = Array.from({ length: 30 }, () => Math.floor(Math.random() * (1000 - 500 + 1)) + 500);
        const dailyLabelsOriginal = Array.from({ length: 30 }, (_, i) => `H-${30 - i}`); // H-30, H-29, ..., H-1

        // PERUBAHAN: Membalikkan urutan array untuk menampilkan H-1 di sebelah kiri dan H-30 di sebelah kanan.
        // Dengan cara ini, data dan label tetap sinkron.
        const dailyTrendData = [...dailyTrendDataOriginal].reverse();
        const dailyLabels = [...dailyLabelsOriginal].reverse(); // Hasil: H-1, H-2, ..., H-30

        let completionChartInstance = null;

        const formatNumber = (num) => new Intl.NumberFormat('id-ID').format(num);

        function renderChart(data, labels) {
            const ctx = document.getElementById('completionChart').getContext('2d');

            if (completionChartInstance) {
                completionChartInstance.destroy();
            }

            // START: WARNA CAHAYA HIJAU
            // Efek Keren: Gradient untuk area di bawah garis (Cahaya Hijau)
            const gradient = ctx.createLinearGradient(0, 0, 0, 256);
            gradient.addColorStop(0, 'rgba(74, 222, 128, 0.6)'); // Hijau muda semi-transparan di atas (#4ade80)
            gradient.addColorStop(1, 'rgba(74, 222, 128, 0)');   // Transparan di bawah
            // END: WARNA CAHAYA HIJAU

            completionChartInstance = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tugas Selesai',
                        data: data,
                        backgroundColor: gradient, 
                        borderColor: '#4ade80', // Garis utama berwarna hijau muda (cahaya hijau)
                        borderWidth: 3,
                        pointBackgroundColor: '#4ade80', // Titik berwarna hijau muda
                        pointBorderColor: '#fff', // White/Light background for points
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

        function updateMetrics(period) {
            const data = mockData[period];
            if (!data) return;

            document.getElementById('total-completed').textContent = formatNumber(data.totalCompleted);
            document.getElementById('completion-rate').textContent = (data.completionRate * 100).toFixed(2) + '%';
            document.getElementById('avg-time').textContent = data.avgCompletionTime;
            // Project Time Used is static for simplicity in this demo
            document.getElementById('project-time-used').textContent = '75%';
        }

        function createLatestTasksTable() {
            const tableBody = document.getElementById('latest-tasks-table');
            tableBody.innerHTML = '';

            latestCompletedJobs.forEach(job => {
                const date = new Date(job.time);
                const timeOptions = {
                    year: 'numeric', month: 'short', day: '2-digit',
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    hour12: false,
                    timeZoneName: 'short'
                };
                const formattedTime = date.toLocaleTimeString('id-ID', timeOptions);
                const milliseconds = String(date.getMilliseconds()).padStart(3, '0');
                const preciseTime = `${formattedTime}.${milliseconds}`;

                let priorityClass;
                switch(job.priority) {
                    case 'High':
                        priorityClass = 'bg-red-50 text-red-700';
                        break;
                    case 'Medium':
                        priorityClass = 'bg-yellow-50 text-yellow-700';
                        break;
                    case 'Low':
                        priorityClass = 'bg-blue-50 text-blue-700';
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

            timeFilters.forEach(button => {
                button.addEventListener('click', function() {
                    timeFilters.forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                        btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                    });

                    this.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
                    this.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');

                    updateMetrics(this.dataset.period);
                });
            });

            const now = new Date();
            const updateOptions = {
                year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit',
                hour12: false
            };
            document.getElementById('last-updated').textContent = now.toLocaleDateString('id-ID', updateOptions);
            
            updateMetrics('daily');
            createLatestTasksTable();
            renderChart(dailyTrendData, dailyLabels);
        });
    </script>

</body>
</html>
