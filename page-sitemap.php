<?php 
/* 
 * Template Name: Site Map
*/

get_header('full'); ?>

<div class="wrap">    
    <div id="full-page">
        <div class="box-content post">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
			
			
            
            <div class="page-entry">
            	 
				 <div id="searchform-right">
				 <?php get_search_form( $echo ); ?> 
                 </div>
                 
                 <div class="clearfix"></div>
                
				<?php the_content(); ?>
                
                
                
                
<?php /*$args = array(
	'depth'        => 0,
	'show_date'    => '',
	'date_format'  => get_option('date_format'),
	'child_of'     => 0,
	'exclude'      => '',
	'include'      => '',
	'title_li'     => __(''),
	'echo'         => 1,
	'authors'      => '',
	'sort_column'  => 'menu_order, post_title',
	'link_before'  => '',
	'link_after'   => '',
	'walker'       => '',
	'post_type'    => 'page',
        'post_status'  => 'publish' 
);*/ ?>

<?php // wp_list_pages( $args ); ?>

<div class="sitemap-col">
<h3>Activities</h3>
<?php wp_list_pages('child_of=27 &sort_column=post_title&title_li=') ?>
</div>

<div class="sitemap-col">
<h3>About Us</h3>
<?php wp_list_pages('child_of=2&sort_column=post_title&title_li=') ?>
</div>

<div class="sitemap-col">
<h3>Programs</h3>
<?php wp_list_pages('child_of=64&sort_column=post_title&title_li=') ?>
</div>

<div class="sitemap-col">
<h3>Events</h3>
<?php wp_list_pages('child_of=2&sort_column=post_title&title_li=') ?>
</div>

<div class="sitemap-col">
<h3>Plan A Visit</h3>
<?php wp_list_pages('child_of=58&sort_column=post_title&title_li=') ?>
</div>

<div class="sitemap-col">
<h3>Groups</h3>
<?php wp_list_pages('child_of=255&sort_column=post_title&title_li=') ?>
</div>
                
                
                
             
            </div><!-- #page-entry -->
                
            <?php endwhile; endif; ?>
        </div>
        
      
	</div><!-- #page -->
    
</div><!-- #wrap -->
<?php get_footer('full'); ?>