<?
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to distylight_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package distylight
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<? // You can start editing here -- including this comment! ?>

	<? if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'distylight' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<? if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation-comment" role="navigation">
			<h1 class="screen-reader-text"><? _e( 'Comment navigation', 'distylight' ); ?></h1>
			<div class="nav-previous"><? previous_comments_link( __( '&larr; Older Comments', 'distylight' ) ); ?></div>
			<div class="nav-next"><? next_comments_link( __( 'Newer Comments &rarr;', 'distylight' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<? endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use distylight_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define distylight_comment() and that will be used instead.
				 * See distylight_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'distylight_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<? if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation-comment" role="navigation">
			<h1 class="screen-reader-text"><? _e( 'Comment navigation', 'distylight' ); ?></h1>
			<div class="nav-previous"><? previous_comments_link( __( '&larr; Older Comments', 'distylight' ) ); ?></div>
			<div class="nav-next"><? next_comments_link( __( 'Newer Comments &rarr;', 'distylight' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<? endif; // check for comment navigation ?>

	<? endif; // have_comments() ?>

	<?
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><? _e( 'Comments are closed.', 'distylight' ); ?></p>
	<? endif; ?>

	<? comment_form(); ?>

</div><!-- #comments -->
