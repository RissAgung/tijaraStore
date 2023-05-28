$(document).ready(function () {
  loadChart();
});

var GetDataChart = (res) => {
  const data = JSON.parse(atob(res));
  console.log(data);

  dataPemasukan = data.data;
  dataPengeluaran = data.data_pengeluaran;
  options.xaxis.categories = data.label;

  chart.updateOptions(options);
  chart.updateSeries(getSeriesPenjualan(), true);
}

//////////////////////////// chart ////////////////////////////

var dataPemasukan = []
var dataPengeluaran = []

function getSeriesPenjualan() {
  return [{
    name: 'Pemasukkan',
    data: dataPemasukan,
  }, {
    name: 'Pengeluaran',
    data: dataPengeluaran,
  }];
}

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
    text: 'Pemasukan Pengeluaran bulan ini',
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
////////////////////////////  end chart ////////////////////////////

////////////////////////////  pie chart ////////////////////////////

var seriesPiePria = [];
var seriesPieWanita = [];
var seriesPieAnak = [];

function getSeriesPiePria() {
  return seriesPiePria;
}

function getSeriesPieWanita() {
  return seriesPieWanita;
}

function getSeriesPieAnak() {
  return seriesPieAnak;
}

var labelsPiePria = [];
var labelsPieWanita = [];
var labelsPieAnak = [];

function getLabelsPiePria() {
  return labelsPiePria;
}

function getLabelsPieWanita() {
  return labelsPieWanita;
}

function getLabelsPieAnak() {
  return labelsPieAnak;
}

var divChart = document.getElementById("container_pie_chart").getBoundingClientRect();
var heightPenjualan = divChart.height;
var widthPenjualan = divChart.width * 0.8;

var optionspie_wanita = {
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
  labels: getLabelsPieWanita(),
  series: getSeriesPieWanita(),

}
var optionspie_pria = {
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
  labels: getLabelsPiePria(),
  series: getSeriesPiePria(),

}
var optionspie_anak = {
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
  labels: getLabelsPieAnak(),
  series: getSeriesPieAnak(),

}


var chartpie_wanita = new ApexCharts(document.querySelector("#pie_chart_wanita"), optionspie_wanita);
var chartpie_pria = new ApexCharts(document.querySelector("#pie_chart_pria"), optionspie_pria);
var chartpie_anak = new ApexCharts(document.querySelector("#pie_chart_anak"), optionspie_anak);

var loadDefaultPie = (res) => {

  const data = JSON.parse(atob(res));

  //////////////// pria ////////////////
  const series_pria = data.pria.series;
  const labels_pria = data.pria.labels;

  seriesPiePria.length = 0;
  series_pria.forEach((series) => {
    seriesPiePria.push(series);
  });

  labelsPiePria.length = 0;
  labels_pria.forEach((labels) => {
    labelsPiePria.push(labels);
  });
  //////////////// end pria ////////////////

  //////////////// wanita ////////////////
  const series_wanita = data.wanita.series;
  const labels_wanita = data.wanita.labels;

  seriesPieWanita.length = 0;
  series_wanita.forEach((series) => {
    seriesPieWanita.push(series);
  });

  labelsPieWanita.length = 0;
  labels_wanita.forEach((labels) => {
    labelsPieWanita.push(labels);
  });
  //////////////// end wanita ////////////////

  //////////////// anak ////////////////
  const series_anak = data.anak.series;
  const labels_anak = data.anak.labels;

  seriesPieAnak.length = 0;
  series_anak.forEach((series) => {
    seriesPieAnak.push(series);
  });

  labelsPieAnak.length = 0;
  labels_anak.forEach((labels) => {
    labelsPieAnak.push(labels);
  });

  loadPieChart();
  //////////////// end anak ////////////////
};
////////////////////////////  end pie chart ////////////////////////////

function loadChart() {
  chart.render();
}

function loadPieChart() {
  chartpie_wanita.render();
  chartpie_pria.render();
  chartpie_anak.render();
  // chartpie_wanita.render();
}