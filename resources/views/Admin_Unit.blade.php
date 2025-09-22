<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manajemen Unit</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fc;
        }
        .dashboard-container {
            display: grid;
            grid-template-columns: 1fr;
            min-height: 100vh;
            background-color: #f0f4f8;
        }
        @media (min-width: 768px) {
            .dashboard-container {
                grid-template-columns: 280px 1fr;
            }
        }
        .sidebar {
            background-color: #2e3a4e;
            color: #d1d5db;
            padding: 2.5rem 1.5rem;
            display: none;
            flex-direction: column;
            gap: 2rem;
        }
        @media (min-width: 768px) {
            .sidebar {
                display: flex;
            }
        }
        .main-content {
            padding: 1.5rem;
            flex-grow: 1;
        }
        .clean-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }
        .btn-primary {
            @apply bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 ease-in-out hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.4);
        }
        .btn-secondary {
            @apply bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-xl transition-all duration-300 ease-in-out hover:bg-gray-300;
        }
        .btn-danger {
            @apply bg-red-600 text-white font-medium py-3 px-6 rounded-xl transition-all duration-300 ease-in-out hover:bg-red-700;
        }
        .input-field {
            @apply block w-full rounded-xl border-2 border-gray-200 bg-gray-50 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200;
        }
        .status-badge {
            @apply inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase;
            letter-spacing: 0.5px;
        }
        .status-aktif { @apply bg-green-100 text-green-700; }
        .status-tidak-aktif { @apply bg-red-100 text-red-700; }
        .status-dalam-perbaikan { @apply bg-yellow-100 text-yellow-700; }
        .hidden { display: none; }
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
        }
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            max-width: 400px;
            text-align: center;
            animation: fadeInScale 0.3s ease-in-out;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-200 ease-in-out z-40" id="sidebar">
            <div class="flex items-center gap-4 mb-8">
                <!-- Vemos Logo SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.66663 16C2.66663 8.35567 8.35567 2.66663 16 2.66663C23.6443 2.66663 29.3333 8.35567 29.3333 16C29.3333 23.6443 23.6443 29.3333 16 29.3333C8.35567 29.3333 2.66663 23.6443 2.66663 16Z" stroke="#d1d5db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16.8839C12.8795 16.8839 13.6288 16.5925 14.1873 16.0339L15.9998 14.2214L17.8123 16.0339C18.3709 16.5925 19.1201 16.8839 19.9997 16.8839C21.8727 16.8839 23.4616 15.295 23.4616 13.422C23.4616 11.5491 21.8727 9.96023 19.9997 9.96023C19.1201 9.96023 18.3709 10.2516 17.8123 10.8102L15.9998 12.6227L14.1873 10.8102C13.6288 10.2516 12.8795 9.96023 12 9.96023C10.1271 9.96023 8.53819 11.5491 8.53819 13.422C8.53819 15.295 10.1271 16.8839 12 16.8839Z" fill="#d1d5db"/>
                </svg>
                <span class="text-xl font-bold text-white">VEMOS</span>
            </div>
            <nav class="flex-grow">
                <a href="#" class="flex items-center gap-4 py-3 px-4 rounded-xl text-white font-semibold bg-violet-600 shadow-lg">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex flex-col">
            <!-- Header for mobile (or to show menu button) -->
            <header class="flex md:hidden items-center justify-between mb-8">
                <button id="menu-btn" class="p-2 text-gray-700">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center gap-4">
                    <!-- Vemos Logo SVG -->
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-gray-900">
                        <path d="M2.66663 16C2.66663 8.35567 8.35567 2.66663 16 2.66663C23.6443 2.66663 29.3333 8.35567 29.3333 16C29.3333 23.6443 23.6443 29.3333 16 29.3333C8.35567 29.3333 2.66663 23.6443 2.66663 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 16.8839C12.8795 16.8839 13.6288 16.5925 14.1873 16.0339L15.9998 14.2214L17.8123 16.0339C18.3709 16.5925 19.1201 16.8839 19.9997 16.8839C21.8727 16.8839 23.4616 15.295 23.4616 13.422C23.4616 11.5491 21.8727 9.96023 19.9997 9.96023C19.1201 9.96023 18.3709 10.2516 17.8123 10.8102L15.9998 12.6227L14.1873 10.8102C13.6288 10.2516 12.8795 9.96023 12 9.96023C10.1271 9.96023 8.53819 11.5491 8.53819 13.422C8.53819 15.295 10.1271 16.8839 12 16.8839Z" fill="currentColor"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-900">VEMOS</span>
                </div>
            </header>

            <!-- Dashboard Page -->
            <div id="dashboard-page">
                <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                        <p class="text-gray-500 mt-1 text-lg">Manajemen Unit</p>
                    </div>
                    <button id="add-unit-btn" class="btn-primary flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Unit</span>
                    </button>
                </header>

                <div class="clean-card mb-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div class="relative w-full sm:w-64">
                            <input type="text" id="search-input" class="input-field pl-10" placeholder="Cari Unit">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <div class="relative w-full sm:w-36">
                                <select id="status-filter" class="input-field appearance-none pr-10">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                    <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            <div class="relative w-full sm:w-36">
                                <select id="unit-filter" class="input-field appearance-none pr-10">
                                    <option value="">Semua Unit</option>
                                    <!-- Unit options will be populated dynamically -->
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-xl">
                        <table class="min-w-full leading-normal bg-white border-collapse">
                            <thead>
                                <tr class="text-left text-sm font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                                    <th class="px-5 py-4">NO</th>
                                    <th class="px-5 py-4">Nama Unit</th>
                                    <th class="px-5 py-4">Status</th>
                                    <th class="px-5 py-4">Dibuat Pada</th>
                                    <th class="px-5 py-4">Diperbarui Pada</th>
                                    <th class="px-5 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="unit-list">
                                <!-- Table rows will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination-controls" class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <!-- Pagination section for future development -->
                    </div>
                </div>
            </div>

            <!-- Add/Edit Unit Page -->
            <div id="form-page" class="hidden">
                <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 id="form-title" class="text-3xl font-bold text-gray-900"></h1>
                        <p class="text-gray-500 mt-1 text-lg">Manajemen Unit</p>
                    </div>
                </header>
                <div class="clean-card">
                    <div class="mb-6">
                        <label for="form-unit-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Unit</label>
                        <input type="text" id="form-unit-name" class="input-field" placeholder="Masukkan Nama Unit">
                    </div>
                    <div class="mb-8">
                        <label for="form-status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div id="form-status-dropdown" class="relative">
                            <button id="form-status-toggle" class="custom-dropdown-toggle input-field flex items-center justify-between" type="button">
                                <span id="selected-status-text">Pilih Status</span>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>
                            <div id="form-status-menu" class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-200 hidden">
                                <div class="custom-dropdown-item px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer" data-value="Aktif">Aktif</div>
                                <div class="custom-dropdown-item px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer" data-value="Tidak Aktif">Tidak Aktif</div>
                                <div class="custom-dropdown-item px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer" data-value="Dalam Perbaikan">Dalam Perbaikan</div>
                            </div>
                            <input type="hidden" id="form-status-input" name="form-status-input">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <button id="form-cancel-btn" class="btn-secondary">
                            Batal
                        </button>
                        <button id="form-save-btn" class="btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="delete-modal" class="hidden modal-overlay">
        <div class="modal-content">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Unit</h3>
            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus unit ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex items-center justify-center gap-4">
                <button id="modal-cancel-btn" class="btn-secondary">Batal</button>
                <button id="modal-confirm-btn" class="btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <!-- Modal Validasi -->
    <div id="validation-modal" class="hidden modal-overlay">
        <div class="modal-content">
            <h3 class="text-lg font-bold text-red-600 mb-2">Peringatan!</h3>
            <p id="validation-message" class="text-gray-700 mb-4"></p>
            <button onclick="document.getElementById('validation-modal').classList.add('hidden')" class="btn-primary">Tutup</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- DOM ELEMENTS ---
            const dashboardPage = document.getElementById('dashboard-page');
            const formPage = document.getElementById('form-page');
            const unitList = document.getElementById('unit-list');
            const addUnitBtn = document.getElementById('add-unit-btn');
            const formTitle = document.getElementById('form-title');
            const formUnitName = document.getElementById('form-unit-name');
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const unitFilter = document.getElementById('unit-filter');
            const deleteModal = document.getElementById('delete-modal');
            const modalConfirmBtn = document.getElementById('modal-confirm-btn');
            const modalCancelBtn = document.getElementById('modal-cancel-btn');
            const validationModal = document.getElementById('validation-modal');
            const validationMessage = document.getElementById('validation-message');

            const formStatusDropdown = document.getElementById('form-status-dropdown');
            const formStatusToggle = document.getElementById('form-status-toggle');
            const formStatusMenu = document.getElementById('form-status-menu');
            const selectedStatusText = document.getElementById('selected-status-text');
            const formStatusInput = document.getElementById('form-status-input');
            const formSaveBtn = document.getElementById('form-save-btn');
            const formCancelBtn = document.getElementById('form-cancel-btn');

            // --- STATE ---
            let units = [
                { id: `unit-${Date.now() + 1}`, name: 'KID2', status: 'Tidak Aktif', createdAt: '18/08/2025', updatedAt: '21/08/2025' },
                { id: `unit-${Date.now() + 2}`, name: 'Unit A', status: 'Aktif', createdAt: '18/08/2025', updatedAt: '21/08/2025' },
                { id: `unit-${Date.now() + 3}`, name: 'Unit B', status: 'Tidak Aktif', createdAt: '18/08/2025', updatedAt: '21/08/2025' },
                { id: `unit-${Date.now() + 4}`, name: 'Gudang Pusat', status: 'Aktif', createdAt: '15/07/2025', updatedAt: '15/07/2025' },
                { id: `unit-${Date.now() + 5}`, name: 'Kantor Cabang', status: 'Dalam Perbaikan', createdAt: '10/06/2025', updatedAt: '25/08/2025' },
            ];
            let editingUnitId = null;
            let unitIdToDelete = null;

            // --- FUNCTIONS ---
            const formatDate = (date) => {
                const d = new Date(date);
                const day = String(d.getDate()).padStart(2, '0');
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const year = d.getFullYear();
                return `${day}/${month}/${year}`;
            };

            const showPage = (pageToShow) => {
                dashboardPage.classList.add('hidden');
                formPage.classList.add('hidden');
                pageToShow.classList.remove('hidden');
            };

            const renderTable = (dataToRender) => {
                unitList.innerHTML = '';
                if (dataToRender.length === 0) {
                    unitList.innerHTML = `<tr><td colspan="6" class="text-center py-10 text-gray-500">Tidak ada data yang ditemukan.</td></tr>`;
                    return;
                }
                dataToRender.forEach((unit, index) => {
                    let statusClass = '';
                    if (unit.status === 'Aktif') {
                        statusClass = 'status-aktif';
                    } else if (unit.status === 'Tidak Aktif') {
                        statusClass = 'status-tidak-aktif';
                    } else {
                        statusClass = 'status-dalam-perbaikan';
                    }
                    const rowHTML = `
                        <tr class="border-b border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-5 py-4 text-sm whitespace-nowrap">${index + 1}</td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap font-medium text-gray-900">${unit.name}</td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                <span class="status-badge ${statusClass}">
                                    ${unit.status}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">${unit.createdAt}</td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">${unit.updatedAt}</td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <button data-id="${unit.id}" class="edit-unit-btn text-blue-600 hover:text-blue-800 transition-colors duration-200 p-2 rounded-full hover:bg-blue-100">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-id="${unit.id}" class="delete-unit-btn text-red-600 hover:text-red-800 transition-colors duration-200 p-2 rounded-full hover:bg-red-100">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    unitList.innerHTML += rowHTML;
                });
            };

            const populateUnitFilter = () => {
                const uniqueUnits = [...new Set(units.map(unit => unit.name))];
                unitFilter.innerHTML = '<option value="">Semua Unit</option>';
                uniqueUnits.sort().forEach(unitName => {
                    const option = document.createElement('option');
                    option.value = unitName;
                    option.textContent = unitName;
                    unitFilter.appendChild(option);
                });
            };

            const filterAndRender = () => {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value;
                const selectedUnit = unitFilter.value;

                let filteredUnits = units.filter(unit => {
                    const matchesSearch = unit.name.toLowerCase().includes(searchTerm);
                    const matchesStatus = selectedStatus === '' || unit.status === selectedStatus;
                    const matchesUnit = selectedUnit === '' || unit.name === selectedUnit;
                    return matchesSearch && matchesStatus && matchesUnit;
                });
                renderTable(filteredUnits);
            };

            const resetForm = () => {
                formUnitName.value = '';
                selectedStatusText.textContent = 'Pilih Status';
                formStatusInput.value = '';
                formStatusMenu.classList.add('hidden');
                editingUnitId = null;
            }

            const handleSave = () => {
                const name = formUnitName.value.trim();
                const status = formStatusInput.value;
                if (!name || !status) {
                    validationMessage.textContent = "Nama Unit dan Status harus diisi.";
                    validationModal.classList.remove('hidden');
                    return;
                }

                if (editingUnitId) {
                    const unitIndex = units.findIndex(u => u.id === editingUnitId);
                    if (unitIndex > -1) {
                        units[unitIndex] = { ...units[unitIndex], name, status, updatedAt: formatDate(new Date()) };
                    }
                } else {
                    units.push({
                        id: `unit-${Date.now()}`, name, status,
                        createdAt: formatDate(new Date()), updatedAt: formatDate(new Date())
                    });
                }

                filterAndRender();
                populateUnitFilter();
                showPage(dashboardPage);
            };

            // --- EVENT LISTENERS ---
            addUnitBtn.addEventListener('click', () => {
                resetForm();
                formTitle.textContent = "Tambah Unit Baru";
                showPage(formPage);
            });

            formCancelBtn.addEventListener('click', () => showPage(dashboardPage));
            formSaveBtn.addEventListener('click', handleSave);

            unitList.addEventListener('click', (event) => {
                const editBtn = event.target.closest('.edit-unit-btn');
                const deleteBtn = event.target.closest('.delete-unit-btn');

                if (editBtn) {
                    editingUnitId = editBtn.dataset.id;
                    const unitToEdit = units.find(u => u.id === editingUnitId);
                    if (unitToEdit) {
                        formUnitName.value = unitToEdit.name;
                        selectedStatusText.textContent = unitToEdit.status;
                        formStatusInput.value = unitToEdit.status;
                        formTitle.textContent = "Edit Unit";
                        showPage(formPage);
                    }
                } else if (deleteBtn) {
                    unitIdToDelete = deleteBtn.dataset.id;
                    deleteModal.classList.remove('hidden');
                }
            });

            modalConfirmBtn.addEventListener('click', () => {
                if (unitIdToDelete) {
                    units = units.filter(u => u.id !== unitIdToDelete);
                    filterAndRender();
                    populateUnitFilter();
                    unitIdToDelete = null;
                }
                deleteModal.classList.add('hidden');
            });

            modalCancelBtn.addEventListener('click', () => {
                unitIdToDelete = null;
                deleteModal.classList.add('hidden');
            });

            [searchInput, statusFilter, unitFilter].forEach(el => {
                el.addEventListener('input', filterAndRender);
                el.addEventListener('change', filterAndRender);
            });

            // Form page custom dropdown logic
            formStatusToggle.addEventListener('click', (event) => {
                event.stopPropagation();
                formStatusMenu.classList.toggle('hidden');
            });

            document.querySelectorAll('#form-status-menu .custom-dropdown-item').forEach(item => {
                item.addEventListener('click', (event) => {
                    const value = event.target.dataset.value;
                    selectedStatusText.textContent = value;
                    formStatusInput.value = value;
                    formStatusMenu.classList.add('hidden');
                });
            });

            window.addEventListener('click', (event) => {
                if (!formStatusDropdown.contains(event.target)) {
                    formStatusMenu.classList.add('hidden');
                }
            });

            // --- INITIALIZATION ---
            filterAndRender();
            populateUnitFilter();
        });
    </script>
</body>
</html>
