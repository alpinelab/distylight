<?php
/**
 * The Template for displaying all single posts.
 *
 * @package bosc
 */

get_header(); ?>


<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <?php
        while ( have_posts() ) : the_post();
          echo get_the_term_list( $post->ID, 'genre', '|') ;
        endwhile;
      ?>
    </div>

    <div class="span2">
      <?php
        while ( have_posts() ) : the_post();
          $images = rwmb_meta( 'portfolio_project_gallery', 'type=image&size=portfolio_thumbnail');
            foreach($images as $image)
              {
      ?>
                <a href="<?php the_permalink(); ?>" >
                  <?php echo "<img src='{$image['url']}'  alt='{$image['alt']}'/>" ?>
                  <?php echo the_title(); ?>
                </a>
<?php
        break;
      }
    endwhile;
?>






      </div>
    </div>
  </div>

<?php get_footer(); ?>











