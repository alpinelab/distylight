<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="span8">
      <!--Sidebar content-->
<?php
    $images = rwmb_meta( 'portfolio_project_gallery', 'type=image&size=large' );
	foreach ( $images as $image )
	{
    	echo "<img src='{$image['url']}'  alt='{$image['alt']}' />";
    	echo "{$image['name']}";
	}
?>

    </div>
    <div class="span4">
    	 <!--Description projet-->
    	<h1 class="entry-title"><?php the_title(); ?></h1>
		<h4 class="entry-title"><?php echo rwmb_meta( 'portfolio_project_location' ); ?></h4>
		<h4 class="entry-title"><?php echo rwmb_meta( 'portfolio_project_client' ); ?></h4>
		<h4 class="entry-title"><?php echo rwmb_meta( 'portfolio_project_area' ); ?></h4>
		<h4 class="entry-title"><?php echo rwmb_meta( 'portfolio_project_cost' ); ?> €</h4>
		<p class="entry-title"><?php echo rwmb_meta( 'portfolio_project_editor' ); ?></p>
    <p class="entry-title"><span><?php previous_post_link('%link', '<< précédent'); ?></span> project <span><?php next_post_link('%link', 'suivant >>'); ?></span></p>
    </div>
  </div>
</div>


<?php get_footer(); ?>