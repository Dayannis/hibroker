<?php
/**
 * The Gallery template to display posts
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
$shieldgroup_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($shieldgroup_columns).' post_format_'.esc_attr($shieldgroup_post_format) ); ?>
	<?php echo (!shieldgroup_is_off($shieldgroup_animation) ? ' data-animation="'.esc_attr(shieldgroup_get_animation_classes($shieldgroup_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($shieldgroup_image[1]) && !empty($shieldgroup_image[2])) echo intval($shieldgroup_image[1]) .'x' . intval($shieldgroup_image[2]); ?>"
	data-src="<?php if (!empty($shieldgroup_image[0])) echo esc_url($shieldgroup_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$shieldgroup_image_hover = 'icon';	//shieldgroup_get_theme_option('image_hover');
	if (in_array($shieldgroup_image_hover, array('icons', 'zoom'))) $shieldgroup_image_hover = 'dots';
	$shieldgroup_components = shieldgroup_is_inherit(shieldgroup_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: shieldgroup_array_get_keys_by_value(shieldgroup_get_theme_option('meta_parts'));
	$shieldgroup_counters = shieldgroup_is_inherit(shieldgroup_get_theme_option_from_meta('counters')) 
								? 'comments'
								: shieldgroup_array_get_keys_by_value(shieldgroup_get_theme_option('counters'));
	shieldgroup_show_post_featured(array(
		'hover' => $shieldgroup_image_hover,
		'thumb_size' => shieldgroup_get_thumb_size( strpos(shieldgroup_get_theme_option('body_style'), 'full')!==false || $shieldgroup_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($shieldgroup_components)
										? shieldgroup_show_post_meta(apply_filters('shieldgroup_filter_post_meta_args', array(
											'components' => $shieldgroup_components,
											'counters' => $shieldgroup_counters,
											'seo' => false,
											'echo' => false
											), $shieldgroup_blog_style[0], $shieldgroup_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'shieldgroup') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>