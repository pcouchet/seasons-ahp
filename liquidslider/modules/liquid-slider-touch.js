touch:function(){var f=this;d(f.sliderId+" .panel").swipe({fallbackToMouseEvents:false,allowPageScroll:"vertical",swipe:function(h,g){f.swipeDir=(g==="left")?"right":"left";if(!f.options.continuous){if(((f.currentTab===0&&g==="right")||((f.currentTab===(f.panelCount-1))&&g==="left"))&&f.options.slideEaseFunction!=="fade"){return false}}f.setCurrent(f.swipeDir);f.clickable=false;d(this).trigger("click");if(f.options.autoSlide){f.checkAutoSlideStop()}if(typeof f.options.callbackFunction==="function"){f.animationCallback(true)}}})},