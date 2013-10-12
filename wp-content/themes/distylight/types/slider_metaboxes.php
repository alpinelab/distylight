<?
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'slider_';

global $slider_meta_boxes;

$slider_meta_boxes = array();

// 1st meta box
$slider_meta_boxes[] = array(
  // Meta box id, UNIQUE per meta box. Optional since 4.1.5
  'id' => 'description',

  // Meta box title - Will appear at the drag and drop handle bar. Required.
  'title' => __( 'Slider', 'rwmb' ),

  // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
  'pages' => array( 'slider'),

  // Where the meta box appear: normal (default), advanced, side. Optional.
  'context' => 'normal',

  // Order of meta box: high (default), low. Optional.
  'priority' => 'high',

  // Auto save: true, false (default). Optional.
  'autosave' => true,

  // List of meta fields
  'fields' => array(
    // IMAGE ADVANCED (WP 3.5+)
    array(
      'name'             => __("Galerie d'images", 'rwmb'),
      'id'               => "{$prefix}gallery",
      'type'             => 'image_advanced',
      'max_file_uploads' => 8,
    )
  )
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function slider_register_meta_boxes()
{
  // Make sure there's no errors when the plugin is deactivated or during upgrade
  if ( !class_exists( 'RW_Meta_Box' ) )
    return;

  global $slider_meta_boxes;
  foreach ( $slider_meta_boxes as $meta_box )
  {
    new RW_Meta_Box( $meta_box );
  }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'slider_register_meta_boxes' );
