var scr = {
	'w'  : $(window).innerWidth(),
	'h' : $(window).innerHeight()
};
$(window).resize(function(){
	scr = {
		'w'  : $(window).innerWidth(),
		'h' : $(window).innerHeight()
	};
});
$.(document).ready(function(){
  $("#boutonOK").click(function()
  {
    'TestAPI.php',
    $.post({
      url : 'TestAPI.php';
      type :  'POST';
      datatype : 'JSON';
      data : 'search='+search;
    });
  });
});
