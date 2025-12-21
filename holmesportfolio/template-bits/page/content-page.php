<?php

/**
 * Theme Name: holmesportfolio
 * Theme URI: https://holmesportfolio.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://holmesportfolio.co.uk/
 * Requires PHP: 7
 * Tested up to: 6.5
 * Version: 4.3
 * License: holmesportfolio Commercial License
 * License URI: https://holmesportfolio.co.uk/hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	</header>

	<?php if (has_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<?php
			$alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
			the_post_thumbnail('medium', array('alt' => esc_attr($alt_text)));
			?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'holmesportfolio'),
			'after'  => '</div>',
		));
		?>
	</div>

	<?php if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						__('Edit <span class="screen-reader-text">%s</span>', 'holmesportfolio'),
						array('span' => array('class' => array()))
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article>