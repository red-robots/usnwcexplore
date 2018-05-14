<?php
/* Template Name: Edition
 *
 * @since   1.0
 * @alter   1.6
*/

get_header('category'); 

$featured_image_mobile = get_field('featured_image_mobile');?>

<div id="img-container-home" class="<?php if($featured_image_mobile) echo "mobile-present";?>">

	<?php 
	global $post;
	$featured_image_location = get_field('featured_image_location');
	$featured_image_credit	= get_field('featured_image_credit');
	$featured_image_location_mobile = get_field('featured_image_location_mobile');
	$featured_image_credit_mobile	= get_field('featured_image_credit_mobile');
	?>
	
	<img class="desktop" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full')[0];?>">
	<?php if($featured_image_mobile){?>
		<img class="mobile" src="<?php echo $featured_image_mobile;?>">
	<?php } ?>

	<?php if ($featured_image_credit || $featured_image_location) { ?>

		<div class="showcredit desktop">
			<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
		</div>


		<div class="photocredit desktop">
	
			<?php if ($featured_image_credit) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit; ?></p> <?php } ?>

			<?php if ($featured_image_location) { ?><p><b>Location:</b> <?php echo $featured_image_location; ?></p> <?php } ?>
		</div>

	<?php } ?>

	<?php if ($featured_image_credit_mobile || $featured_image_location_mobile) { ?>

		<div class="showcredit mobile">
			<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
		</div>


		<div class="photocredit">
	
			<?php if ($featured_image_credit_mobile) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit_mobile; ?></p> <?php } ?>

			<?php if ($featured_image_location_mobile) { ?><p><b>Location:</b> <?php echo $featured_image_location_mobile; ?></p> <?php } ?>
		</div>

	<?php } ?>


</div><!-- img container home-->
    
<div class="clearfix"></div>

<div class="clearfix"></div>



<div id="grid">

<!--<script type="text/javascript">

jQuery(document).ready(function($){

$(".showcredit").hover(function() {
      $(this).next(".photocredit").show();
}).mouseout(function() {
      $(this).next(".photocredit").hide();
});

});
</script>-->


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
    if ( $(this).attr("href").match("#") && !$('.showmenu').attr('class').match('active')) {
 
      // cancel default event propagation
      event.preventDefault();
 
      // scroll to the location
      var href = $(this).attr('href').replace('#', '')
      scrollToAnchor( href );
 
    }
 
  });
 
});


</script>

<hr>

<div id="title-images">

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

//query the posts based on the category of the page you are on
$edition = get_field("edition");
//$edition (since it is a taxonomy) returns the ID for the category so we will use that to query the posts 
$query_string = 'cat='.$edition;

//old code for querying posts
global $query_string; 
//query_posts($query_string . '&cat=-72');

//new code for querying posts
query_posts($query_string);

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
		
	$mobile_banner = get_field('mobile_banner');
    ?>
    
    <div class="all box <?php if($mobile_banner) echo "mobile-present";?>">
      
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
						<?php $alternate_banner = get_field('alternate_banner');
						// Display the appropriate sized featured image?>
						<a href="<?php echo '#'.($post->post_name); ?>"><img class="desktop" src="<?php
							if($alternate_banner){
								echo $alternate_banner;
							} else {
								echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full")[0];
							} ?>">
							<?php if($mobile_banner){?>
								<img class="mobile" src="<?php echo $mobile_banner;?>">
							<?php } ?>
						</a>
					</div><!-- #img-container -->
				<?php if ( $hover_image ) { ?>
				</div>
				<?php }?>   
               
                <?php // Display post title ?>
                
                <?php if (get_field('text-overlay') == 'light') {
				$textcolor = 'light';
			} else if (get_field('text-overlay') == 'dark') {
       				$textcolor = 'dark';
			} else if (get_field('text-overlay') == 'grey'){
				$textcolor = 'grey';
			} else {
				$textcolor = 'light';
			}?>		
			<?php if (get_field('author') ) {
    				$author = get_field('author');
    			}
  			   ?>
  			   
               <div class="story-info"> 
	            <h2 class="<?php echo ($textcolor) ?>"><a href="<?php echo '#'.($post->post_name); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	            <p class="<?php echo ($textcolor) ?>"><?php echo $author ?></p>
	            </div>
				
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




</div>



 <!-- Rewind and Reset -->
<?php  wp_reset_query(); // Reset Query  ?> 
<?php rewind_posts(); ?>


