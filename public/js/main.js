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

});