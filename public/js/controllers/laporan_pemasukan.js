$(document).ready(function () {
  $('#menuLaporan').click(function (e) {
    $('#menuDropDown').toggleClass('max-md:hidden');
    $("#arrowMenu").toggleClass('rotate-180');
  });

  $('#btn_submit_filter').click(function (e) {
    location.replace("/laporan/pemasukan/" + getDataFilter())
  });
});

function showDetail() {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_pria").removeClass("scale-0");
  $("#konten_modal_pria").addClass("scale-100");
}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_pria").removeClass("scale-100");
  $("#konten_modal_pria").addClass("scale-0");
}

function showDetail_wanita() {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_wanita").removeClass("scale-0");
  $("#konten_modal_wanita").addClass("scale-100");
}

function closeModal_wanita() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_wanita").removeClass("scale-100");
  $("#konten_modal_wanita").addClass("scale-0");
}

function closeModal_anak() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_anak").removeClass("scale-100");
  $("#konten_modal_anak").addClass("scale-0");
}

function showDetail_anak() {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_anak").removeClass("scale-0");
  $("#konten_modal_anak").addClass("scale-100");
  console.log('kontol gede');
}

function tab_terjual(jenis) {
  if (jenis == 'pria') {
    $("#tab_terjual").addClass("bg-[#FFB015]");
    $("#tab_tidak_terjual").removeClass("bg-[#FFB015]");
    $("#tb_terjual").removeClass("hidden");
    $("#tb_t_terjual").addClass("hidden");
    console.log("hai")
  } else if (jenis == 'wanita') {
    $("#tab_terjual_wanita").addClass("bg-[#FFB015]");
    $("#tab_tidak_terjual_wanita").removeClass("bg-[#FFB015]");
    $("#tb_terjual_wanita").removeClass("hidden");
    $("#tb_t_terjual_wanita").addClass("hidden");
    console.log("hai")
  } else if (jenis == 'anak') {
    $("#tab_terjual_anak").addClass("bg-[#FFB015]");
    $("#tab_tidak_terjual_anak").removeClass("bg-[#FFB015]");
    $("#tb_terjual_anak").removeClass("hidden");
    $("#tb_t_terjual_anak").addClass("hidden");
    console.log("hai")
  }
}

function tab_tidak_terjual(jenis) {

  if (jenis == 'pria') {
    $("#tab_terjual").removeClass("bg-[#FFB015]");
    $("#tab_tidak_terjual").addClass("bg-[#FFB015]");
    $("#tb_terjual").addClass("hidden");
    $("#tb_t_terjual").removeClass("hidden");
    console.log("hai tidak terjual")
  } else if (jenis == 'wanita') {
    $("#tab_terjual_wanita").removeClass("bg-[#FFB015]");
    $("#tab_tidak_terjual_wanita").addClass("bg-[#FFB015]");
    $("#tb_terjual_wanita").addClass("hidden");
    $("#tb_t_terjual_wanita").removeClass("hidden");
    console.log("hai tidak terjual")
  } else if (jenis == 'anak') {
    $("#tab_terjual_anak").removeClass("bg-[#FFB015]");
    $("#tab_tidak_terjual_anak").addClass("bg-[#FFB015]");
    $("#tb_terjual_anak").addClass("hidden");
    $("#tb_t_terjual_anak").removeClass("hidden");
    console.log("hai tidak terjual")
  }

}