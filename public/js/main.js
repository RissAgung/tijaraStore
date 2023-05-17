$(document).ready(function () {

  console.log("width : " + $(document).width() + " height: " + $(document).height());

  // show sidebar
  $("#burger").click(function (e) {
    e.preventDefault();
    $("#sidebar").addClass("sidebar-show");
    $("#bg-sidebar").removeClass("hidden");
    // $("#bg-sidebar").addClass("bg-black");
    // $("#bg-sidebar").removeClass("bg-white");
  });

  $("#bg-sidebar").click(function (e) {
    e.preventDefault();
    $("#sidebar").removeClass("sidebar-show");
    $("#bg-sidebar").addClass("hidden");
    // $("#bg-sidebar").removeClass("bg-black");
    // $("#bg-sidebar").addClass("bg-white");
  });


});

function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
$('#master_data').click(function (e) {
  e.preventDefault();
  if ($("#div_master").hasClass('show')) {
    $("#div_master").addClass("h-12");
    $("#div_master").removeClass("h-44 show");
  } else {
    $("#div_master").addClass("h-44 show");
    $("#div_master").removeClass("h-12");
  }
});
