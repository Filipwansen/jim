(function() {
    function navSidebar() {
      var $sideElement = $('#navbardropdown');
      var $sideParent = $('header');
      var $body = $('body');
      $sideElement.on('hidden.bs.collapse', function () {
        $sideParent.find('.sidebar-overlay').remove();
        $body.removeClass('scroll-hide');
      });
      $sideElement.on('show.bs.collapse', function () {
        $sideParent.append('<div class="sidebar-overlay" />');
        $body.addClass('scroll-hide');
      });
      $sideParent.on("click", ".sidebar-overlay", function () {
        $sideElement.collapse('hide');
      });
    }
    navSidebar();
    
  })();
    $(document).ready(function () {
        $(window).on('scroll', function(event) {
        var scrollValue = $(window).scrollTop();
        if (scrollValue > $('.header').height()) {
            $('.header-bottom').addClass('fixed-top');
        }else{
            $('.header-bottom').removeClass('fixed-top');
        } 
        });
        $('.blog-like').click(function(){
            if($(this).hasClass('active'))
              $(this).removeClass('active');
            else
              $(this).addClass('active');
          })
  });



function myFunction(x) {
   x.classList.toggle("fa-thumbs-down");
}
