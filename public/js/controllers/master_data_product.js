var selectedTags = [];

// check selected tags
let searchParams = new URLSearchParams(window.location.search);
if (searchParams.get("filter")) {
    for (
        let index = 0;
        index < JSON.parse(searchParams.get("filter")).length;
        index++
    ) {
        const element = JSON.parse(searchParams.get("filter"))[index];
        selectedTags.push(element);
        $("#" + element).toggleClass(
            "bg-white border-[#D9D9D9] text-[#9B9B9B]"
        );
        $("#" + element).toggleClass(
            "bg-[#FFB015] border-[#FFB015] text-black poppins-medium"
        );
    }
}

//filter kategori
$("#filter_kategori").change(function (e) {
    e.preventDefault();
    $("#form_filter_kategori").trigger("submit");
});

// Check All
$("#checkAll").change(function (e) {
    e.preventDefault();
    $(".idcheck").prop("checked", $(this).prop("checked"));
});

// trigger delete selected
$("#btn_hapus").click(function (e) {
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

// // trigger delete per item
// $("#btn_delete_item").click(function (e) {
//     e.preventDefault();
//     $("#form_delete_per_item").trigger("submit");
// });

// Preview Picture
foto.onchange = (evt) => {
    console.log("awdawda");
    const [file] = foto.files;
    if (file) {
        imgpreview.src = URL.createObjectURL(file);
        $("#imgpreview").removeClass("hidden");
        $("#imgpreview").addClass("flex");
    }
};

$("#btn_tambah").click(function (e) {
    e.preventDefault();

    $(".label-error").removeClass("hidden");
    $("#imgpreview").attr("src", "");
    $("#imgpreview").removeClass("flex");
    $("#imgpreview").addClass("hidden");
    showModal();
});

// test selected tag
$("#btn_filter_tags").click(function (e) {
    e.preventDefault();
    if (selectedTags.length == 0) {
        location.href = window.location.origin + "/product";
    } else {
        location.href =
            window.location.origin +
            "/product/tags?filter=" +
            encodeURIComponent(JSON.stringify(selectedTags));
    }
    // $("#form_filter").trigger("submit");
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

function filterTags(kode) {
    if ($("#" + kode).hasClass("bg-[#FFB015]")) {
        for (let index = 0; index < selectedTags.length; index++) {
            const element = selectedTags[index];
            if (element == kode) {
                removeItemOnce(selectedTags, kode);
            }
        }
    } else {
        selectedTags.push(kode);
    }

    $("#" + kode).toggleClass("bg-white border-[#D9D9D9] text-[#9B9B9B]");

    $("#" + kode).toggleClass(
        "bg-[#FFB015] border-[#FFB015] text-black poppins-medium"
    );
    console.log(selectedTags);
}

function removeItemOnce(arr, value) {
    var index = arr.indexOf(value);
    if (index > -1) {
        arr.splice(index, 1);
    }
    return arr;
}

function resetForm() {
    $("#button_submit").html("Tambah Data");
    $("#title_modal").html("Tambah Data");
    $('input[type="checkbox"]').attr("checked", false);
    $('input[type="radio"]').attr("checked", false);

    $("#form_product").attr("action", "/product/add");

    $("#form_product").trigger("reset");
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

    resetForm();
}

$("#btn_submit").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":checkbox:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#txt_nama").val() == "") {
        isError.status = true;
        isError.message = "Field nama tidak boleh kosong";
    } else if ($("#txt_harga").val() == "") {
        isError.status = true;
        isError.message = "Field harga tidak boleh kosong";
    } else if ($("#txt_warna").val() == "") {
        isError.status = true;
        isError.message = "Field warna tidak boleh kosong";
    } else if(val.length == 0){
        isError.status = true;
        isError.message = "Field tags tidak boleh kosong";
    } else if(!$("#free").is(":checked") && !$("#jual").is(":checked")){
        isError.status = true;
        isError.message = "Field jenis tidak boleh kosong";
    } else if($('#foto').get(0).files.length === 0){
        isError.status = true;
        isError.message = "Field foto tidak boleh kosong";
    } else {
        isError.status = false;
        isError.message = "";
    }

    if(isError.status){
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
            text: "Apakah anda yakin ingin menambah data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tidak",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form_product").trigger("submit");
            }
        });
    }


    console.log("wdakdoawkdowa");
});

// TODO: Modal Update
function resetFormUpdate() {
    $('input[type="checkbox"]').attr("checked", false);
    $('input[type="radio"]').attr("checked", false);

    $("#form_productUpdate").trigger("reset");
}

function showModalUpdate() {
    $("#bg_modalUpdate").removeClass("pointer-events-none");
    $("#bg_modalUpdate").addClass("opacity-50");
    $("#bg_modalUpdate").removeClass("opacity-0");

    $("#konten_modalUpdate").addClass("scale-100");
    $("#konten_modalUpdate").removeClass("scale-0");
}

function closeModalUpdate() {
    $("#bg_modalUpdate").addClass("pointer-events-none");
    $("#bg_modalUpdate").removeClass("opacity-50");
    $("#bg_modalUpdate").addClass("opacity-0");

    $("#konten_modalUpdate").removeClass("scale-100");
    $("#konten_modalUpdate").addClass("scale-0");

    resetFormUpdate();
}

