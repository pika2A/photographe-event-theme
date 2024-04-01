document.addEventListener("DOMContentLoaded", function () {
  var x, i, j, selElmnt, a, b, c;
  /* Recherche tous les éléments avec la classe "custom-select" : */
  x = document.getElementsByClassName("custom-select");
  for (i = 0; i < x.length; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    /* Pour chaque élément, crée un nouveau DIV qui agira comme l'élément sélectionné : */
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /* Pour chaque élément, crée un nouveau DIV qui contiendra la liste des options : */
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < selElmnt.length; j++) {
      /* Pour chaque option dans l'élément select original,
        crée un nouveau DIV qui agira comme un élément d'option : */
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function (e) {
        /* Lorsqu'un élément est cliqué, mettre à jour la boîte de sélection originale,
            et l'élément sélectionné : */
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("custom-option");
            for (k = 0; k < y.length; k++) {
              y[k].classList.remove("selected");
            }
            this.classList.add("selected");
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
      /* Lorsque la boîte de sélection est cliquée, fermer toutes les autres boîtes de sélection,
          et ouvrir/fermer la boîte de sélection actuelle : */
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.parentNode.classList.toggle("active");
    });
  }
  function closeAllSelect(elmnt) {
    /* Une fonction qui fermera toutes les boîtes de sélection dans le document,
      sauf la boîte de sélection actuelle : */
    var x,
      y,
      i,
      arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    for (i = 0; i < y.length; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i);
      } else {
        y[i].classList.remove("active");
      }
    }
    for (i = 0; i < x.length; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  /* Si l'utilisateur clique n'importe où en dehors de la boîte de sélection,
    alors fermer toutes les boîtes de sélection : */
  document.addEventListener("click", closeAllSelect);
});
