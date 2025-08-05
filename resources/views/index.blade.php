<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login & Register</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/style.css'])
    @vite(['resources/js/script.js'])
    <style>
        
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 md:p-8">

    <!-- Kontainer utama dengan layout 2 kolom -->
    <div id="main-container" class="bg-white rounded-3xl shadow-xl w-full max-w-5xl flex flex-col md:flex-row overflow-hidden">
        
        <!-- Kolom Kiri: Ilustrasi 3D -->
        <div id="illustration-column" class="hidden md:block md:w-1/2 p-8 bg-gray-50 items-center justify-center">
            <!-- Placeholder untuk ilustrasi. Kamu bisa ganti dengan gambar atau SVG asli. -->
            <img src="https://placehold.co/500x500/f3f4f6/6b7280?text=3D+Illustration" alt="Ilustrasi 3D" class="w-full h-full object-contain">
        </div>

        <!-- Kolom Kanan: Form Login dan Register -->
        <div id="form-column" class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
            
            <!-- Bagian Form Login -->
            <div id="login-form-content" class="space-y-6">
                <h1 class="text-4xl font-bold text-gray-800">Sign in</h1>
                <p class="text-gray-500 text-sm">Selamat datang kembali! Silakan masuk untuk melanjutkan.</p>
                
                <!-- Form input -->
                <form class="space-y-4">
                    <div>
                        <label for="login-email" class="text-sm font-medium text-gray-600">Email</label>
                        <input type="email" id="login-email" placeholder="Email" class="form-input mt-1">
                    </div>
                    <div>
                        <label for="login-password" class="text-sm font-medium text-gray-600">Password</label>
                        <input type="password" id="login-password" placeholder="Password" class="form-input mt-1">
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="remember-me" class="ml-2 block text-gray-600">Ingat saya</label>
                        </div>
                        <a href="#" class="text-blue-600 hover:text-blue-500">Lupa Password?</a>
                    </div>
                    <button type="submit" class="form-button">Login</button>
                </form>
                
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">Belum punya akun? <a href="#" id="show-register" class="text-blue-600 hover:text-blue-500 font-semibold">Daftar di sini</a></p>
                </div>
            </div>

            <!-- Bagian Form Register (multistep) -->
            <div id="register-form-content" class="space-y-6 hidden">
                <h1 class="text-4xl font-bold text-gray-800">Sign up</h1>
                <p class="text-gray-500 text-sm">Selamat datang di platform kami. Silakan daftar untuk pengalaman terbaik.</p>

                <!-- Step 1: Role, Unit, Vendor, Posisi -->
                <div id="step-1" class="form-step space-y-4">
                    <p class="text-center text-gray-500 text-sm font-medium">Langkah 1 dari 3: Informasi Organisasi</p>
                    
                    <!-- Searchable Dropdown: Role -->
                    <div class="searchable-dropdown-container">
                        <label for="register-role" class="text-sm font-medium text-gray-600">Role</label>
                        <input type="text" id="register-role" placeholder="Pilih Role" class="form-input mt-1" autocomplete="off" data-options="Manager,Staff,Admin,Supervisor,Operator">
                        <input type="hidden" id="selected-role">
                        <div id="role-list" class="searchable-dropdown-list hidden"></div>
                    </div>
                    
                    <!-- Searchable Dropdown: Unit -->
                    <div class="searchable-dropdown-container">
                        <label for="register-unit" class="text-sm font-medium text-gray-600">Unit</label>
                        <input type="text" id="register-unit" placeholder="Pilih Unit" class="form-input mt-1" autocomplete="off" data-options="Finance,Marketing,HRD,IT,Operasional,Produksi, Finance, Marketing, HRD, IT, Operasional, Produksi, Finance, Marketing, HRD, IT,
                        Operasional, Produksi, Finance, Marketing, HRD, IT, Operasional, Produksi, Finance, Marketing,
                        HRD, IT, Operasional, Produksi, Finance, Marketing, HRD, IT, Operasional, Produksi, Finance,
                        Marketing, HRD, IT, Operasional, Produksi, Finance, Marketing, HRD, IT, Operasional,
                        Produksi, Finance, Marketing, HRD, IT, Operasional, Produksi, Finance, Marketing, HRD, IT
                        ">
                        <input type="hidden" id="selected-unit">
                        <div id="unit-list" class="searchable-dropdown-list hidden"></div>
                    </div>
                    
                    <!-- Searchable Dropdown: Vendor -->
                    <div class="searchable-dropdown-container">
                        <label for="register-vendor" class="text-sm font-medium text-gray-600">Vendor</label>
                        <input type="text" id="register-vendor" placeholder="Pilih Vendor" class="form-input mt-1" autocomplete="off" data-options="Vendor A,Vendor B,Vendor C,Vendor D,Vendor E,Vendor F">
                        <input type="hidden" id="selected-vendor">
                        <div id="vendor-list" class="searchable-dropdown-list hidden"></div>
                    </div>
                    
                    <!-- Searchable Dropdown: Posisi -->
                    <div class="searchable-dropdown-container">
                        <label for="register-position" class="text-sm font-medium text-gray-600">Posisi</label>
                        <input type="text" id="register-position" placeholder="Pilih Posisi" class="form-input mt-1" autocomplete="off" data-options="Supervisor,Operator,Driver,Manajer Proyek,Analis Data">
                        <input type="hidden" id="selected-position">
                        <div id="position-list" class="searchable-dropdown-list hidden"></div>
                    </div>

                    <button type="button" id="next-step-1" class="form-button">Lanjut</button>
                </div>

                <!-- Step 2: Nama, Username, Password -->
                <div id="step-2" class="form-step space-y-4 form-step-hidden">
                    <p class="text-center text-gray-500 text-sm font-medium">Langkah 2 dari 3: Informasi Akun</p>
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="register-first-name" class="text-sm font-medium text-gray-600">Nama Awal</label>
                            <input type="text" id="register-first-name" placeholder="Nama Awal" class="form-input mt-1">
                        </div>
                        <div class="w-1/2">
                            <label for="register-last-name" class="text-sm font-medium text-gray-600">Nama Akhir</label>
                            <input type="text" id="register-last-name" placeholder="Nama Akhir" class="form-input mt-1">
                        </div>
                    </div>
                    <div>
                        <label for="register-username" class="text-sm font-medium text-gray-600">Username</label>
                        <input type="text" id="register-username" placeholder="Username" class="form-input mt-1">
                    </div>
                    <div>
                        <label for="register-password" class="text-sm font-medium text-gray-600">Password</label>
                        <input type="password" id="register-password" placeholder="Password" class="form-input mt-1">
                    </div>
                    <div class="flex justify-between space-x-4">
                        <button type="button" id="back-step-2" class="w-1/2 py-3 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-lg transition-all duration-300">Kembali</button>
                        <button type="button" id="next-step-2" class="w-1/2 py-3 text-white font-bold bg-blue-500 hover:bg-blue-600 rounded-lg transition-all duration-300">Lanjut</button>
                    </div>
                </div>

                <!-- Step 3: Tanggal Lahir, Email, No. Telepon, Status -->
                <div id="step-3" class="form-step space-y-4 form-step-hidden">
                    <p class="text-center text-gray-500 text-sm font-medium">Langkah 3 dari 3: Informasi Kontak & Lainnya</p>
                    <div>
                        <label for="register-dob" class="text-sm font-medium text-gray-600">Tanggal Lahir</label>
                        <input type="date" id="register-dob" class="form-input mt-1">
                    </div>
                    <div>
                        <label for="register-email" class="text-sm font-medium text-gray-600">Email</label>
                        <input type="email" id="register-email" placeholder="Email" class="form-input mt-1">
                    </div>
                    <div>
                        <label for="register-phone" class="text-sm font-medium text-gray-600">Nomor Telepon</label>
                        <input type="tel" id="register-phone" placeholder="Nomor Telepon" class="form-input mt-1">
                    </div>
                    <div>
                        <label for="register-status" class="text-sm font-medium text-gray-600">Status</label>
                        <input type="text" id="register-status" value="Pending" readonly class="form-input mt-1 bg-gray-100 cursor-not-allowed">
                    </div>
                    <div class="flex items-center">
                        <input id="agree-terms" name="agree-terms" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="agree-terms" class="ml-2 block text-gray-600 text-sm">Saya menyetujui <a href="#" class="text-blue-600 hover:text-blue-500">syarat dan ketentuan</a></label>
                    </div>
                    <div class="flex justify-between space-x-4">
                        <button type="button" id="back-step-3" class="w-1/2 py-3 text-gray-600 font-bold bg-gray-100 hover:bg-gray-200 rounded-lg transition-all duration-300">Kembali</button>
                        <button type="submit" id="register-submit" class="w-1/2 py-3 text-white font-bold bg-blue-500 hover:bg-blue-600 rounded-lg transition-all duration-300">Buat Akun</button>
                    </div>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">Sudah punya akun? <a href="#" id="show-login" class="text-blue-600 hover:text-blue-500 font-semibold">Masuk</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
