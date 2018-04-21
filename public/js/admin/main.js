$(document).ready(function() {
  $(document).on('click', '.open_down', function (e) {
    if($(this).find('.child_menu').hasClass('open')){
      $(this).find('.child_menu').removeClass('open');
    }else{
      $(this).find('.child_menu').addClass('open');
    }
  })

  $(function() {
    $( "#datepicker" ).datepicker({
      'formatDate': 'd.m.Y'
    });
  });
})
