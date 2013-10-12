<?
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package distylight
 */

get_header();

while ( have_posts() ) : the_post();

  if (has_post_thumbnail()) {
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider-normal');
    if ($featured_image)
      $featured_image_url = $featured_image[0]; ?>
    <div class="featured-image"
         style="background-image: url('<?= $featured_image_url ?>');"
         alt="<?= get_the_title() ?>">
    </div> <?
  }

  get_template_part( 'content', 'page' );

endwhile; // end of the loop.

get_footer();

?>