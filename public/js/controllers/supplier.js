$("#btn_tambah").click(function (e) {
    e.preventDefault();
    showModal();
});

$("#checkAll").change(function (e) {
    e.preventDefault();
    $(".idcheck").prop("checked", $(this).prop("checked"));
});

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


function ubah(supplier){

    $("#nama_update").val(supplier.nama_supplier);
    $("#ket_update").val(supplier.keterangan_sup);
    $("#kontak_update").val(supplier.no_hp_supplier);
    $("#alamat_update").val(supplier.alamat);
    $("#idSupUpdate").val(supplier.kode_supplier);

    // let vals = document.getElementById("nama_update").value;
    // console.log(vals);

    // let vals2 = document.getElementById("ket_update").value;
    // console.log(vals2);

    // let vals3 = document.getElementById("kontak_update").value;
    // console.log(vals3);

    // let vals4 = document.getElementById("alamat_update").value;
    // console.log(vals4);

    // let vals5 = document.getElementById("idSupUpdate").value;
    // console.log(vals5);

    showModalEdit();
}


function showModalEdit(){
    $("#bg_modal_edit").removeClass("pointer-events-none");
    $("#bg_modal_edit").addClass("opacity-50");
    $("#bg_modal_edit").removeClass("opacity-0");

    $("#konten_modal_edit").addClass("scale-100");
    $("#konten_modal_edit").removeClass("scale-0");
}
function showModal(){
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
function closeModalEdit() {
    $("#bg_modal_edit").addClass("pointer-events-none");
    $("#bg_modal_edit").removeClass("opacity-50");
    $("#bg_modal_edit").addClass("opacity-0");

    $("#konten_modal_edit").removeClass("scale-100");
    $("#konten_modal_edit").addClass("scale-0");
}


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

$("#btn_submit").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":checkbox:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#nama").val() == "") {
        isError.status = true;
        isError.message = "Field nama tidak boleh kosong";
    } else if ($("#ket").val() == "") {
        isError.status = true;
        isError.message = "Field keterangan tidak boleh kosong";
    } else if ($("#kontak").val() == "") {
        isError.status = true;
        isError.message = "Field nomor telepon tidak boleh kosong";
    } else if ($("#alamat").val() == "") {
        isError.status = true;
        isError.message = "Field alamat tidak boleh kosong";
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
            text: "Apakah anda yakin ingin menambah data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tidak",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form_supplier").trigger("submit");
            }
        });
    }
});

$("#btn_submitUpdate").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":checkbox:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#nama_update").val() == "") {
        isError.status = true;
        isError.message = "Field nama tidak boleh kosong";
    } else if ($("#ket_update").val() == "") {
        isError.status = true;
        isError.message = "Field keterangan tidak boleh kosong";
    } else if ($("#kontak_update").val() == "") {
        isError.status = true;
        isError.message = "Field nomor telepon tidak boleh kosong";
    } else if ($("#alamat_update").val() == "") {
        isError.status = true;
        isError.message = "Field alamat tidak boleh kosong";
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
                $("#form_supplier_edit").trigger("submit");
            }
        });
    }
});


function hanyaAngka(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            return true;
        }
}