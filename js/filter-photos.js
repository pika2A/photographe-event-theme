// Attends que le document soit prêt
jQuery(document).ready(function ($) {
  // Écoute les changements sur les éléments de filtre
  $("#category-filter, #format-filter, #order-filter").change(function () {
    // Récupère les valeurs des filtres
    var category = $("#category-filter").val();
    var format = $("#format-filter").val();
    var order = $("#order-filter").val();

    // Effectue une requête AJAX vers le serveur
    $.ajax({
      type: "POST", // Type de la requête
      url: "/wp-admin/admin-ajax.php", // URL de la requête
      dataType: "json", // Type de données attendues en réponse
      data: {
        // Données envoyées au serveur
        action: "filter_photos", // Action à effectuer
        category: category, // Catégorie à filtrer
        format: format, // Format à filtrer
        order: order, // Ordre de tri
      },
      success: function (response) {
        // Fonction à exécuter en cas de succès
        console.log(response.max); // Affiche le nombre maximum de pages dans la console
        if (1 == response.max) {
          // Si il n'y a qu'une seule page
          $("#load-more").hide(); // Cache le bouton "Charger plus"
        } else {
          // Sinon
          $("#load-more").show(); // Affiche le bouton "Charger plus"
        }
        $("#photos").html(response.html); // Remplace le contenu de l'élément "#photos" par le HTML reçu

        // Sélectionne tous les éléments avec la classe ".fullscreen"
        const newFullscreenIcons = document.querySelectorAll(".fullscreen");
        // Pour chaque élément
        newFullscreenIcons.forEach((icon) => {
          // Ajoute un écouteur d'événement "click" qui appelle la fonction "openLightbox"
          icon.addEventListener("click", openLightbox);
        });
      },
    });
  });
});
