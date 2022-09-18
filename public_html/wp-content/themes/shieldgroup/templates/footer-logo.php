<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.10
 */

// Logo
if (shieldgroup_is_on(shieldgroup_get_theme_option('logo_in_footer'))) {
	$shieldgroup_logo_image = '';
	if (shieldgroup_is_on(shieldgroup_get_theme_option('logo_retina_enabled')) && shieldgroup_get_retina_multiplier(2) > 1)
		$shieldgroup_logo_image = shieldgroup_get_theme_option( 'logo_footer_retina' );
	if (empty($shieldgroup_logo_image)) 
		$shieldgroup_logo_image = shieldgroup_get_theme_option( 'logo_footer' );
	$shieldgroup_logo_text   = get_bloginfo( 'name' );
	if (!empty($shieldgroup_logo_image) || !empty($shieldgroup_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($shieldgroup_logo_image)) {
					$shieldgroup_attr = shieldgroup_getimagesize($shieldgroup_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($shieldgroup_logo_image).'" class="logo_footer_image" alt="'.esc_html(basename($shieldgroup_logo_image)).'"'.(!empty($shieldgroup_attr[3]) ? ' ' . wp_kses_data($shieldgroup_attr[3]) : '').'></a>' ;
				} else if (!empty($shieldgroup_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($shieldgroup_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>