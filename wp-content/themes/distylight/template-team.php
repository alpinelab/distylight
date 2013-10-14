<?
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package distylight
 *
 * Template Name: Team
 */

$team = array(
  array('slug' => 'johan',    'name' => 'Johan SUSTRAC',    'location' => 'Paris, France',     'title' => 'CEO & Lighting Designer'),
  array('slug' => 'hugo',     'name' => 'Hugo BRANDAO',     'location' => 'Paris, France',     'title' => 'Project Manager'),
  array('slug' => 'jeanne',   'name' => 'Jeanne BROCHIER',  'location' => 'Paris, France',     'title' => 'Project Manager'),
  array('slug' => 'isabelle', 'name' => 'Isabelle GAVALDA', 'location' => 'Paris, France',     'title' => 'Art Director & Communication Manager'),
  array('slug' => 'camille',  'name' => 'Camille LAURENT',  'location' => 'Sao Paulo, Brazil', 'title' => 'Brazil Project Manager'),
  array('slug' => 'victor',   'name' => 'Victor DE GUIGNE', 'location' => 'Paris, France',     'title' => 'Graphic Studio Manager'),
  array('slug' => 'david',    'name' => 'David BEDJAI',     'location' => 'Shanghai, China',   'title' => 'China Project Manager')
);

get_header(); ?>

<div class="team-members"> <?

  $idx = 0;

  foreach ($team as $member) {
    if ($idx % 2 == 0) { ?>
      <div class="row">
        <div class="span2 team-member-image"><?= the_team_member_avatar($member['slug']) ?></div> <?
    } ?>

        <div class="span4">
          <div class="team-member-infos">
            <p class="team-member-name"><?= $member['name'] ?></p>
            <p class="team-member-title"><?= $member['title'] ?></p>
            <p class="team-member-location"><?= $member['location'] ?></p>
          </div><!-- .team-member-infos -->
        </div><!-- .span4 --> <?

    if ($idx % 2 == 1) { ?>
        <div class="span2 team-member-image"><?= the_team_member_avatar($member['slug']) ?></div>
      </div><!-- .row --> <?
    }

    $idx++;
  }

  if ($idx % 2 == 0) { ?>
    </div><!-- .row --> <?
  }

?>

</div> <?

get_footer();

?>