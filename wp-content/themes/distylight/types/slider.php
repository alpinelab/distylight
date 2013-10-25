<?

add_action('manage_edit-slider_columns', 'slider_column_filter');
add_action('manage_posts_custom_column', 'slider_column');

// add a column to display thumbnail on admin panel.
function slider_column_filter($columns){
  $thumb = array('thumbnail' => 'Image');
  $columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns, 1, null);
  return $columns;
}

function slider_column($column)
{
  global $post;
  if($column == 'thumbnail'){
    $images = rwmb_meta( 'slider_gallery', 'type=image', $post->ID);
    foreach($images as $image){
        echo edit_post_link("<img src='{$image['url']}'  alt='{$image['alt']}'/>",null, null, $post->ID);
        break;
    }
  }
}

function register_slider(){

  $labels = array(
    'name' => 'Slide',
    'singular_name' => 'Slide',
    'add_new' => 'Add a Slide',
    'add_new_item' => 'Add a new Slide',
    'edit_item' => 'Edit Slide',
    'new_item' => 'New Slide',
    'all_items' => 'All Slides',
    'view_item' => 'View Slide',
    'search_items' => 'Search Slides',
    'not_found' =>  'No slide found',
    'not_found_in_trash' => 'No slide found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Slides'
  );

  $args = array(
    'public' => true,
    'publicly_queryable' => false,
    'labels' => $labels,
    'menu_position' => 4,
    'capability_type' => 'post',
    'supports' => array('title')
  );

  register_post_type('slider', $args);
}

add_action('init', 'register_slider');

function display_slider() {
  $args = array('post_type' => 'slider', 'numberposts' => 1);
  $slides = get_posts($args);
  if ($slides) {
    $images = rwmb_meta('slider_gallery', 'type=image&size=distylight-large', $slides[0]->ID); ?>

    <ul class="codrops-slideshow"> <?

    foreach($images as $image) { ?>
      <li>
        <span class="image-placeholder" style="background-image: url('<?= $image['url'] ?>')"></span>
      </li> <?
    } ?>
    </ul> <?
  }
}

?>