
const ctx = document.getElementById("appointmentsChart").getContext("2d");
new Chart(ctx, {
    type: "bar",
    data: window.appointmentsChartData,
    options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        x: { ticks: { color: "#fff" } },
        y: { beginAtZero: true, ticks: { color: "#fff" } }
    },
    plugins: {
        tooltip: { callbacks: { label: ctx => `${ctx.dataset.label}: ${ctx.parsed.y}` } },
        legend: { labels: { color: "#fff" } }
    }
    }
});
