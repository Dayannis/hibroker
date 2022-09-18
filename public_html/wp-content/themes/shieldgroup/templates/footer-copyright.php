<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.10
 */

// Copyright area
$shieldgroup_footer_scheme =  shieldgroup_is_inherit(shieldgroup_get_theme_option('footer_scheme')) ? shieldgroup_get_theme_option('color_scheme') : shieldgroup_get_theme_option('footer_scheme');
$shieldgroup_copyright_scheme = shieldgroup_is_inherit(shieldgroup_get_theme_option('copyright_scheme')) ? $shieldgroup_footer_scheme : shieldgroup_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($shieldgroup_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$shieldgroup_copyright = shieldgroup_prepare_macros(shieldgroup_get_theme_option('copyright'));
				if (!empty($shieldgroup_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $shieldgroup_copyright, $shieldgroup_matches)) {
						$shieldgroup_copyright = str_replace($shieldgroup_matches[1], date_i18n(str_replace(array('{', '}'), '', $shieldgroup_matches[1])), $shieldgroup_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($shieldgroup_copyright));
				}
			?></div>
		</div>
	</div>
</div>
