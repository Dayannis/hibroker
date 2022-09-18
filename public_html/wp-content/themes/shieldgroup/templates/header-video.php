<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0.14
 */
$shieldgroup_header_video = shieldgroup_get_header_video();
$shieldgroup_embed_video = '';
if (!empty($shieldgroup_header_video) && !shieldgroup_is_from_uploads($shieldgroup_header_video)) {
	if (shieldgroup_is_youtube_url($shieldgroup_header_video) && preg_match('/[=\/]([^=\/]*)$/', $shieldgroup_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$shieldgroup_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($shieldgroup_header_video) . '[/embed]' ));
			$shieldgroup_embed_video = shieldgroup_make_video_autoplay($shieldgroup_embed_video);
		} else {
			$shieldgroup_header_video = str_replace('/watch?v=', '/embed/', $shieldgroup_header_video);
			$shieldgroup_header_video = shieldgroup_add_to_url($shieldgroup_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$shieldgroup_embed_video = '<iframe src="' . esc_url($shieldgroup_header_video) . '" width="1290" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php shieldgroup_show_layout($shieldgroup_embed_video); ?></div><?php
	}
}
?>