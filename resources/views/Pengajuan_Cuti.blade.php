<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengajuan Cuti</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        .container {
            max-width: 100%;
            padding: 1.5rem;
            margin: auto;
        }
        .card {
            background-color: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .calendar-day {
            transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            position: relative;
        }
        .calendar-day:hover {
            background-color: #e5e7eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .day-tooltip {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -120%);
            background-color: #374151;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            z-index: 10;
        }
        .day-tooltip::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #374151 transparent transparent transparent;
        }
        .calendar-day.holiday:hover .day-tooltip,
        .calendar-day.full-quota:hover .day-tooltip {
            opacity: 1;
            visibility: visible;
        }
        .calendar-day.full-quota {
            background-color: #fecaca;
            color: #ffffff;
            cursor: not-allowed;
            opacity: 0.8;
        }
        .calendar-day.almost-full-quota {
            background-color: #fde68a;
            color: #ffffff;
        }
        .calendar-day.selected {
            background-color: #22c55e;
            color: #ffffff;
        }
        .calendar-day.weekend {
            color: #d1d5db;
        }
        @media (min-width: 1024px) {
            .container {
                max-width: 1200px;
            }
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 20;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            text-align: center;
            max-width: 400px;
            width: 90%;
            position: relative;
        }
        .modal-header {
            color: #1f2937;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .modal-body {
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.5;
        }
        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            color: #9ca3af;
        }
        .close-btn:hover {
            color: #4b5563;
        }
    </style>
