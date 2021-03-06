<?
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package distylight
 */

if ( ! function_exists( 'distylight_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function distylight_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<? echo esc_attr( $nav_id ); ?>" class="<? echo $nav_class; ?>">

	<? if ( is_single() ) : // navigation links for single posts ?>

		<? previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'distylight' ) . '</span>' ); ?>
		<? next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'distylight' ) . '</span>' ); ?>

	<? elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<? if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><? next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'distylight' ) ); ?></div>
		<? endif; ?>

		<? if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><? previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'distylight' ) ); ?></div>
		<? endif; ?>

	<? endif; ?>

	</nav><!-- #<? echo esc_html( $nav_id ); ?> -->
	<?
}
endif; // distylight_content_nav

if ( ! function_exists( 'distylight_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function distylight_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<? comment_ID(); ?>" <? comment_class(); ?>>
		<div class="comment-body">
			<? _e( 'Pingback:', 'distylight' ); ?> <? comment_author_link(); ?> <? edit_comment_link( __( 'Edit', 'distylight' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<? else : ?>

	<li id="comment-<? comment_ID(); ?>" <? comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<? comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<? if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<? printf( __( '%s <span class="says">says:</span>', 'distylight' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<? echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<? comment_time( 'c' ); ?>">
							<? printf( _x( '%1$s at %2$s', '1: date, 2: time', 'distylight' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<? edit_comment_link( __( 'Edit', 'distylight' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<? if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><? _e( 'Your comment is awaiting moderation.', 'distylight' ); ?></p>
				<? endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<? comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<? comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- .comment-body -->

	<?
	endif;
}
endif; // ends check for distylight_comment()

if ( ! function_exists( 'distylight_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function distylight_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'distylight_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'distylight_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function distylight_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>', 'distylight' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		$time_string
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function distylight_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so distylight_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so distylight_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in distylight_categorized_blog
 */
function distylight_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'distylight_category_transient_flusher' );
add_action( 'save_post',     'distylight_category_transient_flusher' );
