<script>
    function showModal() {
        $("#bg_modal").removeClass("pointer-events-none");
        $("#bg_modal").addClass("opacity-50");
        $("#bg_modal").removeClass("opacity-0");

        $("#konten_modal").addClass("scale-100");
        $("#konten_modal").removeClass("scale-0");
    }

    function closeModal() {
        $("#bg_modal").addClass("pointer-events-none");
        $("#bg_modal").removeClass("opacity-50");
        $("#bg_modal").addClass("opacity-0");

        $("#konten_modal").removeClass("scale-100");
        $("#konten_modal").addClass("scale-0");

    }

    datenow = new Date();
    var selectedTab = 'harian';
    const pilihan = ['harian', 'mingguan', 'bulanan', 'tahunan', 'range'];
    var selectedFilterHarian = datenow.getFullYear() + '-' + (datenow.getMonth() + 1) + '-' + datenow.getDate();
    var selectedFilterMingguan = datenow.getFullYear() + '-' + (datenow.getMonth() + 1) + '-' + datenow.getDate();

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
        selectedFilterHarian = dateharian.getFullYear() + '-' + (dateharian.getMonth() + 1) + '-' + dateharian
            .getDate();

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
        selectedFilterMingguan = datemingguan.getFullYear() + '-' + (datemingguan.getMonth() + 1) + '-' +
            datemingguan.getDate();
        // alert(ateharian.getFullYear() + '-' + (dateharian.getMonth() + 1) + '-' + dateharian.getDate());
    });
</script>
