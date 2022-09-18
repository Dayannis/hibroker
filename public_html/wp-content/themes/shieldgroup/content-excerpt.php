<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

$shieldgroup_post_format = get_post_format();
$shieldgroup_post_format = empty($shieldgroup_post_format) ? 'standard' : str_replace('post-format-', '', $shieldgroup_post_format);
$shieldgroup_animation = shieldgroup_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($shieldgroup_post_format) ); ?>
	<?php echo (!shieldgroup_is_off($shieldgroup_animation) ? ' data-animation="'.esc_attr(shieldgroup_get_animation_classes($shieldgroup_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	shieldgroup_show_post_featured(array( 'thumb_size' => shieldgroup_get_thumb_size( strpos(shieldgroup_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php

            // Post meta
            $shieldgroup_components = shieldgroup_is_inherit(shieldgroup_get_theme_option_from_meta('meta_parts'))
                ? 'date,author,counters'
                : shieldgroup_array_get_keys_by_value(shieldgroup_get_theme_option('meta_parts'));
            $shieldgroup_counters = shieldgroup_is_inherit(shieldgroup_get_theme_option_from_meta('counters'))
                ? 'comments'
                : shieldgroup_array_get_keys_by_value(shieldgroup_get_theme_option('counters'));

            if (!empty($shieldgroup_components))
                shieldgroup_show_post_meta(apply_filters('shieldgroup_filter_post_meta_args', array(
                        'components' => $shieldgroup_components,
                        'counters' => $shieldgroup_counters,
                        'seo' => false
                    ), 'excerpt', 1)
                );

			do_action('shieldgroup_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('shieldgroup_action_before_post_meta'); 


			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (shieldgroup_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'shieldgroup' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'shieldgroup' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$shieldgroup_show_learn_more = !in_array($shieldgroup_post_format, array('link', 'aside', 'status', 'quote', 'audio'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($shieldgroup_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($shieldgroup_post_format == 'quote') {
					if (($quote = shieldgroup_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						shieldgroup_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $shieldgroup_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'shieldgroup'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>