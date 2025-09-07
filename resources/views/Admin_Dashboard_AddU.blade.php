<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS ini dipertahankan untuk responsivitas yang lebih baik */
        @media (max-width: 768px) {
            .flex-container {
                flex-direction: column;
            }

            .sidebar-stepper {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }

            .form-container {
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen bg-gray-100">

        <!-- Sidebar (VEMOS) -->
        <div class="hidden md:flex flex-col bg-white w-64 shadow-lg p-6 flex-shrink-0 overflow-hidden">
            <div class="flex items-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.75 17L9.75 15.5M12 17L12 15.5M14.25 17L14.25 15.5M12 21a9 9 0 100-18 9 9 0 000 18z" />
                </svg>
                <span class="text-2xl font-bold text-gray-800">VEMOS</span>
            </div>
            <!-- Menggunakan overflow-y-auto pada nav untuk menampung semua menu jika daftar terlalu panjang, tanpa membuat seluruh halaman dapat digulir. -->
            <!-- Font tulisan pada menu sidebar dibuat lebih kecil dengan text-sm -->
            <nav class="flex-grow overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-project-diagram mr-3"></i> Project
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 font-semibold bg-gray-200 text-sm">
                            <i class="fas fa-users mr-3 text-blue-600"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-list-check mr-3"></i> Work Orders
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-cogs mr-3"></i> Aplikasi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-chart-line mr-3"></i> Reports
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-calendar-alt mr-3"></i> Schedules
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-history mr-3"></i> History
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-fingerprint mr-3"></i> Presensi
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-8">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-bell mr-3"></i> Notifications
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-cog mr-3"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-200 text-gray-700 text-sm">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center mt-6 p-4 rounded-lg bg-gray-100">
                <img src="https://placehold.co/40x40/e2e8f0/64748b" alt="Profile"
                    class="rounded-full mr-3">
                <div class="text-sm">
                    <div class="font-semibold text-gray-800">Fadil Oi</div>
                    <div class="text-gray-500">Fadil12@gmail.com</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header with Search -->
            <header class="bg-white shadow-sm p-4 md:p-6 flex justify-between items-center">
                <div class="flex items-center w-full">
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Add User</h1>
                    <div class="relative w-full md:w-1/2 ml-auto">
                        <input type="text" placeholder="Search for anything..."
                            class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </header>

            <!-- Form Container -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl overflow-hidden">
                    <div class="md:flex flex-container">
                        <!-- Stepper -->
                        <div class="w-full md:w-1/4 border-r md:px-6 py-6 sidebar-stepper">
                            <div class="space-y-8">
                                <div class="flex items-center space-x-3" id="step1">
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                        1</div>
                                    <span class="font-medium">Account Information</span>
                                </div>
                                <div class="flex items-center space-x-3" id="step2">
                                    <div
                                        class="w-8 h-8 rounded-full border border-gray-300 text-gray-500 flex items-center justify-center font-bold">
                                        2</div>
                                    <span class="text-gray-500">Personal Information</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <div id="userWizard" class="w-full md:w-3/4 form-container">
                            <!-- Step 1: Account Information -->
                            <div class="step">
                                <div class="px-8 py-6">
                                    <form id="formStep1" class="space-y-6" onsubmit="return false;">
                                        <!-- Username -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Username</label>
                                            <input id="username" name="username" type="text" required
                                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Email</label>
                                            <input id="email" name="email" type="email" required
                                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>

                                        <!-- Password -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                                <!-- Tambahkan ikon mata untuk melihat/menyembunyikan sandi -->
                                                <div class="relative">
                                                    <input id="password" name="password" type="password" required
                                                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-blue-500 focus:border-blue-500">
                                                    <span id="togglePassword"
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                                        <i class="fas fa-eye text-gray-400"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                                                <!-- Tambahkan ikon mata untuk melihat/menyembunyikan sandi konfirmasi -->
                                                <div class="relative">
                                                    <input id="password_confirmation" name="password_confirmation"
                                                        type="password" required
                                                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 focus:ring-blue-500 focus:border-blue-500">
                                                    <span id="togglePasswordConfirmation"
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                                        <i class="fas fa-eye text-gray-400"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end space-x-3">
                                            <button type="button"
                                                class="px-6 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Cancel</button>
                                            <button type="button" id="nextBtn"
                                                class="px-6 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 next-step">Save and continue</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Step 2: Personal Information -->
                            <div class="step hidden">
                                <div class="p-8">
                                    <form id="formStep2" class="space-y-6" onsubmit="return false;">
                                        <!-- Profile Photo -->
                                        <div class="flex items-center space-x-4">
                                            <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                <i class="fas fa-user-circle text-5xl"></i>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Profile Photo</label>
                                                <button type="button"
                                                    class="mt-2 px-4 py-2 rounded-lg border border-blue-600 text-blue-600 hover:bg-blue-50">Choose Photo</button>
                                            </div>
                                        </div>

                                        <!-- Nama Lengkap -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                            <input id="nama_lengkap" name="nama_lengkap" type="text" required
                                                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>

                                        <!-- Tanggal Lahir & No. Telp -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" required
                                                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">No. Telp</label>
                                                <input id="no_telp" name="no_telp" type="tel" required
                                                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        </div>

                                        <!-- Role & Unit -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                                <select id="role" name="role" required
                                                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select Role</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Unit</label>
                                                <select id="unit" name="unit" required
                                                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select Unit</option>
                                                    <option value="marketing">Marketing</option>
                                                    <option value="finance">Finance</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Vendor & Posisi -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Vendor</label>
                                                <select id="vendor" name="vendor" required
                                                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select Vendor</option>
                                                    <option value="vendor_a">Vendor A</option>
                                                    <option value="vendor_b">Vendor B</option>
                                                    <option value="vendor_c">Vendor C</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Posisi</label>
                                                <select id="posisi" name="posisi" required
                                                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select Posisi</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="staf">Staf</option>
                                                    <option value="supervisor">Supervisor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="mt-8 flex justify-end space-x-4">
                                            <button type="button"
                                                class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-100"
                                                id="backBtn">
                                                Back
                                            </button>
                                            <button type="button" id="saveBtn"
                                                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll(".step");

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle("hidden", i !== index);
            });
        }

        function updateStepperUI(stepIndex) {
            const step1Div = document.querySelector("#step1 div");
            const step1Span = document.querySelector("#step1 span");
            const step2Div = document.querySelector("#step2 div");
            const step2Span = document.querySelector("#step2 span");

            if (stepIndex === 0) {
                step1Div.classList.remove("border", "border-gray-300", "text-gray-500");
                step1Div.classList.add("bg-blue-600", "text-white");
                step1Span.classList.remove("text-gray-500");
                step1Span.classList.add("font-medium");

                step2Div.classList.remove("bg-blue-600", "text-white");
                step2Div.classList.add("border", "border-gray-300", "text-gray-500");
                step2Span.classList.remove("font-medium");
                step2Span.classList.add("text-gray-500");
            } else if (stepIndex === 1) {
                step1Div.classList.remove("bg-blue-600", "text-white");
                step1Div.classList.add("border", "border-gray-300", "text-gray-500");
                step1Span.classList.remove("font-medium");
                step1Span.classList.add("text-gray-500");

                step2Div.classList.remove("border", "border-gray-300", "text-gray-500");
                step2Div.classList.add("bg-blue-600", "text-white");
                step2Span.classList.remove("text-gray-500");
                step2Span.classList.add("font-medium");
            }
        }

        // Fungsi untuk validasi sandi
        function validatePasswordMatch() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("password_confirmation").value;

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: "error",
                    title: "Kesalahan!",
                    text: "Sandi dan Konfirmasi Sandi tidak cocok.",
                });
                return false;
            }
            return true;
        }

        // Fungsi untuk toggle visibilitas sandi
        function setupPasswordToggle(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);

            toggle.addEventListener("click", function () {
                const type = input.getAttribute("type") === "password" ? "text" : "password";
                input.setAttribute("type", type);
                this.querySelector("i").classList.toggle("fa-eye");
                this.querySelector("i").classList.toggle("fa-eye-slash");
            });
        }

        document.getElementById("nextBtn").addEventListener("click", function () {
            const formStep1 = document.getElementById("formStep1");
            const requiredFields = formStep1.querySelectorAll("[required]");
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add("border-red-500");
                } else {
                    field.classList.remove("border-red-500");
                }
            });

            if (isValid && validatePasswordMatch()) {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                    updateStepperUI(currentStep);
                }
            } else if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Kesalahan!",
                    text: "Mohon lengkapi semua bidang yang wajib diisi.",
                });
            }
        });

        document.getElementById("backBtn").addEventListener("click", function () {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
                updateStepperUI(currentStep);
            }
        });

        document.getElementById("saveBtn").addEventListener("click", async function () {
            const formStep2 = document.getElementById("formStep2");
            const requiredFields = formStep2.querySelectorAll("[required]");
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add("border-red-500");
                } else {
                    field.classList.remove("border-red-500");
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Kesalahan!",
                    text: "Mohon lengkapi semua bidang yang wajib diisi.",
                });
                return;
            }

            const formStep1Data = Object.fromEntries(new FormData(document.getElementById("formStep1")).entries());
            const formStep2Data = Object.fromEntries(new FormData(document.getElementById("formStep2")).entries());

            const formData = {
                ...formStep1Data,
                ...formStep2Data
            };

            console.log("Data Formulir yang dikirim:", formData);

            try {
                // Simulasi API call
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Data pengguna berhasil disimpan.",
                    showConfirmButton: false,
                    timer: 2000,
                });
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat menyimpan data.",
                });
            }
        });

        // Panggil fungsi setup saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
            updateStepperUI(currentStep);
            setupPasswordToggle("password", "togglePassword");
            setupPasswordToggle("password_confirmation", "togglePasswordConfirmation");
        });
    </script>
</body>

</html>
