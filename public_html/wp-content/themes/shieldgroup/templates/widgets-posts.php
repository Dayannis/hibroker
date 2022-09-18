<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

$shieldgroup_post_id    = get_the_ID();
$shieldgroup_post_date  = shieldgroup_get_date();
$shieldgroup_post_title = get_the_title();
$shieldgroup_post_link  = get_permalink();
$shieldgroup_post_author_id   = get_the_author_meta('ID');
$shieldgroup_post_author_name = get_the_author_meta('display_name');
$shieldgroup_post_author_url  = get_author_posts_url($shieldgroup_post_author_id, '');

$shieldgroup_args = get_query_var('shieldgroup_args_widgets_posts');
$shieldgroup_show_date = isset($shieldgroup_args['show_date']) ? (int) $shieldgroup_args['show_date'] : 1;
$shieldgroup_show_image = isset($shieldgroup_args['show_image']) ? (int) $shieldgroup_args['show_image'] : 1;
$shieldgroup_show_author = isset($shieldgroup_args['show_author']) ? (int) $shieldgroup_args['show_author'] : 1;
$shieldgroup_show_counters = isset($shieldgroup_args['show_counters']) ? (int) $shieldgroup_args['show_counters'] : 1;
$shieldgroup_show_categories = isset($shieldgroup_args['show_categories']) ? (int) $shieldgroup_args['show_categories'] : 1;

$shieldgroup_output = shieldgroup_storage_get('shieldgroup_output_widgets_posts');

$shieldgroup_post_counters_output = '';
if ( $shieldgroup_show_counters ) {
	$shieldgroup_post_counters_output = '<span class="post_info_item post_info_counters">'
								. shieldgroup_get_post_counters('comments')
							. '</span>';
}


$shieldgroup_output .= '<article class="post_item with_thumb">';

if ($shieldgroup_show_image) {
	$shieldgroup_post_thumb = get_the_post_thumbnail($shieldgroup_post_id, shieldgroup_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($shieldgroup_post_thumb) $shieldgroup_output .= '<div class="post_thumb">' . ($shieldgroup_post_link ? '<a href="' . esc_url($shieldgroup_post_link) . '">' : '') . ($shieldgroup_post_thumb) . ($shieldgroup_post_link ? '</a>' : '') . '</div>';
}

$shieldgroup_output .= '<div class="post_content">'
			. ($shieldgroup_show_categories 
					? '<div class="post_categories">'
						. shieldgroup_get_post_categories()
						. $shieldgroup_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($shieldgroup_post_link ? '<a href="' . esc_url($shieldgroup_post_link) . '">' : '') . ($shieldgroup_post_title) . ($shieldgroup_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('shieldgroup_filter_get_post_info', 
								'<div class="post_info">'
									. ($shieldgroup_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($shieldgroup_post_link ? '<a href="' . esc_url($shieldgroup_post_link) . '" class="post_info_date">' : '') 
											. esc_html($shieldgroup_post_date) 
											. ($shieldgroup_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($shieldgroup_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'shieldgroup') . ' ' 
											. ($shieldgroup_post_link ? '<a href="' . esc_url($shieldgroup_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($shieldgroup_post_author_name) 
											. ($shieldgroup_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$shieldgroup_show_categories && $shieldgroup_post_counters_output
										? $shieldgroup_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
shieldgroup_storage_set('shieldgroup_output_widgets_posts', $shieldgroup_output);
?>