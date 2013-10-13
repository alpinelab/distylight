<?
/**
 * The Template for displaying all single posts.
 *
 * @package distylight
 */

get_header();

  while (have_posts()) : the_post();

    if (has_post_thumbnail()) {
      $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-normal');
      if ($featured_image)
        $featured_image_url = $featured_image[0]; ?>
      <div class="featured-image"
           style="background-image: url('<?= $featured_image_url ?>');"
           alt="<?= get_the_title() ?>">
      </div> <?
    } ?>

    <div class="row">
      <div class="span9"> <?
        distylight_content_nav('nav-below');
        get_template_part('content'); ?>
      </div>
      <div class="span3"> <?
        get_sidebar(); ?>
      </div>
    </div> <?
  endwhile; ?>

</div><!-- .row --> <?

get_footer(); ?>