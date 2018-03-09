document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("TrackMessageCookieNotification_Id--3455");
  const close = document.getElementById("TrackMessageCookieNotification_Id--close-5644");

  // Gives the necessary styles so the message looks elegant

  const initClasses = function() {
    element.classList.add('TrackMessageNotification');
  }

  // Remove the display inline style in the TrackMessage main div to load all assets from javascript at once

  const rmClass = function(){
    element.style.removeProperty('display');
  }

  // Selects the message Position

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


    // Open the message depending on the position and effect selected adding a class to the main div of the message
    
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


  // Close the message depending on the position and effect selected and remove de previous open effect class

  const closeTrackMssg = function() {
    if (element.className.includes('opennotification')) {
      var openClass = Array.from(element.classList).filter(function(openClass) {
        return openClass.includes('opennotification');
      })[0];
      element.classList.remove(openClass);
    }
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

  // Load all the functions and styles to show up the message
  const loadAssets = function(){
    rmClass();
    initClasses();
    trackMssgPosition();
    openTrackMssg();
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


  // Events and functions triggers
  
  loadAssets();
  close.addEventListener('click', closeTrackMssg, false);
  close.addEventListener('click', setCookie, false);
  window.addEventListener('beforeunload', setCookie, false);  
});


   