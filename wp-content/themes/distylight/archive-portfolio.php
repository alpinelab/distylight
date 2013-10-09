<?php
/**
 * Template Name: Portfolio
 *
 * @package distylight
 */

$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy'));

get_header(); ?>

<div id="projects-grid">
  <?php
  $args = array('post_type' => 'portfolio', 'posts_per_page' => -1);
  if ($term)
    $args['portfolio-category'] = $term->slug;
  $posts = get_posts($args);
  $idx = 0;
  foreach ($posts as $post) {

    if ($idx % 4 == 0) { ?>
      <div class="row"><?php
    } ?>

    <div class="span3">
      <a href="<?php the_permalink(); ?>"><?php
        if (has_post_thumbnail())
          the_post_thumbnail('portfolio-thumbnail-square', array('alt' => get_the_title()));
        else {
          $image = array_shift(rwmb_meta( 'portfolio_project_gallery', 'type=image&size=portfolio-thumbnail-square'));
          if ($image) ?>
            <img src="<?php echo $image['url'] ?>" alt="<?php the_title() ?>"> <?php
        } ?>
      </a>
    </div><?php

    if ($idx % 4 == 3) { ?></div><?php }

    $idx++;

  } ?>
</div>

<?php get_footer(); ?>
