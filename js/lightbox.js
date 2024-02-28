/* document.addEventListener("DOMContentLoaded", function () {
  var relatedPhotos = document.querySelectorAll(".related-photo");
  relatedPhotos.forEach(function (photo) {
    photo.querySelector("::after").addEventListener("click", function () {
      var img = document.createElement("img");
      img.src = photo.querySelector("img").src;
      var lightbox = document.createElement("div");
      lightbox.id = "lightbox";
      lightbox.appendChild(img);
      document.body.appendChild(lightbox);
      lightbox.addEventListener("click", function () {
        document.body.removeChild(lightbox);
      });
    });
  });
});*/

document.addEventListener("DOMContentLoaded", function () {
  // Attend que le document soit chargé
  var lightboxTriggers = document.querySelectorAll(".lightbox-trigger"); // Sélectionne tous les déclencheurs de lightbox
  lightboxTriggers.forEach(function (trigger) {
    // Parcoure chaque déclencheur de lightbox
    trigger.addEventListener("click", function () {
      // Ajoute un gestionnaire d'événements pour l'événement de clic
      var img = document.createElement("img"); // Crée un nouvel élément img
      img.src = this.parentElement.querySelector("img").src; // Définit l'attribut src de l'élément img sur l'URL de la photo
      var lightbox = document.createElement("div"); // Crée un nouvel élément div pour la lightbox
      lightbox.id = "lightbox"; // Donne un ID à la lightbox
      lightbox.appendChild(img); // Ajoute l'élément img à la lightbox
      document.body.appendChild(lightbox); // Ajoute la lightbox au corps du document
      lightbox.addEventListener("click", function () {
        // Ajoute un gestionnaire d'événements pour l'événement de clic sur la lightbox
        document.body.removeChild(lightbox); // Supprime la lightbox lorsque l'on clique dessus
      });
    });
  });
});
