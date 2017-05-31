/* ===============================================================


------------------------------------------------------------------
** Aside Contact
------------------------------------------------------------------
** debug
------------------------------------------------------------------
** startMasterSlider()
------------------------------------------------------------------
** startNicescroll()
------------------------------------------------------------------
** startSkrollr()
------------------------------------------------------------------
** startLoader()
------------------------------------------------------------------
** orientationChange()
------------------------------------------------------------------
** mobileMenu()
------------------------------------------------------------------
** preventTouchDelay() 
------------------------------------------------------------------
** resizeFunctions()
------------------------------------------------------------------
** openModals()

================================================================*/


/* ===============================================================

** Aside Contact
 
================================================================*/

function asideToogle(){

$('.contact_trigger').click(function(e){
    e.preventDefault();
    $('aside').velocity({'margin-top':0}, { duration: 500, easing: "easeInSine", delay: 0});
});

$('aside a.close').click(function(e){
    e.preventDefault();
    $('aside').velocity({'margin-top':-215}, { duration: 500, easing: "easeInSine", delay: 0});
});


}//asideToogle


/* ===============================================================

** Debug
 
================================================================*/

function debug(){

  $(document).on( "keydown", function( event ) {

      $(window).resize(function(){
        $('.debug').html($(window).width() + ' X ' + $(window).height());
      });

      if (event.keyCode == 68) {
        if ($('.debug').length == 0) {

          $('body').prepend('<div class="debug">' + $(window).width() + ' X ' + $(window).height() + '</div>');
          $('.debug').attr('style','background-color: rgba(0, 0, 0, 0.5)!important; color: #D9D9D9!important; position: fixed!important; left: 20px!important; top: 20px!important; z-index: 999999999999999999999999999!important; box-sizing: border-box!important; padding: 15px 10px!important; font: 14px/16px arial!important;');
          $('*').css("outline", "1px solid blue");
        } else {
          $('.debug').remove();
          $('*').css("outline", "none");
        };
      }
    });


}


/* ============================================

** startMasterSlider()

=============================================*/

