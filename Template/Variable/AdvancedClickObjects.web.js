
(function () {


  return function (parameters, TagManager) {


    this.get = function () {
      var clickObjectFunction = parameters.get('clickObjectFunction');
      var customclickObjectDirection = parameters.get('customclickObjectDirection');
      var customclickObjectFixedLevels = parameters.get('customclickObjectFixedLevels');
      var clickObjectSelector = parameters.get('clickObjectSelector');
      var clickObjectLookupProperty = parameters.get('clickObjectLookupProperty');
      var clickObjectCustomProperty = parameters.get('clickObjectCustomProperty');
      var clickObjectSecondQuery = parameters.get('clickObjectSecondQuery');
      var clickObjectSecondQuerySelector = parameters.get('clickObjectSecondQuerySelector');
      

      function getClickElemAttribute(theClickElem) {
        if (clickObjectLookupProperty == "innerHTML")
          return theClickElem.innerHTML;
        else if (clickObjectLookupProperty == "innerText")
          return theClickElem.innerText;
        else {
          //Make sure the attribute exist before we fetch it
          if(clickObjectLookupProperty == "className")
            return theClickElem.className;
          else if(clickObjectLookupProperty == "innerText") 
            return theClickElem.innerText;
          else if(clickObjectLookupProperty == "innerHTML") 
            return theClickElem.innerHTML;            
          else if (clickObjectLookupProperty == "custom" && theClickElem.hasAttribute(clickObjectCustomProperty))
            return theClickElem.getAttribute(clickObjectCustomProperty);
          else
            return "";
        }
      }
      //Only look at data for Click events
      if (MatomoTagManager.dataLayer.get("event") == "mtm.AllElementsClick" ||
        MatomoTagManager.dataLayer.get("event") == "mtm.AllLinksClick" ||
        MatomoTagManager.dataLayer.get("event") == "mtm.AllDownloadsClick") {

        let clickElem =  MatomoTagManager.dataLayer.get('mtm.clickElement'); 
        if (clickObjectFunction == "clickFixedLevels") {
          if(customclickObjectDirection == 'up') {
            for(i=0;i<customclickObjectFixedLevels;i++) {
              //console.log(clickElem);
              if(clickElem.parentElement != undefined)
                clickElem = clickElem.parentElement;
              else
               return "";
            }
          }
          else if(customclickObjectDirection == 'down') {
            for(i=0;i<customclickObjectFixedLevels;i++) {
              if(clickElem.firstElementChild != undefined)
                clickElem = clickElem.firstElementChild;
              else
                return "";
            }
          }
          return getClickElemAttribute(clickElem);
        }
        if (clickObjectFunction == "clickParents") {
          //Validate if parent exists
          if (clickElem.closest(clickObjectSelector) != null) {
            clickElem = clickElem.closest(clickObjectSelector);
            if(clickObjectSecondQuery == true) {
              if(clickElem != null) {
                if (clickElem.querySelector(clickObjectSecondQuerySelector) != null) {
                    clickElem = clickElem.querySelector(clickObjectSecondQuerySelector);
                }
                else {
                  return "";    
                }
              }
              else {
                return "";    
              }
            }
            return getClickElemAttribute(clickElem);
          }
          else
            return "";
          }
          else if (clickObjectFunction == "clickChildren") {
            //Validate if child exists
            if (clickElem.querySelector(clickObjectSelector) != null) {
              //console.log(clickElem.querySelector(clickObjectSelector));
              if(clickObjectSecondQuery == true) {
                  if(clickElem.closest(clickObjectSelector) != null) {
                    clickElem = clickElem.closest(clickObjectSelector);
                    //console.log(clickElem);
                    if (clickElem.querySelector(clickObjectSecondQuerySelector) != null) {
                        clickElem = clickElem.querySelector(clickObjectSecondQuerySelector);
                        //console.log(clickElem);
                        return clickElem;
                    }
                    else
                      return "";  
                  }  
                else
                  return ""; 
              }
              return getClickElemAttribute(clickElem);
            }
            else
              return "";
          }
          else
            return "";
        }
        else return "";
      };
    };
  }) ();






