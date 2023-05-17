$(document).ready(function () {

  // animasi dropdown menu
  $('#menuLaporan').click(function (e) {
    $('#menuDropDown').toggleClass('max-md:hidden');
    $("#arrowMenu").toggleClass('rotate-180');
  });

  // format rupiah in modal
  var input = document.getElementById("total");
  input.addEventListener("keyup", function (e) {
    var value = e.target.value;
    e.target.value = formatRupiah(value, 'Rp');
  });

  // subnit filter search
  $(document).keyup(function (event) {
    if ($('#field_search').is(":focus") && event.key == "Enter") {
      $('form_search').trigger('submit');
    }
  });

  // submit filter tanggal
  $('#btn_submit_filter').click(function () {

    if (getDataFilter() !== false) {
      let params = new URLSearchParams(window.location.search).get("search")
      let param = params !== null ? "/?search=" + params : "";
      location.replace("/pengeluaran/operasional/" + getDataFilter() + param)
    }
  });
});

function resetForm() {
  $("#form_operasional").trigger("reset");
  $('#keterangan').val(null);
  $('#total').val(null);
}

function showModal(nama_produk) {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_add_operasional").removeClass("scale-0");
  $("#konten_modal_add_operasional").addClass("scale-100");

  $('#nama_produk').val(nama_produk);

}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_add_operasional").removeClass("scale-100");
  $("#konten_modal_add_operasional").addClass("scale-0");

  resetForm();
}

function submit_form() {

  if ($('#keterangan').val() === '') { return Swal.fire("Informasi", 'Field keterangan tidak boleh kosong', "warning") }
  if ($('#total').val() === '') { return Swal.fire("Informasi", 'Field total biaya tidak boleh kosong', "warning") }
  $('#form_operasional').trigger('submit');


}