<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage SHIELDGROUP
 * @since SHIELDGROUP 1.0
 */

// Page (category, tag, archive, author) title

if ( shieldgroup_need_page_title() ) {
	shieldgroup_sc_layouts_showed('title', true);
	shieldgroup_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$shieldgroup_blog_title = shieldgroup_get_blog_title();
							$shieldgroup_blog_title_text = $shieldgroup_blog_title_class = $shieldgroup_blog_title_link = $shieldgroup_blog_title_link_text = '';
							if (is_array($shieldgroup_blog_title)) {
								$shieldgroup_blog_title_text = $shieldgroup_blog_title['text'];
								$shieldgroup_blog_title_class = !empty($shieldgroup_blog_title['class']) ? ' '.$shieldgroup_blog_title['class'] : '';
								$shieldgroup_blog_title_link = !empty($shieldgroup_blog_title['link']) ? $shieldgroup_blog_title['link'] : '';
								$shieldgroup_blog_title_link_text = !empty($shieldgroup_blog_title['link_text']) ? $shieldgroup_blog_title['link_text'] : '';
							} else
								$shieldgroup_blog_title_text = $shieldgroup_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($shieldgroup_blog_title_class); ?>"><?php
								$shieldgroup_top_icon = shieldgroup_get_category_icon();
								if (!empty($shieldgroup_top_icon)) {
									$shieldgroup_attr = shieldgroup_getimagesize($shieldgroup_top_icon);
									?><img src="<?php echo esc_url($shieldgroup_top_icon); ?>" alt="<?php echo esc_html(basename($shieldgroup_top_icon)); ?>" <?php if (!empty($shieldgroup_attr[3])) shieldgroup_show_layout($shieldgroup_attr[3]);?>><?php
								}
								echo wp_kses_data($shieldgroup_blog_title_text);
							?></h1>
							<?php
							if (!empty($shieldgroup_blog_title_link) && !empty($shieldgroup_blog_title_link_text)) {
								?><a href="<?php echo esc_url($shieldgroup_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($shieldgroup_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'shieldgroup_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>