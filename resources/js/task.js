// Data tugas (menggantikan data statis di HTML)
        const tasks = [
            {
                id: 1,
                title: 'Desain Ulang Dashboard Admin',
                description: 'Proyek internal untuk meningkatkan UX',
                status: 'In Progress',
                priority: 'High',
                dueDate: '2025-10-25T17:00:00Z',
                progress: 75,
                assignedTo: [
                    { name: 'Lia Wiranti', position: 'UX/UI Designer', avatar: 'https://placehold.co/40x40/d4c3f5/333333?text=LW', accepted: true },
                    { name: 'Rian Setyawan', position: 'Project Manager', avatar: 'https://placehold.co/40x40/f0b4ba/333333?text=UN', accepted: false }
                ]
            },
            {
                id: 2,
                title: 'Selesaikan Laporan Keuangan Q3',
                description: 'Laporan mingguan untuk tim manajemen',
                status: 'Selesai',
                priority: 'Low',
                dueDate: '2025-10-18T17:00:00Z',
                progress: 100,
                assignedTo: [
                    { name: 'Agus Ridwan', position: 'Staff Keuangan', avatar: 'https://placehold.co/40x40/c2e2c2/333333?text=AR', accepted: true }
                ]
            },
            {
                id: 3,
                title: 'Rapat Koordinasi Tim Marketing',
                description: 'Persiapan untuk peluncuran produk baru',
                status: 'To Do',
                priority: 'Medium',
                dueDate: '2025-10-30T17:00:00Z',
                progress: 0,
                assignedTo: [
                    { name: 'Joko Dwi', position: 'Staf Marketing', avatar: 'https://placehold.co/40x40/f0e68c/333333?text=JD', accepted: false },
                    { name: 'Siti Fauziah', position: 'Teknisi IT', avatar: 'https://placehold.co/40x40/9fa8da/333333?text=SF', accepted: false }
                ]
            },
            {
                id: 4,
                title: 'Perbaiki Bug pada Fitur Login',
                description: 'Tugas darurat dari departemen IT',
                status: 'Overdue',
                priority: 'High',
                dueDate: '2025-08-10T17:00:00Z',
                progress: 50,
                assignedTo: [
                    { name: 'Siti Fauziah', position: 'Teknisi IT', avatar: 'https://placehold.co/40x40/9fa8da/333333?text=SF', accepted: true }
                ]
            }
        ];

        // Mendapatkan elemen DOM
        const searchInput = document.getElementById('searchInput');
        const tasksTableBody = document.getElementById('tasksTableBody');
        const taskPanel = document.getElementById('taskPanel');
        const backdrop = document.getElementById('backdrop');
        const closePanelBtn = document.getElementById('closePanelBtn');
        const panelTitle = document.getElementById('panelTitle');
        const panelDescription = document.getElementById('panelDescription');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const assignedUsersList = document.getElementById('assignedUsersList');

        // Fungsi untuk menghitung progres deadline
        const getDeadlineProgress = (dueDateString) => {
            const dueDate = new Date(dueDateString);
            const now = new Date();
            const totalDuration = 30 * 24 * 60 * 60 * 1000; // Asumsi total durasi tugas 30 hari
            const timeElapsed = now - (dueDate - totalDuration);
            const timeLeft = dueDate - now;

            let percentage = 0;
            let timeLabel = '';
            let barColor = '';
            
            if (timeLeft <= 0) {
                // Tugas sudah jatuh tempo (overdue)
                percentage = 100;
                timeLabel = 'Overdue';
                barColor = 'bg-[var(--deadline-fill-red)]';
            } else {
                // Hitung persentase progres
                percentage = (timeElapsed / totalDuration) * 100;
                percentage = Math.min(percentage, 100);
                
                if (timeLeft < 24 * 60 * 60 * 1000) {
                    // Sisa waktu kurang dari 24 jam
                    timeLabel = `${Math.ceil(timeLeft / (60 * 60 * 1000))}h`;
                    barColor = 'bg-[var(--deadline-fill-orange)]';
                } else {
                    // Sisa waktu dalam hari
                    timeLabel = `${Math.ceil(timeLeft / (24 * 60 * 60 * 1000))}d`;
                    barColor = 'bg-[var(--deadline-fill-green)]';
                }
            }

            return {
                percentage: percentage,
                timeLabel: timeLabel,
                barColor: barColor
            };
        };
        
        // Fungsi untuk merender satu baris tugas ke dalam tabel
        const renderTaskRow = (task) => {
            const row = document.createElement('tr');
            const assignedUsersHTML = task.assignedTo.map(user => `
                <div class="group relative inline-block">
                    <img class="h-6 w-6 rounded-full border-2 border-white object-cover" src="${user.avatar}" alt="Avatar ${user.name}">
                    <!-- Popup status -->
                    <div class="profile-popup absolute left-1/2 -translate-x-1/2 top-full mt-2 p-2 w-52 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-dark">${user.name}</p>
                                <p class="text-xs text-gray">${user.position}</p>
                            </div>
                            ${user.accepted ? '<i class="fas fa-check-circle text-green-500 text-lg"></i>' : '<i class="fas fa-times-circle text-red-500 text-lg"></i>'}
                        </div>
                    </div>
                </div>
            `).join('');

            // Tentukan kelas CSS untuk badge status
            let statusBadgeClass = '';
            let priorityBadgeClass = '';
            switch (task.status) {
                case 'In Progress':
                    statusBadgeClass = 'badge-status-in-progress';
                    break;
                case 'Selesai':
                    statusBadgeClass = 'badge-status-completed';
                    break;
                case 'To Do':
                    statusBadgeClass = 'badge-status-to-do';
                    break;
                case 'Overdue':
                    statusBadgeClass = 'badge-status-overdue';
                    break;
            }
            switch (task.priority) {
                case 'High':
                    priorityBadgeClass = 'badge-priority-high';
                    break;
                case 'Medium':
                    priorityBadgeClass = 'badge-priority-medium';
                    break;
                case 'Low':
                    priorityBadgeClass = 'badge-priority-low';
                    break;
            }
            
            // Menghitung progres deadline
            const deadline = getDeadlineProgress(task.dueDate);

            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="font-medium text-dark">${task.title}</div>
                    <div class="text-xs text-gray-500">${task.description}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap relative">
                    <div class="flex items-center -space-x-1">
                        ${assignedUsersHTML}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusBadgeClass}">
                        ${task.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${priorityBadgeClass}">
                        ${task.priority === 'High' ? 'Tinggi' : task.priority === 'Medium' ? 'Sedang' : 'Rendah'}
                    </span>
                </td>
                <!-- Kolom Progres Deadline Baru -->
                <td class="px-6 py-4">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full ${deadline.barColor}" style="width: ${deadline.percentage}%;"></div>
                    </div>
                    <p class="text-right text-xs mt-1 text-gray">${deadline.timeLabel}</p>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="view-task-btn text-primary hover:text-blue-800 transition-colors duration-200 mr-2" data-task-id="${task.id}"><i class="fas fa-eye"></i></a>
                    <a href="#" class="text-gray-500 hover:text-gray-800 transition-colors duration-200"><i class="fas fa-pencil-alt"></i></a>
                </td>
            `;
            return row;
        };

        // Fungsi untuk merender seluruh tabel berdasarkan filter pencarian
        const renderTable = (searchTerm = '') => {
            tasksTableBody.innerHTML = ''; // Mengosongkan tabel
            
            const lowerCaseSearchTerm = searchTerm.toLowerCase();

            const filteredTasks = tasks.filter(task => {
                const titleMatch = task.title.toLowerCase().includes(lowerCaseSearchTerm);
                const descriptionMatch = task.description.toLowerCase().includes(lowerCaseSearchTerm);
                const assignedUserMatch = task.assignedTo.some(user => user.name.toLowerCase().includes(lowerCaseSearchTerm));
                return titleMatch || descriptionMatch || assignedUserMatch;
            });
            
            if (filteredTasks.length > 0) {
                filteredTasks.forEach(task => {
                    tasksTableBody.appendChild(renderTaskRow(task));
                });
            } else {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `<td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Tidak ada tugas yang cocok dengan pencarian Anda.</td>`;
                tasksTableBody.appendChild(emptyRow);
            }
        };

        // Fungsi untuk membuka panel detail tugas
        const openPanel = (taskId) => {
            const task = tasks.find(t => t.id === taskId);
            if (!task) return;

            // Mengisi konten panel
            panelTitle.textContent = task.title;
            panelDescription.textContent = task.description;
            
            // Mengatur progress bar
            progressBar.style.width = `${task.progress}%`;
            progressText.textContent = `${task.progress}% Selesai`;
            
            // Mengisi daftar pengguna yang ditugaskan
            assignedUsersList.innerHTML = '';
            task.assignedTo.forEach(user => {
                const userDiv = document.createElement('div');
                userDiv.className = 'flex items-center space-x-3';
                const statusIcon = user.accepted ? '<i class="fas fa-check-circle text-green-500 text-xl"></i>' : '<i class="fas fa-times-circle text-red-500 text-xl"></i>';
                userDiv.innerHTML = `
                    <img class="h-10 w-10 rounded-full border-2 border-gray-200 object-cover" src="${user.avatar}" alt="Avatar ${user.name}">
                    <div class="flex-grow">
                        <p class="text-md font-semibold text-dark">${user.name}</p>
                        <p class="text-sm text-gray">${user.position}</p>
                    </div>
                    <div>${statusIcon}</div>
                `;
                assignedUsersList.appendChild(userDiv);
            });

            // Menampilkan panel dan backdrop
            backdrop.classList.remove('hidden');
            taskPanel.classList.add('open');
        };

        // Fungsi untuk menutup panel
        const closePanel = () => {
            taskPanel.classList.remove('open');
            // Sembunyikan backdrop setelah transisi selesai
            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 500); 
        };
        
        // Event listener saat dokumen dimuat
        document.addEventListener('DOMContentLoaded', () => {
            // Render tabel awal saat halaman dimuat
            renderTable();

            // Event listener untuk bilah pencarian
            searchInput.addEventListener('keyup', (e) => {
                renderTable(e.target.value);
            });
        });

        // Event listener menggunakan event delegation untuk tombol "eye" di semua tabel
        document.addEventListener('click', (e) => {
            const viewBtn = e.target.closest('.view-task-btn');
            if (viewBtn) {
                e.preventDefault();
                const taskId = parseInt(viewBtn.dataset.taskId);
                openPanel(taskId);
            }
        });

        // Event listener untuk menutup panel
        closePanelBtn.addEventListener('click', closePanel);
        backdrop.addEventListener('click', closePanel);