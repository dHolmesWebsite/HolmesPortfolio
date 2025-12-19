<?php

/**
 * Template Name: Category types
 */
?>
<?php
get_header();

$page_slug = get_post_field('post_name', get_post());
$category_name = sanitize_title($page_slug);

$search_term = isset($_GET['custom_search']) ? sanitize_text_field($_GET['custom_search']) : '';
$tag_filter = isset($_GET['custom_tag']) ? sanitize_text_field($_GET['custom_tag']) : '';

$args = [
    'post_type' => 'post',
    'posts_per_page' => 10,
    'category_name' => $category_name,
];

if (!empty($search_term)) {
    $args['s'] = $search_term;
}

if (!empty($tag_filter)) {
    $args['tag'] = $tag_filter;
}

$custom_query = new WP_Query($args);
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <button class="back_button_search" onclick="window.history.back()">Back</button>
        <div class="center-items">
            <form method="get" class="search-form" action="">
                <label class="screen-reader-text" for="custom_search"><?php echo esc_html__('Search for:', 'holmesportfolio'); ?></label>
                <input type="text" placeholder="Search" value="<?php echo esc_attr($search_term); ?>" name="custom_search" id="custom_search" class="search-field" />

                <button type="submit" id="searchsubmit" class="submit search-submit" aria-label="<?php esc_attr_e('Search', 'holmesportfolio'); ?>">
                    <span class="search-icon"></span>
                </button>
            </form>
        </div>

        <?php if ($custom_query->have_posts()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>

                <?php
                $description = category_description();
                if (!empty($description)) {
                    echo '<div class="archive_description">' . wp_kses_post($description) . '</div>';
                }
                ?>
            </header>

            <div class="posts-grid">
                <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
                            <div class="post-card-inner">
                                <header class="entry-header">
                                    <h2 class="entry-title">Title: <?php echo esc_html(get_the_title()); ?></h2>
                                    <div class="entry-date">
                                        <?php esc_html_e('Date posted:', 'holmesportfolio'); ?> <?php echo esc_html(get_the_date()); ?>
                                    </div>
                                </header>

                                <div class="post_content">
                                    <?php if (has_post_thumbnail()) :
                                        $alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>
                                        <div class="post-thumbnail">
                                            <?php the_post_thumbnail('medium', ['alt' => esc_attr($alt_text)]); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>

                                <div class="entry-footer">
                                    <?php
                                    $tags = get_the_tags();
                                    if ($tags) :
                                    ?>
                                        <div class="entry-tags">
                                            <span><?php esc_html_e('Tags:', 'holmesportfolio'); ?></span>
                                            <?php
                                            $tag_links = [];
                                            foreach ($tags as $tag) {
                                                $tag_links[] = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                                            }
                                            echo implode(', ', $tag_links);
                                            ?>
                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination-wrapper">
                <?php
                echo wp_kses_post(paginate_links([
                    'prev_text' => __('« Previous', 'holmesportfolio'),
                    'next_text' => __('Next »', 'holmesportfolio'),
                ]));
                ?>
            </div>

        <?php else : ?>
            <div class="posts-grid">
                <article class="post-card no-posts-found">
                    <header class="entry-header">
                        <h2 class="entry-title">No Posts Found</h2>
                    </header>
                    <div class="entry-summary">
                        <p>It looks like there are no posts available here yet. Please check back later.</p>
                    </div>
                </article>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </main>
</div>

<?php get_footer(); ?>