$("#btn_tambah").click(function (e) {
    e.preventDefault();
    showModal();
});

function showModal(){
    $("#bg_modal").removeClass("pointer-events-none");
    $("#bg_modal").addClass("opacity-50");
    $("#bg_modal").removeClass("opacity-0");

    $("#konten_modal_add").addClass("scale-100");
    $("#konten_modal_add").removeClass("scale-0");
    //console.log("ajdsajn");
}
function showModalUpdate(){
    $("#bg_modal_edit").removeClass("pointer-events-none");
    $("#bg_modal_edit").addClass("opacity-50");
    $("#bg_modal_edit").removeClass("opacity-0");

    $("#konten_modal_edit").addClass("scale-100");
    $("#konten_modal_edit").removeClass("scale-0");

     let vals = document.getElementById("id_gajiUpdate").value;
    console.log(vals);

}
function closeModal() {
    $("#bg_modal").addClass("pointer-events-none");
    $("#bg_modal").removeClass("opacity-50");
    $("#bg_modal").addClass("opacity-0");

    $("#konten_modal_add").removeClass("scale-100");
    $("#konten_modal_add").addClass("scale-0");
}
function closeModalUpdate() {
    $("#bg_modal_edit").addClass("pointer-events-none");
    $("#bg_modal_edit").removeClass("opacity-50");
    $("#bg_modal_edit").addClass("opacity-0");

    $("#konten_modal_edit").removeClass("scale-100");
    $("#konten_modal_edit").addClass("scale-0");

    $("#bonus").val("");
    $("#pinjaman").val("");
}


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

$("#admin").keyup(function (e) {
    $("#admin").val(formatRupiah(this.value, "Rp. "));
});
$("#kasir").keyup(function (e) {
    $("#kasir").val(formatRupiah(this.value, "Rp. "));
});
$("#pegawai").keyup(function (e) {
    $("#pegawai").val(formatRupiah(this.value, "Rp. "));
});
$("#bonus").keyup(function (e) {
    $("#bonus").val(formatRupiah(this.value, "Rp. "));
});
$("#pinjaman").keyup(function (e) {
    $("#pinjaman").val(formatRupiah(this.value, "Rp. "));
});
$("#total").keyup(function (e) {
    $("#total").val(formatRupiah(this.value, "Rp. "));
});

    



$("#btn_submit").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":checkbox:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#admin").val() == "") {
        isError.status = true;
        isError.message = "Field gaji admin tidak boleh kosong";
    } else if ($("#kasir").val() == "") {
        isError.status = true;
        isError.message = "Field gaji kasir tidak boleh kosong";
    } else if ($("#pegawai").val() == "") {
        isError.status = true;
        isError.message = "Field gaji pegawai tidak boleh kosong";
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
                $("#form_gaji").trigger("submit");
            }
        });
    }
});




function ubah(gaji){

    $("#id_gajiUpdate").val(gaji.kode_gaji);
    $("#nama").val(gaji.nama_pegawai);
    $("#posisi").val(gaji.posisi);
    // $("#bonus").val(gaji.bonus);
    // $("#pinjaman").val(gaji.pinjaman);
    // $("#gajiPokok").val(gaji.gaji_pokok);
    // $("#total").val(gaji.gaji_total);
    
    

    // let vals = document.getElementById("nama").value;
    // console.log(vals);

    // let vals2 = document.getElementById("posisi").value;
    // console.log(vals2);

    // let vals3 = document.getElementById("gajiPokok").value;
    // console.log(vals3);

    if(gaji.bonus == 0){
        $("#bonus").val("");
    } else {
        $("#bonus").val(formatRupiah(gaji.bonus.toString(), "Rp. "));
    }

    if(gaji.pinjaman == 0){
        $("#pinjaman").val("");
    } else {
        $("#pinjaman").val(formatRupiah(gaji.pinjaman.toString(), "Rp. "));
    }

    $("#gajiPokok").val(formatRupiah(gaji.gaji_pokok.toString(), "Rp. "));
    $("#total").val(formatRupiah(gaji.gaji_total.toString(), "Rp. "));

    showModalUpdate();
    hitungTotal();
}

$("#gajiPokok, #bonus, #pinjaman").on("input", hitungTotal);

function hitungTotal() {


    var awal = $("#gajiPokok").val();
    var intAwal = parseInt(awal.replace(/[^0-9]/g, "")) || 0;
    //console.log(intAwal);
    
    var bonus = $("#bonus").val();
    var intBonus = parseInt(bonus.replace(/[^0-9]/g, "")) || 0;
    //console.log(intBonus);

    var pinjaman = $("#pinjaman").val();
    var IntPinjaman = parseInt(pinjaman.replace(/[^0-9]/g, "")) || 0;
    //console.log(IntPinjaman);
   
    var total = intAwal + intBonus - IntPinjaman;

    //console.log(total);

    $("#total").val(formatRupiah(total.toString(), "Rp. "));

}


$("#submit_editGaji").click(function (e) {
    e.preventDefault();
    var isError = [];
    var val = [];
    $(":checkbox:checked").each(function (i) {
        val[i] = $(this).val();
    });

    if ($("#total").val() == "") {
        isError.status = true;
        isError.message = "Field total tidak boleh kosong";
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
                $("#form_gaji_edit").trigger("submit");
            }
        });
    }
});




$(document).ready(function () {
    $('#btn_submit_filter').click(function () {
  
      if (getDataFilter() !== false) {
        let params = new URLSearchParams(window.location.search).get("search")
        let param = params !== null ? "/?search=" + params : "";
        location.replace("/salary/" + getDataFilter() + param)
      }
    //   console.log(getDataFilter());
    });

    $('#harian').addClass("hidden");
    $('#mingguan').addClass("hidden");
    $('#div-harian').addClass("hidden");
    $('#div-mingguan').addClass("hidden");
    $('#div-bulanan').removeClass('hidden');

    $('#bulanan').addClass('text-primary');
    $('#div-bulanan').addClass('flex');

    selectedTab = 'bulanan';

  });