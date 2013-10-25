<?
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package distylight
 */
?><!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
<meta charset="<? bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><? wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<? bloginfo( 'pingback_url' ); ?>">
<link rel="icon" href="<? bloginfo('template_directory') ?>/favicon.png" type="image/png">
<link rel="shortcut icon" href="<? bloginfo('template_directory') ?>/favicon.ico" type="image/x-icon">

<? wp_head(); ?>
<? include_once('google-analytics.php'); ?>
</head>

<body <? body_class(); ?>>
	<? do_action( 'before' ); ?>
	<header class="navigation" role="banner"> <?
		if (is_home() || is_singular('post')) { ?>
			<a class="blog" href="<?= esc_url(home_url('/blog')) ?>" rel="blog">BLOG</a> <?
		} ?>
		<a class="brand" href="<? echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<h1><img src="<? bloginfo('template_directory') ?>/images/logo.svg" alt="<? bloginfo( 'name' ); ?>"></h1>
		</a>

		<? wp_nav_menu(array(
			'theme_location' 	=> 'primary',
      'container'  => false,
      'before' => '<h2>',
      'after' => '</h2>'
	  )); ?>
	</header>

	<div id="primary" class="content-area container">
	  <div id="content" class="site-content" role="main">
