$(document).ready(function () {
  $('#menuLaporan').click(function (e) {
    $('#menuDropDown').toggleClass('max-md:hidden');
    $("#arrowMenu").toggleClass('rotate-180');
  });

  $('#btn_submit_filter').click(function () {

    if (getDataFilter() !== false) {
      location.replace("/laporan/pengeluaran/" + getDataFilter())
    }
  });
});

function showDetail(param) {

  if (param === 'restock') {
    $("#tb_restock").removeClass("hidden");
    $("#tb_operasional").addClass("hidden");
    $('#title_detail').html('Detail Re-stock');
  } else if (param === 'operasional') {
    $("#tb_restock").addClass("hidden");
    $("#tb_operasional").removeClass("hidden");
    $('#title_detail').html('Detail Operasional');
  }

  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_detail").removeClass("scale-0");
  $("#konten_modal_detail").addClass("scale-100");
}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_detail").removeClass("scale-100");
  $("#konten_modal_detail").addClass("scale-0");
}

// function tab_restock() {
//   $("#tab_restock").addClass("bg-[#FFB015]");
//   $("#tab_operasional").removeClass("bg-[#FFB015]");
//   $("#tb_restock").removeClass("hidden");
//   $("#tb_operasional").addClass("hidden");
//   // alert("awkoawkokwaokowakao")
//   console.log("hai")
// }

// function tab_operasional() {
//   $("#tab_restock").removeClass("bg-[#FFB015]");
//   $("#tab_operasional").addClass("bg-[#FFB015]");
//   $("#tb_restock").addClass("hidden");
//   $("#tb_operasional").removeClass("hidden");
//   console.log("hai tidak terjual")
// }