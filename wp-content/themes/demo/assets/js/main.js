var jwsThemeModule; 
(function($){
 "use strict"; 
 jwsThemeModule = (function() {
  return {
    init: function() {
      this.search();
      this.user();
      this.hover();
      this.filtersColour();
      this.filtersSize();
      this.sliderServices();
      this.sliderConnetVideo();
      this.gallery();
    },
    // -----------------------click show/hiden search----------------
    search :function(){ 
      $('#search-call').removeClass('toggled');

      $('.jws-search').click(function(e) {
        e.stopPropagation();
        $('#search-call').toggleClass('toggled');
        $("#s").focus();
      });

      $('#search-call').click(function(e) {
        e.stopPropagation();
      });

      $('#close').click(function() {
        $('#search-call').removeClass('toggled');
      });

    },  
    // --------------click show/hiden from reigster & login---------------
    user :function(){ 
      $('#from-login').removeClass('login-show');
      $('.login').click(function(e) {
        e.stopPropagation();
        $('#from-login').toggleClass('login-show');
        $("#username").focus();
      });

      $('#customer_login').click(function(e) {
        e.stopPropagation();
      });
      $('#close-login').click(function() {
        $('#from-login').removeClass('login-show');
      });
    },  
    // --------------hover show My Acount && Logout--------------------------
    hover :function(){ 
      $(".elementor-element.elementor-element-a4871a0.elementor-column.elementor-col-20.elementor-top-column").hover(function(){
        $(".form-loged").css("display", "block");
      }, function(){
        $(".form-loged").css("display", "none");
      });
    },
    filtersColour :function(){
      $(".elementor-element.elementor-element-63e0594.elementor-widget.elementor-widget-jws_product_filter_atribute").click(function(){
        $(".jws_filter_attr").toggleClass("block");
      });
    },
    filtersSize :function(){
      $(".elementor-element.elementor-element-bea06b6.elementor-widget.elementor-widget-jws_product_filter_atribute").click(function(){
        $(".jws_filter_attr").toggleClass("block2");
      });
    },

    sliderServices :function(){
      $('ul.colunms').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
      });
    },
    //***ISOTOPE***
      // init Isotope
    gallery :function(){
      var $grid = $('ul#gallery').isotope({
        itemSelector: 'li.gallerys',
        layoutMode: 'masonry',
        hiddenStyle: {
          opacity: 0
        },
        visibleStyle: {
          opacity: 1
        }
      });

      // filter items on button click
      $('ul.lists-cat').on( 'click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
      });
      $('ul.lists-cat').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
          $buttonGroup.find('.is-checked').removeClass('is-checked');
          $( this ).addClass('is-checked');
        });
      }); 


      },

    sliderConnetVideo :function(){
      $('.testimonials_slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          fade: false,
          dots: false,
          asNavFor: '.slider-nav-thumbnails',
         });
      $('.slider-nav-thumbnails').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.testimonials_slider',
        focusOnSelect: true,
        vertical:true,
       });

       // Remove active class from all thumbnail slides
       $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

       // Set active class to first thumbnail slides
       $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

       // On before slide change match active thumbnail to current slide
       $('.slider-display').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var mySlideNumber = nextSlide;
        $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
        $('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
      });
    },
  }
}())
 $(document).ready(function() {
  jwsThemeModule.init();
}); 
})(jQuery);