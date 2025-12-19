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

<!-- ======= Footer ======= -->
<!-- widgets -->
<div class="footer-container">
	<div class="background-footer">
		<div class="footer-widgets"
			<?php
			if (!is_active_sidebar('footer-widgets')) {
				echo ' aria-hidden="true"';
			}
			?>>
			<?php if (is_active_sidebar('footer-widgets')) : ?>
				<div id="footer-sidebar-container">
					<?php dynamic_sidebar('footer-widgets'); ?>
				</div>
			<?php endif; ?>
		</div>

		<footer id="footer" class="footer">
			<div class="footer-content">
				<!-- business address -->

				<?php
				$holmes_footer_settings = get_option('holmes_footer_settings');
				if ($holmes_footer_settings && isset($holmes_footer_settings['footer_text'])) {
					$footer_text = $holmes_footer_settings['footer_text'];
				?>
					<div class="business-address">
						<?php
						$footer_text_lines = explode(',', $footer_text);
						foreach ($footer_text_lines as $index => $line) {
							$line = trim($line);
							if (!empty($line)) {
								if ($index === 0) {
									echo '<div class="footer-text"><span class="first-line">' . esc_html($line) . '</span></div>';
								} else {
									echo '<div class="footer-text">' . esc_html($line) . '</div>';
								}
							}
						}
						?>
					</div>
				<?php } ?>


				<?php
				$holmes_policy_settings_links = get_option('holmes_policy_settings');

				$hasLinks = false;

				// if $holmes_policy_settings_links is an array
				if (is_array($holmes_policy_settings_links)) {
					$privacy_policy_link          = esc_url($holmes_policy_settings_links['privacy_policy_link'] ?? '');
					$terms_conditions_link        = esc_url($holmes_policy_settings_links['terms_conditions_link'] ?? '');
					$accessibility_statement_link = esc_url($holmes_policy_settings_links['accessibility_statement_link'] ?? '');

					// if any of the links are not empty
					if (!empty($privacy_policy_link) || !empty($terms_conditions_link) || !empty($accessibility_statement_link)) {
						$hasLinks = true;
					}
				}
				?>

				<div class="terms-conditions
