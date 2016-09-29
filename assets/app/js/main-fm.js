/*!
	Marena - One Page Vertical / Horizontal Template
	Copyright (c) 2014, Subramanian 

	Author: Subramanian
	Profile: themeforest.net/user/FMedia/

	Version: 1.0.0
	Release Date: July 2014
	
	Built using: jQuery 		version:1.6.2	http://jquery.com/
	jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
	
 */


(function( $ ){	
	
	"use strict";
	
	function mainFm(selector, params){
		
		var defaults = $.extend({}, {
				
				// default variables				
				
				currentPage : "!home",				// Set the current page

				animationSpeed : 1000,				// Default animation speed
				
				slideshowSpeed : 5000				// Flexslider slideshow delaytime on porfolio detail page 
				
			} , params);

			
// Initialize required variables and objects
			var self = this;
			
			self.layoutHorizontal = $("body").hasClass("horizontal_layout");			
				
			if(($("body").hasClass("high_mobile_performance") && window.innerWidth <992)){
				$("body").addClass("horizontal_layout");
			}
			
			self.onePage = $("body").hasClass("not_onepage_ver") ? false : true;	
			
			self.screenWidth =  window.innerWidth;
			
			self.alignPgHor = self.scrollHorizontal = scrollHorizontal = self.onePage ? $("body").hasClass("horizontal_layout") : false;
			
			self.homePage = defaults.currentPage === "" ? "!home" : defaults.currentPage;
			
			self.aniDelay = 50;
			
			self.stageWidth =  window.innerWidth;
			self.stageHeight =  window.innerHeight;

			self.winWidth =  self.stageWidth;
			self.winHeight =  self.stageHeight;

			self.selEle = $(selector);
			self.IEbrowser = $.browser.msie;
			self.mobile = self.stageWidth <= 959;
			self.midMobile = self.stageWidth <= 767 && self.stageWidth > 479;
			self.minMobile = self.stageWidth <= 480;
			self.mobileDevice = self.screenWidth < 1024 && screen.height < 1024;
			ipad = (self.stageWidth === 768 || self.stageHeight === 768) && (self.stageWidth === 1024 || self.stageHeight === 1024) ;
			self.ipadPort = (self.stageWidth >= 768 &&  self.stageWidth < 1024);
			self.navTop = self.stageWidth <= 959;	
			self.StgHig = iPhoneDevice ? screen.height-60 : self.winHeight;
			
			lowResDesktop = self.stageWidth <= 979;
						
			self.lowMobile = self.stageWidth < 769;

			self.aniSpeed = defaults.animationSpeed;
			self.flxDelay =  flxDelay = defaults.slideshowSpeed;
			
			self.headerMc = $(".header");	
			self.headMeuTyp1 = self.headerMc.hasClass("menuType1");		
			
			self.curPgChk = undefined;								
			self.isoAniFin = false;
			
			self.removeAutoposition = false;			
			self.enableAutoposition = true;
			self.temprDisableAutoposition;
			
			self.miniMenu = $(".header").hasClass("mini_menu");	
			self.dottedNav = $(".dotted-nav li a");		
			self.dottedNav_added = self.dottedNav.length > 0 ? true : false;
			
			self.enableLowPerformance = isTouch || window.innerWidth < 1025;		
			self.HideUnuse = self.alignPgHor  ? false : self.enableLowPerformance ? true : false;
			/* Enable/Disable page content animaation*/				
			self.disableAnimation =  isTouch || self.screenWidth < 1025 ? true : false;			
			//self.disableAnimation = true;
		
			self.azh = undefined;
					
			if(!self.onePage){
				$('.contentWrapper').attr("data-id", self.homePage);
			}
			
			$(".itemOver").attr({"aria-haspopup":"true"});

			
			self.rsSliderMc = $(".rs_slider");
			
			self.bdy = $("body");
			self.htmlBody = $("html, body");
			self.foot = $(".footer");	
			self.foter_close = $(".footer_close");
			self.navUl = $('.nav');
						
			self.pgNex = $(".nextPage");
			self.pgPre = $(".previousPage");
			self.pgNexPre = $(".pageNavigation");
			
			self.pgUp = $(".pgScrollUp");
			
			self.bdy.data("width", Number(self.stageWidth));
			self.bdy.data("height", Number(self.stageHeight));

			self.pageLoaded = false;
			
			self.pageLoadfinished = false;
			self.projFm = false;
			self.apis = [];
			self.ff = -1;
			
			self.ContPgTopSpace = 360;
			
			self.supportScrollBar = true;
			if(!self.layoutHorizontal && $.browser.mozilla){			
				self.supportScrollBar = false;
			}
			
			
			self.singleBg = true;
			
			if(self.onePage){
				self.cM = $('.contentWrapper [data-id="'+"#"+self.homePg+'"]').parent();
				self.cM_= $('.contentWrapper [data-id="'+"#"+self.homePg+'"]');
			}else{
				self.cM = $('.contentWrapper [data-id="'+self.homePg+'"]').parent();
				self.cM_= $('.contentWrapper [data-id="'+self.homePg+'"]');
			}
			
			self.hSlider = $(".homeSlider");
			self.hSliderResp = $(".homeSlider .fullHeight.fullResponse");
			self.hSliderVid = $(".homeSlider .fullHeight.fullResponse .video_content.backGroundVideo");

			
			// create Menu fadeout layer
			self.headerFad = $(".pageFade");
			$(".loading_2x").clone().appendTo($(".pageFade"));
			$(".loading_2x .text").html("0%" );
			
			self.contClose = $(".closeBtn");
			

			$(".header_content").data("open", false)
			
			self.bdy.prepend('<div id="dumDiv" style="position:absolute"> </div>');	
			self.dumDiv = self.bdy.children(':first-child');
			
			self.conArry = [];
			$("body").find('.contentWrapper').each(function(){
				self.conArry.push($(this));				
			});	
			
			var prId = 0;
			$("body").find('.gallery_autoThumbnail').each(function(){				
				$(this).find(".carousel_preview").attr("id", "prjId"+prId);					
				if($(this).find(".carousel_container").length == 0){
					$(this).append('<div class="carousel_container thumbItem_holder withoutThumb remove_bottomSpace"> <ul class="carousel_thumbails"> </ul></div>');
					var carThu = $(this).find(".carousel_thumbails");
					var thuNo = 0;
					$(this).find(".carousel_preview").find(".carousel_item").each(function(){
						$(this).attr('id', "prjId"+prId+"-"+thuNo);
						carThu.append('<li> <img src="images/0.png" alt="image01" /> </li>');
						carThu.children(":last-child").attr('data-preview', "#prjId"+prId+"-"+thuNo);
						thuNo++;
					});
				}
				
				$(this).find(".carousel_container").attr("data-link", "#prjId"+prId);
				
				
				prId++;		
			});
			
			
			$('body').find('.flexSlideshow').each(function(){
				  $(this).data("loaded", false);
			  });
					
			if(self.HideUnuse){
				for(var bb=0; bb < self.conArry.length; bb++){	
					self.conArry[bb].css({"visibility":"hidden"});
				}
			}
			
			self.navArry = [];
			for(var ab=0; ab < self.conArry.length; ab++){
				var n_spt = self.conArry[ab];
				if(n_spt.attr("data-id") !== undefined){
					self.navArry.push(self.conArry[ab]);
				}		
			}
			
			for(var ik=0; ik < self.navArry.length; ik++){
				self.navArry[ik].addClass("enablHardwareAcc");
			}
			
			$("a").each(function() {
				if($(this).attr("href") === "#" ){				
					$(this).removeAttr("href");								
				}
			});
			
			self.previewSetting();
			
			// Scroll bar added for require div
			
			if(self.alignPgHor){
				if(!isTouch){
					self.addScrollbar();
				}else{											
				  $(".m-Scrollbar").each(			
					  function(){ 
					    $(this).css({"overflow-y":"auto", "overflow-x":"hidden", "-webkit-overflow-scrolling": "touch"});
					    $(this).addClass("enablHardwareAcc");
						 var srcInt;
						 var mcScr = $(this);
							$(this).scroll(function() {
									clearInterval(srcInt);
									srcInt = setInterval(function(){
									clearInterval(srcInt);
									if( -mcScr.scrollTop() < -150){									
										for(ik =0; ik< self.curPageShow.data("fms").length; ik++){
											if(self.curPageShow.data("fms")[ik].data("loaded")){					
												self.curPageShow.data("fms")[ik].fmMainSlider("pause_slideshow");				
											}
										}																
										self.curPageShow.find('[data-animated-in]').each(function(){
											self.animateObject($(this), -mcScr.scrollTop());
										});
									}
							}, 250);			
						});
				  });
				}
			}else{
				if(isTouch){
				  self.htmlBody.css({ "-webkit-overflow-scrolling": "touch"});
				}
			}
			
			// Initialize niceScroll to html
			if(!isTouch && !self.IEbrowser && self.supportScrollBar ){	
				self.nicScrl = $("html").niceScroll({ zindex : 92200000, styler:"fb", cursorborder : "0px",scrollspeed : 100, cursorminheight:100 , cursorwidth:"10px", horizrailenabled:false });
			}else{
				self.htmlBody.css({"overflow-y":"auto"});
			}
			
			self.bdy.css("display","block");			
	

// Page buttons ==================================================================
			 
			
			// Page scrollUp button
			self.pgScrUp =  $(".move_up, .goTop");
			
			$(".pgScrollUp, .move_up, .goTop").click(function(){
				self.scroll_update(0);
				if(self.onePage && !isMobileChk){
					window.location.href = "#"+self.homePage;
				}
				self.htmlScroll.animate({ scrollTop: "0px" }, 500, "easeInOutQuart" );
			});
			
			// Cache the Window object
			self.scrollObj = $("body, html");
			self.pgAll = $(".bodyContainer");
			self.$html = $("html");
			self.$window = $("body");	


			$(".contactPage .contactPage_content").css({ "min-height": self.stageHeight - self.ContPgTopSpace, "margin-top": self.ContPgTopSpace } );
			
			self.htmlScroll = isNaN($("body").scrollTop()) ? $("html") : $("body");	
			
			
			
			// Full Screen gallery thumbnail code
			for(var ab=0; ab < self.conArry.length; ab++){
				var url__ = self.conArry[ab].attr("data-id");
				self.conArry[ab].find(".fullScreenGallery_thumbnails").each(function(){
					$(this).data("url_",url__);
				});
				
				self.conArry[ab].find(".projDetailLoad").each(function(){
					$(this).data("url_",url__);
				});
				
				self.conArry[ab].find(".fmSlider").each(function(){
					$(this).data("url_",url__);
				});	
			}
			
			// Portfolio project detail page - up down arrow keyboard  action
			$(".projDetailLoad").each(function(){				
				var sel = $(this);
				$('html').keydown(function(e){
					if(sel.data("url_") === self.url && sel.find(".projConWarp").length>0){
						if (e.keyCode === 39) { //up
							sel.find(".next_button_pro").trigger('click');
							return false; 
						} 
						if (e.keyCode === 37) { //down 
							sel.find(".previous_button_pro").trigger('click');
							return false; 
						} 
					}
				});
			});
				
			
			// fmSlider - up down arrow keyboard  action
			$(".fmSlider").each(function(){				
				var sel = $(this);
				$('html').keydown(function(e){
					if(sel.data("url_") === self.url){	
						if(sel.data("loaded")){		
							if (e.keyCode === 39) { //up
								sel.fmMainSlider("Next");
								return false; 
							} 
							if (e.keyCode === 37) { //down 
								sel.fmMainSlider("Previous");
								return false; 
							} 
						}
					}
				});
			});
			
			// Fullscreen gallery - up down arrow keyboard  action
			$(".fullScreenGallery_thumbnails").each(function(){
				var me = $(this);
				var mc = $(this).find(".carousel_container").parent();
				
				me.find(".carousel_thumbails").each(function(){
					var sel = $(this);
					$('html').keydown(function(e){ 
						if(me.data("url_") === self.url){
							if (e.keyCode === 39) { //up
								var cur = sel.children().length-1 > sel.data("cur") ? sel.data("cur")+1 : 0;
								sel.data("fn")(sel.children().eq( cur ), cur,true);
								return false; 
							} 
							if (e.keyCode === 37) { //down 
								var cur = sel.data("cur") > 0 ? sel.data("cur")-1 : sel.children().length-1;
								sel.data("fn")(sel.children().eq( cur ), cur,true);
								return false; 
							} 
						}
					});
				});
				
				// Fullscreen gallery - thumbnail close action
				$(this).find(".thumbClose_btn").click(function(){
					var sc = $(this).find(".btn_icon");

					if(mc.width() <= 160){
						sc.text("CLOSE");
						try { 
							mc.removeClass("miniView");
						} catch (e) {
							 self.htmlScroll.animate({ scrollTop: self.curP.height() }, 500, "easeInOutQuart" );
						}							
					}else{								
						sc.text("OPEN");							
						try {
							mc.addClass("miniView");
						} catch (e) {
							  self.htmlScroll.animate({ scrollTop: "13px" }, 500, "easeInOutQuart" );
						}
					}	
					
				});
			});
			
			
			// Store variable to identify animate objects
			for(var ab=0; ab < self.conArry.length; ab++){
				var mcc = self.conArry[ab];
				var fms = [];
				
				self.conArry[ab].find('.fmSlider').each(function(i){
					 fms[i] = $(this);
					 $(this).find('[data-animated-in]').each(function(){
						  $(this).data("isSliderObj", true);
					  });
				 });
				 
				 var biVid = [];
				 self.conArry[ab].find('.big_video').each(function(i){
					 biVid[i] = $(this);
				 });
				 
				 self.conArry[ab].data("fms", fms);
				 self.conArry[ab].data("biVid", biVid);
			};
					
				
			$('.carousel_preview').each(function(){	
				$(this).find('[data-animated-in]').each(function(){
					$(this).data("caro_prev",true);
				});	
			});	  
			
			// Store variable to identify animate objects holding content animation  
			for(var ab=0; ab < self.conArry.length; ab++){				
				var main_holder = self.conArry[ab];
				main_holder.find('[data-animated-in]').each(function(){
					var aniMc = $(this);	
					aniMc.data("isAniObj", false);				
					aniMc.data("main_holder", main_holder);
											
					if(aniMc.find('.graph_container').length > 0){
						aniMc.data("isAniObj", true);						
					}
										
					if(aniMc.find('.animate_counter').length > 0){
						aniMc.data("isAniObj", true);
					}	
					
					if(aniMc.find('.big_video').length > 0){
						aniMc.data("isVidObj", true);
					}	
					
				});	
							  
				main_holder.find('[data-animated-innerContent]').each(function(){
					$(this).children().each(function(){
						$(this).data("main_holder",main_holder);
					});					  
				});
								
			};
			
			// Hide animate objects
			if(!self.disableAnimation){
				$("body").find('[data-animated-in]').css({"visibility":"hidden"});	
				
				$("body").find('[data-animated-innerContent]').each(function(){
					  $(this).children().css({"visibility":"hidden"});
				});
			}
			
			
			
			// Hide portfolio Page animate objects
			$("body").find('.portfolioPage').each(function(){
				  var main_holder = $(this);
				  main_holder.find('[data-animated-in]').each(function(){
					  $(this).data("isMasonry", true);
					  if(self.alignPgHor){
					  	$(this).css({"visibility":"visible"});	
					  }
				  });
				  
				  main_holder.find('[data-animated-innerContent]').each(function(){
					$(this).children().each(function(){
						$(this).data("isMasonry", true);
						 if(self.alignPgHor){
							$(this).css({"visibility":"visible"});
						 }
					});					  
				});
			});
			
			
			if(isTouch){
				$("body").find('.mainContent .addVideo.backGroundVideo').each(function(){
					$(this).data("inMain",true);					
				});
			}
			
			
			// Footer Open - close button
			if(isTouch){			
				$(".nav a, .footer_close, .btn-navbar").click(function(){					
					$("body").find('.addVideo.backGroundVideo, .video_content.fullscreenVideo').each(function(){
						var vid2 = $(this);
						vid2.data("isPlaying", false);	
						self.video_delete(vid2);
					});				
					self.videoRest();					
				});
			}
					
			
			// Set knob animation
			self.knobAni = false;
			try{		
				$("body").find('.animate_counter, .knob').each(function(i){
					var selK = $(this);	
					selK.data("val", selK.attr("data-value"));
					selK.data("display", selK.parent().parent().find(".display"));	
					selK.data("ani", selK.append($('<div><div/>')).children(":last-child"));
					selK.data("ani").css({"top":0,"position":"absolute"});
					selK.data("display").text(selK.attr("data-value"));	
					
						if(!selK.hasClass("animate_counter")){
							if(selK.hasClass("knob")){
						 		selK.val(selK.attr("data-value")).trigger("change");
						 	}
						}
						
						self.knobAni = true;
					});	
			} catch (e) { self.knobAni = false; }
			
			
			
			// Push all the preload image into a preloadImages array			
			self.preloadImages = [];
			
			$('.preload').each(function(){
				self.preloadImages.push($(this));
				});
				
			$('.preloadimages_inline img').each(function(){
				var th = $(this);
				var img;
				if(th.hasClass("cssBackground")){
					img = retinaDevice ? $(this).attr("data-src-2x") : $(this).attr("data-src");					
				}else{
					img = window.innerWidth > 767 ? $(this).attr("data-src") : ($(this).attr("data-src-small")? $(this).attr("data-src-small")  : $(this).attr("data-src"));
					}
				th.attr("data-src", img);
				th.addClass("preload");
				self.preloadImages.push(th);
			});
			
			self.imgFinished = 0;
			
			if( self.preloadImages.length>0){
				self.intImgLoad(self.preloadImages[self.imgFinished]);
			}else{
				siteStartOpen = true;
			}
			
			
			// Initialize the site after the required time interval	
			var intV = setInterval(function() {					
				  if(siteStartOpen ){
					  clearInterval(intV);
					  setTimeout( function(){
					 
						self.headerMc.show();
						$(".homeSlider .homepage_con").show();

						self.initialize();
						
					}, 200);
				}				
			},10);
			
			
			
			
	}	
	
	
	mainFm.prototype = {				
				
		// Initialize the require objects and variables 
		initialize : function(){
			
			var self = this;
			
			self.prePg = "";
			self.curPg = "";
			self.menuList = [];	
			
			
			
			// Loading object added
			self.bdy.prepend('<div id="preloadImg" style="width:150px; height:150px; visibility:hidden; position:absolute; left:0; top:0; overflow:hidden"> </div>');
			self.dumDiv.addClass('email_loading');
			self.dumDiv.removeClass('email_loading');
			
			if(isTouch){
				$("html , body").css({"overflow":"auto"});
			}

			$(".isotope_option").show();				

			$("body").find('.masonry_items').each(function(){
				$(this).find(".item").css({"position":"relative"});
				$(this).find(".item").addClass("enablHardwareAcc");				
			});			

			self.nexButton_detailPg = $("a.next_button");
			self.preButton_detailPg = $("a.previous_button");
			
			
// Initialize the menu navigation action
			var kk = -1;
			var qq = -1;
			self.rez = false;
			
			try {
				document.createEvent('TouchEvent');
				$(".lightStyle, .inverseStyle, .contentWrapper").bind('click', function() {
				});
			} catch (e) {
				// nothing to do
			}
			
			$('html').keydown(function(e){ 
				if (e.keyCode === 38) { //up 
					self.scroll_by(300);
				return false; 
				} 
				if (e.keyCode === 40) { //down 
					self.scroll_by(-300);
					return false; 
				} 
			});
			
			
			
			$(".header .nav li").each(function() {
				var slf = $(this).children();
				qq++;
				if(slf.attr("href") === "" || slf.attr("href") === undefined){
					return;
				}
				slf.bind('click', function() {	
					self.removeAutoposition = false;			
					$(".nav li a").removeClass("active");
					$(this).addClass("active");						
					var gg =  String($(this).attr("href")).split("#");
					if(gg[1] === self.url){
						self.page_position();
					}
					
				});
				
				slf.bind('click', function() {	
					var uul = $(this).attr("href");
					var trg = $(this).attr("_target");
					if($(this).attr("href") && $(this).attr("href") !== "undefined" && uul.charAt(0) !== "#"){										
						self.headerFad.css({"width":"100%", "height":"100%"});
						if(cssAnimate){
							self.headerFad.delay(100)[animateSyntax]({"opacity": 1}, 500 , "easeInOutQuart", function(){ 
								if(trg !== undefined){
									window.open(uul, trg);
								}else{
									window.location.href = uul;	
								}
							});
						}else{
							self.headerFad.delay(100).animate({"opacity": 1}, 500 , "easeInOutQuart", function(){ 	
								if(trg !== undefined){
									window.open(uul, trg);
								}else{
									window.location.href = uul;	
								}						
							});
						}						
						return false;
					}
				});
				
			});
			
			self.parallaxBgUpdate();
			
			setTimeout(function(){
				$("body").find('.hideForLoad').each(function(){
					$(this).css({"height":"auto", "overflow":"inhert"});
				});
			},1000);
			
			// Initialize the cycle slideshow
			
			$("body").find('.slideshow_cycle').each(function(){
				cycle_pluign($(this)); 
				$(this).cycle("pause");
			});
			
			$(".smoothPageLoad").each(function() {
				var slf = $(this);
				slf.bind('click', function() {	
					var uul = $(this).attr("href");
					var trg = $(this).attr("_target");
					if($(this).attr("href") && $(this).attr("href") !== "undefined" && uul.charAt(0) !== "#"){										
						self.headerFad.css({"width":"100%", "height":"100%"});
						if(cssAnimate){
							self.headerFad.delay(100)[animateSyntax]({"opacity": 1}, 500 , "easeInOutQuart", function(){ 
								if(trg !== undefined){
									window.open(uul, trg);
								}else{
									window.location.href = uul;	
								}
							});
						}else{
							self.headerFad.delay(100).animate({"opacity": 1}, 500 , "easeInOutQuart", function(){ 	
								if(trg !== undefined){
									window.open(uul, trg);
								}else{
									window.location.href = uul;	
								}						
							});
						}						
						return false;
					}
				});
			});
			
			
			$(".menu_link").each(function() {
				var slf = $(this);
				qq++;
				if(slf.attr("href") === "" || slf.attr("href") === undefined){
					return;
				}
				slf.bind('click', function() {	
					self.removeAutoposition = false;					
					var gg =  String($(this).attr("href")).split("#");
					if(gg[1] === self.url){
						self.page_position();
					}
				});	
			});

			
			
			$("body").find(".move_down, .move_down_white").each(function(){
				$(this).bind('click', function() {
					self.removeAutoposition = false;
					var gg =  $(this).attr("href").split("#");
					if(gg[1] === self.url){
						self.page_position();
					}
				});
			});
			
			$("body").find(".homeEleFade").each(function(){
				self.animateObject($(this), 0);				
			})
			
			
			

			self.homePg = self.homePage === "" ? self.menuList[0].substr(1, self.menuList[0].length): self.homePage;
			self.cM = $('.contentWrapper [data-id="'+"#"+self.menuList[0]+'"]').parent();

			$('.contentWrapper [data-id="'+"#"+self.homePg+'"]').css("visibility","visible");			
			$('.contentWrapper [data-id="'+"#"+self.homePg+'"]').hide();			

			
			self.page_dimension();
			
			if(!self.alignPgHor){			
				for(var ab=0; ab < self.conArry.length; ab++){	
					self.conArry[ab].data("loaded", true);
					self.load_plugin_Items(self.conArry[ab]);		
				};		
			}
			
			// Initialize the video	
			self.intVideoObject(self.bdy);
			
			// Enable/disable the image scale animation
			if(isTouch){
				$(".fmSliderNode img").removeClass("enableTransition"); 
				$(".circle_large").removeClass("enableTransition");  
			}else{
				$(".fmSliderNode img").addClass("enableTransition"); 
				$(".circle_large").addClass("enableTransition"); 
			}
			
			self.site_display();			
			self.moveItem =  $(".mainContent");
			
			
			
			// display isotope item
			$('.isotope_items').show();
			
			if(self.headerFad){
				if(cssAnimate){
					self.headerFad.delay(100)[animateSyntax]({"opacity": 0}, 500 , "easeInOutQuart", function(){ 	
						self.headerFad.find(".loading_2x").remove();
						self.headerFad.css({"width":"0px", "height":"0px"});
						
					});
				}else{
					self.headerFad.delay(100).animate({"opacity": 0}, 500 , "easeInOutQuart", function(){ 	
						self.headerFad.find(".loading_2x").remove();
						self.headerFad.css({"width":"0px", "height":"0px"})	;
					});
				}
			}
			
			$(".previousPage, .nextPage").bind('click', function() {
				if($(this).data("url") && $(this).data("url") !== "undefined"){
					self.removeAutoposition = false;
					if($(this).data("url") !== self.url){
						window.location.href = "#"+$(this).data("url");
					}else{
						self.page_position();
					}
					if($('.nav a[href$="#'+$(this).data("url")+'"]').length > 0){
						$(".nav li a").removeClass("active");
						$('.nav a[href$="#'+$(this).data("url")+'"]').addClass("active");
					}
				}
			});
			
			if(isTouch){
				$(".fadeAfterLoad").css({"display":"block"});
			}else{
				$(".fadeAfterLoad").delay(200).fadeIn(300);
			}

			
			
			
			// Initialize the window resize function
			clearInterval(self.intr);
			$(window).resize(function() {	
				clearInterval(self.intr);
				self.intr = setInterval(function(){clearInterval(self.intr); self.windowRez();},100);
			});
			
			//Initialize the mobile orientationchange function
			$(window).bind( 'orientationchange', function(){
				self.windowRez();
			});
			
			
			var oTim = self.onePage ? 700 : 200;
				
			var chkInt = setInterval(function() {
				clearInterval(chkInt);
				self.headHig = self.stageWidth > 991 ? (self.stageWidth < 1025 || !self.headMeuTyp1 ? pageHeaderHeight_mini : pageHeaderHeight) : self.alignPgHor ? 0 : pageHeaderHeight_mini;
				
				self.vertical_scroll();
				
				self.history();
				self.page_setup();
						
			}, oTim);
			
			$('.preloadimages_inline img').each(function(){
				$(this).remove();
			});
			$('.preloadimages_inline').remove();
			
			self.superSlider = typeof superGalleryInit !== "undefined" && typeof superGalleryInit !== undefined;
			self.rsSlider = typeof rsSliderInit !== "undefined" && typeof rsSliderInit !== undefined;
						
		
			if(self.superSlider){
				superGalleryInit();
				if(!supersizedOnBody){
					$(".supersized_gallery").show();
					$("#superNav").show();
					$(".supersized-nav").show();
					api.min_thumb();
				}else{
					if($.supersized.vars.is_paused){ api.playToggle(); }
				}
			}
			
			if(self.rsSlider){
				rsSliderInit();				
				apiRS.revpause();
			}
			
			if( self.stageWidth < 1025 || self.miniMenu){
				self.headerMc.addClass("mini");	
			}
			
			
		},
		
		// Site Preload image  function
		intImgLoad : function  (img){
		
			var self = this;
				img.attr('src', img.attr("data-src"));
                 img.bind("load",function(){
					if(self.imgFinished < self.preloadImages.length-1){
                      self.imgFinished = self.imgFinished+1;					  
                      self.intImgLoad(self.preloadImages[self.imgFinished]);
					  $(".loading_2x .text").html(Math.round(self.imgFinished/(self.preloadImages.length)*100) + "%" );
					}else{
						$(".loading_2x .text").html("100%" );
                      siteStartOpen = true;
					}
					
                  }).error(function () {

				  if(self.imgFinished < self.preloadImages.length-1){
					self.imgFinished = self.imgFinished+1;
					self.intImgLoad(self.preloadImages[self.imgFinished]);
					$(".loading_2x .text").html(Math.round(self.imgFinished/(self.preloadImages.length)*100) + "%" );
				  }else{
					  $(".loading_2x .text").html("100%" );
				   	siteStartOpen = true;
				  }
                  
				  }).each(function() {
                    if(this.complete) { $(this).trigger('load'); }
                  });                  
          },
		
		// Page vertical scroll action
		vertical_scroll : function(){
			var self = this;
			self.scrspy_curPg = self.url;

			var scrpyMc = []
			for(var ab=0; ab < self.conArry.length; ab++){
				scrpyMc.push(self.conArry[ab]);
			};
			
			self.curPageShow = scrpyMc[0];
			
			self.chkScrDown = 0;
			
			var scrIntSpd = isTouch ? 700 : 70;
			
			$(window).trigger("scroll");
			
			// Window scroll event
			$(window).scroll(function() {
				clearInterval(self.scrIntr);
				self.scrIntr = setInterval(function(){
					clearInterval(self.scrIntr);
					self.scrollPos = scrollPos = self.$html.scrollTop() > 0 ?  self.$html.scrollTop() :  self.$window.scrollTop();

					if(!self.alignPgHor){
						
						if(!self.miniMenu){
							if( self.stageWidth > 1024){
								if(self.scrollPos > 150 && !self.headerMc.hasClass("menuType1")){
									self.headerMc.addClass("mini");						
								}else{
									self.headerMc.removeClass("mini");
								}
							}else{
								self.headerMc.addClass("mini");
							}
						}
						
						if(self.scrollPos < 250){
							$(".header.effect1").removeClass("removeEffect");
							$(".header.effect2").addClass("bgTransparent");
						}else{
							$(".header.effect1").addClass("removeEffect");
							$(".header.effect2").removeClass("bgTransparent");
						}
						
						if(self.superSlider && !supersizedOnBody){				
							if(self.scrollPos < 250){
								if($.supersized.vars.is_paused){ setTimeout(function(){ api.playToggle(); } ,1000); }
							}else{				
								if(!$.supersized.vars.is_paused){ setTimeout(function(){ api.playToggle(); },1000); }
							}				
						}
						
						if(self.rsSlider){ 
							if(self.scrollPos < 250){
								apiRS.revresume();
							}else{			
								apiRS.revpause();
							}
						 }
						
						self.headHig = self.stageWidth > 991 ? (self.stageWidth < 1025 || !self.headMeuTyp1 ? pageHeaderHeight_mini : pageHeaderHeight) : self.alignPgHor ? 0 : pageHeaderHeight_mini;
						
						if(self.scrollPos > self.winHeight+50){
							if(!supersizedOnBody){ $(".supersized_gallery").css({"visibility":"hidden", "display":"none"}); }
							$(".hexagon_holder").css({"visibility":"hidden"});
							
						}else{
							if(!supersizedOnBody){ $(".supersized_gallery").css({"visibility":"visible", "display":"block"}); }
							$(".hexagon_holder").css({"visibility":"visible"});
						}
						
						self.enableAutoposition = self.chkScrDown < self.scrollPos ? true : false;
						self.chkScrDown = self.scrollPos;
						
						
						if(self.scrollPos > 240){
							self.pgUp.show();					
						}else{
							self.pgUp.hide();
						}
						
						try{  
							var scrpyPos = [];
							for(var ab=0; ab < self.conArry.length; ab++){
								scrpyPos.push(self.conArry[ab].position().top);
							};
							
							var ii = scrpyMc.length-1;
							var isY = false;
							self.sUrl = "!home";
							self.curScrlPgMc = scrpyMc[0];
							var scrPP = 0;
							/* Page triggering code */
							if(self.enableAutoposition){
								scrPP = self.scrollPos+self.headHig+(self.winHeight/2);
							}else{
								scrPP = self.scrollPos+self.headHig+100;
							}
							$("body").find('.contentWrapper').each(function(i){									
								if($(this).position().top > scrPP && !isY ){
									isY = true;
									self.sUrl = scrpyMc[i-1].attr("data-id");
									self.curScrlPgMc = scrpyMc[i-1];	
									ii = i-1;		
								}
							});
							
							if(!isY){
								self.sUrl = scrpyMc[scrpyMc.length-1].attr("data-id");
								self.curScrlPgMc = scrpyMc[scrpyMc.length-1];
							}							
							
							if(self.HideUnuse){															
							  for(var bb=0; bb < self.conArry.length; bb++){
								  if(ii+1 !== bb && ii-1 !== bb && ii !== bb || (ii+1 === self.conArry.length+1)){
									  if(self.conArry[bb].css("visibility") !== "hidden"){
										  self.conArry[bb].css({"visibility":"hidden"});
									  }
								  }else{
									   if(self.conArry[bb].css("visibility") !== "visible"){									
										  self.conArry[bb].css({"visibility":"visible"});
									  }
								  }
							  }	
						  }
						  
						if(self.scrspy_curPg !== self.sUrl && !self.scrollHorizontal){								
								self.scrspy_curPg = self.sUrl;						
								if(!self.enableLowPerformance && self.azh !== undefined){
									self.updatePage(self.curScrlPgMc);
									if(self.scrollPos < 250){
										if(!self.alignPgHor && self.onePage && !isMobileChk){		
											window.location.href = "#"+self.homePage;
										}
									}	
								}	
								self.azh = self.scrspy_curPg;
							}
								
							if(self.enableLowPerformance && !self.scrollHorizontal){
								if(self.url !== self.sUrl && (self.removeAutoposition) && self.onePage){																	
									window.location.href = "#"+self.sUrl;
								}
							}
	
							clearInterval(self.clearInter3 );				
							self.clearInter3 = setInterval(function(){
								clearInterval(self.clearInter3 );
								if(self.curScrlPgMc.position().top < (self.scrollPos) ){									
									for(var ik =0; ik<self.curScrlPgMc.data("fms").length; ik++){
										if(self.curScrlPgMc.data("fms")[ik].data("loaded")){					
											self.curScrlPgMc.data("fms")[ik].fmMainSlider("pause_slideshow");
										}
									}
								}								
							},500);							
							
								
							self.curScrlPgMc.find('[data-animated-in]').each(function(){							
								self.animateObject($(this), self.scrollPos);
							});
							
						}	catch (e) { }
					}else{
						if(self.scrollPos > 240){
							self.pgUp.show();					
						}else{
							self.pgUp.hide();
							if(self.onePage  && !isMobileChk && !self.scrollHorizontal){
								window.location.href = "#"+self.homePage;
							}
						}
					}
				}, 70);				
			});			
			
		},
		

		
		scroll_by: function (pixels) { 
			var self = this;			
			if(self.alignPgHor && !isTouch){
				try { 
					if(self.alignPgHor){
						if(self.curP.hasClass("m-Scrollbar")) {						
							var selg = $(this); 
							self.curP.find(".mCSB_container").each( function () { 						
								var dragger = $(this); 
								self.curP.mCustomScrollbar("scrollTo",Math.round(Math.abs(dragger.position().top)-pixels)); 
							}); 
						};
					}
				} catch (e) {} 
			}
		},
		
		
		
		// Fullscreen gallery video load function
		fullScreenGallery : function(obj){
			var self = this;
			try{
				$(obj).find('.addVideo').each(function(){
					var vid_ = $(this);
					self.video_delete(vid_);
				});
			} catch (e) { }
		},
		

/* Resize Image */
		
		resizeImg : function (obj){
						
			var self = this;
          	if(obj.width() === 0){ return; }
			var hold;

			if(obj.parent().parent().parent().parent().hasClass("projImgs") || obj.hasClass("resize_align")){				
				if(obj.hasClass("resize_align")){
					hold =obj.parent();
				}else{
					hold =obj.parent().parent().parent().parent();
				}
			}else{
				return;
			}

			obj.css({"width":"auto", "height":"auto"});

			if(obj.data("width_") === undefined){
				var image = new Image();				
				image.onload = function() {
				  appy_resizeImg(obj, this.width, this.height);
					obj.data("width_", this.width);
					obj.data("height_", this.height);
					try {	this.remove();	} catch (e) { }
					self.scroll_update();				
					};				
				image.src = obj.attr("src");
			}else{
				appy_resizeImg(obj,obj.data("width_"), obj.data("height_"));	
				self.scroll_update();		
			}
			
			function appy_resizeImg(obj,wid, hig){				
				var	iw = wid,
					ih = hig,
					ww = hold.width(),
					wh = hold.height(),
					rw = wh / ww,
					ri = ih / iw,
					tp = 0,
					lp = 0,
					newWidth, newHeight,
					newLeft, newTop,
					properties;

					if(obj.hasClass("resize_align") && !obj.hasClass("fitInside") ){
						obj.css({ "margin-left": "0px" });
						var rezr = hold.width() < hold.height() ? rw < ri : rw > ri;
						newWidth = ww;
						newHeight = ww * ri;
						if ( rezr ) {
							lp = ( ww  -newWidth)/2;				
						} 
						obj.css({'margin-left': Math.round(lp) + "px"});
					}else{
						if (ww > wh) {	
							newWidth = ww;
							newHeight = ww * ri;
							if(ww < newWidth || wh < newHeight ){
								newWidth = wh / ri;
								newHeight = wh;
							}
						} else {							
							newWidth = ww;
							newHeight = ww * ri;
						}
						lp = ( ww  -newWidth)/2;
						obj.css({'margin-left': Math.round(lp) + "px"});
					}
					
					newWidth =  Math.round(newWidth);
					newHeight = Math.round(newHeight);
					
					tp = Math.round((wh-newHeight)/2);
					
			  		properties = {
							'width': Math.round(newWidth) + 'px',
							'height': Math.round(newHeight) + 'px',
							'margin-top': Math.round(tp) + "px",
							"left":"auto",
							"right":"auto",
							'bottom': "auto"		
						};
						
					obj.css( properties);
				}
		},


// Site start display function
		
		site_display : function(){			
			var self = this;			

			if(!self.IEbrowser){
				$(".isotope_items .item a .img_text").css("visibility","visible");
			}
			
			$(".contentWrapper").find('#mapWrapper').each(function(){
				if(!self.IEbrowser){
					$(this).parent().prepend($(this).data('map'));
					$(this).parent().children(":first-child").addClass('mapStyle');
					$(this).remove();
				}
			});			
			
			// Flex slideshow initialize
			$('body').find('.flexslider').each(function(){
				if(!$(this).hasClass("flexSlideshow_twitter")){
					try{
						
						if(!$(this).data("loaded")){
							$(this).data("loaded", true);
							var aniTyp = $(this).hasClass('slideAnimation') ? "slide" : "fade";
							var tim_ = $(this).attr('data-slidetime') ? Math.abs($(this).attr('data-slidetime')) : 5000;
							$(this).find("a.lazyload").each(function(){
								self.lazyLoadInt($(this));
							});								
							if(aniTyp === "slide"){
								$(this).find("li").each(function(i){
									$(this).find(".loading_x").remove();
									$(this).find("img").show();
								});
							}
							var laz = $(this).hasClass('flexslider');
							if(!laz){  $(this).addClass("flexslider"); }						
							var ffx = $(this);
							ffx.append('<div class="slider_loading" ></div>');
							$(this).find(" a.lazyload").each(function(){
								self.lazyLoadInt($(this));
							});
							var flexs = $(this);
							flexs.flexslider({
							slideshow: true,
							animation: aniTyp,
							slideshowSpeed: tim_,
							start: function(slider){
								flexs.data("slid",slider);
								flexs.find(".slider_loading").remove();
								slider.pause();
								}
							});	
						}
					} catch (e) { }	
				}
			});			
		},
		
		
		// Site footer code
		siteFooter : function( triggerIt_ ){
			var self = this;
		
			var removeTopSpc = true;
			var tpSpMc = $(".top_space");
			
			var triggerIt = window.innerWidth < 768 ? false : triggerIt_;
			
			if(!self.footActive){
				self.footActive = true;
				self.isHide = false;
				
				$(".header_content").data("open", false);
				self.foter_close.each(function(){
					var fc = $($(this).attr("data-close"));					
					$(this).click(function(){
						var btn = $(this);						
						$(btn.attr("data-close")).each(function(){
							var mc = $(this);							
							if(!self.isHide){
								var h1 =  mc.height();
								mc.css({"height": h1});
								btn.addClass("footOpen");
								if(cssAnimate){
									mc[animateSyntax]({"height": "0px"}, 500 , "easeInOutQuart");
								}else{
									mc.animate({"height": "0px"}, 500 , "easeInOutQuart");
									}
								removeTopSpc = true;
								headerClose = true;																	
							}else{
								if(self.stageWidth > 991){
									$(".header_content").css({"display":"block"});
								}
								btn.removeClass("footOpen");
								var h1 =  mc.height();
								mc.css({"height": "auto"});
								var h2 = mc.height();	
								if(h1 !== h2){										
									mc.css({"height": "0px"});								
									mc[animateSyntax]({"height": h2},500 , "easeInOutQuart", function(){
										$(this).css({"height": "auto"});
									});	
									removeTopSpc = false;
								}
								headerClose = false;	
							}							
							if(!self.alignPgHor){ setTimeout(function(){self.page_setup();},500); }							
						});
						
						self.isHide = self.isHide ? false : true;
						
						if(removeTopSpc){				
							tpSpMc.addClass("removePad");
						}else{
							tpSpMc.removeClass("removePad");
						}											
					});
				});				
			}
					

			if(triggerIt){
				
				self.foter_close.each(function(){
					var fc = $($(this).attr("data-close"));					
					$(this).each(function(){
						var btn = $(this);
						$(btn.attr("data-close")).each(function(){
							var mc = $(this);
							var h1 =  mc.height();
							mc.css({"height": h1});							
							btn.addClass("footOpen");
							mc[animateSyntax]({"height": "0px"}, 500 , "easeInOutQuart");
							removeTopSpc = true;							
						});				
					});
				});
				self.isHide = true;				
			}	
			
			if(!headerClose && !triggerIt){ 
				  self.foter_close.removeClass("footOpen");
				  self.foter_close.each(function(){
					  $($(this).attr("data-close")).each(function(){					
						  var mc = $(this);
						  var h1 =  mc.height();
						  mc.css({"height": "auto"});
						  var h2 = mc.height();	
						  if(h1 !== h2){							
							  mc.css({"height": "0px"});								
							  mc[animateSyntax]({"height": h2},500 , "easeInOutQuart", function(){
								  $(this).css({"height": "auto"});
							  });
						  }
					  });
				  });
				 		
				  if(self.stageWidth > 991){
					  $(".header_content").css({"display":"block"});
					  $(".header_content").css({"height":"auto"});
					  self.headerMc.addClass("menuOpen");
					  removeTopSpc = false;
				  }else{
					  $(".header_content").css({"height":"auto"});
					  if($(".header_content").data("open")){
						  $(".header_content").css({"display":"block"});
						  $(".header_content").css({"height":"auto"});
						  self.headerMc.addClass("menuOpen");
					  }else{
						  $(".header_content").css({"display":"none"});	
						  self.headerMc.removeClass("menuOpen");						
					  }
					  $(".header_content ul li ul li").css({"opacity":1, "bottom":0});
					  removeTopSpc = true;
				  }				  
				   self.isHide = false;	
			}else{
				self.foter_close.addClass("footOpen");
				 self.isHide = true;	
			}		
			
			if(removeTopSpc){				
				tpSpMc.addClass("removePad");
			}else{
				tpSpMc.removeClass("removePad");
			}
			
			setTimeout( function(){ if(!isTouch && !self.IEbrowser && self.supportScrollBar){ self.nicScrl.resize(); }	 }, 500);		
		},
		
		
		
		// Set page dimension
		page_dimension : function(){
			var self = this;
			var conPos = 0;
			self.numCon = 0;

			$(".mainContent").children().each(function(){
				self.numCon++;
			});	
			
			if(self.alignPgHor){
				
				$("body").find(".contentWrapper").each(function(){
					var mcc = $(this);
					mcc.css({"width": self.winWidth	});						
					  if(!lowResDesktop){
						  mcc.css({ "height": self.StgHig});
					  }else{
						  mcc.css({"height": "auto" });
					  }
				});	
				
				if(self.scrollHorizontal){
					$(".mainContent").css({"width":(self.numCon*self.winWidth)+50+"px"});
				}else{
					$(".mainContent").css({"width": self.winWidth, "overflow-x":"hidden" });
				}
				
				if(!lowResDesktop && self.scrollHorizontal){
					$(".mainContent").css({"height": self.StgHig,"overflow-y":"hidden"});
				}else{
					$(".mainContent").css({"height": "auto", "overflow-y":"auto"});
				}
				
			}else{
				
				if(!lowResDesktop){ headerClose = false; }
					
				self.siteFooter();
				
				$(".mainContent").css({"width": self.winWidth, "height": "auto", "overflow-y":"auto", "overflow-x":"hidden" });
				
				$("body").find(".contentWrapper").each(function(){			
					$(this).css({"width": self.winWidth, "height": "auto", "overflow-x":"hidden" });	
				});			
			}
			
			
			$("body").find(".fullHeight").each(function(){
				var se2 = $(this);
				if(self.stageWidth > 991){
					if(self.alignPgHor){ 
						se2.css({"min-height": self.StgHig});
					}else{
						if(se2.hasClass("fixed")){
							se2.css({"min-height": self.StgHig});
						}else{
							se2.css({"min-height": self.StgHig-pageHeaderHeight });
						}
					}
				}else{
					se2.css({"min-height": "none"});
				}
				
				if(se2.hasClass("fullResponse")){
					var dumY = !self.alignPgHor || self.stageWidth < 992 ? self.headMeuTyp1 ? pageHeaderHeight : pageHeaderHeight_mini : 0;
					
					if(se2.hasClass("fullscreenVideo")){
						se2.css({"min-height": self.StgHig-dumY, "min-width": "100%"});
					}
				
					se2.find(".video_content.fullscreenVideo, .fullscreenVideo ").css({"min-height": self.StgHig-dumY, "min-width": "100%"});
				}else{
					if(self.mobile){ 
						se2.css({"min-height": "50px"});
						se2.css({"min-height": "auto"});
					}
				}				
			});
			
			$(".fullScreenSlider").css({"min-height":self.StgHig});
						
		},
		
		
		// Update the page, when the page change is or resize 
		updatePage : function(ele){			
			var self = this;	
			
			if(self.rez){ return; }		
			
							
			var menuDefined = false;
			
			var iid = ele.attr("data-id");
			
			if($('.nav a[href$="#'+ ele.attr("data-id")+'"]').length > 0 || !self.onePage){
				menuDefined = true;
				$(".nav li a").removeClass("active");				  			
				$(".nav li ul li a").removeClass("active");
				
				if(self.onePage){
					if(!$('.nav a[href$="#'+iid+'"]').parent().parent().hasClass("nav")){
					  $('.nav a[href$="#'+iid+'"]').parent().parent().parent().children(":first-child").addClass("active");
					}
					$('.nav a[href$="#'+iid+'"]').addClass("active");	
				}else{
					if(!$('.nav a[href$="'+self.homePage+'"]').parent().parent().hasClass("nav")){
					  $('.nav a[href$="'+self.homePage+'"]').parent().parent().parent().children(":first-child").addClass("active");
					}
					$('.nav a[href$="'+self.homePage+'"]').addClass("active");	
					
				}
			}
				
			if(!menuDefined){ 
			  	$(".nav li a").removeClass("active");
			  	$(".nav li ul li a").removeClass("active"); 
			}
			
			
			if(self.dottedNav_added){
				self.dottedNav.removeClass("active");
				$('.dotted-nav li a[href$="#'+ele.attr("data-id")+'"]').addClass("active");
			}
			
			$('.slideshow_cycle').cycle('pause');			
			ele.find('.slideshow_cycle').each(function(){
				$(this).cycle('resume'); 
			});
			
			ele.find('.flexslider').each(function(){
				try{  
					if($(this).data("slid") !== undefined){
						$(this).data("slid").windowRez(); 
					}
				} catch (e) { }	
			});
			
			ele.find('.masonry_items').each(function(){	
				$(this).find(".item").css({"width":self.masonPer});				
			});			
			
			setTimeout(function(){ 
				  ele.find('.fullScreenGallery_thumbnails').addClass("miniView");
				  try{ 
					  self.curP.find('.fullScreenGallery_thumbnails .thumbClose_btn .btn_icon').text("OPEN");	
				  } catch (e) { }	
			 },1700);
			
			
			ele.find('.fullScreenGallery_thumbnails').each(function(){ 
				var sc = $(this).find('.thumbClose_btn .btn_icon');
				var mc = $(this).find(".carousel_container");
				if(mc.width()<15){
					sc.text("OPEN");
				}else{
					sc.text("CLOSE");
				}
									
				if(self.alignPgHor && !isTouch){
					ele.mCustomScrollbar("update");
					ele.mCustomScrollbar("scrollTo","top");	
				}
			});
			
			
			if(lowResDesktop){
				ele.find('img.resize_align').each(function(){
					self.resizeImg($(this));
				});	
			}			
						
			if(!ele.hasClass('portfolioPage')){
				setTimeout(function(){ self.videoRest(); self.scroll_update() }, 1000);	
			}
			
			
			if(!self.alignPgHor){
	
				for(var ab=0; ab < self.conArry.length; ab++){
					if(self.conArry[ab].attr("data-id") !== ele.attr("data-id")){
						self.conArry[ab].find(".fmSlider").each(function(){
							if($(this).data("loaded")){
								$(this).fmMainSlider("pause_slideshow");
							}						
						});
					}
				};
				
				if(!self.enableLowPerformance){
					if(self.enableAutoposition && !self.temprDisableAutoposition){					
						if(ele.hasClass("autoPosition") && self.onePage){
							self.autoPagePos(ele);	
							if(!isTouch && !self.IEbrowser && self.supportScrollBar){
								self.nicScrl.cancelScroll();
							}
							
							window.location.href = "#"+ele.attr("data-id");	
							
							$("body").bind("mousewheel.myEvents", function() {	return false;	});	
											
							setTimeout(function(){	
								$("body").unbind("mousewheel.myEvents");								
							},2000)	;						
						};
					}else{
						setTimeout(function(){	
							self.enableAutoposition = true; 
							self.temprDisableAutoposition = false	
						}, 2000)				
					}
				}				
			}
			
			$("#big-video-wrap").css({"display":"none"});
			if(BigVid !== undefined){
				BigVid.getPlayer().pause();			
			}
			
			if(ele !== undefined ){			
				ele.find('.big_video').each(function(){
					var vmc = $(this);
					if(!self.lowMobile){
						if(vmc.attr("data-background-video") !== undefined){
							$("#big-video-vid").css({"display":"block"});
							vmc.append($("#big-video-wrap"));							
							var videoVolume = isNaN(vmc.attr("data-video-volume")) ? defaultVolume : Number(vmc.attr("data-video-volume"));
							if(bgVideopath !== vmc.attr("data-background-video"))	{
								bgVideopath = vmc.attr("data-background-video");	
								if(BigVid !== undefined){
									var vpp = bgVideopath.split(",");
									if(vpp < 2){
										BigVid.show(vpp[0] );
									}else{
										BigVid.show(vpp[0], {altSource:vpp[1]}  );
									}
								}												
							}else{	
								if(BigVid !== undefined){
									$(".vidPlyPauBtn").data("view", true);	
									$(".vidPlyPauBtn").find("i").addClass("fa fa-eye-slash");				
									BigVid.getPlayer().play();	
								}
							}
							
							try{ 
								if(BigVid !== undefined){ 
									BigVid.getPlayer().volume(videoVolume); 
								} 
							} catch (e) { }
						}
					}else{
						if(BigVid !== undefined){
							$(".vidPlyPauBtn").data("view", false);			
							$(".vidPlyPauBtn").find("i").removeClass("fa-eye-slash").addClass("fa-eye");	
							BigVid.getPlayer().pause();	
						}
						}
				});	
				
				if(ele.find('.big_video').length > 0){
					$("#big-video-wrap").css({"display":"block"});	
				}
			}
			
			
		},
		
		
		load_plugin_Items : function (e){
			var self = this;
			self.curP = e;
			
			self.curP.find(".carousel_container a.lazyload, .elastislide-carousel a.lazyload, a.lazyload_single").each(function(){
				self.lazyLoadInt($(this));
			});
			
	
			if(self.curP.data("carouselLoad") === undefined || !self.alignPgHor){
				self.curP.data("carouselLoad", true);	
				
				// Initialize carousel Elasticslider 
				self.curP.find('.carousel').each(function(){
					
					$(this).find("img").css({"visibility":"visible"}).show();
					$(this).elastislide();
				});					
			};
			
			
			if(self.curP.data("carouseGallLoad") === undefined ){
				self.curP.data("carouseGallLoad", true);
				
				var fullThumbnail = self.curP.find('.fullScreenGallery_thumbnails');
				
				self.curP.find('.carousel_container').each(function(){					
					$(this).data("thu",fullThumbnail);
					
					
					// Initialize carousel galler Elasticslider										
					if($(this).attr("data-link") === undefined){
				 		$(this).find(".carousel_thumbails").elastislide( { minItems : 1 });	
					}else{
						carousel_gallery_int ($(this));	
					}					
					if(self.disableAnimation){
					 	$(this).find(".carousel_thumbails").css({"visibility":"visible"});	
					}					
				});

			}
			
			if(self.alignPgHor){
				clearInterval(self.clearInter2 );				
				self.clearInter2 = setInterval(function(){
					clearInterval(self.clearInter2 );
					if(!lowResDesktop){
						if(self.curP.hasClass("autoFullscreen")){						
							self.siteFooter(true);
						}else{									
							self.siteFooter();
						}			
					}
				},1500);
			}
			
			if(self.url !== self.curPgChk){	
				if(self.alignPgHor){		
					self.htmlBody.scrollTop(0);	
				}
				try{					
					self.curP.find(".carousel_container").each(function(){
						var mc = $(this);
						if(mc.data("firstLoad") === undefined){
							mc.data("firstLoad", true);
							mc.css({"height":"auto"});	
							mc.data("hig", mc.height());
						}else{
							mc.find(".carousel_thumbails").each(function(){
								$(this).data("fn")($(this).children().eq( 0 ),0,true);
							});
						}
						
					});	
				} catch (e) { }				
			}			
			
			if(!self.alignPgHor){					
				if(self.curP.hasClass("bodyBackground")){
					  var img = !isMobileChk ? self.curP.attr("data-src") : (self.curP.attr("data-src-small")? self.curP.attr("data-src-small")  : self.curP.attr("data-src"));	
					  var imgAtt = !isTouch ? "fixed" : "scroll";
					  var vd = self.curP.hasClass('.backGroundVideo');
					  
					  if(img !== undefined){
						if(img !== "none"){
							$("body").addClass("addBackground").css({"background-image":"url("+img+")"});	
						}else{
							$("body").removeClass("addBackground").css({"background-image":"none"});
						}
					  }
				};	
						
				self.beforePageLoad(self.curP);
				
			}
			
			
			if(!self.curP.data("linkBugFix")){
				self.curP.data("linkBugFix", true)
				$(".thumbItem_holder .thumbItem").find("a").bind("click", function(event) {
					aLink = $(this);
					if(aLink.attr("href") !== undefined && !aLink.hasClass("magnificPopup") && !aLink.hasClass("smoothPageLoad") ){						
						if(aLink.attr("_target") !== undefined){
							window.open(aLink.attr("href"), aLink.attr("target"));
						}else{
							window.location.href = aLink.attr("href");	
						}									
					}
					return false;

				});
			}
			
			
		},
		
		
		
		// Position the page
		page_position : function (e){	
			var self = this;
			
			if(self.alignPgHor){	
				if(!isTouch){
					self.htmlBody.css({"overflow":"hidden"});
				}else{
					self.htmlBody.css({"overflow":"auto"});
				}
				
				for(var ik=0; ik < self.navArry.length; ik++){
					if(self.stageWidth > 1024){					
						self.navArry[ik].css({"visibility":"visible"}).show();		
					}else{					
						if(self.navArry[ik].attr("data-id") === self.url){
						  self.navArry[ik].css({"visibility":"visible"}).show();	
						}else{
						  self.navArry[ik].css({"visibility":"hidden"}).hide();
						}
					}			 
				 }
			}
			
			self.curP = self.navArry[0];	
			
			 for(var ik=0; ik < self.navArry.length; ik++){
				if(self.navArry[ik].attr("data-id") === self.url){
					self.curP = self.navArry[ik];					
				}
			}

			var isInCont = undefined;
			for(var ab=0; ab < self.conArry.length; ab++){
				if(self.conArry[ab].attr("data-id") === self.url){
					isInCont = self.conArry[ab];
				}
			};
				
			self.pgAll.stop();
			
			
			setTimeout(function(){
				if(self.scrollPos === undefined){
					self.scrollPos = scrollPos = self.$html.scrollTop() > 0 ?  self.$html.scrollTop() :  self.$window.scrollTop();
					self.scrollObj.stop(false).animate({ scrollTop: self.scrollPos-1});
				}
				
				if(isInCont !== undefined){
					isInCont.find('[data-animated-in]').each(function(){
						if(lowResDesktop){
							self.animateObject($(this), 1000000);
						}else{
							self.animateObject($(this), self.scrollPos);
						}
					});
				}
			},500);		
						

			if(self.superSlider && !supersizedOnBody){				
				if(self.url === self.homePg){
					setTimeout(function(){ 
						if($.supersized.vars.is_paused){ api.playToggle(); }
						},1000);
				}else{				
					setTimeout(function(){ if(!$.supersized.vars.is_paused){ api.playToggle(); } },1000);
				}				
			}
			
			if(self.rsSlider){				
				if(self.url === self.homePg){
					setTimeout(function(){  apiRS.revresume(); },1000);
				}else{				
					setTimeout(function(){ apiRS.revpause(); },1000);
				}				
			}
			
			if(self.alignPgHor && !isTouch){
				try{ self.curP.mCustomScrollbar("scrollTo","top"); } catch (e) { }
			}
				  
			var posT = 0;

			var scrollPos = self.pgAll.scrollTop();			
			var sped2 = scrollPos < (posT+self.headHig)-10 && scrollPos > 0	? 0 : self.aniSpeed;	

			if(self.alignPgHor){
				self.load_plugin_Items(self.curP);
			}
			
			if(self.alignPgHor){				
				self.pgAll.stop();
				self.moveItem.stop();
				
				if(isInCont !== undefined){
					if(self.scrollHorizontal){	
						self.pageCurPos = -Math.round(isInCont.position().left);
					}else{
						self.pageCurPos = -Math.round(isInCont.position().top);
					}
				}
				
				if(!lowResDesktop){	
					
					if(self.superSlider && !supersizedOnBody){
						$(".supersized_gallery").css({"visibility":"visible", "display":"block"});
					}				
					
					if(!self.rez){	
						self.pgAll.stop().scrollTop(posT);
												
						if(isInCont !== undefined){
							
							if(self.pageCurPos <= 0){
								
								if(self.scrollHorizontal){								
									var sped = self.moveItem.position().left >= self.pageCurPos-5 && self.moveItem.position().left <= self.pageCurPos+5	? 0 : 1000	;			
									self.moveItem.stop()[animateSyntax]({"left":self.pageCurPos+"px"},sped,"easeInOutQuart", function(){					
										if(posT > 10  && !supersizedOnBody ){
											$(".supersized_gallery").css({"visibility":"hidden", "display":"none"});
										}
										self.pageUpdate();
									});
								}else{
									var sped = self.moveItem.position().top >= self.pageCurPos-5 && self.moveItem.position().top <= self.pageCurPos+5	? 0 : 1000	;			
									self.moveItem.stop()[animateSyntax]({"top":self.pageCurPos+"px"},sped,"easeInOutQuart", function(){									
										if(posT > 10  && !supersizedOnBody ){
											$(".supersized_gallery").css({"visibility":"hidden", "display":"none"});
										}
										self.pageUpdate();				
									});	
									
								}								
							}
						}			
					}else{
						self.pgAll.stop().scrollTop(posT);
						if(isInCont !== undefined){
							if(self.pageCurPos <= 0){
								
							   if(self.scrollHorizontal){ 
									var sped = self.moveItem.position().left >= self.pageCurPos-5 && self.moveItem.position().left <= self.pageCurPos+5	? 0 : 1000	;			
									self.moveItem.stop().css({"left":self.pageCurPos+"px"});										
								}else{
									var sped = self.moveItem.position().top >= self.pageCurPos-5 && self.moveItem.position().top <= self.pageCurPos+5	? 0 : 1000	;			
									self.moveItem.stop().css({"top":self.pageCurPos+"px"});									
										
								}
								if(posT > 10  && !supersizedOnBody){
									$(".supersized_gallery").css({"visibility":"hidden", "display":"none"});
								}							  
								self.pageUpdate();
							}
						}
					}				
				}else{				
					self.pgAll.scrollTop(posT);
					
					if(isInCont !== undefined){							
						if(self.pageCurPos <= 0){						
							if(!self.rez && (ipadDevice || !isTouch) && self.url !== self.curPgChk){										
								for(var ik=0; ik < self.navArry.length; ik++){						
									if(self.navArry[ik].attr("data-id") === self.url){
										self.curP = self.navArry[ik];
										self.ir = ik > self.dirFind ? 1 : -1;	
										self.dirFind = ik;			
									}
								}	
								if(self.scrollHorizontal){										
									self.moveItem.css({"left":self.pageCurPos+ (self.stageWidth * self.ir) +"px", "height": self.winHeight, "overflow-y":"hidden"});	
									self.moveItem.stop()[animateSyntax]({"left":self.pageCurPos+"px"}, 700 ,"easeInOutQuart", function(){
										self.moveItem.css({"height": "auto", "overflow-y":"auto"});
										self.pageUpdate();	
									});
								}else{
									self.moveItem.css({"top":self.pageCurPos+ (self.stageWidth * self.ir) +"px", "height": self.winHeight, "overflow-y":"hidden"});	
									self.moveItem.stop()[animateSyntax]({"top":self.pageCurPos+"px"}, 700 ,"easeInOutQuart", function(){
										self.moveItem.css({"height": "auto", "overflow-y":"auto"});
										self.pageUpdate();	
									});

								}
							}else{
								if(self.scrollHorizontal){	
									self.moveItem.stop().css({"left":self.pageCurPos+"px"});
								}else{
									self.moveItem.stop().css({"top":self.pageCurPos+"px"});
								}
								self.pageUpdate();
							}					
						}
					}
					
					if("!home" !== self.url){
						self.headerMc.removeClass("bg_transparent");
						if(!supersizedOnBody){ $(".supersized_gallery").css({"visibility":"hidden", "display":"none"});	}				
					}else{
						self.headerMc.addClass("bg_transparent");
						if(!supersizedOnBody){ $(".supersized_gallery").css({"visibility":"visible", "display":"block"}); }
					}	
				}
			}else{	
				if(self.onePage){			
					self.autoPagePos(isInCont);					
				}
				self.pageUpdate();
			}
			
			
			if(self.pgNex.data( "url") === "undefined"){
				self.pgNex.addClass("endPage");
			}else{
				self.pgNex.removeClass("endPage");
			}
						
			if(self.pgPre.data( "url") === "undefined"){
				self.pgPre.addClass("endPage");
			}else{
				self.pgPre.removeClass("endPage");
			}
						
			self.pgNex.removeClass("autoPosition");
			self.pgPre.removeClass("autoPosition");		
			
			self.headerMc.removeClass("bg_transparent");
			
			self.curPgChk = self.url;
						
			setTimeout(function(){ self.videoRest(); }, 1000);
		
		},
		
		
		// Page auto position
		autoPagePos : function(ele){
			
			
			var self = this;	
			
			if(self.removeAutoposition){ return; }
			
			self.scrollObj.stop(false);
			
			var posT = 0;
			
			posT  = ele === undefined ? 0 : Math.round((ele.position().top ) - self.headHig);

			self.scrollObj.stop(false).animate({ scrollTop: posT }, self.aniSpeed, "easeInOutQuart",function(){	
				if(self.enableLowPerformance){		
					self.removeAutoposition = self.enableLowPerformance ? true : false;	
				}
			});	

		},
		
		
		pageUpdate : function(){
			var self = this;		
			for(var ik=0; ik < self.navArry.length; ik++){
				if(self.navArry[ik].attr("data-id") === self.url){					
					self.updatePage(self.curP);
				}
			}					
			self.scroll_update();	
		},
		



// The entire page will reposition, resize and modified by page_setup function
		page_setup : function (){
			
			var self = this;

			self.stageWidth =  window.innerWidth;
			self.stageHeight =  window.innerHeight;

			self.winWidth =  self.stageWidth;
			self.winHeight =   self.stageHeight;
			
			self.ipadPort = (self.stageWidth >= 768 &&  self.stageWidth < 1024);
			self.mobile = self.stageWidth <= 959 && !self.ipadPort;
			self.midMobile = self.stageWidth <= 767 && self.stageWidth > 479;
			self.minMobile = self.stageWidth <= 480;
			isMobileChk = self.stageWidth < 768;		
			self.navTop = true;				
			
			$(".tst").text(window.innerWidth);
			$(".tst2").text($(window).width());
			
			lowResDesktop = self.stageWidth <= 991;
			self.lowMobile = self.stageWidth < 769;
			
			self.StgHig = iPhoneDevice ? screen.height-60 : self.winHeight;
			
			
			if(($("body").hasClass("high_mobile_performance") && window.innerWidth <992)){
				$("body").addClass("horizontal_layout");
			}else{
				if(self.layoutHorizontal){
					$("body").addClass("horizontal_layout");
				}else{
					$("body").removeClass("horizontal_layout");
				}
			}
			
			self.alignPgHor = self.scrollHorizontal = scrollHorizontal = self.onePage ? $("body").hasClass("horizontal_layout") : false;
			self.enableLowPerformance = isTouch || window.innerWidth < 1025;
			self.HideUnuse = self.alignPgHor  ? false : self.enableLowPerformance ? true : false;

			
			if(!self.HideUnuse && (window.innerWidth > 768)){
				for(var bb=0; bb < self.conArry.length; bb++){				
					self.conArry[bb].css({"visibility":"visible"});
					self.conArry[bb].css({"display":"block"});
					if(!self.conArry[bb].data("loaded")){
						self.load_plugin_Items(self.conArry[bb]);	
					}
				}
			}			
			
			$("body").data("bgType",isMobileChk);
			
			if(self.alignPgHor){
				if(!self.miniMenu){
					if( self.stageWidth < 1025){
						self.headerMc.addClass("mini");
					}else{
						self.headerMc.removeClass("mini");
					}
				}
				if(!lowResDesktop){
					self.pgAll.css({"height":self.StgHig, "overflow":"hidden"});
				}else{
					self.pgAll.css({"height":"auto", "overflow-y":"auto"});
					self.pgAll.css({"visibility":"hidden"});
				}
			}
			
			self.headHig = self.stageWidth > 991 ? (self.stageWidth < 1025 || !self.headMeuTyp1 ? pageHeaderHeight_mini : pageHeaderHeight) : self.alignPgHor ? 0 : pageHeaderHeight_mini;

			
			if(self.headHig > 0){
				$(".mobile_topSpc").removeClass("removeSpc");
			}else{
				$(".mobile_topSpc").addClass("removeSpc");
			}

			$(".header_content").data("open", false);
			if(self.stageWidth > 991){
				$(".header_content").css({"display":"block"});
			}else{
				$(".header_content").css({"display":"none"});					
			}
			
			if(self.scrollHorizontal || isMobileChk){
				self.pgNexPre.addClass("pageNavHorizontal");
			}else{
				self.pgNexPre.removeClass("pageNavHorizontal");
			}
		
			
			self.parallaxBgUpdate();
			
			self.page_dimension();
			
			// Change the default image in img tag, if mobile version(data-src-small) image is assign on the img tag
			self.bdy.find('img').each(function() {
				var thsImg = $(this);
				var mobVer = thsImg.hasClass("lowResSupport") ? (self.stageWidth <= 979 ? true : false) : self.mobile;
				
				if($(this).attr('data-src-small')){		
					if(!mobVer || !$(this).attr('data-src-small')){
						var img_Src = $(this).data('src').split(".");
						var iimg = $(this).attr('data-retina') === "yes" && retinaDevice ? img_Src[0]+"@2x."+ img_Src[1] : $(this).data('src');	
							if(String($(this).attr('src')) !== iimg){
								$(this).attr("src", iimg);
								$(this).data("i_src",$(this).data('src'));
							}			
					}else{
						if($(this).attr('data-src-small')){
							img_Src = $(this).attr('data-src-small').split(".");
							iimg = $(this).attr('data-retina') === "yes" && retinaDevice ? img_Src[0]+"@2x."+ img_Src[1] : $(this).attr('data-src-small');
							if(String($(this).attr('src')) !== String($(this).attr('data-src-small')) && String($(this).attr('src')) !== iimg){
								$(this).attr("src",iimg);
								$(this).data("i_src",$(this).attr('data-src-small'));
							}
						}
					}
				}
			});
			

			$("body").find('.parallax').each(function(){
				var img = !isMobileChk ? $(this).attr("data-src") : ($(this).attr("data-src-small")? $(this).attr("data-src-small")  : $(this).attr("data-src"));	
				var imgAtt = !isTouch ? "scroll" : "scroll";
				var vd = false;
				var thbg = $(this);
				thbg.find('.backGroundVideo').each(function(){
					vd = true;
				});	
				
				if(img !== undefined && !thbg.hasClass("bodyBackground") && img !== thbg.data("imgPath")){			
					if(img !== "none"){
						thbg.css({"background-image":"url("+img+")"});
						thbg.data("imgPath",img );
					}else{
						thbg.css({"background-image":"none"});
						thbg.data("imgPath","none");
					}
				}
			});
			
			
			if(self.rez){
				$(self.contClose.attr("data-content")).css({"top":"0px"});
				self.contClose.children(":first-child").children(":first-child").css({"right" : "-40px"});
			}

			$("body").find('.addVideo.backGroundVideo').each(function(){
				var vid2 = $(this);
				var img = !self.mobile ? vid2.attr("data-src") : (vid2.attr("data-src-small")? vid2.attr("data-src-small")  : vid2.attr("data-src"));	
				if(img !== "none" || img !== undefined){
					vid2.css({"background-image":"url("+img+")"});
				}else{
					vid2.css({"background-image":"none"});
				}
				
			});	

			var tppp = 0;
			
			
			$("body").find(".video_content.backGroundVideo").each(function(){
				$(this).css({"min-height": self.StgHig, "min-width": "100%"});
			});
			
			$("body").find(".carousel_preview.fullScreenGallery_items, .carousel_preview.fullScreenGallery_items .carousel_item").each(function(){
				if(self.alignPgHor){
					$(this).css({"height": self.StgHig, "width":"100%"});
				}else{
					$(this).css({"height": self.StgHig-(self.headHig), "width":"100%"});
				}
			});
			
			var dimSiz =  self.stageWidth > self.stageHeight || self.mobile ? self.winHeight : self.winWidth;
			dimSiz = !self.mobile ? self.stageWidth > 700 ? 700 : 400 : 400;


			self.ContPgTopSpace = self.stageHeight > 360 ? 360 : 150;
			$(".contactPage .contactPage_content").css({ "min-height": self.stageHeight - self.ContPgTopSpace, "margin-top": self.ContPgTopSpace } );
			
			self.masonry();
			
			
			if(self.alignPgHor){
				self.page_position();
			}		
			
			
			$('body').find('img.resize_align').each(function(){
				self.resizeImg($(this));
			});
			
			$('body').find('.masonry_items').css({"mini-width":self.winWidth});
			
			if(isTouch){	
				$(".overlayPattern").hide();
			}
			
			if(BigVid !== undefined){
				$("#big-video-wrap").css({"height": $("#big-video-wrap").parent().parent().height()})
			}
			
			if((self.IEbrowser || !self.supportScrollBar)){
				self.htmlBody.css({"overflow":"auto"});
			}
		},
		
		
		beforePageLoad : function(ele){
			var self = this;			
			
			var isInCont = undefined;
			for(var ab=0; ab < self.conArry.length; ab++){
				if(self.conArry[ab].attr("data-id") === self.url){
					isInCont = self.conArry[ab];
					try{ 
						self.conArry[ab].find('.flexslider').each(function(){
							var fc = $(this);
							if(fc.data("loadInPop") === undefined && fc.data("slid") !== undefined && fc.data("autPly") ){												
								fc.data("slid").resume();
							}
						});
					} catch (e) { }					
				}else{					
					try{ 
						self.conArry[ab].find('.flexslider').each(function(){
							if($(this).data("slid") !== undefined){
								$(this).data("slid").pause();
							}
						}); 
					} catch (e) { }
				}
				
			};					
					
			if(!ele.hasClass("portfolioPage")){
				ele.find('.flexSlideshow').each(function(){
					try{
							if(!$(this).data("loaded")){
								$(this).data("loaded", true);
								var aniTyp = $(this).hasClass('slideAnimation') ? "slide" : "fade";
								var tim_ = $(this).attr('data-slidetime') ?  Math.abs($(this).attr('data-slidetime')) : 5000;
								
								$(this).find("a.lazyload").each(function(){
									self.lazyLoadInt($(this));
								});								
								if(aniTyp === "slide"){
									$(this).find("li").each(function(i){
										$(this).find(".loading_x").remove();
										$(this).find("img").show();
									});
								}
								var laz = $(this).hasClass('flexslider');
								if(!laz){  $(this).addClass("flexslider"); }				
								var ffx = $(this);
								ffx.removeClass('flexSlideshow');
								ffx.append('<div class="slider_loading" ></div>');
								var flexs = $(this);
								
								flexs.flexslider({
								slideshow: true,
								animation: aniTyp,
								slideshowSpeed: tim_,
								start: function(slider){
									flexs.data("slid",slider);
									flexs.find(".slider_loading").remove();
									slider.pause();
									}
								});	
							}
					} catch (e) { }				
				});	
			}	
							
			
			for(var ik =0; ik<ele.data("fms").length; ik++){
				if(ele.data("fms")[ik].data("loaded")){					
				//	ele.data("fms")[ik].fmMainSlider("ReStart");				
				}else{
					ele.data("fms")[ik].data("loaded",true);
					ele.data("fms")[ik].fmMainSlider("startActive");
				}
			}
			  
			ele.find('#map_canvas').each(function(){
				if($(this).data("addMap") !== "yes"){
					$(this).data("addMap", "yes");
					try{
						map_initialize(); 

					} catch (e) {
						$("#map_canvas").html($(this).data("con"));			
					}					
				}
				mapResizer();
			});										
		},
		
		parallaxBgUpdate : function(e){
			
			var self = this;
			$("body").find('.parallax').each(function(){
				var img = !isMobileChk ? $(this).attr("data-src") : ($(this).attr("data-src-small")? $(this).attr("data-src-small")  : $(this).attr("data-src"));	
				var imgAtt = !isTouch ? "scroll" : "scroll";
				var vd = false;
				var thbg = $(this);
				thbg.find('.backGroundVideo').each(function(){
					vd = true;
				});	
				
				if(img !== undefined && !thbg.hasClass("bodyBackground") && img !== thbg.data("imgPath")){			
					if(img !== "none"){
						thbg.css({"background-image":"url("+img+")"});
						thbg.data("imgPath",img );
					}else{
						thbg.css({"background-image":"none"});
						thbg.data("imgPath","none");
					}
				}
			});
			
			
			
			},
		
		
		
// The page_load function is used to position the page as per current menu
		page_load : function (e){
				
			var self = this;
			
			self.url = e  ? e : self.homePg;
			self.cM = $('a[href$="#'+self.url+'"]').parent();
			self.cM_= !self.onePage ? $('.contentWrapper') : $('a[href$="#'+self.url+'"]');
			self.pgViewed = false;
			
			
			if(self.stageWidth <= 991){
				$(".header_content").data("open", false);
				$(".header_content").css({"display":"none"});	
				self.headerMc.removeClass("menuOpen");
			}else{
				$(".header .header_content ul li ul").addClass("hideIt");	
				setTimeout( function(){ $(".header .header_content ul li ul").removeClass("hideIt");	 }, 1200);	
			}	
			var jjj = false; 
			
			self.pgNexPre.removeClass("hideBtn");			
			for(var ik=0; ik < self.navArry.length; ik++){				
				if(self.navArry[ik].attr("data-id") === self.url){					
					if(self.navArry[ik].hasClass("removeNexPrevBtn")){
						self.pgNexPre.addClass("hideBtn");
					}						
					if(self.navArry[ik-1]){
						self.pgPre.data( "url" , self.navArry[ik-1].attr("data-id") );
					}else{
						self.pgPre.data( "url", "undefined"); 
					}
					if(self.navArry[ik+1]){						
						self.pgNex.data( "url" , self.navArry[ik+1].attr("data-id") );
					}else{
						self.pgNex.data( "url", "undefined"); 
					}
					break;
				}				
			}		
			
			
			
			var isInCont = undefined;	
			var beforePg = -1;		
			for(var ab=0; ab < self.conArry.length; ab++){				
				  if(self.conArry[ab].attr("data-id") === self.url){
					  beforePg = ab;
					  isInCont = self.curPageShow =self.conArry[ab];
				  }
			};
			
			if(self.HideUnuse){
				for(var bb=0; bb < self.conArry.length; bb++){
					if(beforePg+1 !== bb && beforePg-1 !== bb && beforePg !== bb || (beforePg+1 === self.conArry.length+1)){
						if(self.conArry[bb].css("visibility") !== "hidden"){
							self.conArry[bb].css({"visibility":"hidden"});
						}
					}else{
						 if(self.conArry[bb].css("visibility") !== "visible"){
							self.conArry[bb].css({"visibility":"visible"});
						}
					}
				}	
			}
			
			
			for(var ab=0; ab < self.conArry.length; ab++){
				if(self.conArry[ab].attr("data-id") !== self.url){					
					for(var ik =0; ik<self.conArry[ab].data("fms").length; ik++){
						if(self.conArry[ab].data("fms")[ik].data("loaded")){					
							self.conArry[ab].data("fms")[ik].fmMainSlider("pause_slideshow");				
						}
					}
				}
			};			
				
			$("body").find('.addVideo').each(function(){	
				$(this).data("isPlaying", false);
			});		
							
				
			if($("body").find('.mfp-wrap').length > 0){
				try{ $.magnificPopup.close(); } catch (e) { }
			} 
					
			
			if(BigVid !== undefined){
				BigVid.getPlayer().pause();
			}
			
			$("#big-video-vid").css({"display":"none"});
			
			if(isInCont !== undefined ){
				isInCont.find('.big_video').each(function(){
					var vmc = $(this);
					if(vmc.attr("data-background-video") !== undefined){
						vmc.append($("#big-video-wrap"));
						$("#big-video-vid").css({"display":"block"});
						var videoVolume = isNaN(vmc.attr("data-video-volume")) ? defaultVolume : Number(vmc.attr("data-video-volume"));
						if(bgVideopath !== vmc.attr("data-background-video"))	{
							bgVideopath = vmc.attr("data-background-video");
							if(BigVid !== undefined){
								var vpp = bgVideopath.split(",");
								if(vpp < 2){
									BigVid.show(vpp[0] );
								}else{
									BigVid.show(vpp[0], {altSource:vpp[1]}  );
								}
							}							
						}else{	
							if(BigVid !== undefined){
								$(".vidPlyPauBtn").data("view", true);	
								$(".vidPlyPauBtn").find("i").addClass("fa fa-eye-slash");				
								BigVid.getPlayer().play();
							}
						}						
						try{ 
							if(BigVid !== undefined){ 
								BigVid.getPlayer().volume(videoVolume); 
							} 
						} catch (e) { }
					}
				});	
			}

			$("body").find('.flexslider').each(function(){
				  if($(this).data("slid") !== undefined){				 
					  $(this).data("slid").pause();
				  }
			});

			
			 if(self.stageWidth <= 991){				
				  $(".header_content").data("open", false);
				  $(".header_content").css({"display":"none"});					
			  }
			  
				
			if(self.alignPgHor){
								
				if(isInCont !== undefined ){			
								
					if(isInCont.hasClass("bodyBackground")){
						var img = !isMobileChk ? isInCont.attr("data-src") : (isInCont.attr("data-src-small")? isInCont.attr("data-src-small")  : isInCont.attr("data-src"));	
						var imgAtt = !isTouch ? "fixed" : "scroll";
						var vd = isInCont.hasClass('.backGroundVideo');
						
						if(img !== undefined){
						  if(img !== "none"){
							  $("body").addClass("addBackground").css({"background-image":"url("+img+")"});	
						  }else{
							  $("body").removeClass("addBackground").css({"background-image":"none"});
						  }
						}
					};								
				}
									
				self.beforePageLoad(isInCont);					

				
				self.page_setup();				
				
				$("body").find('.portfolioPage').each(function(){
					try {
						$(this).detailPage("closeBackCon");
					} catch (e) {}
				});
						
				
				if(self.curPg === ""){
					self.curPg = self.prePg = self.url;	
					if(self.pgSub === undefined && self.onePage){
						window.location.href = "#"+self.url;	
					}
					self.cM = $('a[href$="#'+self.curPg+'"]').parent();
					return;
				}
			}
			
			  
			// Check the previous and current page
			
			if(self.prePg === self.curPg){
				
				try { self.fflod.remove(); } catch (e) { }
												
				// Initialize to load the opening page as per history
				if(self.curPg === "" ){						
					self.curPg = self.prePg = self.url;	
					if(self.pgSub === undefined && self.onePage){
						window.location.href = "#"+self.url;	
					}
					self.cM = $('a[href$="#'+self.curPg+'"]').parent();
					if(self.alignPgHor){
						self.pgAll.stop().animate({ scrollTop: "0px" }, 0, "easeInOutQuart");
					}
				}else{	
					// Initialize to load current page, background and animate to left side			
					self.curPg = self.url;
					var pagScrl_Speed = window.pageYOffset !== 0 ? self.aniSpeed : 50;
					var con_Speed = 0;
					if(self.prePg !== self.url){
						if(self.alignPgHor){
							self.pgAll.stop().animate({ scrollTop: "0px" }, pagScrl_Speed, "easeInOutQuart" ,function(){ });
						}
					}else{
						if(isInCont !== undefined){
							self.page_position();
						}
						if(self.alignPgHor){
							self.pgAll.stop().animate({ scrollTop: "0px" }, 500, "easeInOutQuart" );
						}
					}
				}
			}
			
			
			if(!self.alignPgHor){	
				self.temprDisableAutoposition = true;			
				self.siteFooter();				
				self.page_position();				
			}
		},
				
		
		// Portfolio masonry gallery
		masonry : function(){
			var self = this;			
			$("body").find('.masonry_items').each(function(){
				self.masonNum = self.stageWidth < 1149? (self.mobile ? (self.midMobile ? 2 : 1) : 3) : (self.stageWidth > 1480 ? ($(this).hasClass("max_col4") ? 4 : 5) : 4);
				self.masonPer = Math.round((100/self.masonNum))+"%";					
				$(this).find(".item").css({"width":self.masonPer});				
			});
			
		},
		
		
		// Lazy load function
		lazyLoadInt : function(obj){
			var self = this;
			
			var imSrc = !self.mobileDevice ? obj.attr("href") : (obj.attr("data-src-small")? obj.attr("data-src-small")  :obj.attr("href"));
			var lodr = obj.parent().hasClass('large_image');
			lodr = !lodr ? obj.parent().hasClass('medium_image') : lodr;
			lodr = !lodr ? obj.parent().hasClass('fixedHeight') : lodr;
			lodr = !lodr ? obj.hasClass('lazyload_single') : lodr;
			lodr = !lodr ? obj.hasClass('lazyload_fluid') : lodr;			
			lodr = !lodr ? obj.hasClass('lazyload_gallery') : lodr;

			if(obj.parent().hasClass('imgBorder')){
				lodr = !lodr ? obj.parent().parent().hasClass('fixedHeight') : lodr;
			}			
			var cc = obj.attr('class');
			var st = obj.attr('style');
			var $img;
			if(st){
				$img = $('<img class="'+cc+' style="'+st+'" />');
			}else{
				$img = $('<img class="'+cc+'" />');
			}

			$img.removeClass('lazyload_single');
			$img.removeClass('lazyload_fluid');			
			$img.removeClass('lazyload_gallery');
			$img.removeClass('lazyload');
			obj.replaceWith($img);
			$img.hide();
			
			$(".loading_objects .loading_x").clone().appendTo($img.parent());
			
			if(lodr){
				$img.attr('src', imSrc).load(function() {
					$(this).parent().find(".loading_x").remove();
					if($(this).hasClass("resize_align")){	
						self.resizeImg($(this));						
					};

					if(!$(this).hasClass("noSelfAnimate")){
						$(this).show().addClass(aniInEff);
					}else{
						$(this).show();
					}
										
				}).error(function () { 
					$(this).parent().find(".loading_x").remove();
				}).each(function() {
                  if(this.complete) { $(this).trigger('load'); }
				});
            }else{
				
				$img.attr('src', imSrc).load(function() {
					$(this).parent().find(".loading_x").remove();
					
					if($(this).hasClass("resize_align")){
						self.resizeImg($(this));						
					};	
					$(this).fadeIn(300);
					
					var pim = $img.parent().parent().hasClass('projImgs');
					pim = pim ? pim : $img.parent().parent().parent().parent().hasClass('projImgs');
					if(pim){
						self.resizeImg($(this));
					}else{						

						var posY = $(this).hasClass("scale_fill");
						posY = !posY ? $(this).hasClass("scale_fit") : posY;
						posY = !posY ? $(this).hasClass("scale_cover") : posY;						
						if(posY){							
							if($(this).width() > $(this).parent().width()+5	){
								$(this).css({"left":-($(this).width()-$(this).parent().width())/2});
							}
							$(this).css({"top":-($(this).height()-$(this).parent().height())/2});
						}							
					}
					
				}).error(function () {
					$(this).parent().find(".loading_x").remove();
				}).each(function() {
                  if(this.complete) { $(this).trigger('load'); }
				});	
			}
			
			return $img;
			
		},
		
		
// Initialize the History 
		history : function(){
			var self = this;

			(function($){
				var origContent = "";			
				function loadContent(hash2) {
					window.location.href.substr(0, window.location.href.indexOf('#'));
					var splt = hash2.split("?");
					var hash = !self.onePage ? self.homePg : splt[0];
					self.pgSub = splt[1];

					if(hash !== "") {
						if(origContent === ""  && self.curPg === "") {
							origContent = $('.contentWrapper [data-id="'+"#"+self.homePg+'"]');
						}
						if(self.hisPath !== hash ){
							self.hisPath = hash;
							self.page_load(hash);
						}else{
							
							if(self.pgSub !== undefined && self.projFm){
								var p2 = self.pgSub.split("=");
								if((Number(p2[1]) !== self.curSlide)){
									self.curFmSlider = $(".pageHolder .fmSlides").data("sArry");
									self.curSlide = Number(p2[1]);
									self.showDetailPage(self.curFmSlider[Number(p2[1])]);
								}
							}
						}
					} else {

						if(origContent !== "" && self.curPg === "") {
							if(self.hisPath !== hash ){
								self.hisPath = hash;
								self.page_load(self.homePg);
							}
						}else{
							if(!self.onePage){
								if(self.pgSub !== undefined && self.projFm){
									p2 = self.pgSub.split("=");
									
									if((Number(p2[1]) !== self.curSlide)){
										self.curFmSlider = $(".pageHolder .fmSlides").data("sArry");
										self.curSlide = Number(p2[1]);
										self.showDetailPage(self.curFmSlider[Number(p2[1])]);
									}
								}
							}
						}
					}
					
					if(hash === "" && self.curPg === ""){
						self.page_load(self.homePg);
					}
				}

				$(document).ready(function() {
					$.history.init(loadContent);
					$('#navigation a').not('.external-link').click(function() {
						var url = $(this).attr('href');
						url = url.replace(/^.*#/, '');
						$.history.load(url);
						return false;
					});
				});
				
			})(jQuery);
			
		},
		

// Animating the required object
		
		animateObject : function (mc, scrlPos){
			var self = this;
			
			if(self.disableAnimation){
				return;
			}
						
			var mcPos = Math.round(mc.position().top);	
			
						
			if(mc.data("isSliderObj") || (mc.data("isDisplay")) || mc.data("caro_prev") ){
				return;
			}
			
			
			if(mc.data("isMasonry") && self.alignPgHor){
				return;
			}
		
			var par = 0;
			if(mc.attr("data-anchor-to") !== undefined){
				var mc2 = mc;
				for(var io=0; io<mc.attr("data-anchor-to").split(".").length; io++){
					mc2 = mc2.parent();
				}				
				par = mc2.position().top;
			}
		
			/* The below code is used to find the animation triggering point */
			if(self.alignPgHor){				
				if((mcPos+par)-(self.winHeight-(self.winHeight/4-100))  > Math.abs(scrlPos)  && self.headHig !== 0){
					return;
				}
			}else{				
				var mcPos = Math.round(mcPos + mc.data("main_holder").position().top);						
				if((mcPos+par)-(self.winHeight-(self.winHeight/4-100)) > Math.abs(scrlPos)  && self.headHig !== 0){
					return;
				}		
			}
			/**/
			
			mc.data("isDisplay" , true);		
			
			
			if(mc.data("isAniObj")  && !isTouch){				
				self.animate_objectBeforeDisplay(mc);
			}
					
			if(mc.attr("data-animated-innerContent") === "yes"){
				var kk = 0;
				mc.css({"visibility":"visible"});
				mc.children().css({"visibility":"hidden"});
				mc.children().each(function(){										
					var mc2 = $(this);					
					mc2.stop();
					var aniTyp = mc.attr("data-animated-in") !== undefined ? mc.attr("data-animated-in") : "animated fadeIn";
					mc.data("in", aniTyp)
					kk = !isNaN(mc.attr("data-animated-time")) && mc.attr("data-animated-time") > kk ? Number(mc.attr("data-animated-time")) : kk+5;					
					var aniTim = self.aniDelay*kk;
					aniTim = cssAnimate ? aniTim : aniTim-50;				
					mc2.removeClass(aniTyp);					
					setTimeout(function(){	
						if(cssAnimate){						
							mc2.css({"visibility":"visible"}).removeClass(aniTyp).addClass(aniTyp).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								$(this).removeClass(mc.data("in"));							
								if(mc.data("isAniObj") && !isTouch){
									self.animate_objectAfterDisplay($(this));
								}				
							});
						}else{
							var tp = !isNaN(parseInt(mc2.css("top"))) ? parseInt(mc2.css("top")) : 0;
							var posTyp = mc2.css("position");
							if(posTyp === "static"){ mc2.css({"position":"relative"}); }
							mc2.css({"visibility":"visible", "opacity":0, "top":tp+15}).removeClass(aniTyp).animate({"opacity":1, "top":tp},350, "easeInOutQuad",function(){
								mc2.css({"position":posTyp});								
								$(this).removeClass(mc.data("in"));							
								if(mc.data("isAniObj") && !isTouch){
									self.animate_objectAfterDisplay($(this));
								}				
							});
						}
					}, aniTim );
				});
			}else{
				mc.stop();					
				var aniTyp = mc.attr("data-animated-in") !== undefined ? mc.attr("data-animated-in") : "animated fadeIn";
				mc.data("in", aniTyp);
				var kk = !isNaN(mc.attr("data-animated-time")) && mc.attr("data-animated-time") > kk ? Number(mc.attr("data-animated-time")) : kk+5;
				var aniTim = !isNaN(mc.attr("data-animated-time")) ? self.aniDelay*mc.attr("data-animated-time") : self.aniDelay*(kk);
				aniTim = cssAnimate ? aniTim : aniTim-50;							
				mc.removeClass(aniTyp);					
				setTimeout(function(){	
					if(cssAnimate){						
						mc.css({"visibility":"visible"}).removeClass(aniTyp).addClass(aniTyp).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							$(this).removeClass($(this).data("in"));
							if(mc.data("isAniObj") && !isTouch){
								self.animate_objectAfterDisplay($(this));
							}					
						});
					}else{
						var tp = !isNaN(parseInt(mc.css("top"))) ? parseInt(mc.css("top")) : 0;
						var posTyp = mc.css("position");
						if(posTyp === "static"){ mc.css({"position":"relative"}); }
						mc.css({"visibility":"visible", "opacity":0, "top":tp+15}).removeClass(aniTyp).animate({"opacity":1, "top":tp}, 350, "easeInOutQuad",function(){
							mc.css({"position":posTyp});	
							$(this).removeClass(mc.data("in"));							
							if(mc.data("isAniObj") && !isTouch){
								self.animate_objectAfterDisplay($(this));
							}				
						});
					}
				}, aniTim );
			}
			
		},
		
		animate_objectBeforeDisplay : function(obj){
			var self = this;
			obj.find('.graph_container li').each(function() {
				$(this).each(function() {
					$(this).children(':first-child').css("width","0px");
					 $(this).find(".display").text(0);
				});
			});	
			
			if(self.knobAni){
				try{					
					obj.find('.animate_counter').each(function(){
						 var selK = $(this);
						 if(selK.hasClass("knob")){
						 	selK.val(0).trigger("change");
						 }
						 selK.data("display").text(0);
					});	
				} catch (e) { }	
			 }
			
		},
		
		
			
		animate_objectAfterDisplay : function(obj){
			var self = this;
			obj.find('.graph_container').each(function(){
					self.graph_display($(this));
				});
				
			if(self.knobAni){						
				try{					
					obj.find('.animate_counter').each(function(i){			
						var selK = $(this);
							selK.data("ani").css({"top":0})
							$(selK.data("ani")).animate({
								'top': selK.data("val")
							  },
							  {
								step: function(now, fx) {	
									if(selK.hasClass("knob")){
								  		selK.val(now).trigger("change");
									}
								  	if( selK.data("display")){
									 	selK.data("display").text(Math.round(now));
								  	}
								},
								duration: 2500, 
								easing: "easeInOutQuad"							 
							  });	
					});
				} catch (e) { }	
			}
			
		},
		

