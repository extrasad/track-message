document.addEventListener("DOMContentLoaded", function(event) { 
  const modalElement = document.getElementById("modalPlugin");
  const closeModal = function() {
    modalElement.classList.add("ModalClosed");
  };
  modalElement.addEventListener('click', closeModal, false);

});