<?php
/**
 * Template Name: Portfolio
 *
 * @package bosc
 */

get_header(); ?>
<div class="container-fluid">
  <div class="row-fluid filter-options">
    <div class="span12">
      <?php
      $terms = get_terms('portfolio_category');
      $count = count($terms); $i=0;
      if ($count > 0) {
        echo '<h5>genres</h5>';
        echo '<button class="btn btn-link" data-filter-value=""><span>All</span></button>';
        foreach ($terms as $term) {
          $term_link = get_term_link($term, 'species');
          if(is_wp_error($term_link))
            continue;
          //We successfully got a link. Print it out.
          echo '<button class="btn btn-link" data-filter-value="'.$term->name.'"><span>'.$term->name.'</span></button>';
        }
      }
      ?>
    </div>
  </div>
</div>
<div id="projects-grid" class="container">
  <?php
  $args = array('post_type' => 'portfolio');
  $posts = get_posts($args);
  foreach ($posts as $post) : setup_postdata($post);
    $images = rwmb_meta( 'portfolio_project_gallery', 'type=image&size=portfolio_thumbnail');
      foreach($images as $image)
      {
        $filter = null;
        $terms = get_the_terms($post->ID, 'portfolio_category');
        if ($terms && !is_wp_error($terms))
        {
          $terms_tab = array();
          foreach ($terms as $term) {
            $terms_tab[] = '"'.$term->name.'"';
          }
          $filter = join(", ", $terms_tab);
        }?>

        <div class="span3 picture-item" data-groups='[<?php echo $filter; ?>]'>
          <a href="<?php the_permalink(); ?>" >
            <?php echo "<img src='{$image['url']}'  alt='{$image['alt']}'/>"; ?>
            <?php echo the_title(); ?>
          </a>
          <p>Genres: <span><?php echo $filter; ?></span></p>
        </div>
        <?php
        break;
      }
  endforeach; ?>
  <div class="span3 shuffle__sizer"></div>
</div>

<?php get_footer(); ?>
