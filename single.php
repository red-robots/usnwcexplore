<?php
/* Category Films
 *
 * @since   1.0
 * @alter   1.6
*/
get_header('category'); 

/* Say hello to the Loop... */
if ( have_posts() ) : 

/* Anything placed in #sort is positioned by jQuery Masonry */ ?>
<div id="grid">
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
    	<a href="https://twitter.com/share?text=<?php echo get_the_title($post->ID);?>&hashtags=usnwcstories&via=usnwc" onclick="return popitup('https://twitter.com/share?text=<?php echo get_the_title($post->ID);?>&hashtags=usnwcstories&via=usnwc')">
    		<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/twitter.png">
    	</a>
    </div>
    <div class="social">
    	<a href="http://www.facebook.com/sharer.php?u=http://stories.uswnc.org<?php echo $_SERVER['REQUEST_URI'];?>" onclick="return popitup('http://www.facebook.com/sharer.php?u=http://stories.uswnc.org<?php echo $_SERVER['REQUEST_URI'];?>')">
    		<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/facebook.png">
    	</a>
    </div>
    
    <p><?php edit_post_link(); ?></p>
    
    </div><!-- content -->
    
   </div> <!-- <?php echo $post->post_name; ?> -->
   
   
    <?php endwhile; ?>

<?php endif; ?>


</div><!-- #grid -->
<?php get_footer('category'); ?>