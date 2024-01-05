// Chart
const statistics_chart = document.getElementById("myChart").getContext("2d");
const date = new Date();
const currentMonth = date.getMonth();
let months;

if (currentMonth <= 6) {
  months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni"];
} else {
  months = ["Juli", "Agustus", "September", "Oktober", "November", "Desember"];
}

Chart.defaults.global.tooltips.callbacks.label = (tooltipItem, data) =>
  tooltipItem.yLabel.toLocaleString("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  });

Chart.scaleService.updateScaleDefaults("linear", {
  ticks: {
    callback: (value, index, values) =>
      value.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
      }),
  },
});

fetch("http://localhost:8080/home/getChartCashFlowData")
  .then((response) => response.json())
  .then((cashFlowData) => {
    const myChart = new Chart(statistics_chart, {
      type: "line",
      data: {
        labels: months,
        datasets: [
          {
            label: "Arus Kas",
            data: cashFlowData,
            borderWidth: 5,
            borderColor: "#6777ef",
            backgroundColor: "transparent",
            pointBackgroundColor: "#fff",
            pointBorderColor: "#6777ef",
            pointRadius: 4,
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        scales: {
          yAxes: [
            {
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                stepSize: 150,
              },
            },
          ],
          xAxes: [
            {
              gridLines: {
                color: "#fbfbfb",
                lineWidth: 2,
              },
            },
          ],
        },
      },
    });
  })
  .catch((error) => console.error("Error fetching cashFlow data:", error));
