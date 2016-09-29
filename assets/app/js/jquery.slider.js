/*!

	Marena - One Page Vertical / Horizontal Template
	Copyright (c) 2014, Subramanian 

	Author: Subramanian
	Profile: themeforest.net/user/FMedia/
	
	Version: 1.0.0
	Release Date: July 2014
	
*/	


(function( $ ){	
	
	"use strict";
	
	function fmMainSlider(selector, params){
		// default variables
		var defaults = $.extend({}, { 
			pageBgResize : true,
			slideshowDelayTime : 2.5,
			slideNumber : undefined,
			nextPreviousButton : true,
			playPause : false,
			autoplay : false,
			mouse_drag : false,
			dotButtons : false,
			numberOfthumbnails : undefined
		} , params);
		
		// Initialize required variables and objects
		var self = this;
		self.pageBgResize = defaults.pageBgResize;
		self.delaySec = defaults.slideshowDelayTime;
		self.Tim = defaults.slideshowDelayTime;
		
		self.dotButtons = defaults.dotButtons;
		
		self.plaPau 		= 	defaults.playPause;
		self.nexPreBtn 		= 	self.dotButtons ? false : defaults.nextPreviousButton;
		self.numThum   		= 	true;
		self.slideNumber 	= 	self.dotButtons ? false : defaults.slideNumber;	
		
		self.spd = 0;
		self.ele = [];
		self.cur = 0;
		self.pre = 0;
		self.slideshow = window.innerWidth < 768 ? false : defaults.autoplay;
		self.resetSlideshow = defaults.autoplay;
		self.pauseNow = false;
		self.finishPlay = false;
		self.IE_old = $.browser.msie;
		self.mouse_drag = false;
		self.stopLoadBg = false;		
		self.readyToplay = false;
		self.pauseOnMouseover = false;
		self.loadNew = true;
		self.botButton = true;
		self.aniType = 0;		
		self.selector = selector;		
		self.selEle = $(selector);
      	
		if(!isTouch){
			self.mouse_drag = defaults.mouse_drag;
		}
		
		self.firNavPos = false;	
		
		self.animateEnd = true;
		
		self.resetPause = false;
		
		self.plp_pos1 = "-41px";	
		self.plp_pos2 = "0px";
		
		self.cssAnimationIn = "animated fadeIn";
		self.cssAnimationOut = "animated fadeOut";
		self.intv1;
		self.intv2;
		
		
	}
	

	fmMainSlider.prototype = {
		
		startActive : function(){
			var self = this;	
			
			if(self.selector.length === 0){ return; }
		
			self.selEle.css({"visibility":"visible"});
			var allSlides = self.selEle.find(".fmSlides");
			
			if(self.IE_old){
				allSlides.css({"overflow-x":"hidden"});
			}
		
			/* Create a navigation */
			if(self.slideNumber || self.nexPreBtn || self.plaPau){
				self.selEle.append('<div class="navigations"  ></div>');
				self.navCon = self.selEle.children(":last-child");
			}
			
			/* Add slide number if required */
			if(self.slideNumber){
				self.navCon.prepend('<div class="fmslider_sliderNumber"> <span id="sliderNumber">00</span> / <span id="totalSlides" ></span> </div>');
				self.numHolder = self.navCon.children(":first-child");
				self.num = self.selEle.parent().find("#sliderNumber");
				self.numOfSlides = self.selEle.parent().find("#totalSlides");
				self.numHolder.hide();
			}
			
			self.selEle.find(".magnificPopup").click(function(){
				self.Pause();			
			});
			


			/* Store all slides on Array */
			if(!isNaN(self.numThum)){
				var sl =  allSlides;
				var ss = [];
				 
				sl.children().each(function(){
					ss.push($(this));
				});
	
				var ff = 0;
              sl.append('<div class="row-fluid fmSlider_animate" ><div></div></div>');
				var ns = sl.children(":last-child").children(":first-child"); 
				 
				for(var jj=0; jj<ss.length; jj++){
					if(ff < self.numThum ){
						ff++;
						(ns).append(ss[jj]);
					}else{
						ff = 1;
						sl.append('<div class="row-fluid fmSlider_animate" ><div ></div></div>');
						ns = sl.children(":last-child").children(":first-child");
						(ns).append(ss[jj]);
					}
				}
			}
		
			self.allSlideHolder = self.selEle.find(".fmSlides");
			 
			self.allSlideHolder.children().each(function(){
					$(this).css({"opacity":0, "x": self.selEle.width()});
					self.ele.push($(this));
				}
			);
		
			self.numOfSlides = self.ele.length > 1 ? self.numOfSlides : false;
			if(self.numOfSlides){
				if(self.ele.length > 9){
					self.numOfSlides.text(self.ele.length);
				}else{
					self.numOfSlides.text("0"+self.ele.length);
				}
			}
			
			self.ele[self.ele.length-1].css({"opacity":0, "x": -self.ele[self.ele.length-1].width()});
			self.cur = self.ele.length;
			
			
		
			
			/* Play Pause Button */
			self.plaPau = self.ele.length > 1 ? self.plaPau : false;
			if(self.plaPau){
				self.navCon.prepend('<div  class="fmSlider_plaPau" ><div  class="fmSlider_plaPau_inner fxEmbossBtn"> <div class="fmSlider_plaPau_icon"> </div> <span class="btn_hover"></span> </div></div>');
				self.plaPau = self.navCon.children(":first-child");
				if(self.dotButtons){
					self.navCon.addClass("rightAlign");
				}
				
				self.plaPau.each(function(){
					var selor = $(this);	
					selor.click(function(){
						if(!self.slideshow){
							self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos1});
							self.slideshow = true;
							self.Start();
							
						}else{
							self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos2});
							self.slideshow = false;
							self.Pause();
						}
					});
				});
				
				self.slideshow = self.ele.length > 1 ? self.slideshow : false;
				if(!self.slideshow){
					self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos2});
				}else{
					self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos1});
				}
				
				self.plaPau.css({"visibility":"hidden"});
			}
	
			self.slideshow = self.plaPau ? self.slideshow : false;
			
			/* Next Previous Button */
			self.nexPreBtn = self.ele.length > 1 ? self.nexPreBtn : false;
			if(self.nexPreBtn){
				
				
				self.navCon.prepend(' <div class="next_pre_btn" ></div>');
				self.nxpx = self.navCon.children(":first-child");
				
				self.nxpx.prepend(' <a class="next_btn fxEmbossBtn" ><span class="btn_icon"></span><span class="btn_hover"></span></a>');
				
				self.nxB = self.nxpx.children(":first-child");
				self.nxpx.prepend('<a class="previous_btn fxEmbossBtn" ><span class="btn_icon"></span><span class="btn_hover"></span></a> ');
				self.pxB = self.nxpx.children(":first-child");
				
				if(isTouch){
					self.nxB.removeClass("enableTransition"); 
					self.pxB.removeClass("enableTransition"); 
				}else{
					self.nxB.addClass("enableTransition"); 
					self.pxB.addClass("enableTransition"); 
				}
				
				self.nxB.click(function(){
					self.Next();
				});
				
				self.pxB.click(function(){
					self.Previous();
				});
				
				self.nxB.css({"visibility":"hidden"});
				self.pxB.css({"visibility":"hidden"});
				/*self.nxB.hide();
				self.pxB.hide();*/
			}
			
			
			
			if(self.ele.length === 1){
				self.mouse_drag = false;
			}
			
			
			/* Dotted buttons */
			self.dotClick = -1;
			self.dotsWidth = 0;
			
			self.dotButtons = self.ele.length > 1 ? self.dotButtons : false;
			if(self.dotButtons){
				self.navCon.prepend('<ul class="fmslider_dots"></ul>');
				self.navDots = self.navCon.children(":first-child");
				for(jj=0; self.ele.length > jj; jj++){
					self.navDots.append('<li><a><span><span></span></span></a></li>');
					self.navDots.children(":last-child").data("num",jj);
					self.dotsWidth = self.dotsWidth + self.navDots.children(":last-child").find('a').width();
					self.navDots.children(":last-child").click(function() {
						self.dotClick = $(this).data("num");
						self.Next();
					});
				}
				self.navDots.children(":first-child").find("a").addClass("active");
				self.navDots.hide();
			}
			
			self.fadeToAll = false;
			if(self.numThum !== undefined){
				self.fadeToAll = self.selEle.hasClass('fadeEffect');
			}
			
			if(self.pauseOnMouseover){
				self.allSlideHolder.bind('mouseover mouseup mouseleave', function(e) {
					if(self.mouse_drag){
						self.Pause();
					}
				});
				
				self.allSlideHolder.bind('mouseout', function() {
					if(self.slideshow && self.mouse_drag){
						self.slideshowDelay();
					}
				});
				
				self.allSlideHolder.find("a").bind('mouseover mouseup mouseleave', function(e) {
					self.Pause();
				});
				
				self.allSlideHolder.find("a").bind('mouseout', function() {	
					if(self.slideshow){
						self.slideshowDelay();
					}
				});
			}
			
			
			// slide Drag Coding
		
			var tm;
			var tmArr=[];
			var tmMovChk;
			var tmRevMov = false;
			var bgDrgPos = 0;
			var strDrg = false;
			self.drgPosDir = 0;
			
			var mainCon = self.selEle;
			self.moveItem = self.allSlideHolder;
			self.dragIt = false;
			
			var pauseIntv;
			
			self.Start();
			
			/* Add Mouse cursor */
			if(self.mouse_drag && !isTouch){
				if(!this.hasTouch) {
					self.moveItem.addClass("fm_drag-cursor");
					self.moveItem.bind('mousedown', function() {		
						tmRevMov = false;
						self.moveItem.removeClass("fm_drag-cursor");
						self.moveItem.addClass("fm_draging-cursor");
						mouseDragInit();
					});
				}
				
				// Start to drag using below functionv
				var dragStart = function(){
					if(tch !== tch_){
						strDrg = true;
						self.dragIt = true;						
					}
					self.moveItem.stop();
					tm = Math.round(Math.abs(Number(tch_)-Number(tch)))< 101? 
					Math.round(Math.abs(Number(tch_)-Number(tch))) : Math.round(100 + Math.abs(100-(Math.abs(Number(tch_)-Number(tch))))*0.2);
					
					if(self.finishPlay){
						if((Number(tch_) > Number(tch))){
							self.moveItem.css({"x":Number(tm)+"px"});
						}else{
							self.moveItem.css({"x":-Number(tm)+"px"});
						}
					}
				};
				
				// Stop drag using below function, The next and previous slide will start here
				var dragStop = function(){
					 
					if(Number(tch) !== Number(tch_) && self.finishPlay){
						if(Number(tch) > Number(tch_) ){
		
							if(((Number(tch) - Number(tch_)) > 50 || tmMovChk>5) && !tmRevMov){
								self.moveItem.stop();
								if (!$.browser.msie){
									self.moveItem[animateSyntax]({"x":Number(-tm-(mainCon.width()*0.36))+"px", "opacity":0},300, function(){ dragFinish(); } );
								}else{
									self.moveItem[animateSyntax]({"x":Number(-tm-(mainCon.width()*0.36))-self.moveItem.width()+"px"},300, function(){ dragFinish(); } );
								}
								self.drgPosDir = 1;
								
							}else{
								self.moveItem.stop();
								self.moveItem[animateSyntax]({"x":"0px"});
							}
							
						}else{
							
							if(((Number(tch_)-Number(tch)) > 50 || tmMovChk>5) && !tmRevMov){
								self.moveItem.stop();
								if (!$.browser.msie){
									self.moveItem[animateSyntax]({"x":Number(tm+(mainCon.width()*0.36))+"px", "opacity":0},300, function(){ dragFinish(); } );
								}else{	
									self.moveItem[animateSyntax]({"x":Number(tm+(mainCon.width()*0.36))+self.moveItem.width()+"px"},300, function(){ dragFinish(); });
								}
								self.drgPosDir = -1;
							}else{
								self.moveItem.stop();
								self.moveItem[animateSyntax]({"x":"0px"});
							}
						}
					}
					tm = 0;
				};
				
				// Mousedown event for drag
				
				var mouseDragInit = function(){	
		
					$(document).bind('mousedown.fmDragEvent', function(e) {
						tch = tch_ = Math.abs(e.clientX);
						tmArr = [];
						tmArr.push(tch);
						
						bgDrgPos = parseInt(self.moveItem.css("x"), 10);
						
						self.Pause();
						
						$(document).bind('mousemove.fmDragEvent', function(e) {
							tmRevMov = tch_ > Math.abs(e.clientX) ? (Number(tch) > Number(tch_)) ? false:true : (Number(tch) < Number(tch_)) ? false : true;
							tch_ = Math.abs(e.clientX);
							tmArr.push(tch_);
							tmMovChk = Math.abs((tmArr[tmArr.length-1]-tmArr[tmArr.length-2]));
							dragStart();
	
							return false;
						});
						
						return false;
					});
					
					$(document).bind('mouseup.fmDragEvent', function() {
						strDrg = tch !== tch_ ? false : true;
						$(document).unbind('mousedown.fmDragEvent');
						$(document).unbind('mouseleave.fmDragEvent');
						$(document).unbind('mousemove.fmDragEvent');
						$(document).unbind('mouseup.fmDragEvent');	
						
						self.moveItem.removeClass("fm_draging-cursor");
						self.moveItem.addClass("fm_drag-cursor");
						
						self.Resume();
						
						dragStop();
						return false;
					});
					
					
					$(document).bind('mouseleave.fmDragEvent', function() {
						strDrg = false;
						$(document).unbind('mousedown.fmDragEvent');
						$(document).unbind('mouseleave.fmDragEvent');
						$(document).unbind('mousemove.fmDragEvent');
						$(document).unbind('mouseup.fmDragEvent');	
						
						self.moveItem.removeClass("fm_draging-cursor");
						self.moveItem.addClass("fm_drag-cursor");
						
						return false;
					});
				};
		
				
				// Touch screen Enable
				
				var touEle = self.moveItem;
				var tch = 0;
				var tch_ = 0;
				var tchY = 0;
				var tchY_ = 0;
				
				self.touMoving = true;
				
				
						
							
				var touchStart = function(e) {
					tch = tch_ = Math.abs(e.clientX);
					tmArr = [];
					tmArr.push(tch);
					self.moveItem.stop();
					bgDrgPos = parseInt(self.moveItem.css("x"), 10);
					tch = tch_ =  e.targetTouches[0].clientX;
					
					tchY = tchY_ = e.targetTouches[0].clientY;
				};
					 
				var touchEnd = function() {
					dragStop();
					if(Math.abs(tchY - tchY_) > 100){
						self.moveItem.stop();
						self.moveItem.css({"x":0+"px", "opacity":1});
					}
				};
		
				var touchMove = function(e) {
					tchY_ = e.targetTouches[0].clientY;
					if(Math.abs(tchY - tchY_) < 100){
						tmRevMov = tch_ > Math.abs(e.targetTouches[0].clientX) ? (Number(tch) > Number(tch_)) ? false:true : (Number(tch) < Number(tch_)) ? false : true;
						tch_ = Math.abs(e.targetTouches[0].clientX);
						tmArr.push(tch_);
						tmMovChk = Math.abs((tmArr[tmArr.length-1]-tmArr[tmArr.length-2]));
						dragStart();
					}else{
						self.moveItem.stop();
						self.moveItem.css({"x":0+"px", "opacity":1});
						self.touMoving = false;
						return false;
					}
				};
				
				var dragFinish = function(){
					if(Math.abs(tchY - tchY_) < 100){
						self.moveItem.stop();
						self.moveItem.css({"x":0+"px", "opacity":1});
						if(self.finishPlay){
							self.spd = 0;
							$(self.ele[self.cur]).css({"opacity":0, "x":$(self.selEle).width()} );
							if(self.drgPosDir<0){
								self.Previous();
							}else{
								self.Next();
							}
						}
					}else{
						self.moveItem.stop();
						self.moveItem.css({"x":0+"px", "opacity":1});
					}
				};
				
				// Drag coding end
				
			}else{				
			
					try{		  
						$(function() {	
							self.moveItem.swipe( {
								//Generic swipe handler for all directions
								swipe:function(event, direction, distance, duration, fingerCount) {
									if(direction === "left"){
										self.Next();
									}
									if(direction === "right"){
										self.Previous();
									}
									
								},
								allowPageScroll : "vertical",
								//Default is 75px, set to 0 for demo so any distance triggers swipe
								threshold: swipeThreshold
							});
						});
						
					  }catch(e){}
				}
			
		},
		
		Start : function(){	
		
			var self = this;
			self.readyToplay = true;
			
			if(self.dotClick>-1){
				self.cur = self.dotClick;
			}else{
				self.cur = self.ele.length > self.cur+1? self.cur+1 : 0;
			}
				$("body").find('.addVideo_slider.backGroundVideo').each(function(){
				})
				
				 self.selEle.find('[data-animated-in]').each(function(){
						  $(this).css("visibility", "visible");
					  });
					  
			self.startPlay();
			
		},

		

				
		/* start the slide animation */
		startPlay : function(){	
			var self = this;
			
				self.finishPlay = false;
				self.pauseNow = false;
				
				clearInterval(self.intv1);	
				clearInterval(self.intv2);	

				$("body").find('.addVideo_slider.backGroundVideo').each(function(){
					var vid_ = $(this);
					$("body").mainFm('video_delete', vid_);
					$(this).removeClass("addVideo");
				});
				
				$(".mCSB_container").addClass("removeOverflow");
				
				self.dotClick = -1;
				var dir;
				var aTyp = $(self.ele[self.pre]).hasClass('fadeEffect') || self.fadeToAll;
				
				self.aniType  = aTyp && !self.dragIt ? 0 : 1;
				
				/*aTyp = true;
				self.dragIt = true;
				self.aniType = 1;
				
				self.moveItem.stop();
				if (!$.browser.msie){
					self.moveItem[animateSyntax]({"x":Number(-(self.selEle.width()*0.36))+"px", "opacity":0},300, function(){  } );
				}else{
					self.moveItem[animateSyntax]({"x":Number(-(self.selEle.width()*0.36))-self.moveItem.width()+"px"},300, function(){  } );
				}*/
								
				if(self.navDots){
					self.navDots.find("a").removeClass("active");
					self.navDots.children().each(function(){
						if($(this).data("num") === self.cur){
							$(this).find("a").addClass("active");
						}
					});
				}
				
				
				
				if(self.aniType === 0){
					dir = 0;
				}else{
					dir = self.drgPosDir !== 0? self.drgPosDir : 1;
				}
				
				if(self.loadNew){
					self.loadNew = false;
					
					setTimeout(function(){
						if(self.navDots){
							self.navDots.fadeIn(500);
						}
	
						if(self.nexPreBtn){
							self.nxB.css({"visibility":"visible"}).hide().fadeIn(500);
							self.pxB.css({"visibility":"visible"}).hide().fadeIn(500);
						}
						
						if(self.numHolder){
							self.numHolder.hide().fadeIn(500);
						}
						if(self.plaPau){
							self.plaPau.css({"visibility":"visible"}).hide().fadeIn(500);
						}
					}, 1200);
				}

				var firT = true;
				var aSpd = aTyp ? 5 : 1;
				
				if($(self.ele[self.pre]).hasClass('fmSlider_animate')){
					var sel1 = $(self.ele[self.pre]);
					var kk = dir>0 ? 0: sel1.length;
					var px = self.aniType === 0 ? 0 : 550;	
				}
				
				$(self.ele[self.pre]).stop();				
				var qx = self.aniType === 0 ? 0 : -$(self.ele[self.pre]).width();				
				var aaSpd = self.dragIt ? 10 : self.spd;			
			
				var aniTim = 0;

				if($(self.ele[self.pre]).hasClass('fmSlider_animate')){
					var sel = $(self.ele[self.pre]);
					var lent = 3;
					sel.find('[data-animated-in]').each(function(){
						lent++;
					});
					sel.find('[data-animated-in]').each(function(){
						var mc = $(this);
						mc.stop();
						mc.data("cid2", self.pre)
						aniTim = !self.dragIt && self.pre !== self.cur? aniTim+200 : 0;						
						var aniTyp = mc.attr("data-animated-out") !== undefined ? mc.attr("data-animated-out") : self.cssAnimationOut;
						mc.data("out", aniTyp);
						var tim_ = cssAnimate ? aniTim : aniTim-200;
						
						if($(this).hasClass("backGroundVideo")){
							tim_ = lent*200;
						}
						
						if(self.pre !== self.cur){
							setTimeout(function(){
								if(mc.data("cid2") ===  self.pre){
									if(cssAnimate){
										mc.removeClass(aniTyp)
									  	.css({"visibility":"visible"}).addClass(aniTyp);
									}else{
										mc.removeClass(aniTyp)
									  		.css({"visibility":"visible"}).animate({"opacity":0, "left":-15},500, "easeInOutQuad");
										}
									
								}
							},tim_ );
						}
					});
				}
				
				var allTime =  self.dragIt || !self.animateEnd ? 10 : cssAnimate ? aniTim+1000 : aniTim+300;
							
				self.intv1 = setInterval(function(){ 
					clearInterval(self.intv1);
					self.animateEnd = false;
					
					if($(self.ele[self.pre]).hasClass('fmSlider_animate')){
						var sel2 = $(self.ele[self.pre]);
						sel2.find('[data-animated-In]').each(function(){
							var mc = $(this);				
							mc.removeClass(mc.data("out"));							
							self.spd  = 0;
						});
					}					
				
					for(var ii=0; ii<self.ele.length; ii++){
						$(self.ele[ii]).css({"position": "absolute", "visibility":"hidden", "top":"-10000px"});
					}
					
					self.moveItem.stop();
					self.moveItem.css({"opacity":1});
					$(self.ele[self.cur]).css({"position": "relative", "visibility":"visible", "top":"0"});
					
					self.posNav();
					
					
					
					self.spd = 0;
					self.pre = self.cur;
					
					aTyp = $(self.ele[self.cur]).hasClass('fadeEffect') || self.fadeToAll;
					self.aniType  = aTyp ? 0 : 1;
					
					if(self.aniType === 0){
						dir = 0;
					}else{
						dir = self.drgPosDir !== 0? self.drgPosDir : 1;
					}
				
					if(self.drgPosDir<0){	
						//$(self.ele[self.cur]).css({"x": -$(self.ele[self.cur]).width()});
					}
					
					if(self.num){
						if(self.cur+1 > 9 ){
							$(self.num).text(self.cur+1);
						}else{
							$(self.num).text("0"+ (self.cur+1));
						}
					}
					
					allTime = 0;
					if($(self.ele[self.cur]).hasClass('fmSlider_animate')){
						var sel2 = $(self.ele[self.cur]);
						sel2.find('[data-animated-in]').each(function(){
							var th1 = $(this);
							var aniTyp = th1.attr("data-animated-in") !== undefined ? th1.attr("data-animated-in") : self.cssAnimationIn;
							var aniTim = !isNaN(th1.attr("data-animated-time")) ? 100*th1.attr("data-animated-time") : 50*(kk);
							aniTim = cssAnimate ? aniTim : aniTim/2;
							th1.stop();
							th1.data("in", aniTyp);
							th1.data("time", aniTim);
							th1.removeClass(th1.data("in"));
							allTime =  self.dragIt || !self.animateEnd || self.pre !== self.cur ? 10 : ((allTime+1)*50)+1000;						
							th1.css({"opacity":"0"});							
							self.spd  = 0;
							
						});
					}

					self.drgPosDir = 0;
					self.allSlideHolder.stop();
					self.allSlideHolder.css({"opacity": 1, "x":0});
					$(self.ele[self.cur]).stop();
					
					if($(self.ele[self.cur]).hasClass('fmSlider_animate')){
						sel2.find('[data-animated-in]').each(function(){
							$(this).css({"visibility":"hidden"});
						});
					}
					
					
					self.posNav();

					
					self.firNavPos = true;

					aSpd = aTyp ? (sel2.length<5 ? 5 :1) : 1;
					
					firT = true;
					$(self.ele[self.cur]).css({"opacity": 1, "x":0});
	  
				  var vt = 0;
                  if($(self.ele[self.cur]).hasClass('fmSlider_animate') ){
                    var kk = dir>0 ? 0: sel2.length;					
                    sel2.find('[data-animated-in]').each(function(){
						var th2 = $(this);
						th2.data("cid", self.cur);
                      	th2.stop();
                     	kk = firT && aTyp ? 0 : (dir > 0 || aTyp ? kk+aSpd : kk-aSpd);
                      	firT = false;
					  	var trr = cssAnimate ? th2.data("time") : th2.data("time")-50;
                      	th2.css({"visibility":"visible"})
					  		.css({"x":"0px","opacity":1, "visibility":"hidden"});
							setTimeout(function(){
								if(th2.data("cid") ===  self.cur){									
									if(cssAnimate){										
										th2.removeClass(th2.data("in"));
										th2.css({"visibility":"visible"}).addClass(th2.data("in"));								
										th2.removeClass(th2.data("in")+" "+th2.data("out")).addClass(th2.data("in")).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
											$(this).removeClass($(this).data("in")+" "+$(this).data("out"));
										});
									}else{
										th2.css({"opacity":"0", "visibility":"visible", "left": 15}).animate({"opacity":1, "left":0 },500, "easeInOutQuad", function(){
											$(this).removeClass($(this).data("in")+" "+$(this).data("out"));
										});
									}
								}
	
							}, th2.data("time") );
						vt = th2.data("time") > vt ? th2.data("time") : vt;
							
                    });
                  }

				$(self.ele[self.cur]).find('.addVideo_slider.backGroundVideo').each(function(){
						$(this).addClass("addVideo");
						self.pause_slideshow();
				});
				
				$("body").mainFm('videoRest');
				
				self.animateEnd = true; 
				$(".mCSB_container").addClass("removeOverflow");
				self.spd = 850;
				self.finishPlay = true;
				self.dragIt = false;
				
				self.delaySec =  self.Tim; 
				if($(self.ele[self.cur]).attr("data-stayTime") !== undefined){
					self.delaySec = $(self.ele[self.cur]).attr("data-stayTime"); 
				}
				
				self.intv2 = setInterval(function(){ 
					clearInterval(self.intv2);
					  if(self.slideshow && !self.pauseNow){
						self.slideshowDelay();
					  }
				  }, vt);
				  
			}, allTime);
			
		},
		

		
		/* Slide show delay */
		slideshowDelay : function(){
			var self = this;
			clearInterval(self.ssChk);
			self.ssChk = setInterval(function(){
				if(self.finishPlay){
					clearInterval(self.ssChk);
					self.ssInt = setInterval(function(){
						clearInterval(self.ssInt);	
						self.Start();
					}, 1500*self.delaySec);
				}
			}, 50);
		},
		
		/* Previous slide action */
		Previous: function(){
			var self = this;
			if(self.finishPlay){
				clearInterval(self.ssChk);
				clearInterval(self.ssInt);
				self.cur = self.cur-2 < -1 ? self.ele.length-2 : self.cur-2;
				self.Start();
				
			}
		},
		
		/* Next slide action */
		Next: function(){
			var self = this;
			if(self.finishPlay){
				clearInterval(self.ssChk);
				clearInterval(self.ssInt);
				self.Start();
			}
		},
		
		/* Pause slide action */
		Pause : function(){
			var self = this;
			self.pauseNow  = true;
			clearInterval(self.ssChk);
			clearInterval(self.ssInt);
		},
		
		/* Stop slide action */
		Stop : function(){
			var self = this;
			
			if(!self.readyToplay){
				return;
			}
			
			clearInterval(self.ssChk);
			clearInterval(self.ssInt);
			self.cur = self.ele.length-1;
			self.pre = 0;
			self.spd = 0;
			self.finishPlay = false;
			self.slideshow = false;
			for(var ii=0; ii<self.ele.length; ii++){
				$(self.ele[ii]).stop();
				$(self.ele[ii]).css({"x": $(self.selEle).width(), "opacity":0, "visibility":"hidden", "position": "absolute"});
			}
			$(self.ele[0]).css({"x": $(self.selEle).width(),"position": "relative"});
			if(self.num){
				$(self.num).text("01");
			}
		},
		
		/* Restart the slider */
		ReStart : function(){
			var self = this;
			
			if(!self.resetPause){
				return;
			}
			
			self.resetPause = false;	
					
			self.stopLoadBg = false;
			self.pauseNow  = false;
			self.Stop();
			self.slideshow = self.resetSlideshow;
			if(self.plaPau){
				if(self.resetSlideshow){
					self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos1});
				}else{
					self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos2});
				}
			}
			clearInterval(self.ssChk);
			clearInterval(self.ssInt);
			self.Start();
		},
		
		/* Resume the slider if it pause */
		Resume: function(){
			var self = this;
			if(self.finishPlay && self.slideshow){
				clearInterval(self.ssChk);
				clearInterval(self.ssInt);
				self.slideshowDelay();
			}
		},
		
		pause_slideshow: function(){
			var self = this;
			/*if(self.resetPause){
				return;
			}
			self.resetPause = true;*/
			if(self.plaPau){
				self.plaPau.children(":first-child").children(":first-child").css({"right" : self.plp_pos2});
				self.slideshow = false;
				self.Pause();
			}
		
		},
		
		/*postion navigation */
		
		posNav : function(){
		
			var self = this;
			$(self.ele[self.cur]).css({"padding-top":0+"px", "padding-bottom":0+"px"});
			
			var fh = $("body").hasClass("horizontal_layout") ? $(".footer").outerHeight() : 0;
			
			var elem = $(self.ele[self.cur]);
			
			var alignCenter_ = false;
			if($(self.ele[self.cur]).find(".center_element").length > 0){
				alignCenter_ = true;
				elem = $(self.ele[self.cur]).find(".center_element");

			}
			
			var tbSpc = $(".header").outerHeight()+$(".footer").outerHeight()+50;
			var viewArea = window.innerHeight-($(".header").outerHeight()+fh+100);
			var padd = (viewArea - elem.outerHeight())/2;
			
			if(self.plaPau ){
				self.plaPau.css({"left": Math.round(self.dotsWidth/2)+24 });
			}
			
			if(!$(self.ele[self.cur]).hasClass("fullHeight") || alignCenter_){
				if($(self.selEle).hasClass("middleAlign") && window.innerWidth > 991 ){
					
					if( padd > 0){
						elem.css({"padding-top": $(".header").outerHeight()+padd+"px"});
						elem.css({"padding-bottom": fh+padd+"px"});
					}else{
						elem.css({"padding-top": $(".header").outerHeight()+50+"px"});
						elem.css({"padding-bottom": 0+"px"});
					}
				}else{
					padd = 50;
					elem.css({"padding-top": 85+"px"});
					elem.css({"padding-bottom": 50+"px"});
				}				
			}else{
				elem.css({"padding-top":"0px", "padding-bottom":"0px"});
			}
			
			var valP = self.navCon.css("top");
			
			if(window.innerWidth > 991 ){
				if($("body").hasClass("horizontal_layout")){
					if(self.slideNumber ){
						valP = window.innerHeight-( $(".footer").outerHeight()+75);
					}else{
						valP = window.innerHeight-( $(".footer").outerHeight()+5);
					}
				}else{
					if(self.slideNumber ){
						valP = window.innerHeight-75;
					}else{
						valP = window.innerHeight-15;
					}
				}
			}else{
				valP = 40;
			}
			
			if(valP !==  self.navCon.css("top")){
				self.navCon.css({"top": valP});
			}
				
		}
		
		
		
		
		
			
	};
	

	/*  Initizlize and create the slider plug-in */
	$.fn.fmMainSlider = function(params) {
		var $fm = $(this);
		var instance = $fm.data('GBInstance');
		if (!instance) {
			if (typeof params === 'object' || !params){
				return $fm.data('GBInstance',  new fmMainSlider($fm, params));	
			}
		} else {
			if (instance[params]) {					
				return instance[params].apply(instance, Array.prototype.slice.call(arguments, 1));
			}
		}
	};
	
	
})( jQuery );
