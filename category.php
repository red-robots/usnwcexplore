<?php
/* Category Archive
 *
 * @since   1.0
 * @alter   1.6
*/
wp_redirect(get_bloginfo('url'));
exit;
get_header('category'); ?>

<div id="grid">


<script type="text/javascript">

jQuery(document).ready(function($){

// scroll handler
  var scrollToAnchor = function( id ) {
 
    // grab the element to scroll to based on the name
    var elem = $("a[name='"+ id +"']");
 
    // if that didn't work, look for an element with our ID
    if ( typeof( elem.offset() ) === "undefined" ) {
      elem = $("#"+id);
    }
 
    // if the destination element exists
    if ( typeof( elem.offset() ) !== "undefined" ) {
 
      // do the scroll
      $('html, body').animate({
              scrollTop: elem.offset().top
      }, 1000 );
 
    }
  };
 
  // bind to click event
  $("a").click(function( event ) {
 
    // only do this if it's an anchor link
    if ( $(this).attr("href").match("#") ) {
 
      // cancel default event propagation
      event.preventDefault();
 
      // scroll to the location
      var href = $(this).attr('href').replace('#', '')
      scrollToAnchor( href );
 
    }
 
  });
 
});


</script>



<?php
/**

 * Post Filters
 *
 * Displays filter options if on frontpage and if they aren't 
 * disabled in the theme options. The filters are based on
 * the categories. Each post has its category slug assigned
 * as class names. The Isotope plugin handles the filtering.
 */ ?>





<?php 
/**
 * Display ALL posts
 *
 * If this is the homepage and the "show all posts on blog" option
 * is checked in the theme options, then display all posts on one 
 * page without pagination.
 */ 
/*if( is_home() && !is_search() && ( of_get_option( 'show_all' ) || of_get_option( 'frontpage_category' ) ) ):
	
	$query_string = false;
	
	if( of_get_option('show_all') ){
		$query_string = 'posts_per_page=-1';
	}
	
	if( of_get_option('frontpage_category') && of_get_option('frontpage_category') != 'all' ){
	
		if(of_get_option('show_all')){
			$query_string .= '&';
		}
		
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$query_string .= 'cat='.of_get_option('frontpage_category').'&paged='.$paged;
	}
	
	if( $query_string ){
		query_posts($query_string);
	}
	
endif;*/


//query_posts( 'cat=-72' );



global $query_string;
query_posts($query_string . '&cat=-72');


/* Say hello to the Loop... */
if ( have_posts() ) : 

/* Anything placed in #sort is positioned by jQuery Masonry */ ?>






    
    <?php while ( have_posts() ) : the_post(); 
    	
    	global $my_size, $force_feat_img, $embed_code, $vid_url, $hover_image;
    	
        // Gather custom fields
        $embed_code = get_post_meta($post->ID, 'soy_vid', true);
        $vid_url = get_post_meta($post->ID, 'soy_vid_url', true);
        $force_feat_img = get_post_meta($post->ID, 'soy_hide_vid', true);
        $show_title = get_post_meta($post->ID, 'soy_show_title', true);
        $show_desc = get_post_meta($post->ID, 'soy_show_desc', true);
        $box_size = get_post_meta($post->ID, 'soy_box_size', true); 
        $hover_image = get_post_meta($post->ID, 'hover_image', true);
                
        if( $box_size == 'Medium (485px)' ){
            $my_size = 'col3';
            $embed_size = '495';
        } else if( $box_size == 'Large (660px)' ){
            $my_size = 'col4';
            $embed_size = '670';
        } else if( $box_size == 'Tiny (135px)' ){
            $my_size = 'col1';
            $embed_size = '145';
        }else{
            $my_size = 'col2';
            $embed_size = '320';
        }
        
        /* Check whether content is being displayed
         * This determines whether a border should be applied
         * above the postmeta section
        */
        if($show_title != 'No'){
            $content_class = 'has-content';
        } else if($show_desc != 'No' && $post->post_content){
            $content_class = 'has-content';
        }else {
            $content_class = 'no-content';
        }
        
        // Assign categories as class names to enable filtering
        $category_classes = '';
        
        foreach( ( get_the_category() ) as $category ) {
            $category_classes .= $category->category_nicename . ' ';
        } 
    ?>
    
    <div class="all box ">
      
        <div <?php post_class( 'box-content '.$content_class ) ?>>
            <?php 
            // Display video if available
            if( ( $embed_code || $vid_url ) && !$force_feat_img ):
            
            	if( $vid_url ){
            		echo '<div class="vid-container">'.apply_filters('the_content', '[embed width="' . $embed_size . '"]' . $vid_url . '[/embed]').'</div>';
            	} else {
            		echo '<div class="vid-container">'.$embed_code.'</div>';
            	} 
            
            // Display gallery
            elseif( has_post_format( 'gallery' ) && !$force_feat_img ):
            
            	get_template_part( 'includes/loop-gallery' );
            
            // Display featured image
            elseif ( has_post_thumbnail() ): ?>
				<?php if ( $hover_image ) { ?>
				<div id="hoverlink">
				<?php }?>
                <div class="img-container">
                    <?php 
                    // Display the appropriate sized featured image
                    if( $my_size != 'col2' ): ?>
                        <a href="<?php echo '#'.($post->post_name); ?>"><?php the_post_thumbnail('large'); ?></a>
                    <?php else: ?>
                        <a href="<?php echo '#'.($post->post_name); ?>"><?php the_post_thumbnail('large'); ?></a>
                    <?php endif; ?>
                 <?php if ( $hover_image ) { ?>
				</div>
				<?php }?>   
             </div><!-- #img-container -->
               
                <?php // Display post title ?>
                
                <?php if (get_field('text-overlay') == 'light') {
				$textcolor = 'light';
				} else if (get_field('text-overlay') == 'dark') {
       			 $textcolor = 'dark';
				}?>
				
                
	            <h2 class="<?php echo ($textcolor) ?>"><a href="<?php echo '#'.($post->post_name); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	            
				
            <?php endif; // #has_post_thumbnail() ?>
            
            
            
          
            
        </div><!-- #box-content -->
    </div><!-- #box -->
    <?php endwhile; ?>

