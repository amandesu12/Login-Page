<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vemos Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .menu-item {
            color: #4b5563;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .menu-item:hover, .menu-item.active {
            background-color: #e5e7eb;
            color: #1f2937;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1rem;
            border-radius: 8px;
            transition: background-color 0.2s ease-in-out;
        }

        .list-item:hover {
            background-color: #f9fafb;
        }

        .tooltip {
            position: absolute;
            background-color: #1f2937;
            color: #fff;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out;
            transform: translateX(-50%);
            left: 50%;
            bottom: calc(100% + 10px);
        }

        .tooltip:before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: #1f2937 transparent transparent transparent;
        }
        .chart-point:hover .tooltip {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">

        <!-- Header -->
        <header class="bg-white p-6 md:p-8 flex items-center justify-between border-b border-gray-200 shadow-sm sticky top-0 z-40">
            <h1 class="text-3xl font-bold text-gray-900">Presensi</h1>
            <div class="flex items-center gap-4">
                <div class="relative w-64">
                    <input type="text" placeholder="Search for anything..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm-3.293 11.293a1 1 0 011.414-1.414L10 12.586l1.879-1.879a1 1 0 111.414 1.414L11.414 14l1.879 1.879a1 1 0 11-1.414 1.414L10 15.414l-1.879 1.879a1 1 0 01-1.414-1.414L8.586 14l-1.879-1.879z"/>
                    </svg>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="p-6 md:p-8 flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card: Present -->
                <div class="card flex items-center gap-4">
                    <div class="flex items-center justify-center p-3 rounded-full bg-blue-100 text-blue-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-900">2</div>
                        <div class="text-sm text-gray-500">Active employees</div>
                    </div>
                    <span class="ml-auto text-sm text-gray-400">Present</span>
                </div>
                <!-- Card: Absent -->
                <div class="card flex items-center gap-4">
                    <div class="flex items-center justify-center p-3 rounded-full bg-red-100 text-red-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-900">2</div>
                        <div class="text-sm text-gray-500">Not present</div>
                    </div>
                    <span class="ml-auto text-sm text-gray-400">Absent today</span>
                </div>
                <!-- Card: Rate Arrivals -->
                <div class="card flex items-center gap-4">
                    <div class="flex items-center justify-center p-3 rounded-full bg-yellow-100 text-yellow-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-900">2</div>
                        <div class="text-sm text-gray-500">Avg: 9:00 AM</div>
                    </div>
                    <span class="ml-auto text-sm text-gray-400">Rate Arrivals</span>
                </div>
                <!-- Card: Attendance Rate -->
                <div class="card flex items-center gap-4 relative">
                    <div class="relative w-16 h-16">
                        <svg class="w-full h-full transform -rotate-90">
                            <circle class="text-gray-300" stroke-width="6" stroke="currentColor" fill="transparent" r="28" cx="32" cy="32"/>
                            <circle class="text-green-500" stroke-width="6" stroke="currentColor" fill="transparent" r="28" cx="32" cy="32"
                                style="stroke-dasharray: 175.929; stroke-dashoffset: 52.778;"></circle>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-xl font-bold text-gray-900">Attendance Rate</div>
                        <div class="text-sm text-gray-500">Today's rate</div>
                    </div>
                    <span class="absolute top-4 right-4 text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7z"/>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Today's Attendance -->
                <div class="card flex-1">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Today's Attendance</h3>
                            <p class="text-sm text-gray-500">Real-time attendance overview</p>
                        </div>
                        <a href="#" class="text-blue-500 text-sm font-medium">View All</a>
                    </div>
                    <!-- List -->
                    <div class="space-y-4">
                        <!-- List Item 1 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=JL" alt="Jhone Legends" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Jhone Legends</div>
                                    <div class="text-sm text-gray-500">UX Lead | <span class="text-green-500 font-medium">Present</span></div>
                                    <div class="text-xs text-gray-400">In: 08:30 AM | Out: 17:15 PM</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-green-500 font-medium text-sm rounded-full bg-green-100 px-3 py-1">present</span>
                            </div>
                        </div>
                        <!-- List Item 2 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=JL" alt="Jhone Legends" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Jhone Legends</div>
                                    <div class="text-sm text-gray-500">UI Redesign Kal Company Profile | <span class="text-yellow-500 font-medium">In Progress</span></div>
                                    <div class="text-xs text-gray-400">In: 08:30:00 | Out: 17:15:00</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-yellow-500 font-medium text-sm rounded-full bg-yellow-100 px-3 py-1">late</span>
                            </div>
                        </div>
                        <!-- List Item 3 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=JL" alt="Jhone Legends" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Jhone Legends</div>
                                    <div class="text-sm text-gray-500">UI Redesign Kal Company Profile | <span class="text-red-500 font-medium">Pending</span></div>
                                    <div class="text-xs text-gray-400">In: 08:30:00 | Out: 17:15:00</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-gray-500 font-medium text-sm rounded-full bg-gray-100 px-3 py-1">early-leave</span>
                            </div>
                        </div>
                        <!-- List Item 4 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=JL" alt="Jhone Legends" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Jhone Legends</div>
                                    <div class="text-sm text-gray-500">UI Redesign Kal Company Profile | <span class="text-green-500 font-medium">In Progress</span></div>
                                    <div class="text-xs text-gray-400">In: 08:30:00 | Out: 17:15:00</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-green-500 font-medium text-sm rounded-full bg-green-100 px-3 py-1">present</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Attendance -->
                <div class="card flex-1">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">History Attendance</h3>
                            <p class="text-sm text-gray-500">Real-time attendance overview</p>
                        </div>
                        <a href="#" class="text-blue-500 text-sm font-medium">View All</a>
                    </div>
                    <!-- List -->
                    <div class="space-y-4">
                        <!-- List Item 1 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=AD" alt="Adon" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Adon</div>
                                    <div class="text-sm text-gray-500">2025-08-30</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-red-500 font-medium text-sm rounded-full bg-red-100 px-3 py-1">absent</span>
                                <div class="text-xs text-gray-400 mt-1">9h worked</div>
                            </div>
                        </div>
                        <!-- List Item 2 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=EI" alt="Eigato" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Eigato</div>
                                    <div class="text-sm text-gray-500">2025-08-30</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-yellow-500 font-medium text-sm rounded-full bg-yellow-100 px-3 py-1">late</span>
                                <div class="text-xs text-gray-400 mt-1">9h worked</div>
                            </div>
                        </div>
                        <!-- List Item 3 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=LW" alt="Losieto Wilson" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Losieto Wilson</div>
                                    <div class="text-sm text-gray-500">2025-08-30</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-green-500 font-medium text-sm rounded-full bg-green-100 px-3 py-1">present</span>
                                <div class="text-xs text-gray-400 mt-1">9h worked</div>
                            </div>
                        </div>
                        <!-- List Item 4 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=KU" alt="Kuning" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Kuning</div>
                                    <div class="text-sm text-gray-500">2025-08-30</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-green-500 font-medium text-sm rounded-full bg-green-100 px-3 py-1">present</span>
                                <div class="text-xs text-gray-400 mt-1">9h worked</div>
                            </div>
                        </div>
                        <!-- List Item 5 -->
                        <div class="list-item flex items-center">
                            <div class="flex items-start gap-4 flex-grow">
                                <img src="https://placehold.co/48x48/f1f5f9/94a3b8?text=GE" alt="Genjer" class="rounded-full">
                                <div>
                                    <div class="font-medium text-gray-900">Genjer</div>
                                    <div class="text-sm text-gray-500">2025-08-30</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-gray-500 font-medium text-sm rounded-full bg-gray-100 px-3 py-1">early-leave</span>
                                <div class="text-xs text-gray-400 mt-1">9h worked</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
