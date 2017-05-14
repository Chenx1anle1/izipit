// ;(function($){
//  var oAutoFixed = $('.auto-fixed');
//  if ( !oAutoFixed.length ) { return; }
//  var authsTop = $('.auths').offset().top;
//  $(window).scroll(function(){
//      var scrollTop = $(this).scrollTop();
//      oAutoFixed.each(function(i, ele){
//          var prevAll = $(ele).prevAll(),
//              prevAllH = 0;
//          prevAll.each(function(i, ele){
//              prevAllH += $(ele).height();
//          });
//          var eleTop = $(ele).parent().offset().top+prevAllH;
//          var eleHeight = $(ele).height();
//          // console.log(scrollTop, authsTop);
//          //$(ele)[(scrollTop>=eleTop ? 'add' : 'remove')+'Class']('fixed');
//          var top = authsTop-scrollTop-eleHeight;
//          // console.log(scrollTop, eleTop, scrollTop+eleHeight, authsTop);
//          if ( scrollTop>=eleTop ) {
//              $(ele).addClass('fixed');
//              if ( (scrollTop+eleHeight) >= authsTop ) {
//                  $(ele).css('top', top);
//              }else{
//                  $(ele).css('top', 0);
//              }
//          }else{
//              $(ele).removeClass('fixed');
//          }
            
//      });
//  });
// })(jQuery);
;(function($){
    var oAutoFixed = $('.auto-fixed');
    if ( !oAutoFixed.length ) { return; }
    var oRangeBox = oAutoFixed.parents('.layout');
    
    var fixedTop = oAutoFixed.offset().top;
    $(window).scroll(function(){
        var scrollTop = $(this).scrollTop();

        var fixedHeight = oAutoFixed.height(),
            iRangeTop = oRangeBox.offset().top,
            iRangeBottom = oRangeBox.height() + iRangeTop;

        if ( scrollTop > (fixedTop) ) {
            oAutoFixed.addClass('fixed');
        }else{
            oAutoFixed.removeClass('fixed');
        }
        if ( scrollTop+fixedHeight > iRangeBottom ) {
            var top = iRangeBottom - scrollTop - fixedHeight;   
            oAutoFixed.css('top', top);
        }else{
            oAutoFixed.css('top', 0);
        }
    });
})(jQuery);