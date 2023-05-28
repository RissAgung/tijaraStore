$(document).ready(function () {
  $('#menuLaporan').click(function (e) {
    $('#menuDropDown').toggleClass('max-md:hidden');
    $("#arrowMenu").toggleClass('rotate-180');
  });

  $('#btn_submit_filter').click(function (e) {

    if (getDataFilter() !== false) {
      loadDefaultSeries(getDataFilter())
      loadDefaultPie(getDataFilter())
      closeModalFilter()
    }

  });

  $('#btn_export').click(function (e) {
    let data = [getTotalPemasukan(), getTotalPengeluaran()]

    let send = btoa(data);
    location.replace("/laporan/akumulasi.export/" + send)
  });
});