<hr>

<?php

global $query_string;
//query_posts($query_string . '&cat=-72');
query_posts($query_string);

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

<?php /*adding the wrapper div with the name of the post in order to customize css for each individual post*/ ?>
<div class="<?php echo $post->post_name; ?>">
    
<a name="<?php echo($post->post_name) ?>"></a>

<?php $mobile_banner = get_field('mobile_banner');?>
<div class="feat-img <?php if($mobile_banner) echo "mobile-present";?>">
    <?php 
	
	$video=get_field('video_url'); ?>
				<?php if($video) { ?>
					<a href="<?php echo $video; ?>" 
						rel="wp-video-lightbox" title="">
						<?php } ?>
						
						<?php if ( has_post_thumbnail() ) {
							$thumbnailImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0]; ?>
							<img class="desktop" src="<?php echo $thumbnailImg;?>">
						<?php } ?>
						<?php if($mobile_banner){?>
							<img class="mobile" src="<?php echo $mobile_banner;?>">
						<?php } ?>
						<?php if($video) { ?>
						</a> 
			
				<?php } ?>



<?php if (get_field('photo_credit') ) {
    $credit = get_field('photo_credit');
    }
  	?>
<?php if (get_field('photo_location') ) {
    $location = get_field('photo_location');
	}
	
    $location_mobile = get_field('photo_location_mobile');
    $credit_mobile = get_field('photo_credit_mobile');
  	?>

<?php if ($location || $credit) { ?>

<div class="showcredit desktop">
<img class="white" src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
</div>


<div class="photocredit desktop">

<?php if ($credit) { ?> <p><b>Photographer:</b> <?php echo $credit; ?></p> <?php } ?>

<?php if ($location) { ?><p><b>Location:</b> <?php echo $location; ?></p> <?php } ?>
</div>

<?php } ?>

<?php if ($location_mobile || $credit_mobile) { ?>

  	<div class="showcredit mobile">
<img class="white" src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
</div>


<div class="photocredit">
  	
<?php if ($credit_mobile) { ?> <p><b>Photographer:</b> <?php echo $credit_mobile; ?></p> <?php } ?>

<?php if ($location_mobile) { ?><p><b>Location:</b> <?php echo $location_mobile; ?></p> <?php } ?>
</div>

<?php } ?>

</div>
    
    <div class="title">
    <h1 class="widget-title"><?php echo the_title(); ?></h1>

<?php if (get_field('author_website') ) {
    $authorsite = get_field('author_website');
}?>


	<?php if (get_field('author') ) {
    $author = get_field('author');?>
    
    <p>By 

<?php if ( $authorsite ) { ?>
<a href="<?php echo $authorsite; ?>" target="_blank"> 
<?php }?>

<?php echo $author; ?>

<?php if ( $authorsite ) { ?>
</a>
<?php }?>

</p>
    
  	<?php } ?>
  	
  	<hr> 
  	</div>
    
    <div class="content"><?php the_content(); ?>
        
    <script language="javascript" type="text/javascript">

function popitup(url) {
	newwindow=window.open(url,'name','height=250,width=450');
	if (window.focus) {newwindow.focus()}
	return false;
}

