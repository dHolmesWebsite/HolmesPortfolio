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

// footer page.
function custom_administration_page()
{
?>
	<div class="wrap">
		<h1>Footer Settings</h1>

	</div>
<?php
}

// Main menu.
function custom_admin_menu()
{
	add_menu_page(
		'Footer & header settings',            // Page title.
		'Footer & header settings',            // Menu title.
		'manage_options',            // Capability.
		'admin-settings',            // Menu slug.
		'__return_false',     // Callback function (does nothing).
		'dashicons-admin-generic',   // Icon.
		97                          // Position in the menu.
	);

	// Social Media page.
	add_submenu_page(
		'admin-settings',            // Parent slug.
		'Social media settings',     // Page title.
		'Footer social links',              // Menu title.
		'manage_options',            // Capability.
		'social-media-settings',     // Menu slug.
		'custom_social_media_page'   // Callback function to display the page.
	);

	// Policy page.
	add_submenu_page(
		'admin-settings',
		'Policy settings',
		'Footer policy links',
		'manage_options',
		'policy-settings',
		'custom_policy_page'
	);
	// Footer page.
	add_submenu_page(
		'admin-settings',
		'business button',
		'Footer business button',
		'manage_options',
		'footer-settings',
		'custom_footer_page'
	);
	// submenu header.
	add_submenu_page(
		'admin-settings',
		'Header settings',
		'Header settings',
		'manage_options',
		'header-menu-settings',
		'custom_searchbar_page'
	);

	// removed Admin page.
	remove_submenu_page('admin-settings', 'admin-settings');
}
add_action('admin_menu', 'custom_admin_menu');




// Social Media page.
function custom_social_media_page()
{
?>
	<div class="wrap">
		<a class="URL_back_admin" href="admin.php?page=main-admin">Back to admin</a>
		<h1>Social media settings</h1>
		<form class="hdadmin" method="post" action="options.php">
			<?php
			settings_fields('holmes_social_settings');
			do_settings_sections('holmes_social_settings');
			submit_button();
			?>
			<div class="logo_admin">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg'); ?>" alt="holmesportfolio logo">
			</div>
		</form>
	</div>
<?php
}

// Policy page.
function custom_policy_page()
{
?>
	<div class="wrap">
		<a class="URL_back_admin" href="admin.php?page=main-admin">Back to admin</a>
		<h1>Policy settings</h1>
		<form class="hdadmin" method="post" action="options.php">
			<?php
			settings_fields('holmes_policy_settings');
			do_settings_sections('holmes_policy_settings');
			submit_button();
			?>
			<div class="logo_admin">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg'); ?>" alt="holmesportfolio logo">
			</div>
		</form>
	</div>
<?php
}

// footer page.
function custom_footer_page()
{
?>
	<div class="wrap">
		<a class="URL_back_admin" href="admin.php?page=main-admin">Back to admin</a>
		<h1>Footer business button and copyright</h1>
		<form class="hdadmin" method="post" action="options.php">
			<?php
			settings_fields('holmes_footer_settings');
			do_settings_sections('holmes_footer_settings');
			submit_button();
			?>
			<div class="logo_admin">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg'); ?>" alt="holmesportfolio logo">
			</div>
		</form>
	</div>
	<?php
}

// Policy settings.
function custom_holmes_policy_settings()
{
	add_settings_section(
		'policy_section',               // Section ID.
		'',                 // Section title.
		'custom_policy_section_callback', // Callback function to display the section.
		'holmes_policy_settings'                // Page slug.
	);

	// Terms and Conditions.
	add_settings_field(
		'terms_conditions_link',         // Field ID.
		'Terms and Conditions',          // Field title.
		'custom_terms_conditions_field_callback', // Callback function to display the field.
		'holmes_policy_settings',               // Page slug.
		'policy_section'
	);

	// Privacy Policy.
	add_settings_field(
		'privacy_policy_link',
		'Privacy & Cookie policy',
		'custom_privacy_policy_field_callback',
		'holmes_policy_settings',
		'policy_section'
	);

	// Accessibility Statement.
	add_settings_field(
		'accessibility_statement_link',
		'Accessibility Statement',
		'custom_accessibility_statement_field_callback',
		'holmes_policy_settings',
		'policy_section'
	);

	// policy settings.
	register_setting(
		'holmes_policy_settings',       // Option group.
		'holmes_policy_settings',       // Option name.
		'custom_policy_sanitize' // Sanitization callback function.
	);
}

