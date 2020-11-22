$(window).on("scroll", function() {
    $(header).toggleClass("active", $(this).scrollTop() > $(window).height());
  });