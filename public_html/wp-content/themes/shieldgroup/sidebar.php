<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

if (shieldgroup_sidebar_present()) {
	ob_start();
	$shieldgroup_sidebar_name = shieldgroup_get_theme_option('sidebar_widgets');
	shieldgroup_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($shieldgroup_sidebar_name) ) {
		dynamic_sidebar($shieldgroup_sidebar_name);
	}
	$shieldgroup_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($shieldgroup_out)) {
		$shieldgroup_sidebar_position = shieldgroup_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($shieldgroup_sidebar_position); ?> widget_area<?php if (!shieldgroup_is_inherit(shieldgroup_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(shieldgroup_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'shieldgroup_action_before_sidebar' );
				shieldgroup_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $shieldgroup_out));
				do_action( 'shieldgroup_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>