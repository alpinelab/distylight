<? get_header(); ?>

<div class="container">

  <div class="row projects-navigation">
    <div class="span6"><? previous_post_link('%link', '&larr;'); ?></div>
    <div class="span6"><? next_post_link('%link', '&rarr;'); ?></div>
  </div>

  <div class="row">
    <div class="span12">
      <h1><? the_title(); ?></h1>
    </div>
  </div>

  <div class="row project-infos"> <?
    if (rwmb_meta('portfolio_project_location')) { ?>
      <div class="span3">
        <div class="info-title">Location</div>
        <h4><?= rwmb_meta( 'portfolio_project_location' ) ?></h4>
      </div> <?
    }
    if (rwmb_meta('portfolio_project_date')) { ?>
      <div class="span3">
        <div class="info-title">Date</div>
        <h4><?= rwmb_meta( 'portfolio_project_date' ) ?></h4>
      </div> <?
    }
    if (rwmb_meta('portfolio_project_client')) { ?>
      <div class="span3">
        <div class="info-title">Architect</div>
        <h4><?= rwmb_meta( 'portfolio_project_client' ) ?></h4>
      </div> <?
    }
    if (rwmb_meta('portfolio_project_power')) { ?>
      <div class="span3">
        <div class="info-title">Power</div>
        <h4><?= rwmb_meta( 'portfolio_project_power' ) ?></h4>
      </div> <?
    } ?>
  </div>

  <div class="row project-description">
    <div class="span12">
      <?= rwmb_meta( 'portfolio_project_editor' ) ?>
    </div>
  </div> <?

  $images = rwmb_meta( 'portfolio_project_gallery', 'type=image&size=distylight-large' );
  foreach ( $images as $image ) { ?>
    <div class="row project-image">
      <div class="span12">
        <img src="<?= $image['url'] ?>"  alt="<?= $image['alt'] ?>">
      </div>
    </div> <?
  } ?>

</div>


<? get_footer(); ?>