function startMasterSlider() {

  
//Inicio masterslider
        var slider = new MasterSlider();
        slider.setup('masterslider' , {
             width:1920,    
             height:945,
             smoothHeight:true,
             fullwidth:true,
             speed:65,
             heightLimit:false,
             centerControls:false,   
             space:0,
             autoplay:true,
             loop:true
        });


//Agrego las flechas de navegación
        slider.control('arrows');




//Cliqueando cada thumbnail del paginado te redirije al slide correspondiente

        $('.barcel').click(function(){
            slider.api.gotoSlide(0);
        });

        $('.ricolino').click(function(){
            slider.api.gotoSlide(1);
        });

        $('.coronado').click(function(){
            slider.api.gotoSlide(2);
        });

        $('.vero').click(function(){
            slider.api.gotoSlide(3);
        });

//Cliqueando cada thumbnail resetea las clases active a los siblings y le asigna la clase active a la actual

        $('.pagination a').click(function(){
            $('.pagination a').removeClass('active');
            $(this).addClass('active');
        });


//Cada vez que swipea el slider cambia los estados activos del thumbnail según en que slide ete
        slider.api.addEventListener(MSSliderEvent.CHANGE_START , function(){
                if (slider.api.index() == 0) {
                    $('.pagination a').removeClass('active');
                    $('.pagination .barcel').addClass('active');
                }
                if (slider.api.index() == 1) {
                    $('.pagination a').removeClass('active');
                    $('.pagination .ricolino').addClass('active');
                }

                if (slider.api.index() == 2) {
                    $('.pagination a').removeClass('active');
                    $('.pagination .coronado').addClass('active');
                }

                if (slider.api.index() == 3) {
                    $('.pagination a').removeClass('active');
                    $('.pagination .vero').addClass('active');
                }
        });


          //Cliqueando un thumbnail, setea como abierto a productos, y lo abre para que se desplieguen los productos
        $('.pagination a').click(function(e){
              e.preventDefault();
             
                var product = '';

               if ($(this).hasClass('barcel')) {
                   product = 'barcel'; 
                } else if ($(this).hasClass('ricolino')) {
                   product = 'ricolino'; 
                } else if ($(this).hasClass('coronado')) {
                   product = 'coronado'; 
                } else if ($(this).hasClass('vero')) {
                   product = 'vero'; 
                }



              //Togglea el data de push down 
              $('.push_down').attr('data-open', $('.push_down').attr('data-open') == 'yes' ? 'no' : 'yes');


              //Inicia skrollr para que la variable exista
              var parallax = skrollr.init();

              //Si esta cerrado, pausar el masterslide, agranda la seccion de productos, aparece el boton de go back, anima el scroll para abajo, y aparecen los packagings con efecto
              if ( $('.push_down').attr('data-open') === "yes") {
                 slider.api.pause();

                
                 if ( product === 'barcel') {
                      $('.products_background').velocity({height:1600}, { duration: 500, easing: "easeInSine", delay: 0 });
                 }

                 if ( product === 'ricolino') {
                      $('.products_background').velocity({height:1100}, { duration: 500, easing: "easeInSine", delay: 0 });
                 }

                 if ( product === 'coronado') {
                      $('.products_background').velocity({height:700}, { duration: 500, easing: "easeInSine", delay: 0 });
                 }

                 if ( product === 'vero') {
                      $('.products_background').velocity({height:990}, { duration: 500, easing: "easeInSine", delay: 0 });
                 }


                $('.go_back').velocity({opacity:1}, { display: "block", duration: 500, easing: "easeInSine", delay: 0 });
                 parallax.animateTo($('.products_background').offset().top - 100);
                 
                 setTimeout(function(){
                    $('.products.' + product).show();
                    $('.products.' + product + ' a').velocity('transition.whirlIn');
                },1000);

             } else {

                //Si esta abierto, se van los packagings, el masterslide vuelve a autoplay, el boton de go back desparace y el scroll se anima para arriba nuevamente
                setTimeout(function(){
                 $('.products a:visible').velocity('transition.whirlOut');
                 $('.products').fadeOut(200);
                },0)

                setTimeout(function(){
                      slider.api.resume();
                      $('.products_background').velocity({height:190}, { duration: 500, easing: "easeInSine", delay: 0 });
                      $('.go_back').velocity({opacity:0}, { display: "none", duration: 500, easing: "easeInSine", delay: 0 });
                       parallax.animateTo($('.products_background').offset().top);
                       parallax.animateTo(0);
                },150);
              }
              
      });
 
          


          window.addEventListener('load', function() {
              if(window.location.hash) {
                   var hash = window.location.hash.substring(1);
                   
                   if(hash == 'barcel') {
                       slider.api.gotoSlide(0);
                       slider.api.pause();
                   } 
              
                  if(hash == 'ricolino') {
                      slider.api.gotoSlide(1);
                      slider.api.pause();
                  } 

                  if(hash == 'coronado') {
                      slider.api.gotoSlide(2);
                      slider.api.pause();
                  } 

                  if(hash == 'vero') {
                      slider.api.gotoSlide(3);
                      slider.api.pause();
                  } 




              }
          }, false);



          $('.brands a').click(function(e){
                e.preventDefault();

               /* console.log($(this).attr('data-section'));*/

               if( $(this).attr('data-section') == 'barcel' ) {
                       slider.api.gotoSlide(0);
                       slider.api.pause();
               }

               if( $(this).attr('data-section') == 'ricolino' ) {
                       slider.api.gotoSlide(1);
                       slider.api.pause();
               }

              if( $(this).attr('data-section') == 'coronado' ) {
                       slider.api.gotoSlide(2);
                       slider.api.pause();
               }

              if( $(this).attr('data-section') == 'vero' ) {
                       slider.api.gotoSlide(3);
                       slider.api.pause();
               }
                
          });


}

/* ============================================

** startNicescroll()

=============================================*/


function startNicescroll() {
    $('html').niceScroll({
      'mousescrollstep' : 50,
      'cursorcolor': "#fff",
      'cursorborder': "0",
      'autohidemode' : false,
      'horizrailenabled': false
    });



}

/* ============================================

** startSkrollr()

=============================================*/

function startSkrollr() {
    var parallax = skrollr.init({
      forceHeight: false
    });

/*    parallax.on('render', function(data) {
        console.log(data.curTop);
    });*/

}

/* ============================================

** startLoader()

=============================================*/


