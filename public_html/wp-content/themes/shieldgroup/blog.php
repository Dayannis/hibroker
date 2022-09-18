<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$shieldgroup_content = '';
$shieldgroup_blog_archive_mask = '%%CONTENT%%';
$shieldgroup_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $shieldgroup_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($shieldgroup_content = apply_filters('the_content', get_the_content())) != '') {
		if (($shieldgroup_pos = strpos($shieldgroup_content, $shieldgroup_blog_archive_mask)) !== false) {
			$shieldgroup_content = preg_replace('/(\<p\>\s*)?'.$shieldgroup_blog_archive_mask.'(\s*\<\/p\>)/i', $shieldgroup_blog_archive_subst, $shieldgroup_content);
		} else
			$shieldgroup_content .= $shieldgroup_blog_archive_subst;
		$shieldgroup_content = explode($shieldgroup_blog_archive_mask, $shieldgroup_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) shieldgroup_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$shieldgroup_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$shieldgroup_args = shieldgroup_query_add_posts_and_cats($shieldgroup_args, '', shieldgroup_get_theme_option('post_type'), shieldgroup_get_theme_option('parent_cat'));
$shieldgroup_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($shieldgroup_page_number > 1) {
	$shieldgroup_args['paged'] = $shieldgroup_page_number;
	$shieldgroup_args['ignore_sticky_posts'] = true;
}
$shieldgroup_ppp = shieldgroup_get_theme_option('posts_per_page');
if ((int) $shieldgroup_ppp != 0)
	$shieldgroup_args['posts_per_page'] = (int) $shieldgroup_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($shieldgroup_args);


// Add internal query vars in the new query!
if (is_array($shieldgroup_content) && count($shieldgroup_content) == 2) {
	set_query_var('blog_archive_start', $shieldgroup_content[0]);
	set_query_var('blog_archive_end', $shieldgroup_content[1]);
}

get_template_part('index');
?>