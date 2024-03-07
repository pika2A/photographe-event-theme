// J'attends que le contenu du document soit complètement chargé avant d'exécuter mon code.
document.addEventListener("DOMContentLoaded", function () {
  // Je récupère tous les éléments avec la classe "fullscreen". Ces éléments sont stockés dans un tableau.
  const fullscreenIcons = document.querySelectorAll(".fullscreen");

  // Je récupère l'élément avec l'ID "lightbox".
  const lightbox = document.getElementById("lightbox");

  // Je récupère les éléments avec les classes "cross", "prev" et "next" à l'intérieur de l'élément "lightbox".
  const closeButton = lightbox.querySelector(".cross");
  const prevButton = lightbox.querySelector(".prev");
  const nextButton = lightbox.querySelector(".next");

  // Je crée un tableau avec les URL de toutes les images. Pour cela, je transforme la liste des éléments "fullscreen" en tableau, puis je récupère l'URL de chaque image à partir de l'attribut "data-image-url" de l'élément parent.
  const images = Array.from(document.querySelectorAll(".fullscreen")).map(
    (img) => img.parentElement.dataset.imageUrl
  );

  // Je définis l'index de l'image actuellement affichée. Au début, cet index est 0.
  let currentIndex = 0;

  // Je définis une fonction pour ouvrir la lightbox.
  function openLightbox(event) {
    // J'empêche le comportement par défaut du clic, qui serait de suivre le lien.
    event.preventDefault();

    // Je vérifie si l'élément cliqué est l'image de l'icône "fullscreen". Si c'est le cas, je récupère l'élément parent pour obtenir l'URL de l'image.
    let targetElement = event.target;
    if (targetElement.classList.contains("fullscreen")) {
      targetElement = targetElement.parentElement;
    }

    // Je récupère l'URL de l'image et les informations sur laquelle on clique.
    const imageUrl = targetElement.dataset.imageUrl;
    const reference = targetElement.dataset.reference;
    const category = targetElement.dataset.category;

    // Je récupère les éléments de la lightbox.
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    const lightboxReference = lightbox.querySelector(
      ".lightbox-info .reference"
    );
    const lightboxCategory = lightbox.querySelector(".lightbox-info .category");

    // Je conserve l'URL de l'image de l'icône de fermeture.
    const closeButtonImage = closeButton.querySelector("img");
    const closeButtonImageUrl = closeButtonImage.src;

    // Je change l'URL de l'image et les informations de la lightbox.
    lightboxImage.src = imageUrl;
    lightboxReference.textContent = "Référence : " + reference;
    lightboxCategory.textContent = "Catégorie : " + category;

    // Je rétablis l'URL de l'image de l'icône de fermeture.
    closeButtonImage.src = closeButtonImageUrl;

    // J'ajoute la classe "active" à la lightbox pour la rendre visible.
    lightbox.classList.add("active");
  }

  // Je définis une fonction pour fermer la lightbox.
  function closeLightbox() {
    // Je retire la classe "active" de la lightbox pour la rendre invisible.
    lightbox.classList.remove("active");
  }

  // Je définis une fonction pour afficher la photo suivante.
  function nextPhoto() {
    // J'incrémente currentIndex et j'utilise le modulo pour m'assurer qu'il reste dans les limites du tableau.
    currentIndex = (currentIndex + 1) % images.length;

    // Je mets à jour l'image de la lightbox.
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    lightboxImage.src = images[currentIndex];
  }

  // Je définis une fonction pour afficher la photo précédente.
  function prevPhoto() {
    // Je décrémente currentIndex et j'utilise le modulo pour m'assurer qu'il reste dans les limites du tableau.
    currentIndex = (currentIndex - 1 + images.length) % images.length;

    // Je mets à jour l'image de la lightbox.
    const lightboxImage = lightbox.querySelector(".lightbox-image");
    lightboxImage.src = images[currentIndex];
  }

  // J'ajoute des écouteurs d'événements sur les icônes "fullscreen", les boutons "close", "prev" et "next".
  fullscreenIcons.forEach((icon) => {
    icon.addEventListener("click", openLightbox);
  });
  closeButton.addEventListener("click", closeLightbox);
  prevButton.addEventListener("click", prevPhoto);
  nextButton.addEventListener("click", nextPhoto);
});
