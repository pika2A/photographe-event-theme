// Attend que le document soit chargé
document.addEventListener("DOMContentLoaded", function () {
  // Sélectionnez tous les liens de navigation
  var navLinks = document.querySelectorAll(
    ".prev-photo-link, .next-photo-link"
  );
  // Parcour chaque lien de navigation
  navLinks.forEach(function (link) {
    // Stocke l'URL de l'image de la flèche dans data-default
    link.dataset.default = link.querySelector("img").src;
    // Ajoute un gestionnaire d'événements pour l'événement de survol de la souris
    link.addEventListener("mouseover", function () {
      // Vérifie si l'attribut data-thumb est défini
      if (this.dataset.thumb) {
        // Si oui, change l'image de la flèche en miniature
        // L'URL de la miniature est stockée dans l'attribut data-thumb
        this.querySelector("img").src = this.dataset.thumb;
      }
    });
    // Ajoute un gestionnaire d'événements pour l'événement de sortie de la souris
    link.addEventListener("mouseout", function () {
      // Vérifie si l'attribut data-default est défini
      if (this.dataset.default) {
        // Si oui, changez l'image de la miniature en flèche
        // L'URL de l'image de la flèche est stockée dans l'attribut data-default
        this.querySelector("img").src = this.dataset.default;
      }
    });
  });
});
