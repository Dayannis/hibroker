<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

$shieldgroup_args = get_query_var('shieldgroup_logo_args');

// Site logo
$shieldgroup_logo_type   = isset($shieldgroup_args['type']) ? $shieldgroup_args['type'] : '';
$shieldgroup_logo_image  = shieldgroup_get_logo_image($shieldgroup_logo_type);
$shieldgroup_logo_text   = shieldgroup_is_on(shieldgroup_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$shieldgroup_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($shieldgroup_logo_image) || !empty($shieldgroup_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($shieldgroup_logo_image)) {
			if (empty($shieldgroup_logo_type) && function_exists('the_custom_logo') && (int) $shieldgroup_logo_image > 0) {
				the_custom_logo();
			} else {
				$shieldgroup_attr = shieldgroup_getimagesize($shieldgroup_logo_image);
				echo '<img src="'.esc_url($shieldgroup_logo_image).'" alt="'.esc_html(basename($shieldgroup_logo_image)).'"'.(!empty($shieldgroup_attr[3]) ? ' '.wp_kses_data($shieldgroup_attr[3]) : '').'>';
			}
		} else {
			shieldgroup_show_layout(shieldgroup_prepare_macros($shieldgroup_logo_text), '<span class="logo_text">', '</span>');
			shieldgroup_show_layout(shieldgroup_prepare_macros($shieldgroup_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>