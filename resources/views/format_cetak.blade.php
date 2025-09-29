<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan Harian - VEMOS PT KAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1F2937;
        }
        .container-report {
            max-width: 960px;
            margin: 2rem auto;
            background-color: #FFF;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .btn-print {
            background-color: #0E7490;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px; /* Fully rounded */
            font-weight: 600;
            transition: background-color 0.3s ease-in-out, transform 0.1s ease-in-out;
        }
        .btn-print:hover {
            background-color: #155E75;
            transform: translateY(-2px);
        }
        
        /* Progress bar styles */
        .progress-bar-container {
            width: 100%;
            background-color: #E5E7EB;
            border-radius: 9999px;
            overflow: hidden;
            height: 8px;
        }
        .progress-bar {
            height: 100%;
            background-color: #16A34A; /* Green-600 */
            transition: width 0.3s ease-in-out;
        }
        /* Custom styles for truncated URL */
        .url-wrapper {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            vertical-align: middle;
        }

        /* Print-specific styles for A4 */
        @media print {
            @page {
                size: A4 portrait;
                margin: 25mm 20mm;
            }
            body {
                background-color: #fff;
            }
            .container-report {
                max-width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
            }
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-before: always;
            }
            /* Table optimization for print */
            table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed; /* Fixes column width */
            }
            th, td {
                padding: 10px;
                border: 1px solid #E5E7EB;
                text-align: left;
                word-wrap: break-word; /* Prevents overflow */
            }
            thead {
                background-color: #F3F4F6;
            }
            .table-container {
                border: none;
            }
            /* Adjusting column widths for A4 */
            .column-no { width: 5%; }
            .column-user { width: 12%; }
            .column-wo { width: 10%; }
            .column-activity { width: 25%; }
            .column-attachment { width: 18%; }
            .column-date { width: 10%; }
            .column-status { width: 10%; }
            .column-percentage { width: 10%; }
        }
    </style>
</head>
<body>
    <div class="container-report">
        <div class="pb-6 border-b-2 border-gray-200 mb-8 print:border-gray-400">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Logo_PT_Kereta_Api_Indonesia_%28Persero%29_2020.svg/1200px-Logo_PT_Kereta_Api_Indonesia_%28Persero%29_2020.svg.png" alt="Logo PT KAI" class="h-12">
                    <div class="flex flex-col">
                        <span class="text-3xl font-bold text-gray-800 tracking-tight">VEMOS</span>
                        <span class="text-sm text-gray-500">Sistem Manajemen Kegiatan</span>
                    </div>
                </div>
                <div class="text-right text-sm text-gray-600 leading-relaxed">
                    <p>PT Kereta Api Indonesia (Persero)</p>
                    <p>Jl. Perintis Kemerdekaan No. 1, Bandung 40117</p>
                    <p>pusat@kai.id</p>
                    <p>+62 (022) 4230031</p>
                </div>
            </div>
            
            <h1 class="text-4xl font-extrabold text-gray-900 mt-8 text-center tracking-wide">LAPORAN KEGIATAN HARIAN</h1>
            <p class="text-center text-md text-gray-500 mt-2">Dokumen ini memuat ringkasan kegiatan harian untuk arsip dan pelaporan.</p>
        </div>

        <div class="flex justify-between items-center text-sm text-gray-600 mb-6">
            <div class="flex items-center space-x-4">
                <p><strong>Departemen:</strong> Tim Proyek Alpha</p>
            </div>
            <p><strong>Tanggal Laporan:</strong> 24 Oktober 2025</p>
        </div>

        <div class="overflow-auto border border-gray-200 rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-no">No.</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-user">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-wo">WO</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-activity">Aktivitas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-attachment">Lampiran</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-date">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-status">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider column-percentage">Persentase</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">1</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Rizky Firmansyah</td>
                        <td class="px-6 py-4 text-sm text-gray-700">WO-12345</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Rapat progres mingguan dengan tim.</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <a href="https://contoh.com/dokumen/lampiran_super_panjang_dan_penting_ini.pdf" target="_blank" class="text-blue-600 hover:underline">
                                <span class="url-wrapper">https://contoh.com/dokumen/lampiran_super_panjang_dan_p...</span>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">22 Okt 2025</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-700">Selesai</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-700">100%</span>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 100%;"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">2</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Fatimah Zahra</td>
                        <td class="px-6 py-4 text-sm text-gray-700">WO-12346</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Pembuatan laporan keuangan triwulan.</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <a href="https://contoh.com/dokumen/laporan_keuangan_tahun_2025.xlsx" target="_blank" class="text-blue-600 hover:underline">
                                <span class="url-wrapper">https://contoh.com/dokumen/laporan_keuangan_tahun_2025.xlsx</span>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">23 Okt 2025</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">Proses</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-700">50%</span>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 50%;"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">3</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Budi Santoso</td>
                        <td class="px-6 py-4 text-sm text-gray-700">WO-12347</td>
                        <td class="px-6 py-4 text-sm text-gray-700">Kunjungan lapangan untuk survei lokasi.</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <a href="#" class="text-gray-400 cursor-not-allowed">
                                <span class="url-wrapper">Tidak ada lampiran</span>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">24 Okt 2025</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-700">Tertunda</span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-700">20%</span>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 20%;"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-12 flex justify-between items-end print:mt-16">
            <div class="text-sm text-gray-700">
                <p>Bandung, 24 Oktober 2025</p>
                <p class="mt-10">Hormat kami,</p>
            </div>
            
            <div class="text-center text-sm text-gray-700">
                <div class="mt-20">
                    <p class="font-bold border-t border-gray-400 pt-2">Nama Lengkap Pimpinan</p>
                    <p class="text-gray-500 pt-1">Jabatan / Posisi</p>
                </div>
            </div>
        </div>

        <div class="mt-10 text-center no-print">
            <button onclick="window.print()" class="btn-print shadow-lg">
                <i class="fa-solid fa-print mr-2"></i> Cetak Laporan
            </button>
        </div>
    </div>

</body>
</html>