<?php

/**
 * Theme Name: holmesportfolio
 * Theme URI: https://holmesportfolio.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://holmesportfolio.co.uk/
 * Requires PHP: 8
 * Tested up to: 6.5
 * Version: 5
 * License: holmesportfolio Commercial License
 * License URI: https://holmesportfolio.co.uk/hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */



function wp_maintenance_mode() {
if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
$logo_url = esc_url(get_template_directory_uri() . '/template-bits/admin/holmesportfolio-logo.jpg');
wp_die(
    '<h1>Under Maintenance</h1>
    <p>Our website is changing,<br>
    <img src="' . $logo_url . '" alt="Holmesportfolio logo" style="width:200px;height:auto;"><br>
    Please check back. Target date 10/2/2026</p>',
    'Maintenance',
    array(
        'title'    => 'Maintenance', 
        'response' => 503,
    )
);
}
}
add_action('get_header', 'wp_maintenance_mode');



if (! function_exists('holmes_setup')) {
	function holmes_setup()
	{

		$theme_text_domain = 'holmesportfolio';
		load_theme_textdomain($theme_text_domain, get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('wp-block-styles');
		add_editor_style('style.css');

		function custom_theme_support()
		{
			add_theme_support(
				'meta-boxes',
				array(
					'post',
					'page',

				)
			);
		}
		add_action('after_setup_theme', 'custom_theme_support');

		add_theme_support('responsive-embeds');
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);

		// remove pages from the search

		function remove_page_search_hw($query)
		{
			if ($query->is_search && ! is_admin()) {
				$exclude_ids = array(
					8,   // home
					302, // accessibility-statement
					3, // privacy-policy
					23, // terms-and-conditions
					349, // essential-tools
					347,  // enhancing-accessibility
					602,  // Mega-Menu
					31,  // Theme set-up
					249,  // Report an accessibility issue
					733,  // CR
					27 //posts
				);
				$query->set('post__not_in', $exclude_ids);
			}
			return $query;
		}
		add_filter('pre_get_posts', 'remove_page_search_hw');

		// Spam protection
		add_filter('wpcf7_validate_text*', 'custom_verification_validation_filter', 20, 2);
		add_filter('wpcf7_spam', 'check_hidden_field');

		function custom_verification_validation_filter($result, $tag)
		{
			$name = $tag->name;

			if ($name == 'verification') {
				$value    = isset($_POST[$name]) ? trim($_POST[$name]) : '';
				$question = isset($_POST['question-field']) ? trim($_POST['question-field']) : '';

				// List of questions and answers
				$questions_answers = array(
					'What colour is the sky on a clear day? (required)' => 'blue',
					'What is the sum of 2 + 2? (required)' => '4',
					'What is the capital of France? (required)' => 'paris',
				);

				// Verify the answer
				if (isset($questions_answers[$question]) && strtolower($value) !== strtolower($questions_answers[$question])) {
					$result->invalidate($tag, 'The answer to the verification question is incorrect.');
				}
			}

			return $result;
		}

		function check_hidden_field($spam)
		{
			if (! empty($_POST['hidden-field'])) {
				$spam = true;
			}
			return $spam;
		}

		// End spam

		// Theme homepage (future improvement /home1 can be removed? not sure on purpose)
		function import_single_page()
		{
			$theme_page_file = get_template_directory() . '/home1.php';

			$existing_page_query = new WP_Query(
				array(
					'post_type'      => 'page',
					'post_status'    => 'publish',
					'posts_per_page' => 1,
					'title'          => 'Home',
				)
			);

			if (file_exists($theme_page_file)) {
				$page_content = file_get_contents($theme_page_file);

				// if the "Home" page exists, do nothing
				if ($existing_page_query->have_posts()) {
					$existing_page_query->the_post();
					$existing_page_id = get_the_ID();
				} else {
					// Create a new "Home" page
					$new_page = array(
						'post_title'   => 'Home',
						'post_content' => $page_content,
						'post_status'  => 'publish',
						'post_type'    => 'page',
					);

					$page_id = wp_insert_post($new_page);

					if ($page_id) {
						update_option('page_on_front', $page_id);
						update_option('show_on_front', 'page');
					}
				}

				// Reset post data
				wp_reset_postdata();
			}
			$args = array(
				'width'       => 1200,
				'height'      => 280,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => false,
			);

			// Add theme support for custom headers
			add_theme_support('custom-header', $args);

			add_theme_support('align-wide');
		}
		add_action('after_setup_theme', 'custom_theme_setup');

		// post bits

		function hw_excerpt_length($length)
		{
			return 20;
		}
		add_filter('excerpt_length', 'hw_excerpt_length');

		function hw_excerpt_more($more)
		{
			global $post;

			return '... <p class="hw-read-more">Read about ' . get_the_title($post->ID) . '</p>';
		}
		add_filter('excerpt_more', 'hw_excerpt_more');

		// post bits

		function custom_search_button($form)
		{
			$form = '<form method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
			<label class="screen-reader-text" for="s">' . esc_html__('Search for:', 'holmesportfolio') . '</label>
			<input type="text" placeholder="Search" value="' . get_search_query() . '" name="s" id="s" class="search-field" />
			<button type="submit" id="searchsubmit" class="submit search-submit" aria-label="Search">
				<span class="search-icon"></span>
			</button>
			</form>';
			return $form;
		}

		add_filter('get_search_form', 'custom_search_button');

		function display_welcome_notice()
		{
			echo '<div class="notice notice-success is-dismissible">';
			echo '<p>Welcome to your new home, get started by visiting the  
    <a href="admin.php?page=main-admin">Admin page</a>.</p>';
			echo '</div>';

			update_option('theme_activated', '1');
		}

		add_action('after_switch_theme', 'import_single_page');
		add_action('after_switch_theme', 'display_welcome_notice');

		// valid HTML5
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		//bread crumbs
		function holmes_breadcrumbs()
		{
			if (!is_front_page()) {
				global $post;


				if (is_category() || is_single()) {
					echo '<nav class="breadcrumbs">';
					echo '<a href="' . home_url() . '">Home</a> &raquo; ';
					the_category(' &raquo; ');
					if (is_single()) {
						echo ' &raquo; ';
						the_title();
					}
					echo '</nav>';
				} elseif (is_page()) {
					$ancestors = get_post_ancestors($post);

					// Show breadcrumbs if more than 1 parent
					if (count($ancestors) > 1) {
						echo '<nav class="breadcrumbs">';
						echo '<a href="' . home_url() . '">Home</a> &raquo; ';


						$breadcrumbs = array();
						foreach (array_reverse($ancestors) as $ancestor_id) {
							$breadcrumbs[] = '<a href="' . get_permalink($ancestor_id) . '">' . get_the_title($ancestor_id) . '</a>';
						}

						echo implode(' &raquo; ', $breadcrumbs);
						echo ' &raquo; ' . get_the_title();
						echo '</nav>';
					}
				}
			}
		}


		// refresh widgets
		add_theme_support('customize-selective-refresh-widgets');

		// custom logo support
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// add post support
		add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

		// add theme support menus
		register_nav_menus(
			array(
				'primary' => __('Primary Menu', 'holmesportfolio'),
			)
		);

		add_action('customize_register', 'holmes_customize_register');
	}
}