</script>
    
    <div class="social">
    	<a href="https://twitter.com/share?text=<?php echo get_the_title($post->ID);?>&hashtags=usnwcEXPLORE&via=usnwc" onclick="return popitup('https://twitter.com/share?text=<?php echo get_the_title($post->ID);?>&hashtags=usnwcEXPLORE&via=usnwc')">
    		<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/twitter.png">
    	</a>
    </div>
    <div class="social">
    	<a href="http://www.facebook.com/sharer.php?u=http://explore.usnwc.org<?php echo $_SERVER['REQUEST_URI'];?>" onclick="return popitup('http://www.facebook.com/sharer.php?u=http://explore.usnwc.org<?php echo $_SERVER['REQUEST_URI'];?>')">
    		<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/facebook.png">
    	</a>
    </div>
    
    <p><?php edit_post_link(); ?></p>
    
    </div><!-- content -->
    
   
      <div class="post-photos">
   			<?php 
   
   			$image1 = get_field('image_1');
   			$image2 = get_field('image_2');
   			$image3 = get_field('image_3');
   			$image4 = get_field('image_4');
   			$image5 = get_field('image_5');
   			$image6 = get_field('image_6');
   			$image7 = get_field('image_7');
   			$image8 = get_field('image_8');
   			$image9 = get_field('image_9');
		    $image10 = get_field('image_10');
		    $image11 = get_field('image_11');
			$imagecred1 = get_field('image_1_credit');
   			$imagecred2 = get_field('image_2_credit');
   			$imagecred3 = get_field('image_3_credit');
   			$imagecred4 = get_field('image_4_credit');
   			$imagecred5 = get_field('image_5_credit');
   			$imagecred6 = get_field('image_6_credit');
   			$imagecred7 = get_field('image_7_credit');
   			$imagecred8 = get_field('image_8_credit');
   			$imagecred9 = get_field('image_9_credit');
		    $imagecred10 = get_field('image_10_credit');
		    $imagecred11 = get_field('image_11_credit');
			$imageloc1 = get_field('image_1_location');
   			$imageloc2 = get_field('image_2_location');
   			$imageloc3 = get_field('image_3_location');
   			$imageloc4 = get_field('image_4_location');
   			$imageloc5 = get_field('image_5_location');
   			$imageloc6 = get_field('image_6_location');
   			$imageloc7 = get_field('image_7_location');
   			$imageloc8 = get_field('image_8_location');
   			$imageloc9 = get_field('image_9_location');
		    $imageloc10 = get_field('image_10_location');
		    $imageloc11 = get_field('image_11_location');
   			$size = 'large';
   
			 if ( $image1 )   {
   				echo '<div class="all box"><div class="img-container"><img src="'.$image1.'">'; ?>

				<?php if ($imagecred1 || $imageloc1) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred1; ?></p>
					<p><b>Location: </b><?php echo $imageloc1; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   
   
			if ( $image2 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image2.'">'; ?>

				<?php if ($imagecred2 || $imageloc2) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred2; ?></p>
					<p><b>Location: </b><?php echo $imageloc2; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image3 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image3.'">'; ?>

				<?php if ($imagecred3 || $imageloc3) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred3; ?></p>
					<p><b>Location: </b><?php echo $imageloc3; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image4 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image4.'">'; ?>

				<?php if ($imagecred4 || $imageloc4) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred4; ?></p>
					<p><b>Location: </b><?php echo $imageloc4; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image5 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image5.'">'; ?>

				<?php if ($imagecred5 || $imageloc5) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred5; ?></p>
					<p><b>Location: </b><?php echo $imageloc5; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image6 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image6.'">'; ?>

				<?php if ($imagecred6 || $imageloc6) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred6; ?></p>
					<p><b>Location: </b><?php echo $imageloc6; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image7 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image7.'">'; ?>

				<?php if ($imagecred7 || $imageloc7) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred7; ?></p>
					<p><b>Location: </b><?php echo $imageloc7; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image8 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image8.'">'; ?>

				<?php if ($imagecred8 || $imageloc8) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred8; ?></p>
					<p><b>Location: </b><?php echo $imageloc8; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}
   			
   			if ( $image9 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image9.'">'; ?>

				<?php if ($imagecred9 || $imageloc9) { ?>

  				<div class="showcredit">
				<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
				</div>


				<div class="photocredit">
	  	
					<p><b>Photographer: </b><?php echo $imagecred9; ?></p>
					<p><b>Location: </b><?php echo $imageloc9; ?></p>

				</div>
				<?php }
				echo '</div></div>';

   			}

		    if ( $image10 )   {
			    echo '<div class="all box"><div class="img-container"><img src="'.$image10.'">'; ?>

			    <?php if ($imagecred10 || $imageloc10) { ?>

                    <div class="showcredit">
                        <img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
                    </div>


                    <div class="photocredit">

                        <p><b>Photographer: </b><?php echo $imagecred10; ?></p>
                        <p><b>Location: </b><?php echo $imageloc10; ?></p>

                    </div>
			    <?php }
			    echo '</div></div>';

		    }
		    if ( $image11 )   {
			    echo '<div class="all box"><div class="img-container"><img src="'.$image11.'">'; ?>

			    <?php if ($imagecred11 || $imageloc11) { ?>

                    <div class="showcredit">
                        <img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
                    </div>


                    <div class="photocredit">

                        <p><b>Photographer: </b><?php echo $imagecred11; ?></p>
                        <p><b>Location: </b><?php echo $imageloc11; ?></p>

                    </div>
			    <?php }
			    echo '</div></div>';

		    }
   			
   			
   			
   			?>
   </div>
   
   </div> <!-- <?php echo $post->post_name; ?> -->
   
   
   
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