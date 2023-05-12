<script>
    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

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

        console.log(selectedFilterMingguan);
        // alert(ateharian.getFullYear() + '-' + (dateharian.getMonth() + 1) + '-' + dateharian.getDate());
    });

    // Detail Transaksi

    function showModalDetail(data) {
        console.log(data);

        $("#txt_notransaksi").html(data.kode_tr);
        $("#txt_kasir").html(data.nama_kasir);
        $("#txt_tanggal").html(data.tanggal);

        $("#txt_jenis_pembayaran").html(data.jenis_pembayaran);


        if (data.voucher == null) {
            $("#txt_harga_final").html(formatRupiah(data.total.toString(), "Rp. "));
            $("#txt_voucher").html("-");
        } else {
            $("#txt_harga_final").html(formatRupiah((data.total - data.voucher).toString(), "Rp. "));
            $("#txt_voucher").html(formatRupiah(data.voucher.toString(), "Rp. "));
        }

        $("#txt_total").html(formatRupiah(data.total.toString(), "Rp. "));
        $("#txt_bayar").html(formatRupiah(data.bayar.toString(), "Rp. "));
        $("#txt_kembalian").html(formatRupiah(data.kembalian.toString(), "Rp. "));

        var kontenHtml = '';
        data.detail_transaksi.forEach(element => {
            // console.log(element.detail_diskon_transaksi.free_product);
            kontenHtml += "<tr>";
            kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">' + element.barang.nama_br + '</td>';
            kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">' + formatRupiah(element.barang.harga
                .toString(),
                "Rp. ") + '</td>';

            if (element.detail_diskon_transaksi == null) {
                kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">-</td>';
            } else {
                if (element.detail_diskon_transaksi.free_product == null) {
                    kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">' + formatRupiah(element
                        .detail_diskon_transaksi.nominal.toString(), "Rp. ") + '</td>';
                } else {
                    kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">Beli ' + element
                        .detail_diskon_transaksi.buy + ' Free ' + element.detail_diskon_transaksi.free +
                        '</td>';
                }
            }
            kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">' + element.QTY + '</td>';
            kontenHtml += '<td class="tracking-wide px-4 py-2 text-left">' + formatRupiah(element.subtotal
                .toString(),
                "Rp. ") + '</td>';
            kontenHtml += '</tr>';
        });

        $("#konten_detail_transaksi").html(kontenHtml);


        $("#bg_modal_detail").removeClass("pointer-events-none");
        $("#bg_modal_detail").addClass("opacity-50");
        $("#bg_modal_detail").removeClass("opacity-0");

        $("#konten_modal_detail").addClass("scale-100");
        $("#konten_modal_detail").removeClass("scale-0");
    }

    function closeModalDetail() {
        $("#bg_modal_detail").addClass("pointer-events-none");
        $("#bg_modal_detail").removeClass("opacity-50");
        $("#bg_modal_detail").addClass("opacity-0");

        $("#konten_modal_detail").removeClass("scale-100");
        $("#konten_modal_detail").addClass("scale-0");

    }

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

    $("#btn_submit").click(function (e) { 
        e.preventDefault();
        
    });
</script>
