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
 *
 * Template Name: Contact
 */

// Find the first WPCF7 form
$contact_form = array_shift(get_posts(array('post_type' => 'wpcf7_contact_form')));

get_header(); ?>

<div class="row download-portfolio">
  <div class="span12">
    <a href="<? the_portfolio_url() ?>">Our Portfolio <i class="icon-download"></i></a>
  </div>
</div>

<div class="row contact-page">

  <div class="span6 contact-infos"> <?
    if (have_posts()) : while (have_posts()) : the_post();
      the_content();
    endwhile; endif; ?>
  </div><!-- .span6 --> <?

  if ($contact_form) { ?>
    <div class="span6 contact-form">
      <h4>Contact us / Contactez nous / 联系我们 / Contato</h4>
      <?= do_shortcode("[contact-form-7 id=\"{$contact_form->ID}\" title=\"Contact form\"]"); ?>
    </div><!-- .span6 --> <?
  } ?>

</div><!-- .row --> <?

get_footer();

?>