document.addEventListener("DOMContentLoaded", function(event) { 
    const element = document.getElementById("modal");
    const closeModal = function() {
      element.classList.remove("track-message", "backdrop");
    };
    element.addEventListener('click', closeModal, false); 
  });