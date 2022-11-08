(function () {
    return function (parameters, TagManager) {
        this.get = function () {
            var urlPart = parameters.get('urlPart', 'href');
            var loc = parameters.window.location;

            return DigiTracking.url.parseSearchReplaceTexts(loc.href, urlPart);
        };
    };
})();