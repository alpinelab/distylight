<?
/**
 * The Template for displaying all single posts.
 *
 * @package distylight
 */

get_header(); ?>

  <? while (have_posts()) : the_post();

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
      <div id="primary" class="content-area span8">
        <div id="content" class="site-content" role="main"> <?
          get_template_part('content');
          distylight_content_nav( 'nav-below' ); ?>
        </div>
      </div>
    </div> <?
  endwhile; ?>

  <div class="span4"> <?
    get_sidebar(); ?>
  </div>

</div><!-- .row --> <?

get_footer(); ?>