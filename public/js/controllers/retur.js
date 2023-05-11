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

  $("#konten_modal_add_retur").removeClass("scale-0");
  $("#konten_modal_add_retur").addClass("scale-100");

  $('#nama_produk').val(nama_produk);

}

function closeModal() {
  $("#bg_modal").addClass("pointer-events-none");
  $("#bg_modal").removeClass("opacity-50");
  $("#bg_modal").addClass("opacity-0");

  $("#konten_modal_add_retur").removeClass("scale-100");
  $("#konten_modal_add_retur").addClass("scale-0");

  resetForm();
}

function resetFilter() {
  location.replace("/retur");
}

let getValueSearch = () => { return $('#field_search').val() }

$(document).keyup(function (event) {
  if ($('#field_search').is(":focus") && event.key == "Enter") {
    let params = new URLSearchParams(window.location.search).get("filter")
    let param = params !== null ? "/?filter=" + params : "";
    location.replace("/retur/" + getValueSearch() + param)
  }
});

$('#filter_gender').on('change', function() {
  $('#filter_kategori').trigger('submit');
});

function submitRetur() {
  console.time("Function #1");
  if (fieldValidate()) {
    Swal.fire({
      title: "Tambah Retur",
      text: "Apakah anda yakin?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Tidak",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya",
    }).then((result) => {
      if (result.isConfirmed) {
        $("#form_retur").trigger("submit");
      }
    });
  }
  console.timeEnd("Function #1");
}

function fieldValidate() {

  const isError = Array(
    {
      "value": $("#jumlah_barang").val(),
      "message": "Jumlah tidak boleh kosong"
    },
    {
      "value": $("#supplier").val() === null ? "" : $("#supplier").val(),
      "message": "Supplier tidak boleh kosong"
    },
    {
      "value": $("#jumlah_retur").val() === "" && $("#jumlah_uang").val() === "" ? "" : true,
      "message": "Harap diingat, pada field yang disediakan, jumlah barang yang diretur dan jumlah uang yang dikembalikan tidak boleh kosong salah satunya"
    },
    {
      "value": $("#jumlah_retur").val() > $("#jumlah_barang").val() ? "" : true,
      "message": "Jumlah pengembalian melebihi jumlah retur"
    },
  );

  for (var i = 0; i < isError.length; i++) {
    if (isError[i]["value"] === "") {
      Swal.fire("Informasi", isError[i]["message"], "warning");
      return false
    }
  }

  $("#jumlah_retur").val() === "" ? $("#jumlah_retur").val(0) : "";
  $("#jumlah_uang").val() === "" ? $("#jumlah_uang").val(0) : "";

  return true
}
