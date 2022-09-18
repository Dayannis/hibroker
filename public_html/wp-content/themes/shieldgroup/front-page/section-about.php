<div class="front_page_section front_page_section_about<?php
			$shieldgroup_scheme = shieldgroup_get_theme_option('front_page_about_scheme');
			if (!shieldgroup_is_inherit($shieldgroup_scheme)) echo ' scheme_'.esc_attr($shieldgroup_scheme);
			echo ' front_page_section_paddings_'.esc_attr(shieldgroup_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$shieldgroup_css = '';
		$shieldgroup_bg_image = shieldgroup_get_theme_option('front_page_about_bg_image');
		if (!empty($shieldgroup_bg_image)) 
			$shieldgroup_css .= 'background-image: url('.esc_url(shieldgroup_get_attachment_url($shieldgroup_bg_image)).');';
		if (!empty($shieldgroup_css))
			echo ' style="' . esc_attr($shieldgroup_css) . '"';
?>><?php
	// Add anchor
	$shieldgroup_anchor_icon = shieldgroup_get_theme_option('front_page_about_anchor_icon');	
	$shieldgroup_anchor_text = shieldgroup_get_theme_option('front_page_about_anchor_text');	
	if ((!empty($shieldgroup_anchor_icon) || !empty($shieldgroup_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($shieldgroup_anchor_icon) ? ' icon="'.esc_attr($shieldgroup_anchor_icon).'"' : '')
										. (!empty($shieldgroup_anchor_text) ? ' title="'.esc_attr($shieldgroup_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (shieldgroup_get_theme_option('front_page_about_fullheight'))
				echo ' shieldgroup-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$shieldgroup_css = '';
			$shieldgroup_bg_mask = shieldgroup_get_theme_option('front_page_about_bg_mask');
			$shieldgroup_bg_color = shieldgroup_get_theme_option('front_page_about_bg_color');
			if (!empty($shieldgroup_bg_color) && $shieldgroup_bg_mask > 0)
				$shieldgroup_css .= 'background-color: '.esc_attr($shieldgroup_bg_mask==1
																	? $shieldgroup_bg_color
																	: shieldgroup_hex2rgba($shieldgroup_bg_color, $shieldgroup_bg_mask)
																).';';
			if (!empty($shieldgroup_css))
				echo ' style="' . esc_attr($shieldgroup_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$shieldgroup_caption = shieldgroup_get_theme_option('front_page_about_caption');
			if (!empty($shieldgroup_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($shieldgroup_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($shieldgroup_caption); ?></h2><?php
			}
		
			// Description (text)
			$shieldgroup_description = shieldgroup_get_theme_option('front_page_about_description');
			if (!empty($shieldgroup_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($shieldgroup_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($shieldgroup_description)); ?></div><?php
			}
			
			// Content
			$shieldgroup_content = shieldgroup_get_theme_option('front_page_about_content');
			if (!empty($shieldgroup_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($shieldgroup_content) ? 'filled' : 'empty'; ?>"><?php
					$shieldgroup_page_content_mask = '%%CONTENT%%';
					if (strpos($shieldgroup_content, $shieldgroup_page_content_mask) !== false) {
						$shieldgroup_content = preg_replace(
									'/(\<p\>\s*)?'.$shieldgroup_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$shieldgroup_content
									);
					}
					shieldgroup_show_layout($shieldgroup_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>