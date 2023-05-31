$(document).ready(function () {
  $('#menuLaporan').click(function (e) {
    $('#menuDropDown').toggleClass('max-md:hidden');
    $("#arrowMenu").toggleClass('rotate-180');
  });

  $('#btn_submit_filter').click(function (e) {
    location.replace("/laporan/pemasukan/" + getDataFilter())
  });

  $('#row_table_1').addClass('text-yellow-600 poppins-semibold');

});

function loadDefaultDetail(date, url) {
  $.ajax({
    type: "GET",
    url: url,
    data: {
      data_date: date,
    },
    success: async function (res) {
      const data = JSON.parse(res);

      const produk_pria = getDataProduk('pria', data.produk_terjual);
      const produk_wanita = getDataProduk('wanita', data.produk_terjual);
      const produk_anak = getDataProduk('anak', data.produk_terjual);
      const retur_cs = getData(data.retur_cs);
      const retur_sp = getData(data.retur_sp);

      produk_terjual_pria = produk_pria;
      produk_terjual_wanita = produk_wanita;
      produk_terjual_anak = produk_anak;

      produk_tidak_terjual_pria = getDataProduk('pria', data.produk_tidak_terjual);
      produk_tidak_terjual_wanita = getDataProduk('wanita', data.produk_tidak_terjual);
      produk_tidak_terjual_anak = getDataProduk('anak', data.produk_tidak_terjual);

      retur_customer = retur_cs;
      retur_supplier = retur_sp;

      const total_penjualan_produk_pria = getTotalProdukTerjual(produk_pria);
      const total_penjualan_produk_wanita = getTotalProdukTerjual(produk_wanita);
      const total_penjualan_produk_anak = getTotalProdukTerjual(produk_anak);
      const total_retur = getTotalProdukRetur(retur_sp, retur_cs);

      await $('#total_Produk_pria').html(formatRupiah(total_penjualan_produk_pria.toString(), 'Rp. '));
      await $('#total_Produk_wanita').html(formatRupiah(total_penjualan_produk_wanita.toString(), 'Rp. '));
      await $('#total_Produk_anak').html(formatRupiah(total_penjualan_produk_anak.toString(), 'Rp. '));
      await $('#total_retur').html(formatRupiah(total_retur.toString(), 'Rp. '));
      await $('#total_detail_pemasukan').html(formatRupiah((total_penjualan_produk_pria + total_penjualan_produk_wanita + total_penjualan_produk_anak + total_retur).toString(), 'Rp. '));
    }
  });
}

const getDataProduk = (jenis, data) => {
  let produk = []

  if (jenis == 'pria') {
    for (let index = 0; index < data.length; index++) {
      if (data[index].kategori == 'pria') {
        produk.push(data[index])
      }
    }
    return produk;
  } else if (jenis == 'wanita') {
    for (let index = 0; index < data.length; index++) {
      if (data[index].kategori == 'wanita') {
        produk.push(data[index])
      }
    }
    return produk;
  } else if (jenis == 'anak') {
    for (let index = 0; index < data.length; index++) {
      if (data[index].kategori == 'anak') {
        produk.push(data[index])
      }
    }
    return produk;
  }
};

const getData = (data) => {
  let data_retur = []
  for (let index = 0; index < data.length; index++) {
    data_retur.push(data[index])
  }
  return data_retur;
};

const getTotalProdukTerjual = (data) => {
  let total = 0;
  for (let i = 0; i < data.length; i++) {
    total += parseInt(data[i].harga)
  }
  return total;
}

const getTotalProdukRetur = (retur_sp, retur_cs) => {
  let total = 0;

  for (let i = 0; i < retur_sp.length; i++) {
    total += retur_sp[i].jml_nominal
  }

  for (let i = 0; i < retur_cs.length; i++) {
    total += retur_cs[i].bayar_kurang
  }
  return total;
}

var retur_customer = [];
var retur_supplier = [];

var getReturCs = () => {
  return retur_customer;
}
var getReturSp = () => {
  return retur_supplier;
}

var produk_tidak_terjual_pria = [];
var produk_tidak_terjual_wanita = [];
var produk_tidak_terjual_anak = [];

var getProdukTPria = () => {
  return produk_tidak_terjual_pria;
}
var getProdukTWanita = () => {
  return produk_tidak_terjual_wanita;
}
var getProdukTAnak = () => {
  return produk_tidak_terjual_anak;
}

var produk_terjual_pria = [];
var produk_terjual_wanita = [];
var produk_terjual_anak = [];

