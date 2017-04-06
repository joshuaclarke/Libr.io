$.(documents).ready(function(){
  $("#boutonOK").click(function()
  {
    'TestAPI.php',
    $.get({
      url : 'TestAPI.php';
      type :  'get';
      datatype : 'JSON';
      data : 'search='+search;
    });
  });
});
