jQuery(document).ready(function ($) {
  $("#category-filter, #format-filter, #order-filter").change(function () {
    var category = $("#category-filter").val();
    var format = $("#format-filter").val();
    var order = $("#order-filter").val();
    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "filter_photos",
        category: category,
        format: format,
        order: order,
      },
      success: function (response) {
        console.log(response.max);
        if (1 == response.max) {
          $("#load-more").hide();
        } else {
          $("#load-more").show();
        }
        $("#photos").html(response.html);
        const newFullscreenIcons = document.querySelectorAll(".fullscreen");
        newFullscreenIcons.forEach((icon) => {
          icon.addEventListener("click", openLightbox);
        });
      },
    });
  });
});
