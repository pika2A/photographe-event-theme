jQuery(document).ready(function ($) {
  let currentPage = 1;
  $("#load-more").on("click", function () {
    currentPage++;
    var category = $("#category-filter").val();
    var format = $("#format-filter").val();
    var order = $("#order-filter").val();

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "photo_load_more",
        paged: currentPage,
        category: category,
        format: format,
        order: order,
      },
      success: function (res) {
        if (currentPage >= res.max) {
          $("#load-more").hide();
        }
        $(".block_photo").append(res.html);

        // Ré-attachez les événements click
        const newFullscreenIcons = document.querySelectorAll(".fullscreen");
        newFullscreenIcons.forEach((icon) => {
          icon.addEventListener("click", openLightbox);
        });
      },
    });
  });
});
