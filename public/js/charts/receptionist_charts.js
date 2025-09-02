document.addEventListener('DOMContentLoaded', function() {
	try
	{
		// Bar Chart (Appointments by Hour).
		const hoursLabels = appointmentsByHour.map(item => item.hour.toString().padStart(2,'0') + ":00");
		const hoursValues = appointmentsByHour.map(item => item.total);

		const barCtx = document.getElementById("barChart").getContext("2d");

		const gradient = barCtx.createLinearGradient(0, 0, 0, 400);
		gradient.addColorStop(0, "rgba(29, 78, 216, 1)");
		gradient.addColorStop(1, "rgba(14, 165, 233, 0.6)"); 

		const maxBarValue = Math.max(...hoursValues);
		const dynamicMaxY = maxBarValue <= 5 ? 5 : Math.ceil(maxBarValue * 1.2);

		new Chart(barCtx, {
			type: "bar",
			data: {
				labels: hoursLabels,
				datasets: [{
					label: "Appointments by Hour",
					data: hoursValues,
					backgroundColor: gradient,
					borderWidth: 0,
					barThickness: 35,
				}]
			},
			options: {
				responsive: true,
				borderRadius: 10,
				maintainAspectRatio: false,
				layout: { padding: 20 },
				plugins: {
					legend: { display: false },
					tooltip: {
						enabled: true,
						callbacks: {
							label: function(context) {
								return `${context.dataset.label || ''}: ${context.parsed.y}`;
							}
						},
						responsive: true,
					}
				},
				scales: {
					x: {
						grid: { display: false },
						ticks: { color: "#aaa", font: { size: 14 } }
					},
					y: {
						beginAtZero: true,
						max: dynamicMaxY,
						ticks: {
							stepSize: 1,
							color: "#aaa",
							font: { size: 14 }
						},
						grid: {
							color: "rgba(255,255,255,0.05)",
							borderDash: [4, 4]
						}
					}
				}
			}
		});

		// Doughnut Chart (Appointments by Status)
		const statusLabels = appointmentsByStatus.map(item => item.appointment_status);
		const statusValues = appointmentsByStatus.map(item => item.total);

		const doughnutCtx = document.getElementById("myChart").getContext("2d");

		const statusColors = {
			rescheduled: "#2563EB",
			cancelled:  "#EF4444",
			completed:  "#10B981",
			upcoming:   "#F59E0B",
			in_progress:"#3B82F6",
		};

		const doughnutDatasets = statusLabels.map((appointment_status, index) => {
			const value = statusValues[index];
			const total = value + 1;

			const labelKey = appointment_status.replace("-", "_");
			const color = statusColors[labelKey] || "#999";

			return {
				data: [value, total - value],
				backgroundColor: [color, "#0f1724"],
				borderWidth: 0,
				cutout: `${65 - index * 10}%`,
				radius: `${100 - index * 10}%`,
				borderRadius: 3
			};
		});
		new Chart(doughnutCtx, {
			type: "doughnut",
			data: {
				datasets: doughnutDatasets
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				rotation: -90 * (Math.PI / 180),
				layout: { padding: 20 },
				plugins: {
					legend: {
						display: true,
						position: 'right',
						labels: {
							generateLabels: function(chart) {
								return statusLabels.map((label, i) => {
									const labelKey = label.replace("-", "_");
									const color = statusColors[labelKey] || "#999";
									const value = statusValues[i];
									return {
										text: `${label}: ${value}`,
										fillStyle: color,
										strokeStyle: color,
										index: i,
										fontColor: "#fff"
									};
								});
							},
							font: { size: 14 },
							color: "#fff",
							padding: 20
						}
					},
					tooltip: {
						callbacks: {
							label: function(context) {
								const label = statusLabels[context.datasetIndex];
								const value = context.dataset.data[0];
								return `${label}: ${value}`;
							}
						}
					}
				}
			}
		});

	}
	catch (error) {
		console.error("Error loading charts:", error);
	}
});