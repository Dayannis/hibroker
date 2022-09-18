<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

$shieldgroup_blog_style = explode('_', shieldgroup_get_theme_option('blog_style'));
$shieldgroup_columns = empty($shieldgroup_blog_style[1]) ? 1 : max(1, $shieldgroup_blog_style[1]);
$shieldgroup_expanded = !shieldgroup_sidebar_present() && shieldgroup_is_on(shieldgroup_get_theme_option('expand_content'));
$shieldgroup_post_format = get_post_format();
$shieldgroup_post_format = empty($shieldgroup_post_format) ? 'standard' : str_replace('post-format-', '', $shieldgroup_post_format);
$shieldgroup_animation = shieldgroup_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($shieldgroup_columns).' post_format_'.esc_attr($shieldgroup_post_format) ); ?>
	<?php echo (!shieldgroup_is_off($shieldgroup_animation) ? ' data-animation="'.esc_attr(shieldgroup_get_animation_classes($shieldgroup_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($shieldgroup_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	shieldgroup_show_post_featured( array(
											'class' => $shieldgroup_columns == 1 ? 'shieldgroup-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => shieldgroup_get_thumb_size(
																	strpos(shieldgroup_get_theme_option('body_style'), 'full')!==false
																		? ( $shieldgroup_columns > 1 ? 'huge' : 'original' )
																		: (	$shieldgroup_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('shieldgroup_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('shieldgroup_action_before_post_meta'); 

			// Post meta
			$shieldgroup_components = shieldgroup_is_inherit(shieldgroup_get_theme_option_from_meta('meta_parts')) 
										? 'date'.($shieldgroup_columns < 3 ? ',counters' : '')
										: shieldgroup_array_get_keys_by_value(shieldgroup_get_theme_option('meta_parts'));
			$shieldgroup_counters = shieldgroup_is_inherit(shieldgroup_get_theme_option_from_meta('counters')) 
										? 'comments'
										: shieldgroup_array_get_keys_by_value(shieldgroup_get_theme_option('counters'));
			$shieldgroup_post_meta = empty($shieldgroup_components) 
										? '' 
										: shieldgroup_show_post_meta(apply_filters('shieldgroup_filter_post_meta_args', array(
												'components' => $shieldgroup_components,
												'counters' => $shieldgroup_counters,
												'seo' => false,
												'echo' => false
												), $shieldgroup_blog_style[0], $shieldgroup_columns)
											);
			shieldgroup_show_layout($shieldgroup_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$shieldgroup_show_learn_more = !in_array($shieldgroup_post_format, array('link', 'aside', 'status', 'quote'));
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
				?>
			</div>
			<?php
			// Post meta
			if (in_array($shieldgroup_post_format, array('link', 'aside', 'status', 'quote'))) {
				shieldgroup_show_layout($shieldgroup_post_meta);
			}
			// More button
			if ( $shieldgroup_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'shieldgroup'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>