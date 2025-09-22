<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akses</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .active-role {
            background-color: #3A8DFF;
            color: white;
            font-weight: 600;
        }
        .hover-transition {
            transition: all 0.2s ease-in-out;
        }
        .rotate-90 {
            transform: rotate(90deg);
        }
        input[type="checkbox"]:checked {
            accent-color: #3A8DFF;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .modal.active {
            display: flex;
            opacity: 1;
        }
        .modal-content {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            transform: scale(0.95);
            transition: transform 0.3s ease-out;
        }
        .modal.active .modal-content {
            transform: scale(1);
        }
        .modal-icon {
            background-color: #E6F8F3;
            color: #17A984;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            font-size: 3rem;
            margin-bottom: 24px;
        }
    </style>
</head>
<body class="bg-[#F6F8FA] text-[#4C5A6A]">

    <div class="p-8">
        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-2xl font-semibold text-[#2C3849]">Manajemen Akses</h1>
                <p class="text-sm text-[#7F8B9B]">Daftar semua akses fitur sistem.</p>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 flex flex-col md:flex-row gap-6">

            <!-- Sidebar Peran -->
            <div class="w-full md:w-64 bg-[#EBF1F6] rounded-lg p-4 h-fit">
                <h3 class="text-lg font-semibold mb-4 text-[#2C3849]">Daftar Peran</h3>
                <ul id="role-list" class="space-y-2">
                    <li class="p-3 rounded-md cursor-pointer hover:bg-[#DCE7F0] hover-transition flex justify-between items-center" data-role="superadmin">
                        <span>Super Admin</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </li>
                    <li class="p-3 rounded-md cursor-pointer hover:bg-[#DCE7F0] hover-transition flex justify-between items-center" data-role="admin">
                        <span>Admin</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </li>
                    <li class="p-3 rounded-md cursor-pointer hover:bg-[#DCE7F0] hover-transition flex justify-between items-center" data-role="vendor">
                        <span>Vendor</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </li>
                </ul>
            </div>

            <!-- Panel Hak Akses -->
            <div id="access-panel" class="flex-grow bg-white rounded-xl p-4 flex flex-col items-center justify-center text-center">
                <!-- Panel Awal (Default) -->
                <div id="initial-panel" class="p-8">
                    <div class="bg-[#EBF1F6] rounded-full p-6 text-5xl text-[#AAB4C2] mb-4">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <h2 class="text-xl font-semibold mb-2">Pilih Peran</h2>
                    <p class="text-[#7F8B9B]">Silahkan pilih salah satu yang akan diberi akses</p>
                </div>

                <!-- Panel Super Admin -->
                <div id="superadmin-panel" class="hidden w-full">
                    <h2 class="text-xl font-semibold mb-6 text-[#2C3849]">Edit Hak Akses : Super Admin</h2>
                    <!-- Permissions sections -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 text-left">
                        <!-- Section: Dashboard -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="super_dashboard_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Dashboard</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_dashboard_view" class="rounded-sm" checked>
                                    <label for="super_dashboard_view">Lihat Dashboard</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Manajemen -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="super_manajemen_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Manajemen</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <!-- Level 2: User -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 cursor-pointer toggle-permission-section-level2">
                                        <i class="fa-solid fa-angle-right hover-transition text-sm"></i>
                                        <h4 class="font-normal text-[#4C5A6A] mb-1">User</h4>
                                    </div>
                                    <div class="pl-4 space-y-2 permission-list-level2 hidden">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_view" class="rounded-sm" checked>
                                            <label for="super_user_view">Lihat User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_add" class="rounded-sm" checked>
                                            <label for="super_user_add">Tambah User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_simpan" class="rounded-sm" checked>
                                            <label for="super_user_simpan">Simpan User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_delete" class="rounded-sm" checked>
                                            <label for="super_user_delete">Delete User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_input_form" class="rounded-sm" checked>
                                            <label for="super_user_input_form">Input User Form</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_input_post" class="rounded-sm" checked>
                                            <label for="super_user_input_post">Input User Post</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_user_update_status" class="rounded-sm" checked>
                                            <label for="super_user_update_status">Update Status User</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Level 2: Roles -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 cursor-pointer toggle-permission-section-level2">
                                        <i class="fa-solid fa-angle-right hover-transition text-sm"></i>
                                        <h4 class="font-normal text-[#4C5A6A] mb-1">Roles</h4>
                                    </div>
                                    <div class="pl-4 space-y-2 permission-list-level2 hidden">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_roles_view" class="rounded-sm" checked>
                                            <label for="super_roles_view">Lihat Roles</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_roles_add" class="rounded-sm" checked>
                                            <label for="super_roles_add">Tambah Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_roles_simpan" class="rounded-sm" checked>
                                            <label for="super_roles_simpan">Simpan Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_roles_edit" class="rounded-sm" checked>
                                            <label for="super_roles_edit">Edit Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_roles_delete" class="rounded-sm" checked>
                                            <label for="super_roles_delete">Delete Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_roles_update" class="rounded-sm" checked>
                                            <label for="super_roles_update">Update role</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Level 2: Posisi -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 cursor-pointer toggle-permission-section-level2">
                                        <i class="fa-solid fa-angle-right hover-transition text-sm"></i>
                                        <h4 class="font-normal text-[#4C5A6A] mb-1">Posisi</h4>
                                    </div>
                                    <div class="pl-4 space-y-2 permission-list-level2 hidden">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_posisi_view" class="rounded-sm" checked>
                                            <label for="super_posisi_view">Lihat Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_posisi_add" class="rounded-sm" checked>
                                            <label for="super_posisi_add">Tambah Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_posisi_simpan" class="rounded-sm" checked>
                                            <label for="super_posisi_simpan">Simpan Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_posisi_edit" class="rounded-sm" checked>
                                            <label for="super_posisi_edit">Edit Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_posisi_delete" class="rounded-sm" checked>
                                            <label for="super_posisi_delete">Delete Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="super_posisi_update" class="rounded-sm" checked>
                                            <label for="super_posisi_update">Update Posisi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Unit -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="super_unit_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Unit</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_tambah_unit" class="rounded-sm" checked>
                                    <label for="super_tambah_unit">Tambah Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_simpan_unit" class="rounded-sm" checked>
                                    <label for="super_simpan_unit">Simpan Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_edit_unit" class="rounded-sm" checked>
                                    <label for="super_edit_unit">Edit Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_delete_unit" class="rounded-sm" checked>
                                    <label for="super_delete_unit">Delete Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_update_unit" class="rounded-sm" checked>
                                    <label for="super_update_unit">Update Unit</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Vendor -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="super_vendor_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Vendor</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_tambah_vendor" class="rounded-sm" checked>
                                    <label for="super_tambah_vendor">Tambah Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_simpan_vendor" class="rounded-sm" checked>
                                    <label for="super_simpan_vendor">Simpan Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_edit_vendor" class="rounded-sm" checked>
                                    <label for="super_edit_vendor">Edit Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_delete_vendor" class="rounded-sm" checked>
                                    <label for="super_delete_vendor">Delete Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_update_vendor" class="rounded-sm" checked>
                                    <label for="super_update_vendor">Update Vendor</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Jenis Izin -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="super_izin_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Jenis Izin</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_tambah_izin" class="rounded-sm" checked>
                                    <label for="super_tambah_izin">Tambah Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_simpan_izin" class="rounded-sm" checked>
                                    <label for="super_simpan_izin">Simpan Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_edit_izin" class="rounded-sm" checked>
                                    <label for="super_edit_izin">Edit Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_delete_izin" class="rounded-sm" checked>
                                    <label for="super_delete_izin">Delete Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_update_izin" class="rounded-sm" checked>
                                    <label for="super_update_izin">Update Jenis Izin</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Kegiatan -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="super_kegiatan_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Kegiatan</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="super_kegiatan_view" class="rounded-sm" checked>
                                    <label for="super_kegiatan_view">Lihat Kegiatan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Save Button -->
                    <div class="mt-8 text-right w-full">
                        <button class="bg-[#3A8DFF] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#2A75D2] transition duration-200 save-button">Simpan</button>
                    </div>
                </div>

                <!-- Panel Admin -->
                <div id="admin-panel" class="hidden w-full">
                    <h2 class="text-xl font-semibold mb-6 text-[#2C3849]">Edit Hak Akses : Admin</h2>
                    <!-- Permissions sections -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 text-left">
                        <!-- Section: Dashboard -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="admin_dashboard_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Dashboard</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_dashboard_view" class="rounded-sm" checked>
                                    <label for="admin_dashboard_view">Lihat Dashboard</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Manajemen -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="admin_manajemen_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Manajemen</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <!-- Level 2: User -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 cursor-pointer toggle-permission-section-level2">
                                        <i class="fa-solid fa-angle-right hover-transition text-sm"></i>
                                        <h4 class="font-normal text-[#4C5A6A] mb-1">User</h4>
                                    </div>
                                    <div class="pl-4 space-y-2 permission-list-level2 hidden">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_view" class="rounded-sm" checked>
                                            <label for="admin_user_view">Lihat User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_add" class="rounded-sm">
                                            <label for="admin_user_add">Tambah User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_simpan" class="rounded-sm">
                                            <label for="admin_user_simpan">Simpan User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_delete" class="rounded-sm">
                                            <label for="admin_user_delete">Delete User</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_input_form" class="rounded-sm">
                                            <label for="admin_user_input_form">Input User Form</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_input_post" class="rounded-sm">
                                            <label for="admin_user_input_post">Input User Post</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_user_update_status" class="rounded-sm">
                                            <label for="admin_user_update_status">Update Status User</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Level 2: Roles -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 cursor-pointer toggle-permission-section-level2">
                                        <i class="fa-solid fa-angle-right hover-transition text-sm"></i>
                                        <h4 class="font-normal text-[#4C5A6A] mb-1">Roles</h4>
                                    </div>
                                    <div class="pl-4 space-y-2 permission-list-level2 hidden">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_roles_view" class="rounded-sm" checked>
                                            <label for="admin_roles_view">Lihat Roles</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_roles_add" class="rounded-sm">
                                            <label for="admin_roles_add">Tambah Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_roles_simpan" class="rounded-sm">
                                            <label for="admin_roles_simpan">Simpan Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_roles_edit" class="rounded-sm">
                                            <label for="admin_roles_edit">Edit Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_roles_delete" class="rounded-sm">
                                            <label for="admin_roles_delete">Delete Role</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_roles_update" class="rounded-sm">
                                            <label for="admin_roles_update">Update role</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Level 2: Posisi -->
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2 cursor-pointer toggle-permission-section-level2">
                                        <i class="fa-solid fa-angle-right hover-transition text-sm"></i>
                                        <h4 class="font-normal text-[#4C5A6A] mb-1">Posisi</h4>
                                    </div>
                                    <div class="pl-4 space-y-2 permission-list-level2 hidden">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_posisi_view" class="rounded-sm" checked>
                                            <label for="admin_posisi_view">Lihat Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_posisi_add" class="rounded-sm">
                                            <label for="admin_posisi_add">Tambah Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_posisi_simpan" class="rounded-sm">
                                            <label for="admin_posisi_simpan">Simpan Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_posisi_edit" class="rounded-sm">
                                            <label for="admin_posisi_edit">Edit Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_posisi_delete" class="rounded-sm">
                                            <label for="admin_posisi_delete">Delete Posisi</label>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" id="admin_posisi_update" class="rounded-sm">
                                            <label for="admin_posisi_update">Update Posisi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Unit -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="admin_unit_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Unit</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_tambah_unit" class="rounded-sm">
                                    <label for="admin_tambah_unit">Tambah Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_simpan_unit" class="rounded-sm">
                                    <label for="admin_simpan_unit">Simpan Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_edit_unit" class="rounded-sm">
                                    <label for="admin_edit_unit">Edit Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_delete_unit" class="rounded-sm">
                                    <label for="admin_delete_unit">Delete Unit</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_update_unit" class="rounded-sm">
                                    <label for="admin_update_unit">Update Unit</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Vendor -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="admin_vendor_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Vendor</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_tambah_vendor" class="rounded-sm">
                                    <label for="admin_tambah_vendor">Tambah Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_simpan_vendor" class="rounded-sm">
                                    <label for="admin_simpan_vendor">Simpan Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_edit_vendor" class="rounded-sm">
                                    <label for="admin_edit_vendor">Edit Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_delete_vendor" class="rounded-sm">
                                    <label for="admin_delete_vendor">Delete Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_update_vendor" class="rounded-sm">
                                    <label for="admin_update_vendor">Update Vendor</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Jenis Izin -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="admin_izin_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Jenis Izin</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_tambah_izin" class="rounded-sm">
                                    <label for="admin_tambah_izin">Tambah Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_simpan_izin" class="rounded-sm">
                                    <label for="admin_simpan_izin">Simpan Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_edit_izin" class="rounded-sm">
                                    <label for="admin_edit_izin">Edit Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_delete_izin" class="rounded-sm">
                                    <label for="admin_delete_izin">Delete Jenis Izin</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_update_izin" class="rounded-sm">
                                    <label for="admin_update_izin">Update Jenis Izin</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Kegiatan -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="admin_kegiatan_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Kegiatan</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="admin_kegiatan_view" class="rounded-sm" checked>
                                    <label for="admin_kegiatan_view">Lihat Kegiatan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Save Button -->
                    <div class="mt-8 text-right w-full">
                        <button class="bg-[#3A8DFF] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#2A75D2] transition duration-200 save-button">Simpan</button>
                    </div>
                </div>

                <!-- Panel Vendor -->
                <div id="vendor-panel" class="hidden w-full">
                    <h2 class="text-xl font-semibold mb-6 text-[#2C3849]">Edit Hak Akses : Vendor</h2>
                    <!-- Permissions sections -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 text-left">
                        <!-- Section: Vendor -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="vendor_vendor_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Vendor</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="vendor_tambah_vendor" class="rounded-sm">
                                    <label for="vendor_tambah_vendor">Tambah Vendor</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="vendor_simpan_vendor" class="rounded-sm">
                                    <label for="vendor_simpan_vendor">Simpan Vendor</label>
                                </div>
                            </div>
                        </div>
                        <!-- Section: Kegiatan -->
                        <div class="permission-group">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="vendor_kegiatan_all" class="rounded-sm checkbox-parent">
                                <div class="flex items-center gap-2 cursor-pointer toggle-section">
                                    <i class="fa-solid fa-angle-right hover-transition"></i>
                                    <h3 class="font-medium text-[#2C3849]">Kegiatan</h3>
                                </div>
                            </div>
                            <div class="pl-4 space-y-2 permission-list hidden">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="vendor_kegiatan_view" class="rounded-sm" checked>
                                    <label for="vendor_kegiatan_view">Lihat Kegiatan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 text-right w-full">
                        <button class="bg-[#3A8DFF] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#2A75D2] transition duration-200 save-button">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirm-modal" class="modal">
        <div class="modal-content">
            <div class="bg-[#F2F8FF] text-[#3A8DFF] p-6 rounded-full inline-flex justify-center items-center mb-6">
                <i class="fa-solid fa-circle-question text-5xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-[#2C3849]">Apakah Anda yakin ingin memberikan akses ini?</h3>
            <p class="text-[#7F8B9B] mb-6">Pastikan hak akses yang dipilih sudah benar.</p>
            <div class="flex gap-4">
                <button id="modal-cancel-btn" class="flex-1 text-[#4C5A6A] border border-[#D1D9E0] px-6 py-3 rounded-lg font-medium hover:bg-[#EBF1F6] transition duration-200">Batal</button>
                <button id="modal-confirm-yes-btn" class="flex-1 bg-[#3A8DFF] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#2A75D2] transition duration-200">Yakin</button>
            </div>
        </div>
    </div>

    <!-- Modal Sukses -->
    <div id="success-modal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2 text-[#2C3849]">Akses Berhasil Diberikan</h3>
            <p class="text-[#7F8B9B] mb-6">Perubahan hak akses telah disimpan.</p>
            <button id="modal-success-btn" class="bg-[#17A984] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#148b6c] transition duration-200 w-full">Konfirmasi</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleList = document.getElementById('role-list');
            const initialPanel = document.getElementById('initial-panel');
            const superAdminPanel = document.getElementById('superadmin-panel');
            const adminPanel = document.getElementById('admin-panel');
            const vendorPanel = document.getElementById('vendor-panel');
            const saveButtons = document.querySelectorAll('.save-button');
            
            const confirmModal = document.getElementById('confirm-modal');
            const confirmYesBtn = document.getElementById('modal-confirm-yes-btn');
            const confirmCancelBtn = document.getElementById('modal-cancel-btn');

            const successModal = document.getElementById('success-modal');
            const successBtn = document.getElementById('modal-success-btn');

            // Fungsi untuk menyembunyikan semua panel
            function hideAllPanels() {
                initialPanel.classList.add('hidden');
                superAdminPanel.classList.add('hidden');
                adminPanel.classList.add('hidden');
                vendorPanel.classList.add('hidden');
            }

            // Fungsi untuk menampilkan modal dengan efek fade in
            function showModal(modalElement) {
                modalElement.classList.add('active');
            }

            // Fungsi untuk menyembunyikan modal dengan efek fade out
            function hideModal(modalElement) {
                modalElement.classList.remove('active');
                modalElement.addEventListener('transitionend', function handler() {
                    modalElement.style.display = 'none';
                    modalElement.removeEventListener('transitionend', handler);
                });
                modalElement.style.display = 'none';
            }

            // Atur status awal saat halaman dimuat
            hideAllPanels();
            initialPanel.classList.remove('hidden');

            // Event listener untuk klik pada daftar peran
            roleList.addEventListener('click', function(event) {
                const target = event.target.closest('li');
                if (target && target.dataset.role) {
                    // Hapus kelas 'active' dari semua item daftar peran
                    roleList.querySelectorAll('li').forEach(li => {
                        li.classList.remove('active-role');
                    });
                    
                    // Tambahkan kelas 'active' pada item yang diklik
                    target.classList.add('active-role');

                    // Sembunyikan semua panel dan tampilkan panel yang sesuai
                    hideAllPanels();
                    switch(target.dataset.role) {
                        case 'superadmin':
                            superAdminPanel.classList.remove('hidden');
                            break;
                        case 'admin':
                            adminPanel.classList.remove('hidden');
                            break;
                        case 'vendor':
                            vendorPanel.classList.remove('hidden');
                            break;
                    }
                }
            });

            // Event listener untuk klik pada tombol "Simpan"
            saveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    showModal(confirmModal);
                });
            });

            // Event listener untuk tombol "Yakin" pada modal konfirmasi
            confirmYesBtn.addEventListener('click', function() {
                hideModal(confirmModal);
                showModal(successModal);
            });

            // Event listener untuk tombol "Batal" pada modal konfirmasi
            confirmCancelBtn.addEventListener('click', function() {
                hideModal(confirmModal);
            });

            // Event listener untuk tombol "Konfirmasi" pada modal sukses
            successBtn.addEventListener('click', function() {
                hideModal(successModal);
            });

            // Event listener untuk klik di luar modal (untuk menutupnya)
            window.addEventListener('click', function(event) {
                if (event.target === confirmModal) {
                    hideModal(confirmModal);
                }
                if (event.target === successModal) {
                    hideModal(successModal);
                }
            });

            // Event listener untuk klik pada judul kategori hak akses (Level 1)
            const permissionToggles = document.querySelectorAll('.toggle-section');
            permissionToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const permissionList = this.closest('.permission-group').querySelector('.permission-list');
                    
                    // Toggle rotasi ikon dan visibilitas daftar izin
                    icon.classList.toggle('rotate-90');
                    permissionList.classList.toggle('hidden');
                });
            });

            // Event listener untuk klik pada judul kategori hak akses (Level 2, jika ada)
            const permissionTogglesLevel2 = document.querySelectorAll('.toggle-permission-section-level2');
            permissionTogglesLevel2.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const permissionList = this.nextElementSibling;

                    // Toggle rotasi ikon dan visibilitas daftar izin
                    icon.classList.toggle('rotate-90');
                    permissionList.classList.toggle('hidden');
                });
            });

            // Event listener untuk checkbox orang tua (parent)
            const parentCheckboxes = document.querySelectorAll('.checkbox-parent');
            parentCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const permissionList = this.closest('.permission-group').querySelector('.permission-list');
                    if (permissionList) {
                        const childCheckboxes = permissionList.querySelectorAll('input[type="checkbox"]');
                        childCheckboxes.forEach(childCheckbox => {
                            childCheckbox.checked = this.checked;
                        });
                    }
                });
            });

            // Event listener untuk checkbox anak
            const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
            allCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    // Cek apakah checkbox anak ini adalah bagian dari grup
                    const permissionGroup = this.closest('.permission-group');
                    if (permissionGroup) {
                        const parentCheckbox = permissionGroup.querySelector('.checkbox-parent');
                        const allChildCheckboxes = permissionGroup.querySelectorAll('.permission-list input[type="checkbox"]');
                        
                        // Periksa jika semua kotak centang anak dicentang
                        const allChecked = Array.from(allChildCheckboxes).every(cb => cb.checked);
                        
                        // Perbarui status kotak centang induk
                        if (allChecked) {
                            parentCheckbox.checked = true;
                        } else {
                            parentCheckbox.checked = false;
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
