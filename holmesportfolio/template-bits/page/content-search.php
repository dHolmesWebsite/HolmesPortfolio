<?php

/**
 * Theme Name: holmesportfolio
 * Theme URI: https://portfolio.holmeswebsite.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://portfolio.holmeswebsite.co.uk/
 * Requires PHP: 7
 * Tested up to: 6.5
 * Version: 4.3
 * License: holmesportfolio Commercial License
 * License URI: https://portfolio.holmeswebsite.co.uk//hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
	<a href="<?php echo esc_url(get_the_permalink()); ?>" aria-label="Read more about <?php echo esc_attr(get_the_title()); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<?php
				$alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				the_post_thumbnail('medium', array('alt' => esc_attr($alt_text)));
				?>
			</div>
		<?php endif; ?>

		<header class="entry-header">
			<h2 class="entry-title">
				<?php the_title(); ?>
			</h2>
		</header>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</a>

	<div class="entry-footer">
		<?php if (has_tag()) : ?>
			<div class="entry-tags">
				<span><?php esc_html_e('Tags:', 'holmesportfolio'); ?></span>
				<?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?>
			</div>
		<?php endif; ?>
	</div>
</article>