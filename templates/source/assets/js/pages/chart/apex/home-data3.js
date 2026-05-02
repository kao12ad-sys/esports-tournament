$(function () {
  smallchart1();
  smallchart2();
});
function smallchart1() {
  var options = {
    series: [
      {
        name: "Collected",
        data: [
          45000, 52000, 48000, 61000, 55000, 67000, 72000, 58000, 65000, 78000,
          82000, 89000,
        ],
      },
      {
        name: "Pending",
        data: [
          12000, 15000, 11000, 18000, 14000, 16000, 19000, 13000, 17000, 21000,
          18000, 22000,
        ],
      },
    ],
    chart: {
      type: "bar",
      height: 300,
      fontFamily: "Poppins, sans-serif",
      toolbar: {
        show: false,
      },
      animations: {
        enabled: true,
        easing: "easeinout",
        speed: 800,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        borderRadius: 4,
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
        formatter: function (val) {
          return "$" + val / 1000 + "K";
        },
      },
    },
    fill: {
      opacity: 1,
    },
    colors: ["#5C9FFB", "#AEAEAE"],
    legend: {
      position: "top",
      horizontalAlign: "right",
      fontSize: "12px",
      labels: { colors: "#9aa0ac" },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return "$" + val.toLocaleString();
        },
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart2"), options);
  chart.render();
}

function smallchart2() {
  var options = {
    series: [
      {
        name: "Students",
        data: [120, 145, 165, 180, 210, 245, 280, 320, 365, 410, 455, 520],
      },
      {
        name: "New Admissions",
        data: [25, 32, 28, 40, 55, 48, 62, 70, 75, 85, 90, 105],
      },
    ],
    chart: {
      height: 300,
      type: "area",
      dropShadow: {
        enabled: true,
        opacity: 0.3,
        blur: 5,
        left: -7,
        top: 22,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["#6777EF", "#FEB019"],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      curve: "smooth",
      width: 3,
      lineCap: "square",
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      crosshairs: {
        show: true,
      },
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
        offsetX: 0,
        offsetY: 5,
        style: {
          colors: "#9aa0ac",
        },
      },
    },
    yaxis: {
      labels: {
        offsetX: 0,
        offsetY: 0,
        style: {
          colors: "#9aa0ac",
        },
      },
    },
    legend: {
      position: "top",
      horizontalAlign: "right",
      fontSize: "12px",
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

  var chart = new ApexCharts(document.querySelector("#schart3"), options);
  chart.render();
}
