document.addEventListener('DOMContentLoaded', () => {
                // Sidebar toggle functionality
                const sidebar = document.getElementById('sidebar');
                const toggleButton = document.getElementById('sidebar-toggle');
                if (toggleButton) {
                    toggleButton.addEventListener('click', () => {
                        sidebar.classList.toggle('-translate-x-full');
                    });
                }

                // Placeholder data for charts and tables
                const data = {
                    checkin: {
                        day: [
                            {label: "Tepat Waktu", value: 40},
                            {label: "Terlambat", value: 5},
                            {label: "Izin", value: 2},
                            {label: "Tidak Masuk", value: 1}
                        ],
                        week: [
                            {label: "Tepat Waktu", value: 200},
                            {label: "Terlambat", value: 25},
                            {label: "Izin", value: 10},
                            {label: "Tidak Masuk", value: 5}
                        ],
                        month: [
                            {label: "Tepat Waktu", value: 800},
                            {label: "Terlambat", value: 100},
                            {label: "Izin", value: 40},
                            {label: "Tidak Masuk", value: 20}
                        ],
                        year: [
                            {label: "Tepat Waktu", value: 9600},
                            {label: "Terlambat", value: 1200},
                            {label: "Izin", value: 480},
                            {label: "Tidak Masuk", value: 240}
                        ]
                    },
                    vendors: {
                        day: [
                            {label: "Vendor A", value: 5},
                            {label: "Vendor B", value: 3},
                            {label: "Vendor C", value: 2},
                            {label: "Vendor D", value: 4}
                        ],
                        week: [
                            {label: "Vendor A", value: 25},
                            {label: "Vendor B", value: 15},
                            {label: "Vendor C", value: 10},
                            {label: "Vendor D", value: 20}
                        ],
                        month: [
                            {label: "Vendor A", value: 100},
                            {label: "Vendor B", value: 60},
                            {label: "Vendor C", value: 40},
                            {label: "Vendor D", value: 80}
                        ],
                        year: [
                            {label: "Vendor A", value: 1200},
                            {label: "Vendor B", value: 720},
                            {label: "Vendor C", value: 480},
                            {label: "Vendor D", value: 960}
                        ]
                    },
                    positions: {
                        day: [
                            {label: "Manager", value: 10},
                            {label: "Staff", value: 30},
                            {label: "Intern", value: 5},
                            {label: "Supervisor", value: 8}
                        ],
                        week: [
                            {label: "Manager", value: 50},
                            {label: "Staff", value: 150},
                            {label: "Intern", value: 25},
                            {label: "Supervisor", value: 40}
                        ],
                        month: [
                            {label: "Manager", value: 200},
                            {label: "Staff", value: 600},
                            {label: "Intern", value: 100},
                            {label: "Supervisor", value: 160}
                        ],
                        year: [
                            {label: "Manager", value: 2400},
                            {label: "Staff", value: 7200},
                            {label: "Intern", value: 1200},
                            {label: "Supervisor", value: 1920}
                        ]
                    },
                    units: {
                        day: [
                            {label: "Unit Keuangan", value: 15},
                            {label: "Unit Marketing", value: 20},
                            {label: "Unit HRD", value: 10},
                            {label: "Unit Produksi", value: 25}
                        ],
                        week: [
                            {label: "Unit Keuangan", value: 75},
                            {label: "Unit Marketing", value: 100},
                            {label: "Unit HRD", value: 50},
                            {label: "Unit Produksi", value: 125}
                        ],
                        month: [
                            {label: "Unit Keuangan", value: 300},
                            {label: "Unit Marketing", value: 400},
                            {label: "Unit HRD", value: 200},
                            {label: "Unit Produksi", value: 500}
                        ],
                        year: [
                            {label: "Unit Keuangan", value: 3600},
                            {label: "Unit Marketing", value: 4800},
                            {label: "Unit HRD", value: 2400},
                            {label: "Unit Produksi", value: 6000}
                        ]
                    },
                    leave: {
                        day: [
                            {name: "Andi", position: "Staff IT", type: "Izin Sakit", status: "Disetujui"},
                            {name: "Budi", position: "Manager", type: "Izin Cuti", status: "Menunggu"}
                        ],
                        week: [
                            {name: "Andi", position: "Staff IT", type: "Izin Sakit", status: "Disetujui"},
                            {name: "Budi", position: "Manager", type: "Izin Cuti", status: "Menunggu"},
                            {name: "Cici", position: "Staff Keuangan", type: "Izin Cuti", status: "Disetujui"}
                        ],
                        month: [
                            {name: "Andi", position: "Staff IT", type: "Izin Sakit", status: "Disetujui"},
                            {name: "Budi", position: "Manager", type: "Izin Cuti", status: "Menunggu"},
                            {name: "Cici", position: "Staff Keuangan", type: "Izin Cuti", status: "Disetujui"},
                            {name: "Dedi", position: "Staff HRD", type: "Izin Sakit", status: "Disetujui"}
                        ],
                        year: [
                            {name: "Andi", position: "Staff IT", type: "Izin Sakit", status: "Disetujui"},
                            {name: "Budi", position: "Manager", type: "Izin Cuti", status: "Menunggu"},
                            {name: "Cici", position: "Staff Keuangan", type: "Izin Cuti", status: "Disetujui"},
                            {name: "Dedi", position: "Staff HRD", type: "Izin Sakit", status: "Disetujui"},
                            {name: "Evi", position: "Manager", type: "Izin Cuti", status: "Disetujui"}
                        ]
                    }
                };

                // Define a consistent color palette for charts
                const chartColors = ['#004A9F', '#FBBF24', '#4CAF50', '#EF4444', '#9F7AEA', '#4299E1', '#ED8936', '#68D391'];

                // Get canvas elements for charts
                const checkinCanvas = document.getElementById('checkin-chart').getContext('2d');
                const vendorCanvas = document.getElementById('vendor-chart').getContext('2d');
                const positionCanvas = document.getElementById('position-chart').getContext('2d');
                const unitCanvas = document.getElementById('unit-chart').getContext('2d');

                // Function to update the percentage text inside the donut chart
                function updateDonutPercentage(chart) {
                    const total = chart.data.datasets[0].data.reduce((sum, value) => sum + value, 0);
                    const percentageDiv = document.getElementById('checkin-percentage').querySelector('span');
                    percentageDiv.textContent = `${total} %`;
                }

                // Function to create the data list next to the donut chart
                function updateCheckinDataList(filter) {
                    const listContainer = document.getElementById('checkin-data-list');
                    const filteredData = data.checkin[filter];
                    listContainer.innerHTML = ''; // Clear previous content

                    const total = filteredData.reduce((sum, item) => sum + item.value, 0);

                    // Create list items
                    filteredData.forEach((item, index) => {
                        const percentage = total > 0 ? ((item.value / total) * 100).toFixed(0) : 0;
                        const listItem = document.createElement('div');
                        listItem.className = 'flex items-center space-x-3 mb-2';
                        listItem.innerHTML = `
                            <div class="h-4 w-4 rounded-full" style="background-color: ${chartColors[index]};"></div>
                            <div class="flex-grow text-sm text-gray-700">${item.label}</div>
                            <div class="text-sm font-semibold">${percentage}%</div>
                        `;
                        listContainer.appendChild(listItem);
                    });
                }


                // Initialize Donut Chart
                const checkinChart = new Chart(checkinCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: data.checkin.day.map(item => item.label),
                        datasets: [{
                            data: data.checkin.day.map(item => item.value),
                            backgroundColor: chartColors.slice(0, 4),
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%', // Make it a donut chart
                        plugins: {
                            legend: {
                                display: false // Hide default legend
                            },
                            tooltip: {
                                // Custom tooltip for clear display
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let label = tooltipItem.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        const total = tooltipItem.dataset.data.reduce((sum, value) => sum + value, 0);
                                        const percentage = (tooltipItem.raw / total * 100).toFixed(0);
                                        label += `${tooltipItem.raw} (${percentage}%)`;
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });

                // Function to create a bar chart
                function createBarChart(canvas, chartData, title) {
                    return new Chart(canvas, {
                        type: 'bar',
                        data: {
                            labels: chartData.map(item => item.label),
                            datasets: [{
                                label: title,
                                data: chartData.map(item => item.value),
                                backgroundColor: chartData.map((_, i) => chartColors[i % chartColors.length]),
                                borderColor: chartData.map((_, i) => chartColors[i % chartColors.length]),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return `${tooltipItem.raw}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        // Rotate labels for better readability
                                        maxRotation: 45,
                                        minRotation: 45,
                                        autoSkip: false
                                    }
                                }
                            }
                        }
                    });
                }

                // Initialize Bar Charts with default data
                const vendorChart = createBarChart(vendorCanvas, data.vendors.month, 'Jumlah Vendor');
                const positionChart = createBarChart(positionCanvas, data.positions.month, 'Jumlah Posisi');
                const unitChart = createBarChart(unitCanvas, data.units.month, 'Jumlah Unit');

                // Function to update the leave notification table
                function updateLeaveTable(filter) {
                    const tableBody = document.getElementById('leave-list-body');
                    const leaveData = data.leave[filter];
                    tableBody.innerHTML = '';

                    if (leaveData.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="4" class="text-center text-gray-500 py-4">Tidak ada data izin.</td></tr>';
                        return;
                    }

                    leaveData.forEach(item => {
                        const row = document.createElement('tr');
                        const statusColor = item.status === 'Disetujui' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                        row.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap">${item.name}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${item.position}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${item.type}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusColor}">
                                    ${item.status}
                                </span>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
                
                // Function to handle chart updates from dropdowns
                function setupDropdownFilter(dropdownId, chart, dataKey) {
                    const dropdown = document.getElementById(dropdownId);
                    dropdown.addEventListener('change', (e) => {
                        const filter = e.target.value;
                        const newData = data[dataKey][filter];

                        // Update chart data
                        chart.data.labels = newData.map(item => item.label);
                        chart.data.datasets[0].data = newData.map(item => item.value);
                        
                        // For bar charts, re-assign colors in case the number of bars changes
                        if (chart.config.type === 'bar') {
                             chart.data.datasets[0].backgroundColor = newData.map((_, i) => chartColors[i % chartColors.length]);
                             chart.data.datasets[0].borderColor = newData.map((_, i) => chartColors[i % chartColors.length]);
                        }
                        
                        chart.update();
                    });
                }

                // Event listeners for the filter buttons
                document.getElementById('checkin-filter-buttons').addEventListener('click', (e) => {
                    const button = e.target.closest('.filter-button');
                    if (!button) return;

                    document.getElementById('checkin-filter-buttons').querySelectorAll('.filter-button').forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const filter = button.dataset.filter;
                    const newData = data.checkin[filter];

                    checkinChart.data.labels = newData.map(item => item.label);
                    checkinChart.data.datasets[0].data = newData.map(item => item.value);
                    
                    checkinChart.update();
                    updateDonutPercentage(checkinChart);
                    updateCheckinDataList(filter);
                });

                // Event listeners for the leave table filter
                document.getElementById('leave-filter-buttons').addEventListener('click', (e) => {
                    const button = e.target.closest('.filter-button');
                    if (!button) return;

                    document.getElementById('leave-filter-buttons').querySelectorAll('.filter-button').forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const filter = button.dataset.filter;
                    updateLeaveTable(filter);
                });
                
                // Initialize dropdown filters
                setupDropdownFilter('vendor-filter', vendorChart, 'vendors');
                setupDropdownFilter('position-filter', positionChart, 'positions');
                setupDropdownFilter('unit-filter', unitChart, 'units');

                // Function to initialize all tables and charts
                function initialize() {
                     updateLeaveTable('week');
                     updateDonutPercentage(checkinChart);
                     updateCheckinDataList('day');
                }

                // Initial load
                initialize();
            });