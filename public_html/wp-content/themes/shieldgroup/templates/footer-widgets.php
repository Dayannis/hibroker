<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.10
 */

// Footer sidebar
$shieldgroup_footer_name = shieldgroup_get_theme_option('footer_widgets');
$shieldgroup_footer_present = !shieldgroup_is_off($shieldgroup_footer_name) && is_active_sidebar($shieldgroup_footer_name);
if ($shieldgroup_footer_present) { 
	shieldgroup_storage_set('current_sidebar', 'footer');
	$shieldgroup_footer_wide = shieldgroup_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($shieldgroup_footer_name) ) {
		dynamic_sidebar($shieldgroup_footer_name);
	}
	$shieldgroup_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($shieldgroup_out)) {
		$shieldgroup_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $shieldgroup_out);
		$shieldgroup_need_columns = true;	//or check: strpos($shieldgroup_out, 'columns_wrap')===false;
		if ($shieldgroup_need_columns) {
			$shieldgroup_columns = max(0, (int) shieldgroup_get_theme_option('footer_columns'));
			if ($shieldgroup_columns == 0) $shieldgroup_columns = min(4, max(1, substr_count($shieldgroup_out, '<aside ')));
			if ($shieldgroup_columns > 1)
				$shieldgroup_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($shieldgroup_columns).' widget ', $shieldgroup_out);
			else
				$shieldgroup_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($shieldgroup_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$shieldgroup_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($shieldgroup_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'shieldgroup_action_before_sidebar' );
				shieldgroup_show_layout($shieldgroup_out);
				do_action( 'shieldgroup_action_after_sidebar' );
				if ($shieldgroup_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$shieldgroup_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>