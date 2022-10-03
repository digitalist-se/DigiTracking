
(function () {


  return function (parameters, TagManager) {

    this.get = function () {
      var clickObjectFunction = parameters.get('clickObjectFunction');
      var clickObjectSelector = parameters.get('clickObjectSelector');
      var clickObjectLookupProperty = parameters.get('clickObjectLookupProperty');
      var clickObjectCustomProperty = parameters.get('clickObjectCustomProperty');

      //Only look at data for Click events
      if (MatomoTagManager.dataLayer.get("event") == "mtm.AllElementsClick" ||
        MatomoTagManager.dataLayer.get("event") == "mtm.AllLinksClick" ||
        MatomoTagManager.dataLayer.get("event") == "mtm.AllDownloadsClick") {

        if (clickObjectFunction == "clickParents") {
          //Validate if parent exists
          if (MatomoTagManager.dataLayer.get('mtm.clickElement').closest(clickObjectSelector) != null) {
            //Handle special cases for innerHTML & innerText for others use getAttribute()
            if (clickObjectLookupProperty == "innerHTML")
              return MatomoTagManager.dataLayer.get('mtm.clickElement').closest(clickObjectSelector).innerHTML;
            else if (clickObjectLookupProperty == "innerText")
              return MatomoTagManager.dataLayer.get('mtm.clickElement').closest(clickObjectSelector).innerText;
            else {
              //Make sure the attribute exist before we fetch it
              if (MatomoTagManager.dataLayer.get('mtm.clickElement').closest(clickObjectSelector).hasAttribute(clickObjectCustomProperty))
                return MatomoTagManager.dataLayer.get('mtm.clickElement').closest(clickObjectSelector).getAttribute(clickObjectCustomProperty);
              else
                return "";
            }
          }
          else
            return "";
          }
          else if (clickObjectFunction == "clickChildren") {
            //Validate if child exists
            if (MatomoTagManager.dataLayer.get('mtm.clickElement').querySelector(clickObjectSelector) != null) {
            //Handle special cases for innerHTML & innerText for others use getAttribute()              
              if (clickObjectLookupProperty == "innerHTML")
                return MatomoTagManager.dataLayer.get('mtm.clickElement').querySelector(clickObjectSelector).innerHTML;
              else if (clickObjectLookupProperty == "innerText")
                return MatomoTagManager.dataLayer.get('mtm.clickElement').querySelector(clickObjectSelector).innerText;
              else {
                //Make sure the attribute exist before we fetch it
                if (MatomoTagManager.dataLayer.get('mtm.clickElement').querySelector(clickObjectSelector).hasAttribute(clickObjectCustomProperty))
                  return MatomoTagManager.dataLayer.get('mtm.clickElement').querySelector(clickObjectSelector).getAttribute(clickObjectCustomProperty);
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






