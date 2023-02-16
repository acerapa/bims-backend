
(function (window) {
	'use strict'
	function PluginInquiry() {

        var Plugin_inquiry   = {};

        Plugin_inquiry.send = function (photo_refid) {
            $.get( env_api + "", function (response) {
				callback(response);
			});
        }
        return Plugin_inquiry;
	};

	if(typeof(Plugin_inquiry) === 'undefined'){
		window.Plugin_inquiry = PluginInquiry();
	}
}) (window);
