<?

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
  add_image_size('distylight-thumbnail',        384,  240,  true);
  add_image_size('distylight-thumbnail-square', 384,  384,  true);
  add_image_size('distylight-small',            1280, 800,  true);
  add_image_size('distylight-normal',           1680, 1050, true);
  add_image_size('distylight-large',            1920, 1200, true);
}