// Social Media settings.
function custom_holmes_social_settings()
{
	add_settings_section(
		'social_media_section',                   // Section ID.
		'',                    // Section title.
		'custom_social_media_section_callback', // Callback function to display the section.
		'holmes_social_settings'                  // Page slug.
	);

	// Facebook.
	add_settings_field(
		'facebook_link',                           // Field ID.
		'Facebook link',                           // Field title.
		'custom_social_media_facebook_field_callback', // Callback function to display the field.
		'holmes_social_settings',                  // Page slug.
		'social_media_section'
	);

	// Twitter X.
	add_settings_field(
		'twitter_link',
		'X link',
		'custom_social_media_twitter_field_callback',
		'holmes_social_settings',
		'social_media_section'
	);

	// Instagram.
	add_settings_field(
		'instagram_link',
		'Instagram link',
		'custom_social_media_instagram_field_callback',
		'holmes_social_settings',
		'social_media_section'
	);

	// Youtube.
	add_settings_field(
		'youtube_link',
		'Youtube link',
		'custom_social_media_youtube_field_callback',
		'holmes_social_settings',
		'social_media_section'
	);

	// social media settings.
	register_setting(
		'holmes_social_settings',     // Option group.
		'holmes_social_settings',     // Option name.
		'custom_social_media_sanitize' // Sanitization callback function.
	);

	add_settings_field(
		'holmes_social_icon_style',
		'Social media icons',
		'display_social_icon_style_dropdown',
		'holmes_social_settings',
		'social_media_section',
		array('label_for' => 'holmes_social_icon_style')
	);

	register_setting(
		'holmes_social_settings',
		'holmes_social_icon_style',
		[
			'type' => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'default',
		]
	);
}

// Footer settings.
function custom_holmes_footer_settings()
{
	add_settings_section(
		'footer_section',
		'',
		'custom_heading_callback',
		'holmes_footer_settings'
	);

	// heading section text.
	function custom_heading_callback()
	{
		echo '<div class="info-box">';
		echo '<h2>Info:</h2>';
		echo '<p class="Other-text">If you use the button. <b>remember to add a description or it could fail accessibility.</b></p>';
		echo '<p class="Other-text">Only the parts that you enter details in will show.</p>';
		echo '</div>';
	}

	// Contact Us Title.
	add_settings_field(
		'contact_us_title',
		'Button title (above button)',
		'custom_contact_us_title_callback',
		'holmes_footer_settings',
		'footer_section'
	);

	// Contact Us Description.
	add_settings_field(
		'contact_us_description',
		'Button description (above button)',
		'custom_contact_us_description_callback',
		'holmes_footer_settings',
		'footer_section'
	);

	// Contact Us Button Text.
	add_settings_field(
		'contact_us_button_text',
		'Button text (inside button)',
		'custom_contact_us_button_text_callback',
		'holmes_footer_settings',
		'footer_section'
	);

	// contact us screen reader text.
	add_settings_field(
		'contact_us_button_screen_reader_text',
		'Button description(this is for accessibility)<br>Example: Button opens our email address',
		'custom_contact_us_button_screen_reader_text_callback',
		'holmes_footer_settings',
		'footer_section'
	);

	// Contact Us Button Link.
	add_settings_field(
		'contact_us_button_link',
		'Button link: <br>example: mailto:someone@example.com',
		'custom_contact_us_button_link_callback',
		'holmes_footer_settings',
		'footer_section'
	);
	// Footer text.
	add_settings_field(
		'footer_text',
		'Footer text: <br>(add a business address?, use comma\'s for spacing)<br> example: The House, Cloud road, Cloud land, NEee eEE',
		'custom_footer_text_callback',
		'holmes_footer_settings',
		'footer_section'
	);

	// copyright text.
	add_settings_field(
		'copyright_text',
		'Copyright text, <br>this shows at the bottom of the footer',
		'custom_copyright_text_callback',
		'holmes_footer_settings',
		'footer_section'
	);
	register_setting(
		'holmes_footer_settings',      // Option group.
		'holmes_footer_settings',      // Option name.
		'custom_footer_sanitize' // Sanitization callback function.
	);
}

