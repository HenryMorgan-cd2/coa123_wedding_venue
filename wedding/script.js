$(function(){

  $('.datepicker[name=earliest]').datepicker({
    onClose: function( selectedDate ) {
      $(".datepicker[name=latest]").datepicker( "option", "minDate", selectedDate );
    }
  });
  $('.datepicker[name=latest]').datepicker({
    onClose: function( selectedDate ) {
      $(".datepicker[name=earliest]").datepicker( "option", "maxDate", selectedDate );
    }
  });

});