// Initialize video cover image
		intVideoObject : function(obj){
			var self = this;
			obj.find('.addVideo').each(function(){		
				var addCover = false;			
										
				$(this).find('.video_hover').each(function(){
					addCover = true;
					var vv =  $(this);
					var vid = $(this).parent();
					vid.data("added", true);
					var eventMc = ('ontouchstart' in document.documentElement) ? 'touchstart' : 'click';
					vv.bind(eventMc, function(event) {	
						$("body").find('.addVideo').each(function(){
							$(this).data("isPlaying", false);
							if($(this).parent().hasClass("tabVideo")){ return; }							
							if(!$(this).data("added")){
								vid.children(':first-child').removeClass("enablHardwareAcc");
							}
							$(this).find('.vid').remove();
							if(!$(this).hasClass("backGroundVideo")){
								$(this).find('img').fadeIn();
								$(this).find('.video_hover').fadeIn();
								$(this).find('.video_hover').css({"z-index":"55"});
							}
						});
			
						vid.prepend('<div class="vid" ></div>');
						vid.data("added", true);
						vid.data("isPlaying", true);
						var autply = vid.attr("data-autoPlay") === "true" ? true : false;
						vid.data("autoplay", autply);
						vid.data("url_", self.curP.attr("data-id"));
						vid.find('.video_hover').css({"z-index":"-1"});
						vid.find('img').fadeOut(100,function(){
							var vid_ = $(this).parent();					
							vid_.children(':first-child').embedPlayer(vid_.attr('data-url'), vid_.width()+"px", vid_.height()+"px", true, vid_.children(':first-child'), false);		 
							}
						);			
					});
				});	
				
				
			});
			
		},
		
		
		


