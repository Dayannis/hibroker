<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.10
 */


// Socials
if ( shieldgroup_is_on(shieldgroup_get_theme_option('socials_in_footer')) && ($shieldgroup_output = shieldgroup_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php shieldgroup_show_layout($shieldgroup_output); ?>
		</div>
	</div>
	<?php
}
?>