<!DOCTYPE html>
<html lang="id">
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

        /* Gaya untuk modal pop-up */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            text-align: center;
            transform: translateY(-20px);
            transition: transform 0.3s ease-in-out;
        }
        .modal-overlay.show .modal-content {
            transform: translateY(0);
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
                    <!-- Bilah pencarian di sini -->
                    <input type="text" id="searchInput" placeholder="Cari..." class="w-full pl-10 pr-4 py-2 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover-transition">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
            </div>
        </header>

        <!-- Main Content (Dashboard View) -->
        <main id="dashboardView" class="space-y-6">
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
                    <button id="addNewUserBtn" class="flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-500 shadow-sm hover:bg-blue-600 hover-transition">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <span class="hidden md:inline">Tambah Pengguna Baru</span>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
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
        
        <!-- Main Content (Sync Contacts View - New and Initially Hidden) -->
        <main id="syncContactsView" class="hidden space-y-6">
            <!-- Breadcrumb for Sync Contacts -->
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <button id="backFromSyncBtn" class="font-semibold text-blue-500 hover:underline">Dashboard</button>
                <span>/</span>
                <span class="font-semibold text-blue-500">Tambah Kontak</span>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-6 max-w-lg mx-auto">
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-semibold">Verifikasi Nomor Telepon</h3>
                    <p class="text-gray-500 text-sm">Pilih kode negara dan masukkan nomor telepon Anda.</p>
                </div>
                <div class="space-y-4">
                    <!-- Dropdown Kode Negara yang bisa diketik -->
                    <div>
                        <label for="countryCodeInput" class="block text-sm font-medium text-gray-700">Kode Negara</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="tel" id="countryCodeInput" name="countryCode" required placeholder="+62" class="flex-shrink-0 w-24 p-2 rounded-l-md border border-r-0 border-gray-300 focus:border-blue-500 focus:ring-blue-500" list="countryCodes">
                            <datalist id="countryCodes">
                                <!-- Options will be populated by JS -->
                            </datalist>
                            <input type="text" id="countryName" name="countryName" disabled placeholder="Nama Negara" class="block w-full rounded-r-md bg-gray-100 text-gray-600 border border-gray-300 p-2 cursor-not-allowed">
                        </div>
                    </div>
                    
                    <!-- Input Nomor Telepon -->
                    <div>
                        <label for="phoneNumber" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" required placeholder="Masukkan nomor telepon Anda" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                        <p id="phoneError" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <!-- Tombol Lanjutkan dan Batal -->
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" id="cancelSyncBtn" class="px-4 py-2 rounded-lg text-gray-700 bg-gray-200 shadow-sm hover:bg-gray-300 hover-transition">Batal</button>
                        <button type="button" id="continueBtn" class="px-4 py-2 rounded-lg text-white bg-blue-500 shadow-sm hover:bg-blue-600 hover-transition">Lanjutkan</button>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Main Content (Add User View - Initially Hidden) -->
        <main id="addUserView" class="hidden space-y-6">
            <!-- Breadcrumb for Add User -->
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <button id="backToDashboardBtn" class="font-semibold text-blue-500 hover:underline">Dashboard</button>
                <span>/</span>
                <span class="font-semibold text-blue-500">Tambah Pengguna</span>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Tambah Pengguna Baru</h3>
                </div>
    
                <!-- Form untuk memasukkan data pengguna -->
                <form id="addUserForm" class="space-y-4">
                    <div>
                        <label for="userName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="userName" name="userName" required placeholder="Masukkan nama lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>
                    <div>
                        <label for="userVendor" class="block text-sm font-medium text-gray-700">Vendor</label>
                        <input type="text" id="userVendor" name="userVendor" required placeholder="Masukkan nama vendor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>
                    <div>
                        <label for="userUnit" class="block text-sm font-medium text-gray-700">Unit</label>
                        <select id="userUnit" name="userUnit" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                            <option value="KID">KID</option>
                            <option value="KIDC">KIDC</option>
                            <option value="KIDD">KIDD</option>
                            <option value="Logistik">Logistik</option>
                        </select>
                    </div>
                    <div>
                        <label for="userStatus" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="userStatus" name="userStatus" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" id="cancelAddBtn" class="px-4 py-2 rounded-lg text-gray-700 bg-gray-200 shadow-sm hover:bg-gray-300 hover-transition">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded-lg text-white bg-blue-500 shadow-sm hover:bg-blue-600 hover-transition">Simpan</button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Main Content (Edit User View - New and Initially Hidden) -->
        <main id="editUserView" class="hidden space-y-6">
            <!-- Breadcrumb for Edit User -->
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <button id="backFromEditBtn" class="font-semibold text-blue-500 hover:underline">Dashboard</button>
                <span>/</span>
                <span class="font-semibold text-blue-500">Edit Pengguna</span>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Edit Pengguna</h3>
                </div>
    
                <!-- Form untuk mengedit data pengguna -->
                <form id="editUserForm" class="space-y-4">
                    <input type="hidden" id="editUserId">
                    <div>
                        <label for="editUserName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="editUserName" name="editUserName" required placeholder="Masukkan nama lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>
                    <div>
                        <label for="editUserVendor" class="block text-sm font-medium text-gray-700">Vendor</label>
                        <input type="text" id="editUserVendor" name="editUserVendor" required placeholder="Masukkan nama vendor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>
                    <div>
                        <label for="editUserUnit" class="block text-sm font-medium text-gray-700">Unit</label>
                        <select id="editUserUnit" name="editUserUnit" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                            <option value="KID">KID</option>
                            <option value="KIDC">KIDC</option>
                            <option value="KIDD">KIDD</option>
                            <option value="Logistik">Logistik</option>
                        </select>
                    </div>
                    <div>
                        <label for="editUserStatus" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="editUserStatus" name="editUserStatus" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end pt-4 gap-4">
                        <button type="button" id="cancelEditBtn" class="px-4 py-2 rounded-lg text-gray-700 bg-gray-200 shadow-sm hover:bg-gray-300 hover-transition">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded-lg text-white bg-blue-500 shadow-sm hover:bg-blue-600 hover-transition">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Modal Pop-up -->
    <div id="customModal" class="modal-overlay hidden">
        <div class="modal-content">
            <div id="modalIcon" class="mb-4">
                <!-- Ikon akan disuntikkan di sini -->
            </div>
            <h4 id="modalTitle" class="text-xl font-bold mb-2"></h4>
            <p id="modalMessage" class="text-gray-700 mb-4"></p>
            <div class="flex justify-center gap-4">
                <button id="confirmBtn" class="px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600 hover-transition hidden">Hapus</button>
                <button id="cancelConfirmBtn" class="px-4 py-2 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 hover-transition hidden">Batal</button>
                <button id="closeModalBtn" class="px-4 py-2 rounded-lg text-white bg-blue-500 hover:bg-blue-600 hover-transition">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="fixed-pagination">
        <div class="flex flex-col md:flex-row items-center justify-between p-6 bg-gray-50 border-t border-gray-200 rounded-xl card max-w-7xl mx-auto">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <div class="text-sm text-gray-600">
                    <span id="paginationInfo">1-3 dari 3 Baris/Halaman</span>
                </div>
                <div class="relative">
                    <button id="rowsPerPageBtn" class="flex items-center gap-2 px-3 py-1 text-sm rounded-lg bg-white shadow-sm border border-gray-300 hover:bg-gray-100 transition-colors duration-200">
                        <span id="rowsPerPageValue">3</span>
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
            const dashboardView = document.getElementById('dashboardView');
            const syncContactsView = document.getElementById('syncContactsView');
            const addUserView = document.getElementById('addUserView');
            const editUserView = document.getElementById('editUserView'); // New edit view
            const addNewUserBtn = document.getElementById('addNewUserBtn');
            const backFromSyncBtn = document.getElementById('backFromSyncBtn');
            const continueBtn = document.getElementById('continueBtn');
            const cancelSyncBtn = document.getElementById('cancelSyncBtn');
            const backToDashboardBtn = document.getElementById('backToDashboardBtn');
            const backFromEditBtn = document.getElementById('backFromEditBtn');
            const cancelAddBtn = document.getElementById('cancelAddBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn'); // New cancel edit button
            const addUserForm = document.getElementById('addUserForm');
            const editUserForm = document.getElementById('editUserForm'); // New edit form
            const userTableBody = document.getElementById('userTableBody');
            const customModal = document.getElementById('customModal'); // New custom modal
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalIcon = document.getElementById('modalIcon');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const confirmBtn = document.getElementById('confirmBtn');
            const cancelConfirmBtn = document.getElementById('cancelConfirmBtn');
            const paginationContainer = document.getElementById('paginationContainer');
            const searchInput = document.getElementById('searchInput'); // New search input

            // Data pengguna dummy
            const users = [
                { id: 1, name: 'Nisha Kumari', vendor: 'Hyperlink', unit: 'KID', contact: '+62 812 3456 7890', status: 'Inactive', date: '12/03/2024' },
                { id: 2, name: 'Sophia', vendor: 'Kritrim', unit: 'KID', contact: '+62 812 3456 7891', status: 'Inactive', date: '12/03/2024' },
                { id: 3, name: 'Rudra Pratap', vendor: 'AroLink', unit: 'KID', contact: '+62 812 3456 7892', status: 'Active', date: '12/03/2024' },
            ];

            // Data kode negara (hanya 5 sesuai permintaan)
            const countries = [
                { code: '+62', name: 'Indonesia' },
                { code: '+65', name: 'Singapura' },
                { code: '+60', name: 'Malaysia' },
                { code: '+91', name: 'India' },
                { code: '+1', name: 'Amerika Serikat' },
            ];
            const countryCodeInput = document.getElementById('countryCodeInput');
            const countryNameInput = document.getElementById('countryName');
            const countryCodesDatalist = document.getElementById('countryCodes');
            
            // Elemen validasi dan input nomor telepon
            const phoneNumberInput = document.getElementById('phoneNumber');
            const phoneError = document.getElementById('phoneError');

            // Variable untuk menyimpan nomor telepon dan id pengguna yang diedit
            let userPhoneNumber = '';
            let userToEditId = null;

            // Isi datalist kode negara
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.code;
                option.label = country.name;
                countryCodesDatalist.appendChild(option);
            });

            // Perbarui nama negara saat input kode negara berubah
            countryCodeInput.addEventListener('input', () => {
                const inputValue = countryCodeInput.value;
                const foundCountry = countries.find(country => country.code === inputValue);
                if (foundCountry) {
                    countryNameInput.value = foundCountry.name;
                    phoneNumberInput.value = inputValue + ' '; // Tambahkan spasi setelah kode negara
                    phoneNumberInput.focus(); // Fokuskan kursor ke input nomor telepon
                } else {
                    countryNameInput.value = '';
                }
            });

            // Set default value saat halaman dimuat
            const defaultCountryOption = countries.find(country => country.code === '+62');
            if (defaultCountryOption) {
                countryCodeInput.value = '+62';
                countryNameInput.value = defaultCountryOption.name;
                phoneNumberInput.value = defaultCountryOption.code + ' ';
            }

            // Fungsi untuk memformat nomor telepon saat diketik
            phoneNumberInput.addEventListener('input', (event) => {
                const countryCode = countryCodeInput.value.trim();
                const prefix = countryCode ? countryCode + ' ' : '';
                
                // Hapus kode negara, spasi, dan karakter non-digit dari nilai
                let rawNumber = event.target.value.substring(prefix.length).replace(/\D/g, '');
                
                let formattedNumber = '';
                if (rawNumber.length > 0) {
                    // Format menjadi 3 digit spasi 4 digit spasi, sisanya bebas
                    formattedNumber += rawNumber.substring(0, 3);
                    if (rawNumber.length > 3) {
                        formattedNumber += ' ' + rawNumber.substring(3, 7);
                    }
                    if (rawNumber.length > 7) {
                        formattedNumber += ' ' + rawNumber.substring(7);
                    }
                }
                
                event.target.value = prefix + formattedNumber.trim();
                
                if (rawNumber.length >= 8) {
                    phoneError.classList.add('hidden');
                }
            });
            
            // --- Fungsionalitas Pencarian & Pagination ---
            let currentPage = 1;
            let rowsPerPage = 3;
            const paginationInfo = document.getElementById('paginationInfo');
            const paginationLinks = document.getElementById('paginationLinks');
            const firstPageBtn = document.getElementById('firstPage');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const lastPageBtn = document.getElementById('lastPage');
            const rowsPerPageBtn = document.getElementById('rowsPerPageBtn');
            const rowsPerPageValue = document.getElementById('rowsPerPageValue');
            const rowsPerPageDropdown = document.getElementById('rowsPerPageDropdown');

            function renderUsers(filteredUsers = users) {
                userTableBody.innerHTML = ''; // Hapus baris yang ada

                const totalRows = filteredUsers.length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const paginatedUsers = filteredUsers.slice(start, end);

                if (paginatedUsers.length === 0) {
                    const emptyRow = document.createElement('tr');
                    emptyRow.innerHTML = `<td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data pengguna.</td>`;
                    userTableBody.appendChild(emptyRow);
                } else {
                    paginatedUsers.forEach(user => {
                        const row = document.createElement('tr');
                        row.dataset.userId = user.id; // Tambahkan data attribute untuk ID
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button class="edit-btn text-blue-600 hover:text-blue-900" data-id="${user.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="delete-btn text-red-600 hover:text-red-900" data-id="${user.id}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                        userTableBody.appendChild(row);
                    });
                }


                // Re-attach event listeners to new rows
                attachEventListeners();
                updatePagination(totalRows); // Panggil ini setelah merender pengguna
            }

            function updatePagination(totalRows) {
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
                        const searchQuery = searchInput.value.toLowerCase();
                        const filteredUsers = filterUsers(searchQuery);
                        renderUsers(filteredUsers);
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

            function filterUsers(query) {
                const lowerCaseQuery = query.toLowerCase();
                return users.filter(user =>
                    user.name.toLowerCase().includes(lowerCaseQuery) ||
                    user.vendor.toLowerCase().includes(lowerCaseQuery) ||
                    user.unit.toLowerCase().includes(lowerCaseQuery) ||
                    user.contact.toLowerCase().replace(/\s/g, '').includes(lowerCaseQuery.replace(/\s/g, ''))
                );
            }
            
            searchInput.addEventListener('input', (event) => {
                const query = event.target.value;
                const filteredUsers = filterUsers(query);
                currentPage = 1; // Reset ke halaman pertama saat mencari
                renderUsers(filteredUsers);
            });


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
                            statusButton.classList.remove('bg-green-100', 'text-red-800');
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
                                    showCustomModal('success', 'Berhasil Disalin!', 'Nomor berhasil disalin ke papan klip.');
                                }).catch(err => {
                                    console.error('Gagal menyalin:', err);
                                    showCustomModal('error', 'Gagal!', 'Gagal menyalin. Silakan salin secara manual.');
                                });
                            } else {
                                const textarea = document.createElement('textarea');
                                textarea.value = kontak;
                                document.body.appendChild(textarea);
                                textarea.select();
                                document.execCommand('copy');
                                showCustomModal('success', 'Berhasil Disalin!', 'Nomor berhasil disalin ke papan klip.');
                            }
                        }
                    });
                });

                // Fungsionalitas Tombol Edit
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const userId = parseInt(button.dataset.id);
                        userToEditId = userId;
                        const user = users.find(u => u.id === userId);
                        if (user) {
                            document.getElementById('editUserName').value = user.name;
                            document.getElementById('editUserVendor').value = user.vendor;
                            document.getElementById('editUserUnit').value = user.unit;
                            document.getElementById('editUserStatus').value = user.status;
                            showEditUserForm();
                        }
                    });
                });

                // Fungsionalitas Tombol Hapus
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const userId = parseInt(button.dataset.id);
                        showCustomModal('confirm', 'Konfirmasi Hapus', 'Apakah Anda yakin ingin menghapus pengguna ini?', () => {
                            const userIndex = users.findIndex(u => u.id === userId);
                            if (userIndex !== -1) {
                                users.splice(userIndex, 1);
                                const searchQuery = searchInput.value.toLowerCase();
                                const filteredUsers = filterUsers(searchQuery);
                                renderUsers(filteredUsers);
                                showCustomModal('success', 'Berhasil Dihapus!', 'Pengguna berhasil dihapus.');
                            }
                        });
                    });
                });
            }

            // Fungsi untuk menampilkan modal pop-up kustom
            function showCustomModal(type, title, message, onConfirm = null) {
                modalTitle.textContent = title;
                modalMessage.textContent = message;
                closeModalBtn.classList.remove('hidden');
                confirmBtn.classList.add('hidden');
                cancelConfirmBtn.classList.add('hidden');

                if (type === 'success') {
                    modalIcon.innerHTML = `<svg class="w-16 h-16 text-green-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                } else if (type === 'error') {
                    modalIcon.innerHTML = `<svg class="w-16 h-16 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
                } else if (type === 'confirm') {
                    modalIcon.innerHTML = `<svg class="w-16 h-16 text-yellow-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`;
                    closeModalBtn.classList.add('hidden');
                    confirmBtn.classList.remove('hidden');
                    cancelConfirmBtn.classList.remove('hidden');
                    confirmBtn.onclick = () => { onConfirm(); hideModal(); };
                    cancelConfirmBtn.onclick = () => hideModal();
                }

                customModal.classList.remove('hidden');
                customModal.classList.add('show');
            }

            // Fungsi untuk menyembunyikan modal pop-up
            function hideModal() {
                customModal.classList.remove('show');
                setTimeout(() => {
                    customModal.classList.add('hidden');
                }, 300); // Tunggu sampai transisi selesai
            }
            closeModalBtn.addEventListener('click', hideModal);

            // Event listeners untuk peralihan tampilan
            function showDashboard() {
                dashboardView.classList.remove('hidden');
                paginationContainer.classList.remove('hidden');
                syncContactsView.classList.add('hidden');
                addUserView.classList.add('hidden');
                editUserView.classList.add('hidden'); // Sembunyikan view edit
                // Reset form saat kembali ke dashboard
                phoneNumberInput.value = '';
                phoneError.classList.add('hidden');
                // Render ulang dengan data terbaru dan hasil pencarian
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers);
            }

            function showSyncContactsForm() {
                dashboardView.classList.add('hidden');
                paginationContainer.classList.add('hidden');
                syncContactsView.classList.remove('hidden');
                addUserView.classList.add('hidden');
                editUserView.classList.add('hidden'); // Sembunyikan view edit
                // Atur kembali placeholder dan value saat form ditampilkan
                const defaultCountry = countries.find(country => country.code === '+62');
                if (defaultCountry) {
                    countryCodeInput.value = '+62';
                    countryNameInput.value = defaultCountry.name;
                    phoneNumberInput.value = defaultCountry.code + ' ';
                }
            }

            function showAddUserForm() {
                dashboardView.classList.add('hidden');
                paginationContainer.classList.add('hidden');
                syncContactsView.classList.add('hidden');
                addUserView.classList.remove('hidden');
                editUserView.classList.add('hidden'); // Sembunyikan view edit
            }

            function showEditUserForm() {
                dashboardView.classList.add('hidden');
                paginationContainer.classList.add('hidden');
                syncContactsView.classList.add('hidden');
                addUserView.classList.add('hidden');
                editUserView.classList.remove('hidden'); // Tampilkan view edit
            }

            // Navigasi
            addNewUserBtn.addEventListener('click', showSyncContactsForm);
            backFromSyncBtn.addEventListener('click', showDashboard);
            cancelSyncBtn.addEventListener('click', showDashboard);
            backToDashboardBtn.addEventListener('click', showDashboard);
            cancelAddBtn.addEventListener('click', showDashboard);
            backFromEditBtn.addEventListener('click', showDashboard);
            cancelEditBtn.addEventListener('click', showDashboard);

            continueBtn.addEventListener('click', () => {
                const fullPhoneNumber = phoneNumberInput.value.trim();
                const selectedCode = countryCodeInput.value.trim();
                
                // Ambil hanya digit dari nomor telepon dan hapus kode negara
                const rawNumber = fullPhoneNumber.replace(/\D/g, ''); // Hapus semua non-digit
                const phoneNumberWithoutCode = rawNumber.startsWith(selectedCode.replace(/\D/g, '')) ? rawNumber.substring(selectedCode.replace(/\D/g, '').length) : rawNumber;

                // Validasi
                if (phoneNumberWithoutCode === '' || isNaN(phoneNumberWithoutCode) || phoneNumberWithoutCode.length < 8) {
                    phoneError.classList.remove('hidden');
                    phoneError.textContent = 'Nomor telepon tidak valid. Masukkan minimal 8 digit angka setelah kode negara.';
                } else {
                    phoneError.classList.add('hidden');
                    userPhoneNumber = fullPhoneNumber; // Simpan nomor telepon yang sudah diformat
                    showAddUserForm();
                }
            });


            addUserForm.addEventListener('submit', (event) => {
                event.preventDefault();

                const newId = users.length > 0 ? Math.max(...users.map(u => u.id)) + 1 : 1;

                const newUser = {
                    id: newId,
                    name: document.getElementById('userName').value,
                    vendor: document.getElementById('userVendor').value,
                    unit: document.getElementById('userUnit').value,
                    contact: userPhoneNumber, // Gunakan nomor telepon dari langkah sebelumnya
                    status: document.getElementById('userStatus').value,
                    date: new Date().toLocaleDateString('id-ID'),
                };
                
                users.unshift(newUser); // Menggunakan unshift() untuk menambahkan di awal array
                
                addUserForm.reset();
                showDashboard();
                currentPage = 1; // Reset ke halaman pertama saat menambahkan pengguna baru
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers); // Render ulang tabel untuk menampilkan data baru
                showCustomModal('success', 'Berhasil Ditambahkan!', 'Pengguna baru berhasil ditambahkan.'); // Tampilkan modal pop-up
            });

            editUserForm.addEventListener('submit', (event) => {
                event.preventDefault();

                const editedUserIndex = users.findIndex(u => u.id === userToEditId);
                if (editedUserIndex !== -1) {
                    users[editedUserIndex].name = document.getElementById('editUserName').value;
                    users[editedUserIndex].vendor = document.getElementById('editUserVendor').value;
                    users[editedUserIndex].unit = document.getElementById('editUserUnit').value;
                    users[editedUserIndex].status = document.getElementById('editUserStatus').value;
                }

                showDashboard();
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers);
                showCustomModal('success', 'Berhasil Diperbarui!', 'Data pengguna berhasil diperbarui.');
            });

            // Event Listeners untuk Pagination
            firstPageBtn.addEventListener('click', () => {
                currentPage = 1;
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers);
            });
            prevPageBtn.addEventListener('click', () => {
                currentPage = Math.max(1, currentPage - 1);
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers);
            });
            nextPageBtn.addEventListener('click', () => {
                const totalRows = filterUsers(searchInput.value.toLowerCase()).length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                currentPage = Math.min(totalPages, currentPage + 1);
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers);
            });
            lastPageBtn.addEventListener('click', () => {
                const totalRows = filterUsers(searchInput.value.toLowerCase()).length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                currentPage = totalPages;
                const searchQuery = searchInput.value.toLowerCase();
                const filteredUsers = filterUsers(searchQuery);
                renderUsers(filteredUsers);
            });

            // Event Listener untuk Dropdown Rows per Halaman
            rowsPerPageBtn.addEventListener('click', (event) => {
                rowsPerPageDropdown.classList.toggle('hidden');
                event.stopPropagation();
            });

            document.querySelectorAll('#rowsPerPageDropdown a').forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    rowsPerPage = parseInt(event.target.getAttribute('data-value'));
                    rowsPerPageValue.textContent = rowsPerPage;
                    currentPage = 1;
                    const searchQuery = searchInput.value.toLowerCase();
                    const filteredUsers = filterUsers(searchQuery);
                    renderUsers(filteredUsers);
                    rowsPerPageDropdown.classList.add('hidden');
                });
            });

            // Sembunyikan dropdown jika mengklik di luar
            document.addEventListener('click', (event) => {
                if (!rowsPerPageBtn.contains(event.target)) {
                    rowsPerPageDropdown.classList.add('hidden');
                }
            });
            
            // Panggilan awal untuk merender pengguna dan menyiapkan paginasi
            renderUsers();
        });
    </script>
</body>
</html>
