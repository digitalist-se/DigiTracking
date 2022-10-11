
(function () {


  return function (parameters, TagManager) {

    this.get = function () {
      var clickObjectFunction = parameters.get('clickObjectFunction');
      var clickObjectSelector = parameters.get('clickObjectSelector');
      var clickObjectLookupProperty = parameters.get('clickObjectLookupProperty');
      var clickObjectCustomProperty = parameters.get('clickObjectCustomProperty');
      var clickObjectSecondQuery = parameters.get('clickObjectSecondQuery');
      var clickObjectSecondQuerySelector = parameters.get('clickObjectSecondQuerySelector');
      
      //Only look at data for Click events
      if (MatomoTagManager.dataLayer.get("event") == "mtm.AllElementsClick" ||
        MatomoTagManager.dataLayer.get("event") == "mtm.AllLinksClick" ||
        MatomoTagManager.dataLayer.get("event") == "mtm.AllDownloadsClick") {

        let clickElem =  MatomoTagManager.dataLayer.get('mtm.clickElement'); 
        if (clickObjectFunction == "clickParents") {
          //Validate if parent exists
          if (clickElem.closest(clickObjectSelector) != null) {
            clickElem = clickElem.closest(clickObjectSelector);
            if(clickObjectSecondQuery == true) {
              if (clickElem.querySelector(clickObjectSecondQuerySelector) != null) {
                  clickElem = clickElem.querySelector(clickObjectSecondQuerySelector);
              }
              else {
                 return;    
              }
            }
            //Handle special cases for innerHTML & innerText for others use getAttribute()
            if (clickObjectLookupProperty == "innerHTML")
              return clickElem.innerHTML;
            else if (clickObjectLookupProperty == "innerText")
              return clickElem.innerText;
            else {
              //Make sure the attribute exist before we fetch it
              if (clickElem.hasAttribute(clickObjectCustomProperty))
                return clickElem.getAttribute(clickObjectCustomProperty);
              else
                return "";
            }
          }
          else
            return "";
          }
          else if (clickObjectFunction == "clickChildren") {
            //Validate if child exists
            if (clickElem.querySelector(clickObjectSelector) != null) {
              if(clickObjectSecondQuery == true) {
                if (clickElem.closest(clickObjectSelector).querySelector(clickObjectSecondQuerySelector) != null)
                    clickElem = clickElem.closest(clickObjectSelector).querySelector(clickObjectSecondQuerySelector);
                else
                   return;    
              }
            //Handle special cases for innerHTML & innerText for others use getAttribute()              
              if (clickObjectLookupProperty == "innerHTML")
                return clickElem.querySelector(clickObjectSelector).innerHTML;
              else if (clickObjectLookupProperty == "innerText")
                return clickElem.querySelector(clickObjectSelector).innerText;
              else {
                //Make sure the attribute exist before we fetch it
                if (clickElem.querySelector(clickObjectSelector).hasAttribute(clickObjectCustomProperty))
                  return clickElem.querySelector(clickObjectSelector).getAttribute(clickObjectCustomProperty);
                else
                  return "";
              }
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