</head>
<body>

    <div class="container min-h-screen flex items-center justify-center p-4">
        <div class="card w-full lg:max-w-4xl p-6 lg:p-10 flex flex-col lg:flex-row gap-8 lg:gap-12">

            <div class="flex-1">
                <div class="mb-6 lg:mb-8">
                    <h1 class="text-4xl font-bold text-gray-900">Presensi</h1>
                    <p id="currentTime" class="text-sm text-gray-500 mt-2"></p>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Pengajuan Cuti</h2>
                        <p class="text-sm text-gray-500 mt-2">Silakan lengkapi formulir di bawah ini untuk mengajukan permohonan cuti Anda.</p>
                    </div>

                    <div>
                        <label for="leave-type-select" class="block text-gray-700 font-semibold mb-2">Jenis Cuti</label>
                        <select id="leave-type-select" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="">-- Pilih Jenis Cuti --</option>
                            <option value="cuti_menikah">Cuti Menikah Anak</option>
                            <option value="cuti_istri_melahirkan">Cuti Istri Melahirkan/Keguguran</option>
                            <option value="cuti_besar">Cuti Besar</option>
                            <option value="cuti_tanggungan">Cuti Diluar Tanggungan</option>
                            <option value="cuti_haid">Cuti Diluar Haid</option>
                            <option value="cuti_keagamaan">Cuti Keagamaan</option>
                        </select>
                    </div>

                    <div id="formContainer" class="hidden space-y-6">
                        <div id="quotaInfo" class="p-4 bg-orange-100 border border-orange-300 text-orange-800 rounded-xl" style="display: none;">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.86 3.375 2.693 3.375h1.5c.995 0 1.956-.411 2.693-1.148l3.056-3.056a2.25 2.25 0 0 0-3.056-3.056l-3.056 3.056Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.86 3.375 2.693 3.375h1.5c.995 0 1.956-.411 2.693-1.148l3.056-3.056a2.25 2.25 0 0 0-3.056-3.056l-3.056 3.056Z" />
                                </svg>
                                <p class="text-sm font-medium">Jenis cuti ini akan memotong kuota cuti tahunan Anda</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal Cuti Dipilih</label>
                            <div id="selectedDatesBox" class="p-4 border border-dashed rounded-lg text-gray-400 max-h-40 overflow-y-auto space-y-1">
                                Belum ada tanggal dipilih
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi Laporan dan Kegiatan</label>
                            <textarea id="description" rows="4" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none transition-all" placeholder="Jelaskan Alasan Pengajuan Cuti Anda"></textarea>
                        </div>

                        <div id="validationMessage" class="mt-4 p-3 text-sm rounded-lg hidden"></div>

                        <div class="mt-8">
                            <button id="submitBtn" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition-colors">Kirim Permohonan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-96 flex-shrink-0">
                <div class="p-6 bg-blue-50 text-blue-800 rounded-xl mb-6">
                    <p class="font-medium">Klik tanggal untuk memilih/membatalkan. Hanya hari kerja yang dihitung sebagai cuti.
                    <br> <span class="font-bold">Tidak bisa mengajukan cuti mundur (backdate).</span></p>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-between w-full mb-4">
                        <button id="prevMonth" class="p-2 text-gray-500 hover:bg-gray-200 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <span id="currentMonthYear" class="text-lg font-bold text-gray-800"></span>
                        <button id="nextMonth" class="p-2 text-gray-500 hover:bg-gray-200 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center w-full mb-4">
                        <div class="text-gray-500 font-medium">Min</div>
                        <div class="text-gray-500 font-medium">Sen</div>
                        <div class="text-gray-500 font-medium">Sel</div>
                        <div class="text-gray-500 font-medium">Rab</div>
                        <div class="text-gray-500 font-medium">Kam</div>
                        <div class="text-gray-500 font-medium">Jum</div>
                        <div class="text-gray-500 font-medium">Sab</div>
                    </div>

                    <div id="calendar" class="grid grid-cols-7 gap-1 w-full">
                        <!-- Kalender akan di-render oleh JavaScript -->
                    </div>
                </div>

                <div class="mt-6 p-4 rounded-lg border">
                    <h3 class="font-semibold text-gray-700 mb-2">Keterangan</h3>
                    <div class="flex items-center mb-1">
                        <div class="w-4 h-4 rounded mr-2 bg-green-500"></div>
                        <span class="text-sm text-gray-600">Tanggal Dipilih</span>
                    </div>
                    <div class="flex items-center mb-1">
                        <div class="w-4 h-4 rounded mr-2 bg-yellow-400"></div>
                        <span class="text-sm text-gray-600">Kuota Hampir Penuh</span>
                    </div>
                    <div class="flex items-center mb-1">
                        <div class="w-4 h-4 rounded mr-2 bg-red-400"></div>
                        <span class="text-sm text-gray-600">Kuota Penuh</span>
                    </div>
                    <div class="flex items-center mb-1">
                        <div class="w-4 h-4 rounded mr-2 bg-gray-200"></div>
                        <span class="text-sm text-gray-600">Akhir pekan (tidak dihitung)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded mr-2 bg-red-600"></div>
                        <span class="text-sm text-gray-600">Hari Libur Nasional / Cuti Bersama</span>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- The Modal -->
    <div id="successModal" class="modal flex justify-center items-center">
        <div class="modal-content">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-teal-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="modal-header">Success</div>
                <div class="modal-body">
                    <p class="mb-4 text-sm">Pengajuan telah berhasil diajukan.</p>
                    <p class="mb-4 text-sm font-semibold">Terima kasih atas dedikasi Anda, Harap pantau terus informasi pengajuan cuti anda dan selamat menjalankan cuti dan silakan kembali bekerja jika cuti Anda sudah selesai.</p>
                </div>
                <button id="modalConfirmBtn" class="w-full bg-teal-600 text-white font-bold py-3 rounded-lg hover:bg-teal-700 transition-colors mt-4">Konfirmasi</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const calendar = document.getElementById('calendar');
            const currentMonthYear = document.getElementById('currentMonthYear');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            const selectedDatesBox = document.getElementById('selectedDatesBox');
            const currentTimeElement = document.getElementById('currentTime');
            const quotaInfoBox = document.getElementById('quotaInfo');
            const leaveTypeSelect = document.getElementById('leave-type-select');
            const formContainer = document.getElementById('formContainer');
            const submitBtn = document.getElementById('submitBtn');
            const descriptionInput = document.getElementById('description');
            const validationMessage = document.getElementById('validationMessage');
            const successModal = document.getElementById('successModal');
            const modalConfirmBtn = document.getElementById('modalConfirmBtn');
            
            let today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();
            let selectedDates = [];

            const MAX_LEAVE_DAYS = 12;

            const quotaCuttingLeaveTypes = ['cuti_menikah', 'cuti_istri_melahirkan', 'cuti_besar'];
            
            leaveTypeSelect.addEventListener('change', (event) => {
                const selectedValue = event.target.value;
                if (selectedValue) {
                    formContainer.classList.remove('hidden');
                } else {
                    formContainer.classList.add('hidden');
                }

                if (quotaCuttingLeaveTypes.includes(selectedValue)) {
                    quotaInfoBox.style.display = 'block';
                } else {
                    quotaInfoBox.style.display = 'none';
                }
            });

            // Daftar hari libur nasional (contoh)
            const holidays = {
                '2025-05-12': 'Hari Raya Idul Fitri',
                '2025-05-13': 'Cuti Bersama Idul Fitri',
                '2025-05-20': 'Hari Raya Waisak',
                '2025-06-01': 'Hari Lahir Pancasila',
                '2025-06-15': 'Hari Raya Idul Adha',
            };

            const fullQuotaDates = {
                '2025-05-22': true,
                '2025-05-23': true,
            };

            const almostFullDates = {
                '2025-05-21': true,
            };

            const renderCalendar = (month, year) => {
                calendar.innerHTML = '';
                const firstDayOfMonth = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                
                currentMonthYear.textContent = `${monthNames[month]} ${year}`;

                for (let i = 0; i < firstDayOfMonth; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.classList.add('p-2', 'h-10', 'flex', 'items-center', 'justify-content');
                    calendar.appendChild(emptyDay);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.classList.add('p-2', 'h-10', 'flex', 'items-center', 'justify-center', 'rounded-xl', 'transition-all', 'calendar-day', 'text-sm');
                    dayElement.textContent = day;

                    const date = new Date(year, month, day);
                    const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const dayOfWeek = date.getDay();

                    if (dayOfWeek === 0 || dayOfWeek === 6) {
                        dayElement.classList.add('weekend', 'bg-gray-200');
                        dayElement.classList.remove('hover:bg-gray-200');
                    }
                    
                    let isNotSelectable = false;
                    let holidayName = holidays[formattedDate];
                    if (holidayName) {
                        dayElement.classList.add('bg-red-600', 'text-white', 'holiday', 'relative');
                        dayElement.innerHTML = `<span class="day-number">${day}</span><div class="day-tooltip">${holidayName}</div>`;
                        isNotSelectable = true;
                    } else if (fullQuotaDates[formattedDate]) {
                        dayElement.classList.add('bg-red-400', 'text-white');
                        isNotSelectable = true;
                    } else if (almostFullDates[formattedDate]) {
                        dayElement.classList.add('bg-yellow-400', 'text-white');
                    }

                    if (selectedDates.includes(formattedDate)) {
                        dayElement.classList.add('selected', 'bg-green-500');
                    }

                    const isPastDate = date < today.setHours(0, 0, 0, 0);
                    if (isPastDate || isNotSelectable || dayOfWeek === 0 || dayOfWeek === 6) {
                        dayElement.classList.remove('hover:bg-gray-200');
                        dayElement.classList.add('cursor-not-allowed', 'opacity-50');
                    } else {
                        dayElement.addEventListener('click', () => {
                            if (selectedDates.includes(formattedDate)) {
                                selectedDates = selectedDates.filter(d => d !== formattedDate);
                                dayElement.classList.remove('selected', 'bg-green-500');
                                dayElement.classList.add('hover:bg-gray-200');
                                if (almostFullDates[formattedDate]) {
                                    dayElement.classList.remove('bg-green-500');
                                    dayElement.classList.add('bg-yellow-400', 'text-white');
                                }
                            } else {
                                if (selectedDates.length >= MAX_LEAVE_DAYS) {
                                    showMessage(`Maaf, Anda tidak dapat memilih lebih dari ${MAX_LEAVE_DAYS} hari cuti.`, 'error');
                                    return;
                                }
                                selectedDates.push(formattedDate);
                                dayElement.classList.add('selected', 'bg-green-500');
                                dayElement.classList.remove('hover:bg-gray-200', 'bg-yellow-400');
                            }
                            updateSelectedDatesBox();
                            hideMessage();
                        });
                    }
                    calendar.appendChild(dayElement);
                }
            };

            const updateSelectedDatesBox = () => {
                if (selectedDates.length > 0) {
                    const sortedDates = selectedDates.sort();
                    selectedDatesBox.innerHTML = '';
                    sortedDates.forEach(date => {
                        const dateSpan = document.createElement('span');
                        dateSpan.textContent = new Date(date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                        dateSpan.classList.add('block', 'text-sm', 'text-gray-700', 'p-1');
                        selectedDatesBox.appendChild(dateSpan);
                    });
                } else {
                    selectedDatesBox.textContent = 'Belum ada tanggal dipilih';
                }
            };

            const showMessage = (message, type) => {
                validationMessage.textContent = message;
                validationMessage.classList.remove('hidden');
                if (type === 'error') {
                    validationMessage.classList.add('bg-red-100', 'text-red-700');
                    validationMessage.classList.remove('bg-green-100', 'text-green-700');
                } else {
                    validationMessage.classList.add('bg-green-100', 'text-green-700');
                    validationMessage.classList.remove('bg-red-100', 'text-red-700');
                }
            };

            const hideMessage = () => {
                validationMessage.classList.add('hidden');
            };
            
            const updateCurrentTime = () => {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', timeZoneName: 'short' };
                currentTimeElement.textContent = now.toLocaleDateString('id-ID', options);
            };

            const resetForm = () => {
                selectedDates = [];
                leaveTypeSelect.value = "";
                descriptionInput.value = '';
                formContainer.classList.add('hidden');
                updateSelectedDatesBox();
                renderCalendar(currentMonth, currentYear);
            };

            submitBtn.addEventListener('click', () => {
                hideMessage();
                const selectedLeaveType = leaveTypeSelect.value;
                const description = descriptionInput.value.trim();

                if (!selectedLeaveType) {
                    showMessage('Silakan pilih jenis cuti terlebih dahulu.', 'error');
                    return;
                }

                if (selectedDates.length === 0) {
                    showMessage('Silakan pilih setidaknya satu tanggal cuti.', 'error');
                    return;
                }

                if (quotaCuttingLeaveTypes.includes(selectedLeaveType) && description === '') {
                    showMessage('Alasan cuti wajib diisi untuk jenis cuti yang memotong kuota.', 'error');
                    return;
                }

                successModal.style.display = 'flex';
            });
            
            modalConfirmBtn.addEventListener('click', () => {
                successModal.style.display = 'none';
                resetForm();
            });

            window.addEventListener('click', (event) => {
                if (event.target == successModal) {
                    successModal.style.display = 'none';
                    resetForm();
                }
            });

            prevMonthBtn.addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar(currentMonth, currentYear);
                hideMessage();
            });

            nextMonthBtn.addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar(currentMonth, currentYear);
                hideMessage();
            });

            renderCalendar(currentMonth, currentYear);
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);
        });
    </script>
</body>
</html>