// Social Media section text.
function custom_social_media_section_callback()
{
	echo '<div class="info-box">';
	echo '<h2>Info:</h2>';
	echo '<p class="Other-text">Enter your social media links.</p>';
	echo '<p class="Other-text">Only the ones you enter will show.</p>';
	echo '</div>';
}


// Facebook settings.
function custom_social_media_facebook_field_callback()
{
	$options = get_option('holmes_social_settings');

	// Check if $options is an array.
	if (is_array($options) && isset($options['facebook_link'])) {
	?>
		<input type="text" name="holmes_social_settings[facebook_link]" value="<?php echo esc_url($options['facebook_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_social_settings[facebook_link]" value="" />
	<?php
	}
}

// twitter setting.
function custom_social_media_twitter_field_callback()
{
	$options = get_option('holmes_social_settings');

	if (is_array($options) && isset($options['twitter_link'])) {
	?>
		<input type="text" name="holmes_social_settings[twitter_link]" value="<?php echo esc_url($options['twitter_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_social_settings[twitter_link]" value="" />
	<?php
	}
}


// Instagram setting.
function custom_social_media_instagram_field_callback()
{
	$options = get_option('holmes_social_settings');

	if (is_array($options) && isset($options['instagram_link'])) {
	?>
		<input type="text" name="holmes_social_settings[instagram_link]" value="<?php echo esc_url($options['instagram_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_social_settings[instagram_link]" value="" />
	<?php
	}
}



// Youtube setting.
function custom_social_media_youtube_field_callback()
{
	$options = get_option('holmes_social_settings');

	if (is_array($options) && isset($options['youtube_link'])) {
	?>
		<input type="text" name="holmes_social_settings[youtube_link]" value="<?php echo esc_url($options['youtube_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_social_settings[youtube_link]" value="" />
	<?php
	}
}

function display_social_icon_style_dropdown($args)
{
	$icon_style = get_option($args['label_for'], 'default');

	$styles = array(
		'default' => 'Default',
		'round'   => 'Round',
		'square'  => 'Square',
		'outline' => 'Outline',
		'minimal' => 'Minimal',
	);

	echo '<select id="' . esc_attr($args['label_for']) . '" name="' . esc_attr($args['label_for']) . '" onchange="updateIconPreview(this)">';
	foreach ($styles as $key => $label) {
		echo '<option value="' . esc_attr($key) . '" ' . selected($icon_style, $key, false) . '>' . esc_html($label) . '</option>';
	}
	echo '</select>';


	echo '<div class="social-icon-preview" style="margin-top:10px;">';
	foreach (['facebook', 'x', 'instagram', 'youtube'] as $platform) {
		echo '<img class="social-icon" data-platform="' . esc_attr($platform) . '" src="' . esc_url(get_template_directory_uri() . "/template-bits/admin/icons/{$icon_style}/{$platform}.png") . '" style="width:32px;height:32px;margin-right:10px;" />';
	}
	echo '</div>';

	// update preview
	?>
	<script>
		function updateIconPreview(select) {
			var style = select.value;
			var basePath = "<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/icons/'); ?>";
			document.querySelectorAll('.social-icon-preview img').forEach(function(img) {
				var platform = img.getAttribute('data-platform');
				img.src = basePath + style + '/' + platform + '-icon.png';
			});
		}
		//preview
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("<?php echo esc_attr($args['label_for']); ?>").dispatchEvent(new Event('change'));
		});
	</script>
	<?php
}



// Policy section text.
function custom_policy_section_callback()
{
	echo '<div class="info-box">';
	echo '<h2>Info:</h2>';
	echo '<p class="Other-text">Enter your policy links.</p>';
	echo '<p class="Other-text">Only the ones you enter will show.</p>';
	echo '</div>';
}

// terms and conditions.
function custom_terms_conditions_field_callback()
{
	$options = get_option('holmes_policy_settings');

	if (is_array($options) && isset($options['terms_conditions_link'])) {
	?>
		<input type="text" name="holmes_policy_settings[terms_conditions_link]" value="<?php echo esc_url($options['terms_conditions_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_policy_settings[terms_conditions_link]" value="" />
	<?php
	}
}


// Privacy Policy.
function custom_privacy_policy_field_callback()
{
	$options = get_option('holmes_policy_settings');

	if (is_array($options) && isset($options['privacy_policy_link'])) {
	?>
		<input type="text" name="holmes_policy_settings[privacy_policy_link]" value="<?php echo esc_url($options['privacy_policy_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_policy_settings[privacy_policy_link]" value="" />
	<?php
	}
}



