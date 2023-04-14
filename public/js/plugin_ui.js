
(function (window) {
	'use strict'
	function PluginUI() {

        var Plugin_ui       = {};
        var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

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

        Plugin_ui.editModalDataTextArea = function(table, whereClm, whereVal, clmToUpdate, description, oldValue, placeholder, callbackShowLoading, callbackHideLoading, callbackReturn) {
        
            Swal.fire({
                title: "Editor",
                text: description,
                input: 'textarea',
                inputValue: oldValue,
                inputAttributes: {
                    autocapitalize: 'off',
                    autocomplete: 'off',
                    placeholder: placeholder
                },
                showCancelButton: true,
                confirmButtonText: 'OK',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    if(result.value == '') {
                        callbackReturn({ success: false, message: 'Changing with empty value is not allowed'});
                    }
                    else {

			            var uri 	= env_api + "api/plugin_query/editSingle?table="+ table +"&whereClm="+ whereClm +"&whereVal="+ whereVal +"&column=" + clmToUpdate + "&value=" + result.value;

                        callbackShowLoading();
                        $.get( uri, function (response) {
                            callbackHideLoading();
                            callbackReturn(response);
                        });
                    }
                }
            });
        };

        Plugin_ui.editModalDataText = function(table, whereClm, whereVal, clmToUpdate, description, oldValue, placeholder, callbackShowLoading, callbackHideLoading, callbackReturn) {
        
            Swal.fire({
                title: "Editor",
                text: description,
                input: 'text',
                inputValue: oldValue,
                inputAttributes: {
                    autocapitalize: 'off',
                    autocomplete: 'off',
                    placeholder: placeholder
                },
                showCancelButton: true,
                confirmButtonText: 'OK',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    if(result.value == '') {
                        callbackReturn({ success: false, message: 'Changing with empty value is not allowed'});
                    }
                    else {

			            var uri 	= env_api + "api/plugin_query/editSingle?table="+ table +"&whereClm="+ whereClm +"&whereVal="+ whereVal +"&column=" + clmToUpdate + "&value=" + result.value;

                        callbackShowLoading();
                        $.get( uri, function (response) {
                            callbackHideLoading();
                            callbackReturn(response);
                        });
                    }
                }
            });
        };

        Plugin_ui.addRecordModalSingleColumn = function (title, text, table, callbackShowLoading, callbackHideLoading, callbackReturn) {
            Swal.fire({
                title: title,
                text: text,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocomplete: 'off',
                },
                showCancelButton: true,
                confirmButtonText: 'OK',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    if(result.value == '') {
                        callbackReturn({ success: false, message: 'Password is required'});
                    }
                    else {
                        var args = {
                            table: table,
                            column: {
                                first_name: '',
                            }
                        };
                        
                        callbackShowLoading();
                        $.get( env_api + "plugin_query/insertGetId?" + $.param(args), function (response) {
                            callbackHideLoading();
                            console.log(response);
                        });
                    }
                }
            });
        };

        Plugin_ui.deleteModalWithoutPassword = function (title, text, table, whereArray, callbackShowLoading, callbackHideLoading, callbackReturn) {
            Swal.fire({
                title: title,
                text: text,
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    var args = {
                        table: table,
                        where: whereArray
                    };
                    callbackShowLoading();
                    $.get( env_api + "api/plugin_query/deletePermanent?" + $.param(args), function (response) {
                        callbackHideLoading();
                        callbackReturn(response);
                    });
                }
            })
        };

        Plugin_ui.deleteModalWithPassword = function (title, text, table, whereArray, user_refid, callbackShowLoading, callbackHideLoading, callbackReturn) {
            Swal.fire({
                title: title,
                text: text,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocomplete: 'off',
                    placeholder: 'Enter your password to delete'
                },
                showCancelButton: true,
                confirmButtonText: 'Delete',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    if(result.value == '') {
                        callbackReturn({ success: false, message: 'Password is required'});
                    }
                    else {
                        var args = {
                            table: table,
                            where: whereArray,
                            user_refid: user_refid,
                            password: result.value
                        };
                        callbackShowLoading();
                        $.get( env_api + "api/plugin_query/deleteWithPassword?" + $.param(args), function (response) {
                            callbackHideLoading();
                            callbackReturn(response);
                        });
                    }
                }
            });
        };

        return Plugin_ui;
	};

	if(typeof(Plugin_ui) === 'undefined'){
		window.Plugin_ui = PluginUI();
	}
}) (window);
