// Animated counters
function animateCounter(elementId, target) {
  let current = 0;
  const increment = target / 50;
  const timer = setInterval(function () {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    var el = document.getElementById(elementId);
    if (el) {
      el.textContent = Math.floor(current).toLocaleString();
    }
  }, 30);
}

document.addEventListener("DOMContentLoaded", function () {
  animateCounter("totalStudents", 4586);
  animateCounter("totalTeachers", 156);
  animateCounter("totalCourses", 103);
  animateCounter("totalFees", 245000);
  animateCounter("totalGraduates", 892);
  animateCounter("newAdmissions", 323);
});

// Attendance Overview - ApexCharts Line Chart
var attendanceOverviewOptions = {
  series: [
    {
      name: "Present",
      data: [92, 94, 90, 88, 95, 92, 88, 85, 90, 92, 95, 93],
    },
    {
      name: "Absent",
      data: [5, 3, 7, 8, 3, 5, 8, 10, 6, 5, 3, 4],
    },
    {
      name: "Leave",
      data: [3, 3, 3, 4, 2, 3, 4, 5, 4, 3, 2, 3],
    },
  ],
  chart: {
    type: "line",
    height: 280,
    fontFamily: "Poppins, sans-serif",
    toolbar: { show: false },
    animations: { enabled: true, easing: "easeinout", speed: 800 },
  },
  colors: ["#38ef7d", "#fa709a", "#fee140"],
  dataLabels: { enabled: false },
  stroke: { curve: "smooth", width: 3 },
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
    labels: { style: { fontSize: "11px", colors: "#9aa0ac" } },
  },
  yaxis: {
    labels: {
      style: { fontSize: "11px", colors: "#9aa0ac" },
      formatter: function (val) {
        return val + "%";
      },
    },
    min: 0,
    max: 100,
  },
  legend: {
    position: "top",
    horizontalAlign: "right",
    fontSize: "12px",
    labels: { colors: "#9aa0ac" },
  },
  grid: { borderColor: "#f0f0f0" },
  tooltip: {
    y: {
      formatter: function (val) {
        return val + "%";
      },
    },
  },
};

if (document.querySelector("#attendanceOverviewChart")) {
  var attendanceOverviewChart = new ApexCharts(
    document.querySelector("#attendanceOverviewChart"),
    attendanceOverviewOptions,
  );
  attendanceOverviewChart.render();
}

// Monthly Admission Trend - ApexCharts Area Chart
var admissionTrendOptions = {
  series: [
    {
      name: "Admissions",
      data: [45, 52, 48, 65, 72, 68, 78, 85, 80, 92, 88, 105],
    },
  ],
  chart: {
    type: "area",
    height: 280,
    fontFamily: "Poppins, sans-serif",
    toolbar: { show: false },
    animations: { enabled: true, easing: "easeinout", speed: 800 },
  },
  colors: ["#667eea"],
  dataLabels: { enabled: false },
  stroke: { curve: "smooth", width: 3 },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.5,
      opacityTo: 0.1,
      stops: [0, 100],
    },
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
    labels: { style: { fontSize: "11px", colors: "#9aa0ac" } },
  },
  yaxis: { labels: { style: { fontSize: "11px", colors: "#9aa0ac" } } },
  grid: { borderColor: "#f0f0f0" },
  tooltip: {
    y: {
      formatter: function (val) {
        return val + " admissions";
      },
    },
  },
};

if (document.querySelector("#admissionTrendChart")) {
  var admissionTrendChart = new ApexCharts(
    document.querySelector("#admissionTrendChart"),
    admissionTrendOptions,
  );
  admissionTrendChart.render();
}
