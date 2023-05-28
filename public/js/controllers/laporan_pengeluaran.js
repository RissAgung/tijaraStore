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

  $('#row_table_1').addClass('text-yellow-600 poppins-semibold');
});

const sumTotal = (data) => {
  let finaldata = 0;

  for (let i = 0; i < data.length; i++) {
    finaldata += data[i].total
  }
  return finaldata;
}

const sumTotalRetur = (data) => {
  let finaldata = 0;

  for (let i = 0; i < data.length; i++) {
    finaldata += data[i].kembalian_tunai + data[i].bayar_tunai
  }
  return finaldata;
}

var detail_restock = [];
var detail_operasional = [];
var detail_retur = [];

var getDetailRestock = () => {
  return detail_restock;
}
var getDetailOperasional = () => {
  return detail_operasional;
}
var getDetailRetur = () => {
  return detail_retur;
}

function loadDefaultDetail(date, url) {
  $.ajax({
    type: "get",
    url: url,
    data: {
      data_date: date,
    },
    success: async function (res) {
      const data = JSON.parse(res);

      const dataRestock = data.restock;
      const dataOperasional = data.operasional;
      const dataRetur = data.retur_cs;

      const totalRestock = sumTotal(dataRestock);
      const totalOperasional = sumTotal(dataOperasional);
      const totalRetur = sumTotalRetur(dataRetur);

      detail_restock = dataRestock;
      detail_operasional = dataOperasional;
      detail_retur = dataRetur;

      await $('#total_restock').html(formatRupiah(totalRestock.toString(), 'Rp. '));
      await $('#total_operasional').html(formatRupiah(totalOperasional.toString(), 'Rp. '));
      await $('#total_retur').html(formatRupiah(totalRetur.toString(), 'Rp. '));
    }
  });
}

// get data saat click
function pilih_data(id, date, url) {

  // set color
  $('#row_table_' + id + '').addClass('text-yellow-600 poppins-semibold');
  $('[id^="row_table_"]').not('#row_table_' + id + '').removeClass('text-yellow-600 poppins-semibold');

  $.ajax({
    type: "get",
    url: url,
    data: {
      data_date: date,
    }, beforeSend: function () {
      Swal.fire({
        title: 'Loading',
        html: '<div class="body-loading"><div class="loadingspinner"></div></div>', // add html attribute if you want or remove
        allowOutsideClick: false,
        showConfirmButton: false,

      });
    },
    success: async function (res) {
      const data = JSON.parse(res);

      const dataRestock = data.restock;
      const dataOperasional = data.operasional;
      const dataRetur = data.retur_cs;

      const totalRestock = sumTotal(dataRestock);
      const totalOperasional = sumTotal(dataOperasional);
      const totalRetur = sumTotalRetur(dataRetur);

      detail_restock = dataRestock;
      detail_operasional = dataOperasional;
      detail_retur = dataRetur;

      await $('#total_restock').html(formatRupiah(totalRestock.toString(), 'Rp. '));
      await $('#total_operasional').html(formatRupiah(totalOperasional.toString(), 'Rp. '));
      await $('#total_retur').html(formatRupiah(totalRetur.toString(), 'Rp. '));

      Swal.close();
    }
  });

  // console.log(date);
}

function showDetail(param) {

  if (param === 'restock') {
    $("#tb_restock").removeClass("hidden");
    $("#tb_operasional").addClass("hidden");
    $("#tb_retur").addClass("hidden");
    $('#title_detail').html('Detail Re-stock');

    let data = getDetailRestock()
    let data_html = '';

    for (let i = 0; i < data.length; i++) {
      data_html += '<tr>';
      data_html += '<td class="text-left p-3">' + data[i].kode_pengeluaran + '</td>';
      data_html += '<td class="text-center p-3">' + data[i].tanggal + '</td>';
      data_html += '<td class="text-center p-3">' + data[i].pengeluaran_barang.barang.nama_br + '</td>';
      data_html += '<td class="text-center p-3">' + data[i].jumlah + '</td>';
      data_html += '<td class="text-right p-3">' + formatRupiah(data[i].total.toString(), 'Rp. ') + '</td>';
      data_html += '</tr>';
    }
    $('#data_tb_restock').html(data_html);
  } else if (param === 'operasional') {
    $("#tb_restock").addClass("hidden");
    $("#tb_operasional").removeClass("hidden");
    $("#tb_retur").addClass("hidden");
    $('#title_detail').html('Detail Operasional');

    let data = getDetailOperasional()
    let data_html = '';

    for (let i = 0; i < data.length; i++) {
      data_html += '<tr>';
      data_html += '<td class="text-left p-3">' + data[i].kode_pengeluaran + '</td>';
      data_html += '<td class="text-center p-3">' + data[i].tanggal + '</td>';
      data_html += '<td class="text-center p-3">' + data[i].item_operasional + '</td>';
      data_html += '<td class="text-right p-3">' + formatRupiah(data[i].total.toString(), 'Rp. ') + '</td>';
      data_html += '</tr>';
    }
    $('#data_tb_operasional').html(data_html);
  } else if (param === 'retur') {
    $("#tb_restock").addClass("hidden");
    $("#tb_operasional").addClass("hidden");
    $("#tb_retur").removeClass("hidden");
    $('#title_detail').html('Detail Retur');

    let data = getDetailRetur()
    let data_html = '';

    for (let i = 0; i < data.length; i++) {

      let produk_retur = data[i].barang_retur_c_s !== null ? data[i].barang_retur_c_s.nama_br : '-';
      let produk_keluar = data[i].barang_keluar_retur_c_s !== null ? data[i].barang_keluar_retur_c_s.nama_br : '-';
      let kembalian_tunai = data[i].kembalian_tunai !== null ? formatRupiah(data[i].kembalian_tunai.toString(), 'Rp. ') : formatRupiah('0', 'Rp. ');
      let bayar_tunai = data[i].bayar_tunai !== null ? formatRupiah(data[i].bayar_tunai.toString(), 'Rp. ') : formatRupiah('0', 'Rp. ');

      data_html += '<tr>';
      data_html += '<td class="text-left p-3">' + data[i].kode_retur_cs + '</td>';
      data_html += '<td class="text-center p-3">' + data[i].tanggal + '</td>';
      data_html += '<td class="text-center p-3">' + produk_retur + '</td>';
      data_html += '<td class="text-center p-3">' + produk_keluar + '</td>';
      data_html += '<td class="text-center p-3">' + kembalian_tunai + '</td>';
      data_html += '<td class="text-right p-3">' + bayar_tunai + '</td>';
      data_html += '</tr>';
    }
    $('#data_tb_retur').html(data_html);
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