// Video Reset function
		videoRest : function(obj){
			var self = this;
			
			$("#fancybox-wrap").find('.addVideo').each(function(){	
				self.video_delete($(this));
			});
			
			try{
				$("body").find('.addVideo').each(function(){		
					if(!$(this).hasClass("backGroundVideo")  && !$(this).data("isPlaying") || ($(this).data("url_") !== self.curP.attr("data-id")) ){
						self.video_delete($(this));
					}
					if($(this).data("isPlaying") ){
						var vid = $(this);
						var www = Math.round(vid.width());
						var hhh = Math.round(vid.height());
						vid.find("iframe").css({"width": www+"px", "height": hhh+"px"});						
						if(isTouch){ vid.find("iframe").css({"top":self.headHig }); }
					}
				});
			} catch (e) { }
 			
			try{
					
				self.curP.find('.addVideo.backGroundVideo').each(function(){
					var vid = $(this);
					var www = Math.round(vid.width());
					var hhh = Math.round(vid.height());
					var vidW = !isTouch ? www * 1.8 : www;
					var vidH = !isTouch ? hhh * 1.8 : hhh;
					var ww = vidW;	
					var hh = vidH;
					
					if(!vid.data("added") && vid.data("inMain") === undefined){							
						vid.data("url_", self.curP.attr("data-id"));
						vid.prepend('<div class="vid" ></div>');
						vid.children(':first-child').addClass("enablHardwareAcc");
						vid.find('.video_hover').css({"z-index":"55"});							
						vid.find('img').show();
						vid.children(':first-child').embedPlayer(vid.attr('data-url'), vidW+"px", vidH+"px", true, vid.children(':first-child'), true);
					}
					vid.data("added", true);
					vid.children(':first-child').css({ "top": -Math.round((hh-hhh)/2)});
					vid.find("iframe").css({"width": ww+"px", "height": hh+"px" });
				});					
								
				$("body").find('.addVideo.backGroundVideo').each(function(){
					var vid_ = $(this);
							
					if(vid_.data("url_") !== self.curP.attr("data-id")){
						self.video_delete(vid_);
					}
				});

			  } catch (e) { }
		},
		
		video_delete : function(mc){
			mc.data("added", false);
			mc.find('.vid').each(function(){
				$(this).removeClass("enablHardwareAcc");
				try{ 				
					if($(this).length>0){
						jQuery("#"+$(this).children(':first-child').attr("id")).tubeplayer('destroy');
					}
				} catch (e) { }
				$(this).remove();
			});
			mc.find('img').show();
			mc.find('.video_hover').show();
			mc.find('.video_hover').css({"z-index":"55"});
		},
		
		
		
