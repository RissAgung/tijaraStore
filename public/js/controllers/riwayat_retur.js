function showModal(data) {
  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_detail_riwayat").removeClass("scale-0");
  $("#konten_modal_detail_riwayat").addClass("scale-100");

  $('#nama_br').html(data.nama_br);
  $('#jumlah_produk').html(data.QTY);
  $('#jumlah_retur').html(data.jml_barang);
  $('#uang_kembali').html(formatRupiah(String(data.jml_nominal), 'Rp. '));

  $('#no_tr').html(data.kode_retur);
  $('#tgl_tr').html(data.tanggal);
  $('#nama_sp').html(data.nama_sp);
  $('#no_tlp').html(data.no_hp_sp);
  $('#instansi').html(data.instansi);


  // console.log(data)

}

function closeModalDetail() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_detail_riwayat").removeClass("scale-100");
  $("#konten_modal_detail_riwayat").addClass("scale-0");
}

function showModalFilter() {
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

let getValueSearch = () => { return $('#field_search').val() }

function resetFilter() {
  location.replace("/riwayatRetur");
}

$(document).keyup(function (event) {
  if ($('#field_search').is(":focus") && event.key == "Enter") {
    $('form_search').trigger('submit');
  }
});

$(document).ready(function () {

  $('#btn_submit_filter').click(function () {

    if (getDataFilter() !== false) {
      let params = new URLSearchParams(window.location.search).get("search")
      let param = params !== null ? "/?search=" + params : "";
      location.replace("/riwayatRetur/" + getDataFilter() + param)
    }
    // getDataFilter()
  });
});

