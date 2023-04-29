function resetForm() {
  $("#form_retur").trigger("reset");
  $('#jumlah_barang').val(null);
  $('#supplier').val(null);
  $('#jumlah_retur').val(null);
  $('#jumlah_uang').val(null);
}

function showModal(nama_produk) {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal").removeClass("scale-0");
  $("#konten_modal").addClass("scale-100");

  $('#nama_produk').val(nama_produk);

}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal").removeClass("scale-100");
  $("#konten_modal").addClass("scale-0");

  resetForm();
}

function resetFilter() {
  location.replace("/retur");
}

let getValueSearch = () => { return $('#field_search').val() }

$(document).keyup(function (event) {
  if ($('#field_search').is(":focus") && event.key == "Enter") {
    let params = new URLSearchParams(window.location.search).get("filter")
    let param = params !== null ? "/?filter="+params : "";
    location.replace("/retur/"+getValueSearch()+ param)
  }
});

function submitFilter() {
  $('#filter_kategori').trigger('submit');
}
