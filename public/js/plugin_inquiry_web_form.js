
(function (window) {
	'use strict'
	function PluginInquiryWebForm() {

        var Plugin_inquiry_web_form     = {};
        var env_api 		            = Plugin_config_file.projects()['env_api_multi_purpose'];

        Plugin_inquiry_web_form.send = function (name, email, subject, message, taglist, callback) {

			if(name == '') {
				callback({ success: false, message: 'Name is required' });
			}
			else if(email == '') {
				callback({ success: false, message: 'Email is required' });
			}
			else if(subject == '') {
				callback({ success: false, message: 'Subject is required' });
			}
			else if(message == '') {
				callback({ success: false, message: 'Inquiry message is required' });
			}
			else {
				var uri 	= env_api + "api/plugin_inquiry_web_form/send?name="+ name +"&email="+ email +"&subject="+ subject +"&message=" + message + "&taglist=" + taglist;
				if(Plugin_config_file.projects()['env'] == 'local') {
					console.log("Request to:");
					console.log(uri);
				}
				$.get( uri, function (response) {
					callback(response);
				});
			}
        }
        return Plugin_inquiry_web_form;
	};

	if(typeof(Plugin_inquiry_web_form) === 'undefined'){
		window.Plugin_inquiry_web_form = PluginInquiryWebForm();
	}
}) (window);
