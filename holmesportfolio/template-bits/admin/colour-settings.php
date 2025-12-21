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

/* Style page.*/
function custom_style_settings_page()
{
?>
	<div class="wrapHD">
		<h1>Style Settings</h1>
	</div>
<?php
}

/* Main menu.*/
function custom_style_menu()
{
	add_menu_page(
		'Style settings',             // Page title.
		'Style settings',             // Menu title.
		'manage_options',             // Capability.
		'style-settings',             // Menu slug.
		'__return_false',      // function (does nothing).
		'dashicons-admin-customizer',    // Icon.
		98                           // Position in the menu.
	);

	// colour page.
	add_submenu_page(
		'style-settings',            // Parent slug.
		'Colour',          // Page title.
		'Colour settings',          // Menu title.
		'manage_options',           // Capability.
		'colour-settings',          // Menu slug.
		'custom_colour_page'        // function to display the page.
	);

	// layout page.
	add_submenu_page(
		'style-settings',
		'Layout',
		'Layout settings',
		'manage_options',
		'layout-settings',
		'custom_layout_page'
	);

	// remove style page.
	remove_submenu_page('style-settings', 'style-settings');
}
add_action('admin_menu', 'custom_style_menu');

/* colour page.*/
function custom_colour_page()
{
?>
	<div class="wrapHD">
		<a class="URL_back_admin" href="admin.php?page=main-admin">Back to admin</a>
		<h1>Colour Settings</h1>
		<form class="hdadmin" method="post" action="options.php">
			<?php
			settings_fields('style_settings_group');
			do_settings_sections('style_settings_page');
			submit_button();
			?>
		</form>
		<div class="logo_admin">
			<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg'); ?>" alt="holmesportfolio logo">
		</div>
	</div>

<?php
}

/* Layout  page.*/
function custom_layout_page()
{
?>
	<div class="wrapHD">
		<a class="URL_back_admin" href="admin.php?page=main-admin">Back to admin</a>
		<h1>Layout Settings</h1>
		<form class="hdadmin" method="post" action="options.php">
			<?php
			settings_fields('layout_settings_group');
			do_settings_sections('layout_settings_page');
			submit_button();
			?>
		</form>
		<div class="logo_admin">
			<img src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg'); ?>" alt="holmesportfolio logo">
		</div>
	</div>

<?php
}


?>
<?php
/* CSS width size option.*/

