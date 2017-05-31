$(document).ready(function() {

// debug();

/* ===============================================================

** Common functions
 
================================================================*/

startLoader();
asideToogle();
mobileMenu();
preventTouchDelay();
orientationChange();
dropDownBrands();
scrollbar();


/* ===============================================================

** IPAD
 
================================================================*/

if( navigator.platform === 'iPad' ){
  $('#rotationDevice p').text('Rotate your device');
  $('#rotationDevice span').text('horizontally');
} else {
  $('#rotationDevice p').text('Please visit');
  $('#rotationDevice span').text('Mobile version');
  startNicescroll();
  startSkrollr();
}




/* ===============================================================

** Home
 
================================================================*/

if ($('.wrapper.home').length > 0) {
	console.log('Home');
	startMasterSlider();
	openModals();
}

/* ===============================================================

** News
 
================================================================*/

if ($('.wrapper.news').length > 0) {
	  console.log('News');
	  startNewsSwiper()
	  scrollToAnchor();
}

/* ===============================================================

** Careers
 
================================================================*/

if ($('.wrapper.careers').length > 0) {
	  console.log('Careers');
}

/* ===============================================================

** Responsibility
 
================================================================*/

if ($('.wrapper.responsibility').length > 0) {
	console.log('responsibility');
	startNutritionSwiper()
}

/* ===============================================================

** Who we are
 
================================================================*/

if ($('.wrapper.who_we_are').length > 0) {
	console.log('Who we are');
}

/* ===============================================================

** Resize
 
================================================================*/

$(window).resize(function(){
		resizeFunctions();
});





});