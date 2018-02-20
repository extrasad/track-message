document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("TrackMessageCookieNotification_Id--3455");
  const close = document.getElementById("TrackMessageCookieNotification_Id--close-5644");
  const closeModal = function() {
    element.classList.add("TrackMessageNotification__content--closenotification");
  };
  //Setting cookie
  const setCookie = function(){
  var cookieName = 'UserFirstTime';
  var cookieValue = '1';
  var myDate = new Date();
  //Cookie duration (2 months)
  myDate.setMonth(myDate.getMonth() + 2);
  document.cookie = cookieName +"=" + cookieValue + ";expires=" + myDate 
                  + ";path=/";
  };
  close.addEventListener('click', closeModal, false);
  close.addEventListener('click', setCookie, false);
});

   