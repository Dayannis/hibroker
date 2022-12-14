<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

shieldgroup_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	shieldgroup_show_layout(get_query_var('blog_archive_start'));

	$shieldgroup_classes = 'posts_container '
						. (substr(shieldgroup_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap columns_padding_bottom' : 'masonry_wrap');
	$shieldgroup_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$shieldgroup_sticky_out = shieldgroup_get_theme_option('sticky_style')=='columns' 
							&& is_array($shieldgroup_stickies) && count($shieldgroup_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($shieldgroup_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$shieldgroup_sticky_out) {
		if (shieldgroup_get_theme_option('first_post_large') && !is_paged() && !in_array(shieldgroup_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($shieldgroup_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($shieldgroup_sticky_out && !is_sticky()) {
			$shieldgroup_sticky_out = false;
			?></div><div class="<?php echo esc_attr($shieldgroup_classes); ?>"><?php
		}
		get_template_part( 'content', $shieldgroup_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	shieldgroup_show_pagination();

	shieldgroup_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>