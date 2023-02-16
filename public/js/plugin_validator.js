
(function (window) {
	'use strict'
	function PluginValidator() {
        
        var Plugin_validator   = {};

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
