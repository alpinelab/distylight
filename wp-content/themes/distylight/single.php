<?
/**
 * The Template for displaying all single posts.
 *
 * @package distylight
 */

get_header(); ?>

	<div id="primary" class="content-area span8">
		<div id="content" class="site-content" role="main">

		<? while ( have_posts() ) : the_post(); ?>

			<? get_template_part( 'content', 'single' ); ?>

			<? distylight_content_nav( 'nav-below' ); ?>

			<?
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<? endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>