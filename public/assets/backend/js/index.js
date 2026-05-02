// Student Attendance Donut Chart
var attendanceDonutOptions = {
  series: [425, 45, 30],
  labels: ["Present", "Absent", "Leave"],
  chart: {
    type: "donut",
    height: 220,
    fontFamily: "Poppins, sans-serif",
  },
  colors: ["#667eea", "#fa709a", "#fee140"],
  plotOptions: {
    pie: {
      donut: {
        size: "65%",
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
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  stroke: {
    width: 2,
  },
};
var attendanceDonutChart = new ApexCharts(
  document.querySelector("#attendanceDonut"),
  attendanceDonutOptions,
);
attendanceDonutChart.render();

// Monthly Fee Collection Bar Chart
var feeCollectionOptions = {
  series: [
    {
      name: "Collection",
      data: [
        45000, 52000, 48000, 61000, 55000, 67000, 72000, 58000, 65000, 78000,
        82000, 89000,
      ],
    },
  ],
  chart: {
    type: "bar",
    height: 250,
    fontFamily: "Poppins, sans-serif",
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      borderRadius: 4,
      horizontal: false,
      columnWidth: "50%",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    labels: {
      style: {
        fontSize: "10px",
        colors: "#9aa0ac",
      },
    },
  },
  yaxis: {
    labels: {
      style: {
        fontSize: "10px",
        colors: "#9aa0ac",
      },
      formatter: function (val) {
        return "$" + val / 1000 + "K";
      },
    },
  },
  fill: {
    opacity: 1,
    colors: ["#667eea"],
  },
  colors: ["#667eea"],
  tooltip: {
    y: {
      formatter: function (val) {
        return "$" + val.toLocaleString();
      },
    },
  },
};
var feeCollectionChart = new ApexCharts(
  document.querySelector("#feeCollectionBar"),
  feeCollectionOptions,
);
feeCollectionChart.render();

// Exam Result Performance Area Chart
var examPerformanceOptions = {
  series: [
    {
      name: "Class 10",
      data: [85, 88, 82, 90, 92, 88, 95],
    },
    {
      name: "Class 9",
      data: [78, 82, 80, 85, 88, 84, 90],
    },
  ],
  chart: {
    type: "area",
    height: 220,
    fontFamily: "Poppins, sans-serif",
    toolbar: {
      show: false,
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
    width: 2,
  },
  xaxis: {
    categories: [
      "Term 1",
      "Term 2",
      "Term 3",
      "Unit Test 1",
      "Unit Test 2",
      "Half Yearly",
      "Final",
    ],
    labels: {
      style: {
        fontSize: "10px",
        colors: "#9aa0ac",
      },
    },
  },
  yaxis: {
    min: 60,
    max: 100,
    labels: {
      style: {
        fontSize: "10px",
        colors: "#9aa0ac",
      },
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.4,
      opacityTo: 0.1,
      stops: [0, 100],
    },
  },
  colors: ["#667eea", "#38ef7d"],
  legend: {
    position: "top",
    fontSize: "11px",
    offsetY: -5,
    labels: { colors: "#9aa0ac" },
  },
  grid: {
    borderColor: "#f0f0f0",
  },
};
var examPerformanceChart = new ApexCharts(
  document.querySelector("#examPerformanceArea"),
  examPerformanceOptions,
);
examPerformanceChart.render();

// Library Book Issue Line Chart
var libraryLineOptions = {
  series: [
    {
      name: "Books Issued",
      data: [120, 145, 132, 168, 155, 180, 195, 178, 165, 190, 210, 225],
    },
    {
      name: "Books Returned",
      data: [105, 130, 125, 150, 145, 165, 180, 165, 155, 175, 195, 210],
    },
  ],
  chart: {
    type: "line",
    height: 290,
    fontFamily: "Poppins, sans-serif",
    toolbar: {
      show: false,
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
    width: 3,
  },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    labels: {
      style: {
        fontSize: "11px",
        colors: "#9aa0ac",
      },
    },
  },
  yaxis: {
    labels: {
      style: {
        fontSize: "11px",
        colors: "#9aa0ac",
      },
    },
  },
  colors: ["#667eea", "#38ef7d"],
  legend: {
    position: "top",
    horizontalAlign: "right",
    fontSize: "11px",
    labels: { colors: "#9aa0ac" },
  },
  grid: {
    borderColor: "#f0f0f0",
  },
  markers: {
    size: 4,
    strokeWidth: 2,
    hover: {
      size: 6,
    },
  },
};
var libraryLineChart = new ApexCharts(
  document.querySelector("#libraryLineChart"),
  libraryLineOptions,
);
libraryLineChart.render();
