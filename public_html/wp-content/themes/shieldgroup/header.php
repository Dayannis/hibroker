<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(shieldgroup_get_theme_option('color_scheme'));
										 ?>">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'shieldgroup_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php
			
			// Desktop header
			$shieldgroup_header_type = shieldgroup_get_theme_option("header_type");
			if ($shieldgroup_header_type == 'custom' && !shieldgroup_is_layouts_available())
				$shieldgroup_header_type = 'default';
			get_template_part( "templates/header-{$shieldgroup_header_type}");

			// Side menu
			if (in_array(shieldgroup_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap">

				<?php if (shieldgroup_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					shieldgroup_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						shieldgroup_create_widgets_area('widgets_above_content');
						?>				
