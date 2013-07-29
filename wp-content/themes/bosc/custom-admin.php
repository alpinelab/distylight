<?php
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
    $restricted = array(__('Media'), __('Comments'), __('Contact'));
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

  //
  // Remove columns in pages listing
  //

  add_filter('manage_posts_columns', 'custom_post_columns');

  function custom_pages_columns($defaults) {
    unset($defaults['comments']);
    unset($defaults['author']);
    return $defaults;
  }

  add_filter('manage_pages_columns', 'custom_pages_columns');

}

?>