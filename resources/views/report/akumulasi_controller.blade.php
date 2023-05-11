<script>
    $(document).ready(async function() {
        await loadChart();
        await loadDefaultSeries();
        await loadPieChart()
    });


    ////////////////////////////////// CHART //////////////////////////////////

    function loadChart() {
        chart.render();
        // chartpie.render();
    }

    function loadPieChart() {
        chartpie.render();
    }

    var dataPemasukan = []

    function getSeriesPenjualan() {
        return [{
            name: 'Pemasukkan',
            data: dataPemasukan,
        }];
    }

    async function loadDefaultSeries() {
        await $.ajax({
            type: "GET",
            url: "{{ route('getAkumulasi') }}",
            success: function(res) {
                const data = JSON.parse(res);
                dataPemasukan = data.data;
                options.xaxis.categories = data.bulan;
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

    var divChart = document.getElementById("container_pie_chart").getBoundingClientRect();
    var heightPenjualan = divChart.height - 10;
    var widthPenjualan = divChart.width - 10;

    var optionspieframe = {
        redrawOnWindowResize: true,
        chart: {
            height: (heightPenjualan),
            width: (widthPenjualan),
            type: 'pie',

        },
        title: {
            text: 'Produk Terjual',
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
        labels: ['bintang', 'kontol', 'memek', 'pokeh', 'plerrrr', 'blok awoakwokoawkow'],
        // series: getSeriesPie(),
        series: [30, 40, 90, 80, 60, 20],

    }

    var seriesPie = [];

    function getSeriesPie() {
        return seriesPie;
    }

    var chartpie = new ApexCharts(document.querySelector("#pie_chart"), optionspieframe);
</script>
