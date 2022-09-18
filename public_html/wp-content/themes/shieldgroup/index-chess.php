<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

shieldgroup_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	shieldgroup_show_layout(get_query_var('blog_archive_start'));

	$shieldgroup_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$shieldgroup_sticky_out = shieldgroup_get_theme_option('sticky_style')=='columns' 
							&& is_array($shieldgroup_stickies) && count($shieldgroup_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($shieldgroup_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$shieldgroup_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($shieldgroup_sticky_out && !is_sticky()) {
			$shieldgroup_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $shieldgroup_sticky_out && is_sticky() ? 'sticky' :'chess' );
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