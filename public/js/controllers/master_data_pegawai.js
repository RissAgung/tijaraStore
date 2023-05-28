function resetForm() {
    $("#button_submit").html("Tambah Data");
    $("#title_modal").html("Tambah Data");
    $('input[type="checkbox"]').attr("checked", false);
    $('input[type="radio"]').attr("checked", false);

    $("#form_add_pegawai").attr("action", "/pegawai/tambah");

    $("#form_add_pegawai").trigger("reset");
    $("#role");
}

function showModal() {
    $("#bg_modal").removeClass("pointer-events-none");
    $("#bg_modal").addClass("opacity-50");
    $("#bg_modal").removeClass("opacity-0");

    $("#konten_modal").addClass("scale-100");
    $("#konten_modal").removeClass("scale-0");

    if ($("#role").val() == "admin" || "kasir") {
        $("#username").removeClass("hidden");
        $("#password").removeClass("hidden");
    } else {
        $("#username").addClass("hidden");
        $("#password").addClass("hidden");
    }
}

function closeModal() {
    $("#bg_modal").addClass("pointer-events-none");
    $("#bg_modal").removeClass("opacity-50");
    $("#bg_modal").addClass("opacity-0");

    $("#konten_modal").removeClass("scale-100");
    $("#konten_modal").addClass("scale-0");

    resetForm();
}

$("#btn_tambah").click(function (e) {
    e.preventDefault();

    $(".label-error").removeClass("hidden");
    $("#imgpreview").attr("src", "");
    $("#imgpreview").removeClass("flex");
    $("#imgpreview").addClass("hidden");
    showModal();
});

$("#btn_submit").click(function (e) {
    e.preventDefault();

    if (!/^[0-9]+$/.test($("#no_hp").val())) {
        return Swal.fire(
            "Informasi",
            "Field no hp hanya boleh berisi angka",
            "warning"
        );
    }

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
            $("#form_add_pegawai").trigger("submit");
        }
    });

    console.log("wdakdoawkdowa");
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

function resetFormUpdate() {
    // $('input[type="checkbox"]').attr("checked", false);
    $('input[type="radio"]').attr("checked", false);

    $("#form_productUpdate").trigger("reset");
}
function showModalUpdate() {
    console.log("edit");
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

function editData(item) {
    $(".label-error-update").addClass("hidden");
    $("#kode_pegawaiU").val(item.kode_pegawai);
    $("#nama_pegawaiU").val(item.nama);
    $("#alamatU").val(item.alamat);
    $("#no_hpU").val(item.no_hp);
    $("#" + item.gender + "Update").attr("checked", true);

    console.log(item);
    showModalUpdate();
}

$("#btn_submitU").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":radio:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#nama_pegawaiU").val() == "") {
        isError.status = true;
        isError.message = "Field nama tidak boleh kosong";
    } else if ($("#alamatU").val() == "") {
        isError.status = true;
        isError.message = "Field alamat tidak boleh kosong";
    } else if ($("#no_hpU").val() == "") {
        isError.status = true;
        isError.message = "Field nomer hape tidak boleh kosong";
    } else {
        isError.status = false;
        isError.message = "";
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
            text: "Apakah anda yakin ingin mengubah data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tidak",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form_edit_pegawai").trigger("submit");
            }
        });
    }
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

function toggleDropdown1() {
    document.getElementById("genderDropdown1").classList.toggle("hidden");
}

function toggleDropdown2() {
    document.getElementById("genderDropdown2").classList.toggle("hidden");
}
//funsi untuk mengubah nilai dropdown
$("#role").on("change", function () {
    var value = $(this).val();

    if (value == "pegawai") {
        $("#username").addClass("hidden");
        $("#password").addClass("hidden");
    } else {
        $("#username").removeClass("hidden");
        $("#password").removeClass("hidden");
    }
});

$("#genderSelect").change(function (e) {
    e.preventDefault();
    var selectedGender = $("#genderSelect").val();
    var selectedRole = $("#roleSelect").val();
    console.log("gender");
    window.location.href = "/pegawai/filterG/" + $("#genderSelect").val();
});

$("#roleSelect").change(function (e) {
    e.preventDefault();
    // console.log('tes');
    var selectedGender = $("#genderSelect").val();
    var selectedRole = $("#roleSelect").val();
    console.log("role");
    window.location.href = "/pegawai/filterR/" + $("#roleSelect").val();
});
