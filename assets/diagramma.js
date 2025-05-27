const labels = chartData.map((row) => row.datums);
const values = chartData.map((row) => row.pasutijumu_skaits);

const ctx = document.getElementById("pasutijumuDiagramma").getContext("2d");
const myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: labels, // Ass "x" vērtības (datumi)
    datasets: [
      {
        label: "Pasūtījumu skaits",
        data: values, // Ass "y" vērtības (skaits)
        backgroundColor: "#ef9e7871",
        borderColor: "#c96333",
        borderWidth: 2,
        fill: true,
        tension: 0.2,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false,
      },
      tooltip: {
        enabled: true,
      },
    },
    scales: {
      x: {
        grid: {
          display: false,
        },
      },
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1,
          callback: function (value) {
            return Number.isInteger(value) ? value : "";
          },
        },
      },
    },
  },
});
