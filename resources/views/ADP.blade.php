<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | VEMOS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e71f1;
            --secondary-color: #f0f4f9;
            --text-color: #4b5563;
            --bg-color: #ffffff;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --info-color: #3b82f6;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --purple-color: #8b5cf6;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 1.5rem;
            box-sizing: border-box;
            overflow: hidden;
        }

        .main-content {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            overflow: hidden;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
            flex-shrink: 0;
        }

        .search-bar {
            flex-grow: 1;
            display: flex;
            align-items: center;
            background-color: var(--bg-color);
            border-radius: 0.75rem;
            padding: 0.5rem 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .search-bar i {
            color: #9ca3af;
            margin-right: 0.5rem;
        }

        .search-bar input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 0.9rem;
        }

        .header .grid-view {
            display: flex;
            gap: 0.5rem;
        }

        .header .grid-view button {
            background-color: var(--bg-color);
            border: none;
            padding: 0.5rem;
            border-radius: 0.75rem;
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .header .grid-view button:hover {
            background-color: var(--primary-color);
            color: var(--bg-color);
        }

        .content-card {
            background-color: var(--bg-color);
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .profile-header .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-header .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-header .user-info .details h3 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .profile-header .user-info .details p {
            margin: 0.15rem 0;
            font-size: 0.8rem;
            color: #6b7280;
        }

        .profile-header .user-info .details .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--success-color);
            background-color: rgba(16, 185, 129, 0.1);
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
            flex-shrink: 0;
        }

        .stat-card {
            background-color: var(--secondary-color);
            padding: 1rem;
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .stat-card h4 {
            margin: 0;
            font-size: 0.8rem;
            color: #6b7280;
        }

        .stat-card .value {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 0.25rem;
        }

        .stat-card .value small {
            font-size: 0.7rem;
            font-weight: 400;
            color: #9ca3af;
        }

        .stat-card .progress-bar {
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 9999px;
            margin-top: 0.75rem;
        }

        .stat-card .progress-bar-fill {
            height: 100%;
            border-radius: 9999px;
            background-color: var(--primary-color);
            transition: width 0.5s ease-in-out;
        }

        .stat-card .icon-check {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            color: var(--success-color);
            font-size: 1rem;
        }

        .stat-card.progress-card .value {
            font-size: 1.25rem;
        }

        .stat-card.progress-card .progress-bar {
            height: 10px;
            margin-top: 0.5rem;
        }

        .stat-card.progress-card .progress-bar-fill {
            background-color: var(--info-color);
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1rem;
            flex-shrink: 0;
        }

        .tabs button {
            background: none;
            border: none;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #6b7280;
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
        }

        .tabs button.active {
            color: var(--primary-color);
        }

        .tabs button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }

        .tab-content {
            display: none;
            flex-direction: column;
            flex-grow: 1;
            overflow: hidden;
        }

        .tab-content.active {
            display: flex;
        }
        
        .activity-list, .task-list {
            flex-grow: 1;
            /* Added for scroll functionality */
            overflow-y: auto;
            max-height: 400px; /* Adjust as needed */
        }

        .activity-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background-color: var(--secondary-color);
            border-radius: 1rem;
            margin-bottom: 0.75rem;
        }

        .activity-item .left-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .activity-item .icon {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .activity-item .icon.blue { background-color: var(--info-color); }
        .activity-item .icon.green { background-color: var(--success-color); }
        .activity-item .icon.red { background-color: var(--danger-color); }
        .activity-item .icon.purple { background-color: var(--purple-color); }
        .activity-item .icon.yellow { background-color: var(--warning-color); }
        

        .activity-item .details, .task-item-list .details {
            line-height: 1.4;
        }

        .activity-item .details p, .task-item-list .details p {
            margin: 0;
            font-size: 0.9rem;
        }
        
        .task-item-list {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem;
            background-color: var(--secondary-color);
            border-radius: 1rem;
            margin-bottom: 0.75rem;
        }
        
        .task-item-list .details h5 {
            margin: 0 0 0.25rem 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .activity-item .details small, .task-item-list .details small {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .task-item-list .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .task-item-list .status-badge.selesai {
            color: var(--success-color);
            background-color: rgba(16, 185, 129, 0.1);
        }

        .task-item-list .status-badge.on-progress {
            color: var(--info-color);
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .task-item-list .status-badge.belum-selesai {
            color: var(--danger-color);
            background-color: rgba(239, 68, 68, 0.1);
        }
        
        .task-item-list .task-icon {
            color: var(--success-color);
            font-size: 1.25rem;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }
        
        .task-item-list .task-title-group {
            display: flex;
            align-items: center;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
            flex-grow: 1;
            overflow: hidden;
        }
        
        .profile-main-container, .right-panel {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .performance-card {
            background-color: var(--secondary-color);
            border-radius: 1rem;
            padding: 1rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .performance-card h4 {
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
            flex-shrink: 0;
        }

        .performance-stats {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .performance-stat-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .performance-stat-item .label {
            width: 100px;
            font-size: 0.85rem;
            color: #4b5563;
        }

        .performance-stat-item .value {
            font-weight: 600;
        }

        .performance-stat-item .progress-bar-container {
            flex-grow: 1;
        }

        .performance-stat-item .progress-bar-fill {
            background-color: var(--primary-color);
        }
        
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                overflow-y: auto;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }
            
            .header {
                flex-direction: column;
                align-items: stretch;
            }
        }
        
        .tooltip {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            z-index: 20;
            white-space: nowrap;
        }
        
        .chart-container {
            position: relative;
        }

        .chart-container .chart-bar {
            position: relative;
            height: 12px;
            background-color: #e5e7eb;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .chart-container .chart-bar:hover {
            transform: scaleY(1.1);
        }

        .chart-container .chart-bar .fill {
            height: 100%;
            border-radius: 9999px;
            background-color: var(--primary-color);
            transition: width 0.5s ease-in-out;
        }

    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h2>Presensi</h2>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search for anything...">
                </div>
                <div class="grid-view">
                    <button><i class="fas fa-th-large"></i></button>
                    <button><i class="fas fa-list"></i></button>
                </div>
            </header>

            <div class="dashboard-grid">
                <div class="profile-main-container">
                    <div class="content-card">
                        <div class="profile-header">
                            <div class="user-info">
                                <img src="https://placehold.co/60x60/2e71f1/ffffff?text=SD" alt="User Avatar">
                                <div class="details">
                                    <h3>Sari Dewi</h3>
                                    <p>sari.dewi@company.com</p>
                                    <p class="badge">UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="profile-meta">
                                <p>Tanggal Bergabung</p>
                                <p><strong>20 Agustus 2022</strong></p>
                                <p>Status: <span class="badge" style="color: var(--success-color); background-color: rgba(16, 185, 129, 0.1);">Aktif</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="content-card">
                        <div class="tabs">
                            <button class="tab-button active" data-tab="overview">Overview</button>
                            <button class="tab-button" data-tab="tugas">Tugas</button>
                            <button class="tab-button" data-tab="aktivitas">Aktivitas</button>
                        </div>
                        
                        <div id="overview" class="tab-content active">
                            <h4>Aktivitas Terbaru</h4>
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon blue"></div>
                                        <div class="details">
                                            <p>Menyelesaikan task "API Integration"</p>
                                            <small>2 jam yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon green"></div>
                                        <div class="details">
                                            <p>Memulai task "Database Optimization"</p>
                                            <small>2 jam yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon blue"></div>
                                        <div class="details">
                                            <p>Update progress task "UI Redesign"</p>
                                            <small>2 jam yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon purple"></div>
                                        <div class="details">
                                            <p>Menambahkan komentar pada "Bug Report #45"</p>
                                            <small>3 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon yellow"></div>
                                        <div class="details">
                                            <p>Memperbarui profil</p>
                                            <small>4 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="tugas" class="tab-content">
                            <h4>Daftar Tugas</h4>
                            <div class="task-list">
                                <div class="task-item-list">
                                    <div class="task-title-group">
                                        <i class="fas fa-check-circle task-icon"></i>
                                        <div class="details">
                                            <h5>API Integration</h5>
                                            <small>Selesai • 2 jam yang lalu</small>
                                        </div>
                                    </div>
                                    <span class="status-badge selesai">Selesai</span>
                                </div>
                                <div class="task-item-list">
                                    <div class="task-title-group">
                                        <i class="fas fa-spinner task-icon" style="color: var(--info-color);"></i>
                                        <div class="details">
                                            <h5>Database Optimization</h5>
                                            <small>Dalam Progress • 60% Selesai</small>
                                        </div>
                                    </div>
                                    <span class="status-badge on-progress">Aktif</span>
                                </div>
                            </div>
                        </div>
                        
                        <div id="aktivitas" class="tab-content">
                            <h4>Log Aktivitas</h4>
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon green"></div>
                                        <div class="details">
                                            <p>Login pada pukul 08:00</p>
                                            <small>Hari ini</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon red"></div>
                                        <div class="details">
                                            <p>Logout pada pukul 17:30</p>
                                            <small>Kemarin</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon blue"></div>
                                        <div class="details">
                                            <p>Menyelesaikan tugas "UI Redesign"</p>
                                            <small>Kemarin</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon green"></div>
                                        <div class="details">
                                            <p>Login pada pukul 08:15</p>
                                            <small>2 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon purple"></div>
                                        <div class="details">
                                            <p>Menambahkan komentar pada "Bug Report #45"</p>
                                            <small>3 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon yellow"></div>
                                        <div class="details">
                                            <p>Memperbarui profil</p>
                                            <small>4 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tambahan item untuk demo scroll -->
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon blue"></div>
                                        <div class="details">
                                            <p>Menyelesaikan tugas "Fix responsive layout"</p>
                                            <small>5 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon green"></div>
                                        <div class="details">
                                            <p>Memulai task "Implement Dark Mode"</p>
                                            <small>5 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="left-group">
                                        <div class="icon red"></div>
                                        <div class="details">
                                            <p>Menambahkan dependensi baru ke proyek</p>
                                            <small>6 hari yang lalu</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-panel">
                    <div class="content-card profile-stats">
                        <div class="stat-card">
                            <h4>Total Jam Kerja</h4>
                            <div class="value">1252<small>Jam</small></div>
                            <p class="mt-2">120 jam minggu ini</p>
                            <i class="fas fa-check-circle icon-check"></i>
                        </div>
                        <div class="stat-card">
                            <h4>Tugas Selesai</h4>
                            <div class="value">50</div>
                            <p class="mt-2">12 bulan ini</p>
                            <i class="fas fa-check-circle icon-check"></i>
                        </div>
                        <div class="stat-card progress-card">
                            <h4>Tugas Aktif</h4>
                            <div class="value">5</div>
                            <p>Sedang Dikerjakan</p>
                        </div>
                        <div class="stat-card progress-card">
                            <h4>Progress</h4>
                            <div class="value">70%</div>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" style="width: 70%;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="content-card performance-card">
                        <h4>Performa Mingguan</h4>
                        <div class="performance-stats">
                            <div class="performance-stat-item">
                                <span class="label">Jam Kerja</span>
                                <div class="progress-bar-container chart-container">
                                    <div class="chart-bar" data-value="30/40" data-label="Jam Kerja">
                                        <div class="fill" style="width: 75%;"></div>
                                    </div>
                                </div>
                                <span class="value">30/40</span>
                            </div>
                            <div class="performance-stat-item">
                                <span class="label">Tugas Selesai</span>
                                <div class="progress-bar-container chart-container">
                                    <div class="chart-bar" data-value="5" data-label="Tugas Selesai">
                                        <div class="fill" style="width: 100%;"></div>
                                    </div>
                                </div>
                                <span class="value">5 Tugas</span>
                            </div>
                            <div class="performance-stat-item">
                                <span class="label">Efisiensi</span>
                                <div class="progress-bar-container chart-container">
                                    <div class="chart-bar" data-value="Baik" data-label="Efisiensi">
                                        <div class="fill" style="width: 80%;"></div>
                                    </div>
                                </div>
                                <span class="value">Baik</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Task Management Card (previously here, now removed as content is in tab) -->
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    this.classList.add('active');
                    const targetTab = this.getAttribute('data-tab');
                    document.getElementById(targetTab).classList.add('active');
                });
            });

            // Chart Tooltip functionality
            const chartBars = document.querySelectorAll('.chart-bar');
            const body = document.body;
            let tooltip = null;

            chartBars.forEach(bar => {
                bar.addEventListener('mouseenter', function(e) {
                    if (!tooltip) {
                        tooltip = document.createElement('div');
                        tooltip.classList.add('tooltip');
                        body.appendChild(tooltip);
                    }
                    const value = this.getAttribute('data-value');
                    const label = this.getAttribute('data-label');
                    tooltip.textContent = `${label}: ${value}`;
                    
                    const rect = this.getBoundingClientRect();
                    tooltip.style.left = `${rect.left + window.scrollX + (rect.width / 2)}px`;
                    tooltip.style.top = `${rect.top + window.scrollY - 40}px`;
                    tooltip.style.opacity = '1';
                });

                bar.addEventListener('mousemove', function(e) {
                    if (tooltip) {
                        tooltip.style.left = `${e.pageX + 15}px`;
                        tooltip.style.top = `${e.pageY - 35}px`;
                    }
                });

                bar.addEventListener('mouseleave', function() {
                    if (tooltip) {
                        tooltip.style.opacity = '0';
                    }
                });
            });
        });
    </script>
</body>
</html>