function startLoader(){

      var countImages = $('img').length,
      loadedImageCount = 0;
          
      $('body').imagesLoaded()
          .always( function( instance ) {})
          .done( function( instance ) {
                  console.log('All images loaded successfully.')
               
                setTimeout(function(){
                  $('.progress_overlay').velocity({opacity:0}, { duration: 500, easing: "easeInSine", delay: 0 , display: "none"});
                  $('.progress').velocity({opacity:0}, { duration: 500, easing: "easeInSine", delay: 0 , display: "none"});
                },100);

                setTimeout(function(){
                    $('.wrapper').velocity({opacity:1}, { duration: 500, easing: "easeInSine", delay: 400 });
                    $('.highlight').velocity({opacity:1}, { duration: 500, easing: "easeInSine", delay: 600 });
                    $('h1').velocity({opacity:1}, { duration: 400, easing: "easeInSine", delay: 800 });
                    $('.pagination').velocity("fadeIn", { duration: 400, easing: "easeInSine", delay: 1000 });
                },200)



           })
          .fail( function() {
              console.log('Something went wrong');
          })
          .progress( function( instance, image ) {

              loadedImageCount++;
              var progress = (loadedImageCount * 100) / countImages;
              var progressTotal = progress.toFixed(0);
              // console.log(progressTotal)
              if(image.isLoaded) {
                $('.progress').html(progressTotal + '%');
              }

         });   


}



/* ============================================

** orientationChange()

=============================================*/


function orientationChange(){


  function rotateActive(){

    $('#rotationDevice').addClass('active');
    setTimeout(function(){
      $('#rotationDevice div').addClass('animate_one');
      setTimeout(function(){
        $('#svgWrapper').addClass('rotate')
        setTimeout(function(){
          $('#rotationDevice p, #rotationDevice span').addClass('active');
        },200)
      },1000);
    },800); 

  };

  function rotateDesactive(){
    $('#rotationDevice').removeClass('active');
      setTimeout(function(){

      $('#rotationDevice div').removeClass('animate_one');
      $('#svgWrapper').removeClass('rotate');
      $('#rotationDevice p, #rotationDevice span').removeClass('active'); 
      },800)

  }

  function get_orientation_on_ini() {
      switch(window.orientation){
          case -90:
          case 90:
            rotateDesactive();
              break;
          default:
            rotateActive();
              break;
      }
  }

  function on_update_orientation(){
      switch(window.orientation){
          case -90:
          case 90:
            rotateDesactive();

              break;
          default:
            rotateActive();

              break;
      }
  }




  window.addEventListener('orientationchange', on_update_orientation);
  get_orientation_on_ini();

}


/* ============================================

** mobileMenu()

=============================================*/

function mobileMenu() {
    $('.mobile_menu_trigger').click(function(){
        $('.mobile_menu').attr('data-open', $('.mobile_menu').attr('data-open') == 'yes' ? 'no' : 'yes');
        $(this).toggleClass('active');
        $('.wrapper').toggleClass("pushed");
        
        if($('.mobile_menu').attr('data-open') === 'yes') {
          $('.wrapper').attr('style','position:fixed;opacity:1;');
        } else {
          $('.wrapper').attr('style','position:relative;opacity:1;');
        }

    });
}

/* ============================================

** preventTouchDelay()

=============================================*/

function preventTouchDelay(){
    window.addEventListener('load', function() {
        FastClick.attach(document.body);
    }, false);
}  

/* ============================================

** resizeFunctions()

=============================================*/

function resizeFunctions(){
       if($('.mobile_menu').attr('data-open') === 'yes') {
          $('.wrapper').removeClass("pushed");
          $('.mobile_menu_trigger').removeClass('active');
          $('.mobile_menu').attr('data-open','no');
          $('.wrapper').attr('style','position:relative;opacity:1;');
        } 

}  


/* ============================================

** openModals()

=============================================*/

function openModals(){

       $ ('.nutrition_facts li:odd').attr('style', 'background-color:#b47a0a');

      $('.products a').click(function(e){
        e.preventDefault();
        $('.overlay').addClass('active');
      });

      $(".overlay").click(function(e) {
      e.preventDefault();
        $(this).removeClass('active');
      }); 


      $(".nutrition_facts_trigger").click(function(e) {
        e.preventDefault();
        $('.nutrition').attr('data-open', $('.nutrition').attr('data-open') == 'yes' ? 'no' : 'yes');

           

              if($('.nutrition').attr('data-open') === 'yes') {
                     $('.nutrition').velocity({height:400}, { duration: 250, easing: "easeInSine", delay: 0 });
                     $('.modal .close').velocity({opacity:1}, { duration: 500, easing: "easeInSine", delay: 0 });
              } else {
                     $('.nutrition').velocity("reverse");
                     $('.modal .close').velocity("reverse");

              }


      
      }); 

    $(".modal .close").click(function(e) {
        e.preventDefault();
        $('.nutrition').attr('data-open', $('.nutrition').attr('data-open') == 'yes' ? 'no' : 'yes');
        $('.nutrition').velocity({height:75}, { duration: 250, easing: "easeInSine", delay: 0 });
        $('.modal .close').velocity({opacity:0}, { duration: 500, easing: "easeInSine", delay: 0 });
      }); 




      $(".overlay .modal").click(function(e) {
            if (!e)
            e = window.event;

            if (e.stopPropagation) {
            e.stopPropagation();
            }

            else {
            e.cancelBubble = true;
            }
      });  
}

 

