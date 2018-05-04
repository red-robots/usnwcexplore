<?php 
/*
 * Template Name: Films
 * @author   Fritz Healy
 * @since         1.0
 * @alter         1.6
*/

get_header('films'); 

$featured_image_mobile = get_field('featured_image_mobile');?>

<div id="img-container-home" class="<?php if($featured_image_mobile) echo "mobile-present";?>">
	<?php 
	global $post;
	$featured_image_location = get_field('featured_image_location');
	$featured_image_credit	= get_field('featured_image_credit');
	$featured_image_location_mobile = get_field('featured_image_location_mobile');
	$featured_image_credit_mobile	= get_field('featured_image_credit_mobile');
	?>
	<img class="desktop" src="<?php echo preg_replace("/http:\/\/explore.usnwc.org/","",wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full')[0]);?>">
	<?php if($featured_image_mobile){?>
		<img class="mobile" src="<?php echo $featured_image_mobile;?>">
	<?php }
	if ($featured_image_credit || $featured_image_location) { ?>
  		<div class="showcredit desktop">
			<img src="/wp-content/uploads/2015/03/Photo_Icon_White.png">
		</div>
		<div class="photocredit desktop">
			<?php if ($featured_image_credit) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit; ?></p> <?php } ?>
			<?php if ($featured_image_location) { ?><p><b>Location:</b> <?php echo $featured_image_location; ?></p> <?php } ?>
		</div>
	<?php } ?>
	<?php if ($featured_image_credit_mobile || $featured_image_location_mobile) { ?>
  		<div class="showcredit mobile">
			<img src="/wp-content/uploads/2015/03/Photo_Icon_White.png">
		</div>
		<div class="photocredit">
			<?php if ($featured_image_credit_mobile) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit_mobile; ?></p> <?php } ?>
			<?php if ($featured_image_location_mobile) { ?><p><b>Location:</b> <?php echo $featured_image_location_mobile; ?></p> <?php } ?>
		</div>
	<?php } ?>
</div><!-- img container home-->
<div class="clearfix"></div>

<div id="films-page">    
	<div id="grid">
		<div id="films-chapter-images">
			<?php $args=array("cat"=>16,"post_type"=>"post",'order'=>'ASC'); 
			$query = new WP_Query($args);
       		 	if($query->have_posts()){
        			while($query->have_posts()){
        				$query->the_post();
					global $embed_code, $vid_url;
				        // Gather custom fields
				        $embed_code = get_post_meta($post->ID, 'soy_vid', true);
				        $vid_url = get_post_meta($post->ID, 'soy_vid_url', true);
					$video_url = get_field('video_url');?>
					<?php if($video_url){
						if(has_post_thumbnail()){?>
						<div class=" film <?php echo $query->post->post_name; ?> all box">
        						<div class="img-container">
								<a href="<?php echo $video_url;?>" rel="wp-video-lightbox" title="">
									<img src="<?php echo preg_replace("/http:\/\/explore.usnwc.org/", "", wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID), 'full')[0]);?>">
								</a>
								<?php
								$featured_image_location = get_field('featured_image_location');
								$featured_image_credit	= get_field('featured_image_credit');	 
								if ($featured_image_credit || $featured_image_location) { ?>
							  		<div class="showcredit">
										<img src="/wp-content/uploads/2015/03/Photo_Icon_White.png">
									</div><!--end of show credit-->
									<div class="photocredit">
										<?php if ($featured_image_credit) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit; ?></p> <?php } ?>
										<?php if ($featured_image_location) { ?><p><b>Location:</b> <?php echo $featured_image_location; ?></p> <?php } ?>
									</div><!--end of photo-credit-->
								<?php } ?>
							</div><!--end of image container-->
							<div class="story-info">
								<?php if (get_field('text-overlay') == 'light') {
									$textcolor = 'light';
								} else if (get_field('text-overlay') == 'dark') {
       			 						$textcolor = 'dark';
								} else{
									$textcolor = 'light';
								}?>
								<h2 class="<?php echo $textcolor;?>">
									<a href="<?php echo $video_url;?>" rel="wp-video-lightbox" title="">
										<?php echo get_the_title();?>
									</a>
								</h2>
							</div><!--end of story info-->
						</div><!-- end of all box title-->
					<?php } //end of has thumbnail if
					else{?>
						<div class=" archive <?php echo $query->post->post_name; ?> all box">
        						<div class="img-container">
								<a href="<?php echo $video_url;?>" rel="wp-video-lightbox" title="">
									<img src="/wp-content/uploads/2015/03/Explore_2000x800.jpg">
								</a>
								<div class="showcredit">
									<img src="http://explore.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
								</div><!--end of show credit-->
								<div class="photocredit">
									<p><b>Photographer: Cooper Lambla</b></p>
									<p><b>Location: Zambezi River, Zambia</b></p>
								</div><!--end of photo-credit-->
								<div class="story-info">
									<?php if (get_field('text-overlay') == 'light') {
										$textcolor = 'light';
									} else if (get_field('text-overlay') == 'dark') {
       					 					$textcolor = 'dark';
									} else{
										$textcolor = 'light';
									}?>
									<h2 class="<?php echo $textcolor;?>">
										<a href="<?php echo $video_url;?>" rel="wp-video-lightbox" title="">
											<?php echo get_the_title();?>
										</a>
									</h2>
								</div><!-- end of story info-->
							</div><!-- end of img-container-->
						</div><!--end of all box title-->
					<?php } //end of else
					} //end of video url if
				} //end of while
        		} //end of have_posts() if
			else { ?>
				<div>
					<h2>There are no editions to show at this time. Please check back soon!</h2>
				</div>
			<?php }?>
        	</div><!-- title images-->
	</div><!-- #grid -->
</div><!-- #wrap -->
<hr>
<?php get_footer('films'); ?>