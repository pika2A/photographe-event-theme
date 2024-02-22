jQuery(document).ready(function ($) {
  // Quand l'utilisateur clique sur le bouton "Contact"
  $("#contactButton").click(function () {
    // Afficher la modal
    $("#myModal").css("display", "block");
    // Préremplir le champ de formulaire avec la référence de la photo
    var reference = $(this).data("reference");
    $("#refField").val(reference);
  });

  // Quand l'utilisateur clique sur le bouton pour fermer la modal
  $(".close").click(function () {
    $("#myModal").css("display", "none");
  });

  // Quand l'utilisateur clique en dehors de la modal, la fermer
  $(window).click(function (event) {
    if (event.target == $("#myModal")[0]) {
      $("#myModal").css("display", "none");
    }
  });
});