// Add scrollbar
		addScrollbar : function (){
			var self = this;
			$('body').find(".m-Scrollbar").each(
				function(){	
						$(this).mCustomScrollbar({
							theme: "light-thin",
							autoHideScrollbar: true,
							advanced:{
								autoScrollOnFocus: false
							},
							scrollInertia: 500,
							mouseWheelPixels: 320,						
							callbacks:{
							  onScroll:function(){
								  	if(mcs.top < -150){										
										for(var ik =0; ik<$(this).data("fms").length; ik++){
											if($(this).data("fms")[ik].data("loaded")){					
												$(this).data("fms")[ik].fmMainSlider("pause_slideshow");				
											}
										}																
									self.curPageShow.find('[data-animated-in]').each(function(){
										var tps = mcs.topPct < 90 ? mcs.top : 1000000;
										self.animateObject($(this), tps);
									});				
								}								
							  }
							}
						});
					}
				);

			$('body').find(".scroll-pane").each(
				function()
					{	self.apis.push($(this).jScrollPane({ autoReinitialise: true, verticalDragMinHeight : 70 }).data().jsp);
					}
			);
			
			
			$(".mCSB_scrollTools").bind('mouseover.scrolEvent', function() {	
				$(this).find(".mCSB_dragger .mCSB_dragger_bar")[animateSyntax]({"width":"8px"}, 300, "easeInOutQuart")
			});
			
			$(".mCSB_scrollTools").bind('mouseleave.scrolEvent', function() {	
				if(!self.scrlPress){
					$(this).find(".mCSB_dragger_bar")[animateSyntax]({"width":"2px"}, 300, "easeInOutQuart");
				}
			});
			
			
			$(".mCSB_scrollTools .mCSB_dragger_bar").bind('mousedown.scrolEvent', function() {	
				self.scrlPress = true;
			});
			
			$("body").bind('mouseup.scrolEven', function() {
				$(".mCSB_scrollTools .mCSB_dragger_bar")[animateSyntax]({"width":"2px"}, 300, "easeInOutQuart");
				self.scrlPress = false;
			});
			
		},
			

