function scrollToTop(){verticalOffset="undefined"!=typeof verticalOffset?verticalOffset:0,element=jQuery("body"),offset=element.offset(),offsetTop=offset.top,jQuery("html, body").animate({scrollTop:offsetTop},500,"linear")}jQuery(function(){var e=jQuery(".video");e.on("click",function(){var e=jQuery(this),o=e.contents(),t=o.length,r=null;elm_id=e.attr("id");for(var s=0;t>s;s++)8===o[s].nodeType&&(r=o[s].textContent);jQuery(".section-"+elm_id).css("background",""),e.addClass("player").html(r),e.off("click"),jQuery(".carousel").carousel("pause")})}),jQuery(function(){jQuery(document).on("scroll",function(){jQuery(window).scrollTop()>100?jQuery(".scroll-top-wrapper").addClass("show"):jQuery(".scroll-top-wrapper").removeClass("show")}),jQuery(".scroll-top-inner").on("click",scrollToTop)}),jQuery("#scroll-to-top-wrapper").affix({offset:{top:100,bottom:function(){return this.bottom=jQuery("#site-footer").outerHeight(!0)}}}),jQuery(document).bind("keyup",function(e){39===e.which?jQuery(".carousel").carousel("next"):37===e.which&&jQuery(".carousel").carousel("prev")}),jQuery(".carousel").carousel({pause:"hover"}),jQuery(window).load(function(){jQuery(".widget_twserviceswidget .services").isotope({itemSelector:".service",layoutMode:"fitRows"}),jQuery(".widget_twservicescategorywidget .service-categories").isotope({itemSelector:".service-category",layoutMode:"fitRows"}),jQuery("#related-posts .related-post-inner").isotope({itemSelector:".related-post-container",layoutMode:"fitRows"})}),jQuery(window).smartresize(function(){jQuery(".widget_twserviceswidget .services").isotope({itemSelector:".service",layoutMode:"fitRows"}),jQuery(".widget_twservicescategorywidget .service-categories").isotope({itemSelector:".service-category",layoutMode:"fitRows"}),jQuery("#related-posts .related-post-inner").isotope({itemSelector:".related-post-container",layoutMode:"fitRows"})});