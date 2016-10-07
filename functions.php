<?php

add_theme_support('custom-logo');

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}

function load_fonts() {
    wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed:400,700|Lato:400,700|Source+Sans+Pro:400,700');
    wp_enqueue_style( 'googleFonts');
}
add_action('wp_print_styles', 'load_fonts');
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
/**
 * Surchage de Lire la suite
 */
function my_child_theme_setup() {
    remove_filter('wp_trim_excerpt', 'all_excerpts_get_more_link');
    add_filter('wp_trim_excerpt', 'maf_all_excerpts_get_more_link');
}
add_action( 'after_setup_theme', 'my_child_theme_setup' );

function maf_all_excerpts_get_more_link($post_excerpt) {
    return $post_excerpt . '...';
}
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