// Remove scrollbar			
		removeScrollbar : function(){
          var self = this;
				if (self.apis.length) {
					$.each(
						self.apis,
						function(i) {
									this.destroy();
							}
						);
					self.apis = [];
				}
			
			$(".mCSB_scrollTools").unbind('mouseover.scrolEvent');
			$(".mCSB_scrollTools").unbind('mouseleave.scrolEvent');
			$(".mCSB_scrollTools .mCSB_dragger_bar").unbind('mousedown.scrolEvent');
			$("body").unbind('mouseup.scrolEven');
		},


// Scrollbar update function
		scroll_update : function(rPos){		
			var self = this;

			var rePos = typeof rPos !== undefined ? rPos : 0;
			
				if(self.stageWidth > 991){	 		
					if(self.alignPgHor){	
						if(self.stageWidth <= 991){
							self.curP.css({"height":"auto"});
						}
						try{ 	
							if(self.curP.hasClass("m-Scrollbar")){
								self.curP.mCustomScrollbar("update");
								if(rPos !==  undefined){
									self.curP.mCustomScrollbar("scrollTo","top");
								}
							}				
							self.curP.find(".m-Scrollbar").each(function(){
								$(this).mCustomScrollbar("update");
								if(rPos !==  undefined){
									$(this).mCustomScrollbar("scrollTo","top");
								}
								
							});
						} catch (e) { }
						
						try{
							if(!isTouch){
								if(rePos !== 0 && rePos !== undefined){
									self.curP.mCustomScrollbar("update");
									self.curP.mCustomScrollbar("scrollTo", rePos);
								}
							}
						} catch (e) { }
					}else{						
						if(rPos !==  undefined){
							self.scrollObj.stop(false).animate({ scrollTop: rePos+"px" }, 500, "easeInOutQuart");
						}
					}
			}else{					
				if(!isTouch && !self.IEbrowser && self.supportScrollBar){ 				
					self.nicScrl.resize();
					if(rPos !==  undefined){
						self.scrollObj.stop(false).animate({ scrollTop: rePos+"px" }, 500, "easeInOutQuart");
					}
				}			
			}
					
		},
		
