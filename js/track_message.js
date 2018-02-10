document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("Modal__TrackMessageModal_Id--3455");
  const close = document.getElementById("Modal_TrackMessageModal_Id--close-5644");
  const closeModal = function() {
    element.classList.add("TrackMessageModal__content--closemodal");
  };
  close.addEventListener('click', closeModal, false);
});
    