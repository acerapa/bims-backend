
(function (window) {
	'use strict'
	function PluginUI() {
        var Plugin_ui   = {};

        Plugin_ui.disableButton = function (elem, text) {
            $(elem).prop("disabled", true).text(text).css({'opacity': 0.4, 'cursor':'not-allowed'});
        };

        Plugin_ui.enableButton = function (elem, text) {
            $(elem).prop("disabled", false).text(text).css({'opacity': 1, 'cursor':'pointer'});
        };

        return Plugin_ui;
	};

	if(typeof(Plugin_ui) === 'undefined'){
		window.Plugin_ui = PluginUI();
	}
}) (window);
