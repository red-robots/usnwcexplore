/*This function populates the mobile nav base on the nav in the header and footer 
 */
function populateMobileNav(){
	var $mobileNav = jQuery('.mobile-nav');
	var $mobileMenu = jQuery('<ul></ul>').addClass('mobile-menu');
	jQuery('#header .nav > ul').children('li').children('a').each(function(){
		var $this=jQuery(this);
		$mobileMenu.append(jQuery('<a></a>').append(jQuery('<li></li>').text($this.text())).attr('href',$this.attr('href')));
	});
	$mobileNav.append($mobileMenu);
}
/* This function shows the mobile nav and sets up the event handler for displaying the sub-levels of navigation
 */
function showMobileNav(){
	var $mobileNav = jQuery('.mobile-nav').show();
}
//This function hides the mobile nav
function hideMobileNav(){
	jQuery('.mobile-nav').hide();
}
/* This function resets the page-content, showmenu and mobile nav elements to their original states
 * upon a resize of the browser window past ipad formatting at 768px
 */
function resetIfResize(){
	var $pageContainer=jQuery('.section-page-container');
	var $header = jQuery('#header');
	var resetPageContainer=function(){							//function is event handler
		if(jQuery(window).width()>670&&jQuery('#header .nav').css('display')==="none"){ //if coming from mobile width where .nav is not displayed and crossed the 768 ipad boundary
			$header.animate({
					left:'0'
				},300,function(){
					$header.css({
						'left':'0',
					});
				});
			$pageContainer.animate({						//animate section-page-container to original state
				left: '0',
			},300,function(){
				$pageContainer.css({
					'left':'0'
				});
				hideMobileNav();
			});
			unlockWheel();
			unlockScroll();
			$pageContainer.off('click'); 
			jQuery('#header .showmenu').removeClass('active');	
			jQuery(window).off('resize',resetPageContainer);			//remove event handler so that it can only be called once
		}
		//this section hides the mobile nav desktop layout so that the mobile layout may be employed
		if(jQuery(window).width()<=670&&jQuery('#header .nav').css('display')!=="none"){ //if coming from desktop where nav is displayed and crossed the 768 ipad boundary
			console.log("event");
			jQuery('#header .nav').hide();
			jQuery(window).off('resize',resetPageContainer);			//remove event handler so that it can only be called once
		}
	}
	jQuery(window).on('resize',resetPageContainer);
}
/* This function prevents the default action of the mouse wheel.
 * This is used to prevent scrolling from the mouse wheel while the mobile menu is open.
 */
function setWheel(e){
	e = e || window.event;
	if(e.preventDefault)e.preventDefault();
	if(e.stopPropagation)e.stopPropagation();
	e.cancelBubble = true;
	e.returnValue = false;
}
/* This function locks the mouse wheel feature in place so that the user cannot scroll the page with the mouse wheel
 *
 * The setWheel function is passed as the event handler.
 * This function is used to lock the scroll for the mouse wheel while operating on the mobile nav
 */
function lockWheel(){
	if(document.addEventListener){
		if(navigator.userAgent.indexOf("Gecko")!=-1){
			document.addEventListener('DOMMouseScroll',setWheel);
		}
		document.addEventListener('mousewheel',setWheel);
	}
	else document.attachEvent('onmousewheel',setWheel);
}
/* This function de-registers the event listeners set from the lockWheel function
 * unlocking the mouse wheel so that the user can scroll the page using the mouse wheel.
 */
function unlockWheel(){
	if(document.removeEventListener){
		document.removeEventListener('mousewheel',setWheel);
		if(navigator.userAgent.indexOf("Gecko")!=-1)document.removeEventListener('DOMMouseScroll',setWheel);
	}
	else document.detachEvent('onmousewheel',setWheel);
}
//this function returns the absolute value of the input
function abs(x){
	if(x<0)return -1*x;
	else return x;
}
/* This function moves the scroll so that it always returns to the passed lockx and locky values 
 * This function is used to prevent the user from scrolling away from the mobile nav while it is open
 */
