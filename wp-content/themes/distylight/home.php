<?
/**
 * Home template file. Displays the blog posts.
 *
 * @package distylight
 */

get_header(); ?>

<div class="row">

  <div class="span9"> <?
    if (have_posts()) :
      $idx = 0;
      while (have_posts()) : the_post();
        if ($idx++ == 0) { ?>
          <div class="post"> <?
            if (has_post_thumbnail()) {
              $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'distylight-normal');
              if ($featured_image)
                $featured_image_url = $featured_image[0]; ?>
              <a class="featured-image"
                   style="background-image: url('<?= $featured_image_url ?>');"
                   alt="<?= get_the_title() ?>"
                   href="<? the_permalink() ?>">
              </a> <?
            } ?>
            <div class="entry-header">
              <h4 class="entry-title">
                <a href="<?= the_permalink() ?>">
                  <?= the_title() ?>
                </a>
              </h4>
            </div>
            <div class="entry-content"><?= the_excerpt() ?></div>
          </div> <?
        } else
          get_template_part('content');
      endwhile;
    else :
      get_template_part('no-results');
    endif; ?>
  </div>

  <div class="span3"> <?
    get_sidebar(); ?>
  </div>

</div> <?

get_footer();

?>