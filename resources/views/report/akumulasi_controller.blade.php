<script>
    $(document).ready(async function() {
        await loadChart();
        await loadDefaultSeries();
        await loadDefaultPie();
    });


    ////////////////////////////////// CHART //////////////////////////////////

    function loadChart() {
        chart.render();
        // chartpie.render();
    }

    function loadPieChart() {
        chartpie_wanita.render();
        chartpie_pria.render();
        chartpie_anak.render();
    }

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

    var totalPemasukan = 0;
    var totalPengeluaran = 0;

    var getTotalPemasukan = () => {
      return totalPemasukan;
    }

    var getTotalPengeluaran = () => {
      return totalPengeluaran;
    }

    async function loadDefaultSeries(data = null) {
        await $.ajax({
            type: "GET",
            data: {
                data_date: data,
            },
            url: "{{ route('getAkumulasi') }}",
            success: function(res) {
                const data = JSON.parse(res);
                dataPemasukan = data.data;
                dataPengeluaran = data.data_pengeluaran;
                options.xaxis.categories = data.label;
                console.log(data);

                var total = 0;
                var total_pengeluaran = 0;

                for (var index = 0; index < dataPemasukan.length; index++) {
                    total += parseInt(dataPemasukan[index]);
                }

                for (var index = 0; index < dataPengeluaran.length; index++) {
                    total_pengeluaran += parseInt(dataPengeluaran[index]);
                }

                totalPemasukan = total;
                totalPengeluaran = total_pengeluaran;

                $('#value_pemasukan').html(formatRupiah(String(total), 'Rp. '));
                $('#value_pengeluaran').html(formatRupiah(String(total_pengeluaran), 'Rp. '));
            }

        });
        chart.updateOptions(options);
        chart.updateSeries(getSeriesPenjualan(), true);
        // console.log("pal adwbjawgdagd")
    }


    var divChart = document.getElementById("container_chart").getBoundingClientRect();
    var chartWidth = divChart.width * 0.9;
    var chartHight = divChart.height * 0.8;

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
            show: true,

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
            text: 'Akumulasi tahun ini',
            align: 'left',
            margin: 60,
            offsetX: 0,
            offsetY: -20,
            floating: true,
            style: {
                fontSize: '19px',
                fontWeight: 'bold',
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
                formatter: function(val) {
                    return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
            }
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
            }
        },

        series: [{
                name: "",
                data: []
            },
            {
                name: "",
                data: []
            }
        ],
        stroke: {
            colors: ["transparent"],
            width: 2
        },

        colors: ['#FFB015', '#000000'],

        xaxis: {
            type: 'category',
            categories: [],
            labels: {
                show: true,
            },
            rotateLabels: 0,
        }

    }
    var chart = new ApexCharts(document.querySelector("#chart"), options);


    ////////////////////////////////// PIE CHART //////////////////////////////////

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

    async function loadDefaultPie(data = null) {

        await $.ajax({
            type: "GET",
            data: {
                data_date: data,
            },
            url: "{{ route('getPieChart') }}",
            success: function(res) {
                const data = JSON.parse(res);
                console.log(data)

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

                console.log(getLabelsPieWanita())
                console.log(getSeriesPieWanita())
                //////////////// end anak ////////////////

            }



        });

        // chartpie_wanita.updateOptions({
        //     labels: getLabelsPieWanita(),
        //     series: getSeriesPieWanita()
        // });
        await loadPieChart();
    }

    var divChart = document.getElementById("container_pie_chart").getBoundingClientRect()
    var heightPenjualan = divChart.height;
    var widthPenjualan = divChart.width;

    var optionspie_wanita = {
        redrawOnWindowResize: true,
        chart: {
            height: (heightPenjualan),
            width: (widthPenjualan),
            type: 'pie',

        },
        title: {
            text: 'Produk Wanita',
            align: 'center',
            margin: 60,
            offsetX: 0,
            offsetY: -20,
            floating: true,
            style: {
                fontSize: '19px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: '#263238'
            },
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
        title: {
            text: 'Produk Pria',
            align: 'center',
            margin: 60,
            offsetX: 0,
            offsetY: -20,
            floating: true,
            style: {
                fontSize: '19px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: '#263238'
            },
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
        title: {
            text: 'Produk Anak',
            align: 'center',
            margin: 60,
            offsetX: 0,
            offsetY: -20,
            floating: true,
            style: {
                fontSize: '19px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: '#263238'
            },
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
</script>