var getProdukPria = () => {
  return produk_terjual_pria;
}
var getProdukWanita = () => {
  return produk_terjual_wanita;
}
var getProdukAnak = () => {
  return produk_terjual_anak;
}

function pilih_data(id, date, url) {

  // set color
  $('#row_table_' + id + '').addClass('text-yellow-600 poppins-semibold');
  $('[id^="row_table_"]').not('#row_table_' + id + '').removeClass('text-yellow-600 poppins-semibold');

  // ajax
  $.ajax({
    type: "GET",
    url: url,
    data: {
      data_date: date,
    },
    beforeSend: function () {
      Swal.fire({
        title: 'Loading',
        html: '<div class="body-loading"><div class="loadingspinner"></div></div>', // add html attribute if you want or remove
        allowOutsideClick: false,
        showConfirmButton: false,

      });
    },
    success: async function (res) {
      const data = JSON.parse(res);
      console.log(data);

      const produk_pria = getDataProduk('pria', data.produk_terjual);
      const produk_wanita = getDataProduk('wanita', data.produk_terjual);
      const produk_anak = getDataProduk('anak', data.produk_terjual);
      const retur_cs = getData(data.retur_cs);
      const retur_sp = getData(data.retur_sp);

      produk_terjual_pria = produk_pria;
      produk_terjual_wanita = produk_wanita;
      produk_terjual_anak = produk_anak;

      produk_tidak_terjual_pria = getDataProduk('pria', data.produk_tidak_terjual);
      produk_tidak_terjual_wanita = getDataProduk('wanita', data.produk_tidak_terjual);
      produk_tidak_terjual_anak = getDataProduk('anak', data.produk_tidak_terjual);

      retur_customer = retur_cs;
      retur_supplier = retur_sp;

      const total_penjualan_produk_pria = getTotalProdukTerjual(produk_pria);
      const total_penjualan_produk_wanita = getTotalProdukTerjual(produk_wanita);
      const total_penjualan_produk_anak = getTotalProdukTerjual(produk_anak);
      const total_retur = getTotalProdukRetur(retur_sp, retur_cs);

      await $('#total_Produk_pria').html(formatRupiah(total_penjualan_produk_pria.toString(), 'Rp. '));
      await $('#total_Produk_wanita').html(formatRupiah(total_penjualan_produk_wanita.toString(), 'Rp. '));
      await $('#total_Produk_anak').html(formatRupiah(total_penjualan_produk_anak.toString(), 'Rp. '));
      await $('#total_retur').html(formatRupiah(total_retur.toString(), 'Rp. '));
      await $('#total_detail_pemasukan').html(formatRupiah((total_penjualan_produk_pria + total_penjualan_produk_wanita + total_penjualan_produk_anak + total_retur).toString(), 'Rp. '));

      Swal.close();
    }
  });
}


// show detail produk & retur
function showDetail(jenis) {

  if (getProdukTPria().length !== 0 || getProdukTWanita().length !== 0 || getProdukTAnak().length !== 0) {

    let data_tidak_terjual;
    let data_terjual;

    switch (jenis) {
      case 'pria':
        data_tidak_terjual = getProdukTPria();
        break;
      case 'wanita':
        data_tidak_terjual = getProdukTWanita();
        break;
      case 'anak':
        data_tidak_terjual = getProdukTAnak();
        break;
    }

    switch (jenis) {
      case 'pria':
        data_terjual = getProdukPria();
        break;
      case 'wanita':
        data_terjual = getProdukWanita();
        break;
      case 'anak':
        data_terjual = getProdukAnak();
        break;
    }

    let data_table_terjual = '';
    for (let i = 0; i < data_terjual.length; i++) {
      data_table_terjual += '<tr>';
      data_table_terjual += '  <td class="p-2 md:p-4 text-left" id="nama_br">' + data_terjual[i].nama_br + '</td>';
      data_table_terjual += '  <td class="p-2 md:p-4" id="jumlah_produk">' + data_terjual[i].jumlah + 'X</td>';
      data_table_terjual += '</tr>';
    }

    let data_table_tidak_terjual = '';
    for (let i = 0; i < data_tidak_terjual.length; i++) {
      data_table_tidak_terjual += '<tr>';
      data_table_tidak_terjual += '  <td class="p-2 md:p-4 text-left" id="nama_br">' + data_tidak_terjual[i].nama_br + '</td>';
      data_table_tidak_terjual += '</tr>';
    }

    $('#tb_terjual').html(data_table_terjual);
    $('#tb_t_terjual').html(data_table_tidak_terjual);
  }


  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_detail_produk").removeClass("scale-0");
  $("#konten_modal_detail_produk").addClass("scale-100");
}

