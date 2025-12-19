<?php

/**
 * Theme Name: holmesportfolio
 * Theme URI: https://portfolio.holmeswebsite.co.uk
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://portfolio.holmeswebsite.co.uk
 * Requires PHP: 7
 * Tested up to: 6.5
 * Version: 4.3
 * License: holmesportfolio Commercial License
 * License URI: https://portfolio.holmeswebsite.co.uk/hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

/* make menu. */
function custom_dashboard_menu()
{
	add_menu_page(
		'Main admin page',
		'Admin area',
		'manage_options',
		'main-admin',
		'custom_dashboard_page',
		'dashicons-admin-home',
		2
	);
}
add_action('admin_menu', 'custom_dashboard_menu');
/* save settings. */
function custom_savetheme_settings_init()
{
	/* save theme text.*/
	add_settings_section(
		'savetheme_settings_section',  // Section ID.
		'<p class="Other-text">If ticked, theme data is not removed upon changing or deleting</p>',         // Section title.
		'empty_callback',  // empty callback function.
		'main-admin'                   // Page slug.
	);

	/* save theme settings.*/
	add_settings_field(
		'holmes_savetheme',                     // Field ID.
		'',             // Field title.
		'custom_holmes_savetheme_field_callback', // display the field.
		'main-admin',
		'savetheme_settings_section',           // Section ID.
		array('label_for' => 'holmes_savetheme')
	);

	/* Register the setting.*/
	register_setting(
		'savetheme_settings_group',     // Option group.
		'holmes_savetheme',            // Option name.
		'sanitize_text_field'           // Sanitization callback.
	);
}
add_action('admin_init', 'custom_savetheme_settings_init');
/* dash board admin. */
function custom_dashboard_page()
{
?>
	<div class="style_admin">
		<h1>Admin area</h1>
		<p class="Other-text">Welcome to the main admin page. </p>
		<p class="Other-text">Here you can access all your admin pages. instead of finding them</p>

		<ul>
			<h3 class="admin-text">Main site settings</h3>
			<li><a href="admin.php?page=header-menu-settings">Header settings</a></li>
			<li><a href="admin.php?page=layout-settings">Page width and button radius</a></li>
			<li><a href="admin.php?page=colour-settings">Change theme gradient</a></li>
		</ul>

		<ul>
			<h3 class="admin-text">Footer settings</h3>
			<li><a href="admin.php?page=footer-settings">Business button, business address and copyright</a></li>
			<li><a href="admin.php?page=policy-settings">Policy settings</a></li>
			<li><a href="admin.php?page=social-media-settings">Social media settings</a></li>
		</ul>

		<li><a class="URL_tutorial" href="https://portfolio.holmeswebsite.co.uk/theme-setup/" target="_blank">Theme tutorial</a></li>
	</div>

	<h3 class="admin-text">Knowledge check</h3>
	<ul class="tips_admin">
		<li>Ensure all images have descriptive ALT text</li>
		<li>Use headings (<code>&lt;h1&gt;</code>, <code>&lt;h2&gt;</code>, etc.) to structure your content, only do one <code>&lt;h1&gt;</code> per page. On WordPress you won't be using h1 normally as this is used for the page title</li>
		<li>Provide clear and descriptive link text</li>
		<li>Avoid using jargon or abbreviations without explanation</li>
		<li>Use bullet points or numbered lists for easier readability</li>
		<li>Provide transcripts or captions for audio and video content</li>
		<li>Avoid using PDFs, but ensure documents are accessible for screen readers</li>
		<li>Choose accessible colours for text and backgrounds</li>
	</ul>

	<a class="URL_admin" href="https://portfolio.holmeswebsite.co.uk/accessibility/" target="_blank">Read more about accessibility</a>
	<a class="URL_admin" href="mailto:david@portfolio.holmeswebsite.co.uk?subject=Report%20accessibility%20issue" target="_blank">Report identified accessibility issues with this theme</a>

	<div class="logo_admin">
		<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/HolmesWebsite-logo.jpg'); ?>" alt="HolmesWebsite logo">
	</div>

	<br>
	<form class="hdadmin" method="post" action="options.php">
		<?php
		settings_fields('savetheme_settings_group');
		do_settings_sections('main-admin');
		submit_button();
		?>
	</form>
<?php
}

/* save theme.*/
function custom_holmes_savetheme_field_callback()
{
	$holmes_savetheme = get_option('holmes_savetheme', 0);
?>
	<label for="holmes_savetheme" class="Other-text">
		<input type="checkbox" id="holmes_savetheme" name="holmes_savetheme" value="1" <?php checked(1, $holmes_savetheme); ?>>
		Keep the theme data
	</label>
<?php
}

// Empty function for settings.
function empty_callback() {}
