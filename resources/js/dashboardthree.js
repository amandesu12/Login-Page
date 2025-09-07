// Data for donut chart
const entriesData = {
    labels: ['Sakit', 'Izin', 'Tidak Hadir', 'Hadir', 'Kantor'],
    datasets: [{
        data: [5, 10, 15, 65, 5],
        backgroundColor: ['#ef4444', '#f97316', '#22c55e', '#3b82f6', '#fde047'],
        hoverOffset: 4
    }]
};

// Configuration for donut chart
const entriesConfig = {
    type: 'doughnut',
    data: entriesData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed !== null) {
                            label += context.parsed + '%';
                        }
                        return label;
                    }
                }
            }
        }
    }
};

// Render donut chart
const entriesChart = new Chart(
    document.getElementById('entriesChart'),
    entriesConfig
);

// Data for bar chart
const unitData = {
    labels: ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
    datasets: [{
        label: 'Unit',
        data: [19900, 17250, 14650, 11230, 8890, 8600],
        backgroundColor: '#93c5fd',
        borderColor: '#60a5fa',
        borderWidth: 1,
        borderRadius: 5,
        barThickness: 30,
    }]
};

// Configuration for bar chart
const unitConfig = {
    type: 'bar',
    data: unitData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += context.parsed.y.toLocaleString();
                        }
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Render bar chart
const unitChart = new Chart(
    document.getElementById('unitChart'),
    unitConfig
);