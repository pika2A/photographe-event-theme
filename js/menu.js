const menuToggle = document.querySelector(".menu-toggle");
const menuContainer = document.getElementById("menu-menu");

menuToggle.addEventListener("click", () => {
  menuToggle.classList.toggle("open");
  menuContainer.classList.toggle("open");

  // Si l'élément "menuToggle" a la classe "open", ajoute la classe "cross"
  if (menuToggle.classList.contains("open")) {
    menuToggle.classList.add("cross");
  } else {
    // Sinon, supprime la classe "cross"
    menuToggle.classList.remove("cross");
  }
});
