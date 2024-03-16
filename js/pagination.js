jQuery(document).ready(function ($) {
  let currentPage = 1;
  $("#load-more").on("click", function () {
    currentPage++; // Do currentPage + 1, because we want to load the next page

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "photo_load_more",
        paged: currentPage,
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
