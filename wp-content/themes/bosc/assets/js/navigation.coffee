# navigation.js
# Handles toggling the navigation menu for small screens.

(->
  container = document.getElementById('site-navigation')
  return unless container

  button = container.getElementsByTagName('h1')[0]
  return if 'undefined' == typeof button

  menu = container.getElementsByTagName('ul')[0]

  # Hide menu toggle button if menu is empty and return early.
  if 'undefined' == typeof menu
    button.style.display = 'none'
    return

  if menu.className.indexOf('nav-menu') == -1
    menu.className += ' nav-menu'

  button.onclick = ->
    if container.className.indexOf('toggled') != -1
      container.className = container.className.replace ' toggled', ''
    else
      container.className += ' toggled'
)()