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


get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<button class="back_button_search" onclick="window.history.back()">Back</button>

		<div class="posts-grid">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post();
			?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
						<a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
							<div class="post-card-inner">
								<header class="entry-header">
									<h2 class="entry-title"><?php echo esc_html(get_the_title()); ?></h2>
								</header>

								<div class="post_content">
									<?php if (has_post_thumbnail()) :
										$alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
									?>
										<div class="post-thumbnail">
											<?php the_post_thumbnail('medium', ['alt' => esc_attr($alt_text)]); ?>
										</div>
									<?php endif; ?>

									<div class="entry-summary">
										<?php
										$excerpt = get_the_excerpt();
										if (!empty($excerpt)) {
											echo wp_kses_post($excerpt);
										} else {
											echo '<p class="hw-read-more">' . sprintf(
												esc_html__('Read more posts about %s', 'holmesportfolio'),
												esc_html(get_the_title())
											) . '</p>';
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
	<?php
				endwhile;
	?>



<?php
			else :
?>
	<p>No results found. Try a different search.</p>
<?php
			endif;
?>
</div>
<div class="pagination-wrapper">
	<?php
	echo wp_kses_post(paginate_links([
		'prev_txt' => __('« Previous', 'holmesportfolio'),
		'next_txt' => __('Next »', 'holmesportfolio'),
	]));
	?>
</div>
</main>
</div>

<?php
get_footer();
