<div class="front_page_section front_page_section_team<?php
			$shieldgroup_scheme = shieldgroup_get_theme_option('front_page_team_scheme');
			if (!shieldgroup_is_inherit($shieldgroup_scheme)) echo ' scheme_'.esc_attr($shieldgroup_scheme);
			echo ' front_page_section_paddings_'.esc_attr(shieldgroup_get_theme_option('front_page_team_paddings'));
		?>"<?php
		$shieldgroup_css = '';
		$shieldgroup_bg_image = shieldgroup_get_theme_option('front_page_team_bg_image');
		if (!empty($shieldgroup_bg_image)) 
			$shieldgroup_css .= 'background-image: url('.esc_url(shieldgroup_get_attachment_url($shieldgroup_bg_image)).');';
		if (!empty($shieldgroup_css))
			echo ' style="' . esc_attr($shieldgroup_css) . '"';
?>><?php
	// Add anchor
	$shieldgroup_anchor_icon = shieldgroup_get_theme_option('front_page_team_anchor_icon');	
	$shieldgroup_anchor_text = shieldgroup_get_theme_option('front_page_team_anchor_text');	
	if ((!empty($shieldgroup_anchor_icon) || !empty($shieldgroup_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_team"'
										. (!empty($shieldgroup_anchor_icon) ? ' icon="'.esc_attr($shieldgroup_anchor_icon).'"' : '')
										. (!empty($shieldgroup_anchor_text) ? ' title="'.esc_attr($shieldgroup_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_team_inner<?php
			if (shieldgroup_get_theme_option('front_page_team_fullheight'))
				echo ' shieldgroup-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$shieldgroup_css = '';
			$shieldgroup_bg_mask = shieldgroup_get_theme_option('front_page_team_bg_mask');
			$shieldgroup_bg_color = shieldgroup_get_theme_option('front_page_team_bg_color');
			if (!empty($shieldgroup_bg_color) && $shieldgroup_bg_mask > 0)
				$shieldgroup_css .= 'background-color: '.esc_attr($shieldgroup_bg_mask==1
																	? $shieldgroup_bg_color
																	: shieldgroup_hex2rgba($shieldgroup_bg_color, $shieldgroup_bg_mask)
																).';';
			if (!empty($shieldgroup_css))
				echo ' style="' . esc_attr($shieldgroup_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_team_content_wrap content_wrap">
			<?php
			// Caption
			$shieldgroup_caption = shieldgroup_get_theme_option('front_page_team_caption');
			if (!empty($shieldgroup_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_team_caption front_page_block_<?php echo !empty($shieldgroup_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($shieldgroup_caption); ?></h2><?php
			}
		
			// Description (text)
			$shieldgroup_description = shieldgroup_get_theme_option('front_page_team_description');
			if (!empty($shieldgroup_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_team_description front_page_block_<?php echo !empty($shieldgroup_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($shieldgroup_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_team_output"><?php 
				if (is_active_sidebar('front_page_team_widgets')) {
					dynamic_sidebar( 'front_page_team_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!shieldgroup_exists_trx_addons())
						shieldgroup_customizer_need_trx_addons_message();
					else
						shieldgroup_customizer_need_widgets_message('front_page_team_caption', 'ThemeREX Addons - Team');
				}
			?></div>
		</div>
	</div>
</div>