<?
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<? $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<? echo esc_url( home_url( '/' ) ); ?>" title="<? echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<? header_image(); ?>" width="<? echo get_custom_header()->width; ?>" height="<? echo get_custom_header()->height; ?>" alt="" />
		</a>
	<? } // if ( ! empty( $header_image ) ) ?>

 *
 * @package distylight
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses distylight_header_style()
 * @uses distylight_admin_header_style()
 * @uses distylight_admin_header_image()
 *
 * @package distylight
 */
function distylight_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'distylight_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'distylight_header_style',
		'admin-head-callback'    => 'distylight_admin_header_style',
		'admin-preview-callback' => 'distylight_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'distylight_custom_header_setup' );

if ( ! function_exists( 'distylight_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see distylight_custom_header_setup().
 */
function distylight_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<? echo $header_text_color; ?>;
		}
	<? endif; ?>
	</style>
	<?
}
endif; // distylight_header_style

if ( ! function_exists( 'distylight_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see distylight_custom_header_setup().
 */
function distylight_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?
}
endif; // distylight_admin_header_style

if ( ! function_exists( 'distylight_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see distylight_custom_header_setup().
 */
function distylight_admin_header_image() {
	$style        = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$header_image = get_header_image();
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<? echo $style; ?> onclick="return false;" href="<? echo esc_url( home_url( '/' ) ); ?>"><? bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<? echo $style; ?>><? bloginfo( 'description' ); ?></div>
		<? if ( ! empty( $header_image ) ) : ?>
			<img src="<? echo esc_url( $header_image ); ?>" alt="" />
		<? endif; ?>
	</div>
<?
}
endif; // distylight_admin_header_image
