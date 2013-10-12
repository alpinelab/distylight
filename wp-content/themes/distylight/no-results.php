<?
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package distylight
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><? _e( 'Nothing Found', 'distylight' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<? if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><? printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'distylight' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<? elseif ( is_search() ) : ?>

			<p><? _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'distylight' ); ?></p>
			<? get_search_form(); ?>

		<? else : ?>

			<p><? _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'distylight' ); ?></p>
			<? get_search_form(); ?>

		<? endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