/* ============================================

** scrollToAnchor()

=============================================*/


function scrollToAnchor(){

      $('.highlight .content article a').click(function(){
          $('html, body').animate({
              scrollTop: $( $(this).attr('href') ).offset().top - 150
          }, 600);
          return false;
      });

}



/* ============================================

** startNewsSwiper()

=============================================*/

function startNewsSwiper() {

  var newsSwiper = $('#news').swiper({
    mode:'horizontal',
    loop:false,
  onSlideChangeEnd: function () {
$('.news .slider_news .next, .news .slider_news .prev').show();
if(newsSwiper.activeIndex==0){
$('.news .slider_news .prev').fadeOut(250)
}
if(newsSwiper.activeIndex==newsSwiper.slides.length-1){
$('.news .slider_news .next').fadeOut(250)
}

  }
  });

  //Next 

  $('.news .slider_news .next').click(function(){newsSwiper.swipeNext()})

  //Prev 

  $('.news .slider_news .prev').click(function(){newsSwiper.swipePrev()})



    var pressSwiper = $('#press').swiper({
    mode:'horizontal',
    loop:false,
    onSlideChangeEnd: function () {

$('.news .slider_press .next, .news .slider_press .prev').show();

if(pressSwiper.activeIndex==0){
$('.news .slider_press .prev').fadeOut(250)
}
if(pressSwiper.activeIndex==pressSwiper.slides.length-1){
$('.news .slider_press .next').fadeOut(250)
}

    }
    });

    //Next 

    $('.news .slider_press .next').click(function(){pressSwiper.swipeNext()})

    //Prev 

    $('.news .slider_press .prev').click(function(){pressSwiper.swipePrev()})


        var campaignsSwiper = $('#campaigns').swiper({
    mode:'horizontal',
    loop:false,
    onSlideChangeEnd: function () {

$('.news .slider_campaigns .next, .news .slider_campaigns .prev').show();

if(campaignsSwiper.activeIndex==0){
$('.news .slider_campaigns .prev').fadeOut(250)
}
if(campaignsSwiper.activeIndex==campaignsSwiper.slides.length-1){
$('.news .slider_campaigns .next').fadeOut(250)
}


    }
    });

    //Next 

    $('.news .slider_campaigns .next').click(function(){campaignsSwiper.swipeNext()})

    //Prev 

    $('.news .slider_campaigns .prev').click(function(){campaignsSwiper.swipePrev()})

}



/* ============================================

** startNutritionSwiper()

=============================================*/

function startNutritionSwiper() {

  var nutritionSwiper = $('#nutrition').swiper({
    mode:'horizontal',
    loop:false,
  onSlideChangeEnd: function () {

$('.slider_nutrition .next, .slider_nutrition .prev').show();

if(nutritionSwiper.activeIndex==0){
$('.slider_nutrition .prev').fadeOut(250)
}
if(nutritionSwiper.activeIndex==nutritionSwiper.slides.length-1){
$('.slider_nutrition .next').fadeOut(250)
}


  }
  });

  //Next 

  $('.slider_nutrition .next').click(function(){nutritionSwiper.swipeNext()})

  //Prev 

  $('.slider_nutrition .prev').click(function(){nutritionSwiper.swipePrev()})



}



     
      
             



/* ============================================

** dropDownBrands()

=============================================*/

function dropDownBrands() {

    $("li.brands").hover(function(){
             $(this).addClass('active');
             $(this).find('ul').fadeIn(250);
            },
            function(){
            $(this).removeClass('active');
            $(this).find('ul').fadeOut(250);
        });
}



/* ============================================

** scrollbar()

=============================================*/

function scrollbar() {
    $('.scrollable').perfectScrollbar();
}


