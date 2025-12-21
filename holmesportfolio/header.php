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

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
	<script>
		document.documentElement.classList.replace('no-js', 'js');
	</script>
</head>


<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!--  Header  -->
	<header id="header" class="header">

		<div class="header-container">
			<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'holmesportfolio'); ?></a>

			<!-- logo -->
			<div class="logo hw-slide-hidden-down" aria-label="Home">
				<?php
				$custom_logo_id = get_theme_mod('custom_logo');
				$logo_url       = wp_get_attachment_image_url($custom_logo_id, 'full');
				$site_tagline   = get_bloginfo('description');

				if ($logo_url) {
					printf(
						'<a href="%1$s" class="d-flex align-items-center scrollto me-auto me-lg-0"><img src="%2$s" aria-label="go to %3$s homepage" alt="%3$s"></a>',
						esc_url(home_url('/')),
						esc_url($logo_url),
						esc_attr(get_bloginfo('name'))
					);
				} elseif ($site_tagline) {

					echo '<p class="site-name">' . esc_html(get_bloginfo('name')) . '<br><span class="tagline">' . esc_html($site_tagline) . '</span></p>';
				} else {
					echo '<p class="site-name">' . esc_html(get_bloginfo('name')) . '</p>';
				}
				?>
				<!-- slogan -->
				<?php $holmes_hide_slogan = get_option('holmes_hide_slogan'); ?>

				<div class="slogan-container" aria-label="Site slogan"
					<?php
					if ($holmes_hide_slogan) {
						echo ' aria-hidden="true"';
					}
					?>>

					<?php
					if (! $holmes_hide_slogan) {
						echo '<p class="slogan">' . esc_html(get_option('blogdescription')) . '</p>';
					}
					?>
				</div>
			</div>



			<!-- search bar -->
			<?php
			$holmes_hide_search_bar = get_option('holmes_hide_search_bar', false);
			?>

			<div class="header-searchbar" aria-label="Search bar"
				<?php
				if ($holmes_hide_search_bar) {
					echo ' aria-hidden="true"';
				}
				?>>
				<?php
				if (! $holmes_hide_search_bar) {
				?>
				<?php
					get_search_form();
				}
				?>

				<div class="shop-basket">
					<?php
					if (
						class_exists('WooCommerce') &&
						function_exists('WC') &&
						WC()->cart &&
						WC()->cart->get_cart_contents_count() > 0 &&
						! is_checkout() &&
						! is_shop()
					) : ?>
						<div id="header-mini-cart" class="header-cart-widget">
							<?php the_widget('WC_Widget_Cart', 'title='); ?>
						</div>
					<?php endif; ?>

				</div>
			</div>

		</div>

	</header>

	<!-- navbar -->
	<div class="navbar-wrapper"> <!-- aria-hidden="true" -->
		<button class="menu-toggle" aria-label="Mobile navigation toggle" aria-controls="navbar" aria-haspopup="true" aria-expanded="false">
			<span class="menu-toggle-icon"></span>
		</button>
	</div>
	<!-- Main navigation menu -->
	<div class="top_container">
		<nav id="navbar" aria-label="Main menu" class="navbar">
			<?php
			if (has_nav_menu('primary')) :
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'primary-menu',
						'menu_id'        => 'primary-menu',
					)
				);
			else :
				printf(
					'<a href="%1$s">%2$s</a>',
					esc_url(admin_url('/nav-menus.php')),
					esc_html__('Please add a menu', 'holmesportfolio')
				);
			endif;
			?>
		</nav>


	</div>