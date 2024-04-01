// Attends que le document soit prêt
jQuery(document).ready(function ($) {
  // Vérifie la largeur de la fenêtre
  if ($(window).width() < 768) {
    // Si la largeur de l'écran est inférieure à 768px
    // Applique le plugin select2 aux éléments de filtre avec une largeur de 80%
    $("#category-filter, #format-filter, #order-filter").select2({
      width: "80%",
    });
  } else {
    // Sinon, applique le plugin select2 avec la largeur par défaut
    $("#category-filter, #format-filter, #order-filter").select2();
  }
  // Ajoute un écouteur d'événement sur l'événement "select2:selecting" pour tous les éléments select
  $("select").on("select2:selecting", function (e) {
    // Récupère le dropdown du select2 courant
    var $dropdown = $(this).parent().find(".select2-dropdown");
    // Change la couleur de fond du dropdown en rouge
    $dropdown.css("background-color", "#FE5858");
  });
});
