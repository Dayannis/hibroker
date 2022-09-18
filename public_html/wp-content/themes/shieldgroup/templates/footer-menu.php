<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.10
 */

// Footer menu
$shieldgroup_menu_footer = shieldgroup_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($shieldgroup_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php shieldgroup_show_layout($shieldgroup_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>