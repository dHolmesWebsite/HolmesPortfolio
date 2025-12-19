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
	<a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
		<div class="post-card-inner">

			<header class="entry-header">
				<h2 class="entry-title">Title: <?php echo esc_html(get_the_title()); ?></h2>
				<div class="entry-date">
					<?php esc_html_e('Date posted:', 'holmesportfolio'); ?> <?php echo esc_html(get_the_date()); ?>
				</div>
			</header>

			<div class="post_content">
				<?php
				if (has_post_thumbnail()) :
					$alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
				?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail('medium', ['alt' => esc_attr($alt_text)]); ?>
					</div>
				<?php endif; ?>

				<div class="entry-summary">
					<?php
					if (is_home() || is_archive()) {
						the_excerpt();
					} else {
						the_content();
					}
					?>
				</div>
			</div>
	</a>
	<div class="entry-footer">
		<?php
		$tags = get_the_tags();
		if ($tags) :
		?>
			<div class="entry-tags-wrapper">
				<div class="entry-tags">
					<span><?php esc_html_e('Tags:', 'holmesportfolio'); ?></span>
					<?php
					$tag_links = [];
					foreach ($tags as $tag) {
						$tag_links[] = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
					}
					echo implode(', ', $tag_links);
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>

	</div>
</article>