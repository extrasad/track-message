document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("TrackMessageCookieNotification_Id--3455");
  const close = document.getElementById("TrackMessageCookieNotification_Id--close-5644");
  const closeModal = function() {
    if (element.classList.contains("TrackMessageNotification__content--opennotification-bottom")){
    element.classList.add("TrackMessageNotification__content--closenotification-bottom");
    } else {
      element.classList.add("TrackMessageNotification__content--closenotification-top");
    }
  }
  //Setting cookie
  var setCookie = function(){
  var cookieName = 'UserFirstTime';
  var cookieValue = '1';
  var myDate = new Date();
  //Cookie duration (2 months)
  myDate.setMonth(myDate.getMonth() + 2);
  document.cookie = cookieName +"=" + cookieValue + ";expires=" + myDate 
                  + ";path=/";
  };

  // Time duration of the message in the page.
  setTimeout(function () {
    setCookie()
    element.classList.add("TrackMessageNotification__content--closenotification-bottom");
  }, 10*1000);
  close.addEventListener('click', closeModal, false);
  close.addEventListener('click', setCookie, false);
  window.addEventListener('beforeunload', setCookie, false);
  
});

   