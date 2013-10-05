<?php

/**
* POUR APPELER LE CUSTOM POST TYPE PORTFOLIO
*/
require_once(ABSPATH.'wp-content/themes/distylight/types/portfolio.php');

/**
* POUR APPELER LE CUSTOM METABOXES PORTFOLIO
*/
require_once(ABSPATH.'wp-content/themes/distylight/types/portfolio_metaboxes.php');


/**
* POUR APPELER LE CUSTOM POST TYPE SLIDER
*/
require_once(ABSPATH.'wp-content/themes/distylight/types/slider.php');

/**
* POUR APPELER LE CUSTOM METABOXES SLIDER
*/
require_once(ABSPATH.'wp-content/themes/distylight/types/slider_metaboxes.php');

/**
* POUR CREER DES TAILLES IMAGES PERSOS
*/

if (function_exists('add_image_size'))
{
  add_image_size('slider-small',        1280, 800,  true);
  add_image_size('slider-normal',       1680, 1050, true);
  add_image_size('slider-large',        1920, 1200, true);
  add_image_size('portfolio_thumbnail', 300,  250,  true);
}