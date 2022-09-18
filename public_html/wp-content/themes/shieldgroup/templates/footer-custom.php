<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.10
 */

$shieldgroup_footer_scheme =  shieldgroup_is_inherit(shieldgroup_get_theme_option('footer_scheme')) ? shieldgroup_get_theme_option('color_scheme') : shieldgroup_get_theme_option('footer_scheme');
$shieldgroup_footer_id = str_replace('footer-custom-', '', shieldgroup_get_theme_option("footer_style"));
if ((int) $shieldgroup_footer_id == 0) {
	$shieldgroup_footer_id = shieldgroup_get_post_id(array(
												'name' => $shieldgroup_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$shieldgroup_footer_id = apply_filters('shieldgroup_filter_get_translated_layout', $shieldgroup_footer_id);
}
$shieldgroup_footer_meta = get_post_meta($shieldgroup_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($shieldgroup_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($shieldgroup_footer_id))); 
						if (!empty($shieldgroup_footer_meta['margin']) != '') 
							echo ' '.esc_attr(shieldgroup_add_inline_css_class('margin-top: '.shieldgroup_prepare_css_value($shieldgroup_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($shieldgroup_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('shieldgroup_action_show_layout', $shieldgroup_footer_id);
	?>
</footer><!-- /.footer_wrap -->
