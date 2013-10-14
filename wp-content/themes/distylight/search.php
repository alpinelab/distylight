<?
/**
 * The template for displaying Search Results pages.
 *
 * @package distylight
 */

get_header(); ?>

	<section id="primary" class="content-area span8">
		<div id="content" class="site-content" role="main">

		<? if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><? printf( __( 'Search Results for: %s', 'distylight' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<? /* Start the Loop */ ?>
			<? while ( have_posts() ) : the_post(); ?>

				<? get_template_part( 'content', 'search' ); ?>

			<? endwhile; ?>

			<? distylight_content_nav( 'nav-below' ); ?>

		<? else : ?>

			<? get_template_part( 'no-results', 'search' ); ?>

		<? endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>