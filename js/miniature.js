// Attend que le document soit chargé
document.addEventListener("DOMContentLoaded", function () {
  // Sélectionne tous les liens de navigation
  var navLinks = document.querySelectorAll(
    ".prev-photo-link, .next-photo-link"
  );

  // Parcourt chaque lien de navigation
  navLinks.forEach(function (link) {
    // Ajoute un gestionnaire d'événements pour l'événement de survol de la souris
    link.addEventListener("mouseover", function () {
      // Vérifie si l'attribut data-thumb est défini
      if (this.dataset.thumb) {
        // Si oui, change l'image de fond de l'élément .thumbnail en miniature
        // L'URL de la miniature est stockée dans l'attribut data-thumb
        this.querySelector(".thumbnail").style.backgroundImage =
          'url("' + this.dataset.thumb + '")';
      }
    });

    // Ajoute un gestionnaire d'événements pour l'événement de sortie de la souris
    link.addEventListener("mouseout", function () {
      // Supprime l'image de fond de l'élément .thumbnail
      this.querySelector(".thumbnail").style.backgroundImage = "";
    });
  });
});
