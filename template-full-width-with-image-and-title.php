<?php 
/* 
 * Template Name: Full Width with Image adn title
 * @since         1.0
 * @alter         2.0
*/

get_header('full'); ?>

<div class="wrap">    
    <div id="full-page">
        <div class="box-content post">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
            
            <div class="page-entry">
        
                    
                    
                    <?php 
				// Display media (Video URL >> Wide embed >> Embed >> Image)
				if($vid_url):
		        	echo apply_filters( 'the_content', "[embed width='670']" . $vid_url . "[/embed]" );
		        elseif($vid_wide):
					echo $vid_wide; 
		        elseif($vid): 
					echo $vid;
				// new stuff
				elseif(get_post_meta($post->ID, 'use another poster', true)): { ?>
				<img src="<?php echo get_post_meta($post->ID, "use another poster", $single = true); ?>" class="feat-img" />
                <?php }
				// end new stuff 
				elseif ( has_post_thumbnail() ):
		            the_post_thumbnail('fullwidth');
		        endif; ?>

            
             <h1 class="page-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>

            </div><!-- #page-entry -->
                
            <?php endwhile; endif; ?>
        </div>
   
        
	</div><!-- #page -->
    
</div><!-- #wrap -->
<?php get_footer('full'); ?>