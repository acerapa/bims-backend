
(function (window) {
	'use strict'
	function PluginValidator() {
        
        var Plugin_validator   = {};
        var env 			= 'local';
		var env_api 		= '';
		var env_local 		= 'http://127.0.0.1:8000/';
		var env_live 		=  window.location.origin + '/partition-api/v1/public/';

        if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

        Plugin_validator.isMobileNumber = function (country_code, input) {
            return true;
        };

        Plugin_validator.isEmailAddress = function (elem, text) {
            return true;
        };

        Plugin_validator.isSecuredPassword = function (password) {
            return true;
        };

        return Plugin_validator;
	};

	if(typeof(Plugin_validator) === 'undefined'){
		window.Plugin_validator = PluginValidator();
	}
}) (window);
