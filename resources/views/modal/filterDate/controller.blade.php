<link rel="stylesheet" href="{{ asset('css/Datepicker.css') }}">
<script src="{{ asset('js/DatePicker.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
<script>
    function showModalFilter() {
        $("#bg_modal").removeClass("pointer-events-none");
        $("#bg_modal").addClass("opacity-50");
        $("#bg_modal").removeClass("opacity-0");

        $("#konten_modal").addClass("scale-100");
        $("#konten_modal").removeClass("scale-0");
    }

    function closeModalFilter() {
        $("#bg_modal").addClass("pointer-events-none");
        $("#bg_modal").removeClass("opacity-50");
        $("#bg_modal").addClass("opacity-0");

        $("#konten_modal").removeClass("scale-100");
        $("#konten_modal").addClass("scale-0");
    }

    datenow = new Date();
    var selectedTab = 'harian';
    const pilihan = ['harian', 'mingguan', 'bulanan', 'tahunan', 'range'];
    const Bulan = (datenow.getMonth() + 1).toString().length === 1 ? "0" + (datenow.getMonth() + 1).toString() : (
        datenow.getMonth() + 1).toString()
    const Tanggal = (datenow.getDate()).toString().length === 1 ? "0" + (datenow.getDate()).toString() : (datenow
        .getDate()).toString()

    var selectedFilterHarian = datenow.getFullYear() + '-' + Bulan + '-' + Tanggal
    var selectedFilterMingguan = datenow.getFullYear() + '-' + Bulan + '-' + Tanggal

    function setBulanan(){
        selectedTab = 'bulanan';
    }

    function clickTab(name) {
        for (let index = 0; index < pilihan.length; index++) {
            const element = pilihan[index];
            $('#div-' + element).addClass('hidden');
            $('#div-' + element).removeClass('flex');
            $('#' + element).addClass('hover:bg-gray-200');
            $('#' + element).removeClass('text-primary');
        }

        $('#' + name).addClass('text-primary');
        $('#' + name).removeClass('hover:bg-gray-200');
        $('#div-' + name).removeClass('hidden');
        $('#div-' + name).addClass('flex');
        selectedTab = name;
        // console.log('#' + name);
    }

    const hari = document.getElementById('div-harian');
    const datepicker_hari = new Datepicker(hari, {
        todayHighlight: true,
        endDate: '+367d',
        calendarWeeks: true,
        weekStart: 0,
        // ...options
    });

    hari.addEventListener('changeDate', function(evt) {
        dateharian = new Date(evt.detail.date);

        const Bulan = (dateharian.getMonth() + 1).toString().length === 1 ? "0" + (dateharian.getMonth() + 1)
            .toString() : (dateharian.getMonth() + 1).toString()
        const Tanggal = (dateharian.getDate()).toString().length === 1 ? "0" + (dateharian.getDate())
            .toString() : (dateharian.getDate()).toString()

        selectedFilterHarian = dateharian.getFullYear() + '-' + Bulan + '-' + Tanggal;

        // alert(ateharian.getFullYear() + '-' + (dateharian.getMonth() + 1) + '-' + dateharian.getDate());

    });

    const minggu = document.getElementById('div-mingguan');
    const datepicker_minggu = new Datepicker(minggu, {
        todayHighlight: true,
        endDate: '+367d',
        calendarWeeks: true,
        weekStart: 0,

        // ...options
    });

    minggu.addEventListener('changeDate', function(evt) {
        datemingguan = new Date(evt.detail.date);
        const Bulan = (datemingguan.getMonth() + 1).toString().length === 1 ? "0" + (datemingguan.getMonth() +
                1)
            .toString() : (datemingguan.getMonth() + 1).toString()
        const Tanggal = (datemingguan.getDate()).toString().length === 1 ? "0" + (datemingguan.getDate())
            .toString() : (datemingguan.getDate()).toString()

        selectedFilterMingguan = datemingguan.getFullYear() + '-' + Bulan + '-' + Tanggal;
        // alert(ateharian.getFullYear() + '-' + (dateharian.getMonth() + 1) + '-' + dateharian.getDate());
    });

    function getDataFilter() {

        // console.log(selectedFilterHarian)
        if (selectedTab === 'harian') {
            const data = {
                type: 'harian',
                data: selectedFilterHarian
            }
            return btoa(JSON.stringify(data));

        } else if (selectedTab === 'mingguan') {
            const data = {
                type: 'mingguan',
                data: selectedFilterMingguan
            }
            return btoa(JSON.stringify(data));

        } else if (selectedTab === 'bulanan') {
            const bulan = $('#filterbulanan_bulan option:selected').val();
            const tahun = $('#filterbulanan_tahun option:selected').val();

            const data = {
                type: 'bulanan',
                data: {
                    bulan: bulan,
                    tahun: tahun
                }
            }
            return btoa(JSON.stringify(data));

        } else if (selectedTab === 'tahunan') {
            const tahun = $('#filtertahunan_tahun option:selected').val();
            const data = {
                type: 'tahunan',
                data: {
                    tahun: tahun
                }
            }
            return btoa(JSON.stringify(data));

        } else if (selectedTab === 'range') {
            const date_awal = $('#filter_range_awal').val();
            const date_akhir = $('#filter_range_akhir').val();

            const validate = (message) => {
                Swal.fire("Informasi", message, "warning")
            }

            if (date_awal.length === 0 && date_akhir.length === 0) {
                validate('harap masukkan tanggal awal dan akhir')
                return false;
            } else if (date_awal.length === 0) {
                validate('harap masukkan tanggal awal')
                return false;
            } else if (date_akhir.length === 0) {
                validate('harap masukkan tanggal akhir')
                return false;
            }

            const data = {
                type: 'range',
                data: {
                    awal: date_awal,
                    akhir: date_akhir
                }
            }
            return btoa(JSON.stringify(data));
        }
    }
</script>
