<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEMOS - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-blue: #4285f4;
            --sidebar-bg: #f8f9fa;
            --card-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f6fa;
        }
        
        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid #e9ecef;
        }
        
        .sidebar .brand {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .sidebar .brand h4 {
            color: var(--primary-blue);
            font-weight: bold;
            margin: 0;
        }
        
        .sidebar .nav-link {
            color: #6c757d;
            padding: 12px 20px;
            border: none;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary-blue);
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .search-bar {
            background: white;
            border-radius: 25px;
            border: 1px solid #e9ecef;
            padding: 10px 20px;
            width: 300px;
        }
        
        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            text-align: center;
            margin-bottom: 20px;
        }
        
        .metric-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .metric-card .label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .metric-card .icon {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        .blue { color: var(--primary-blue); }
        .orange { color: #ff9500; }
        .green { color: #34c759; }
        .red { color: #ff3b30; }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
        }
        
        .user-table {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .user-profile {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            padding: 10px;
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .notification-badge {
            background: #ff3b30;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <h4><i class="fas fa-play-circle"></i> VEMOS</h4>
        </div>
        
        <nav class="nav flex-column">
            <a class="nav-link active" href="#"><i class="fas fa-th-large"></i> Dashboard</a>
            <a class="nav-link" href="#"><i class="fas fa-project-diagram"></i> Project</a>
            <a class="nav-link" href="#"><i class="fas fa-users"></i> Users <i class="fas fa-chevron-down ms-auto"></i></a>
            <a class="nav-link" href="#"><i class="fas fa-chart-bar"></i> Reports <i class="fas fa-chevron-down ms-auto"></i></a>
            <a class="nav-link" href="#">
                <i class="fas fa-calendar-alt"></i> Schedules 
                <span class="notification-badge">1</span>
            </a>
            <a class="nav-link" href="#"><i class="fas fa-history"></i> History</a>
            <a class="nav-link" href="#">
                <i class="fas fa-envelope"></i> Messages 
                <span class="notification-badge">2</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i> Notifications 
                <span class="notification-badge">1</span>
            </a>
            <a class="nav-link" href="#"><i class="fas fa-cog"></i> Settings</a>
            <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
        
        <div class="user-profile">
            <img src="/placeholder.svg?height=40&width=40" alt="User">
            <div>
                <div style="font-weight: 500; font-size: 0.9rem;">Michael Smith</div>
                <div style="color: #6c757d; font-size: 0.8rem;">michaelsmith12@gmail.com</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard</h2>
            <div class="d-flex align-items-center">
                <input type="text" class="search-bar" placeholder="Search for anything...">
                <button class="btn btn-link ms-3"><i class="fas fa-th"></i></button>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="icon blue"><i class="fas fa-tasks"></i></div>
                    <div class="label">Total Task</div>
                    <div class="number blue">124</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="icon orange"><i class="fas fa-spinner fa-spin"></i></div>
                    <div class="label">In Progress</div>
                    <div class="number orange">124</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="icon green"><i class="fas fa-check-circle"></i></div>
                    <div class="label">Complete</div>
                    <div class="number green">124</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="icon red"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="label">Overdue</div>
                    <div class="number red">124</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Donut Chart -->
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="mb-4">Total Entries Today</h5>
                    <div style="position: relative; height: 300px;">
                        <canvas id="donutChart"></canvas>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex flex-wrap gap-3">
                            <div><span style="color: #4285f4;">●</span> Sick</div>
                            <div><span style="color: #ff9500;">●</span> Permission</div>
                            <div><span style="color: #ff3b30;">●</span> Not Present</div>
                            <div><span style="color: #34c759;">●</span> Present</div>
                            <div><span style="color: #ff9500;">●</span> Office</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Status Table -->
            <div class="col-md-6">
                <div class="user-table">
                    <h5 class="mb-4">List User Status</h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr style="color: #6c757d; font-size: 0.9rem;">
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Jenis Izin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Andi</td>
                                <td>Staff IT</td>
                                <td>Izin Sakit</td>
                                <td><span class="status-badge status-pending">pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bar Charts -->
        <div class="row">
            <div class="col-md-4">
                <div class="chart-container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6>Jumlah Posisi</h6>
                        <small class="text-muted">this months ▼</small>
                    </div>
                    <canvas id="positionChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Donut Chart
        const donutCtx = document.getElementById('donutChart').getContext('2d');
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sick', 'Permission', 'Not Present', 'Present', 'Office'],
                datasets: [{
                    data: [20, 25, 30, 15, 10],
                    backgroundColor: ['#4285f4', '#ff9500', '#ff3b30', '#34c759', '#ff9500'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Bar Charts Data
        const barData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [190, 175, 145, 112, 98, 86],
                backgroundColor: '#6c5ce7',
                borderRadius: 4
            }]
        };

        const barOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 400,
                    ticks: {
                        stepSize: 100
                    }
                }
            }
        };

        // Vendor Chart
        const vendorCtx = document.getElementById('vendorChart').getContext('2d');
        new Chart(vendorCtx, {
            type: 'bar',
            data: barData,
            options: barOptions
        });

        // Position Chart
        const positionCtx = document.getElementById('positionChart').getContext('2d');
        new Chart(positionCtx, {
            type: 'bar',
            data: barData,
            options: barOptions
        });

        // Unit Chart
        const unitCtx = document.getElementById('unitChart').getContext('2d');
        new Chart(unitCtx, {
            type: 'bar',
            data: barData,
            options: barOptions
        });
    </script>
</body>
</html>