function moveScroll(obj){
	var $document = jQuery(document);
	var currentx = $document.scrollLeft();
	var currenty = $document.scrollTop();
	var diffx = currentx - obj.data.lockx;
	var diffy = currenty - obj.data.locky;
	var stepx = -1*diffx/10;
	var stepy = -1*diffy/10;
	if(abs(stepx)<1){
		if(stepx<0)stepx=-1;
		else stepx=1;
	}
	if(abs(stepy)<1){
		if(stepy<0)stepy=-1;
		else stepy=1;
	}
	if(abs(diffx)>=abs(stepx))$document.scrollLeft(currentx + stepx);
	else $document.scrollLeft(obj.data.lockx);
	if(abs(diffy)>=abs(stepy))$document.scrollTop(currenty + stepy);
	else $document.scrollTop(obj.data.locky);
}
/* This function sets the event listener for the scroll, and passes the values to lock the scroll to
 */
function lockScroll(){
	var lockxvar = jQuery(document).scrollLeft();
	var lockyvar = jQuery(document).scrollTop();
	jQuery(document).on('scroll', {
		lockx: lockxvar,
		locky: lockyvar
	},moveScroll);
}
/* This function de-registers the event listeners set in the lockScroll function
 * effectively releasing the scroll feature back to normal use
 */
function unlockScroll(){
	jQuery(document).off('scroll',moveScroll);
}
/* The following function populates the mobile nav, sets the controls for the horizontal toggle for the section-page-container div 
 * on mobile and sets the call to view the mobile nav if clicked and reset if the screen is resized. 
 * 
 * It is controlled at first by clicking on the show menu hamburger. This shows the mobile menu and pushes the 
 * section-page-container over.
 * After that the page is returned to its original state once any item on the page is clicked.
 * Note: e.preventDefault() is used to prevent the action of clicking on any link when the page
 * is pushed over. 
 * Also note the on click for the page content calls the off function on itself to remove the on click 
 * after the page is returned to its original state
 */
jQuery(document).ready(function(){
	populateMobileNav();					//have to populate the nav before getting the items
	hideMobileNav();
	var $showMenu = jQuery('#header .showmenu'); 						//get the hamburger 
	var $pageContainer = jQuery('.section-page-container');
	var $header = jQuery('#header');
	$showMenu.on('click', function(e){							//event listener for click on hamburger
		if(jQuery(window).width()<=670){
			if(!$showMenu.hasClass('active')){						//if not actively animated, if animated do nothing event listener
				resetIfResize();									//on page-content will handle
				e.stopPropagation(); //stop propagation so that page content on click isn't triggered 
				showMobileNav();
				$header.animate({
					left:'250px',
                    'width':$pageContainer.css("width")
				},300,function(){
					$header.css({
						'left':'250px',
                        'width':$pageContainer.css("width")
					});
				});
				$pageContainer.animate({								//if page is not pushed over aka not active class on hamburger
					left: '250px'										//animate to 250px
				}, 300,function(){
					$pageContainer.css({
						'left':'250px',
					});
				});
				lockWheel();
				lockScroll();
				$showMenu.addClass('active');						//add class active once hamburger is clicked
				$pageContainer.on('click',function(e){				//set up event listener for return animation on click for section-page-container
					e.preventDefault();	//prevent linking			//note any of it's children will bubble up and trigger this
					$header.animate({
						left:'0'
					},300,function(){
						$header.css({
							'left':'0',
                            'width':'100%'
						});
					});
					e.returnValue=false;
					$pageContainer.animate({							//animate back to 0
						left: '0'
					},300,function(){
						$pageContainer.css({
							'left':'0',
						});
						hideMobileNav();
					});
					unlockWheel();
					unlockScroll();
					$pageContainer.off('click');						//deactivate event listenter for page content once animated to 0 left 0 top
					$showMenu.removeClass('active');				//remove class active from hamburger after animation
				});
			}
		}
		else {
			jQuery('#header .nav').slideToggle("fast");
			resetIfResize();
		}
	});
});