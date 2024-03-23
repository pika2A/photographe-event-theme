jQuery(document).ready(function ($) {
  $("#category-filter, #format-filter, #order-filter").change(function () {
    var category = $("#category-filter").val();
    var format = $("#format-filter").val();
    var order = $("#order-filter").val();
    $.ajax({
      type: "POST",
      url: ajax_object.ajaxurl, // Cette variable est définie par WordPress.
      data: {
        action: "filter_photos",
        category: category,
        format: format,
        order: order,
      },
      success: function (response) {
        $("#photos").html(response);
        const newFullscreenIcons = document.querySelectorAll(".fullscreen");
        newFullscreenIcons.forEach((icon) => {
          icon.addEventListener("click", openLightbox);
        });
      },
    });
  });
});
