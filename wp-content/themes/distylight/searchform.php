<?
/**
 * The template for displaying search forms in distylight
 *
 * @package distylight
 */
?>
<form role="search" method="get" class="search-form" action="<? echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><? _ex( 'Search for:', 'label', 'distylight' ); ?></span>
		<input type="search" class="search-field" placeholder="<? echo esc_attr_x( 'Search &hellip;', 'placeholder', 'distylight' ); ?>" value="<? echo esc_attr( get_search_query() ); ?>" name="s" title="<? _ex( 'Search for:', 'label', 'distylight' ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<? echo esc_attr_x( 'Search', 'submit button', 'distylight' ); ?>" />
</form>
