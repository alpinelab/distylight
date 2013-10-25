<?
/**
 * Template Name: Portfolio
 *
 * @package distylight
 */

$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy'));

get_header(); ?>

<div id="projects-grid">
  <?
  $args = array('post_type' => 'portfolio', 'posts_per_page' => -1);
  if ($term)
    $args['portfolio-category'] = $term->slug;
  $posts = get_posts($args);
  $idx = 0;
  foreach ($posts as $post) {

    if ($idx % 4 == 0) { ?>
      <div class="row"><?
    } ?>

    <div class="span3">
      <a href="<? the_permalink(); ?>"><?
        if (has_post_thumbnail())
          the_post_thumbnail('distylight-thumbnail-square', array('alt' => get_the_title()));
        else {
          $image = array_shift(rwmb_meta( 'portfolio_project_gallery', 'type=image&size=distylight-thumbnail-square'));
          if ($image) ?>
            <img src="<? echo $image['url'] ?>" alt="<? the_title() ?>"> <?
        } ?>
      </a>
    </div><?

    if ($idx % 4 == 3) { ?></div><? }

    $idx++;

  } ?>
</div>

<? get_footer(); ?>
