$(document).ready(function () {
  loadChart();
  loadPieChart();
});

//////////////////////////// chart ////////////////////////////

var divChart = document.getElementById("container_chart").getBoundingClientRect();
var chartWidth = divChart.width - 30;
var chartHight = divChart.height - 30;

var options = {
  chart: {
    redrawOnWindowResize: true,
    type: 'bar',
    height: chartHight,
    width: chartWidth,
    toolbar: {
      show: true,
      offsetX: 0,
      offsetY: 0,

      export: {
        csv: {
          filename: undefined,
          columnDelimiter: ',',
          headerCategory: 'category',
          headerValue: 'value',
          dateFormatter(timestamp) {
            return new Date(timestamp).toDateString()
          }
        },
        svg: {
          filename: undefined,
        },
        png: {
          filename: undefined,
        }
      },
      autoSelected: 'zoom'
    },
  },
  dataLabels: {
    enabled: false,

  },
  legend: {
    show: false,

    position: 'bottom',
    horizontalAlign: 'center',

    floating: false,
    fontSize: '14px',
    fontFamily: 'Helvetica, Arial',
    fontWeight: 400,



    offsetX: 0,
    offsetY: 0,
    labels: {
      colors: ['#ED30A2', '#0782C8'],
      useSeriesColors: false
    },
  },

  title: {
    text: 'Pemasukan Pengeluaran',
    align: 'left',
    margin: 60,
    offsetX: 0,
    offsetY: -20,
    floating: true,
    style: {
      fontSize: '15px',
      fontWeight: 'normal',
      fontFamily: undefined,
      color: '#263238'
    },
  },

  noData: {
    text: "No Data",
    align: 'center',
    verticalAlign: 'middle',
    offsetX: 0,
    offsetY: 0,
    style: {
      color: undefined,
      fontSize: '14px',
      fontFamily: undefined
    },
    xaxis: {
      type: 'category',
      categories: [],
      labels: {
        show: false,
      },
    }
  },

  tooltip: {
    y: {
      formatter: function (val) {
        return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }
    }
  },
  yaxis: {
    labels: {
      formatter: function (val) {
        return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }
    }
  },

  series: [{
    name: "lampu",
    data: [30000, 60000]
  },
  {
    name: "piring",
    data: [30000, 60000]
  },
  ],
  stroke: {
    colors: ["transparent"],
    width: 2
  },

  colors: ['#FFB015', '#000000'],

  xaxis: {
    type: 'category',
    categories: ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'],
    labels: {
      show: true,
    },
    rotateLabels: 0,
  }

}
var chart = new ApexCharts(document.querySelector("#chart"), options);

////////////////////////////  pie chart ////////////////////////////
var divChart = document.getElementById("container_pie_chart").getBoundingClientRect();
var heightPenjualan = divChart.height;
var widthPenjualan = divChart.width * 0.8;

var optionspieframe_pria = {
  redrawOnWindowResize: true,
  chart: {
    height: (heightPenjualan),
    width: (widthPenjualan),
    type: 'pie',

  },
  legend: {
    position: 'bottom',
    horizontalAlign: 'center',

  },
  labels: ['chinos', 'baju koko', 'hodie', 'sweater', 'baju polo', 'jeans'],
  // series: getSeriesPie(),
  series: [30, 40, 90, 80, 60, 20],

}

var chartpie_pria = new ApexCharts(document.querySelector("#pie_chart_pria"), optionspieframe_pria);

function loadChart() {
  chart.render();
}

function loadPieChart() {
  chartpie_pria.render();
  // chartpie_wanita.render();
}