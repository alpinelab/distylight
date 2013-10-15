<?
/**
 * Checks if a particular user has a role.
 * Returns true if a match was found.
 *
 * @param string $role Role name.
 * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
 * @return bool
 */
function check_user_role($role, $user_id = null) {
  if (is_numeric($user_id))
    $user = get_userdata($user_id);
  else
    $user = wp_get_current_user();
  if (empty($user))
    return false;
  return in_array($role, (array) $user->roles);
}


if (check_user_role('editor')) {

  //
  // Remove items from menu
  //
  function remove_menu_items() {
    global $menu;
    $restricted = array(__('Media'), __('Comments'), __('Contact'), __('Tools'));
    end ($menu);
    while (prev($menu)){
      $value = explode(' ',$menu[key($menu)][0]);
      if(in_array($value[0] != NULL ? $value[0] : "" , $restricted)){
        unset($menu[key($menu)]);
      }
    }
  }
  add_action('admin_menu', 'remove_menu_items');

  //
  // Remove columns in posts listing
  //
  function custom_post_columns($defaults) {
    unset($defaults['comments']);
    unset($defaults['author']);
    return $defaults;
  }
  add_filter('manage_posts_columns', 'custom_post_columns');


  //
  // Remove columns in pages listing
  //
  function custom_pages_columns($defaults) {
    unset($defaults['comments']);
    unset($defaults['author']);
    return $defaults;
  }
  add_filter('manage_pages_columns', 'custom_pages_columns');


  //
  // Remove widgets on the dashboard
  //
  function disable_default_dashboard_widgets() {
    // remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core'); // Other WordPress News
    remove_meta_box('dashboard_secondary', 'dashboard', 'core'); // WordPress Blog
  }
  add_action('admin_menu', 'disable_default_dashboard_widgets');

  //
  // Force dashboard to be on 1 column
  //
  function screen_layout_columns($columns) {
    $columns['dashboard'] = 1;
    return $columns;
  }
  add_filter('screen_layout_columns', 'screen_layout_columns');

  function screen_layout_dashboard() {
    return 1;
  }
  add_filter('get_user_option_screen_layout_dashboard', 'screen_layout_dashboard');

  //
  // Remove Screen Options button
  //
  function remove_screen_options() {
    return false;
  }
  add_filter('screen_options_show_screen', 'remove_screen_options');

}

//
// Add projects to "Right Now" dashboard widget
//
function portfolio_in_rightnow() {
  $types = 'portfolio';
  if (!post_type_exists(''.$types.'')) { return; }
  $num_posts = wp_count_posts(''.$types.'');
  $nbr_ = 'Projet';
  $nbr_s = 'Projets';
  $num = number_format_i18n($num_posts->publish);
  $text = _n('' . $nbr_ . '', '' . $nbr_s . '', intval($num_posts->publish));
  if (current_user_can('edit_posts')) {
    $num = "<a href='edit.php?post_type=$types'>$num</a>";
    $text = "<a href='edit.php?post_type=$types'>$text</a>";
  }
  echo '<tr><td class="first b">' . $num . '</td><td class="t">' . $text . '</td></tr>';
  if ($num_posts->pending > 0) {
    $num = number_format_i18n($num_posts->pending);
    $text = _n('En attente', 'En attentes', intval($num_posts->pending));
    if (current_user_can('edit_posts')) {
      $num = "<a href='edit.php?post_status=pending&post_type=$types'>$num</a>";
      $text = "<a class='waiting' href='edit.php?post_status=pending&post_type=$types'>$text</a>";
    }
    echo '<tr><td class="first b">' . $num . '</td><td class="t">' . $text . '</td></tr>';
  }
}
add_action('right_now_content_table_end', 'portfolio_in_rightnow');

?>