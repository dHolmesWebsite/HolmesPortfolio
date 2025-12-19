<?php
add_action('wp_enqueue_scripts', 'hw_child_assets');

function hw_child_assets()
{
    wp_enqueue_style('child-style', get_stylesheet_uri());
}


// woo commerce
function hw_child_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'hw_child_add_woocommerce_support');
