/*
 * This script controls the centering of the elements in site info at window sizes above 670 aka.desktop.
 * It does nothing and resets the site info to it's original css values if screen size is <= 670
 */

//when the dom is loaded
jQuery(document).ready(function(){
	//get the site info which holds the elements we want to center, and set offset used to 
	//offset the centering of site info since the explore logo isn't centered in site info
	var $siteInfo2=jQuery('#site-info2');
	var offset=-15;
	//on first pass center site info if window size greater than 670 and set function to 
	//recenter on window resize
	if(window.innerWidth>670){
		$siteInfo2.css({
			'marginLeft': (window.innerWidth/2)-(Number($siteInfo2.css("width").replace(/[^0-9\.-]/g,""))/2)-offset+"px"
		});
		jQuery(window).on('resize', sizeMargin);
	}
	//otherwise set function to wait until the window size > 670
	else jQuery(window).on('resize', wait);
	//this function waits until the window size is > 670 then centers the site info and 
	//sets the event handler to recenter if resize and takes off the wait function
	function wait(){
		if(window.innerWidth>670){
			$siteInfo2.css({
				'marginLeft': (window.innerWidth/2)-(Number($siteInfo2.css("width").replace(/[^0-9\.-]/g,""))/2)-offset+"px"
			});
			jQuery(window).on('resize', sizeMargin).off('resize', wait);
		}
	}
	//this function recenters the site info if the screen width > 670. If screen width <=670 this function removes itself
	//from the event listener, removes the margin property set by this script so the original css value is used, and sets an
	//event listener for the wait function on resize.
	function sizeMargin(){
		if(window.innerWidth>670){
			$siteInfo2.css({
				'marginLeft': (window.innerWidth/2)-(Number($siteInfo2.css("width").replace(/[^0-9\.-]/g,""))/2)-offset+"px"
			});
		}
		else {
			$siteInfo2.attr('style',$siteInfo2.attr('style').replace(/margin[^;]*;/g,""));
			jQuery(window).on('resize', wait).off('resize', sizeMargin);
		}
	}
});