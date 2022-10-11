// Data-attribute tracking by
// Tomas Persson - Digitalist.se 
// This script will send events to Matomo TagManager

/**
Usage:
Add this script to any page where you have the Matomo script running.
The script will catch clicks on elements with the data attribute data-event-category or data-event-include
An example would be
<div data-event-category="Button"
        data-event-action="Click"
       data-event-name="Buy Milk"
       data-event-value="4">
            <a href="https://example.com" data-event-include>Click Me!</a>
            <i class="arrow" data-event-include>
</div>
Note: You will need to have set upp the following items in the TagManager
Trigger named: customEvent 
Variable (datalayer) named: eventCategory
Variable (datalayer) named: eventAction
Variable (datalayer) named: eventName
Variable (datalayer) named: eventValue
Finally you need to set up an Event Tag using the triggers and variables above that sends an event to Matomo.
**/

//Get Matomo Tag Manager
var _mtm = window._mtm = window._mtm || [];
var _paq = window._paq = window._paq || [];

// Send data to Matomo function
function sendEventData(elem,options) {
    let cat = options.customEventCategory;
    let act = options.customEvenAction;
    let nam = options.customEventName;
    let val = options.customEventValue;
    let action = "";
    if(elem.getAttribute('data-event-action') != null)
        action = elem.getAttribute('data-event-action');
    let name = "";
    if(elem.getAttribute('data-event-name') != null)
        name = elem.getAttribute('data-event-name');     
    let value = 0;
    if(elem.getAttribute('data-event-value') != null)
        value = elem.getAttribute('data-event-value');  

    if(options.useDataLayer)    {
            _mtm.push({
                'event': options.customEvent,
                        cat : elem.getAttribute('data-event-category'),
                        act : action,
                        nam : name,
                        val : value
              });  
    }          
     else {
        _paq.push(['trackEvent', 
                elem.getAttribute('data-event-category'), 
                action, 
                name,
                value
            ]);

     }

}
// Javascript polyfill for the function .closest for IE9+
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype['msMatchesSelector'] || Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;

        do {
            if (el.matches(s)) {
                return el;
            }
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}    
// END - Javascript polyfill for the function .closest for IE9+

