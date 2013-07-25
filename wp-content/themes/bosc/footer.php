<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package bosc
 */
?>


    </div><!-- #main -->
	</div><!-- .container -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php do_action( 'bosc_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'bosc' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'bosc' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'bosc' ), 'bosc', '<a href="http://www.alpine-lab.com" rel="designer">Alpine Lab</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>