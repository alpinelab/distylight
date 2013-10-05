PORTFOLIO = ((($) ->
  "use strict"
  $grid = $("#projects-grid")
  $filterOptions = $(".filter-options")
  $sizer = $grid.find(".shuffle__sizer")
  init = ->

    # None of these need to be executed synchronously
    setTimeout (->
      listen()
      setupFilters()
    ), 100

    # instantiate the plugin
    $grid.shuffle
      itemSelector: ".picture-item"
      sizer: $sizer

  # Set up button clicks
  setupFilters = ->
    $btns = $filterOptions.find("button")
    $btns.on "click", ->
      $this = $(this)
      filter = $this.data("filterValue")
      $grid.shuffle "shuffle", filter

    $btns = null

  # Re layout shuffle when images load. This is only needed
  # below 768 pixels because the .picture-item height is auto and therefore
  # the height of the picture-item is dependent on the image
  # I recommend using imagesloaded to determine when an image is loaded
  # but that doesn t support IE7
  listen = ->
    debouncedLayout = $.throttle(300, ->
      $grid.shuffle "update"
    )

    # Get all images inside shuffle
    $grid.find("img").each ->
      proxyImage = undefined

      # Image already loaded
      return  if @complete and @naturalWidth isnt `undefined`

      # If none of the checks above matched, simulate loading on detached element.
      proxyImage = new Image()
      $(proxyImage).on "load", ->
        $(this).off "load"
        debouncedLayout()

      proxyImage.src = @src

  init: init
)(jQuery))
jQuery(document).ready ($) ->
  PORTFOLIO.init()
