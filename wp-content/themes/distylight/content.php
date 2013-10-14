<?
/**
 * @package distylight
 */
?>

<article id="post-<? the_ID(); ?>" <? post_class() ?>> <?
  if (is_search() || is_home()) : // Only display Excerpts for Search and Home ?>
    <div class="entry-summary">
      <div class="row">
        <div class="span2">
          <a href="<? the_permalink() ?>"> <?
            the_post_thumbnail('portfolio-thumbnail') ?>
          </a>
        </div>
        <div class="span7">
          <header class="entry-header">
            <h4 class="entry-title"><a href="<? the_permalink() ?>" rel="bookmark"><? the_title() ?></a></h4>
          </header><!-- .entry-header -->
          <div class="entry-content"> <?
            the_excerpt() ?>
          </div>
        </div>
      </div>
    </div><!-- .entry-summary --> <?
  else :
    if (!is_page()) { ?>
      <header class="entry-header">
        <h1 class="entry-title"><a href="<? the_permalink() ?>" rel="bookmark"><? the_title() ?></a></h1>
      </header><!-- .entry-header --> <?
    } ?>
    <div class="entry-content"> <?
      the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'distylight' )); ?>
    </div><!-- .entry-content --> <?
  endif;

  if (!(is_search() || is_home())) { ?>
    <footer class="entry-meta"> <?
      if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
        <div class="entry-meta"> <?
          distylight_posted_on(); ?>
        </div><!-- .entry-meta --> <?
        $categories_list = get_the_category_list( __( ', ', 'distylight' ) );
        if ($categories_list && distylight_categorized_blog()) : ?>
          <span class="cat-links">
            <? printf(__('Posted in %1$s', 'distylight'), $categories_list); ?>
          </span> <?
        endif; // End if categories

        $tags_list = get_the_tag_list('', __(', ', 'distylight'));
        if ( $tags_list ) : ?>
          <span class="tags-links">
            <? printf( __( 'Tagged %1$s', 'distylight' ), $tags_list ); ?>
          </span> <?
        endif; // End if $tags_list
      endif; // End if 'post' == get_post_type()

      edit_post_link( __( 'Edit', 'distylight' ), '<span class="edit-link">', '</span>' ); ?>

    </footer><!-- .entry-meta --> <?
  } ?>

</article><!-- #post-## -->