function ubahData(
    nama,
    warna,
    kategori,
    ukuran,
    harga,
    tags,
    jenis,
    id,
    foto,
    barcode
) {
    $(".label-error-update").addClass("hidden");

    $("#txt_namaUpdate").val(nama);
    $("#txt_warnaUpdate").val(warna);
    $("#txt_kategoriUpdate").val(kategori);
    $("#txt_ukuranUpdate").val(ukuran);
    $("#txt_hargaUpdate").val(formatRupiah(harga, "Rp. "));
    $("#barcode_id").val(barcode);
    $("#idproductUpdate").val(id);
    $("#" + jenis + "Update").attr("checked", true);

    $("#imgpreviewUpdate").attr("src", foto);
    $("#imgpreviewUpdate").removeClass("hidden");
    $("#imgpreviewUpdate").addClass("flex");

    var tags_selected = JSON.parse(tags);
    console.log(tags_selected);
    for (let index = 0; index < tags_selected.length; index++) {
        const element = tags_selected[index];
        $("#update-" + element.kode_tag).attr("checked", true);
        // console.log(element.kode_tag);
    }
    showModalUpdate();
}

$("#btn_submitUpdate").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":checkbox:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#txt_namaUpdate").val() == "") {
        isError.status = true;
        isError.message = "Field nama tidak boleh kosong";
    } else if ($("#txt_hargaUpdate").val() == "") {
        isError.status = true;
        isError.message = "Field harga tidak boleh kosong";
    } else if ($("#txt_warnaUpdate").val() == "") {
        isError.status = true;
        isError.message = "Field warna tidak boleh kosong";
    } else if(val.length == 0){
        isError.status = true;
        isError.message = "Field tags tidak boleh kosong";
    } else if(!$("#freeUpdate").is(":checked") && !$("#jualUpdate").is(":checked")){
        isError.status = true;
        isError.message = "Field jenis tidak boleh kosong";
    } else {
        isError.status = false;
        isError.message = "";
    }

    if(isError.status){
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
            text: "Apakah anda yakin ingin mengubah data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tidak",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form_productUpdate").trigger("submit");
            }
        });
    }
});

// Preview Picture
fotoUpdate.onchange = (evt) => {
    console.log("awdawda");
    const [file] = fotoUpdate.files;
    if (file) {
        imgpreviewUpdate.src = URL.createObjectURL(file);
        $("#imgpreviewUpdate").removeClass("hidden");
        $("#imgpreviewUpdate").addClass("flex");
    }
};

// TODO: Show Barcode

const showModalBarocde = () => {
    $("#bg_modal_barcode").removeClass("pointer-events-none");
    $("#bg_modal_barcode").addClass("opacity-50");
    $("#bg_modal_barcode").removeClass("opacity-0");

    $("#konten_modal_barcode").addClass("scale-100");
    $("#konten_modal_barcode").removeClass("scale-0");
};

const closeModalBarcode = () => {
    $("#bg_modal_barcode").addClass("pointer-events-none");
    $("#bg_modal_barcode").removeClass("opacity-50");
    $("#bg_modal_barcode").addClass("opacity-0");

    $("#konten_modal_barcode").removeClass("scale-100");
    $("#konten_modal_barcode").addClass("scale-0");
};

$("#btn_barcode").click((e) => {
    e.preventDefault();
    $("#img_barcode").attr(
        "src",
        "data:image/png;base64," + $("#barcode_id").val()
    );
    showModalBarocde();
});

// TODO: Custom Field
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

$("#txt_harga").keyup(function (e) {
    $("#txt_harga").val(formatRupiah(this.value, "Rp. "));
});

$("#txt_hargaUpdate").keyup(function (e) {
    $("#txt_hargaUpdate").val(formatRupiah(this.value, "Rp. "));
});


// TODO: Tags
const showModalTag = () => {
    $("#bg_modal_tag").removeClass("pointer-events-none");
    $("#bg_modal_tag").addClass("opacity-50");
    $("#bg_modal_tag").removeClass("opacity-0");

    $("#konten_modal_tag").addClass("scale-100");
    $("#konten_modal_tag").removeClass("scale-0");
};

const closeModalTag = () => {
    $("#bg_modal_tag").addClass("pointer-events-none");
    $("#bg_modal_tag").removeClass("opacity-50");
    $("#bg_modal_tag").addClass("opacity-0");

    $("#konten_modal_tag").removeClass("scale-100");
    $("#konten_modal_tag").addClass("scale-0");
};

const toggleTab = (param) => {
    if(param == "tambah"){
        $("#tambah-container").removeClass("hidden");
        $("#tambah-container").addClass("flex");
        $("#label-tambah").removeClass("text-[#8F8F8F]");
        $("#label-tambah").addClass("text-black");

        $("#data-container").removeClass("flex");
        $("#data-container").addClass("hidden");
        $("#label-data").removeClass("text-black");
        $("#label-data").addClass("text-[#8F8F8F]");

        $("#selectedTabTag").removeClass("translate-x-20 w-[50px]");
        $("#selectedTabTag").addClass("translate-x-0 w-[70px]");
    } else {
        $("#data-container").removeClass("hidden");
        $("#data-container").addClass("flex");
        $("#label-data").removeClass("text-[#8F8F8F]");
        $("#label-data").addClass("text-black");

        $("#tambah-container").removeClass("flex");
        $("#tambah-container").addClass("hidden");
        $("#label-tambah").removeClass("text-black");
        $("#label-tambah").addClass("text-[#8F8F8F]");

        $("#selectedTabTag").removeClass("translate-x-0 w-[70px]");
        $("#selectedTabTag").addClass("translate-x-20 w-[50px]");
    }
}