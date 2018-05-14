 <?php
/*
 * Normal Page Template
*/
get_header('page'); ?>

<div id="img-container-home">

	<?php 
	global $post;
	$featured_image_location = get_field('featured_image_location');
	$featured_image_credit	= get_field('featured_image_credit');

	?>
	
	<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full')[0];?>">

	<?php if ($featured_image_credit || $featured_image_location) { ?>

  		<div class="showcredit">
			<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
		</div>


		<div class="photocredit">
  	
			<?php if ($featured_image_credit) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit; ?></p> <?php } ?>

			<?php if ($featured_image_location) { ?><p><b>Location:</b> <?php echo $featured_image_location; ?></p> <?php } ?>
		</div>

	<?php } ?>


</div><!-- img container home-->
    
    
    
    <div class="clearfix"></div>

<div class="clearfix"></div>

<div id="grid">

<script type="text/javascript">

jQuery(document).ready(function($){

$(".showcredit").hover(function() {
      $(this).next(".photocredit").show();
}).mouseout(function() {
      $(this).next(".photocredit").hide();
});

});
</script>


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
    
<a name="<?php echo($post->post_name) ?>"></a>

    
    <div class="title">
    <h1 class="widget-title"><?php echo the_title(); ?></h1>
	<?php if (get_field('author') ) {
    $author = get_field('author');?>
    
    <p>By <?php echo $author; ?></p>
    
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
    
    
    <p><?php edit_post_link(); ?></p>
    
    </div><!-- content -->
    
   
      <div class="post-photos">
      <!-- <div class="down-arrow"><img src="https://cdn4.iconfinder.com/data/icons/defaulticon/icons/png/256x256/arrow-down.png"></div> -->
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
   			$size = 'large';
   
			 if ( $image1 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image1.'">
<div class="Test"></div>
<?php if ($imagecred1 || $imageloc1) { ?>

  	<div class="showcredit">
<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/W_logo.png">
</div>


<div class="photocredit">
  	
<p><b>Photographer:</b> <?php echo $imagecred1; ?></p>
<p><b>Location:</b> <?php echo $imageloc1; ?></p>

</div>

<?php } ?>



</div></div>';
   			}
   
			if ( $image2 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image2.'"></div></div>';
   			}
   			
   			if ( $image3 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image3.'"></div></div>';
   			}
   			
   			if ( $image4 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image4.'"></div></div>';
   			}
   			
   			if ( $image5 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image5.'"></div></div>';
   			}
   			
   			if ( $image6 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image6.'"></div></div>';
   			}
   			
   			if ( $image7 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image7.'"></div></div>';
   			}
   			
   			if ( $image8 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image8.'"></div></div>';
   			}
   			
   			if ( $image9 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image9.'"></div></div>';
   			}
   			
   			if ( $image10 )   {
   			echo '<div class="all box"><div class="img-container"><img src="'.$image10.'"></div></div>';
   			}
   			
   			
   			
   			?>
   </div>
   
   
   
   
   
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