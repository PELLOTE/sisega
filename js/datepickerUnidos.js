//Validador de fecha
$('.datepicker1').on('changeDate', function(e){
    if(!$('.datepicker2').val()){
      $('.datepicker2').datepicker('setStartDate', $(this).val());
  }
  else{
    from = $(".datepicker1").val().split("/");
    date1 = new Date(from[2], from[1]-1, from[0]);
    from = $(".datepicker2").val().split("/");
    date2 = new Date(from[2], from[1]-1, from[0]);
    if( date2 < date1)  $('.datepicker2').datepicker('update', $(this).val());
    $('.datepicker2').datepicker('setStartDate', $(this).val());
  }
});
