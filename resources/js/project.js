document.addEventListener('DOMContentLoaded', () => {
    const users = {
        'user1': { name: 'Agus Setiawan', email: 'agus.s@vemos.id' },
        'user2': { name: 'Budi Santoso', email: 'budi.s@vemos.id' },
        'user3': { name: 'Citra Dewi', email: 'citra.d@vemos.id' }
    };

    const projects = {
        'project1': {
            name: 'Mobile App',
            description: 'Pengembangan aplikasi mobile untuk platform Android dan iOS dengan fitur e-commerce lengkap.',
            status: 'In Progress',
            progress: 90,
            category: 'Shopping',
            date: 'Aug 17, 2025',
            members: ['user1', 'user2', 'user3']
        },
        'project2': {
            name: 'Web Dashboard',
            description: 'Perancangan dan implementasi dashboard web untuk analisis data penjualan dan performa bisnis.',
            status: 'Planning',
            progress: 30,
            category: 'Analytics',
            date: 'Aug 17, 2025',
            members: ['user1', 'user2']
        },
        'project3': {
            name: 'Animate Illustration',
            description: 'Pembuatan ilustrasi animasi untuk kampanye pemasaran media sosial dan landing page.',
            status: 'Completed',
            progress: 75,
            category: 'Design',
            date: 'Aug 17, 2025',
            members: ['user3']
        },
        'project4': {
            name: 'Animate Illustration',
            description: 'Pembuatan ilustrasi animasi untuk kampanye pemasaran media sosial dan landing page.',
            status: 'Completed',
            progress: 75,
            category: 'Design',
            date: 'Aug 17, 2025',
            members: ['user3']
        },
    };

    // Get the single tooltip element and its content area
    const tooltip = document.getElementById('user-tooltip');
    const tooltipContent = tooltip.querySelector('.tooltip-content');

    // Get all avatar images with the data-user-id attribute
    const avatarImages = document.querySelectorAll('img[data-user-id]');

    // Get action buttons
    const detailBtns = document.querySelectorAll('.detail-btn');
    const addProjectBtns = document.querySelectorAll('#addProjectBtn');

    // Function to show the tooltip
    function showTooltip(event) {
        const userId = event.target.getAttribute('data-user-id');
        if (!userId || !users[userId]) return;

        const user = users[userId];
        const rect = event.target.getBoundingClientRect();

        // Update tooltip content
        tooltipContent.innerHTML = `
                    <div class="text-sm font-semibold">${user.name}</div>
                    <div class="text-xs text-gray-500">${user.email}</div>
                `;

        // Position the tooltip above the avatar image
        const tooltipHeight = tooltip.offsetHeight;
        tooltip.style.left = `${rect.left + (rect.width / 2)}px`;
        tooltip.style.top = `${rect.top - 10 - tooltipHeight}px`; // Position above the avatar with a small gap

        // Make the tooltip visible
        tooltip.style.display = 'block';
        setTimeout(() => {
            tooltip.style.opacity = '1';
        }, 10);
    }

    // Function to hide the tooltip
    function hideTooltip() {
        tooltip.style.opacity = '0';
        // Wait for the transition to finish before hiding completely
        setTimeout(() => {
            tooltip.style.display = 'none';
        }, 200);
    }

    // Add mouseenter and mouseleave listeners to each avatar image
    avatarImages.forEach(image => {
        image.addEventListener('mouseenter', showTooltip);
        image.addEventListener('mouseleave', hideTooltip);
    });

    // Function to show the side panel
    function showPanel() {
        sidePanel.classList.remove('translate-x-full');
        overlay.classList.remove('hidden', 'opacity-0');
    }

    // Function to hide the side panel
    function hidePanel() {
        sidePanel.classList.add('translate-x-full');
        overlay.classList.add('hidden', 'opacity-0');
    }

    // Function to render project details
    function renderProjectDetail(projectId) {
        const project = projects[projectId];
        if (!project) {
            panelContent.innerHTML = `<div class="text-center text-gray-500">Project not found.</div>`;
            return;
        }

        // Get member avatars HTML
        const membersHtml = project.members.map(memberId => {
            const member = users[memberId];
            if (!member) return '';
            const initials = member.name.split(' ').map(n => n[0]).join('');
            const placeholderColors = {
                'A': '1a73e8',
                'B': 'ea4335',
                'C': 'fbbc05'
            };
            const color = placeholderColors[initials[0]] || '4a90e2';
            return `
                        <div class="flex items-center space-x-2 p-2 bg-gray-100 rounded-lg">
                            <img class="h-8 w-8 rounded-full" src="https://placehold.co/32x32/${color}/ffffff?text=${initials}" alt="${member.name}">
                            <div>
                                <div class="font-medium text-sm">${member.name}</div>
                                <div class="text-xs text-gray-500">${member.email}</div>
                            </div>
                        </div>
                    `;
        }).join('');

        panelContent.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Project Name</p>
                            <h3 class="text-xl font-bold">${project.name}</h3>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Description</p>
                            <p class="text-sm text-gray-700">${project.description}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Category</p>
                                <p class="text-sm text-gray-700">${project.category}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Date</p>
                                <p class="text-sm text-gray-700">${project.date}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Progress</p>
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: ${project.progress}%"></div>
                                </div>
                                <span class="text-xs text-gray-600 ml-2 font-medium">${project.progress}%</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Team Members</p>
                            <div class="space-y-2 mt-2">
                                ${membersHtml}
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-2">
                            <button class="bg-gray-200 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-300">Edit</button>
                            <button class="bg-red-500 px-4 py-2 rounded-lg text-sm font-medium text-white hover:bg-red-600">Delete</button>
                        </div>
                    </div>
                `;
    }

    // Function to render the add project form
    function renderAddProjectForm() {
        panelContent.innerHTML = `
                    <form class="space-y-4">
                        <div>
                            <label for="projectName" class="block text-sm font-medium text-gray-700">Project Name</label>
                            <input type="text" id="projectName" name="projectName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                        </div>
                        <div>
                            <label for="projectDescription" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="projectDescription" name="projectDescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"></textarea>
                        </div>
                        <div>
                            <label for="projectCategory" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="projectCategory" name="projectCategory" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                                <option>Shopping</option>
                                <option>Analytics</option>
                                <option>Design</option>
                            </select>
                        </div>
                        <div>
                            <label for="projectMembers" class="block text-sm font-medium text-gray-700">Team Members</label>
                            <input type="text" id="projectMembers" name="projectMembers" placeholder="e.g., Agus, Budi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" class="bg-gray-200 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-300" id="cancelAddBtn">Cancel</button>
                            <button type="submit" class="bg-blue-500 px-4 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-600">Save Project</button>
                        </div>
                    </form>
                `;
        document.getElementById('cancelAddBtn').addEventListener('click', hidePanel);
    }

    // Event listeners for opening the panel
    detailBtns.forEach(btn => {
        btn.addEventListener('click', (event) => {
            const projectId = event.target.getAttribute('data-project-id');
            panelTitle.textContent = 'Project Details';
            renderProjectDetail(projectId);
            showPanel();
        });
    });

    addProjectBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            panelTitle.textContent = 'Add New Project';
            renderAddProjectForm();
            showPanel();
        });
    });

    // Event listeners for closing the panel
    closePanelBtn.addEventListener('click', hidePanel);
    overlay.addEventListener('click', hidePanel);

});