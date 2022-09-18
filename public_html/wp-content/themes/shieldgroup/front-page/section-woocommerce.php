<div class="front_page_section front_page_section_woocommerce<?php
			$shieldgroup_scheme = shieldgroup_get_theme_option('front_page_woocommerce_scheme');
			if (!shieldgroup_is_inherit($shieldgroup_scheme)) echo ' scheme_'.esc_attr($shieldgroup_scheme);
			echo ' front_page_section_paddings_'.esc_attr(shieldgroup_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$shieldgroup_css = '';
		$shieldgroup_bg_image = shieldgroup_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($shieldgroup_bg_image)) 
			$shieldgroup_css .= 'background-image: url('.esc_url(shieldgroup_get_attachment_url($shieldgroup_bg_image)).');';
		if (!empty($shieldgroup_css))
			echo ' style="' . esc_attr($shieldgroup_css) . '"';
?>><?php
	// Add anchor
	$shieldgroup_anchor_icon = shieldgroup_get_theme_option('front_page_woocommerce_anchor_icon');	
	$shieldgroup_anchor_text = shieldgroup_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($shieldgroup_anchor_icon) || !empty($shieldgroup_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($shieldgroup_anchor_icon) ? ' icon="'.esc_attr($shieldgroup_anchor_icon).'"' : '')
										. (!empty($shieldgroup_anchor_text) ? ' title="'.esc_attr($shieldgroup_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (shieldgroup_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' shieldgroup-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$shieldgroup_css = '';
			$shieldgroup_bg_mask = shieldgroup_get_theme_option('front_page_woocommerce_bg_mask');
			$shieldgroup_bg_color = shieldgroup_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($shieldgroup_bg_color) && $shieldgroup_bg_mask > 0)
				$shieldgroup_css .= 'background-color: '.esc_attr($shieldgroup_bg_mask==1
																	? $shieldgroup_bg_color
																	: shieldgroup_hex2rgba($shieldgroup_bg_color, $shieldgroup_bg_mask)
																).';';
			if (!empty($shieldgroup_css))
				echo ' style="' . esc_attr($shieldgroup_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$shieldgroup_caption = shieldgroup_get_theme_option('front_page_woocommerce_caption');
			$shieldgroup_description = shieldgroup_get_theme_option('front_page_woocommerce_description');
			if (!empty($shieldgroup_caption) || !empty($shieldgroup_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($shieldgroup_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($shieldgroup_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($shieldgroup_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($shieldgroup_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($shieldgroup_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($shieldgroup_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$shieldgroup_woocommerce_sc = shieldgroup_get_theme_option('front_page_woocommerce_products');
				if ($shieldgroup_woocommerce_sc == 'products') {
					$shieldgroup_woocommerce_sc_ids = shieldgroup_get_theme_option('front_page_woocommerce_products_per_page');
					$shieldgroup_woocommerce_sc_per_page = count(explode(',', $shieldgroup_woocommerce_sc_ids));
				} else {
					$shieldgroup_woocommerce_sc_per_page = max(1, (int) shieldgroup_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$shieldgroup_woocommerce_sc_columns = max(1, min($shieldgroup_woocommerce_sc_per_page, (int) shieldgroup_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$shieldgroup_woocommerce_sc}"
									. ($shieldgroup_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($shieldgroup_woocommerce_sc_ids).'"' 
											: '')
									. ($shieldgroup_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(shieldgroup_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($shieldgroup_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(shieldgroup_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(shieldgroup_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($shieldgroup_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($shieldgroup_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>