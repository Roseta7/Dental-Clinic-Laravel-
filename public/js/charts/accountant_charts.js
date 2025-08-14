document.addEventListener('DOMContentLoaded', function() {
    
    //pie chart
    const ctx1 = document.getElementById("statusChart").getContext("2d");

    const gradient1 = ctx1.createLinearGradient(0, 0, 0, 300);
    gradient1.addColorStop(0, "#6366F1");
    gradient1.addColorStop(0.5, "#ffffff");
    gradient1.addColorStop(1, "#6366F1");

    const gradient2 = ctx1.createLinearGradient(0, 0, 0, 300);
    gradient2.addColorStop(0, "#FACC15");
    gradient2.addColorStop(0.5, "#ffffff");
    gradient2.addColorStop(1, "#FACC15");

    const gradient3 = ctx1.createLinearGradient(0, 0, 0, 300);
    gradient3.addColorStop(0, "#4ADE80");
    gradient3.addColorStop(0.5, "#ffffff");
    gradient3.addColorStop(1, "#4ADE80");

    const gradient4 = ctx1.createLinearGradient(0, 0, 0, 300);
    gradient4.addColorStop(0, "#F87171");
    gradient4.addColorStop(0.5, "#ffffff");
    gradient4.addColorStop(1, "#F87171");

    const gradient5 = ctx1.createLinearGradient(0, 0, 0, 300);
    gradient5.addColorStop(0, "#ec4899");
    gradient5.addColorStop(0.5, "#ffffff");
    gradient5.addColorStop(1, "#ec4899");

    // Pie Chart - Revenue Distribution by Treatment Type(for Current Month)
    const pieLabels = pieData.map(item => item.label);
    const pieValues = pieData.map(item => item.percentage);


    const statusChart = new Chart(ctx1, {
        type: "doughnut",
        data: {
            labels: pieLabels,
            datasets: [
            {
                data: pieValues,
                backgroundColor: [
                    gradient1,
                    gradient2,
                    gradient3,
                    gradient4,
                    gradient5,
                ],
                borderColor: "#2A2A2A",
                borderWidth: 4,
                borderRadius: 5,
                cutout: "70%",
            },
            ],
        },
        options: {
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || "";
                            const value = context.raw;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${label}: ${percent}% (${value})`;
                        },
                        responsive: true, // تفعيل التجاوُب
                        maintainAspectRatio: false,
                    },
                },
            },
        },
    });

    const ctx = document.getElementById("myChart").getContext("2d");

    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, "rgba(99, 102, 241, 0.5)");
    gradient.addColorStop(1, "rgba(99, 102, 241, 0)");

    let pointStyleIndex = 0;
    const pointStyles = ["circle", "rect", "triangle"];
    let fillArea = true;

    // Line Chart - Monthly Revenue (Current Year)
    const months = chartData.map(item => item.month);
    const revenues = chartData.map(item => item.total);


    const lineChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: months,
            datasets: [
            {
                label: "Revenue Growth",
                data: revenues,
                fill: fillArea,
                backgroundColor: gradient,
                borderColor: "#6366f1",
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: "#ffffff",
                pointBorderColor: "#6366f1",
                pointHoverRadius: 6,
                pointRadius: 5,
                pointStyle: pointStyles[pointStyleIndex],
            }],
        },
        options: {
            responsive: true,
            plugins: {
            legend: {
                labels: {
                    color: "#f9fafb",
                    font: { size: 14, weight: "bold" },
                },
            },
            tooltip: {
                backgroundColor: "#1f2937",
                titleColor: "#fff",
                bodyColor: "#d1d5db",
                padding: 10,
            },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgba(255, 255, 255, 0.1)",
                    },
                    ticks: {
                        color: "#9ca3af",
                        font: { size: 12, weight: "bold" },
                    },
                    title: {
                        display: true,
                        text: "value",
                        font: { size: 14, weight: "bold" },
                        color: "#e5e7eb",
                    },
                },
                x: {
                    grid: {
                        color: "rgba(255, 255, 255, 0.05)",
                    },
                    ticks: {
                        color: "#9ca3af",
                        font: { size: 12, weight: "bold" },
                    },
                    title: {
                        display: true,
                        text: "Months",
                        font: { size: 14, weight: "bold" },
                        color: "#e5e7eb",
                    },
                },
            },
        },
    });

    // ------------------------
    // TOGGLE POINT STYLE BUTTON
    // ------------------------
    const toggleBtn = document.getElementById("togglePointStyle");
    const toggleFillBtn = document.getElementById("toggleFill");

    toggleBtn.addEventListener("click", () => {
        pointStyleIndex = (pointStyleIndex + 1) % pointStyles.length;
        lineChart.data.datasets[0].pointStyle = pointStyles[pointStyleIndex];
        lineChart.update();

        const stylesMap = {
            circle: "Circle Points",
            rect: "Square Points",
            triangle: "Triangle Points",
        };
        toggleBtn.textContent = `Point Style: ${
            stylesMap[pointStyles[pointStyleIndex]]
        }`;
    });

    // ------------------------
    // TOGGLE FILL AREA BUTTON
    // ------------------------
    toggleFillBtn.addEventListener("click", () => {
        fillArea = !fillArea;
        lineChart.data.datasets[0].fill = fillArea;
        lineChart.update();

        if (fillArea) {
            toggleFillBtn.classList.add("active");
            toggleFillBtn.textContent = "Fill Area: Enabled";
        } 
        else {
            toggleFillBtn.classList.remove("active");
            toggleFillBtn.textContent = "Fill Area: Disabled";
        }
    });

    // Initial setup
    toggleBtn.dispatchEvent(new Event("click"));
    toggleFillBtn.dispatchEvent(new Event("click"));
});

