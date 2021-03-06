<?
/**
 * The template for displaying image attachments.
 *
 * @package distylight
 */

get_header();
?>

	<div id="primary" class="content-area span8 image-attachment">
		<div id="content" class="site-content" role="main">

		<? while ( have_posts() ) : the_post(); ?>

			<article id="post-<? the_ID(); ?>" <? post_class(); ?>>
				<header class="entry-header">
					<? the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?
							$metadata = wp_get_attachment_metadata();
							printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'distylight' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height'],
								get_permalink( $post->post_parent ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);

							edit_post_link( __( 'Edit', 'distylight' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-meta -->

					<nav role="navigation" id="image-navigation" class="navigation-image">
						<div class="nav-previous"><? previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'distylight' ) ); ?></div>
						<div class="nav-next"><? next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'distylight' ) ); ?></div>
					</nav><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<? distylight_the_attached_image(); ?>
						</div><!-- .attachment -->

						<? if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<? the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<? endif; ?>
					</div><!-- .entry-attachment -->

					<?
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'distylight' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?
						if ( comments_open() && pings_open() ) : // Comments and trackbacks open
							printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'distylight' ), get_trackback_url() );
						elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open
							printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'distylight' ), get_trackback_url() );
						elseif ( comments_open() && ! pings_open() ) : // Only comments open
							 _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'distylight' );
						elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed
							_e( 'Both comments and trackbacks are currently closed.', 'distylight' );
						endif;

						edit_post_link( __( 'Edit', 'distylight' ), ' <span class="edit-link">', '</span>' );
					?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-## -->

			<?
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<? endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<? get_footer(); ?>