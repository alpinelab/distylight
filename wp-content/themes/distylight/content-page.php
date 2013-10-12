<?
/**
 * The template used for displaying page content in page.php
 *
 * @package distylight
 */
?>

<article id="post-<? the_ID(); ?>" <? post_class(); ?>>
	<div class="entry-content">
		<? the_content(); ?>
		<?
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'distylight' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<? edit_post_link( __( 'Edit', 'distylight' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
