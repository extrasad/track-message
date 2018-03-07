document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("TrackMessageCookieNotification_Id--3455");
  const close = document.getElementById("TrackMessageCookieNotification_Id--close-5644");

  const trackMssgPosition = function(){
    switch (positionSettings.mssgPosition) { 
      case 'position_top': 
        element.classList.add('TrackMessageNotification__content--top') 
        break 
      case 'position_block_top_right': 
        element.classList.add('TrackMessageNotification__content--top-right')
        break 
      case 'position_block_top_left': 
        element.classList.add('TrackMessageNotification__content--top-left')
        break 
      case 'position_block_bottom_right': 
        element.classList.add('TrackMessageNotification__content--bottom-right')
        break 
      case 'position_block_bottom_left': 
        element.classList.add('TrackMessageNotification__content--bottom-left')
        break 
      default: 
        element.classList.add('TrackMessageNotification__content--bottom')
    }
  }


  	// OPEN MESSAGE CONTAINER
  const openTrackMssg = function(){
    switch (true) { 
      case (openViewSettings.openView === 'fade'): 
        element.classList.add('TrackMessageNotification__content_fade--opennotification') 
        break 
      case (openViewSettings.openView === 'fade-slide' && positionSettings.mssgPosition == 'position_top' ): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-top')
        break 
      case (openViewSettings.openView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-top')
        break 
      case (openViewSettings.openView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-top')
        break 
      case (openViewSettings.openView === 'fade-slide' && positionSettings.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-bottom')
        break
      case (openViewSettings.openView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-bottom')
        break
      case (openViewSettings.openView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_bottom_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-bottom')
        break 
      case (openViewSettings.openView === 'slide' && positionSettings.mssgPosition == 'position_top'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-top')
        break 
      case (openViewSettings.openView === 'slide' && positionSettings.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-top')
        break 
      case (openViewSettings.openView === 'slide' && positionSettings.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-top')
        break 
      case (openViewSettings.openView === 'slide' && positionSettings.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-bottom')
        break
      case (openViewSettings.openView === 'slide' && positionSettings.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-bottom')
        break
      case (openViewSettings.openView === 'slide' && positionSettings.mssgPosition == 'position_block_bottom_right'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-bottom')
        break 
      default: 
        element.classList.add('TrackMessageNotification__content--opennotification')
    }    
  }

  const closeTrackMssg = function(){
    switch (true) { 
      case (closeViewSettings.closeView === 'fade'): 
        element.classList.add('TrackMessageNotification__content_fade--closenotification') 
        break 
      case (closeViewSettings.closeView === 'fade-slide' && positionSettings.mssgPosition == 'position_top' ): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-top')
        break 
      case (closeViewSettings.closeView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-top')
        break 
      case (closeViewSettings.closeView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-top')
        break 
      case (closeViewSettings.closeView === 'fade-slide' && positionSettings.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-bottom')
        break
      case (closeViewSettings.closeView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-bottom')
        break
      case (closeViewSettings.closeView === 'fade-slide' && positionSettings.mssgPosition == 'position_block_bottom_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-bottom')
        break 
      case (closeViewSettings.closeView === 'slide' && positionSettings.mssgPosition == 'position_top'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-top')
        break 
      case (closeViewSettings.closeView === 'slide' && positionSettings.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-top')
        break 
      case (closeViewSettings.closeView === 'slide' && positionSettings.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-top')
        break 
      case (closeViewSettings.closeView === 'slide' && positionSettings.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-bottom')
        break
      case (closeViewSettings.closeView === 'slide' && positionSettings.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-bottom')
        break
      case (closeViewSettings.closeView === 'slide' && positionSettings.mssgPosition == 'position_block_bottom_right'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-bottom')
        break 
      default: 
        element.classList.add('TrackMessageNotification__content--closenotification')
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
  element.addEventListener('DOMContentLoaded', openTrackMssg, false );
  element.addEventListener('DOMContentLoaded', trackMssgPosition, false );
  window.addEventListener('beforeunload', setCookie, false);
  
  
});


   