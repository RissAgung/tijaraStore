$(document).ready(function () {
  $('#menuLaporan').click(function (e) {
    $('#menuDropDown').toggleClass('max-md:hidden');
    $("#arrowMenu").toggleClass('rotate-180');
  });
});

function showDetail() {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal").removeClass("scale-0");
  $("#konten_modal").addClass("scale-100");
}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal").removeClass("scale-100");
  $("#konten_modal").addClass("scale-0");
}

function tab_terjual(){
  $("#tab_terjual").addClass("bg-[#FFB015]");
  $("#tab_tidak_terjual").removeClass("bg-[#FFB015]");
  $("#tb_terjual").removeClass("hidden");
  $("#tb_t_terjual").addClass("hidden");
  // alert("awkoawkokwaokowakao")
  console.log("hai")
}

function tab_tidak_terjual(){
  $("#tab_terjual").removeClass("bg-[#FFB015]");
  $("#tab_tidak_terjual").addClass("bg-[#FFB015]");
  $("#tb_terjual").addClass("hidden");
  $("#tb_t_terjual").removeClass("hidden");
  console.log("hai tidak terjual")
}