// Accessibility Statement.
function custom_accessibility_statement_field_callback()
{
	$options = get_option('holmes_policy_settings');

	if (is_array($options) && isset($options['accessibility_statement_link'])) {
	?>
		<input type="text" name="holmes_policy_settings[accessibility_statement_link]" value="<?php echo esc_url($options['accessibility_statement_link']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_policy_settings[accessibility_statement_link]" value="" />
	<?php
	}
}



// Contact Us title.
function custom_contact_us_title_callback()
{
	$options = get_option('holmes_footer_settings');
	?>
	<div class="contact-us-top">
		<?php
		/* Check if $options is an array before accessing its elements.*/
		if (is_array($options) && isset($options['contact_us_title'])) {
		?>
			<input type="text" name="holmes_footer_settings[contact_us_title]" value="<?php echo esc_attr($options['contact_us_title']); ?>" />
		<?php
		} else {
		?>
			<input type="text" name="holmes_footer_settings[contact_us_title]" value="" />
		<?php
		}
		?>
	</div>
<?php
}


// Contact Us description.
function custom_contact_us_description_callback()
{
	$options = get_option('holmes_footer_settings');
?>

	<?php
	// Check if $options is an array before accessing its elements.
	if (is_array($options) && isset($options['contact_us_description'])) {
	?>
		<textarea name="holmes_footer_settings[contact_us_description]" rows="3" cols="50"><?php echo esc_textarea($options['contact_us_description']); ?></textarea>
	<?php
	} else {
	?>
		<textarea name="holmes_footer_settings[contact_us_description]" rows="3" cols="50"></textarea>
	<?php
	}
}


// Contact Us button text.
function custom_contact_us_button_text_callback()
{
	$options = get_option('holmes_footer_settings');

	if (is_array($options) && isset($options['contact_us_button_text'])) {
	?>
		<input type="text" name="holmes_footer_settings[contact_us_button_text]" value="<?php echo esc_attr($options['contact_us_button_text']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_footer_settings[contact_us_button_text]" value="" />
	<?php
	}
}



// Contact Us screen reader text.
function custom_contact_us_button_screen_reader_text_callback()
{
	$options = get_option('holmes_footer_settings');

	if (is_array($options) && isset($options['contact_us_button_screen_reader_text'])) {
	?>
		<input type="text" name="holmes_footer_settings[contact_us_button_screen_reader_text]" value="<?php echo esc_attr($options['contact_us_button_screen_reader_text']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_footer_settings[contact_us_button_screen_reader_text]" value="" />
	<?php
	}
}


// Contact Us link.
function custom_contact_us_button_link_callback()
{
	$options = get_option('holmes_footer_settings');
	?>
	<div class="contact-us-bottom">
		<?php
		// Check if $options is an array.
		if (is_array($options) && isset($options['contact_us_button_link'])) {
		?>
			<input type="text" name="holmes_footer_settings[contact_us_button_link]" value="<?php echo esc_url($options['contact_us_button_link']); ?>" />
		<?php
		} else {
		?>
			<input type="text" name="holmes_footer_settings[contact_us_button_link]" value="" />
		<?php
		}
		?>
	</div>
<?php
}

// footer text.
function custom_footer_text_callback()
{
	$options = get_option('holmes_footer_settings');
?>

	<?php
	// Check if $options is an array.
	if (is_array($options) && isset($options['footer_text'])) {
	?>
		<textarea name="holmes_footer_settings[footer_text]" rows="5" cols="50"><?php echo esc_textarea($options['footer_text']); ?></textarea>
	<?php
	} else {
	?>
		<textarea name="holmes_footer_settings[footer_text]" rows="5" cols="50"></textarea>
	<?php
	}
}

// copyright text.
function custom_copyright_text_callback()
{
	$options = get_option('holmes_footer_settings');

	if (is_array($options) && isset($options['copyright_text'])) {
	?>
		<input type="text" name="holmes_footer_settings[copyright_text]" value="<?php echo esc_attr($options['copyright_text']); ?>" />
	<?php
	} else {
	?>
		<input type="text" name="holmes_footer_settings[copyright_text]" value="" />
	<?php
	}
}



add_action('admin_init', 'custom_holmes_footer_settings');
add_action('admin_init', 'custom_holmes_social_settings');
add_action('admin_init', 'custom_holmes_policy_settings');