function custom_dynamic_layout_css()
{
	$size = get_option('holmes_content_width', 90);


	$custom_css = "
    @media screen and (min-width: 768px) {
        /* Apply only for tablets and above */
        .content-area {
            width: {$size}% !important;
        }
    }
    ";

	wp_add_inline_style('main-style', $custom_css);

	$radius = get_option('holmes_button_radius', 'curve');

	switch ($radius) {
		case 'rectangle':
			$border_radius = '0px';
			break;
		case 'curve':
			$border_radius = '5px';
			break;
		case 'pill':
			$border_radius = '30px';
			break;
		default:
			$border_radius = '5px';
			break;
	}

	$custom_css .= "
    /* Button styles */
   .added_to_cart, .wc-block-components-button, .wc-block-cart__submit-container, .prevhw, .nexthw, .back_button, .back_button_search, .menu-toggle, .wp-block-button .wp-block-button__link, .comment-form-comment textarea, .submenu_container a , .search-submit,.holmes-button, .search-field, .contactus-button input[type=\"button\"], .navbar ul li,.navbar ul>li a, .search-submit, #scrollTop,.submit[type=\"submit\"] {
        border-radius: {$border_radius} !important;
    }
    ";

	wp_add_inline_style('main-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'custom_dynamic_layout_css');





function holmes_gradient_css()
{

	$gradient_type = get_option('holmes_gradient_css', 'gleaming_grey');

	switch ($gradient_type) {
		case 'gleaming_grey':
			$holmes_gradient_css = 'linear-gradient(to right, #cccccc 0%, #ffffff 50%, #cccccc 100%)';
			break;
		case 'fading_edges':
			$holmes_gradient_css = 'radial-gradient(circle, #ffffff 0%, #cccccc 50%, transparent 100%)';
			break;
		case 'fading_right':
			$holmes_gradient_css = 'linear-gradient(to bottom right, #ffffff 0%, #cccccc 50%, transparent 100%)';
			break;
		case 'stripes':
			$holmes_gradient_css = 'linear-gradient(#dddddd 0%, #dddddd 25%, #cccccc 25%, #cccccc 50%, #dddddd 50%, #dddddd 75%, #cccccc 75%, #cccccc 100%)';
			break;
		case 'left_shade':
			$holmes_gradient_css = 'radial-gradient(circle at 25px 5px, #cccccc 10%, transparent 10%)';
			break;
		case 'waves':
			$holmes_gradient_css = 'repeating-radial-gradient(circle at 10px 5px, #cccccc, #cccccc 20px, transparent 20px, transparent 40px)';
			break;
		case 'small_waves':
			$holmes_gradient_css = 'repeating-radial-gradient(circle at 10px 5px, #cccccc, #cccccc 2px, transparent 2px, transparent 4px)';
			break;
		case 'diagonal_shade':
			$holmes_gradient_css = 'repeating-linear-gradient(15deg, #cccccc, #dddddd 25px)';

			break;
		case 'shades':
			$holmes_gradient_css = 'linear-gradient(to right, #eeeeee, #cccccc, #aaaaaa, #888888, #666666)';
			break;
		case 'none':
			$holmes_gradient_css = '';
			break;
	}

	$custom_css = "
    .submenu_container,
    .footer-copyright,
    .bottom_container,
    .navbar-wrapper {
        background-image: {$holmes_gradient_css} !important;
    }

    ";

	wp_add_inline_style('main-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'holmes_gradient_css');





/* colour section text.*/
function custom_style_settings_section_callback()
{
	echo '<div class="info-box">';
	echo '<h2>Important:</h2>';
	echo '<p class="Other-text">If you change the colours you might not be <a href="https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html" target="_blank">Wcag compliant</a></p>';
	echo '<p class="Other-text">We recommend using a contrast checker tool. </p>';
	echo '</div>';
}


/* layout section text.*/
function custom_layout_settings_section_callback()
{
	echo '<div class="info-box">';
	echo '<h2>Important:</h2>';
	echo '<p class="Other-text">You can effect the button and text input radius here,</p>';
	echo '<p class="Other-text">and the page width</p>';
	echo '</div>';
}


/* colour settings.*/

function custom_style_settings_init()
{
	add_settings_section(
		'style_settings_section',             // Section ID.
		'',                  // Section title.
		'custom_style_settings_section_callback', // Callback function to display the section.
		'style_settings_page'                  // Page slug.
	);

	// gradient css.
	add_settings_field(
		'holmes_gradient_css',
		'Gradient for navbar and footer bar',
		'display_gradient_select',
		'style_settings_page',
		'style_settings_section',
		array('label_for' => 'holmes_gradient_css')
	);

	// layout settings.

	add_settings_section(
		'layout_settings_section',             // Section ID.
		'',                     // Section title.
		'custom_layout_settings_section_callback', // Callback function to display the section.
		'layout_settings_page'                 // Page slug.
	);

	// page size option
	add_settings_field(
		'holmes_content_width',                 // Field ID.
		'Page width',                 // Field label.
		'display_slider',                      // Callback function to display the field.
		'layout_settings_page',              // Page slug.
		'layout_settings_section',           // Section ID.
		array('label_for' => 'holmes_content_width')  // Additional arguments.
	);

	// radius option.
	add_settings_field(
		'holmes_button_radius',
		'Button and text input Radius',
		'display_radius_select',
		'layout_settings_page',
		'layout_settings_section',
		array('label_for' => 'holmes_button_radius')
	);

	// Register settings layout.
	register_setting('layout_settings_group', 'holmes_content_width', 'sanitize_slider_input');
	register_setting('layout_settings_group', 'holmes_button_radius', array('sanitize_callback' => 'sanitize_text_field'));

	// Register settings colour.
	register_setting('style_settings_group', 'holmes_gradient_css', array('sanitize_callback' => 'sanitize_text_field'));
}
add_action('admin_init', 'custom_style_settings_init');


/* slider field.*/
function display_slider($args)
{
	$size = get_option($args['label_for'], 90);

?>
	<div class="slider-container">
		<input type="range" id="<?php echo esc_attr($args['label_for']); ?>" name="<?php echo esc_attr($args['label_for']); ?>" value="<?php echo esc_attr($size); ?>" min="70" max="100" step="10" class="slider">
		<div class="slider-values">
			<?php for ($i = 70; $i <= 100; $i += 10) { ?>
				<span><?php echo esc_html($i); ?></span>
			<?php } ?>
		</div>
	</div>
<?php
}

/* radius field.*/
function display_radius_select($args)
{
	$radius = get_option($args['label_for'], 'curve');

?>
	<div style="display: block; margin-top: 10px;">
		<select id="<?php echo esc_attr($args['label_for']); ?>" name="<?php echo esc_attr($args['label_for']); ?>">
			<option value="rectangle" <?php selected($radius, 'rectangle'); ?>>Rectangle</option>
			<option value="curve" <?php selected($radius, 'curve'); ?>>Curve</option>
			<option value="pill" <?php selected($radius, 'pill'); ?>>Pill</option>
		</select>
		<div class="preview_imageradius">
			<img id="<?php echo esc_attr($args['label_for']); ?>-image" src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/images/' . $radius . '.png'); ?>">
		</div>
	</div>

	<script>
		var dropdown = document.getElementById("<?php echo esc_attr($args['label_for']); ?>");
		var image = document.getElementById("<?php echo esc_attr($args['label_for']); ?>-image");

		dropdown.addEventListener('change', function() {
			var selectedOption = this.options[this.selectedIndex];
			var imagePath = "<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/images/'); ?>" + selectedOption.value + ".png";
			if (imagePath) {
				image.src = imagePath;
				image.style.display = 'inline';
			} else {
				image.style.display = 'none';
			}
		});

		dropdown.dispatchEvent(new Event('change'));
	</script>
<?php
}


/* gradient field.*/
function display_gradient_select($args)
{
	$gradient_type = get_option($args['label_for'], 'gleaming_grey');

?>
	<select id="<?php echo esc_attr($args['label_for']); ?>" name="<?php echo esc_attr($args['label_for']); ?>" onchange="updateGradientImage(this)">
		<option value="gleaming_grey" <?php selected($gradient_type, 'gleaming_grey'); ?>>Gleaming_Grey</option>
		<option value="fading_edges" <?php selected($gradient_type, 'fading_edges'); ?>>Fading_Edges</option>
		<option value="fading_right" <?php selected($gradient_type, 'fading_right'); ?>>Fading_Right</option>
		<option value="stripes" <?php selected($gradient_type, 'stripes'); ?>>Stripes</option>
		<option value="left_shade" <?php selected($gradient_type, 'left_shade'); ?>>Left_Shade</option>
		<option value="waves" <?php selected($gradient_type, 'waves'); ?>>Waves</option>
		<option value="small_waves" <?php selected($gradient_type, 'small_waves'); ?>>Small_Waves</option>
		<option value="diagonal_shade" <?php selected($gradient_type, 'diagonal_shade'); ?>>Diagonal_Shade</option>
		<option value="shades" <?php selected($gradient_type, 'shades'); ?>>Shades</option>
		<option value="none" <?php selected($gradient_type, 'none'); ?>>None</option>
	</select>
	<div class="preview_imagegradient">
		<img id="<?php echo esc_attr($args['label_for']); ?>-image" src="<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/images/' . $gradient_type . '.png'); ?>">
	</div>

	<script>
		function updateGradientImage(select) {
			var image = document.getElementById("<?php echo esc_attr($args['label_for']); ?>-image");
			var imagePath = "<?php echo esc_url(get_template_directory_uri() . '/template-bits/admin/images/'); ?>" + select.value + ".png";
			if (select.value === 'none') {
				image.style.display = 'none';
			} else {
				image.style.display = 'block';
				image.src = imagePath;
			}
		}

		var dropdown = document.getElementById("<?php echo esc_attr($args['label_for']); ?>");
		dropdown.dispatchEvent(new Event('change'));
	</script>
<?php
}
