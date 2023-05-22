function showModal() {
    console.log("tes");
    $("#bg_modal").removeClass("pointer-events-none");
    $("#bg_modal").addClass("opacity-50");
    $("#bg_modal").removeClass("opacity-0");

    $("#konten_modal_restock").addClass("scale-100");
    $("#konten_modal_restock").removeClass("scale-0");
}

function closeModal() {
    $("#bg_modal").addClass("pointer-events-none");
    $("#bg_modal").removeClass("opacity-50");
    $("#bg_modal").addClass("opacity-0");

    $("#konten_modal_restock").removeClass("scale-100");
    $("#konten_modal_restock").addClass("scale-0");

    resetForm();
}

function resetForm() {
    $("#form_add_Pengeluaran_re_stock").trigger("reset");
    $("#form_add_Pengeluaran_re_stock").trigger("reset");
    $("#jumlah").val(null);
    $("#total").val(null);
}

$("#btn_tambah").click(function (e) {
    e.preventDefault();

    $(".label-error").removeClass("hidden");
    $("#imgpreview").attr("src", "");
    $("#imgpreview").removeClass("flex");
    $("#imgpreview").addClass("hidden");
    showModal();
});

var input = document.getElementById("total");
input.addEventListener("keyup", function (e) {
    var value = e.target.value;
    e.target.value = formatRupiah(value, "Rp");
});

function submit_form() {
    if ($("#jumlah").val() === "") {
        return Swal.fire(
            "Informasi",
            "Field jumlah tidak boleh kosong",
            "warning"
        );
    }
    if ($("#total").val() === "") {
        return Swal.fire(
            "Informasi",
            "Field total biaya tidak boleh kosong",
            "warning"
        );
    }
    $("#form_add_Pengeluaran_re_stock").trigger("submit");
}

$(document).ready(function () {
    // animasi dropdown menu
    $("#menuLaporan").click(function (e) {
        $("#menuDropDown").toggleClass("max-md:hidden");
        $("#arrowMenu").toggleClass("rotate-180");
    });

    // format rupiah in modal
    var input = document.getElementById("total");
    input.addEventListener("keyup", function (e) {
        var value = e.target.value;
        e.target.value = formatRupiah(value, "Rp");
    });

    // subnit filter search
    $(document).keyup(function (event) {
        if ($("#field_search").is(":focus") && event.key == "Enter") {
            $("form_search").trigger("submit");
        }
    });

    // submit filter tanggal
    $("#btn_submit_filter").click(function () {
        if (getDataFilter() !== false) {
            let params = new URLSearchParams(window.location.search).get(
                "search"
            );
            let param = params !== null ? "/?search=" + params : "";
            location.replace(
                "/pengeluaran/re-stock/" + getDataFilter() + param
            );
        }
    });
});
