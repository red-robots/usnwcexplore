<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
       wp_enqueue_script('jquery');
       wp_enqueue_script('jquery-core-ui');
       wp_enqueue_script('jquery-tabs-ui');
       wp_enqueue_script('hoverlink', get_bloginfo('template_directory').'/rollover.js');
       //wp_head();
    ?>



<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="google-site-verification" content="e3L8kU2GBIb6wsJkRj2n6v1GDc-ajo6yg6IgX2xYl7w" />


<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'shaken' ), max( $paged, $page ) );

?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_url').'?v='.time(); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox-1.3.4.css" />

<link rel="stylesheet" href="http://explore.usnwc.org/wp-content/themes/usnwc/css/addtohomescreen.css">


<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">
twttr.conversion.trackPid('l4lpc');
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l4lpc&p_id=Twitter" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l4lpc&p_id=Twitter" />
</noscript>

<script src="<?php echo get_template_directory_uri(); ?>/js/addtohomescreen.min.js?"></script>
<script>
addToHomescreen({skipFirstVisit:true,maxDisplayCount:1});
</script>

<!--<link rel="apple-touch-icon" sizes="57x57" href="http://explore.usnwc.org/wp-content/uploads/2015/03/Explore_57x57.jpg" />
<link rel="apple-touch-icon" sizes="72x72" href="http://explore.usnwc.org/wp-content/uploads/2015/03/Explore_72x72.jpg" />
<link rel="apple-touch-icon" sizes="114x114" href="http://explore.usnwc.org/wp-content/uploads/2015/03/Explore_114x114.jpg" />-->
<link rel="apple-touch-icon" sizes="144x144" href="http://explore.usnwc.org/wp-content/uploads/2015/05/Explore_Favicon.png" />

<!--<link rel="stylesheet" href="http://www.usnwc.org/play/franklin-webfonts/franklingothicfs_condensed_macroman/stylesheet.css" type="text/css" charset="utf-8" />

<link rel="stylesheet" href="http://www.usnwc.org/play/franklin-webfonts/franklingothicfs_condenseditalic_macroman/stylesheet.css" type="text/css" charset="utf-8" />

<link rel="stylesheet" href="http://www.usnwc.org/play/franklin-webfonts/franklingothicfs_mediumcondensed_macroman/stylesheet.css" type="text/css" charset="utf-8" />
-->

<?php wp_head(); ?>


<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

  
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61189862-1', 'auto');
  ga('send', 'pageview');

</script>


</head>

<body>
<div class="mobile-nav"></div>
<div class="section-page-container">
<div class="false-header">
	<img class="false-showmenu" src="/wp-content/uploads/2015/07/false-showmenu.jpg">
	<img class="false-logo" src="/wp-content/uploads/2015/07/false-logo.jpg">
</div>
<div id="header">
<div class="showmenu"><img src="http://explore.usnwc.org/wp-content/uploads/2015/03/hamburger.png"></div>
<div id="site-info2">
        
    			
    			<nav class="left">
    				<?php wp_nav_menu( array( 'menu'=>'left' ) ); ?>
    			</nav>
    			
                <div id="logo">
                    <a href="http://explore.usnwc.org/"><img src="/wp-content/uploads/2015/07/ExploreLogo.png"></a>
                </div>
                
                <nav class="right">
                	<?php wp_nav_menu( array( 'menu'=>'right' ) ); ?>
                </nav>
    
            
        </div><!-- #site-info -->
        
        
                
        <?php /* Main Menu */ ?>
        <div class = "nav_border img:hover">
	<div class="header-nav">
       <div class="nav">
		<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => '' ) ); ?>
       </div>
        </div>
	</div> <!--#nav-border-->
       
    
        
        <div class="clearfix"></div>
  <!--  </div> #wrap -->
  
<!--  <div class="visit-us"><a href="<?php bloginfo('url') ?>/visit-us">Visit Us &rsaquo;</a></div>-->
  





</div>

<div class="section-page-content <?php echo $post->post_name;?>">