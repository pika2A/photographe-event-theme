document.addEventListener("DOMContentLoaded", function () {
  // Récupération des éléments nécessaires
  const fullscreenIcons = document.querySelectorAll(".fullscreen");
  const lightbox = document.getElementById("lightbox");
  const closeButton = lightbox.querySelector(".cross");
  const prevButton = lightbox.querySelector(".prev");
  const nextButton = lightbox.querySelector(".next");
  // Stocke toutes les images dans un tableau
  const images = Array.from(document.querySelectorAll(".fullscreen")).map(
    (img) => img.parentElement.dataset.imageUrl
  );
  // Stocke l'index de l'image actuellement affichée
  let currentIndex = 0;

  //fonction pour ouvrir la lightbox
  function openLightbox(event) {
    event.preventDefault(); // Empêche le comportement par défaut du clic

    // Vérifie si l'élément cliqué est l'image de l'icone "fullscreen"
    let targetElement = event.target;
    if (targetElement.classList.contains("fullscreen")) {
      // si c'est le cas,utilise l'élément parent pour récupérer l'URL de l'image
      targetElement = targetElement.parentElement;
    }

    // Récupère l'URL de l'image et les informations sur laquelle on clique
    const imageUrl = targetElement.dataset.imageUrl;
    const reference = targetElement.dataset.reference;
    const category = targetElement.dataset.category;

    // Récupère les éléments de la lightbox
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    const lightboxReference = lightbox.querySelector(
      ".lightbox-info .reference"
    );
    const lightboxCategory = lightbox.querySelector(".lightbox-info .category");

    // Conservez l'URL de l'image de l'icône de fermeture
    const closeButtonImage = closeButton.querySelector("img");
    const closeButtonImageUrl = closeButtonImage.src;

    // Changez l'URL de l'image et les informations de la lightbox
    lightboxImage.src = imageUrl;
    lightboxReference.textContent = "Référence : " + reference;
    lightboxCategory.textContent = "Catégorie : " + category;

    // Rétabli l'URL de l'image de l'icône de fermeture
    closeButtonImage.src = closeButtonImageUrl;

    lightbox.classList.add("active");
  }

  // Fonction pour fermer la lightbox
  function closeLightbox() {
    lightbox.classList.remove("active");
  }

  function nextPhoto() {
    // Incrémentez currentIndex et utilisez le modulo pour s'assurer qu'il reste dans les limites du tableau
    currentIndex = (currentIndex + 1) % images.length;

    // Mettez à jour l'image de la lightbox
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    lightboxImage.src = images[currentIndex];
  }

  function prevPhoto() {
    // Décrémentez currentIndex et utilisez le modulo pour s'assurer qu'il reste dans les limites du tableau
    currentIndex = (currentIndex - 1 + images.length) % images.length;

    // Mettez à jour l'image de la lightbox
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    lightboxImage.src = images[currentIndex];
  }

  // Ajout des écouteurs d'événements
  fullscreenIcons.forEach((icon) => {
    icon.addEventListener("click", (event) => openLightbox(event)); // Passe event comme paramètre
  });

  closeButton.addEventListener("click", closeLightbox);
  prevButton.addEventListener("click", prevPhoto);
  nextButton.addEventListener("click", nextPhoto);
});
