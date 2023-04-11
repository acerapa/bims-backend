
(function (window) {
	'use strict'
	function PluginFAQ() {

        var Plugin_faq      = {};
        var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_faq.get = function (category, callback) {
            $.get( env_api + "api/plugin_faq/get?category=" + category, function (response) {
                callback(response);
            });
        };

        return Plugin_faq;
	};

	if(typeof(Plugin_faq) === 'undefined'){
		window.Plugin_faq = PluginFAQ();
	}

}) (window);
