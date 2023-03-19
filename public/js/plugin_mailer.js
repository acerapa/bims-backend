
(function (window) {
	'use strict'
	function PluginMailer() {
        
        var Plugin_mailer   = {};
        var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_mailer.sendText = function (content, to_email, to_name, subject) {
            var uri = env_api + "api/plugin_email/sendText?content="+ content +"&to_email="+ to_email +"&to_name="+ to_name +"&subject=" + subject;
			$.get( uri, function (response) {
				callback(response);
			});
        };

        Plugin_mailer.sendHTML = function (content, to_email, to_name, subject) {
            var uri = env_api + "api/plugin_email/sendText?content="+ content +"&to_email="+ to_email +"&to_name="+ to_name +"&subject=" + subject;
			$.get( uri, function (response) {
				callback(response);
			});
        };

        return Plugin_mailer;
	};

	if(typeof(Plugin_mailer) === 'undefined'){
		window.Plugin_mailer = PluginMailer();
	}
}) (window);
