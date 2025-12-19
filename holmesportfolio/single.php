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

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php holmes_breadcrumbs(); ?>

		<?php
		while (have_posts()) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<button class="back_button" onclick="window.history.back()">Back</button>
					<h2 class="entry-title"><?php the_title(); ?></h2>

				</header>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
				?>


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
			</article>

		<?php endwhile; ?>
	</main>

</div>

<?php
get_footer();
