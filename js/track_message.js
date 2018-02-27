document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("TrackMessageCookieNotification_Id--3455");
  const close = document.getElementById("TrackMessageCookieNotification_Id--close-5644");
  const closeTrackMssg = function() {
    if (element.classList.contains("TrackMessageNotification__content--opennotification-bottom")){
    element.classList.add("TrackMessageNotification__content--closenotification-bottom");
    } else {
      element.classList.add("TrackMessageNotification__content--closenotification-top");
    }
  }
  // Getting the cookie value if is setted
  var getCookie =function(name){
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
    if (parts.length == 2){
      return parts.pop().split(";").shift();
    }

  }
  //Setting cookie
  var setCookie = function(){
  var cookieName = 'UserFirstTime';
  var cookieValue = '1';
  var myDate = new Date();
  var cookieTime = parseInt(phpValues.cookie);
  //Cookie duration
  myDate.setMonth(myDate.getMonth() + cookieTime);
  //Check if cookie is setted to not reset the cookie.
  var cookie= getCookie("UserFirstTime");
  //Checking cookie value
    if (!cookie  == '1'){
      document.cookie = cookieName +"=" + cookieValue + ";expires=" + myDate 
      + ";path=/";
      }

    };
  // Time duration of the message in the page.
  var messageTime = parseInt(phpValues.message);
  var setTime = setTimeout(function(messageTime) {
    closeTrackMssg()
    setCookie()
  }, messageTime*1000);

  close.addEventListener('click', closeTrackMssg, false);
  close.addEventListener('click', setCookie, false);
  window.addEventListener('beforeunload', setCookie, false);
  
  
});


   