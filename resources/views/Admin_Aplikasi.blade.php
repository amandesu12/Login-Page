<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aplikasi</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/css/aplikasi.css', 'resources/js/aplikasi.js'])
</head>
<body class="antialiased">

    <!-- Halaman Dashboard -->
    <div id="dashboardPage" class="p-4 md:p-8 lg:p-12 pb-24">
        <!-- Header -->
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-800">Aplikasi</h1>
            <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
                <!-- Search Input -->
                <div class="relative w-full md:w-72">
                    <input type="text" id="searchInput" placeholder="Cari Aplikasi" class="w-full px-4 py-2 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" />
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <!-- Priority Dropdown -->
                <div class="relative" id="priorityDropdown">
                    <button class="bg-white text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Priority <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute z-10 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">High</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Medium</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Low</a>
                        </div>
                    </div>
                </div>
                <!-- Unit Dropdown -->
                <div class="relative" id="unitDropdown">
                    <button class="bg-white text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Unit <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute z-10 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">KID1</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">KID2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">KID3</a>
                        </div>
                    </div>
                </div>
                <!-- Add Aplikasi Button -->
                <button id="addAppButton" class="flex items-center justify-center gap-2 bg-blue-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-auto">
                    <i class="fas fa-plus"></i>
                    Add Aplikasi
                </button>
            </div>
        </header>

        <!-- Table Container -->
        <div class="bg-white rounded-xl overflow-hidden card">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider rounded-tl-xl">
                                Nama Aplikasi
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider">
                                Unit
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider cursor-pointer" id="sortDate">
                                <div class="flex items-center gap-1">
                                    Created At
                                    <i class="fas fa-sort text-xs"></i>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-500 uppercase tracking-wider rounded-tr-xl cursor-pointer" id="sortUpdateDate">
                                <div class="flex items-center gap-1">
                                    Updated At
                                    <i class="fas fa-sort text-xs"></i>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="tableBody">
                        <!-- Table Rows will be rendered here dynamically by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination yang posisinya tetap di bawah -->
        <div class="flex flex-col md:flex-row items-center justify-between p-6 bg-gray-50 border-t border-gray-200 rounded-xl card fixed-pagination">
            <div class="text-sm text-gray-600 mb-4 md:mb-0">
                <span id="paginationInfo"></span>
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

    <!-- Halaman Formulir "Add Aplikasi" -->
    <div id="addAppPage" class="p-4 md:p-8 lg:p-12 pb-24 hidden">
        <div class="w-full max-w-2xl mx-auto">
            <div class="bg-white rounded-xl p-8 card">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 text-center">Add Aplikasi</h2>
                
                <form id="addAppForm" action="#" method="POST">
                    <!-- Input Nama Aplikasi -->
                    <div class="mb-6">
                        <label for="appNameInput" class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                        <input type="text" id="appNameInput" name="namaAplikasi" placeholder="Nama Aplikasi" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" required>
                    </div>

                    <!-- Input Unit -->
                    <div class="mb-6">
                        <label for="unitInput" class="block text-sm font-medium text-gray-700 mb-2">Unit</label>
                        <select id="unitInput" name="unit" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" required>
                            <option value="" disabled selected>Pilih Unit</option>
                            <option value="KID1">KID1</option>
                            <option value="KID2">KID2</option>
                            <option value="KID3">KID3</option>
                        </select>
                    </div>

                    <!-- Input Prioritas -->
                    <div class="mb-8">
                        <label for="priorityInput" class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                        <select id="priorityInput" name="prioritas" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" required>
                            <option value="" disabled selected>Pilih Prioritas</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-4">
                        <button type="button" id="cancelButton" class="w-full sm:w-auto px-6 py-2 rounded-lg text-gray-700 font-medium border border-gray-300 hover:bg-gray-100 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" id="saveButton" class="w-full sm:w-auto px-6 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Halaman Formulir "Edit Aplikasi" -->
    <div id="editAppPage" class="p-4 md:p-8 lg:p-12 pb-24 hidden">
        <div class="w-full max-w-2xl mx-auto">
            <div class="bg-white rounded-xl p-8 card">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 text-center">Edit Aplikasi</h2>
                
                <form id="editAppForm" action="#" method="POST">
                    <input type="hidden" id="editAppId">
                    <!-- Input Nama Aplikasi -->
                    <div class="mb-6">
                        <label for="editAppNameInput" class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                        <input type="text" id="editAppNameInput" name="namaAplikasi" placeholder="Nama Aplikasi" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" required>
                    </div>

                    <!-- Input Unit -->
                    <div class="mb-6">
                        <label for="editUnitInput" class="block text-sm font-medium text-gray-700 mb-2">Unit</label>
                        <select id="editUnitInput" name="unit" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" required>
                            <option value="" disabled selected>Pilih Unit</option>
                            <option value="KID1">KID1</option>
                            <option value="KID2">KID2</option>
                            <option value="KID3">KID3</option>
                        </select>
                    </div>

                    <!-- Input Prioritas -->
                    <div class="mb-8">
                        <label for="editPriorityInput" class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                        <select id="editPriorityInput" name="prioritas" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" required>
                            <option value="" disabled selected>Pilih Prioritas</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-4">
                        <button type="button" id="cancelButtonEdit" class="w-full sm:w-auto px-6 py-2 rounded-lg text-gray-700 font-medium border border-gray-300 hover:bg-gray-100 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" id="saveButtonEdit" class="w-full sm:w-auto px-6 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    </script>
</body>
</html>
