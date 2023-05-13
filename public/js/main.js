$(document).ready(function () {

  console.log("width : "+$(document).width()+" height: "+$(document).height());

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

  $('#master_data').click(function (e) { 
    e.preventDefault();
    if($("#div_master").hasClass('show')){
      $("#div_master").addClass("h-12");
      $("#div_master").removeClass("h-44 show");
    } else {
      $("#div_master").addClass("h-44 show");
      $("#div_master").removeClass("h-12");
    }
  });
  

});