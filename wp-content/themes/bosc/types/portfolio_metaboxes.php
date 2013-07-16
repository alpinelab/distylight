<?php
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
$prefix = 'portfolio_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'description',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Fiche Projet', 'rwmb' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'portfolio'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(
		// Localisation du projet
		array(
			// Field name - Will be used as label
			'name'  => __( 'Localisation du projet', 'rwmb' ),
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}project_location",
			// Field description (optional)
			'desc'  => __( 'Entrer le lieu où se situe le projet', 'rwmb' ),
			'type'  => 'text',
			// Default value (optional)
			'std'   => __( 'le lieu va là !', 'rwmb' ),
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),
		// Client
		array(
			// Field name - Will be used as label
			'name'  => __( "Maitrise d'ouvrage", 'rwmb' ),
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}project_client",
			// Field description (optional)
			'desc'  => __( 'Nom du client', 'rwmb' ),
			'type'  => 'text',
			// Default value (optional)
			'std'   => __( 'le client va là !', 'rwmb' ),
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),
		// Surface
		array(
			// Field name - Will be used as label
			'name'  => __( "Surface du projet", 'rwmb' ),
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}project_area",
			// Field description (optional)
			'desc'  => __( 'Surface du projet', 'rwmb' ),
			'type'  => 'text',
			// Default value (optional)
			'std'   => __( 'la surface putain!', 'rwmb' ),
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),
		// Coût du projet
		array(
			'name' => __( 'Coût du projet', 'rwmb' ),
			'id'   => "{$prefix}project_cost",
			'type' => 'number',

			'min'  => 0,
			'step' => 10000,
		),
		// Date de réalisation du projet
		array(
			'name' => __( 'Date de réalisation du projet', 'rwmb' ),
			'desc'  => __( "Ne seront affiché que le mois et l'année", 'rwmb' ),
			'id'   => "{$prefix}project_date",
			'type' => 'date',

			// jQuery date picker options. See here http://api.jqueryui.com/datepicker
			'js_options' => array(
				'appendText'      => __( '(dd-mm-yyyy)', 'rwmb' ),
				'dateFormat'      => __( 'dd-mm-yy', 'rwmb' ),
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
		),
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => __( 'Description du projet', 'rwmb' ),
			'id'   => "{$prefix}project_editor",
			'type' => 'wysiwyg',
			// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
			'raw'  => false,
			'std'  => __( 'Hello Bosci!', 'rwmb' ),

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 10,
				'teeny'         => true,
				'media_buttons' => false,
			),
		),
				// IMAGE ADVANCED (WP 3.5+)
		array(
			'name'             => __( "Galerie d'images", 'rwmb' ),
			'id'               => "{$prefix}project_gallery",
			'type'             => 'image_advanced',
			'max_file_uploads' => 8,
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => __( 'Password is required', 'rwmb' ),
				'minlength' => __( 'Password must be at least 7 characters', 'rwmb' ),
			),
		)
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );
