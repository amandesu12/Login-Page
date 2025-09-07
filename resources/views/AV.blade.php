<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts for sans-serif -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-gray-100 antialiased">

    <!-- Success Pop-up -->
    <div id="successPopup" class="hidden fixed top-20 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-3 px-6 rounded-xl shadow-lg z-50 transition-transform duration-500">
        Vendor berhasil disimpan!
    </div>

    <!-- Main Application Container -->
    <div id="appContainer" class="flex flex-col h-screen">

        <!-- Top Header -->
        <header class="bg-white shadow-md py-4 px-8 flex justify-between items-center sticky top-0 z-40">
            <!-- Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <span class="text-xl font-bold text-gray-900">VEMOS</span>
            </div>
            <div class="flex-1 mx-4 relative max-w-lg hidden md:block">
                <input type="text" id="searchInput" placeholder="Search for anything" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 text-sm">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16a6.471 6.471 0 0 0 3.73-1.28l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-semibold text-gray-700 hidden md:block">Michael Smith</span>
                <img class="w-8 h-8 rounded-full" src="https://placehold.co/40x40/60a5fa/ffffff?text=MS" alt="Michael Smith">
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-auto bg-gray-100 p-8">

            <!-- Dashboard Page Content -->
            <div id="dashboardPage">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 space-y-4 md:space-y-0">
                    <h1 class="text-3xl font-semibold text-gray-800">Vendors</h1>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                        <select id="priorityFilter" class="w-full sm:w-auto py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 text-sm">
                            <option value="">Semua Prioritas</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                        <select id="unitFilter" class="w-full sm:w-auto py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 text-sm">
                            <option value="">Semua Unit</option>
                            <option value="Unit A">Unit A</option>
                            <option value="Unit B">Unit B</option>
                        </select>
                        <button id="addVendorButton" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm flex items-center justify-center">
                            <span class="font-bold mr-1 text-lg">+</span> Add Vendor
                        </button>
                    </div>
                </div>

                <!-- Grid Vendors Cards -->
                <div id="vendorsGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    <!-- Vendor cards will be dynamically inserted here by JavaScript -->
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="hidden flex items-center justify-center h-64">
                    <p class="text-gray-500 text-lg">Tidak ada vendor yang ditemukan.</p>
                </div>

                <!-- Delete Confirmation Modal (used on dashboard) -->
                <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-3xl bg-white text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Konfirmasi Hapus</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-gray-600">Apakah Anda yakin ingin menghapus vendor ini?</p>
                        </div>
                        <div class="flex justify-center space-x-4 mt-4">
                            <button id="confirmDeleteButton" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Hapus</button>
                            <button id="cancelDeleteButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Vendor Page Content -->
            <div id="addVendorPage" class="p-8 hidden">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                    <h1 class="text-3xl font-semibold text-gray-800">Add Vendor</h1>
                    <!-- This button is just a UI placeholder -->
                    <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-semibold transition-colors duration-300 hover:bg-gray-300">
                        <span class="text-lg">+</span> Add Aplikasi
                    </button>
                </div>
                <div class="bg-white rounded-3xl shadow-lg p-6 max-w-lg mx-auto">
                    <form id="vendorForm">
                        <input type="hidden" id="vendorId">
                        <div class="mb-6">
                            <label for="vendorName" class="block text-gray-700 text-sm font-bold mb-2">Nama Vendor</label>
                            <input type="text" id="vendorName" name="vendorName" class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama vendor" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Logo (opsional)</label>
                            <div class="flex items-center space-x-4">
                                <input type="file" id="vendorLogoFile" name="vendorLogoFile" accept="image/*" class="hidden">
                                <label for="vendorLogoFile" class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                                    Pilih Foto
                                </label>
                                <span id="fileSelectedName" class="text-sm text-gray-500 truncate">Tidak ada file yang dipilih</span>
                            </div>
                        </div>
                        <div class="flex justify-center space-x-4 mt-8">
                            <button id="cancelButton" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-300">Batal</button>
                            <button id="saveButton" type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</body>

