<?php

/**
* POUR APPELER LE CUSTOM POST TYPE PORTFOLIO
*/
require_once(ABSPATH.'wp-content/themes/bosc/types/portfolio.php');

/**
* POUR APPELER LE CUSTOM METABOXES
*/
require_once(ABSPATH.'wp-content/themes/bosc/types/portfolio_metaboxes.php');

/**
* POUR CREER DES TAILLES IMAGES PERSOS
*/

if ( function_exists( 'add_image_size' ) )
	add_image_size( 'portfolio_thumbnail', 300, 250, true);