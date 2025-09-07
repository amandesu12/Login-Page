document.addEventListener('DOMContentLoaded', () => {
    const dashboardPage = document.getElementById('dashboardPage');
    const addAppPage = document.getElementById('addAppPage');
    const editAppPage = document.getElementById('editAppPage');
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const addAppButton = document.getElementById('addAppButton');
    const sortCreateDateBtn = document.getElementById('sortDate');
    const sortUpdateDateBtn = document.getElementById('sortUpdateDate');
    const priorityDropdown = document.getElementById('priorityDropdown');
    const unitDropdown = document.getElementById('unitDropdown');
    const paginationInfo = document.getElementById('paginationInfo');
    const paginationLinks = document.getElementById('paginationLinks');
    const firstPageBtn = document.getElementById('firstPage');
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const lastPageBtn = document.getElementById('lastPage');
    const addAppForm = document.getElementById('addAppForm');
    const editAppForm = document.getElementById('editAppForm');
    const cancelButton = document.getElementById('cancelButton');
    const cancelButtonEdit = document.getElementById('cancelButtonEdit');

    // Initial dummy data. Added 'updatedAt' field.
    let allData = [
        { id: 1, nama: 'MOSY', unit: 'KID2', prioritas: 'Low', createdAt: '2025-09-18T10:00:00Z', updatedAt: '2025-09-18T10:00:00Z', color: 'bg-green-400' },
        { id: 2, nama: 'Presensi', unit: 'KID2', prioritas: 'Medium', createdAt: '2025-09-18T11:00:00Z', updatedAt: '2025-09-18T11:00:00Z', color: 'bg-yellow-400' },
        { id: 3, nama: 'Notifications', unit: 'KID2', prioritas: 'High', createdAt: '2025-09-18T12:00:00Z', updatedAt: '2025-09-18T12:00:00Z', color: 'bg-red-400' },
        { id: 4, nama: 'Work Orders', unit: 'KID1', prioritas: 'Low', createdAt: '2025-09-17T13:00:00Z', updatedAt: '2025-09-17T13:00:00Z', color: 'bg-green-400' },
        { id: 5, nama: 'Reports', unit: 'KID3', prioritas: 'High', createdAt: '2025-09-16T14:00:00Z', updatedAt: '2025-09-16T14:00:00Z', color: 'bg-red-400' },
        { id: 6, nama: 'History', unit: 'KID1', prioritas: 'Medium', createdAt: '2025-09-15T15:00:00Z', updatedAt: '2025-09-15T15:00:00Z', color: 'bg-yellow-400' },
        { id: 7, nama: 'Schedules', unit: 'KID2', prioritas: 'Low', createdAt: '2025-09-14T16:00:00Z', updatedAt: '2025-09-14T16:00:00Z', color: 'bg-green-400' },
        { id: 8, nama: 'Assets', unit: 'KID3', prioritas: 'Medium', createdAt: '2025-09-13T17:00:00Z', updatedAt: '2025-09-13T17:00:00Z', color: 'bg-yellow-400' },
        { id: 9, nama: 'Maintenance', unit: 'KID1', prioritas: 'Low', createdAt: '2025-09-12T18:00:00Z', updatedAt: '2025-09-12T18:00:00Z', color: 'bg-green-400' },
        { id: 10, nama: 'Analytics', unit: 'KID2', prioritas: 'High', createdAt: '2025-09-11T19:00:00Z', updatedAt: '2025-09-11T19:00:00Z', color: 'bg-red-400' },
        { id: 11, nama: 'Payroll', unit: 'KID3', prioritas: 'Medium', createdAt: '2025-09-10T20:00:00Z', updatedAt: '2025-09-10T20:00:00Z', color: 'bg-yellow-400' },
        { id: 12, nama: 'Inventory', unit: 'KID1', prioritas: 'Low', createdAt: '2025-09-09T21:00:00Z', updatedAt: '2025-09-09T21:00:00Z', color: 'bg-green-400' },
        { id: 13, nama: 'CRM', unit: 'KID2', prioritas: 'High', createdAt: '2025-09-08T22:00:00Z', updatedAt: '2025-09-08T22:00:00Z', color: 'bg-red-400' },
        { id: 14, nama: 'Billing', unit: 'KID3', prioritas: 'Medium', createdAt: '2025-09-07T23:00:00Z', updatedAt: '2025-09-07T23:00:00Z', color: 'bg-yellow-400' },
        { id: 15, nama: 'Support', unit: 'KID1', prioritas: 'Low', createdAt: '2025-09-06T10:00:00Z', updatedAt: '2025-09-06T10:00:00Z', color: 'bg-green-400' },
        { id: 16, nama: 'Projects', unit: 'KID2', prioritas: 'High', createdAt: '2025-09-05T11:00:00Z', updatedAt: '2025-09-05T11:00:00Z', color: 'bg-red-400' },
        { id: 17, nama: 'Contacts', unit: 'KID3', prioritas: 'Medium', createdAt: '2025-09-04T12:00:00Z', updatedAt: '2025-09-04T12:00:00Z', color: 'bg-yellow-400' },
        { id: 18, nama: 'Calendar', unit: 'KID1', prioritas: 'Low', createdAt: '2025-09-03T13:00:00Z', updatedAt: '2025-09-03T13:00:00Z', color: 'bg-green-400' },
        { id: 19, nama: 'Documents', unit: 'KID2', prioritas: 'High', createdAt: '2025-09-02T14:00:00Z', updatedAt: '2025-09-02T14:00:00Z', color: 'bg-red-400' },
        { id: 20, nama: 'Task Manager', unit: 'KID3', prioritas: 'Medium', createdAt: '2025-09-01T15:00:00Z', updatedAt: '2025-09-01T15:00:00Z', color: 'bg-yellow-400' }
    ];

    let filteredData = [...allData];
    const rowsPerPage = 5;
    let currentPage = 1;
    let currentSortColumn = 'createdAt';
    let sortOrder = 'desc';

    const getColorForPriority = (priority) => {
        switch (priority) {
            case 'High':
                return 'bg-red-400';
            case 'Medium':
                return 'bg-yellow-400';
            case 'Low':
                return 'bg-green-400';
            default:
                return 'bg-gray-400';
        }
    };

    // Function to format a date string to a readable format
    const formatDate = (dateString) => {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        return date.toLocaleDateString('id-ID', options);
    };

    const renderTable = (data) => {
        tableBody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedData = data.slice(start, end);

        if (paginatedData.length === 0) {
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `<td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>`;
            tableBody.appendChild(emptyRow);
        } else {
            paginatedData.forEach(item => {
                const row = document.createElement('tr');
                row.classList.add('bg-white', 'hover:bg-gray-50', 'transition-colors', 'duration-200');
                row.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-4">
                                    <div class="w-1.5 h-10 rounded-full ${item.color}"></div>
                                    <span class="text-sm font-medium text-gray-900">${item.nama}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.unit}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(item.createdAt)}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(item.updatedAt)}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center gap-4 justify-end">
                                    <button class="text-gray-500 hover:text-blue-600 transition-colors duration-200 edit-btn" data-id="${item.id}">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="text-gray-500 hover:text-red-600 transition-colors duration-200 delete-btn" data-id="${item.id}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                tableBody.appendChild(row);
            });
        }

        // Attach event listeners for edit and delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const idToDelete = parseInt(e.currentTarget.dataset.id);
                const nama = e.currentTarget.closest('tr').querySelector('.font-medium').textContent;

                showCustomMessage(`Apakah Anda yakin ingin menghapus aplikasi "${nama}"?`, () => {
                    allData = allData.filter(item => item.id !== idToDelete);
                    filterAndRender();
                });
            });
        });

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const idToEdit = parseInt(e.currentTarget.dataset.id);
                const appToEdit = allData.find(item => item.id === idToEdit);

                if (appToEdit) {
                    document.getElementById('editAppId').value = appToEdit.id;
                    document.getElementById('editAppNameInput').value = appToEdit.nama;
                    document.getElementById('editUnitInput').value = appToEdit.unit;
                    document.getElementById('editPriorityInput').value = appToEdit.prioritas;

                    dashboardPage.classList.add('hidden');
                    editAppPage.classList.remove('hidden');
                }
            });
        });
    };

    const showCustomMessage = (message, onConfirm) => {
        const modalId = 'custom-modal';
        let modal = document.getElementById(modalId);

        if (!modal) {
            modal = document.createElement('div');
            modal.id = modalId;
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden';
            modal.innerHTML = `
                        <div class="bg-white p-6 rounded-lg shadow-xl w-80 max-w-sm mx-4">
                            <p id="modal-message" class="text-gray-800 mb-6 text-center"></p>
                            <div class="flex justify-center gap-4">
                                <button id="modal-confirm-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">OK</button>
                                <button id="modal-cancel-btn" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200">Batal</button>
                            </div>
                        </div>
                    `;
            document.body.appendChild(modal);

            document.getElementById('modal-confirm-btn').addEventListener('click', () => {
                onConfirm();
                modal.classList.add('hidden');
            });

            document.getElementById('modal-cancel-btn').addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        }

        document.getElementById('modal-message').textContent = message;
        modal.classList.remove('hidden');
    };

    const renderPagination = (data) => {
        paginationLinks.innerHTML = '';
        const totalPages = Math.ceil(data.length / rowsPerPage);
        const startItem = (currentPage - 1) * rowsPerPage + 1;
        const endItem = Math.min(currentPage * rowsPerPage, data.length);
        paginationInfo.textContent = `${startItem}-${endItem} dari ${data.length} Baris/Halaman:`;

        for (let i = 1; i <= totalPages; i++) {
            const link = document.createElement('a');
            link.href = '#';
            link.classList.add('pagination-link', 'w-8', 'h-8', 'flex', 'items-center', 'justify-center', 'rounded-lg', 'text-sm', 'font-medium', 'hover:bg-gray-200', 'transition-colors', 'duration-200');
            link.textContent = i;
            if (i === currentPage) {
                link.classList.add('active');
            }
            link.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                renderTable(filteredData);
                renderPagination(filteredData);
            });
            paginationLinks.appendChild(link);
        }

        firstPageBtn.disabled = currentPage === 1;
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
        lastPageBtn.disabled = currentPage === totalPages;
    };

    const filterAndRender = () => {
        const searchTerm = searchInput.value.toLowerCase();
        filteredData = allData.filter(item =>
            item.nama.toLowerCase().includes(searchTerm) ||
            item.unit.toLowerCase().includes(searchTerm)
        );
        currentPage = 1;
        renderTable(filteredData);
        renderPagination(filteredData);
    };

    // Event Listener for Search Input
    searchInput.addEventListener('input', () => {
        filterAndRender();
    });

    // Event Listener for "Add Aplikasi" button
    addAppButton.addEventListener('click', () => {
        dashboardPage.classList.add('hidden');
        addAppPage.classList.remove('hidden');
    });

    // Event Listener for "Cancel" button on Add form
    cancelButton.addEventListener('click', () => {
        addAppPage.classList.add('hidden');
        dashboardPage.classList.remove('hidden');
    });

    // Event Listener for "Cancel" button on Edit form
    cancelButtonEdit.addEventListener('click', () => {
        editAppPage.classList.add('hidden');
        dashboardPage.classList.remove('hidden');
    });

    // Event Listener for "Add Aplikasi" form submission
    addAppForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const appName = document.getElementById('appNameInput').value;
        const unit = document.getElementById('unitInput').value;
        const priority = document.getElementById('priorityInput').value;

        const now = new Date().toISOString();
        const newApp = {
            id: allData.length > 0 ? Math.max(...allData.map(item => item.id)) + 1 : 1,
            nama: appName,
            unit: unit,
            prioritas: priority,
            createdAt: now,
            updatedAt: now,
            color: getColorForPriority(priority)
        };
        allData.push(newApp);
        addAppForm.reset();

        // Return to dashboard and update the table
        addAppPage.classList.add('hidden');
        dashboardPage.classList.remove('hidden');
        filterAndRender();
        showCustomMessage(`Aplikasi "${newApp.nama}" berhasil ditambahkan!`, () => {});
    });

    // Event Listener for "Edit Aplikasi" form submission
    editAppForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const appId = parseInt(document.getElementById('editAppId').value);
        const appName = document.getElementById('editAppNameInput').value;
        const unit = document.getElementById('editUnitInput').value;
        const priority = document.getElementById('editPriorityInput').value;

        const appIndex = allData.findIndex(item => item.id === appId);
        if (appIndex > -1) {
            allData[appIndex].nama = appName;
            allData[appIndex].unit = unit;
            allData[appIndex].prioritas = priority;
            allData[appIndex].updatedAt = new Date().toISOString(); // Update the timestamp
            allData[appIndex].color = getColorForPriority(priority);
        }

        // Return to dashboard and update the table
        editAppPage.classList.add('hidden');
        dashboardPage.classList.remove('hidden');
        filterAndRender();
        showCustomMessage(`Aplikasi "${appName}" berhasil diubah!`, () => {});
    });


    // Event Listener for Sorting
    sortCreateDateBtn.addEventListener('click', () => {
        sortOrder = (currentSortColumn === 'createdAt' && sortOrder === 'desc') ? 'asc' : 'desc';
        currentSortColumn = 'createdAt';
        filteredData.sort((a, b) => {
            const dateA = new Date(a.createdAt);
            const dateB = new Date(b.createdAt);
            if (sortOrder === 'asc') return dateA - dateB;
            return dateB - dateA;
        });
        renderTable(filteredData);
        renderPagination(filteredData);
    });

    sortUpdateDateBtn.addEventListener('click', () => {
        sortOrder = (currentSortColumn === 'updatedAt' && sortOrder === 'desc') ? 'asc' : 'desc';
        currentSortColumn = 'updatedAt';
        filteredData.sort((a, b) => {
            const dateA = new Date(a.updatedAt);
            const dateB = new Date(b.updatedAt);
            if (sortOrder === 'asc') return dateA - dateB;
            return dateB - dateA;
        });
        renderTable(filteredData);
        renderPagination(filteredData);
    });

    // Event Listeners for Dropdown
    priorityDropdown.querySelector('button').addEventListener('click', (e) => {
        e.stopPropagation();
        priorityDropdown.querySelector('.dropdown-menu').classList.toggle('show');
        unitDropdown.querySelector('.dropdown-menu').classList.remove('show');
    });

    unitDropdown.querySelector('button').addEventListener('click', (e) => {
        e.stopPropagation();
        unitDropdown.querySelector('.dropdown-menu').classList.toggle('show');
        priorityDropdown.querySelector('.dropdown-menu').classList.remove('show');
    });

    window.addEventListener('click', (e) => {
        if (!priorityDropdown.contains(e.target)) {
            priorityDropdown.querySelector('.dropdown-menu').classList.remove('show');
        }
        if (!unitDropdown.contains(e.target)) {
            unitDropdown.querySelector('.dropdown-menu').classList.remove('show');
        }
    });

    // Event Listeners for Pagination Navigation
    firstPageBtn.addEventListener('click', () => {
        currentPage = 1;
        renderTable(filteredData);
        renderPagination(filteredData);
    });

    prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable(filteredData);
            renderPagination(filteredData);
        }
    });

    nextPageBtn.addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTable(filteredData);
            renderPagination(filteredData);
        }
    });

    lastPageBtn.addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / rowsPerPage);
        currentPage = totalPages;
        renderTable(filteredData);
        renderPagination(filteredData);
    });

    // Initial view setup
    filterAndRender();
});