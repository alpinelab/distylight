<?php

add_action('manage_edit-portfolio_columns', 'portfolio_column_filter');
add_action('manage_posts_custom_column', 'portfolio_column');

// add a column to display thumbnail on admin panel.
function portfolio_column_filter($columns){
  $thumb = array('thumbnail' => 'Image');
  $columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns, 1, null);
  return $columns;
}

function portfolio_column($column)
{
  global $post;
  if($column == 'thumbnail'){
    $images = rwmb_meta( 'portfolio_project_gallery', 'type=image');
    foreach($images as $image){
        echo edit_post_link("<img src='{$image['url']}'  alt='{$image['alt']}'/>",null, null, $post->ID);
        break;
    }
  }
}


function register_portfolio() {
  $labels = array(
//Les noms qui apparaisssnt dans le Back-Office de Wordpress

    'name' => 'Projects',
    'singular_name' => 'Project',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Project',
    'edit_item' => 'Edit Project',
    'new_item' => 'New Project',
    'all_items' => 'All Projects',
    'view_item' => 'View Project',
    'search_items' => 'Search Projects',
    'not_found' =>  'No projects found',
    'not_found_in_trash' => 'No projects found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Projects'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title')
  );

  register_post_type( 'portfolio', $args );
}
add_action( 'init', 'register_portfolio' );

// register_taxonomy( 'type', 'portfolio', array( 'hierarchical' => true, 'label' => 'Type', 'query_var' => true, 'rewrite' => true ) );


// hook into the init action and call create_portfolio_taxonomies when it fires
add_action( 'init', 'create_portfolio_taxonomies', 0 );

// create a taxonomy, genre for the post type "portfolio"
function create_portfolio_taxonomies()
    {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'parent_item'       => __( 'Parent Genre' ),
        'parent_item_colon' => __( 'Parent Genre:' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio_category' ),
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
    }
?>