<script>
    // --- In-memory data for simulation ---
    let vendors = [
        { id: '1', name: 'Vendor ABC', logoUrl: 'https://placehold.co/96x96/60a5fa/1f2937?text=ABC', createdAt: new Date().toISOString(), updatedAt: null, priority: 'High', unit: 'Unit A' },
        { id: '2', name: 'Vendor XYZ', logoUrl: 'https://placehold.co/96x96/60a5fa/1f2937?text=XYZ', createdAt: new Date().toISOString(), updatedAt: null, priority: 'Medium', unit: 'Unit B' }
    ];
    let nextId = 3;

    // UI elements
    const dashboardPage = document.getElementById('dashboardPage');
    const addVendorPage = document.getElementById('addVendorPage');
    const vendorsGrid = document.getElementById('vendorsGrid');
    const emptyState = document.getElementById('emptyState');
    const addVendorButton = document.getElementById('addVendorButton');
    const deleteModal = document.getElementById('deleteModal');
    const successPopup = document.getElementById('successPopup');
    const vendorForm = document.getElementById('vendorForm');
    const vendorIdInput = document.getElementById('vendorId');
    const vendorLogoFile = document.getElementById('vendorLogoFile');
    const fileSelectedName = document.getElementById('fileSelectedName');
    const searchInput = document.getElementById('searchInput');
    const priorityFilter = document.getElementById('priorityFilter');
    const unitFilter = document.getElementById('unitFilter');

    // State for filtering
    let currentFilters = {
        search: '',
        priority: '',
        unit: ''
    };

    // --- CRUD Functions (Simulated) ---

    // Render vendor cards based on filtered data
    const renderVendors = (vendorsToRender) => {
        vendorsGrid.innerHTML = '';
        if (vendorsToRender.length === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
            vendorsToRender.forEach(vendor => {
                const vendorCard = document.createElement('div');
                vendorCard.className = 'bg-white rounded-3xl shadow-lg p-6 flex flex-col items-center justify-center transition-transform duration-300 hover:scale-105 hover:shadow-xl';
                vendorCard.innerHTML = `
                    <div class="w-24 h-24 mb-4 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        <img src="${vendor.logoUrl || 'https://placehold.co/96x96/60a5fa/1f2937?text=VEMOS'}" alt="${vendor.name} Icon" class="rounded-full w-full h-full object-cover" onerror="this.onerror=null; this.src='https://placehold.co/96x96/60a5fa/1f2937?text=VEMOS';">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">${vendor.name}</h3>
                    <p class="text-xs text-gray-500 mt-1">Dibuat pada: ${new Date(vendor.createdAt).toLocaleDateString()}</p>
                    ${vendor.updatedAt ? `<p class="text-xs text-gray-500">Diupdate pada: ${new Date(vendor.updatedAt).toLocaleDateString()}</p>` : ''}
                    <p class="text-xs text-gray-500">Prioritas: <span class="font-medium text-black">${vendor.priority}</span></p>
                    <p class="text-xs text-gray-500">Unit: <span class="font-medium text-black">${vendor.unit}</span></p>
                    <div class="flex space-x-4 mt-4 text-gray-400">
                        <button data-id="${vendor.id}" class="edit-btn hover:text-blue-500 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 21h-2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2zM5 21a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5z"/>
                            </svg>
                        </button>
                        <button data-id="${vendor.id}" class="delete-btn hover:text-red-500 transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M15 1H9c-1.103 0-2 .897-2 2v2H4c-.552 0-1 .448-1 1s.448 1 1 1h16c.552 0 1-.448 1-1s-.448-1-1-1h-3V3c0-1.103-.897-2-2-2zM9 3h6v2H9V3zM5 21c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V7H5v14z"/>
                            </svg>
                        </button>
                    </div>
                `;
                vendorsGrid.appendChild(vendorCard);
            });
        }
    };

    const filterAndRenderVendors = () => {
        const filteredVendors = vendors.filter(vendor => {
            const matchesSearch = vendor.name.toLowerCase().includes(currentFilters.search.toLowerCase());
            const matchesPriority = currentFilters.priority === '' || vendor.priority === currentFilters.priority;
            const matchesUnit = currentFilters.unit === '' || vendor.unit === currentFilters.unit;
            return matchesSearch && matchesPriority && matchesUnit;
        });
        renderVendors(filteredVendors);
    };

    // Add a new vendor
    const addVendor = (vendorData) => {
        const newVendor = {
            id: String(nextId++),
            ...vendorData,
            createdAt: new Date().toISOString(),
            updatedAt: null
        };
        vendors.push(newVendor);
        showPopup("Vendor berhasil ditambahkan!");
        filterAndRenderVendors();
    };

    // Update an existing vendor
    const updateVendor = (vendorId, vendorData) => {
        const index = vendors.findIndex(v => v.id === vendorId);
        if (index !== -1) {
            vendors[index] = { ...vendors[index], ...vendorData, updatedAt: new Date().toISOString() };
            showPopup("Vendor berhasil diperbarui!");
            filterAndRenderVendors();
        } else {
            showPopup("Gagal memperbarui vendor.", 'red');
        }
    };

    // Delete a vendor
    const deleteVendor = (vendorId) => {
        const initialLength = vendors.length;
        vendors = vendors.filter(v => v.id !== vendorId);
        if (vendors.length < initialLength) {
            showPopup("Vendor berhasil dihapus!");
            filterAndRenderVendors();
        } else {
            showPopup("Gagal menghapus vendor.", 'red');
        }
    };

    // Pop-up display function
    const showPopup = (message, color = 'green') => {
        const popup = document.getElementById('successPopup');
        popup.textContent = message;
        popup.classList.remove('hidden', 'bg-green-500', 'bg-red-500');
        popup.classList.add(color === 'green' ? 'bg-green-500' : 'bg-red-500');
        setTimeout(() => {
            popup.classList.add('hidden');
        }, 3000);
    };

    // --- Page Navigation Functions ---
    const showPage = (pageId) => {
        dashboardPage.classList.add('hidden');
        addVendorPage.classList.add('hidden');
        
        if (pageId === 'dashboard') {
            dashboardPage.classList.remove('hidden');
            document.querySelector('main').classList.add('p-8');
            document.querySelector('main').classList.remove('p-0');
        } else if (pageId === 'addVendor') {
            addVendorPage.classList.remove('hidden');
            document.querySelector('main').classList.remove('p-8');
            document.querySelector('main').classList.add('p-0');
        }
    };

    // --- Main Event Listeners ---

    // Navigate to Add Vendor Page
    addVendorButton.addEventListener('click', () => {
        vendorForm.reset();
        vendorIdInput.value = '';
        fileSelectedName.textContent = 'Tidak ada file yang dipilih';
        showPage('addVendor');
    });

    // Handle form submission (Add/Edit)
    vendorForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const vendorData = {
            name: vendorForm.vendorName.value,
            logoUrl: 'https://placehold.co/96x96/60a5fa/1f2937?text=VEMOS',
            priority: 'High', 
            unit: 'Unit A', 
        };
        if (vendorIdInput.value) {
            updateVendor(vendorIdInput.value, vendorData);
        } else {
            addVendor(vendorData);
        }
        showPage('dashboard');
    });

    // Update file name display when a file is selected
    vendorLogoFile.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            fileSelectedName.textContent = e.target.files[0].name;
        } else {
            fileSelectedName.textContent = 'Tidak ada file yang dipilih';
        }
    });

    // Cancel button
    document.getElementById('cancelButton').addEventListener('click', () => {
        showPage('dashboard');
    });

    // Event delegation for Edit and Delete buttons on the grid
    vendorsGrid.addEventListener('click', (e) => {
        const editButton = e.target.closest('.edit-btn');
        const deleteButton = e.target.closest('.delete-btn');

        if (editButton) {
            const vendorId = editButton.dataset.id;
            const vendor = vendors.find(v => v.id === vendorId);
            if (vendor) {
                vendorIdInput.value = vendor.id;
                vendorForm.vendorName.value = vendor.name;
                fileSelectedName.textContent = 'Tidak ada file yang dipilih';
                showPage('addVendor');
            }
        }

        if (deleteButton) {
            const vendorId = deleteButton.dataset.id;
            document.getElementById('confirmDeleteButton').dataset.id = vendorId;
            deleteModal.classList.remove('hidden');
        }
    });

    // Confirm delete button listener
    document.getElementById('confirmDeleteButton').addEventListener('click', (e) => {
        const vendorId = e.target.dataset.id;
        if (vendorId) {
            deleteVendor(vendorId);
            deleteModal.classList.add('hidden');
        }
    });

    // Cancel delete button
    document.getElementById('cancelDeleteButton').addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });

    // Filter event listeners
    searchInput.addEventListener('input', (e) => {
        currentFilters.search = e.target.value.trim();
        filterAndRenderVendors();
    });

    priorityFilter.addEventListener('change', (e) => {
        currentFilters.priority = e.target.value;
        filterAndRenderVendors();
    });

    unitFilter.addEventListener('change', (e) => {
        currentFilters.unit = e.target.value;
        filterAndRenderVendors();
    });

    // Initial render
    filterAndRenderVendors();
    showPage('dashboard');

</script>
</html>
