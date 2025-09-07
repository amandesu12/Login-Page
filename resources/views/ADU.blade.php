<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VEMOS - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fc;
            color: #1e293b;
            padding-bottom: 7rem; /* Menambahkan padding untuk mencegah konten terhalang oleh paginasi tetap */
        }

        /* Gaya untuk scrolbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Transisi hover halus */
        .hover-transition {
            transition: all 0.2s ease-in-out;
        }

        /* Gaya kustom untuk pop-up */
        .popup-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #1e293b;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: 100;
        }
        .popup-message.show {
            opacity: 1;
        }

        /* Gaya untuk pagination yang tetap di bawah */
        .fixed-pagination {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem 0; /* Sesuaikan padding vertikal */
            background-color: #f7f9fc;
            z-index: 50;
        }
    </style>
</head>
<body class="p-6 md:p-10">

    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Header -->
        <header class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <h1 class="text-3xl font-bold">VEMOS</h1>
                <div class="relative w-full md:w-80">
                    <input type="text" placeholder="Search for anything..." class="w-full pl-10 pr-4 py-2 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover-transition">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="space-y-6">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <span>Dashboard</span>
                <span>/</span>
                <span class="font-semibold text-blue-500">Users</span>
            </div>

            <!-- Header Tabel -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <h2 class="text-2xl font-semibold">Users</h2>
                    <p class="text-gray-500">Daftar pengguna terdaftar di sistem.</p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-500 shadow-sm hover:bg-blue-600 hover-transition">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <span class="hidden md:inline">Add New User</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Pengguna -->
            <div class="overflow-x-auto rounded-xl shadow-sm bg-white border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                                <span class="ml-1 text-gray-400">^</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vendor
                                <span class="ml-1 text-gray-400">^</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Unit
                                <span class="ml-1 text-gray-400">^</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kontak
                                <span class="ml-1 text-gray-400">^</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                                <span class="ml-1 text-gray-400">^</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                                <span class="ml-1 text-gray-400">^</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
                        <!-- Baris Data Contoh -->
                        <!-- The data rows will be generated dynamically by JavaScript -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Pagination -->
    <div class="fixed-pagination">
        <div class="flex flex-col md:flex-row items-center justify-between p-6 bg-gray-50 border-t border-gray-200 rounded-xl card max-w-7xl mx-auto">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <div class="text-sm text-gray-600">
                    <span id="paginationInfo">1-15 dari 300 Baris/Halaman</span>
                </div>
                <div class="relative">
                    <button id="rowsPerPageBtn" class="flex items-center gap-2 px-3 py-1 text-sm rounded-lg bg-white shadow-sm border border-gray-300 hover:bg-gray-100 transition-colors duration-200">
                        <span id="rowsPerPageValue">15</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div id="rowsPerPageDropdown" class="hidden absolute bottom-full mb-2 w-24 rounded-lg shadow-lg bg-white border border-gray-200 z-10">
                        <a href="#" data-value="10" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">10</a>
                        <a href="#" data-value="15" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">15</a>
                        <a href="#" data-value="20" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">20</a>
                        <a href="#" data-value="25" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">25</a>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button class="w-8 h-8 rounded-lg text-gray-500 hover:bg-gray-200 transition-colors duration-200" id="firstPage">
                    <i class="fas fa-angle-double-left"></i>
                </button>
                <button class="w-8 h-8 rounded-lg text-gray-500 hover:bg-gray-200 transition-colors duration-200" id="prevPage">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="paginationLinks" class="flex items-center space-x-2">
                    <!-- Pagination links akan dibuat secara dinamis di sini -->
                </div>
                <button class="w-8 h-8 rounded-lg text-gray-500 hover:bg-gray-200 transition-colors duration-200" id="nextPage">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="w-8 h-8 rounded-lg text-gray-500 hover:bg-gray-200 transition-colors duration-200" id="lastPage">
                    <i class="fas fa-angle-double-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Script untuk fungsionalitas klik -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const kontakCells = document.querySelectorAll('.kontak-cell');
            const waLinks = document.querySelectorAll('.wa-link');
            const userTableBody = document.getElementById('userTableBody');

            const users = [
                { name: 'Nisha Kumari', vendor: 'Hyperlink', unit: 'KID2', contact: '+123 456 789 100', status: 'Inactive', date: '12/03/2024' },
                { name: 'Sophia', vendor: 'Kritrim', unit: 'KID2', contact: '+123 456 789 101', status: 'Inactive', date: '12/03/2024' },
                { name: 'Rudra Pratap', vendor: 'AroLink', unit: 'KID2', contact: '+123 456 789 102', status: 'Active', date: '12/03/2024' },
                { name: 'Trisha Norton', vendor: 'Firelog', unit: 'KID2', contact: '+123 456 789 103', status: 'Active', date: '12/03/2024' },
                { name: 'Ahmad Faisal', vendor: 'TechWave', unit: 'KID1', contact: '+123 456 789 104', status: 'Active', date: '13/03/2024' },
                { name: 'Putri Lestari', vendor: 'InnovateID', unit: 'KID3', contact: '+123 456 789 105', status: 'Inactive', date: '14/03/2024' },
                { name: 'Budi Santoso', vendor: 'DigitalForge', unit: 'KID2', contact: '+123 456 789 106', status: 'Active', date: '15/03/2024' },
                { name: 'Siti Aminah', vendor: 'NetSolutions', unit: 'KID1', contact: '+123 456 789 107', status: 'Inactive', date: '16/03/2024' },
                { name: 'Joko Susilo', vendor: 'CloudNine', unit: 'KID3', contact: '+123 456 789 108', status: 'Active', date: '17/03/2024' },
                { name: 'Dewi Rahayu', vendor: 'DataLink', unit: 'KID2', contact: '+123 456 789 109', status: 'Active', date: '18/03/2024' },
                { name: 'Agus Wijaya', vendor: 'CodeCraft', unit: 'KID1', contact: '+123 456 789 110', status: 'Inactive', date: '19/03/2024' },
                { name: 'Rina Puspita', vendor: 'WebFlow', unit: 'KID3', contact: '+123 456 789 111', status: 'Active', date: '20/03/2024' },
                { name: 'Fahrianto', vendor: 'Syntax', unit: 'KID2', contact: '+123 456 789 112', status: 'Inactive', date: '21/03/2024' },
                { name: 'Indah Sari', vendor: 'PixelPerfect', unit: 'KID1', contact: '+123 456 789 113', status: 'Active', date: '22/03/2024' },
                { name: 'Bayu Prasetya', vendor: 'LogicLabs', unit: 'KID3', contact: '+123 456 789 114', status: 'Active', date: '23/03/2024' },
                { name: 'Ayu Kartika', vendor: 'Cloudify', unit: 'KID2', contact: '+123 456 789 115', status: 'Inactive', date: '24/03/2024' },
            ];
            
            // --- Fungsionalitas Pagination ---
            const totalRows = users.length;
            const paginationInfo = document.getElementById('paginationInfo');
            const paginationLinks = document.getElementById('paginationLinks');
            const firstPageBtn = document.getElementById('firstPage');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const lastPageBtn = document.getElementById('lastPage');
            const rowsPerPageBtn = document.getElementById('rowsPerPageBtn');
            const rowsPerPageValue = document.getElementById('rowsPerPageValue');
            const rowsPerPageDropdown = document.getElementById('rowsPerPageDropdown');

            let currentPage = 1;
            let rowsPerPage = 15;

            function renderUsers() {
                userTableBody.innerHTML = ''; // Hapus baris yang ada

                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const paginatedUsers = users.slice(start, end);

                paginatedUsers.forEach(user => {
                    const row = document.createElement('tr');
                    const statusClass = user.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';

                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                <div class="text-sm font-medium text-gray-900">${user.name}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gray-200"></div>
                                <span class="text-sm text-gray-500">${user.vendor}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.unit}</td>
                        <td class="kontak-cell cursor-pointer px-6 py-4 whitespace-nowrap text-sm text-gray-500 hover:text-blue-500 transition-colors duration-200" data-contact="${user.contact}">
                            <div class="flex items-center gap-2">
                                <span>${user.contact}</span>
                                <a href="#" class="wa-link text-gray-400 hover:text-green-500 transition-colors duration-200">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </td>
                        <td class="status-cell px-6 py-4 whitespace-nowrap relative">
                            <button class="status-button px-2 py-1 inline-flex items-center gap-1 rounded-full text-xs font-semibold ${statusClass} focus:outline-none">
                                <span>${user.status}</span>
                                <i class="fas fa-caret-down"></i>
                            </button>
                            <div class="status-dropdown hidden absolute top-full mt-2 w-32 rounded-lg shadow-lg bg-white z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg">Active</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-lg">Inactive</a>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${user.date}</td>
                    `;
                    userTableBody.appendChild(row);
                });

                // Re-attach event listeners to new rows
                attachEventListeners();
            }

            function updatePagination() {
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                const startRow = (currentPage - 1) * rowsPerPage + 1;
                const endRow = Math.min(currentPage * rowsPerPage, totalRows);

                paginationInfo.textContent = `${startRow}-${endRow} dari ${totalRows} Baris/Halaman`;

                // Update page buttons
                paginationLinks.innerHTML = '';
                const maxVisiblePages = 7;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages && totalPages >= maxVisiblePages) {
                    startPage = endPage - maxVisiblePages + 1;
                }

                if (startPage > 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.className = 'text-gray-500 mx-1';
                    paginationLinks.appendChild(ellipsis);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;
                    button.className = `w-8 h-8 rounded-lg shadow-sm hover-transition text-sm ${i === currentPage ? 'bg-blue-500 text-white hover:bg-blue-600' : 'bg-white text-gray-700 hover:bg-gray-100'}`;
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderUsers();
                        updatePagination();
                    });
                    paginationLinks.appendChild(button);
                }

                if (endPage < totalPages) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.className = 'text-gray-500 mx-1';
                    paginationLinks.appendChild(ellipsis);
                }

                firstPageBtn.disabled = currentPage === 1;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages;
                lastPageBtn.disabled = currentPage === totalPages;

                firstPageBtn.classList.toggle('text-gray-300', currentPage === 1);
                prevPageBtn.classList.toggle('text-gray-300', currentPage === 1);
                nextPageBtn.classList.toggle('text-gray-300', currentPage === totalPages);
                lastPageBtn.classList.toggle('text-gray-300', currentPage === totalPages);
            }

            function attachEventListeners() {
                // Fungsionalitas Dropdown Status
                document.querySelectorAll('.status-button').forEach(button => {
                    button.addEventListener('click', (event) => {
                        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                            if (dropdown !== button.nextElementSibling) {
                                dropdown.classList.add('hidden');
                            }
                        });
                        button.nextElementSibling.classList.toggle('hidden');
                        event.stopPropagation();
                    });
                });

                document.querySelectorAll('.status-dropdown a').forEach(link => {
                    link.addEventListener('click', (event) => {
                        event.preventDefault();
                        const newStatus = event.target.textContent.trim();
                        const statusCell = link.closest('.status-cell');
                        const statusButton = statusCell.querySelector('.status-button');
                        const statusSpan = statusButton.querySelector('span');
                        const dropdown = statusCell.querySelector('.status-dropdown');

                        statusSpan.textContent = newStatus;
                        if (newStatus === 'Active') {
                            statusButton.classList.remove('bg-red-100', 'text-red-800');
                            statusButton.classList.add('bg-green-100', 'text-green-800');
                        } else {
                            statusButton.classList.remove('bg-green-100', 'text-green-800');
                            statusButton.classList.add('bg-red-100', 'text-red-800');
                        }
                        dropdown.classList.add('hidden');
                    });
                });

                // Fungsionalitas WhatsApp dan Salin
                document.querySelectorAll('.wa-link').forEach(link => {
                    link.addEventListener('click', (event) => {
                        event.preventDefault();
                        event.stopPropagation();
                        const cell = link.closest('.kontak-cell');
                        if (cell) {
                            const kontak = cell.getAttribute('data-contact').replace(/\s/g, '');
                            const waUrl = `https://wa.me/${kontak}`;
                            window.open(waUrl, '_blank');
                        }
                    });
                });
                
                document.querySelectorAll('.kontak-cell').forEach(cell => {
                    cell.addEventListener('click', (event) => {
                        if (!event.target.closest('.wa-link') && !event.target.closest('.status-button') && !event.target.closest('.status-dropdown')) {
                            const kontak = cell.getAttribute('data-contact');
                            if (navigator.clipboard) {
                                navigator.clipboard.writeText(kontak).then(() => {
                                    showPopup("Nomor berhasil disalin!");
                                }).catch(err => {
                                    console.error('Gagal menyalin:', err);
                                    showPopup("Gagal menyalin. Salin secara manual.");
                                });
                            } else {
                                const textarea = document.createElement('textarea');
                                textarea.value = kontak;
                                document.body.appendChild(textarea);
                                textarea.select();
                                document.execCommand('copy');
                                document.body.removeChild(textarea);
                                showPopup("Nomor berhasil disalin!");
                            }
                        }
                    });
                });
            }

            // Fungsi untuk Pop-up
            let popupMessage = null;
            let timeoutId = null;
            function showPopup(message) {
                if (popupMessage) {
                    popupMessage.parentNode.removeChild(popupMessage);
                    clearTimeout(timeoutId);
                }

                popupMessage = document.createElement('div');
                popupMessage.className = 'popup-message';
                popupMessage.textContent = message;
                document.body.appendChild(popupMessage);

                setTimeout(() => {
                    popupMessage.classList.add('show');
                }, 10);

                timeoutId = setTimeout(() => {
                    popupMessage.classList.remove('show');
                    setTimeout(() => {
                        if (popupMessage && popupMessage.parentNode) {
                            popupMessage.parentNode.removeChild(popupMessage);
                            popupMessage = null;
                        }
                    }, 300);
                }, 2000);
            }

            // Event listeners for pagination controls
            firstPageBtn.addEventListener('click', () => {
                currentPage = 1;
                renderUsers();
                updatePagination();
            });

            prevPageBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderUsers();
                    updatePagination();
                }
            });

            nextPageBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderUsers();
                    updatePagination();
                }
            });

            lastPageBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                currentPage = totalPages;
                renderUsers();
                updatePagination();
            });

            rowsPerPageBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                rowsPerPageDropdown.classList.toggle('hidden');
            });

            rowsPerPageDropdown.addEventListener('click', (event) => {
                event.preventDefault();
                const newRowsPerPage = event.target.getAttribute('data-value');
                if (newRowsPerPage) {
                    rowsPerPage = parseInt(newRowsPerPage);
                    rowsPerPageValue.textContent = newRowsPerPage;
                    currentPage = 1;
                    rowsPerPageDropdown.classList.add('hidden');
                    renderUsers();
                    updatePagination();
                }
            });

            document.addEventListener('click', (event) => {
                if (!rowsPerPageBtn.contains(event.target) && !rowsPerPageDropdown.contains(event.target)) {
                    rowsPerPageDropdown.classList.add('hidden');
                }
                document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            });

            // Initial call to render users and set up pagination
            renderUsers();
            updatePagination();

        });
    </script>
</body>
</html>
