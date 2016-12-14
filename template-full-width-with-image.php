<?php 
/* 
 * Template Name: Full Width with Image
 * @since         1.0
 * @alter         2.0
*/

get_header('full'); ?>

<div class="wrap">    
    <div id="full-page">
        <div class="box-content post">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
            
            <div class="page-entry">
          <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  					the_post_thumbnail('fullwidth'); }  ?>

            
                
				<?php the_content(); ?>

            </div><!-- #page-entry -->
                
            <?php endwhile; endif; ?>
        </div>
   
        
	</div><!-- #page -->
    
</div><!-- #wrap -->
<?php get_footer('full'); ?>