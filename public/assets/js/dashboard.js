$(function () {


  // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      { name: "Earnings this month:", data: [355, 390, 300, 350, 390, 180, 355, 390] },
      { name: "Expense this month:", data: [280, 250, 325, 215, 250, 310, 280, 250] },
    ],

    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },


    colors: ["#5D87FF", "#49BEFF"],


    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },


    legend: {
      show: false,
    },


    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },


    yaxis: {
      show: true,
      min: 0,
      max: 400,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },


    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]


  };

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();


  // =====================================
  // Breakup
  // =====================================
  var breakup = {
    color: "#adb5bd",
    series: [38, 40, 25],
    labels: ["2022", "2021", "2020"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();



  // =====================================
  // Earning
  // =====================================
  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Earnings",
        color: "#49BEFF",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();
})

// Bar April
new ApexCharts(document.querySelector("#bar-april"), {
  chart: {
    type: 'bar',
    height: 160,
    toolbar: { show: false }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '45%',
      borderRadius: 4,
      dataLabels: {
        position: 'top'
      }
    }
  },
  dataLabels: {
    enabled: true,
    formatter: function (val) {
      return val.toLocaleString(); // format angka
    },
    offsetY: -10,
    style: {
      fontSize: '12px',
      colors: ["#000", "#000"]
    }
  },
  series: [
    {
      name: 'Barang Masuk',
      data: [13432]
    },
    {
      name: 'Barang Keluar',
      data: [2162]
    }
  ],
  xaxis: {
    categories: ['April'],
    labels: {
      style: { fontSize: '12px' }
    },
    axisBorder: { show: false },
    axisTicks: { show: false }
  },
  yaxis: {
    show: false
  },
  legend: {
    position: 'bottom',
    fontSize: '12px'
  },
  colors: ['#1e88e5', '#f1c40f'],
  grid: {
    padding: { top: 10, bottom: -10, left: 0, right: 0 }
  }
}).render();


// Sales Chart
new ApexCharts(document.querySelector("#sales-chart"), {
  chart: {
    type: 'line',
    height: '450', // Penting untuk isi penuh
    toolbar: { show: true }
  },
  series: [
    { name: "Penjualan", data: [12000, 15000, 14000, 18000, 17000, 20000, 22000, 21000, 25000, 26000, 24000, 27000] },
    { name: "Pembelian", data: [10000, 11000, 12000, 13000, 12500, 14500, 15000, 14000, 15500, 16500, 16000, 17000] }
  ],
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  },
  colors: ['#1e88e5', '#f1c40f'],
  grid: { padding: { top: 10, bottom: 10, left: 10, right: 10 } },
  stroke: { width: 3 }
}).render();


// Pie Fast
new ApexCharts(document.querySelector("#pie-fast"), {
  chart: { type: 'donut' },
  series: [44, 25, 15, 16],
  labels: ['Benih', 'Pupuk', 'Obat', 'Makanan'],
  colors: ['#1e88e5', '#26c6da', '#745af2', '#f1c40f']
}).render();

// Pie Slow
new ApexCharts(document.querySelector("#pie-slow"), {
  chart: { type: 'donut' },
  series: [20, 30, 25, 25],
  labels: ['Benih', 'Pupuk', 'Obat', 'Makanan'],
  colors: ['#ff5c8e', '#26c6da', '#745af2', '#f1c40f']
}).render();