function showDetail_retur() {

  if (getReturCs().length !== 0 || getReturSp().length !== 0) {

    let retur_cs = getReturCs();
    let retur_sp = getReturSp();

    let data_table_retur_cs = '';
    for (let i = 0; i < retur_cs.length; i++) {
      data_table_retur_cs += '<tr>';
      data_table_retur_cs += '  <td class="p-2 md:p-4 text-left">' + retur_cs[i].kode_retur_cs + '</td>';
      data_table_retur_cs += '  <td class="p-2 md:p-4" id="jumlah_produk">' + retur_cs[i].tanggal + '</td>';
      data_table_retur_cs += '  <td class="p-2 md:p-4" id="jumlah_produk">' + retur_cs[i].barang_retur_c_s.nama_br + '</td>';
      data_table_retur_cs += '  <td class="p-2 md:p-4" id="jumlah_produk">' + retur_cs[i].barang_keluar_retur_c_s.nama_br + '</td>';
      data_table_retur_cs += '  <td class="p-2 md:p-4 text-right">' + formatRupiah(retur_cs[i].bayar_kurang.toString(), 'Rp. ') + '</td>';
      data_table_retur_cs += '</tr>';
    }

    let data_table_retur_sp = '';
    for (let i = 0; i < retur_sp.length; i++) {
      data_table_retur_sp += '<tr>';
      data_table_retur_sp += '  <td class="p-2 md:p-4 text-left">' + retur_sp[i].kode_retur + '</td>';
      data_table_retur_sp += '  <td class="p-2 md:p-4">' + retur_sp[i].tanggal + '</td>';
      data_table_retur_sp += '  <td class="p-2 md:p-4">' + retur_sp[i].nama_br + '</td>';
      data_table_retur_sp += '  <td class="p-2 md:p-4">' + retur_sp[i].QTY + '</td>';
      data_table_retur_sp += '  <td class="p-2 md:p-4">' + retur_sp[i].jml_barang + '</td>';
      data_table_retur_sp += '  <td class="p-2 md:p-4">' + formatRupiah(retur_sp[i].jml_nominal.toString(), 'Rp. ') + '</td>';
      data_table_retur_sp += '</tr>';
    }

    $('#tb_cs').html(data_table_retur_cs);
    $('#tb_sp').html(data_table_retur_sp);
  }


  $("#bg_modal").removeClass("pointer-events-none");
  $("#bg_modal").addClass("opacity-50");
  $("#bg_modal").removeClass("opacity-0");

  $("#konten_modal_detail_retur").removeClass("scale-0");
  $("#konten_modal_detail_retur").addClass("scale-100");
}
// end show detail produk & retur

// close detail produk & retur
function closeModal_detail_retur() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_detail_retur").removeClass("scale-100");
  $("#konten_modal_detail_retur").addClass("scale-0");

  tab_cs();
}

function closeModal_detail_produk() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_detail_produk").removeClass("scale-100");
  $("#konten_modal_detail_produk").addClass("scale-0");

  tab_terjual();
}
// end close detail produk & retur

// tab detail produk
function tab_terjual() {
  $("#tab_terjual").addClass("bg-[#FFB015]");
  $("#tab_tidak_terjual").removeClass("bg-[#FFB015]");
  $("#container_tb_terjual").removeClass("hidden");
  $("#container_tb_t_terjual").addClass("hidden");
}

function tab_tidak_terjual() {
  $("#tab_terjual").removeClass("bg-[#FFB015]");
  $("#tab_tidak_terjual").addClass("bg-[#FFB015]");
  $("#container_tb_terjual").addClass("hidden");
  $("#container_tb_t_terjual").removeClass("hidden");
}
// end tab detail produk

// tab retur
function tab_cs() {
  $("#tab_cs").addClass("bg-[#FFB015]");
  $("#tab_sp").removeClass("bg-[#FFB015]");
  $("#container_tb_cs").removeClass("hidden");
  $("#container_tb_sp").addClass("hidden");
}

function tab_sp() {
  $("#tab_cs").removeClass("bg-[#FFB015]");
  $("#tab_sp").addClass("bg-[#FFB015]");
  $("#container_tb_cs").addClass("hidden");
  $("#container_tb_sp").removeClass("hidden");
}
// end tab retur