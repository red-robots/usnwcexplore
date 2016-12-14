<?php 
/**
 * Sidebar.php
 *
 */ ?>
<div id="sidebar">

	<?php if(is_single()){ ?>
		<?php dynamic_sidebar( 'post-sidebar' ); ?>
	<?php //} else if(is_page_template('template-unique-sidebar.php')) { ?>
		<?php //dynamic_sidebar( 'unique-sidebar' ); ?>
	<?php //} else if(is_archive() || is_home()) { ?>
		<?php //dynamic_sidebar( 'gallery-sidebar' ); ?>
	<?php } else { ?>

	
<!--<div class="sidebar-item box-content">
<h3 class="widget-title">Trail Status and Activity Schedule</h3>
<?php if ( ! dynamic_sidebar( 'page-sidebar' ) ) : endif; // end primary widget area ?>
</div> sidebar-item  -->
<?php } ?>

        <?php  // If it's a summer camp form Page then show this sidebar ?>
    <?php if ( is_page( 'summer-camp-forms-never') ) { ?>
   <div class="sidebar-item box-content">
    <h3 class="widget-title">Other Links</h3>
            <ul>
            <li><a href="<?php bloginfo(url); ?>/play/wp-login.php?action=register">Register</a></li>
            <li><a href="<?php bloginfo(url); ?>/play/wp-login.php">Login to update your info</a></li>
            <li>Please note: If you cannot finish this form at this time, please click through to the end and submit what information you have finished. You can always come back to finish or update any information that needs changing.</li>
            </ul>
    </div>
    <?php } // End Summer Camp Forms ?>
    
    
 <?php if(is_page('directions')) { ?>  
  <div class="sidebar-item box-content">
<h3 class="widget-title">Map</h3>  
     <div id="directions-right">
			<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=5000+Whitewater+Center+Parkway+Charlotte,+NC++28214&amp;sll=37.0625,-95.677068&amp;sspn=42.901912,72.949219&amp;ie=UTF8&amp;hq=5000+Whitewater+Center+Parkway&amp;hnear=Charlotte,+NC+28214&amp;ll=35.272251,-81.005458&amp;spn=0.04651,0.089003&amp;output=embed"></iframe><br />
            
View <a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=5000+Whitewater+Center+Parkway+Charlotte,+NC++28214&amp;sll=37.0625,-95.677068&amp;sspn=42.901912,72.949219&amp;ie=UTF8&amp;hq=5000+Whitewater+Center+Parkway&amp;hnear=Charlotte,+NC+28214&amp;ll=35.272251,-81.005458&amp;spn=0.04651,0.089003" style="color:#0000FF;text-align:right">U.S National Whitewater Center</a> in a larger map </div><!-- map -->
 </div><!-- widget -->
 <?php } ?> 

    <?php  // Box of links on contact page ?>
    <?php if ( is_page('contact-us') ) { ?>
   <div class="sidebar-item box-content">
    <h3 class="widget-title">Other Links</h3>
<div class="contact-page">
            <ul>
            <li class="employment"><a href="<?php bloginfo(url); ?>/about/employment">Employment</a><br/>Employment</li>
            <li class="donation"><a href="<?php bloginfo(url); ?>/about/request-for-donation">Request for Donation</a><br/>Request for Donation</li>
            <li class="band"><a href="<?php bloginfo('url'); ?>/riverjam/band-submission-form">Band Submission Form</a><br/>Band Submission Form</li>
	    <li class="brochure"><a href="<?php bloginfo('url'); ?>/about/brochure-request-form/">Band Submission Form</a><br/>Brochure Request</li>
            </ul>
</div>
    </div>
    <?php } // End About Us ?>

  
    
    
        <?php  // If it's a summer camp form Page then show this sidebar ?>
    <?php if ( is_page( 'summer-camp-forms-never') ) { ?>
   <div class="sidebar-item box-content">
    <h3 class="widget-title">Other Links</h3>
            <ul>
            <li><a href="<?php bloginfo(url); ?>/play/wp-login.php?action=register">Register</a></li>
            <li><a href="<?php bloginfo(url); ?>/play/wp-login.php">Login to update your info</a></li>
            </ul>
    </div>
    <?php } // End Summer Camp Forms ?>
    
    
 
 
 <?php 
//
///////////    River Jam Stuff    < -----------
//
?>    



    
</div><!-- #primary .widget-area -->