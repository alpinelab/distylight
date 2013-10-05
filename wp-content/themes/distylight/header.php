<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package distylight
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>
	<header class="navbar navbar-fixed-top navbar-inverse" role="banner">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>

				<?php wp_nav_menu(array(
					'theme_location' 	=> 'primary',
	        'container'  => false,
  	      'menu_class' => 'nav'
    	  )); ?>
    	 </div>
		</div>
	</header>

	<div class="container-fluid">
		<div id="main" class="site-main row-fluid">
