document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("Modal__TrackMessageModal_Id--3455");
  const close = document.getElementById("Modal_TrackMessageModal_Id--close-5644");
  const closeModal = function() {
    element.classList.add("TrackMessageModal__content--closemodal");
  };
  //Setting cookie
  const setCookie = function(){
  var cookieName = 'UserFirstTime';
  var cookieValue = '1';
  var myDate = new Date();
  //Cookie duration (1 year)
  myDate.setFullYear(myDate.getFullYear() + 1);
  document.cookie = cookieName +"=" + cookieValue + ";expires=" + myDate 
                  + ";path=/";
  };
  close.addEventListener('click', closeModal, false);
  close.addEventListener('click', setCookie, false);
});

   