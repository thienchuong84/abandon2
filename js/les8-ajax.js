// refer at http://api.jquery.com/jquery.ajax/

function ajaxSubmit(){
  var tmpDate = $("#ntc_abandon_date").val();
  var tmpCallerid = $("#ntc_callerid").val();
  
  $.ajax({
  method: "POST",
  url: "les8-ajax-submit.php",
  data: { tmpDate1: tmpDate, tmpCallerid1: tmpCallerid },
  })
  .done(function( msg ) {
    $('#position_that_you_show').html(msg);
  });
}



// for bootstrap datepicker
var page = {bootstrap:3};
function swap_bs(){
  var bscss = $('#bs-css'),
      bsdpcss = $('#bsdp-css');
  if (page.bootstrap == 3){
    bscss.prop('href', 'bootstrap-datepicker/css/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css');
    bsdpcss.prop('href', 'bootstrap-datepicker/css/datepicker.css');
    page.bootstrap = 2;
    $(page).trigger('change:bootstrap', 2)
  }
  else{
    bscss.prop('href', 'css/bootstrap.min.css');
    bsdpcss.prop('href', 'bootstrap-datepicker/css/datepicker3.css');
    page.bootstrap = 3;
    $(page).trigger('change:bootstrap', 3)
  }
}