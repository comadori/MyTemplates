
// POPUP WINDOW //////////////////////////////////////////////////////////
function openWin(theURL, name, features ){
  window.open( theURL, name, features );
}
function closeWin(){
  window.close();
}


// ANCHOR LINK ///////////////////////////////////////////////////////////////

__InpageLinkTopOffset = 0;
__InpageLinkSpeed     = 500;
$(function(){
  $("a[href^=#]").click(function(){
    var Hash = $(this.hash);
    var HashOffset = $(Hash).offset().top-__InpageLinkTopOffset;
    $("html,body").animate({
      scrollTop: HashOffset
    }, __InpageLinkSpeed);
    return false;
  });
});

$(window).load(function() {
  var topBtn = $('.totop');
  topBtn.hide();

  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });
});



// SP MENU ///////////////////////////////////////////////////////////////
$(document).ready(function(){
	$('ul.sNav li.close').css({'display':'none'});
	$('ul.sNav li.open').click(function(){
		$('nav.gNav').slideDown(100);
		$('ul.sNav li.close').show();
		$('ul.sNav li.open').hide();
  	});
	$('ul.sNav li.close').click(function(){
		$('nav.gNav').slideUp(100);
		$('ul.sNav li.close').hide();
		$('ul.sNav li.open').show();
 	});
});
// ウインドウを変更した際のナビゲーションの表示
$(window).bind('resize', function(){
  if ( $(window).innerWidth() > 481 ) {
    $('nav.gNav').show();
  }
  else {
    $('ul.sNav li.close').click();
  }
});



// SEARCH BOX ///////////////////////////////////////////////////////////////
$(document).ready(function(){
  
  var $searchTrigger = $('[data-searchbox="trigger"]'),
      $searchInput = $('[data-searchbox="input"]'),
      $searchClear = $('[data-searchbox="clear"]');

$searchTrigger.click(function(){
    var $this = $('[data-searchbox="trigger"]');
    $this.addClass('active');
    $searchInput.focus();
  });

$searchInput.blur(function(){
    if($searchInput.val().length > 0){
      
      return false;
      
    } else {
      
      $searchTrigger.removeClass('active');
      
    }
    
  });
  
  $searchClear.click(function(){
    $searchInput.val('');
  });
  
  $searchInput.focus(function(){
    $searchTrigger.addClass('active');
  });
  
});