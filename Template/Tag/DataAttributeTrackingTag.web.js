(function () {
    return function (parameters, TagManager) {
        this.fire = function () {

            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = Matomo.getTracker().getPiwikUrl() + "/plugins/DigiTracking/javascript/data-attribute-tracking.js";
            
            document.getElementsByTagName('head')[0].appendChild(script);
            
            //Get configs
            const options = {
                useDataLayer: '',
                customEvent: '',
                customEventCategory: '',
                customEvenAction: '',
                customEventName: '',
                customEventValue: ''
            };

            options.useDataLayer = parameters.get('useDataLayer');
            options.customEvent = parameters.get('customEvent');
            options.customEventCategory = parameters.get('customEventCategory');
            options.customEvenAction = parameters.get('customEvenAction');
            options.customEventName = parameters.get('customEventName');
            options.customEventValue = parameters.get('customEventValue');

            // Detect clicks on elements with data attribute data-event-category or data-event-include
            document.documentElement.addEventListener('click', function(event) {
                
                if (event.target.getAttribute('data-event-category') != null) {
                    sendEventData(event.target,options);
                } else if (event.target.getAttribute('data-event-include') != null) {
                    sendEventData(event.target.closest('[data-event-category]'),options);
                }
            }, true);
                        



        };
    };
})();