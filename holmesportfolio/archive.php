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

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<button class="back_button_search" onclick="window.history.back()">Back</button>

		<?php if (have_posts()) : ?>
			<header class="archive-page-header">
				<?php
				the_archive_title('<h1 class="center-items">', '</h1>');
				$description = get_the_archive_description();
				if (!empty($description)) {
					echo '<div class="archive_description">' . wp_kses_post($description) . '</div>';
				}
				?>
			</header>

			<div class="posts-grid">
				<?php while (have_posts()) : the_post(); ?>
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
										<?php the_excerpt(); ?>
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
		<?php endwhile; ?>
</div>

<?php else : ?>
	<div class="posts-grid">
		<article class="post-card no-posts-found">
			<header class="entry-header">
				<h2 class="entry-title">No Posts Found</h2>
			</header>
			<div class="entry-summary">
				<p>It looks like there are no posts available here yet. Please check back later!</p>
			</div>
		</article>
	</div>
<?php endif; ?>
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
<?php get_footer(); ?>