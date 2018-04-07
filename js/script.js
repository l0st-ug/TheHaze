$(function() {
  var topoffset = 70; //variable for menu height

  //Use smooth scrolling when clicking on navigation
  $('.navbar-nav a').click(function() {
    if (location.pathname.replace(/^\//,'') === 
      this.pathname.replace(/^\//,'') && 
      location.hostname === this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top-topoffset
        }, 500);
        return false;
      } //target.length
    } //click function
  }); //smooth scrolling

});

// scrollbar effect on menu
$(document).ready(function(){
  var scroll_top = 0;
  $(window).scroll(function(){
    scroll_top = $(window).scrollTop();
     $('.counter').html(scroll_top);
    
    if (scroll_top >= 100) {
      $('#mynav').addClass('scrolled');
    } else if (scroll_top < 100) {
      $('#mynav').removeClass('scrolled');
    } 
  });  
});
