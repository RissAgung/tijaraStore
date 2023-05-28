<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^\d]/g, "").toString(),
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

    const showModalTambah = () => {
        $("#bg_modal_tambah").removeClass("pointer-events-none");
        $("#bg_modal_tambah").addClass("opacity-50");
        $("#bg_modal_tambah").removeClass("opacity-0");

        $("#konten_modal_tambah").addClass("scale-100");
        $("#konten_modal_tambah").removeClass("scale-0");
    }

    const closeModalTambah = () => {
        $("#bg_modal_tambah").addClass("pointer-events-none");
        $("#bg_modal_tambah").removeClass("opacity-50");
        $("#bg_modal_tambah").addClass("opacity-0");

        $("#konten_modal_tambah").removeClass("scale-100");
        $("#konten_modal_tambah").addClass("scale-0");
    }

    const showModalUbah = (item) => {

        try {
            $("#txt_kode_voucher_update").val(item.kode_voucher);
            $("#txt_nama_update").val(item.nama_voucher);
            $("#jenis_voucher_update").val(item.kategori);
            if (item.kategori == 'nominal') {
                $("#txt_nominal_update").val(formatRupiah(item.nominal.toString()));
            } else {
                $("#txt_nominal_update").val(formatRupiah(item.nominal.toString()));
            }
        } catch (error) {

        }


        $("#bg_modal_update").removeClass("pointer-events-none");
        $("#bg_modal_update").addClass("opacity-50");
        $("#bg_modal_update").removeClass("opacity-0");

        $("#konten_modal_update").addClass("scale-100");
        $("#konten_modal_update").removeClass("scale-0");
    }

    const closeModalUbah = () => {
        $('.label-error').addClass('hidden');

        $("#bg_modal_update").addClass("pointer-events-none");
        $("#bg_modal_update").removeClass("opacity-50");
        $("#bg_modal_update").addClass("opacity-0");

        $("#konten_modal_update").removeClass("scale-100");
        $("#konten_modal_update").addClass("scale-0");
    }

    $("#btn_submit").click(function(e) {
        e.preventDefault();
        let isError = {};

        if ($("#txt_kode_voucher").val() == "") {
            isError = {
                "status": true,
                "message": "Kode voucher tidak boleh kosong",
            };
        } else if ($("#txt_nama").val() == "") {
            isError = {
                "status": true,
                "message": "Nama voucher tidak boleh kosong",
            };
        } else if ($("#jenis_voucher").val() == "") {
            isError = {
                "status": true,
                "message": "Jenis voucher tidak boleh kosong",
            };
        } else if ($("#txt_nominal").val() == "") {
            isError = {
                "status": true,
                "message": "Nominal tidak boleh kosong",
            };
        }

        if (isError.status) {
            Swal.fire({
                title: "Informasi",
                text: isError.message,
                icon: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Ya",
            });
        } else {
            Swal.fire({
                title: "Tambah Data",
                text: "Apakah anda yakin ingin menambah data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonText: "Tidak",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form_voucher").trigger("submit");
                }
            });
        }
    });

    $("#btn_submit_update").click(function(e) {
        e.preventDefault();
        let isError = {};

        if ($("#txt_kode_voucher_update").val() == "") {
            isError = {
                "status": true,
                "message": "Kode voucher tidak boleh kosong",
            };
        } else if ($("#txt_nama_update").val() == "") {
            isError = {
                "status": true,
                "message": "Nama voucher tidak boleh kosong",
            };
        } else if ($("#jenis_voucher_update").val() == "") {
            isError = {
                "status": true,
                "message": "Jenis voucher tidak boleh kosong",
            };
        } else if ($("#txt_nominal_update").val() == "") {
            isError = {
                "status": true,
                "message": "Nominal tidak boleh kosong",
            };
        }

        if (isError.status) {
            Swal.fire({
                title: "Informasi",
                text: isError.message,
                icon: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Ya",
            });
        } else {
            Swal.fire({
                title: "Ubah Data",
                text: "Apakah anda yakin ingin mengubah data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonText: "Tidak",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form_voucher_update").trigger("submit");
                }
            });
        }



    });

    var selected_jenis = 'persen';
    var selected_jenis_update = 'persen';

    $("#jenis_voucher").change(function(e) {
        e.preventDefault();
        if ($("#jenis_voucher").val() == 'persen') {
            selected_jenis = 'persen';
            $("#txt_nominal").val("");
            $("#txt_nominal").attr('maxlength', '2');
        } else {
            selected_jenis = 'nominal'
            $("#txt_nominal").val("");
            $("#txt_nominal").attr('maxlength', '13');

        }
    });

    $("#txt_nominal").keyup(function(e) {
        if (selected_jenis == 'persen') {
            $("#txt_nominal").val(formatRupiah(this.value));
        } else {
            $("#txt_nominal").val(formatRupiah(this.value));
        }
    });

    $("#jenis_voucher_update").change(function(e) {
        e.preventDefault();
        if ($("#jenis_voucher_update").val() == 'persen') {
            selected_jenis_update = 'persen';
            $("#txt_nominal_update").val("");
            $("#txt_nominal_update").attr('maxlength', '2');
        } else {
            selected_jenis_update = 'nominal'
            $("#txt_nominal_update").val("");
            $("#txt_nominal_update").attr('maxlength', '13');

        }
    });

    $("#txt_nominal_update").keyup(function(e) {
        if (selected_jenis_update == 'persen') {
            $("#txt_nominal_update").val(formatRupiah(this.value));
        } else {
            $("#txt_nominal_update").val(formatRupiah(this.value));
        }
    });

    $("#checkAll").change(function(e) {
        e.preventDefault();
        $(".idcheck").prop("checked", $(this).prop("checked"));
    });

    $("#btn_hapus").click(function(e) {
        e.preventDefault();
        var checkedCount = $(".idcheck:checked").length;
        if (checkedCount == 0) {
            Swal.fire("Informasi", "Pilih data yang ingin dihapus", "warning");
        } else {
            Swal.fire({
                title: "Hapus Data",
                text: "Apakah anda yakin ingin menghapus data yang dipilih?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonText: "Tidak",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form_delete").trigger("submit");
                }
            });
        }
    });

    const hapusData = (url) => {
        Swal.fire({
            title: "Hapus Data",
            text: "Apakah anda yakin ingin menghapus data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tidak",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = window.location.origin + url;
            }
        });
    };

    $(document).keyup(function(event) {
        if ($('#keyword').is(":focus") && event.key == "Enter") {
            location.replace('/voucher/search/' + $("#keyword").val());
        }
    });

    //filter kategori
    $("#filter_kategori").change(function(e) {
        e.preventDefault();
        location.replace('/voucher/filter/' + $("#filter_kategori").val());
    });
</script>
