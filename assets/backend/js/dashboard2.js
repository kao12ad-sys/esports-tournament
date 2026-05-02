// Total Students Card (Animated Counter)
$(function () {
  chart1();
  chart4();
  chart5();
  initScholarshipChart();
  initHostelDonutChart();
});

// Initialize Feather Icons
if (typeof feather !== "undefined") {
  feather.replace();
}

function chart1() {
  var options = {
    chart: {
      height: 300,
      type: "line",
      shadow: {
        enabled: true,
        color: "#000",
        top: 18,
        left: 7,
        blur: 10,
        opacity: 1,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["#786BED", "#999b9c"],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      curve: "smooth",
    },
    series: [
      {
        name: "High - 2019",
        data: [19, 15, 14, 24, 25, 19, 22, 24, 25],
      },
      {
        name: "Low - 2019",
        data: [7, 11, 22, 18, 31, 13, 26, 16, 31],
      },
    ],
    grid: {
      borderColor: "#e7e7e7",
      row: {
        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
        opacity: 0.0,
      },
    },
    markers: {
      size: 6,
    },
    xaxis: {
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "july",
        "aug",
        "sep",
      ],
      labels: {
        style: {
          colors: "#9aa0ac",
        },
      },
    },
    yaxis: {
      title: {
        text: "Income",
      },
      labels: {
        style: {
          colors: "#9aa0ac",
        },
      },
      min: 5,
      max: 40,
    },

    legend: {
      position: "top",
      horizontalAlign: "right",
      floating: true,
      offsetY: -5,
      offsetX: -5,
      labels: { colors: "#9aa0ac" },
    },
    tooltip: {
      theme: "dark",
      marker: {
        show: true,
      },
      x: {
        show: true,
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart1"), options);

  chart.render();
}
function chart4() {
  var options = {
    chart: {
      height: 300,
      stacked: true,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: false,
      },
    },
    responsive: [
      {
        breakpoint: 480,
        options: {
          legend: {
            position: "bottom",
            offsetX: -10,
            offsetY: 0,
          },
        },
      },
    ],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
      },
    },
    tooltip: {
      theme: "dark",
      marker: {
        show: true,
      },
      x: {
        show: true,
      },
    },
    xaxis: {
      categories: ["jan", "feb", "mar", "apr", "may", "jun"],
      labels: {
        style: {
          colors: "#9aa0ac",
        },
      },
    },
    yaxis: {
      labels: {
        style: {
          colors: "#9aa0ac",
        },
      },
    },
    legend: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    series: [
      {
        name: "Class A",
        data: [44, 55, 41, 67, 22, 43],
      },
      {
        name: "Class B",
        data: [13, 23, 20, 8, 13, 27],
      },
      {
        name: "Class C",
        data: [11, 17, 15, 15, 21, 14],
      },
      {
        name: "Class D",
        data: [21, 7, 25, 13, 22, 8],
      },
    ],
  };

  var chart = new ApexCharts(document.querySelector("#schart2"), options);

  chart.render();
}
function chart5() {
  var options = {
    series: [86, 64],
    chart: {
      height: 350,
      type: "radialBar",
      offsetY: -10,
    },
    colors: ["#7ECB78", "#F59F4A"],
    plotOptions: {
      radialBar: {
        startAngle: -135,
        endAngle: 135,
        inverseOrder: true,
        dataLabels: {
          show: true,
          name: {
            show: true,
            fontSize: "16px",
            fontWeight: 600,
            offsetY: -30,
            formatter(val, show, opts) {
              return [opts.globals.seriesNames[0], opts.globals.series[0]];
            },
          },
          value: {
            show: true,
            fontWeight: 600,
            color: "#F59F4A",
            fontSize: "16px",
          },
          total: {
            show: true,
            fontSize: "16px",
            fontWeight: 600,
            color: "#7ECB78",
            formatter(opts) {
              return [opts.globals.series[1], opts.globals.seriesNames[1]];
            },
          },
        },
      },
    },
    labels: ["Math", "Science"],
  };

  var chart = new ApexCharts(document.querySelector("#schart3"), options);
  chart.render();
}

// 14. Scholarship Distribution - ApexCharts Donut
function initScholarshipChart() {
  var options = {
    series: [156, 45, 89, 23],
    labels: ["Merit", "Sports", "Financial Aid", "Special"],
    chart: {
      type: "donut",
      height: 300,
      fontFamily: "Poppins, sans-serif",
    },
    colors: ["#667eea", "#38ef7d", "#fa709a", "#fee140"],
    plotOptions: {
      pie: {
        donut: {
          size: "60%",
          labels: {
            show: true,
            total: {
              show: true,
              label: "Total",
              formatter: function (w) {
                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
              },
            },
          },
        },
      },
    },
    dataLabels: { enabled: false },
    legend: {
      position: "bottom",
      fontSize: "11px",
      labels: { colors: "#9aa0ac" },
    },
    stroke: { width: 2 },
  };

  if (document.querySelector("#scholarshipChart")) {
    var chart = new ApexCharts(
      document.querySelector("#scholarshipChart"),
      options,
    );
    chart.render();
  }
}

// 15. Hostel Occupancy - ApexCharts Donut
function initHostelDonutChart() {
  var options = {
    series: [420, 80],
    labels: ["Occupied", "Available"],
    chart: {
      type: "donut",
      height: 300,
      fontFamily: "Poppins, sans-serif",
    },
    colors: ["#667eea", "#38ef7d"],
    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          labels: {
            show: true,
            total: {
              show: true,
              label: "Total Beds",
              formatter: function (w) {
                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
              },
            },
          },
        },
      },
    },
    dataLabels: { enabled: false },
    legend: {
      position: "bottom",
      fontSize: "12px",
      labels: { colors: "#9aa0ac" },
    },
    stroke: { width: 2 },
  };

  if (document.querySelector("#hostelDonutChart")) {
    var chart = new ApexCharts(
      document.querySelector("#hostelDonutChart"),
      options,
    );
    chart.render();
  }
}