function enqueue_comment_reply_script()
{
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_comment_reply_script');




// woo commerce

function holmes_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'holmes_add_woocommerce_support');



// Remove automatic <p> tags around images
function remove_ptags_around_images($content)
{
	// Remove <p> tags around images
	$content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	// Remove empty <p> tags
	$content = preg_replace('/<p>(\s|&nbsp;)*<\/p>/i', '', $content);
	return $content;
}
add_filter('the_content', 'remove_ptags_around_images');

function holmes_register_sidebar_widgets()
{
	// Footer widgets
	register_sidebar(
		array(
			'name'          => esc_html__('Footer widgets', 'holmesportfolio'),
			'id'            => 'footer-widgets',
			'description'   => esc_html__('Widgets in this area will be displayed in the footer, a good use is recent posts or menu links', 'holmesportfolio'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action('widgets_init', 'holmes_register_sidebar_widgets');

function holmes_customize_register($wp_customize)
{
	// Remove setting and control for displaying site title and tagline
	$wp_customize->remove_control('display_header_text');
}
add_action('after_setup_theme', 'holmes_setup');


// error messages & files

function enqueue_admin_styles()
{
	$admin_variables_css = get_template_directory() . '/assets/css/variables.css';
	$error_messages      = array();

	if (file_exists($admin_variables_css)) {
		wp_enqueue_style('admin-variables-style', get_template_directory_uri() . '/assets/css/variables.css', array(), '1.0.1', 'all');
	} else {
		$error_messages[] = 'Error: Admin variables CSS file not found.';
	}

	if (! empty($error_messages)) {
		echo '<div class="error-messages">';
		foreach ($error_messages as $error_message) {
			echo '<div class="error-message">' . $error_message . '</div>';
		}
		echo '</div>';
	}
}

add_action('admin_enqueue_scripts', 'enqueue_admin_styles');


function holmes_enqueue_scripts_and_styles()
{
	$main_css          = get_template_directory() . '/assets/css/main.css';
	$megamenu_css      = get_template_directory() . '/assets/css/mega-menu.css';
	$megamenu_js       = get_template_directory() . '/assets/js/mega-menu.js';
	$main_js           = get_template_directory() . '/assets/js/main.js';
	$custom_comment_js = get_template_directory() . '/assets/js/custom-comment.js';
	$error_messages    = array();

	if (file_exists($megamenu_css)) {
		wp_enqueue_style('mega-menu-css', get_template_directory_uri() . '/assets/css/mega-menu.css', array(), '1.0.3', 'all');
	} else {
		$error_messages[] = 'Error: MegaMenu CSS file not found.';
	}

	if (file_exists($megamenu_js)) {
		wp_enqueue_script('mega-menu-js', get_template_directory_uri() . '/assets/js/mega-menu.js', array('jquery'), '1.0.1', true);
	} else {
		$error_messages[] = 'Error: MegaMenu JS file not found.';
	}

	if (file_exists($main_css)) {
		wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.3', 'all');
	} else {
		$error_messages[] = 'Error: Main CSS file not found.';
	}

	if (file_exists($main_js)) {
		wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.1', true);
	} else {
		$error_messages[] = 'Error: Main JS file not found.';
	}

	if (file_exists($custom_comment_js)) {
		wp_enqueue_script('custom-comment', get_template_directory_uri() . '/assets/js/custom-comment.js', array('jquery'), null, true);
	} else {
		$error_messages[] = 'Error: Custom comment JS file not found.';
	}

	if (! empty($error_messages)) {
		echo '<div class="error-messages">';
		foreach ($error_messages as $error_message) {
			echo '<div class="error-message">' . $error_message . '</div>';
		}
		echo '</div>';
	}
}
add_action('wp_enqueue_scripts', 'holmes_enqueue_scripts_and_styles');


require_once get_template_directory() . '/template-bits/admin/footer-header-settings.php';
require_once get_template_directory() . '/template-bits/admin/colour-settings.php';
require_once get_template_directory() . '/template-bits/admin/my-admin.php';

// hiding the page heading
function custom_hide_heading_meta_box()
{
	// Check if the current user is admin
	add_meta_box(
		'custom-hide-heading',
		__('Hide Page Heading', 'holmesportfolio'),
		'custom_render_hide_heading_meta_box',
		'page',
		'side',
		'default'
	);
}

add_action('add_meta_boxes', 'custom_hide_heading_meta_box');

// hide page heading
function custom_render_hide_heading_meta_box($post)
{
	$value = get_post_meta($post->ID, '_hide_heading', true);
?>
	<label for="hide-heading">
		<input type="checkbox" id="hide-heading" name="hide-heading" <?php checked(strval($value), 'on'); ?>>
		<?php _e('Hide page heading', 'holmesportfolio'); ?>
	</label>
<?php
}

// Save option
function custom_save_hide_heading_meta_box($post_id)
{
	if (isset($_POST['hide-heading'])) {
		update_post_meta($post_id, '_hide_heading', 'on');
	} else {
		delete_post_meta($post_id, '_hide_heading');
	}
}
add_action('save_post', 'custom_save_hide_heading_meta_box');

// remove settings

function remove_holmes_settings_on_switch($new_theme)
{

	if ($new_theme !== 'holmesportfolio' && ! get_option('holmes_savetheme')) {
		delete_option('holmes_hide_search_bar');
		delete_option('holmes_hide_slogan');
		delete_option('holmes_menu_option');
		delete_option('holmes_social_settings');
		delete_option('holmes_policy_settings');
		delete_option('holmes_footer_settings');
		delete_option('theme_mods_holmesportfolio');
		delete_option('holmes_theme_colour');
		delete_option('holmes_gradient_css');
		delete_option('holmes_content_width');
		delete_option('holmes_button_radius');
		delete_option('holmes_savetheme');
		delete_option('holmes_social_icon_style');
		delete_option('theme_mods_holmesportfolio-child');
	}
}
add_action('switch_theme', 'remove_holmes_settings_on_switch');

?>