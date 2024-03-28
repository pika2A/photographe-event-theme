jQuery(document).ready(function ($) {
  if ($(window).width() < 768) {
    // Si la largeur de l'écran est inférieure à 768px
    $("#category-filter, #format-filter, #order-filter").select2({
      width: "80%", // Applique une largeur de 80%
    });
  } else {
    $("#category-filter, #format-filter, #order-filter").select2(); // Sinon, utilise la largeur par défaut
  }
  $("select").on("select2:selecting", function (e) {
    var $dropdown = $(this).parent().find(".select2-dropdown");
    $dropdown.css("background-color", "#FE5858");
    setTimeout(function () {
      $dropdown.css("background-color", "");
    }, 100);
  });
});
