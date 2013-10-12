<?
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package distylight
 */

get_header(); ?>

	<div id="primary" class="content-area span8">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post not-found">
				<header class="entry-header">
					<h1 class="entry-title"><? _e( 'Oops! That page can&rsquo;t be found.', 'distylight' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><? _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'distylight' ); ?></p>

					<? get_search_form(); ?>

					<? the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<? if ( distylight_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widgettitle"><? _e( 'Most Used Categories', 'distylight' ); ?></h2>
						<ul>
						<?
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<? endif; ?>

					<?
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'distylight' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<? the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .not-found -->

		</div><!-- #content -->
	</div><!-- #primary -->

<? get_footer(); ?>