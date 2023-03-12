$("#btn_tambah").click(function (e) { 
    e.preventDefault();
    showModal();
});

$("#bg_modal").click(function (e) { 
    e.preventDefault();
    closeModal();
});

function ubahData(id){
    $("#txt_nama").val("Data ke " + id);
    showModal();
    console.log("Data ke " + id);
}

function showModal(){
    $("#bg_modal").removeClass("pointer-events-none");
    $("#bg_modal").addClass("opacity-50");
    $("#bg_modal").removeClass("opacity-0");

    $("#konten_modal").addClass("scale-100");
    $("#konten_modal").removeClass("scale-0");
}

function closeModal(){
    $("#bg_modal").addClass("pointer-events-none");
    $("#bg_modal").removeClass("opacity-50");
    $("#bg_modal").addClass("opacity-0");

    $("#konten_modal").removeClass("scale-100");
    $("#konten_modal").addClass("scale-0");
}

$("#btn_submit").submit(function (e) { 
    e.preventDefault();
    console.log("wdakdoawkdowa");
});