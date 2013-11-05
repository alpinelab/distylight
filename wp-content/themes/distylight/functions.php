<?

/**
* POUR APPELER TOUS LES ELEMENTS CUSTOM DANS LE DOSSIER TYPES
*/
require_once(ABSPATH.'wp-content/themes/distylight/types/require.php');


/**
 * Admin panel customization
 */
require_once(ABSPATH.'wp-content/themes/distylight/custom-admin.php');


/**
 * distylight functions and definitions
 *
 * @package distylight
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'distylight_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function distylight_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on distylight, use a find and replace
	 * to change 'distylight' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'distylight', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'distylight' ),
	) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'distylight_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // distylight_setup
add_action( 'after_setup_theme', 'distylight_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function distylight_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar (blog)', 'distylight' ),
		'id'            => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>'
	) );
}
add_action( 'widgets_init', 'distylight_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function distylight_scripts() {

	wp_enqueue_style( 'distylight-style', get_stylesheet_uri() );
	wp_enqueue_style( 'twitter-bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css' );
	wp_enqueue_style( 'twitter-bootstrap-responsive', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.min.css' );

	wp_deregister_script('jquery');
	wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), '1.10.2', false);
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'application', get_bloginfo('template_directory') . '/js/application.js', array('jquery'), '', true );

	wp_enqueue_script( 'twitter-bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js', array('jquery'), '2.3.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'distylight_scripts' );

/**
 * Disable the admin bar when viewing the site as an administrator
 */
// add_filter( 'show_admin_bar', '__return_false' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions used on the team page to find team members avatars
 */
function get_team_member_avatar_url($slug, $size) {
  $attachments = get_posts(array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_mime_type' => 'image',
    'name' => 'team-'.$slug
  ));
  $avatar = array_shift($attachments);
  return $avatar ? wp_get_attachment_image_src($avatar->ID, $size) : '';
}

function the_team_member_avatar($slug) {
  $image = get_team_member_avatar_url($slug, 'thumbnail');
  echo "<img src=\"{$image[0]}\" width=\"{$image[1]}\" height=\"{$image[2]}\">";
}

function the_portfolio_url() {
  $attachments = get_posts(array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'name' => 'portfolio'
  ));
  $portfolio = array_shift($attachments);
  echo $portfolio ? wp_get_attachment_url($portfolio->ID) : 'ERROR';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