// Graph display function
		graph_display : function (e){
			e.find('li').each(function() {
				var selK = $(this).find(".display");
				$(this).each(function() {
					$(this).children(':first-child').css("width","0px");
					$(this).children(':first-child').stop();	
					var vall = parseInt($(this).attr('data-level')) >= 100 ? "101%" : $(this).attr('data-level');						  
					$(this).children(':first-child').animate( { width: vall },
							  {
								step: function(now, fx) {									
								  	selK.text(Math.round(now > 100 ? "100" : now));
								},
								duration: 1500, 
								easing: "easeInOutQuad"							 
					});	
				});
			});
		},
		
// Window Resize function
		windowRez : function (){			
			var self = this;
			if(Number(self.bdy.data("width")) !== Number(window.innerWidth) || Number(self.bdy.data("height")) !== Number(window.innerHeight)){
				self.bdy.data("width", Number(window.innerWidth));
				self.bdy.data("height", Number(window.innerHeight));
				self.rez = true;
				self.page_setup();
				self.rez = false;
			}
		},
		
		
		previewSetting : function (){
			var self = this;
			// Preview_set
			self.curColor = "color-white";
			self.curTempColor = "";
			
			var colr = $("#set_color").attr("href");
			if( colr.split("orange").length > 1){
				self.curTempColor = "-orange";
			}else if( colr.split("red").length > 1){
				self.curTempColor = "-red";
			}
				
			
			self.setting_tool = $(".setting_tools");
			setPreviewBtn();
			
			$(".setting_tools .iButton").click(function(){
				if(self.setting_tool.hasClass("hideTool")){
					self.setting_tool.removeClass("hideTool");
				}else{
					self.setting_tool.addClass("hideTool");
				}
			});
			
			$(".mUp").click(function(){
				$(".setting_tools").addClass("mUp");
				});
			
			$(".mDown").click(function(){
				$(".setting_tools").removeClass("mUp");
				});
				
			
			$(".colWhite").click(function(){
				if(!$(this).hasClass("active")){
					$("#set_color").attr("href", "css/color-white"+self.curTempColor+".css");
					$("body").addClass("white_ver");
					$(".slider1").removeClass("inverseStyle");
					$(".preview_set").addClass("inverseStyle");
					setPreviewBtn();
				}
			});
			
			$(".colNight").click(function(){
				if(!$(this).hasClass("active")){
					$("#set_color").attr("href", "css/color-night"+self.curTempColor+".css");
					$("body").removeClass("white_ver");
					$(".slider1").addClass("inverseStyle");
					$(".preview_set").removeClass("inverseStyle");	
					setPreviewBtn();
				}
			});
			
			$(".colBlack").click(function(){
				if(!$(this).hasClass("active")){
					$("#set_color").attr("href", "css/color-black"+self.curTempColor+".css");
					$("body").removeClass("white_ver");
					$(".slider1").addClass("inverseStyle");
					$(".preview_set").removeClass("inverseStyle");	
					setPreviewBtn();
				}
			});
			
			/* --- */
			
			if($(".header .container").length > 0 ){				
				$(".mType1").click(function(){
					if($(".header .container").length > 0 ){					
						$(".header").removeClass("menuType2");
						$(".header").addClass("menuType1");
						var mp = Math.round( Math.abs(100/$(".header_content>ul").children().length))+.90;
						$(".header_content>ul>li").css({"min-width": mp-1+"%"});
						self.headMeuTyp1 = self.headerMc.hasClass("menuType1");
						self.page_setup();
					}
					setPreviewBtn();
				});				
				$(".mType2").click(function(){
					if($(".header .container").length > 0 ){					
						$(".header").removeClass("menuType1");
						$(".header").addClass("menuType2");
						$(".header_content>ul>li").css({"min-width":"none"});
						self.headMeuTyp1 = self.headerMc.hasClass("menuType1");
						self.page_setup();
					}
					setPreviewBtn();
				});
				
			}else{
				$(".mType1, .mType2").css({"opacity":".5"});
			}
			
			$(".fontStyle1").click(function(){
				$("#set_font").attr("href", "css/font-style1.css");
				setPreviewBtn();
				
			});
			
			$(".fontStyle2").click(function(){
				$("#set_font").attr("href", "css/font-style2.css");
				setPreviewBtn();				
			});
			
			/* --- */
			
			$(".temHigLight1").click(function(){
				if(!$(this).hasClass("active")){
					$("#set_color").attr("href", "css/"+self.curColor+""+".css");
					self.curTempColor = "";
					setPreviewBtn();
				}
			});
			
			$(".temHigLight2").click(function(){
				if(!$(this).hasClass("active")){
					$("#set_color").attr("href", "css/"+self.curColor+"-orange"+".css");
					self.curTempColor = "-orange";
					setPreviewBtn();
				}
			});
			
			$(".temHigLight3").click(function(){
				if(!$(this).hasClass("active")){
					$("#set_color").attr("href", "css/"+self.curColor+"-red"+".css");
					self.curTempColor = "-red";
					setPreviewBtn();
				}
			});
			

			
			function setPreviewBtn(){
				$(".fontStyle1, .fontStyle2, .mType1, .mType2, .colWhite, .colNight, .colBlack").removeClass("active");
				$(".temHigLight1, .temHigLight2, .temHigLight3").removeClass("active");
				
				var cUrl = $("#set_color").attr("href");
				
				if( cUrl.split("white").length > 1){
					$(".colWhite").addClass("active");
					self.curColor = "color-white";
				}else if( cUrl.split("night").length > 1){
					$(".colNight").addClass("active");
					self.curColor = "color-night";
				}else{
					$(".colBlack").addClass("active");
					self.curColor = "color-black";
				}
					
				if( $(".header").hasClass("menuType1")){
					$(".mType1").addClass("active");
				}else{
					$(".mType2").addClass("active");
				}	
				
				if($("#set_font").attr("href") == "css/font-style1.css"){
					$(".fontStyle1").addClass("active");
				}else{
					$(".fontStyle2").addClass("active");
				}	
				
				if( cUrl.split("orange").length > 1){
					$(".temHigLight2").addClass("active");
				}else if( cUrl.split("red").length > 1){
					$(".temHigLight3").addClass("active");
				}else{
					$(".temHigLight1").addClass("active");
				}
				
				if( self.stageWidth < 1025 || self.miniMenu){
					self.headerMc.addClass("mini");	
				}						
				if(!self.miniMenu){
					if( self.stageWidth > 1024){
						if(self.scrollPos > 150 && !self.headerMc.hasClass("menuType1")){
							self.headerMc.addClass("mini");					
						}else{
							self.headerMc.removeClass("mini");
						}
					}else{
						self.headerMc.addClass("mini");
					}
				}
				
			}	
		}
	};

		
// Initizlize and create the main plug-in
	$.fn.mainFm = function(params) {
		var $fm = $(this);
		var instance = $fm.data('GBInstance');
		if (!instance) {
			if (typeof params === 'object' || !params){
				return $fm.data('GBInstance',  new mainFm($fm, params));	
			}
		} else {
			if (instance[params]) {					
				return instance[params].apply(instance, Array.prototype.slice.call(arguments, 1));
			}
		}
	};

	
})( jQuery );
