$(document).ready(function() {
  $(document).on('click', '.side-menu .fa-chevron-down', function () {
    if($('.side-menu .child_menu').hasClass('open')){
      $('.side-menu .child_menu').removeClass('open');
    }else{
      $('.side-menu .child_menu').addClass('open');
    }
  })
})
