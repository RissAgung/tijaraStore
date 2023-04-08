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
    $("#form_delete").trigger("submit");
});

// trigger delete per item
$("#btn_delete_item").click(function (e) {
    e.preventDefault();
    $("#form_delete_per_item").trigger("submit");
});

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

$("#bg_modal").click(function (e) {
    e.preventDefault();
    closeModal();
});

// test selected tag
$("#btn_filter_tags").click(function (e) {
    e.preventDefault();
    if (selectedTags.length == 0) {
        location.href = window.location.origin + window.location.pathname;
    } else {
        location.href =
            window.location.origin +
            "/product/tags?filter=" +
            encodeURIComponent(JSON.stringify(selectedTags));
    }
    // $("#form_filter").trigger("submit");
});

function ubahData(nama, warna, kategori, ukuran, harga, tags, jenis, id, foto) {
    $("#button_submit").html("Ubah Data");
    $("#title_modal").html("Ubah Data");

    $(".label-error").addClass("hidden");

    $("#txt_nama").val(nama);
    $("#txt_warna").val(warna);
    $("#txt_kategori").val(kategori);
    $("#txt_ukuran").val(ukuran);
    $("#txt_harga").val(harga);
    $("#id").val(id);
    $("#" + jenis).attr("checked", true);

    $("#imgpreview").attr("src", foto);
    $("#imgpreview").removeClass("hidden");
    $("#imgpreview").addClass("flex");

    $("#form_product").attr("action", "/product/update");

    var tags_selected = JSON.parse(tags);
    console.log(tags_selected);
    for (let index = 0; index < tags_selected.length; index++) {
        const element = tags_selected[index];
        $("#" + element.kode_tag).attr("checked", true);
        // console.log(element.kode_tag);
    }
    showModal();
}

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

$("#btn_submit").submit(function (e) {
    e.preventDefault();
    console.log("wdakdoawkdowa");
});
