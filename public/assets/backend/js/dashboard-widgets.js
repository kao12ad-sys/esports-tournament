// Dashboard Widgets JavaScript - ApexCharts Only

document.addEventListener("DOMContentLoaded", function () {
  initTeacherWorkloadChart();
  initClassPerformanceRadar();
  initGenderPieChart();
  initPassRateChart();
  initStaffAttendanceChart();
});

// 2. Teacher Workload Distribution - ApexCharts Bar Chart
function initTeacherWorkloadChart() {
  var options = {
    series: [
      {
        name: "Classes",
        data: [5, 4, 6, 3, 5, 4, 3, 5],
      },
      {
        name: "Students",
        data: [120, 95, 145, 80, 125, 110, 90, 135],
      },
    ],
    chart: {
      type: "bar",
      height: 280,
      fontFamily: "Poppins, sans-serif",
      toolbar: { show: false },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        borderRadius: 4,
      },
    },
    dataLabels: { enabled: false },
    stroke: { show: true, width: 2, colors: ["transparent"] },
    xaxis: {
      categories: [
        "Mrs. Smith",
        "Mr. Johnson",
        "Mrs. Davis",
        "Mr. Wilson",
        "Mrs. Brown",
        "Mr. Taylor",
        "Mrs. Anderson",
        "Mr. Thomas",
      ],
      labels: { style: { fontSize: "10px", colors: "#9aa0ac" } },
    },
    yaxis: { labels: { style: { fontSize: "11px", colors: "#9aa0ac" } } },
    fill: { opacity: 1 },
    colors: ["#667eea", "#38ef7d"],
    legend: {
      position: "top",
      horizontalAlign: "right",
      fontSize: "11px",
      labels: { colors: "#9aa0ac" },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val;
        },
      },
    },
  };

  if (document.querySelector("#teacherWorkloadChart")) {
    var chart = new ApexCharts(
      document.querySelector("#teacherWorkloadChart"),
      options,
    );
    chart.render();
  }
}

// 4. Class Performance - ApexCharts Radar Chart
function initClassPerformanceRadar() {
  var options = {
    series: [
      {
        name: "Class 10-A",
        data: [90, 85, 88, 82, 92, 87],
      },
      {
        name: "Class 10-B",
        data: [82, 88, 85, 90, 80, 85],
      },
    ],
    chart: {
      type: "radar",
      height: 280,
      fontFamily: "Poppins, sans-serif",
      toolbar: { show: false },
    },
    colors: ["#667eea", "#38ef7d"],
    dataLabels: { enabled: true },
    stroke: { width: 2 },
    xaxis: {
      categories: [
        "Math",
        "Science",
        "English",
        "History",
        "Physics",
        "Chemistry",
      ],
      labels: { style: { fontSize: "11px", colors: "#9aa0ac" } },
    },
    yaxis: {
      labels: { style: { fontSize: "10px", colors: "#9aa0ac" } },
      min: 60,
      max: 100,
    },
    legend: {
      position: "top",
      horizontalAlign: "right",
      fontSize: "11px",
      labels: { colors: "#9aa0ac" },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val + "%";
        },
      },
    },
  };

  if (document.querySelector("#classPerformanceRadar")) {
    var chart = new ApexCharts(
      document.querySelector("#classPerformanceRadar"),
      options,
    );
    chart.render();
  }
}

// 5. Student Gender Distribution - ApexCharts Donut
function initGenderPieChart() {
  var options = {
    series: [2456, 2130],
    labels: ["Male", "Female"],
    chart: {
      type: "donut",
      height: 300,
      fontFamily: "Poppins, sans-serif",
    },
    colors: ["#667eea", "#fa709a"],
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
    dataLabels: { enabled: false },
    legend: {
      position: "bottom",
      fontSize: "12px",
      labels: { colors: "#9aa0ac" },
    },
    stroke: { width: 2 },
  };

  if (document.querySelector("#genderPieChart")) {
    var chart = new ApexCharts(
      document.querySelector("#genderPieChart"),
      options,
    );
    chart.render();
  }
}

// 6. Subject-wise Pass Rate - ApexCharts Horizontal Bar
function initPassRateChart() {
  var options = {
    series: [
      {
        name: "Pass Rate",
        data: [92, 88, 95, 78, 85, 90],
      },
    ],
    chart: {
      type: "bar",
      height: 280,
      fontFamily: "Poppins, sans-serif",
      toolbar: { show: false },
      horizontal: true,
    },
    plotOptions: {
      bar: {
        horizontal: true,
        borderRadius: 4,
        barHeight: "60%",
        distributed: true,
      },
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return val + "%";
      },
    },
    colors: ["#667eea", "#38ef7d", "#fa709a", "#fee140", "#4facfe", "#f093fb"],
    xaxis: {
      categories: [
        "English",
        "Mathematics",
        "Physics",
        "History",
        "Chemistry",
        "Science",
      ],
      labels: { style: { fontSize: "11px", colors: "#9aa0ac" } },
      max: 100,
    },
    yaxis: { labels: { style: { fontSize: "11px", colors: "#9aa0ac" } } },
    legend: { show: false },
    tooltip: {
      y: {
        formatter: function (val) {
          return val + "%";
        },
      },
    },
  };

  if (document.querySelector("#passRateChart")) {
    var chart = new ApexCharts(
      document.querySelector("#passRateChart"),
      options,
    );
    chart.render();
  }
}

// 12. Staff Attendance Weekly Trend - ApexCharts Area
function initStaffAttendanceChart() {
  var options = {
    series: [
      {
        name: "Present",
        data: [145, 148, 142, 150, 147, 149, 151],
      },
      {
        name: "Absent",
        data: [8, 5, 10, 3, 6, 4, 2],
      },
      {
        name: "Leave",
        data: [7, 7, 8, 7, 7, 7, 7],
      },
    ],
    chart: {
      type: "area",
      height: 280,
      fontFamily: "Poppins, sans-serif",
      toolbar: { show: false },
    },
    colors: ["#38ef7d", "#fa709a", "#fee140"],
    dataLabels: { enabled: false },
    stroke: { curve: "smooth", width: 2 },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.4,
        opacityTo: 0.1,
        stops: [0, 100],
      },
    },
    xaxis: {
      categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      labels: { style: { fontSize: "11px", colors: "#9aa0ac" } },
    },
    yaxis: { labels: { style: { fontSize: "11px", colors: "#9aa0ac" } } },
    legend: {
      position: "top",
      horizontalAlign: "right",
      fontSize: "11px",
      labels: { colors: "#9aa0ac" },
    },
    grid: { borderColor: "#f0f0f0" },
  };

  if (document.querySelector("#staffAttendanceChart")) {
    var chart = new ApexCharts(
      document.querySelector("#staffAttendanceChart"),
      options,
    );
    chart.render();
  }
}
