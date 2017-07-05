<?php
add_action('wp_head', 'tracker_mailchimp');

function tracker_mailchimp()
{
?>
    <script type="text/javascript">
    var $mcGoal = {'settings':{'uuid':'f734e235a937fbb3234f8b4a3','dc':'us9'}};
    (function() {
        var sp = document.createElement('script'); sp.type = 'text/javascript'; sp.async = true; sp.defer = true;
        sp.src = ('https:' == document.location.protocol ? 'https://s3.amazonaws.com/downloads.mailchimp.com' : 'http://downloads.mailchimp.com') + '/js/goal.min.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sp, s);
})(); 
</script>
<?php
}

add_theme_support('custom-logo');

function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    // Get the theme data
    $the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}

function load_fonts()
{
    wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Lato:400,700|Source+Sans+Pro:400,700|Montserrat:400,700');
    wp_enqueue_style('googleFonts');
}
add_action('wp_print_styles', 'load_fonts');
function custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');
/**
 * Surchage de Lire la suite
 */
function my_child_theme_setup()
{
    remove_filter('wp_trim_excerpt', 'all_excerpts_get_more_link');
    add_filter('wp_trim_excerpt', 'maf_all_excerpts_get_more_link');
}
add_action('after_setup_theme', 'my_child_theme_setup');

function maf_all_excerpts_get_more_link($post_excerpt)
{
    return $post_excerpt . '...';
}
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

// Hook Woocomerce pour le footer
function action_woocommerce_after_main_content($woocommerce_output_content_wrapper_end)
{
    echo '</div></div></div>';
}
add_action('woocommerce_after_main_content', 'action_woocommerce_after_main_content', 10);

// Hook title category
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    }
    return $title;
});

// Sidebar footer
add_action('widgets_init', 'theme_slug_widgets_init');

function theme_slug_widgets_init()
{
    register_sidebars(3, [
        'name' => 'Partie n°%d du footer',
        'id' => 'maf_footer',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
}

// Sidebar supprimé suite migration
register_sidebar( array(
    'name'          => __( 'Sidebar', 'understrap' ),
    'id'            => 'sidebar-1',
    'description'   => 'Sidebar widget area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
) );


/*
 * Custom login page
 */
function my_login_logo_css() { ?>
    <style type="text/css">
    #login h1 img {
        width: 100%;
    }
    #login {
        padding-top: 4% !important;
    }
    form#loginform{
        border: 5px solid #fd5d83; 
    }
    body {
        background: #23475b !important;
    }
    .login #backtoblog a, .login #nav a, .login h1 a {
        color: white !important;
    }
    .login.wp-core-ui .button-primary ,
    .login.wp-core-ui .button-primary:hover{
        background: #fc2b5c;
        border-color: #fc2b5c;
        text-shadow: none;
        box-shadow: none;
    }
    #woo-slg-social-container-login legend ,
    #woo-slg-social-container-login a{
        color: white;
    }
    </style>
<?php 
}
add_action( 'login_enqueue_scripts', 'my_login_logo_css' );

// Défini à 640px dans le parent
$content_width = 1024;
