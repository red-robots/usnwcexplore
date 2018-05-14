<?php 
/*
 * Template Name: Archives
 * @since         1.0
 * @alter         1.6
*/

get_header('archives'); 
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
<div class="clearfix"></div>


<div id="archives-page">    
	<div id="grid">
		<div id="archive-edition-images">
			<?php $args=array("post__not_in"=>array(69,226,710,794,1159),"post_type"=>"page","posts_per_page"=>-1); 
			$query = new WP_Query($args);
       		 	if($query->have_posts()){
        			while($query->have_posts()){
        				$query->the_post();
					$archive_image = get_field('archive_image');?>
					<?php if($archive_image){?>
						<div class=" archive <?php echo the_title();?> all box">
        						<div class="img-container">
								<a href="<?php echo get_permalink($queried_object_id);?>">
									<img src="<?php echo preg_replace("/http:\/\/explore.usnwc.org/","",$archive_image);?>">
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
									<a href="<?php echo get_permalink($queried_object_id);?>">
										<?php echo get_the_title();?>
									</a>
								</h2>
							</div><!--end of story info-->
						</div><!-- end of all box title-->
					<?php } //end of has thumbnail if
					else{?>
						<div class=" archive <?php echo get_the_title();?> all box">
        						<div class="img-container">
								<a href="<?php echo get_permalink($queried_object_id);?>">
									<img src="/wp-content/uploads/2015/03/Explore_2000x800.jpg">
								</a>
								<div class="showcredit">
									<img src="https://stories.usnwc.org/wp-content/uploads/2015/03/Photo_Icon_White.png">
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
										<a href="<?php echo get_permalink($queried_object_id);?>">
											<?php echo get_the_title();?>
										</a>
									</h2>
								</div><!-- end of story info-->
							</div><!-- end of img-container-->
						</div><!--end of all box title-->
					<?php }
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
<?php get_footer('archives'); ?>