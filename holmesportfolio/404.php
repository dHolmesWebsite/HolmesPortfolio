<?php

/**
 * Theme Name: holmesportfolio
 * Theme URI: https://portfolio.holmeswebsite.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://portfolio.holmeswebsite.co.uk/
 * Requires PHP: 8
 * Tested up to: 6.5
 * Version: 5
 * License: holmesportfolio Commercial License
 * License URI: https://portfolio.holmeswebsite.co.uk//hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

?>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e('Sorry, we can\'t locate this.', 'holmesportfolio'); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e('try the search below.', 'holmesportfolio'); ?></p>
				<?php get_search_form(); ?>

			</div>
		</section>
	</main>
</div>

<?php get_footer(); ?>