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

    console.log("wdakdoawkdowa");
});


// TODO: Modal Update
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

    resetForm();
}

function ubahData(nama, warna, kategori, ukuran, harga, tags, jenis, id, foto, barcode) {
    $(".label-error-update").addClass("hidden");

    $("#txt_namaUpdate").val(nama);
    $("#txt_warnaUpdate").val(warna);
    $("#txt_kategoriUpdate").val(kategori);
    $("#txt_ukuranUpdate").val(ukuran);
    $("#txt_hargaUpdate").val(harga);
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

    console.log("wdakdoawkdowa");
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
}

const closeModalBarcode = () => {
    $("#bg_modal_barcode").addClass("pointer-events-none");
    $("#bg_modal_barcode").removeClass("opacity-50");
    $("#bg_modal_barcode").addClass("opacity-0");
    
    $("#konten_modal_barcode").removeClass("scale-100");
    $("#konten_modal_barcode").addClass("scale-0");
    
}

$("#btn_barcode").click((e) => {
    e.preventDefault();
    $("#img_barcode").attr("src", "data:image/png;base64," + $("#barcode_id").val());
    showModalBarocde();
});

