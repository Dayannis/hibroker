<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('shieldgroup_trx_addons_get_mycss')) {
	add_filter('shieldgroup_filter_get_css', 'shieldgroup_trx_addons_get_mycss', 10, 4);
	function shieldgroup_trx_addons_get_mycss($css, $colors, $fonts, $scheme='') {

        if (isset($css['fonts']) && $fonts) {
            $css['fonts'] .= <<<CSS
            .widget .widget_title,
            .sc_testimonials_item_author_title,
            .sc_icons.sc_icons_size_small .sc_icons_item_title,
                        .sc_team_short .sc_team_item_title,
            .format-audio .post_featured .post_audio_title, .trx_addons_audio_player .audio_caption,
            .footer_wrap .widget_title, .footer_wrap .widgettitle,
            blockquote > a, blockquote > p > a,
            blockquote > cite, blockquote > p > cite,
            body .mejs-container * {
                {$fonts['p_font-family']}
            }
            .sc_layouts_row_type_normal a .sc_layouts_item_details_line2,
            .sc_testimonials_item_content,
            .sc_price_item_price_value,
            .vc_message_box,
            .sc_countdown_default .sc_countdown_digits,
            .sc_layouts_row_type_narrow .sc_layouts_item_details_line2,
            .trx_addons_dropcap {
                {$fonts['h1_font-family']}
            }

CSS;
        }

        if (isset($css['colors']) && $colors) {
            $css['colors'] .= <<<CSS
            
            /* Inline colors */
            .trx_addons_accent,
            .trx_addons_accent_big,
            .trx_addons_accent > a,
            .trx_addons_accent > * {
                color: {$colors['text_link']};
            }
            .trx_addons_accent_hovered {
                color: {$colors['text_hover']};
            }
            .trx_addons_accent_bg {
                background-color: {$colors['text_link2']};
                color: {$colors['inverse_link']};
            }

            
            /* Tooltip */
            .trx_addons_tooltip {
                color: {$colors['text_dark']};
                border-color: {$colors['text_dark']};
            }
            .trx_addons_tooltip:before {
                background-color: {$colors['text_link3']};
                color: {$colors['text_link']};
            }
            .trx_addons_tooltip:after {
                border-top-color: {$colors['text_link3']};
            }
            
            
            /* Dropcaps */
            .trx_addons_dropcap_style_1 {
                background: {$colors['text_hover']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_dropcap_style_2 {
                background: {$colors['bg_color_0']};
                color: {$colors['text_dark']};
            }
            
            
            /* Blockqoute */
            blockquote {
                color: {$colors['inverse_link']};
                background: {$colors['text_link2']};
            }
            blockquote > a, blockquote > p > a,
            blockquote > cite, blockquote > p > cite {
                color: {$colors['inverse_link']};
            }
            blockquote > a, blockquote > p > a:hover {
                color: {$colors['text_hover']};
            }
            .sc_testimonials_item_content:before,
            blockquote:before {
                color: {$colors['inverse_link_02']};
            }
            
            /* Images */
            figure figcaption,
            .wp-caption .wp-caption-text,
            .wp-caption .wp-caption-dd,
            .wp-caption-overlay .wp-caption .wp-caption-text,
            .wp-caption-overlay .wp-caption .wp-caption-dd {
                color: {$colors['inverse_link']};
                background-color: {$colors['inverse_dark_05']};
            }
            
            
            /* Lists */
            ul[class*="trx_addons_list"] > li:before{
                color: {$colors['text_hover']};
            }
            ol > li::before {
                color: {$colors['text_dark']};
            }
            
            /* Table */
            table th {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_hover']};
            }
            table th, table th + th, table td + th  {
                border-color: {$colors['inverse_link_05']};
            }
            table td, table th + td, table td + td {
                color: {$colors['text']};
                border-color: {$colors['bd_color']};
            }
            table > tbody > tr:nth-child(2n+1) > td {
                background-color: {$colors['alter_bg_color']};
            }
            table > tbody > tr:nth-child(2n) > td {
                background-color: {$colors['alter_bg_color']};
            }

            /* Main menu */
            .sc_layouts_menu_nav>li>a {
                color: {$colors['text']} !important;
            }
            .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li.current-menu-item>a,
            .sc_layouts_menu_nav>li.current-menu-parent>a,
            .sc_layouts_menu_nav>li.current-menu-ancestor>a {
                color: {$colors['text_link']} !important;
            }
            
            .scheme_dark .sc_layouts_menu_nav>li>a {
                color: {$colors['inverse_link']} !important;
            }
            .scheme_dark .sc_layouts_menu_nav>li>a:hover, 
            .scheme_dark .sc_layouts_menu_nav>li.sfHover>a, 
            .scheme_dark .sc_layouts_menu_nav>li.current-menu-item>a, 
            .scheme_dark .sc_layouts_menu_nav>li.current-menu-parent>a, 
            .scheme_dark .sc_layouts_menu_nav>li.current-menu-ancestor>a {
                color: {$colors['inverse_link_05']} !important;
            }
            
            /* Dropdown menu */
            .sc_layouts_menu_nav>li ul {
                background-color: {$colors['text_link2']};
            }
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a,
            .sc_layouts_menu_nav>li li>a {
                color: {$colors['inverse_link']} !important;
            }
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li li>a:hover,
            .sc_layouts_menu_nav>li li.sfHover>a,
            .sc_layouts_menu_nav>li li.current-menu-item>a,
            .sc_layouts_menu_nav>li li.current-menu-parent>a,
            .sc_layouts_menu_nav>li li.current-menu-ancestor>a {
                color: {$colors['inverse_link']} !important;
                background-color: {$colors['text_hover2']};
            }
            
            
            /* Breadcrumbs */
            .sc_layouts_title_caption {
                color: {$colors['text_dark']};
            }
            .sc_layouts_title_breadcrumbs a {
                color: {$colors['text_dark']} !important;
            }
            .breadcrumbs_item.current{
                color: {$colors['text_hover']} !important;
            }
            .sc_layouts_title_breadcrumbs a:hover {
                color: {$colors['text_hover']} !important;
            }
            
            /* Slider */
            .sc_slider_controls .slider_controls_wrap > a,
            .slider_container.slider_controls_side .slider_controls_wrap > a,
            .slider_outer_controls_side .slider_controls_wrap > a {
                color: {$colors['text_dark']};
                background-color: {$colors['alter_bg_color']};
            }
            .sc_slider_controls .slider_controls_wrap > a:hover,
            .slider_container.slider_controls_side .slider_controls_wrap > a:hover,
            .slider_outer_controls_side .slider_controls_wrap > a:hover {
                 color: {$colors['inverse_link']};
                background-color: {$colors['text_dark']};
            }
            
            
            /* Price */
            .price-header {
                background-color: {$colors['text_hover']};
            }
            .sc_price .trx_addons_columns_wrap > div:last-child .sc_price_item,
            .sc_price_item {
                color: {$colors['text']};
                background-color: {$colors['bg_color']};
                border-color: {$colors['bd_color']};
            }
            .sc_price {
                background-color: {$colors['bg_color']};
            }
            .sc_price_item:hover {
                color: {$colors['text']};
                background-color: {$colors['bg_color']};
                border-color: {$colors['bd_color']};
            }
            .sc_price_item .sc_price_item_icon {
                color: {$colors['text_link']};
            }
            .sc_price_item:hover .sc_price_item_icon {
                color: {$colors['text_hover']};
            }
            .sc_price_item .sc_price_item_label {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            .sc_price_item:hover .sc_price_item_label {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            .sc_price_item .sc_price_item_subtitle {
                color: {$colors['text_dark']};
            }
            .sc_price_item .sc_price_item_title,
            .sc_price_item .sc_price_item_title a {
                color: {$colors['inverse_link']};
            }
            .sc_price_item:hover .sc_price_item_title,
            .sc_price_item:hover .sc_price_item_title a {
                color: {$colors['inverse_link']};
            }
            .sc_price_item .sc_price_item_price {
                color: {$colors['inverse_link']};
            }
            .sc_price_item .sc_price_item_description,
            .sc_price_item .sc_price_item_details {
                color: {$colors['text']};
            }
            .sc_price .trx_addons_columns_wrap > div:nth-child(2n+2),
            .sc_price .trx_addons_columns_wrap > div:nth-child(2n+2) .sc_price_item {
                background: {$colors['alter_bg_hover']};
            }
            .sc_price .trx_addons_columns_wrap > div:nth-child(4n+2) .sc_price_item .price-header {
                background: {$colors['alter_link3']};
            }
            .sc_price .trx_addons_columns_wrap > div:nth-child(4n+3) .sc_price_item .price-header {
                background: {$colors['extra_link2']};
            }
            .sc_price .trx_addons_columns_wrap > div:nth-child(4n+4) .sc_price_item .price-header {
                background: {$colors['text_link2']};
            }
            
            /* Layouts */
            .sc_layouts_logo .logo_text {
                color: {$colors['text_dark']};
            }
            

            /* Shortcodes */
            .sc_skills_pie.sc_skills_compact_off .sc_skills_total {
                color: {$colors['text_dark']};
            }
            .sc_skills_pie.sc_skills_compact_off .sc_skills_item_title {
                color: {$colors['text_dark']};
            }
            .sc_countdown .sc_countdown_label,
            .sc_countdown_default .sc_countdown_digits span {
                color: {$colors['text_dark']};
                background: {$colors['bg_color_0']};
            }
            
            /* Audio */
            .trx_addons_audio_player.without_cover,
            .format-audio .post_featured.without_thumb .post_audio {
                background: {$colors['alter_bg_color']};
            }
            .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
            .mejs-controls .mejs-time-rail .mejs-time-current {
                background: {$colors['text_hover']};
            }
            .mejs-controls .mejs-button {
                background: {$colors['text_link2']};
                color: {$colors['inverse_link']};
            }
            .mejs-controls .mejs-button:hover {
                background: {$colors['text_hover2']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_audio_player .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total:before, .trx_addons_audio_player .mejs-controls .mejs-time-rail .mejs-time-total:before,
            .mejs-controls .mejs-time-rail .mejs-time-total,
            .mejs-controls .mejs-time-rail .mejs-time-loaded,
            .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
                background: {$colors['bg_color']};
            }
            .without_thumb .mejs-controls .mejs-currenttime,
            .without_thumb .mejs-controls .mejs-duration,
            .trx_addons_audio_player.without_cover .audio_author,
            .format-audio .post_featured .post_audio_author,
            .trx_addons_audio_player .mejs-container .mejs-controls .mejs-time {
                color: {$colors['text']};
            }
            
            
            .widget input[type="text"], .widget input[type="number"], .widget input[type="email"], .widget input[type="tel"], .widget input[type="password"], .widget input[type="search"], .widget select, .widget textarea, .widget textarea.wp-editor-area {
                background: {$colors['bg_color']};
            }
            .sc_layouts_row_type_narrow .sc_layouts_login .sc_layouts_item_details_line1,
            .sc_layouts_row_type_narrow .sc_layouts_item_details_line2 {
                color: {$colors['text_link']};
            }
            .sc_layouts_row_type_narrow .sc_layouts_login a:hover .sc_layouts_item_details_line1 {
                color: {$colors['text_hover']};
            }
            .scheme_self.footer_wrap a,
            .scheme_self.footer_wrap .widget li a {
                color: {$colors['text']};
            }
            .scheme_self.footer_wrap a:hover,
            .scheme_self.footer_wrap .widget li a:hover {
                color: {$colors['text_dark']};
            }
            .footer_wrap .socials_wrap .social_item .social_icon,
            .scheme_self.footer_wrap .socials_wrap .social_item .social_icon {
                color: {$colors['text_dark']};
                background-color: {$colors['bd_color']};
            }
            .footer_wrap .socials_wrap .social_item:hover .social_icon,
            .scheme_self.footer_wrap .socials_wrap .social_item:hover .social_icon {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_hover']};
            }
            
            .scheme_dark .sc_button_simple:not(.sc_button_bg_image),
             .scheme_dark .sc_button_simple:not(.sc_button_bg_image):before, 
             .scheme_dark .sc_button_simple:not(.sc_button_bg_image):after {
                color: {$colors['inverse_link']};
            }
            .slider_container .slider_pagination_wrap .swiper-pagination-bullet,
            .slider_outer .slider_pagination_wrap .swiper-pagination-bullet,
            .swiper-pagination-custom .swiper-pagination-button {
                background-color: {$colors['inverse_link_04']};
            }
            .swiper-pagination-custom .swiper-pagination-button.swiper-pagination-button-active,
            .slider_container .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active,
            .slider_outer .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active,
            .slider_container .slider_pagination_wrap .swiper-pagination-bullet:hover,
            .slider_outer .slider_pagination_wrap .swiper-pagination-bullet:hover {
                background-color: {$colors['text_hover']};
            }
            
            /* Socials */
            .socials_wrap .social_item .social_icon {
                background-color: {$colors['alter_bg_color']};
            }
            .socials_wrap .social_item .social_icon,
            .socials_wrap .social_item .social_icon i {
                color: {$colors['text_dark']};
            }
            .socials_wrap .social_item:hover .social_icon {
                background-color: {$colors['text_hover']};
            }
            .socials_wrap .social_item:hover .social_icon,
            .socials_wrap .social_item:hover .social_icon i {
                color: {$colors['inverse_link']};
            }
            .post_item_single .post_content > .post_meta_single .post_share .social_item {
                 color: {$colors['text_dark']};
            }
            .comments_list_wrap .comment_author a {
                color: {$colors['text']};
            }
            .sc_googlemap_content_default .sc_form_title {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_link2']};
            }
            .sc_services_light .sc_services_item_title a,
            .sc_services_light .sc_services_item_icon {
                color: {$colors['text_dark']};
            }
            .sc_services_light .sc_services_item:hover .sc_services_item_icon,
            .sc_services_light .sc_services_item_title a:hover,
            .sc_services_light .sc_services_item_icon:hover {
                color: {$colors['text_link']};
            }
            .sc_testimonials_item_author_subtitle,
            .sc_testimonials_item_author_title {
                color: {$colors['text_dark']};
            }
            
            .sc_services_default .sc_services_item {
                background-color: {$colors['text_hover']};
            }
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(4n+2) .sc_services_item {
                background-color: {$colors['text_hover3']};
            }
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(4n+3) .sc_services_item {
                background-color: {$colors['extra_link2']};
            }
            .sc_services_default .sc_services_columns_wrap > div[class*="trx_addons_column"]:nth-child(4n+4) .sc_services_item {
                background-color: {$colors['text_link2']};
            }
            .sc_services_default .sc_services_item:hover .sc_services_item_icon,
            .sc_services_default .sc_services_item_content,
            .sc_services_default .sc_services_item_title a,
            .sc_services_default .sc_services_item_subtitle a {
                color: {$colors['inverse_link']};
                background: {$colors['bg_color_0']};
            }
            .sc_services_default .sc_services_item_title a:hover,
            .sc_services_default .sc_services_item_subtitle a:hover {
                color: {$colors['inverse_link_07']};
            }
            .sc_services_default .sc_services_item_icon {
                color: {$colors['inverse_link_05']};
            }
            .sc_team_short .trx_addons_hover_content {
                background-color: {$colors['extra_bd_color']};
            }
            .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item .social_icon {
               background-color: {$colors['extra_bg_color']};
               color: {$colors['inverse_link']};
            }
            .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item:hover .social_icon {
               background-color: {$colors['text_hover']};
               color: {$colors['inverse_link']};
            }
            .sc_services_alt .sc_services_item_title a:hover,
            .sc_services_alt .sc_services_item_icon {
                color: {$colors['text_hover']};
            }
            .sc_services_alt .sc_services_item_content,
            .sc_services_alt .sc_services_item_icon:hover {
                color: {$colors['text_dark']};
            }  
            .sc_recent_news.sc_recent_news_with_accented .sc_recent_news_columns_wrap > div + div {
                background-color: {$colors['alter_bg_color']};
            }
            .sc_recent_news .post_item.post_accented_off + .post_item.post_accented_off {
                border-color: {$colors['bd_color']};
            }
            .custom .tp-bullet {
                background-color: {$colors['bg_color_04']};
            }
            .custom .tp-bullet.selected,
            .custom .tp-bullet:hover {
                background-color: {$colors['text_hover']};
            }
            .sc_icons .sc_icons_item_title {
                color: {$colors['text_dark']};
            } 
            .sc_icons_item_description {
                color: {$colors['text_dark_05']};
            }  
            .serv-image .sc_services_item_descr {
               background-color: {$colors['inverse_dark_06']};
               color: {$colors['inverse_link']};
            }
            .sc_icons.sc_align_left.sc_icons_size_small .trx_addons_column-1_2 + .trx_addons_column-1_2:before {
                color: {$colors['alter_light']};
            }
            .header_position_over .top_panel {
                background-color: {$colors['extra_bg_hover_08']} !important;
            }
            .header_position_over .top_panel .sc_layouts_row_fixed_on {
                background-color: {$colors['extra_bg_hover']} !important;
            }
            .sc_layouts_row_type_normal a .sc_layouts_item_details_line2,
            .sc_layouts_item_icon {
                color: {$colors['text_hover']};
            }
            .sc_layouts_row_type_normal a:hover .sc_layouts_item_details_line2,
            .sc_layouts_row_type_normal .sc_layouts_item_details_line1 {
                color: {$colors['text_dark']};
            }
            .scheme_dark.sc_layouts_row_type_compact .sc_layouts_item_icon,
            .scheme_dark.sc_layouts_row_type_compact .sc_layouts_item_details_line1 {
                color: {$colors['inverse_link_06']};
            }
            .scheme_dark.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon,
            .scheme_dark.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_details_line1 {
                color: {$colors['inverse_link']};
            }
            .sc_input_hover_iconed[class*="sc_input_hover_"] input[type="text"], .sc_input_hover_iconed[class*="sc_input_hover_"] input[type="number"], .sc_input_hover_iconed[class*="sc_input_hover_"] input[type="email"], .sc_input_hover_iconed[class*="sc_input_hover_"] input[type="password"], .sc_input_hover_iconed[class*="sc_input_hover_"] input[type="search"], .sc_input_hover_iconed[class*="sc_input_hover_"] textarea {
                background-color: {$colors['bg_color']};
            }
            .mfp-close-btn-in .mfp-close {
                color: {$colors['text_link3']};
            }
            .widget_search input.search-submit:focus,
            .mfp-close-btn-in .mfp-close:hover {
                color: {$colors['text_hover']};
            }
            .team_member_socials .social_item,
            .serv-image a,
            .socials_wrap .social_item {
                color: {$colors['inverse_link']} !important;
            }
           


CSS;
		}

		return $css;
	}
}
?>