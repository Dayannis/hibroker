<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

$shieldgroup_blog_style = explode('_', shieldgroup_get_theme_option('blog_style'));
$shieldgroup_columns = empty($shieldgroup_blog_style[1]) ? 2 : max(2, $shieldgroup_blog_style[1]);
$shieldgroup_post_format = get_post_format();
$shieldgroup_post_format = empty($shieldgroup_post_format) ? 'standard' : str_replace('post-format-', '', $shieldgroup_post_format);
$shieldgroup_animation = shieldgroup_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($shieldgroup_columns).' post_format_'.esc_attr($shieldgroup_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!shieldgroup_is_off($shieldgroup_animation) ? ' data-animation="'.esc_attr(shieldgroup_get_animation_classes($shieldgroup_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$shieldgroup_image_hover = shieldgroup_get_theme_option('image_hover');
	// Featured image
	shieldgroup_show_post_featured(array(
		'thumb_size' => shieldgroup_get_thumb_size(strpos(shieldgroup_get_theme_option('body_style'), 'full')!==false || $shieldgroup_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $shieldgroup_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $shieldgroup_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>