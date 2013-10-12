<?
/**
 * Home template file. Displays the blog posts.
 *
 * @package distylight
 */

get_header(); ?>

<div class="row">

  <div class="span8"> <?
    if (have_posts()) :
      while (have_posts()) : the_post();
        get_template_part('content');
      endwhile;
      distylight_content_nav('nav-below');
    else :
      get_template_part('no-results', 'archive');
    endif; ?>
  </div>

  <div class="span4"> <?
    get_sidebar(); ?>
  </div>

</div> <?

get_footer();

?>