<?php
if (!$hasLinks) {
	echo ' empty';
}
?>
"
					<?php
					if (!$hasLinks) {
						echo ' aria-hidden="true"';
					}
					?>>
					<?php if (!empty($privacy_policy_link) || !empty($terms_conditions_link) || !empty($accessibility_statement_link)) : ?>
						<ul class="policy-links">
							<?php if (!empty($privacy_policy_link)) : ?>
								<li><a href="<?php echo esc_url($privacy_policy_link); ?>" aria-label="Privacy & Cookie policy"><?php esc_html_e('Privacy & Cookie policy', 'holmesportfolio'); ?></a></li>
							<?php endif; ?>

							<?php if (!empty($terms_conditions_link)) : ?>
								<li><a href="<?php echo esc_url($terms_conditions_link); ?>" aria-label="Terms and Conditions"><?php esc_html_e('Terms and Conditions', 'holmesportfolio'); ?></a></li>
							<?php endif; ?>

							<?php if (!empty($accessibility_statement_link)) : ?>
								<li><a href="<?php echo esc_url($accessibility_statement_link); ?>" aria-label="Accessibility Statement"><?php esc_html_e('Accessibility Statement', 'holmesportfolio'); ?></a></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>

				<!-- contact us -->
				<?php
				$holmes_footer_settings = get_option('holmes_footer_settings');
				$hasContent = false;

				if ($holmes_footer_settings) {
					$contactUsTitle = isset($holmes_footer_settings['contact_us_title']) ? $holmes_footer_settings['contact_us_title'] : '';
					$contactUsDescription = isset($holmes_footer_settings['contact_us_description']) ? $holmes_footer_settings['contact_us_description'] : '';
					$contactUsButtonText = isset($holmes_footer_settings['contact_us_button_text']) ? esc_attr($holmes_footer_settings['contact_us_button_text']) : '';
					$contactUsButtonLink = isset($holmes_footer_settings['contact_us_button_link']) ? esc_url($holmes_footer_settings['contact_us_button_link']) : '';
					$contactUsButtonScreenReaderText = isset($holmes_footer_settings['contact_us_button_screen_reader_text']) ? esc_attr($holmes_footer_settings['contact_us_button_screen_reader_text']) : '';

					// if any of the variables contain text
					if ($contactUsTitle || $contactUsDescription || $contactUsButtonText || $contactUsButtonLink || $contactUsButtonScreenReaderText) {
						$hasContent = true;
					}
				}
				?>
				<div class="contactus-button<?php if (!$hasContent) echo ' empty'; ?>" <?php if (!$hasContent) echo ' aria-hidden="true"'; ?>>
					<?php
					if (!empty($contactUsTitle)) {
						echo '<span class="first-line">' . esc_html($contactUsTitle) . '</span>';
					}

					if (!empty($contactUsDescription)) {
						echo wpautop(wp_kses_post($contactUsDescription));
					}

					if (!empty($contactUsButtonText)) {
						echo '<input 
            aria-haspopup="true" 
            type="button" 
            id="contactUsButton" 
            value="' . esc_attr($contactUsButtonText) . '" 
            onclick="window.location.href=\'' . esc_url($contactUsButtonLink) . '\';"';

						if (!empty($contactUsButtonScreenReaderText)) {
							echo ' title="' . esc_attr($contactUsButtonScreenReaderText) . '"';
							echo ' aria-label="' . esc_attr($contactUsButtonScreenReaderText) . '"';
						}

						echo ' onkeypress="if(event.keyCode==13 || event.which==13){ this.click(); }"';
						echo '>';
					}
					?>
					<script>
						document.addEventListener("DOMContentLoaded", () => {
							const button = document.getElementById("contactUsButton");

							if (button) {
								const currentPath = encodeURI(window.location.pathname);
								const baseUrl = "<?php echo esc_js($contactUsButtonLink); ?>";

								if (baseUrl) {
									button.onclick = () => {
										window.location.href = `${baseUrl}?AboutPage=${currentPath}`;
									};
								}
							}
						});
					</script>
				</div>


				<!--java error -->


				<div class="java-error-message">
					<p>This website requires Java to run. Please enable Java in your browser settings to access its full functionality.</p>
				</div>
			</div>

		</footer>

		<!-- social media links -->
		<?php
		$social_media_links = get_option('holmes_social_settings');
		$icon_style = get_option('holmes_social_icon_style', 'default');

		if (is_array($social_media_links)) {
			$facebook_link  = esc_url($social_media_links['facebook_link'] ?? '');
			$twitter_link   = esc_url($social_media_links['twitter_link'] ?? '');
			$instagram_link = esc_url($social_media_links['instagram_link'] ?? '');
			$youtube_link   = esc_url($social_media_links['youtube_link'] ?? '');

			if (!empty($facebook_link) || !empty($twitter_link) || !empty($instagram_link) || !empty($youtube_link)) {
		?>
				<div class="bottom_container">
					<div class="social-links-right">
						<?php
						if (!empty($facebook_link)) {
							echo '<a href="' . esc_url($facebook_link) . '" target="_blank" aria-haspopup="true">
						<img src="' . esc_url(get_template_directory_uri() . '/template-bits/admin/icons/' . $icon_style . '/facebook-icon.png') . '" alt="Facebook">
					</a>';
						}
						if (!empty($twitter_link)) {
							echo '<a href="' . esc_url($twitter_link) . '" target="_blank" aria-haspopup="true">
						<img src="' . esc_url(get_template_directory_uri() . '/template-bits/admin/icons/' . $icon_style . '/x-icon.png') . '" alt="Twitter">
					</a>';
						}
						if (!empty($instagram_link)) {
							echo '<a href="' . esc_url($instagram_link) . '" target="_blank" aria-haspopup="true">
						<img src="' . esc_url(get_template_directory_uri() . '/template-bits/admin/icons/' . $icon_style . '/instagram-icon.png') . '" alt="Instagram">
					</a>';
						}
						if (!empty($youtube_link)) {
							echo '<a href="' . esc_url($youtube_link) . '" target="_blank" aria-haspopup="true">
						<img src="' . esc_url(get_template_directory_uri() . '/template-bits/admin/icons/' . $icon_style . '/youtube-icon.png') . '" alt="YouTube">
					</a>';
						}
						?>
					</div>
				</div>
		<?php
			}
		}
		?>

		<!-- copyright -->

		<div class="footer-copyright">
			<?php
			$holmes_footer_settings = get_option('holmes_footer_settings');

			// if $holmes_footer_settings is an array
			if (is_array($holmes_footer_settings)) {
				$copyrightText = $holmes_footer_settings['copyright_text'] ?? '';

				if (!empty($copyrightText)) {
					echo esc_html($copyrightText);
				}
			}
			?>
		</div>
	</div>
	<div class="credits">
		Developed by <a href="https://holmesportfolio.co.uk" target="_blank" aria-haspopup="true" aria-label="Developed by Holmes">HolmesPortfolio™</a>
	</div>

</div>


<!-- Scroll to top button -->
<button id="scrollTop" aria-label="Go to top">Top</button>



<?php wp_footer(); ?>