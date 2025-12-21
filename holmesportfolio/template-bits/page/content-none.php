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
<section class="no-resultsS">
	<div class="posts-grid">
		<article class="post-card">
			<header class="entry-header">
				<h2 class="entry-title"><?php esc_html_e('Sorry, Nothing Found.', 'holmesportfolio'); ?></h2>
			</header>

			<div class="entry-summary">
				<?php
				if (is_home() && current_user_can('publish_posts')) :

					printf(
						'<p>' . wp_kses(
							__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'holmesportfolio'),
							array('a' => array('href' => array()))
						) . '</p>',
						esc_url(admin_url('post-new.php'))
					);

				elseif (is_search()) :
				?>
					<p><?php esc_html_e('Nothing matched your search terms. Please try again.', 'holmesportfolio'); ?></p>
					<?php get_search_form(); ?>

				<?php else : ?>
					<p><?php esc_html_e('It seems we can\'t find what you\'re looking for. maybe try searching.', 'holmesportfolio'); ?></p>
					<?php get_search_form(); ?>

				<?php endif; ?>
			</div>
		</article>
	</div>
</section>