jQuery(document).ready ($) ->
  $(document).keydown (e) ->
    url = false
    if e.which == 37 # Left arrow key code
      url = $('.previous-image a').attr 'href'
    else if e.which == 39 # Right arrow key code
      url = $('.entry-attachment a').attr 'href'
    if url and not $('textarea, input').is(':focus')
      window.location = url
