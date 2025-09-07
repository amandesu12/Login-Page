|

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEMOS Admin Dashboard</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/css/project.css', 'resources/js/app.js', 'resources/js/project.js'])
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-60 bg-white shadow-lg flex flex-col justify-between fixed h-screen z-20">
        <div class="p-4">
            <div class="text-2xl font-bold text-gray-800 mb-8">VEMOS</div>
            <nav>
                <ul>
                    <li class="mb-1">
                        <a href="#" class="flex items-center px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 text-sm">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center px-3 py-1.5 rounded-md bg-blue-500 text-white font-semibold shadow-md text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2H7a2 2 0 00-2 2v2m14 0a2 2 0 00-2-2H7a2 2 0 00-2 2"></path></svg>
                            Project
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 text-sm">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6a2 2 0 002-2v-3a2 2 0 00-2-2H7a2 2 0 00-2 2v3a2 2 0 002 2z"></path></svg>
                            Users
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center justify-between px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002-2v-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 002 2m-6 0h6"></path></svg>
                                Reports
                            </div>
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">3</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center justify-between px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Messages
                            </div>
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">3</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center justify-between px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 5.722 6.5 7.965 6.5 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a2 2 0 11-4 0m4 0v1a3 3 0 01-3 3H5a3 3 0 01-3-3v-6a3 3 0 013-3h3a3 3 0 013 3v1"></path></svg>
                                Notifications
                            </div>
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">2</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="flex items-center px-3 py-1.5 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 text-sm">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296-.07 2.572-1.065z"></path></svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="p-4">
            <div class="border-t border-gray-200 my-4"></div>
            <div class="flex items-center">
                <img src="https://placehold.co/24x24/4a90e2/ffffff?text=MS" alt="Michael Smith" class="rounded-full mr-2 border-2 border-white shadow">
                <div>
                    <div class="font-semibold text-gray-800 text-sm leading-tight">Michael Smith</div>
                    <div class="text-xs text-gray-500 leading-tight">michaelsmith@gmail.com</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 ml-60">
        <!-- Header -->
        <header class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold text-gray-800">Project</h1>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search for anything..." class="pl-8 pr-3 py-1.5 text-sm rounded-lg border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    <svg class="absolute left-2.5 top-1/2 transform -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </header>

        <!-- Project Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">

            <!-- Project Card 1 -->
            <div class="bg-white rounded-xl shadow-lg p-3">
                <div class="flex justify-between items-center mb-2 text-xs text-gray-500">
                    <span class="font-medium">Aug 17, 2025</span>
                    <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-1.5 py-0.5 rounded-full">Shopping</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-0.5">Mobile App</h3>
                <p class="text-xs text-gray-600 mb-3">Shopping</p>

                <div class="flex items-center mb-3">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 90%"></div>
                    </div>
                    <span class="text-xs text-gray-600 ml-2 font-medium">90%</span>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex -space-x-1.5 overflow-hidden">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/1a73e8/ffffff?text=A1" alt="avatar" data-user-id="user1">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/ea4335/ffffff?text=A2" alt="avatar" data-user-id="user2">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/fbbc05/ffffff?text=A3" alt="avatar" data-user-id="user3">
                    </div>
                    <div class="flex space-x-1.5">
                        <button class="bg-blue-500 p-1 rounded-full text-white shadow-md hover:bg-blue-600 transition-colors duration-200" id="addProjectBtn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </button>
                        <button class="bg-gray-200 px-2.5 py-1 rounded-full text-xs text-gray-700 font-medium hover:bg-gray-300 transition-colors duration-200 detail-btn" data-project-id="project1">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Project Card 2 -->
            <div class="bg-white rounded-xl shadow-lg p-3">
                <div class="flex justify-between items-center mb-2 text-xs text-gray-500">
                    <span class="font-medium">Aug 17, 2025</span>
                    <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-1.5 py-0.5 rounded-full">Shopping</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-0.5">Web Dashboard</h3>
                <p class="text-xs text-gray-600 mb-3">Shopping</p>

                <div class="flex items-center mb-3">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                    <span class="text-xs text-gray-600 ml-2 font-medium">30%</span>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex -space-x-1.5 overflow-hidden">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/1a73e8/ffffff?text=A1" alt="avatar" data-user-id="user1">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/ea4335/ffffff?text=A2" alt="avatar" data-user-id="user2">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/fbbc05/ffffff?text=A3" alt="avatar" data-user-id="user3">
                    </div>
                    <div class="flex space-x-1.5">
                        <button class="bg-blue-500 p-1 rounded-full text-white shadow-md hover:bg-blue-600 transition-colors duration-200" id="addProjectBtn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </button>
                        <button class="bg-gray-200 px-2.5 py-1 rounded-full text-xs text-gray-700 font-medium hover:bg-gray-300 transition-colors duration-200 detail-btn" data-project-id="project2">
                            Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Project Card 3 -->
            <div class="bg-white rounded-xl shadow-lg p-3">
                <div class="flex justify-between items-center mb-2 text-xs text-gray-500">
                    <span class="font-medium">Aug 17, 2025</span>
                    <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-1.5 py-0.5 rounded-full">Shopping</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-0.5">Animate Illustration</h3>
                <p class="text-xs text-gray-600 mb-3">Shopping</p>

                <div class="flex items-center mb-3">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                    <span class="text-xs text-gray-600 ml-2 font-medium">75%</span>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex -space-x-1.5 overflow-hidden">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/1a73e8/ffffff?text=A1" alt="avatar" data-user-id="user1">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/ea4335/ffffff?text=A2" alt="avatar" data-user-id="user2">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/fbbc05/ffffff?text=A3" alt="avatar" data-user-id="user3">
                    </div>
                    <div class="flex space-x-1.5">
                        <button class="bg-blue-500 p-1 rounded-full text-white shadow-md hover:bg-blue-600 transition-colors duration-200" id="addProjectBtn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </button>
                        <button class="bg-gray-200 px-2.5 py-1 rounded-full text-xs text-gray-700 font-medium hover:bg-gray-300 transition-colors duration-200 detail-btn" data-project-id="project3">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Project Card 4 -->
            <div class="bg-white rounded-xl shadow-lg p-3">
                <div class="flex justify-between items-center mb-2 text-xs text-gray-500">
                    <span class="font-medium">Aug 17, 2025</span>
                    <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-1.5 py-0.5 rounded-full">Shopping</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-0.5">Animate Illustration</h3>
                <p class="text-xs text-gray-600 mb-3">Shopping</p>

                <div class="flex items-center mb-3">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                    <span class="text-xs text-gray-600 ml-2 font-medium">75%</span>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex -space-x-1.5 overflow-hidden">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/1a73e8/ffffff?text=A1" alt="avatar" data-user-id="user1">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/ea4335/ffffff?text=A2" alt="avatar" data-user-id="user2">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white cursor-pointer" src="https://placehold.co/24x24/fbbc05/ffffff?text=A3" alt="avatar" data-user-id="user3">
                    </div>
                    <div class="flex space-x-1.5">
                        <button class="bg-blue-500 p-1 rounded-full text-white shadow-md hover:bg-blue-600 transition-colors duration-200" id="addProjectBtn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </button>
                        <button class="bg-gray-200 px-2.5 py-1 rounded-full text-xs text-gray-700 font-medium hover:bg-gray-300 transition-colors duration-200 detail-btn" data-project-id="project4">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Single tooltip element that will be moved and updated -->
    <div id="user-tooltip" class="tooltip">
        <div class="tooltip-content"></div>
        <div class="tooltip-arrow"></div>
    </div>


</body>
</html>