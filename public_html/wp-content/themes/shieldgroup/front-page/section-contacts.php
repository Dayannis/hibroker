<div class="front_page_section front_page_section_contacts<?php
			$shieldgroup_scheme = shieldgroup_get_theme_option('front_page_contacts_scheme');
			if (!shieldgroup_is_inherit($shieldgroup_scheme)) echo ' scheme_'.esc_attr($shieldgroup_scheme);
			echo ' front_page_section_paddings_'.esc_attr(shieldgroup_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$shieldgroup_css = '';
		$shieldgroup_bg_image = shieldgroup_get_theme_option('front_page_contacts_bg_image');
		if (!empty($shieldgroup_bg_image)) 
			$shieldgroup_css .= 'background-image: url('.esc_url(shieldgroup_get_attachment_url($shieldgroup_bg_image)).');';
		if (!empty($shieldgroup_css))
			echo ' style="' . esc_attr($shieldgroup_css) . '"';
?>><?php
	// Add anchor
	$shieldgroup_anchor_icon = shieldgroup_get_theme_option('front_page_contacts_anchor_icon');	
	$shieldgroup_anchor_text = shieldgroup_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($shieldgroup_anchor_icon) || !empty($shieldgroup_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($shieldgroup_anchor_icon) ? ' icon="'.esc_attr($shieldgroup_anchor_icon).'"' : '')
										. (!empty($shieldgroup_anchor_text) ? ' title="'.esc_attr($shieldgroup_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (shieldgroup_get_theme_option('front_page_contacts_fullheight'))
				echo ' shieldgroup-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$shieldgroup_css = '';
			$shieldgroup_bg_mask = shieldgroup_get_theme_option('front_page_contacts_bg_mask');
			$shieldgroup_bg_color = shieldgroup_get_theme_option('front_page_contacts_bg_color');
			if (!empty($shieldgroup_bg_color) && $shieldgroup_bg_mask > 0)
				$shieldgroup_css .= 'background-color: '.esc_attr($shieldgroup_bg_mask==1
																	? $shieldgroup_bg_color
																	: shieldgroup_hex2rgba($shieldgroup_bg_color, $shieldgroup_bg_mask)
																).';';
			if (!empty($shieldgroup_css))
				echo ' style="' . esc_attr($shieldgroup_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$shieldgroup_caption = shieldgroup_get_theme_option('front_page_contacts_caption');
			$shieldgroup_description = shieldgroup_get_theme_option('front_page_contacts_description');
			if (!empty($shieldgroup_caption) || !empty($shieldgroup_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($shieldgroup_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($shieldgroup_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($shieldgroup_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($shieldgroup_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($shieldgroup_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($shieldgroup_description));
					?></div><?php
				}
			}

			// Content (text)
			$shieldgroup_content = shieldgroup_get_theme_option('front_page_contacts_content');
			$shieldgroup_layout = shieldgroup_get_theme_option('front_page_contacts_layout');
			if ($shieldgroup_layout == 'columns' && (!empty($shieldgroup_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($shieldgroup_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($shieldgroup_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($shieldgroup_content);
				?></div><?php
			}

			if ($shieldgroup_layout == 'columns' && (!empty($shieldgroup_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$shieldgroup_sc = shieldgroup_get_theme_option('front_page_contacts_shortcode');
			if (!empty($shieldgroup_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($shieldgroup_sc) ? 'filled' : 'empty'; ?>"><?php
					shieldgroup_show_layout(do_shortcode($shieldgroup_sc));
				?></div><?php
			}

			if ($shieldgroup_layout == 'columns' && (!empty($shieldgroup_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>