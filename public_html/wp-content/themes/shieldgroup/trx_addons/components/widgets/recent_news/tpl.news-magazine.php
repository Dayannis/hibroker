<?php
/**
 * The "News Magazine" template to show post's content
 *
 * Used in the widget Recent News.
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */
 
$widget_args = get_query_var('trx_addons_args_recent_news');
$style = $widget_args['style'];
$number = $widget_args['number'];
$count = $widget_args['count'];
$columns = $widget_args['columns'];
$featured = $widget_args['featured'];
$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');

if ($number==$featured+1 && $number > 1 && $featured < $count && $featured!=$columns-1) {
	?><div class="post_delimiter<?php if ($columns > 1) echo ' '.esc_attr(trx_addons_get_column_class(1, 1)); ?>"></div><?php
}
if ($columns > 1 && !($featured==$columns-1 && $number>$featured+1)) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $columns)); ?>"><?php
}
?><article 
	<?php post_class( 'post_item post_layout_'.esc_attr($style)
					.' post_format_'.esc_attr($post_format)
					.' post_accented_'.($number<=$featured ? 'on' : 'off') 
					.($featured == $count && $featured > $columns ? ' post_accented_border' : '')
					); ?>
	<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
	
	trx_addons_get_template_part('templates/tpl.featured.php',
								'trx_addons_args_featured',
								apply_filters('trx_addons_filter_args_featured', array(
												'post_info' => '',
												'thumb_size' => trx_addons_get_thumb_size($number<=$featured ? 'post' : 'posts')
												), 'recent_news-magazine')
								);

	if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
            if ( $number<=$featured && in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
                ?><div class="post_meta"><span class="post_date"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_date(); ?></a></span><?php
                ?><span class="post_author"><?php echo esc_html__('by','shieldgroup').' '; the_author_link(); ?></span><?php
                if (!is_singular() || have_comments() || comments_open()) {
                    $post_comments = get_comments_number();
                    ?>
                    <a href="<?php echo esc_url(get_comments_link()); ?>"
                       class="post_meta_item post_counters_item post_counters_comments"><?php
                        ?><span class="post_counters_number"><?php
                            echo esc_html($post_comments);
                            ?></span><?php
                        ?> <span class="post_counters_label"><?php
                            echo esc_html(_n('Comment', 'Comments', $post_comments, 'shieldgroup'));
                            ?></span>
                    </a>
                    <?php
                }
                ?></div><?php
            }

			the_title( ($number<=$featured ? '<h5' : '<h6').' class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a>'.($number<=$featured ? '</h5>' : '</h6>') );

			if ( $number>$featured && in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
				?><div class="post_meta"><span class="post_date"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_date(); ?></a></span><?php
                if (!is_singular() || have_comments() || comments_open()) {
                    $post_comments = get_comments_number();
                    ?>
                    <a href="<?php echo esc_url(get_comments_link()); ?>"
                       class="post_meta_item post_counters_item post_counters_comments"><?php
                        ?><span class="post_counters_number"><?php
                            echo esc_html($post_comments);
                            ?></span><?php
                        ?> <span class="post_counters_label"><?php
                            echo esc_html(_n('Comment', 'Comments', $post_comments, 'shieldgroup'));
                            ?></span>
                    </a>
                    <?php
                }
                ?></div><?php
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}
?>
</article><?php

if ($columns > 1 && !($featured==$columns-1 && $featured<$number && $number<$count)) {
	?></div><?php
}
?>