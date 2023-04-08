$('#burger').click(function (e) { 
  e.preventDefault();
  $('#span1').toggleClass('span1');
  $('#span2').toggleClass('span2');
  $('#span3').toggleClass('span3');
  $('#menu_navbar').toggleClass('hidden');
  $('#menu_navbar').toggleClass('flex');
});

