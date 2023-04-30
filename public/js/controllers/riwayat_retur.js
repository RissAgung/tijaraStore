function showModal(data) {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal").removeClass("scale-0");
  $("#konten_modal").addClass("scale-100");

  $('#nama_br').html(data.nama_br);
  $('#jumlah_produk').html(data.QTY);
  $('#jumlah_retur').html(data.jml_barang);
  $('#uang_kembali').html(data.jml_nominal);

  $('#no_tr').html(data.kode_retur);
  $('#tgl_tr').html(data.tanggal);
  $('#nama_sp').html(data.nama_sp);
  $('#no_tlp').html(data.no_hp_sp);
  $('#instansi').html(data.instansi);


  // console.log(data)

}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal").removeClass("scale-100");
  $("#konten_modal").addClass("scale-0");
}

let getValueSearch = () => { return $('#field_search').val() }

function resetFilter() {
  location.replace("/riwayatRetur");
}

$(document).keyup(function (event) {
  if ($('#field_search').is(":focus") && event.key == "Enter") {
    location.replace("/riwayatRetur/" + getValueSearch())
  }
});