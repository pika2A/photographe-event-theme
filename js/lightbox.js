// Attend que le DOM soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {
  // Récupère tous les éléments avec la classe "fullscreen" et les stocke dans un tableau
  const fullscreenIcons = document.querySelectorAll(".fullscreen");

  // Récupère l'élément avec l'ID "lightbox"
  const lightbox = document.getElementById("lightbox");

  // Récupère les éléments avec les classes "cross", "prev" et "next" à l'intérieur de l'élément "lightbox"
  const closeButton = lightbox.querySelector(".cross");
  const prevButton = lightbox.querySelector(".prev");
  const nextButton = lightbox.querySelector(".next");

  // Crée un tableau avec les URL de toutes les images
  const images = Array.from(document.querySelectorAll(".fullscreen")).map(
    (img) => img.parentElement.dataset
  );

  // Initialise l'index de l'image actuellement affichée à 0
  let currentIndex = 0;

  // Fonction pour ouvrir la lightbox
  function openLightbox(event) {
    // Empêche le comportement par défaut du clic (suivre le lien)
    event.preventDefault();

    // Vérifie si l'élément cliqué est l'icône "fullscreen"
    let targetElement = event.target;
    if (targetElement.classList.contains("fullscreen")) {
      targetElement = targetElement.parentElement;
    }

    // Récupère l'URL de l'image et ses informations
    const imageUrl = targetElement.dataset.imageUrl;
    const reference = targetElement.dataset.reference;
    const category = targetElement.dataset.category;

    // Récupère les éléments de la lightbox
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    const lightboxReference = lightbox.querySelector(
      ".lightbox-info .reference"
    );
    const lightboxCategory = lightbox.querySelector(".lightbox-info .category");

    // Récupère l'URL de l'image de l'icône de fermeture
    const closeButtonImage = closeButton.querySelector("img");
    const closeButtonImageUrl = closeButtonImage.src;

    // Met à jour l'URL de l'image et les informations de la lightbox
    lightboxImage.src = imageUrl;
    lightboxReference.textContent = "Référence : " + reference;
    lightboxCategory.textContent = "Catégorie : " + category;

    // Rétablit l'URL de l'image de l'icône de fermeture
    closeButtonImage.src = closeButtonImageUrl;

    // Ajoute la classe "active" à la lightbox pour la rendre visible
    lightbox.classList.add("active");
  }

  // Attacher la fonction openLightbox à l'objet window
  window.openLightbox = openLightbox;

  // Fonction pour fermer la lightbox
  function closeLightbox() {
    // Retire la classe "active" de la lightbox pour la rendre invisible
    lightbox.classList.remove("active");
  }

  // Fonction pour afficher la photo suivante
  function nextPhoto() {
    // Incrémente l'index de l'image en utilisant le modulo pour rester dans les limites du tableau
    currentIndex = (currentIndex + 1) % images.length;

    // Met à jour l'image de la lightbox
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    lightboxImage.src = images[currentIndex].imageUrl;

    // Met à jour les informations de référence et de catégorie
    const reference = images[currentIndex].reference;
    const category = images[currentIndex].category;
    const lightboxReference = lightbox.querySelector(
      ".lightbox-info .reference"
    );
    const lightboxCategory = lightbox.querySelector(".lightbox-info .category");
    lightboxReference.textContent = "Référence : " + reference;
    lightboxCategory.textContent = "Catégorie : " + category;
  }

  // Fonction pour afficher la photo précédente
  function prevPhoto() {
    // Décrémente l'index de l'image en utilisant le modulo pour rester dans les limites du tableau
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    // Met à jour l'image de la lightbox
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    lightboxImage.src = images[currentIndex].imageUrl;

    // Met à jour les informations de référence et de catégorie
    const reference = images[currentIndex].reference;
    const category = images[currentIndex].category;
    const lightboxReference = lightbox.querySelector(
      ".lightbox-info .reference"
    );
    const lightboxCategory = lightbox.querySelector(".lightbox-info .category");
    lightboxReference.textContent = "Référence : " + reference;
    lightboxCategory.textContent = "Catégorie : " + category;
  }

  // Ajoute des écouteurs d'événements sur les icônes "fullscreen" et les boutons "close", "prev" et "next"
  fullscreenIcons.forEach((icon) => {
    icon.addEventListener("click", openLightbox);
  });
  closeButton.addEventListener("click", closeLightbox);
  prevButton.addEventListener("click", prevPhoto);
  nextButton.addEventListener("click", nextPhoto);
});
