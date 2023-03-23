
(function (window) {
	'use strict'
	function PluginUI() {
        var Plugin_ui   = {};

        Plugin_ui.populateDropdown = function (elem, options, defaultVal) {
            $(elem).html('');
            $(elem).append(`<option value='0'>Select</option>`);
            for(let i = 0; i < options.length; i++) {
                if(options[i]['value'] == defaultVal) {
                    $(elem).append(`<option value='`+ options[i]['value'] +`' selected>`+ options[i]['label'] +`</option>`);
                }
                else {
                    $(elem).append(`<option value='`+ options[i]['value'] +`'>`+ options[i]['label'] +`</option>`);
                }
            }
        };

        Plugin_ui.buttonUploading = function (isUploading, elem, label) {
            if(isUploading) {
                $(elem).prop("disabled", true).css({'cursor':'not-allowed'});
                $(elem + " .spinner-border").css({'display':'block'});
                $(elem + " span").text(label);
            }
            else {
                $(elem).prop("disabled", false).css({'cursor':'pointer'});
                $(elem + " .spinner-border").css({'display':'none'});
                $(elem + " span").text(label);
            }
        };

        Plugin_ui.disableButton = function (elem, text) {
            if($(elem).is('button')) {
                $(elem).prop("disabled", true).text(text).css({'opacity': 0.4, 'cursor':'not-allowed'});
            }
            else {
                $(elem).prop("disabled", true).val(text).css({'opacity': 0.4, 'cursor':'not-allowed'});
            }
        };

        Plugin_ui.enableButton = function (elem, text) {
            if($(elem).is('button')) {
                $(elem).prop("disabled", false).text(text).css({'opacity': 1, 'cursor':'pointer'});
            }
            else {
                $(elem).prop("disabled", false).val(text).css({'opacity': 1, 'cursor':'pointer'});
            }
        };

        return Plugin_ui;
	};

	if(typeof(Plugin_ui) === 'undefined'){
		window.Plugin_ui = PluginUI();
	}
}) (window);
