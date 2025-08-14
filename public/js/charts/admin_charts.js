document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('myChart').getContext('2d');

        // أحجام النقاط مضبوطة يدوياً لتطابق الصورة
    const pointRadii = 5;

    const pointStyles = [
        'circle','circle','circle','rect',
        'circle','rect','circle','rect',
        'circle','rect','circle','circle'
    ];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: window.chartData.monthLabels,
            datasets: [{
                data: window.chartData.monthlyTotals,
                borderColor: '#00ffcc',
                backgroundColor: '#00ffcc',
                fill: false,
                tension: 0.4,
                pointRadius: 5,
                pointStyle: pointStyles,
                pointBackgroundColor: '#00ffcc',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 10 }
                }
            }
        }
    });
});

//chart card
const chartsData = [
    { id: "chart1", data: window.chartData.trends.patients },
    { id: "chart2", data: window.chartData.trends.unpaid },
    { id: "chart3", data: window.chartData.trends.paid },
    { id: "chart4", data: window.chartData.trends.treatments }
];

const allDataPoints = [
    ...window.chartData.trends.patients,
    ...window.chartData.trends.unpaid,
    ...window.chartData.trends.paid,
    ...window.chartData.trends.treatments,
];
const globalMax = Math.max(...allDataPoints);

chartsData.forEach(chart => {
    const ctx = document.getElementById(chart.id).getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 100);
    gradient.addColorStop(0, 'rgba(0,255,204,0.6)');
    gradient.addColorStop(1, 'rgba(0,255,204,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: window.chartData.monthLabels,
            datasets: [
                {
                    data: chart.data,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#00ffcc',
                    tension: 0.4,
                    pointRadius: 0
                },
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                x: { display: false },
                y: {
                    beginAtZero: true,
                    max: globalMax,
                    // display: false
                }
            }
        }
    });
});
