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


$page_id      = get_queried_object_id();
$page_title   = get_the_title($page_id);
$hide_heading = get_post_meta(get_queried_object_id(), '_hide_heading', true);

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php if (! $hide_heading) : ?>
			<header class="entry-header">
				<?php
				if ($page_title) {
					echo '<h1 class="page-title">' . esc_html($page_title) . '</h1>';
				}
				?>
			</header>
		<?php endif; ?>
		<div class="center-items">
			<form method="get" class="search-form" action="">
				<label class="screen-reader-text" for="s">
					<?php echo esc_html__('Search for:', 'holmesportfolio'); ?>
				</label>
				<input type="text" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-field" />

				<button type="submit" id="searchsubmit" class="submit search-submit" aria-label="<?php esc_attr_e('Search', 'holmesportfolio'); ?>">
					<span class="search-icon"></span>
				</button>
			</form>


			<form class="post-filter-form" method="get">
				<label for="filter-category" class="filtertypes">Filter:</label>
				<?php
				$selected_category = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
				$categories = get_terms(
					array(
						'taxonomy'   => 'category',
						'hide_empty' => true,
					)
				);

				if (! empty($categories) && ! is_wp_error($categories)) {
					echo '<select name="cat" id="filter-category" class="filtertypes">';
					echo '<option value="">Select a category</option>';
					foreach ($categories as $category) {
						echo '<option value="' . esc_attr($category->term_id) . '"' . selected($selected_category, $category->term_id, false) . '>' . esc_html($category->name) . '</option>';
					}
					echo '</select>';
				}
				?>
				<button type="submit" class="submit">Apply Filter</button>
			</form>
		</div>
		<?php
		if (have_posts()) :
			echo '<div class="posts-grid">';

			while (have_posts()) : the_post();
				get_template_part('template-bits/post/content', get_post_format());
			endwhile;

			echo '</div>';

		?>

		<?php

		else :
			get_template_part('template-bits/page/content', 'none');
		endif;
		?>
	</main>
	<div class="pagination-wrapper">
		<?php
		echo wp_kses_post(paginate_links([
			'prev_txt' => __('« Previous', 'holmesportfolio'),
			'next_txt' => __('Next »', 'holmesportfolio'),
		]));
		?>
	</div>
</div>
<?php
get_footer();
?>