(->
  jQuery(document).ready ($) ->
    $("#slider").carouFredSel
      items: 1
      direction: "down"
      scroll:
        items: 1
        duration: 800
        pauseOnHover: false
        fx: "scroll"
        easing: "swing"
).call this