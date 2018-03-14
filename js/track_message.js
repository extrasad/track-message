document.addEventListener("DOMContentLoaded", function(event) { 
  const element = document.getElementById("TrackMessageCookieNotification_Id--3455");
  const close = document.getElementById("TrackMessageCookieNotification_Id--close-5644");
  var url;
  
  // Takes the value from checkbox policy_link to decide if it will apply policyTabSelector

  const targetSelector= function(){
    if ( phpValues.policyLink == 1 ){
      url = document.getElementById('TrackMessageCookieNotification__url-Id--2443');
      policyTabSelector();
    }
  }

  // If the user checked the optional header this will display his custom header or default header

  const mssgHeader = function(){
    if (phpValues.mssgHeaderSelector == 1){
      var headerText = phpValues.mssgHeaderText;
      var header = document.createElement("h5");
      header.setAttribute("class","TrackMessageCookieNotification__header");
      var text = document.createTextNode(headerText);
      header.appendChild(text);
      element.insertBefore(header, element.childNodes[0]);
    }
  }

  // Gives the necessary styles so the message looks elegant

  const initClasses = function() {
    element.classList.add('TrackMessageNotification');
  }

  // Remove the display inline style in the TrackMessage main div to load all assets from javascript at once

  const rmClass = function(){
    element.style.removeProperty('display');
  }

  // Takes the values from policy_tab_selector to determine the current attribute

  const policyTabSelector = function(){
    switch ( phpValues.tabSelector ) {
      case '_self':
        url.setAttribute('target','_self')
        break
      default:
        url.setAttribute('target','_blank')
    }
  }

  // Selects the message Position

  const trackMssgPosition = function(){
    switch (phpValues.mssgPosition) { 
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
      case (phpValues.openView === 'fade'): 
        element.classList.add('TrackMessageNotification__content_fade--opennotification') 
        break 
      case (phpValues.openView === 'fade-slide' && phpValues.mssgPosition == 'position_top' ): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-top')
        break 
      case (phpValues.openView === 'fade-slide' && phpValues.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-top')
        break 
      case (phpValues.openView === 'fade-slide' && phpValues.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-top')
        break 
      case (phpValues.openView === 'fade-slide' && phpValues.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-bottom')
        break
      case (phpValues.openView === 'fade-slide' && phpValues.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-bottom')
        break
      case (phpValues.openView === 'fade-slide' && phpValues.mssgPosition == 'position_block_bottom_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--opennotification-bottom')
        break 
      case (phpValues.openView === 'slide' && phpValues.mssgPosition == 'position_top'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-top')
        break 
      case (phpValues.openView === 'slide' && phpValues.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-top')
        break 
      case (phpValues.openView === 'slide' && phpValues.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-top')
        break 
      case (phpValues.openView === 'slide' && phpValues.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-bottom')
        break
      case (phpValues.openView === 'slide' && phpValues.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_slide--opennotification-bottom')
        break
      case (phpValues.openView === 'slide' && phpValues.mssgPosition == 'position_block_bottom_right'): 
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
      case (phpValues.closeView === 'fade'): 
        element.classList.add('TrackMessageNotification__content_fade--closenotification')
        break 
      case (phpValues.closeView === 'fade-slide' && phpValues.mssgPosition == 'position_top' ): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-top')
        break 
      case (phpValues.closeView === 'fade-slide' && phpValues.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-top')
        break 
      case (phpValues.closeView === 'fade-slide' && phpValues.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-top')
        break 
      case (phpValues.closeView === 'fade-slide' && phpValues.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-bottom')
        break
      case (phpValues.closeView === 'fade-slide' && phpValues.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-bottom')
        break
      case (phpValues.closeView === 'fade-slide' && phpValues.mssgPosition == 'position_block_bottom_right'): 
        element.classList.add('TrackMessageNotification__content_fade-slide--closenotification-bottom')
        break 
      case (phpValues.closeView === 'slide' && phpValues.mssgPosition == 'position_top'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-top')
        break 
      case (phpValues.closeView === 'slide' && phpValues.mssgPosition == 'position_block_top_right'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-top')
        break 
      case (phpValues.closeView === 'slide' && phpValues.mssgPosition == 'position_block_top_left'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-top')
        break 
      case (phpValues.closeView === 'slide' && phpValues.mssgPosition == 'position_bottom'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-bottom')
        break
      case (phpValues.closeView === 'slide' && phpValues.mssgPosition == 'position_block_bottom_left'): 
        element.classList.add('TrackMessageNotification__content_slide--closenotification-bottom')
        break
      case (phpValues.closeView === 'slide' && phpValues.mssgPosition == 'position_block_bottom_right'): 
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
    targetSelector();
    mssgHeader();
  }
  const loadSettings = function(){
    closeSettings();
    firstPageSettings();
  }


  // Getting the cookie value if is setted
  var getCookie =function(name){
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
      if (parts.length == 2){
        return parts.pop().split(";").shift();
      }
  };
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
  var closeSettings = function(){
    var closeOption = phpValues.close;
    var mandatoryAccept = parseInt(phpValues.mandatoryAccept);
      switch(closeOption){
        case('scroll'):
          var settingScroll = function(){
            var scrollDistance = parseInt(phpValues.scrollDistance);
              scrollTop = window.pageYOffset
                if(scrollTop >= scrollDistance && mandatoryAccept == 0){
                  setCookie()
                  closeTrackMssg()
                  window.removeEventListener('scroll', settingScroll, false);
                }
            }
          window.addEventListener('scroll', settingScroll, false);
        break;
        case('click'):
          close.addEventListener('click', closeTrackMssg, false);
          close.addEventListener('click', setCookie, false);
        break;
        case('time'):
          var messageTime = parseInt(phpValues.message);
          if(mandatoryAccept == 0){
            var setTime = setTimeout(function(messageTime) {
              setCookie()
              closeTrackMssg()
            }, messageTime*1000);
          }
        break;      
    }
  };
  var firstPageSettings = function(){
    var firstPage = parseInt(phpValues.firstPage);
      if (firstPage === 1){
        setCookie()
      }
  }
  
  loadAssets();
  loadSettings();
  close.addEventListener('click', closeTrackMssg, false);
  close.addEventListener('click', setCookie, false);

 
});