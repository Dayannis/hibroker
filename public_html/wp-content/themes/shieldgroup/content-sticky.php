<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

$shieldgroup_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$shieldgroup_post_format = get_post_format();
$shieldgroup_post_format = empty($shieldgroup_post_format) ? 'standard' : str_replace('post-format-', '', $shieldgroup_post_format);
$shieldgroup_animation = shieldgroup_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($shieldgroup_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($shieldgroup_post_format) ); ?>
	<?php echo (!shieldgroup_is_off($shieldgroup_animation) ? ' data-animation="'.esc_attr(shieldgroup_get_animation_classes($shieldgroup_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	shieldgroup_show_post_featured(array(
		'thumb_size' => shieldgroup_get_thumb_size($shieldgroup_columns==1 ? 'big' : ($shieldgroup_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($shieldgroup_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			shieldgroup_show_post_meta(apply_filters('shieldgroup_filter_post_meta_args', array(), 'sticky', $shieldgroup_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>