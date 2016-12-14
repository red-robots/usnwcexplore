<?php 
/* 
 * Template Name: Full Width
 * @since         1.0
 * @alter         2.0
*/

get_header('full'); ?>

<div class="wrap">    
    <div id="full-page">
        <div class="box-content post">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
            <h1 class="widget-title"><?php the_title(); ?></h1>
            <div class="page-entry">
            	
                
				<?php the_content(); ?>

            </div><!-- #page-entry -->
                
            <?php endwhile; endif; ?>
        </div>
        
        <?php if(current_theme_supports('shaken_page_comments')) : 
        	comments_template( '', true ); 
        endif; ?>
        
	</div><!-- #page -->
    
</div><!-- #wrap -->
<?php get_footer('full'); ?>