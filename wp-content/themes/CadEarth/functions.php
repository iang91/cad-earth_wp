<?php

/***** BASIC FUNCTIONS *****/

/* CALL STYLES FROM PARENT */
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* CUSTOM JQUERY */
function customjs(){
    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0', true);
    wp_enqueue_script('FontAwesome', 'https://kit.fontawesome.com/d026cab0b6.js', array('jquery'), '', true);    
    // wp_enqueue_script('owlcarouseljs', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'customjs');

/* CUSTOM CSS */
function enqueue_our_required_stylesheets(){
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css'); 
    // wp_enqueue_style('owlcarousel-css', get_stylesheet_directory_uri() . '/css/owl.carousel.min.css'); 
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');


/* CUSTOM PLUGINS */
/*** Duplicate Pages/Posts/CTP ***/
include_once(get_stylesheet_directory() .'/custom-plugins/duplicate-pages.php');


/***** MISCELANEOUS *****/

/*  CHANGE LOGO IN LOGIN */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png); padding-bottom: 30px; width: 100%; height:100px; background-size: contain;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


/***** PRACTICAL SHORTCODES *****/

/* ADD SHORTCODE MENU */
add_filter( 'the_title', function( $title, $item_id ) {
    if ( 'nav_menu_item' === get_post_type( $item_id ) ) {
        return do_shortcode( $title );
    }
    return $title;
}, 10, 2 );

/* CALL MENU BY SHORTCUT BY: [menu name="-your menu name-" class="-your class-"] */
function print_menu_shortcode($atts, $content = null) {
extract(shortcode_atts(array( 'name' => null, 'class' => null ), $atts));
return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');


/* CALL URL SHORTCODE TO AVOID ABSOLUTE LINKS BY: [url] */
function url_shortcode() {
    return get_bloginfo('url');
}
add_shortcode('url','url_shortcode');


/***** DIVI SHORTCODES *****/

//SHORTCODE INSIDE MODULES
function showmodule_shortcode($moduleid) {
    extract(shortcode_atts(array('id' =>'*'),$moduleid)); 
    return do_shortcode('[et_pb_section global_module="'.$id.'"][/et_pb_section]');
}
add_shortcode('showmodule', 'showmodule_shortcode');


/***** WP HIDE ERRORS *****/

/* REMOVE LOGIN ERRORS */
function login_errors_message() {
    return 'Ooooops!';
}
add_filter('login_errors', 'login_errors_message');

/*  REMOVE CRAP FROM HEADER */
remove_action( 'wp_head',             'adjacent_posts_rel_link',       10, 0);
remove_action( 'wp_head',             'feed_links',                    2     );
remove_action( 'wp_head',             'feed_links_extra',              3     );
remove_action( 'wp_head',             'rsd_link'                             );
remove_action( 'wp_head',             'wlwmanifest_link'                     );
remove_action( 'wp_head',             'index_rel_link'                       );
remove_action( 'wp_head',             'parent_post_rel_link',          10, 0 );
remove_action( 'wp_head',             'start_post_rel_link',           10, 0 );
remove_action( 'wp_head',             'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head',             'locale_stylesheet'                    );
remove_action( 'publish_future_post', 'check_and_publish_future_post', 10, 1 );
remove_action( 'wp_head',             'wp_generator'                         );
remove_action( 'wp_footer',           'wp_print_footer_scripts'              );
remove_action( 'wp_head',             'wp_shortlink_wp_head',          10, 0 );
remove_action( 'template_redirect',   'wp_shortlink_header',           11, 0 );


/* DEACTIVATE HTML ON COMMENTS */
add_filter('pre_comment_content', 'wp_specialchars');

/* REMOVE WP VERSION FROM RSS*/
add_filter('the_generator', '__return_empty_string');

/* REMOVE SCRIPTS VERSIONS */
function shapeSpace_remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);