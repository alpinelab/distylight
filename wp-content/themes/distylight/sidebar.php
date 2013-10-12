<?
/**
 * The Sidebar containing the main widget areas.
 *
 * @package distylight
 */
?>
	<div id="secondary" class="widget-area span4" role="complementary">
		<? do_action( 'before_sidebar' ); ?>
		<? if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<? get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><? _e( 'Archives', 'distylight' ); ?></h1>
				<ul>
					<? wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><? _e( 'Meta', 'distylight' ); ?></h1>
				<ul>
					<? wp_register(); ?>
					<li><? wp_loginout(); ?></li>
					<? wp_meta(); ?>
				</ul>
			</aside>

		<? endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
