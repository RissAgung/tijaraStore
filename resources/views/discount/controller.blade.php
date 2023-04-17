<script>
    if ($("#jenis_discount").val() == "persen") {
        $("#txt_nominal").val("");
        $("#txt_nominal").attr("maxlength", 3);
        $("#container-jumlah").addClass("hidden");
        $("#container-free-product").addClass("hidden");
        $("#container-jumlah").removeClass("flex");
        $("#container-free-product").removeClass("flex");

        $("#container-nominal").addClass("flex");
        $("#container-nominal").removeClass("hidden");

    } else if ($("#jenis_discount").val() == "nominal") {
        $("#txt_nominal").val("");
        $("#txt_nominal").attr("maxlength", 15);
        $("#container-jumlah").addClass("hidden");
        $("#container-free-product").addClass("hidden");
        $("#container-jumlah").removeClass("flex");
        $("#container-free-product").removeClass("flex");

        $("#container-nominal").addClass("flex");
        $("#container-nominal").removeClass("hidden");
    } else {
        $("#container-jumlah").removeClass("hidden");
        $("#container-free-product").removeClass("hidden");
        $("#container-jumlah").addClass("flex");
        $("#container-free-product").addClass("flex");

        $("#container-nominal").removeClass("flex");
        $("#container-nominal").addClass("hidden");
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

    $("#jenis_discount").change(function(e) {
        e.preventDefault();
        if ($("#jenis_discount").val() == "persen") {
            $("#txt_nominal").val("");
            $("#txt_nominal").attr("maxlength", 3);
            $("#container-jumlah").addClass("hidden");
            $("#container-free-product").addClass("hidden");
            $("#container-jumlah").removeClass("flex");
            $("#container-free-product").removeClass("flex");

            $("#container-nominal").addClass("flex");
            $("#container-nominal").removeClass("hidden");

        } else if ($("#jenis_discount").val() == "nominal") {
            $("#txt_nominal").val("");
            $("#txt_nominal").attr("maxlength", 15);
            $("#container-jumlah").addClass("hidden");
            $("#container-free-product").addClass("hidden");
            $("#container-jumlah").removeClass("flex");
            $("#container-free-product").removeClass("flex");

            $("#container-nominal").addClass("flex");
            $("#container-nominal").removeClass("hidden");
        } else {
            $("#container-jumlah").removeClass("hidden");
            $("#container-free-product").removeClass("hidden");
            $("#container-jumlah").addClass("flex");
            $("#container-free-product").addClass("flex");

            $("#container-nominal").removeClass("flex");
            $("#container-nominal").addClass("hidden");
        }
    });

    var dataProduct = [];
    var kontenData = "";
    var selectedTab = "pria";
    var selectedProduct = {};

    const setProduct = (kode, nama) => {
        selectedProduct = {
            'nama': nama,
            'kode': kode
        }
        $("#txt_product").val(selectedProduct.nama);
        $("#txt_kode").val(selectedProduct.kode);
        closeModalData();
    }

    const showData = (param) => {
        switch (param) {
            case "pria":
                selectedTab = "pria"
                if (dataProduct[0].length === 0) {
                    $("#nodata").removeClass("hidden");
                    $("#nodata").addClass("flex");

                    $("#konten-data").addClass("hidden");
                    $("#konten-data").removeClass("flex");
                } else {
                    $("#nodata").addClass("hidden");
                    $("#nodata").removeClass("flex");

                    $("#konten-data").removeClass("hidden");
                    $("#konten-data").addClass("flex");
                    for (let index = 0; index < dataProduct[0].length; index++) {
                        const element = dataProduct[0][index];
                        kontenData +=
                            '<div class="flex flex-row justify-between items-center w-full hover:bg-slate-100 rounded-md py-2 px-4">';
                        kontenData += '<p>' + element.nama_br + '</p>'
                        kontenData +=
                            '<div onclick="setProduct(`' + element.kode_br + '`, `' + element.nama_br +
                            '`)" class="bg-primary py-2 px-2 rounded-md flex justify-center drop-shadow-sm">'
                        kontenData +=
                            '<svg class="mt-0" width="12" height="12" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.497057 7.69705C0.497055 8.35979 1.03432 8.89705 1.69706 8.89705L6.49706 8.89705L6.49706 13.697C6.49706 14.3598 7.03432 14.8971 7.69704 14.897C8.35977 14.897 8.89702 14.3598 8.89704 13.697L8.89706 8.89705L13.697 8.89704C14.3598 8.89699 14.8971 8.35973 14.8971 7.69703C14.8971 7.03433 14.3598 6.49707 13.6971 6.49704L8.89705 6.49705L8.89707 1.69704C8.89705 1.03432 8.35979 0.497062 7.69707 0.497041C7.03435 0.497022 6.49709 1.03428 6.49706 1.69705L6.49706 6.49705L1.69705 6.49705C1.03431 6.49706 0.497059 7.03431 0.497057 7.69705Z" fill="black" /></svg>'
                        kontenData += '</div></div>'
                    }
                }
                break;
            case "wanita":
                selectedTab = "wanita"
                if (dataProduct[1].length === 0) {
                    $("#nodata").removeClass("hidden");
                    $("#nodata").addClass("flex");

                    $("#konten-data").addClass("hidden");
                    $("#konten-data").removeClass("flex");
                } else {
                    $("#nodata").addClass("hidden");
                    $("#nodata").removeClass("flex");

                    $("#konten-data").removeClass("hidden");
                    $("#konten-data").addClass("flex");

                    for (let index = 0; index < dataProduct[1].length; index++) {
                        const element = dataProduct[1][index];
                        kontenData +=
                            '<div class="flex flex-row justify-between items-center w-full hover:bg-slate-100 rounded-md py-2 px-4">';
                        kontenData += '<p>' + element.nama_br + '</p>'
                        kontenData +=
                            '<div onclick="setProduct(`' + element.kode_br + '`, `' + element.nama_br +
                            '`)" class="bg-primary py-2 px-2 rounded-md flex justify-center drop-shadow-sm">'
                        kontenData +=
                            '<svg class="mt-0" width="12" height="12" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.497057 7.69705C0.497055 8.35979 1.03432 8.89705 1.69706 8.89705L6.49706 8.89705L6.49706 13.697C6.49706 14.3598 7.03432 14.8971 7.69704 14.897C8.35977 14.897 8.89702 14.3598 8.89704 13.697L8.89706 8.89705L13.697 8.89704C14.3598 8.89699 14.8971 8.35973 14.8971 7.69703C14.8971 7.03433 14.3598 6.49707 13.6971 6.49704L8.89705 6.49705L8.89707 1.69704C8.89705 1.03432 8.35979 0.497062 7.69707 0.497041C7.03435 0.497022 6.49709 1.03428 6.49706 1.69705L6.49706 6.49705L1.69705 6.49705C1.03431 6.49706 0.497059 7.03431 0.497057 7.69705Z" fill="black" /></svg>'
                        kontenData += '</div></div>'
                    }
                }
                break;
            case "anak":
                selectedTab = "anak"
                if (dataProduct[2].length === 0) {
                    $("#nodata").removeClass("hidden");
                    $("#nodata").addClass("flex");

                    $("#konten-data").addClass("hidden");
                    $("#konten-data").removeClass("flex");
                } else {
                    $("#nodata").addClass("hidden");
                    $("#nodata").removeClass("flex");

                    $("#konten-data").removeClass("hidden");
                    $("#konten-data").addClass("flex");

                    for (let index = 0; index < dataProduct[2].length; index++) {
                        const element = dataProduct[2][index];
                        kontenData +=
                            '<div class="flex flex-row justify-between items-center w-full hover:bg-slate-100 rounded-md py-2 px-4">';
                        kontenData += '<p>' + element.nama_br + '</p>'
                        kontenData +=
                            '<div onclick="setProduct(`' + element.kode_br + '`, `' + element.nama_br +
                            '`)" class="bg-primary py-2 px-2 rounded-md flex justify-center drop-shadow-sm">'
                        kontenData +=
                            '<svg class="mt-0" width="12" height="12" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.497057 7.69705C0.497055 8.35979 1.03432 8.89705 1.69706 8.89705L6.49706 8.89705L6.49706 13.697C6.49706 14.3598 7.03432 14.8971 7.69704 14.897C8.35977 14.897 8.89702 14.3598 8.89704 13.697L8.89706 8.89705L13.697 8.89704C14.3598 8.89699 14.8971 8.35973 14.8971 7.69703C14.8971 7.03433 14.3598 6.49707 13.6971 6.49704L8.89705 6.49705L8.89707 1.69704C8.89705 1.03432 8.35979 0.497062 7.69707 0.497041C7.03435 0.497022 6.49709 1.03428 6.49706 1.69705L6.49706 6.49705L1.69705 6.49705C1.03431 6.49706 0.497059 7.03431 0.497057 7.69705Z" fill="black" /></svg>'
                        kontenData += '</div></div>'
                    }
                }
                break;
        }


        $("#konten-data").html(kontenData);
        kontenData = ""
    }

    const toggleTab = (param) => {
        if (param == "pria") {
            $("#label-pria").addClass("text-black");
            $("#label-pria").removeClass("text-[#8F8F8F]");

            $("#label-wanita").removeClass("text-black");
            $("#label-wanita").addClass("text-[#8F8F8F]");

            $("#label-anak").removeClass("text-black");
            $("#label-anak").addClass("text-[#8F8F8F]");

            $("#selectedTabTag").removeClass("translate-x-[115px] w-[50px]");
            $("#selectedTabTag").removeClass("translate-x-[45px] w-[65px]");
            $("#selectedTabTag").addClass("translate-x-0 w-[35px]");
        } else if (param == "wanita") {
            $("#label-wanita").addClass("text-black");
            $("#label-wanita").removeClass("text-[#8F8F8F]");

            $("#label-pria").removeClass("text-black");
            $("#label-pria").addClass("text-[#8F8F8F]");

            $("#label-anak").removeClass("text-black");
            $("#label-anak").addClass("text-[#8F8F8F]");

            $("#selectedTabTag").removeClass("translate-x-0 w-[35px]");
            $("#selectedTabTag").removeClass("translate-x-[115px] w-[50px]");
            $("#selectedTabTag").addClass("translate-x-[45px] w-[65px]");
        } else {
            $("#label-anak").addClass("text-black");
            $("#label-anak").removeClass("text-[#8F8F8F]");

            $("#label-pria").removeClass("text-black");
            $("#label-pria").addClass("text-[#8F8F8F]");

            $("#label-wanita").removeClass("text-black");
            $("#label-wanita").addClass("text-[#8F8F8F]");

            $("#selectedTabTag").removeClass("translate-x-0 w-[35px]");
            $("#selectedTabTag").removeClass("translate-x-[45px] w-[65px]");
            $("#selectedTabTag").addClass("translate-x-[115px] w-[50px]");
        }
        showData(param);
    }

    $("#form_search").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/api/product/nodiscount?search=" + $("#field_search").val(),
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading',
                    html: '<div class="body-loading"><div class="loadingspinner"></div></div>', // add html attribute if you want or remove
                    allowOutsideClick: false,
                    showConfirmButton: false,

                });
            },
            success: function(response) {
                swal.close();
                dataProduct = response;
                showData(selectedTab)
            }
        });

    });


    // show data
    const showDataProduct = () => {
        $.ajax({
            type: "GET",
            url: "/api/product/nodiscount",
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading',
                    html: '<div class="body-loading"><div class="loadingspinner"></div></div>', // add html attribute if you want or remove
                    allowOutsideClick: false,
                    showConfirmButton: false,

                });
            },
            success: function(response) {
                swal.close();
                dataProduct = response;
                showData("pria");
                showModalData();
                // console.log(dataProduct);
            }
        });
    }

    const showModalData = () => {
        $("#bg_modal_data").removeClass("pointer-events-none");
        $("#bg_modal_data").addClass("opacity-50");
        $("#bg_modal_data").removeClass("opacity-0");

        $("#konten_modal_data").addClass("scale-100");
        $("#konten_modal_data").removeClass("scale-0");
    }

    const closeModalData = () => {
        $("#bg_modal_data").addClass("pointer-events-none");
        $("#bg_modal_data").removeClass("opacity-50");
        $("#bg_modal_data").addClass("opacity-0");

        $("#konten_modal_data").removeClass("scale-100");
        $("#konten_modal_data").addClass("scale-0");

        $("#field_search").val("");
        toggleTab("pria");
    }

    $("#btn_submit").click(function(e) {
        e.preventDefault();
        let isError = {};
        if ($("#jenis_discount").val() == "persen") {
            if ($("#txt_product").val() == "") {
                isError = {
                    "status": true,
                    "message": "Product tidak boleh kosong",
                };
            } else if ($("#txt_nominal").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field nominal tidak boleh kosong",
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
                    title: "Informasi",
                    text: "Apakah anda yakin ingin menambah diskon?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: "Tidak",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_discount").trigger("submit");
                    }
                });
            }

        } else if ($("#jenis_discount").val() == "nominal") {
            if ($("#txt_product").val() == "") {
                isError = {
                    "status": true,
                    "message": "Product tidak boleh kosong",
                };
            } else if ($("#txt_nominal").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field nominal tidak boleh kosong",
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
                    title: "Informasi",
                    text: "Apakah anda yakin ingin menambah diskon?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: "Tidak",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_discount").trigger("submit");
                    }
                });
            }
        } else {
            if ($("#txt_product").val() == "") {
                isError = {
                    "status": true,
                    "message": "Product tidak boleh kosong",
                };
            } else if (!$("#bebas").is(":checked") && !$("#sama").is(":checked")) {
                isError = {
                    "status": true,
                    "message": "Field jenis free tidak boleh kosong",
                };
            } else if ($("#txt_beli").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field beli tidak boleh kosong",
                };
            } else if ($("#txt_gratis").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field gratis tidak boleh kosong",
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
                    title: "Informasi",
                    text: "Apakah anda yakin ingin menambah diskon?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: "Tidak",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_discount").trigger("submit");
                    }
                });
            }
        }
    });

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


    $("#txt_nominal").keyup(function(e) {
        $("#txt_nominal").val(formatRupiah(this.value));
    });


    // Ubah Data
    $("#txt_nominal_update").keyup(function(e) {
        $("#txt_nominal_update").val(formatRupiah(this.value));
    });

    $("#btn_submit_update").click(function(e) {
        e.preventDefault();
        let isError = {};
        if ($("#jenis_discount_update").val() == "persen") {
            if ($("#txt_product_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Product tidak boleh kosong",
                };
            } else if ($("#txt_nominal_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field nominal tidak boleh kosong",
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
                    title: "Informasi",
                    text: "Apakah anda yakin ingin mengubah diskon?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: "Tidak",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_discount_ubah").trigger("submit");
                    }
                });
            }

        } else if ($("#jenis_discount_update").val() == "nominal") {
            if ($("#txt_product_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Product tidak boleh kosong",
                };
            } else if ($("#txt_nominal_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field nominal tidak boleh kosong",
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
                    title: "Informasi",
                    text: "Apakah anda yakin ingin mengubah diskon?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: "Tidak",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_discount_ubah").trigger("submit");
                    }
                });
            }
        } else {
            if ($("#txt_product_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Product tidak boleh kosong",
                };
            } else if (!$("#bebas_update").is(":checked") && !$("#sama_update").is(":checked")) {
                isError = {
                    "status": true,
                    "message": "Field jenis free tidak boleh kosong",
                };
            } else if ($("#txt_beli_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field beli tidak boleh kosong",
                };
            } else if ($("#txt_gratis_update").val() == "") {
                isError = {
                    "status": true,
                    "message": "Field gratis tidak boleh kosong",
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
                    title: "Informasi",
                    text: "Apakah anda yakin ingin mengubah diskon?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonText: "Tidak",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_discount_ubah").trigger("submit");
                    }
                });
            }
        }
    });

    if ($("#jenis_discount_update").val() == "persen") {
        $("#txt_nominal_update").val("");
        $("#txt_nominal_update").attr("maxlength", 3);
        $("#container-jumlah_update").addClass("hidden");
        $("#container-free-product_update").addClass("hidden");
        $("#container-jumlah_update").removeClass("flex");
        $("#container-free-product_update").removeClass("flex");

        $("#container-nominal_update").addClass("flex");
        $("#container-nominal_update").removeClass("hidden");

    } else if ($("#jenis_discount_update").val() == "nominal") {
        $("#txt_nominal_update").val("");
        $("#txt_nominal_update").attr("maxlength", 15);
        $("#container-jumlah_update").addClass("hidden");
        $("#container-free-product_update").addClass("hidden");
        $("#container-jumlah_update").removeClass("flex");
        $("#container-free-product_update").removeClass("flex");

        $("#container-nominal_update").addClass("flex");
        $("#container-nominal_update").removeClass("hidden");
    } else {
        $("#container-jumlah_update").removeClass("hidden");
        $("#container-free-product_update").removeClass("hidden");
        $("#container-jumlah_update").addClass("flex");
        $("#container-free-product_update").addClass("flex");

        $("#container-nominal_update").removeClass("flex");
        $("#container-nominal_update").addClass("hidden");
    }


    const showModalUbah = () => {
        $("#bg_modal_ubah").removeClass("pointer-events-none");
        $("#bg_modal_ubah").addClass("opacity-50");
        $("#bg_modal_ubah").removeClass("opacity-0");

        $("#konten_modal_ubah").addClass("scale-100");
        $("#konten_modal_ubah").removeClass("scale-0");
    }

    const closeModalUbah = () => {
        $("#bg_modal_ubah").addClass("pointer-events-none");
        $("#bg_modal_ubah").removeClass("opacity-50");
        $("#bg_modal_ubah").addClass("opacity-0");

        $("#konten_modal_ubah").removeClass("scale-100");
        $("#konten_modal_ubah").addClass("scale-0");
    }

    $("#jenis_discount_update").change(function(e) {
        e.preventDefault();
        if ($("#jenis_discount_update").val() == "persen") {
            $("#txt_nominal_update").val("");
            $("#txt_nominal_update").attr("maxlength", 3);
            $("#container-jumlah_update").addClass("hidden");
            $("#container-free-product_update").addClass("hidden");
            $("#container-jumlah_update").removeClass("flex");
            $("#container-free-product_update").removeClass("flex");

            $("#container-nominal_update").addClass("flex");
            $("#container-nominal_update").removeClass("hidden");

        } else if ($("#jenis_discount_update").val() == "nominal") {
            $("#txt_nominal_update").val("");
            $("#txt_nominal_update").attr("maxlength", 15);
            $("#container-jumlah_update").addClass("hidden");
            $("#container-free-product_update").addClass("hidden");
            $("#container-jumlah_update").removeClass("flex");
            $("#container-free-product_update").removeClass("flex");

            $("#container-nominal_update").addClass("flex");
            $("#container-nominal_update").removeClass("hidden");
        } else {
            $("#container-jumlah_update").removeClass("hidden");
            $("#container-free-product_update").removeClass("hidden");
            $("#container-jumlah_update").addClass("flex");
            $("#container-free-product_update").addClass("flex");

            $("#container-nominal_update").removeClass("flex");
            $("#container-nominal_update").addClass("hidden");
        }
    });

    const ubahData = (arr) => {
        $("#txt_kode_update").val(arr.diskon.kode_diskon);
        $("#txt_product_update").val(arr.nama_br);

        if (arr.diskon.kategori == "persen") {
            $("#txt_nominal_update").val("");
            $("#txt_nominal_update").attr("maxlength", 3);
            $("#container-jumlah_update").addClass("hidden");
            $("#container-free-product_update").addClass("hidden");
            $("#container-jumlah_update").removeClass("flex");
            $("#container-free-product_update").removeClass("flex");

            $("#container-nominal_update").addClass("flex");
            $("#container-nominal_update").removeClass("hidden");

            $("#jenis_discount_update").val(arr.diskon.kategori);
            $("#txt_nominal_update").val(formatRupiah(arr.diskon.nominal.toString()));
        } else if (arr.diskon.kategori == "nominal") {
            $("#txt_nominal_update").val("");
            $("#txt_nominal_update").attr("maxlength", 15);
            $("#container-jumlah_update").addClass("hidden");
            $("#container-free-product_update").addClass("hidden");
            $("#container-jumlah_update").removeClass("flex");
            $("#container-free-product_update").removeClass("flex");

            $("#container-nominal_update").addClass("flex");
            $("#container-nominal_update").removeClass("hidden");

            $("#jenis_discount_update").val(arr.diskon.kategori);
            $("#txt_nominal_update").val(formatRupiah(arr.diskon.nominal.toString()));
        } else {
            $("#container-jumlah_update").removeClass("hidden");
            $("#container-free-product_update").removeClass("hidden");
            $("#container-jumlah_update").addClass("flex");
            $("#container-free-product_update").addClass("flex");

            $("#container-nominal_update").removeClass("flex");
            $("#container-nominal_update").addClass("hidden");

            $("#jenis_discount_update").val(arr.diskon.kategori);

            if (JSON.parse(arr.diskon.free_product).free == "sama") {
                $("#sama_update").attr("checked", "");
            } else {
                $("#bebas_update").attr("checked", "");
            }
            $("#txt_beli_update").val(JSON.parse(arr.diskon.free_product).value.buy);
            $("#txt_gratis_update").val(JSON.parse(arr.diskon.free_product).value.gratis);
        }
        showModalUbah();
    }

    // hapus data
    // Check All
    $("#checkAll").change(function(e) {
        e.preventDefault();
        $(".idcheck").prop("checked", $(this).prop("checked"));
    });

    // trigger delete selected
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



    // Filter Kategori
    $("#filter_kategori").change(function(e) {
        e.preventDefault();
        switch ($("#filter_kategori").val()) {
            case "persen":
                location.href = window.location.origin + "/diskon/kategori?value=" + "persen";
                break;
            case "nominal":
                location.href = window.location.origin + "/diskon/kategori?value=" + "nominal";
                break;
            case "free":
                location.href = window.location.origin + "/diskon/kategori?value=" + "free";
                break;
            default:
                break;
        }
    });
</script>
