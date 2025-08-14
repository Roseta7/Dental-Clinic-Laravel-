// Doughnut Chart

const visitLabels = Object.keys(visitTypeStats);
const visitValues = Object.values(visitTypeStats);

new Chart(document.getElementById('patientsChart'), {
    type: 'doughnut',
    data: {
        labels: visitLabels,
        datasets: [{
            data: visitValues,
            backgroundColor: ['#f7b6b2', '#ffe680', '#b2f0e3', '#c6d8f2', '#d3b2f0'],
            hoverOffset: 4,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: { legend: { display: false } }
    }
});

// Bar Chart

const treatmentLabels = Object.keys(treatmentPercentages);
const treatmentValues = Object.values(treatmentPercentages);

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: treatmentLabels,
        datasets: [{
            data: treatmentValues,
            backgroundColor: ['#f7b6b2', '#ffe680', '#b2f0e3', '#c6d8f2', '#e0ccff'],
            barThickness: 16,
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        scales: {
            x: { beginAtZero: true, max: 100, grid: { display: false }, ticks: { color: '#888' } },
            y: { grid: { display: false }, ticks: { color: '#ccc', font: { size: 14 } } }
        },
        plugins: {
            legend: { display: false },
            tooltip: { backgroundColor: '#333', titleColor: '#fff', bodyColor: '#fff', callbacks: { label: ctx => `${ctx.parsed.x}%` } }
        }
    }
});