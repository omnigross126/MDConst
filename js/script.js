function showSlideshow(image) {
    var overlay = document.getElementById("slideshowOverlay");
    var slideshowImage = document.getElementById("slideshowImage");
  
    slideshowImage.src = image.src;
    overlay.style.display = "block";
  }
  
  function hideSlideshow() {
    var overlay = document.getElementById("slideshowOverlay");
  
    overlay.style.display = "none";
  }
  