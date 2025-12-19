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

$hide_heading = get_post_meta(get_queried_object_id(), '_hide_heading', true);
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php holmes_breadcrumbs(); ?>

		<?php
		if (is_active_sidebar('sidebar')) {
			dynamic_sidebar('sidebar');
		}
		?>



		<?php
		while (have_posts()) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if (! $hide_heading) : ?>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>

				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
				?>
			</article>

		<?php endwhile; ?>
	</main>

</div>

<?php
get_footer();