// Sanitize social media settings.
function custom_social_media_sanitize($input)
{
	foreach ($input as $key => $value) {
		$input[$key] = esc_url_raw($value);
	}
	return $input;
}

// Sanitize policy settings.
function custom_policy_sanitize($input)
{
	foreach ($input as $key => $value) {
		$input[$key] = esc_url_raw($value);
	}
	return $input;
}


// Sanitize footer settings.
function custom_footer_sanitize($input)
{
	foreach ($input as $key => $value) {
		switch ($key) {
			case 'footer_text':
			case 'contact_us_title':
			case 'contact_us_description':
			case 'contact_us_button_text':
			case 'contact_us_button_screen_reader_text':
			case 'copyright_text':
				$input[$key] = sanitize_text_field($value);
				break;
			case 'contact_us_button_link':
				$input[$key] = esc_url_raw($value);
				break;
			default:
				$input[$key] = $value;
		}
	}
	return $input;
}
function custom_header_settings_sanitize($input)
{
	return isset($input) ? 1 : 0;
}



add_filter('sanitize_option_holmes_social_settings', 'custom_social_media_sanitize');
add_filter('sanitize_option_holmes_policy_settings', 'custom_policy_sanitize');
add_filter('sanitize_option_holmes_footer_settings', 'custom_footer_sanitize');
add_filter('sanitize_option_header_settings_group', 'custom_header_settings_sanitize');


// search bar page.
function custom_searchbar_page()
{
	?>
	<div class="wrap">
		<a class="URL_back_admin" href="admin.php?page=main-admin">Back to admin</a>
		<h1>Header settings</h1>


		<form class="hdadmin" method="post" action="options.php">
			<?php
			settings_fields('header_settings_group');
			do_settings_sections('header_settings_page');
			submit_button();
			?>

			<div class="logo_admin">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg'); ?>" alt="holmesportfolio logo">
			</div>


	</div>
<?php
}

// register header settings.
function custom_header_settings_init()
{

	// Header Settings.
	add_settings_section(
		'header_settings_section',             // Section ID.
		'',                  // Section title.
		'custom_header_settings_section_callback', // Callback function to display the section.
		'header_settings_page'                  // Page slug.
	);

	// search bar settings.
	add_settings_field(
		'holmes_hide_search_bar',                      // Field ID.
		'Hide Search Bar:',                      // Field title.
		'custom_holmes_hide_search_bar_field_callback', // Callback function to display the field.
		'header_settings_page',                 // Page slug.
		'header_settings_section'   // section id.
	);

	// register search bar.
	register_setting(
		'header_settings_group',      // Option group.
		'holmes_hide_search_bar'             // Option name.
	);

	// slogan settings.
	add_settings_field(
		'holmes_hide_slogan',
		'Hide slogan:<br> this one appears under the logo',
		'custom_holmes_hide_slogan_field_callback',
		'header_settings_page',
		'header_settings_section'
	);

	// Register the slogan.
	register_setting(
		'header_settings_group',     // Option group.
		'holmes_hide_slogan'             // Option name.
	);
}
add_action('admin_init', 'custom_header_settings_init');

// header section text.
function custom_header_settings_section_callback()
{
	echo '<div class="info-box">';
	echo '<h2>Info:</h2>';
	echo '<p class="Other-text">Here you can <ul><li>Add a search bar</li> <li>Show your slogan in the header</li> <li>Pick a menu</li></ul> </p>';
	echo '</div>';
}



// hide Slogan.
function custom_holmes_hide_slogan_field_callback()
{
	$holmes_hide_slogan = get_option('holmes_hide_slogan', 0);
?>
	<label for="holmes_hide_slogan" class="Other-text">
		<input type="checkbox" id="holmes_hide_slogan" name="holmes_hide_slogan" value="1" <?php checked(1, $holmes_hide_slogan); ?>>
		Hide the slogan
	</label>
<?php
}

// Hide Search Bar.
function custom_holmes_hide_search_bar_field_callback()
{
	$holmes_hide_search_bar = get_option('holmes_hide_search_bar', 0);
?>
	<label for="holmes_hide_search_bar" class="Other-text">
		<input type="checkbox" id="holmes_hide_search_bar" name="holmes_hide_search_bar" value="1" <?php checked(1, $holmes_hide_search_bar); ?>>
		Hide the search bar
	</label>
<?php
}
