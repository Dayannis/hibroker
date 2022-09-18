<?php
/**
 * The template for homepage posts with "Portfolio" style
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
	
	// Show filters
	$shieldgroup_cat = shieldgroup_get_theme_option('parent_cat');
	$shieldgroup_post_type = shieldgroup_get_theme_option('post_type');
	$shieldgroup_taxonomy = shieldgroup_get_post_type_taxonomy($shieldgroup_post_type);
	$shieldgroup_show_filters = shieldgroup_get_theme_option('show_filters');
	$shieldgroup_tabs = array();
	if (!shieldgroup_is_off($shieldgroup_show_filters)) {
		$shieldgroup_args = array(
			'type'			=> $shieldgroup_post_type,
			'child_of'		=> $shieldgroup_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $shieldgroup_taxonomy,
			'pad_counts'	=> false
		);
		$shieldgroup_portfolio_list = get_terms($shieldgroup_args);
		if (is_array($shieldgroup_portfolio_list) && count($shieldgroup_portfolio_list) > 0) {
			$shieldgroup_tabs[$shieldgroup_cat] = esc_html__('All', 'shieldgroup');
			foreach ($shieldgroup_portfolio_list as $shieldgroup_term) {
				if (isset($shieldgroup_term->term_id)) $shieldgroup_tabs[$shieldgroup_term->term_id] = $shieldgroup_term->name;
			}
		}
	}
	if (count($shieldgroup_tabs) > 0) {
		$shieldgroup_portfolio_filters_ajax = true;
		$shieldgroup_portfolio_filters_active = $shieldgroup_cat;
		$shieldgroup_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters shieldgroup_tabs shieldgroup_tabs_ajax">
			<ul class="portfolio_titles shieldgroup_tabs_titles">
				<?php
				foreach ($shieldgroup_tabs as $shieldgroup_id=>$shieldgroup_title) {
					?><li><a href="<?php echo esc_url(shieldgroup_get_hash_link(sprintf('#%s_%s_content', $shieldgroup_portfolio_filters_id, $shieldgroup_id))); ?>" data-tab="<?php echo esc_attr($shieldgroup_id); ?>"><?php echo esc_html($shieldgroup_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$shieldgroup_ppp = shieldgroup_get_theme_option('posts_per_page');
			if (shieldgroup_is_inherit($shieldgroup_ppp)) $shieldgroup_ppp = '';
			foreach ($shieldgroup_tabs as $shieldgroup_id=>$shieldgroup_title) {
				$shieldgroup_portfolio_need_content = $shieldgroup_id==$shieldgroup_portfolio_filters_active || !$shieldgroup_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $shieldgroup_portfolio_filters_id, $shieldgroup_id)); ?>"
					class="portfolio_content shieldgroup_tabs_content"
					data-blog-template="<?php echo esc_attr(shieldgroup_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(shieldgroup_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($shieldgroup_ppp); ?>"
					data-post-type="<?php echo esc_attr($shieldgroup_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($shieldgroup_taxonomy); ?>"
					data-cat="<?php echo esc_attr($shieldgroup_id); ?>"
					data-parent-cat="<?php echo esc_attr($shieldgroup_cat); ?>"
					data-need-content="<?php echo (false===$shieldgroup_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($shieldgroup_portfolio_need_content) 
						shieldgroup_show_portfolio_posts(array(
							'cat' => $shieldgroup_id,
							'parent_cat' => $shieldgroup_cat,
							'taxonomy' => $shieldgroup_taxonomy,
							'post_type' => $shieldgroup_post_type,
							'page' => 1,
							'sticky' => $shieldgroup_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		shieldgroup_show_portfolio_posts(array(
			'cat' => $shieldgroup_cat,
			'parent_cat' => $shieldgroup_cat,
			'taxonomy' => $shieldgroup_taxonomy,
			'post_type' => $shieldgroup_post_type,
			'page' => 1,
			'sticky' => $shieldgroup_sticky_out
			)
		);
	}

	shieldgroup_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>