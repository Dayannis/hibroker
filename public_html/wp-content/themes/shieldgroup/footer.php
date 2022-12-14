<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

						// Widgets area inside page content
						shieldgroup_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					shieldgroup_create_widgets_area('widgets_below_page');

					$shieldgroup_body_style = shieldgroup_get_theme_option('body_style');
					if ($shieldgroup_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$shieldgroup_footer_type = shieldgroup_get_theme_option("footer_type");
			if ($shieldgroup_footer_type == 'custom' && !shieldgroup_is_layouts_available())
				$shieldgroup_footer_type = 'default';
			get_template_part( "templates/footer-{$shieldgroup_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (shieldgroup_is_on(shieldgroup_get_theme_option('debug_mode')) && shieldgroup_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(shieldgroup_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>