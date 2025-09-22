<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vemos | Profil Pengguna</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .container-fluid {
            padding: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
        }
        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-group input,
        .input-group button {
            border-radius: 0.75rem;
        }
        .input-group input:focus,
        .input-group button:focus {
            outline: none;
            box-shadow: 0 0 0 2px #a5b4fc;
        }
        .btn-primary {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4338ca;
        }
        .btn-secondary {
            background-color: #d1d5db;
            color: #4b5563;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #9ca3af;
        }
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 0.15s;
        }
        .profile-image-container {
            position: relative;
            cursor: pointer;
        }
        .profile-image-container:hover .edit-icon {
            opacity: 1;
        }
        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 3rem;
            height: 3rem;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .alert-message {
            background-color: #fecaca;
            color: #b91c1c;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            border: 1px solid #ef4444;
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 antialiased">

    <div class="container-fluid">
        <!-- Header -->
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Profil</h1>
        </header>

        <!-- Main Content -->
        <main class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <!-- Card Profil -->
            <div class="card md:col-span-1 lg:col-span-1 flex flex-col items-center p-6">
                <div class="profile-image-container w-32 h-32 mb-4">
                    <img src="https://placehold.co/150x150/d1d5db/4b5563?text=FDL" alt="Foto Profil" class="w-full h-full rounded-full object-cover">
                    <div class="edit-icon" onclick="triggerFileInput()">
                        <input type="file" id="profile_photo" class="hidden" accept="image/*" onchange="previewProfilePhoto(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <script>
                        function triggerFileInput() {
                            document.getElementById('profile_photo').click();
                        }

                        function previewProfilePhoto(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const profileImage = document.querySelector('.profile-image-container img');
                                    profileImage.src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-1">FADIL UY</h2>
                <div class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2 py-1 rounded-full mb-4">Super Admin</div>
                <div class="space-y-2 text-gray-600 w-full text-center">
                    <p class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>WOII@company.com</span>
                    </p>
                    <p class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.144l-2.545 1.838a1 1 0 00-.568 1.145l1.498 4.493a1 1 0 01-.502 1.144l-2.545 1.838a1 1 0 00-.568 1.145l1.498 4.493a1 1 0 01-.502 1.144z" />
                        </svg>
                        <span>+123 456 789</span>
                    </p>
                    <p class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.899a2 2 0 01-2.828 0l-4.243-4.242a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Bandung, Jawa Barat</span>
                    </p>
                    <p class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>30-12-2025</span>
                    </p>
                </div>
            </div>

            <!-- Formulir Informasi Profil dan Ubah Kata Sandi -->
            <div class="md:col-span-2 lg:col-span-3 space-y-6">
                <!-- Informasi Profil -->
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Profil</h3>
                    <p class="text-sm text-gray-500 mb-4">Perbarui informasi pribadi dan kontak Anda</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="input-group">
                            <label for="full-name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="full-name" value="Jhon Legens" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                        <div class="input-group">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" id="address" value="Bandung, Jawa Barat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                        <div class="input-group">
                            <label for="phone-number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" id="phone-number" value="+123 456 789 100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                    </div>
                    <div class="flex space-x-4 mt-4">
                        <button class="btn-primary">Perbarui Profil</button>                        
                    </div>
                </div>

                <!-- Ubah Kata Sandi -->
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ubah Kata Sandi</h3>
                    <p class="text-sm text-gray-500 mb-4">Perbarui kata sandi Anda untuk menjaga keamanan akun</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="input-group">
                            <label for="current-password" class="block text-sm font-medium text-gray-700">Kata Sandi Saat Ini</label>
                            <input type="password" id="current-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                        <div class="input-group">
                            <label for="new-password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                            <input type="password" id="new-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                        <div class="input-group">
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" id="confirm-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Kata sandi harus minimal **14 karakter** dan berisi kombinasi huruf, angka, dan simbol.</p>
                    <div id="password-validation-message" class="alert-message"></div>
                    <div class="flex space-x-4 mt-4">
                        <button id="save-password-btn" class="btn-primary">Simpan</button>                        
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const profileImageContainer = document.querySelector('.profile-image-container');
            const savePasswordBtn = document.getElementById('save-password-btn');
            const validationMessage = document.getElementById('password-validation-message');

            
            savePasswordBtn.addEventListener('click', (e) => {
                e.preventDefault();

                const currentPassword = document.getElementById('current-password').value;
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;

                // Reset pesan validasi
                validationMessage.style.display = 'none';
                validationMessage.textContent = '';

                let errors = [];

                if (!currentPassword || !newPassword || !confirmPassword) {
                    errors.push('Semua kolom kata sandi harus diisi.');
                }

                if (newPassword !== confirmPassword) {
                    errors.push('Kata sandi baru dan konfirmasinya tidak cocok.');
                }

                // Regex untuk memeriksa huruf, angka, dan simbol (minimal 14 karakter)
                const passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{14,})/;
                if (newPassword && !passwordRegex.test(newPassword)) {
                    errors.push('Kata sandi harus minimal 14 karakter dan berisi kombinasi huruf, angka, dan simbol.');
                }
                
                if (errors.length > 0) {
                    validationMessage.textContent = errors.join(' ');
                    validationMessage.style.display = 'block';
                } else {
                    // Logika untuk menyimpan kata sandi akan ditambahkan di sini
                    alert('Kata sandi berhasil diperbarui!');
                }
            });
            
            function alert(message) {
                // A simple custom alert box
                const alertDiv = document.createElement('div');
                alertDiv.style.position = 'fixed';
                alertDiv.style.top = '50%';
                alertDiv.style.left = '50%';
                alertDiv.style.transform = 'translate(-50%, -50%)';
                alertDiv.style.padding = '20px';
                alertDiv.style.backgroundColor = 'white';
                alertDiv.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
                alertDiv.style.borderRadius = '10px';
                alertDiv.style.zIndex = '1000';
                alertDiv.style.textAlign = 'center';
                alertDiv.innerHTML = `<p>${message}</p><button onclick="this.parentNode.remove()" style="margin-top:10px; padding:8px 16px; border-radius:5px; background-color:#4f46e5; color:white;">OK</button>`;
                document.body.appendChild(alertDiv);
            }
        });
    </script>

</body>
</html>
