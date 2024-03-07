// Récupérer la modale
var modal = document.getElementById("myModal");

// Récupérer le lien du menu "Contact"
var contactLink = document.querySelector(".openModal");

// Quand l'utilisateur clique sur le lien, ouvrir la modale
contactLink.onclick = function (event) {
  event.preventDefault(); // Empêcher le lien de suivre l'URL
  modal.style.display = "flex";
};

// Quand l'utilisateur clique n'importe où en dehors de la modale, la fermer
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
