document.addEventListener("DOMContentLoaded", function () {
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
});
