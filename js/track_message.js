document.addEventListener("DOMContentLoaded", function(event) { 
      const element = document.getElementById("modal");
      const close = document.getElementById("close");
      const closeModal = function() {
        element.classList.add("ModalClosed");
      };
      close.addEventListener('click', closeModal, false); 
    });
    
    
    