<?php
/**
 * 5 Phút Crypto Clone functions and definitions
 */

if ( ! function_exists( 'fivepc_clone_setup' ) ) :
    function fivepc_clone_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-main' => esc_html__( 'Primary Menu', '5pc-clone' ),
                'menu-footer' => esc_html__( 'Footer Menu', '5pc-clone' ),
            )
        );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'fivepc_clone_setup' );

/**
 * Enqueue scripts and styles.
 */
function fivepc_clone_scripts() {
    // Google Fonts Inter
    wp_enqueue_style( 'fivepc-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );

    // Bootstrap 5 CSS
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0' );

    // Swiper CSS
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), '10.0.0' );

    // Theme Main Stylesheet
    wp_enqueue_style( 'fivepc-style', get_stylesheet_uri(), array( 'bootstrap-css' ), wp_get_theme()->get( 'Version' ) );

    // Bootstrap Bundle JS
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true );

    // Swiper JS
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), '10.0.0', true );

    // Custom Scripts (Marquee & Playlist logic)
    wp_enqueue_script( 'fivepc-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'fivepc_clone_scripts' );
