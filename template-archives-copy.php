<?php 
/*
 * Template Name: Archives - copy
 * @since         1.0
 * @alter         1.6
*/

get_header('archives'); ?>

<div id="img-container-home">
	<?php 
	global $post;
	$featured_image_location = get_field('featured_image_location');
	$featured_image_credit	= get_field('featured_image_credit');
	?>
	<img src="<?php echo preg_replace("/http:\/\/explore.usnwc.org/","",wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full')[0]);?>">
	<?php if ($featured_image_credit || $featured_image_location) { ?>
  		<div class="showcredit">
			<img src="/wp-content/uploads/2015/03/Photo_Icon_White.png">
		</div>
		<div class="photocredit">
			<?php if ($featured_image_credit) { ?> <p><b>Photographer:</b> <?php echo $featured_image_credit; ?></p> <?php } ?>
			<?php if ($featured_image_location) { ?><p><b>Location:</b> <?php echo $featured_image_location; ?></p> <?php } ?>
		</div>
	<?php } ?>
</div><!-- img container home-->
<div class="clearfix"></div>
<div class="clearfix"></div>


<div id="archives-page"> 
		<hr>
		<nav id="archive-search-sort-bar">
			<?php foreach(get_categories() as $category){ ?>
				<a class="<?php echo $category->category_nicename;?>"><?php echo $category->name;?></a>
			<?php } ?>
		</nav>
		<hr>
		<div id="archive-edition-images">
			<?php
			for($i=0;$i<2;$i++){
				if($i==1){
					$args=array("post_type"=>"post","posts_per_page"=>"-1"); 
				}
				else {
					$args=array("post__not_in"=>array(69,226,710,794),"post_type"=>"page");
				}
				$query = new WP_Query($args);
       		 		if($query->have_posts()){
        				while($query->have_posts()){
        					$query->the_post();
						$archive_image = wp_get_attachment_image_src(get_post_thumbnail_id($queried_object_id),'full')[0];?>
						<?php if($archive_image){
							$category_classes = '';
   							foreach(get_the_category() as $category){
   								$category_classes .= $category->category_nicename . ' '; 
   							} ?>
							<div class=" archive <?php echo $category_classes.$query->post->post_name;?> all box">
        							<div class="img-container">
									<a href="<?php echo get_permalink($queried_object_id);?>">
										<img src="<?php echo str_replace(home_url(),"",$archive_image);?>">
									</a>
									<?php
									if($i==1){
										$featured_image_location = get_field('photo_location');
										$featured_image_credit	= get_field('photo_credit');	 
									}
									else {
										$featured_image_location = get_field('featured_image_location');
										$featured_image_credit	= get_field('featured_image_credit');	
									}
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
					} //end of while
        			} //end of have_posts() if
			} //end of for loop ?>
        	</div><!-- title images-->
</div><!-- #wrap -->
<hr>
<?php get_footer('archives'); ?>