<?php // Display pagination when applicable
if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'usnwc') ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>', 'usnwc') ); ?></div>
        <div class="clearfix"></div>
    </div><!-- #nav-below -->
<?php endif; ?>

<?php else :
/* If there are no posts */ ?>
<!-- 
<div id="sort">
    <div class="box">
        <div class="box-content not-found">
        <h2><?php echo('Sorry, no posts were found'); ?></h2>
        <?php get_search_form(); ?>
        </div>
    </div>
</div> -->
<?php endif; ?>








 <!-- Rewind and Reset -->
<?php  wp_reset_query(); // Reset Query  ?> 
<?php rewind_posts(); ?>


<div class="hosted"><h1 class="widget-title"><?php single_cat_title( '', true ); ?></h1></div>


<hr>

<?php

global $query_string;
query_posts($query_string . '&cat=-72');


/* Say hello to the Loop... */
if ( have_posts() ) : 

/* Anything placed in #sort is positioned by jQuery Masonry */ ?>


    <?php while ( have_posts() ) : the_post(); 
    	
    	global $my_size, $force_feat_img, $embed_code, $vid_url;
    	
        // Gather custom fields
        $embed_code = get_post_meta($post->ID, 'soy_vid', true);
        $vid_url = get_post_meta($post->ID, 'soy_vid_url', true);
        $force_feat_img = get_post_meta($post->ID, 'soy_hide_vid', true);
        $show_title = get_post_meta($post->ID, 'soy_show_title', true);
        $show_desc = get_post_meta($post->ID, 'soy_show_desc', true);
        $box_size = get_post_meta($post->ID, 'soy_box_size', true); 
        
        if( $box_size == 'Medium (485px)' ){
            $my_size = 'col3';
            $embed_size = '495';
        } else if( $box_size == 'Large (660px)' ){
            $my_size = 'col4';
            $embed_size = '670';
        } else if( $box_size == 'Tiny (135px)' ){
            $my_size = 'col1';
            $embed_size = '200';
        }else{
            $my_size = 'col2';
            $embed_size = '320';
        }
        
        /* Check whether content is being displayed
         * This determines whether a border should be applied
         * above the postmeta section
        */
        if($show_title != 'No'){
            $content_class = 'has-content';
        } else if($show_desc != 'No' && $post->post_content){
            $content_class = 'has-content';
        }else {
            $content_class = 'no-content';
        }
        
        // Assign categories as class names to enable filtering
        $category_classes = '';
        
        foreach( ( get_the_category() ) as $category ) {
            $category_classes .= $category->category_nicename . ' ';
        } 
    ?>
    
<div class="feat-img">
    <?php 

if ( has_post_thumbnail() ) {
	the_post_thumbnail('full');
} ?>
</div>
    
    <h1 class="widget-title"><?php echo the_title(); ?><a name="<?php echo($post->post_name) ?>"></a></h1>
    
    <div class="content"><?php the_content(); ?></div>
    
   
   
   <?php

$post_object = get_field('slider');

if( $post_object ): 

	// override $post
	$post = $post_object;
	setup_postdata( $post ); 

	?>
	
	
	<?php $soliloquy = get_post_meta( $post->ID, 'gallery', true ); ?>
	<?php if ( function_exists( 'soliloquy_slider' ) ) soliloquy_slider( $soliloquy ); ?>


    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
   
   <hr>
    
    <?php endwhile; ?>

<?php // Display pagination when applicable
if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
        
    </div><!-- #nav-below -->
<?php endif; ?>

<?php else :
/* If there are no posts */ ?>
<div id="sort">
   
</div><!-- #sort -->
<?php endif; ?>








</div><!-- #grid -->
<?php get_footer('category'); ?>