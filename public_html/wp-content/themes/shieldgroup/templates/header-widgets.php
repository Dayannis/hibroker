<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

// Header sidebar
$shieldgroup_header_name = shieldgroup_get_theme_option('header_widgets');
$shieldgroup_header_present = !shieldgroup_is_off($shieldgroup_header_name) && is_active_sidebar($shieldgroup_header_name);
if ($shieldgroup_header_present) { 
	shieldgroup_storage_set('current_sidebar', 'header');
	$shieldgroup_header_wide = shieldgroup_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($shieldgroup_header_name) ) {
		dynamic_sidebar($shieldgroup_header_name);
	}
	$shieldgroup_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($shieldgroup_widgets_output)) {
		$shieldgroup_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $shieldgroup_widgets_output);
		$shieldgroup_need_columns = strpos($shieldgroup_widgets_output, 'columns_wrap')===false;
		if ($shieldgroup_need_columns) {
			$shieldgroup_columns = max(0, (int) shieldgroup_get_theme_option('header_columns'));
			if ($shieldgroup_columns == 0) $shieldgroup_columns = min(6, max(1, substr_count($shieldgroup_widgets_output, '<aside ')));
			if ($shieldgroup_columns > 1)
				$shieldgroup_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($shieldgroup_columns).' widget ', $shieldgroup_widgets_output);
			else
				$shieldgroup_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($shieldgroup_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$shieldgroup_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($shieldgroup_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'shieldgroup_action_before_sidebar' );
				shieldgroup_show_layout($shieldgroup_widgets_output);
				do_action( 'shieldgroup_action_after_sidebar' );
				if ($shieldgroup_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$shieldgroup_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>