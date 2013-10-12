<?
/**
 * The Sidebar containing the main widget areas.
 *
 * @package distylight
 */
?>

<div id="secondary" class="widget-area span4" role="complementary"> <?
  do_action( 'before_sidebar' );
  dynamic_sidebar( 'blog-sidebar' ); ?>
</div><!-- #secondary -->
