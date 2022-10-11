(function () {
    return function (parameters, TagManager) {
        this.fire = function () {

            //Get configs
            const options = {
                enableOutLinkEvents: '',
                customOutLinkEventCategory: '',
                customOutLinkEventValue: "",
                customOutLinkInternalDomains: '',
                enableDownloadEvents: '',
                customDownloadkEventCategory: '',
                customDownloadEventValue: '',
                enableDownloadExtensions: '',
                enablePhoneClicks: '',
                customPhoneEventCategory: '',
                customPhoneEventValue: '',
                enableMailClicks: '',
                customMailEventCategory: '',
                customMailEventValue: '',
            };
                        
            options.enableOutLinkEvents = parameters.get('enableOutLinkEvents');
            options.customOutLinkEventCategory = parameters.get('customOutLinkEventCategory');
            options.customOutLinkEventValue = parameters.get('customOutLinkEventValuey');
            options.customOutLinkInternalDomains = parameters.get('customOutLinkInternalDomains');
            options.enableDownloadEvents = parameters.get('enableDownloadEvents');
            options.customDownloadkEventCategory = parameters.get('customDownloadkEventCategory');
            options.enableDownloadExtensions = parameters.get('enableDownloadExtensions');
            options.customDownloadEventValue = parameters.get('customDownloadEventValue');
            options.enablePhoneClicks = parameters.get('enablePhoneClicks');
            options.customPhoneEventCategory = parameters.get('customPhoneEventCategory');
            options.customPhoneEventValue = parameters.get('customPhoneEventValue');
            options.enableMailClicks = parameters.get('enableMailClicks');
            options.customMailEventCategory = parameters.get('customMailEventCategory');
            options.customMailEventValue = parameters.get('customMailEventValue');

            let domainChecks = [];

            //Add a general click listner
            document.documentElement.addEventListener('click', function(event) {    
            //TODO add test before so that we only do this if any trackers are enabled
            var _paq = window._paq = window._paq || [];
    
            //TODO - perhaps we want to load all funtions from an external js to keep this file smaller
            //Outlink logic
            let eventLink = event.target.href;
            let domain = window.location.origin;

            // START OUTLINK EVENTS
            //Ignore mail, phone and JS clicks etc  
            if(options.enableOutLinkEvents && event.target != null &&
                eventLink != undefined && 
                eventLink.search("javascript:") == -1 && 
                eventLink.search("mailto:") == -1 &&
                eventLink.search("ftp:") == -1 &&
                eventLink.startsWith("#") == false &&
                eventLink.search("file:") == -1 &&
                eventLink.search("tel:") == -1 ) {
                let isInternal = false; 

                //Add custom domains if they exist
                if(options.customOutLinkInternalDomains != "")
                  domainChecks = options.customOutLinkInternalDomains.split(",");

                domainChecks.push(window.location.origin);    

                //Check if link is in internal domain list 
                for(i=0;i<domainChecks.length;i++) {
                    if(eventLink.search(domainChecks[i]) != -1) {
                        isInternal = true;
                        break;
                    }
                }
                //This seems to be an external link lets send event data
                if(isInternal == false) {
                    //TODO - perhaps add a way to send this via the datalayer (_mtm) instead.
                    _paq.push(['trackEvent', 
                        options.customOutLinkEventCategory , 
                        event.target.innerText + " - " +  eventLink , 
                        window.location.pathname.toLowerCase() ,
                        options.customOutLinkEventValue
                    ]);
                }
            }
            // END OUTLINK EVENTS
            // START DOWNLOAD EVENTS
            if(options.enableDownloadEvents == 1) {
                var extensions = parameters.get('enableDownloadExtensions');
                extensions = String(extensions).split(',');
                var i;
                for (i = 0; i < extensions.length; i++) {
                    extensions[i] = TagManager.utils.trim(extensions[i]);
                }
                var downloadExtensionsPattern = new RegExp('\\.(' + extensions.join('|') + ')([?&#]|$)', 'i');
                if (downloadExtensionsPattern.test(eventLink)) {

                    _paq.push(['trackEvent', 
                        options.customDownloadkEventCategory , 
                        event.target.innerText + " - " +  eventLink , 
                        window.location.pathname.toLowerCase() ,
                        options.customDownloadEventValue
                    ]);
                }

            }
            // END DOWNLOAD EVENTS
            // START PHONE CLICK EVENTS
            if(options.enablePhoneClicks && eventLink != undefined && eventLink.search("tel:") != -1 ) {    
                _paq.push(['trackEvent', 
                    options.customPhoneEventCategory , 
                    event.target.innerText , 
                    window.location.pathname.toLowerCase() ,
                    options.customPhoneEventValue
            ]);

            }
            // END PHONE CLICK  EVENTS
            // START MAIL CLICK EVENTS
            if(options.enableMailClicks && eventLink != undefined && eventLink.search("mailto:") != -1 ) {    
                    _paq.push(['trackEvent', 
                        options.customMailEventCategory , 
                        event.target.innerText , 
                        window.location.pathname.toLowerCase() ,
                        options.customMailEventValue
                ]);
            }
            // END MAIL CLICK EVENTS
         }, true);

        };
    };
})();