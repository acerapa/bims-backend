
(function (window) {
	'use strict'
	function PluginChatbox() {

        var Plugin_chatbox  = {};
        var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];
        var env_config      = {};

        Plugin_chatbox.init = function (config) {
            env_config = config;
            $(document).ready(function () {
                $.get( env_api + "plugin_chatbox", (chatbox_ui) => {
                    $("body").append(chatbox_ui);
                    Plugin_chatbox.theme(config);
                    if(config.user_is_new) {
                        Plugin_chatbox.isNew();
                    }
                    else {
                        //Load list of conversations
                    }
                    console.log(config);
                });
            });
        };

        Plugin_chatbox.theme = function (config) {
            $(".jl-plugin-chatbox .jl-plugin-header").css({ 'background-color': config.theme.header });
            $(".jl-plugin-chatbox .jl-plugin-body").css({ 'background-color': config.theme.body });
            $(".jl-plugin-chatbox .jl-plugin-footer").css({ 'background-color': config.theme.footer });
        };

        Plugin_chatbox.isNew = function () {
            $(".jl-plugin-body").append(
                `<div class="p-3">
                    <div class="form-group row">
                        <label class="col-3" for="inputAddress">Topic</label>
                        <div class="col-9">
                            <p>Unsaon pag patay sa iro nga buhi pa?</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="inputAddress">Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control js-jka4wahncsdf">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="inputAddress">Email</label>
                        <div class="col-9">
                            <input type="text" class="form-control js-kjaxvbsfgde4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3" for="inputAddress">Mobile</label>
                        <div class="col-9">
                            <input type="text" class="form-control js-jkncvxdsder5">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <button class="btn btn-primary w-100 js-hjnxavbxznsd">Start Conversation</button>
                        </div>
                    </div>
                    
                </div>`);
        };

        Plugin_chatbox.getLocalInfo = function () {
            const data = localStorage.getItem("convo_active_info");
            if(data) {
                return JSON.parse(data);
            }
            else {
                return null;
            }
        };

        Plugin_chatbox.isOld = function (callback) {

        };

        Plugin_chatbox.fetchConvo = function (user_refid, callback) {
            
        };

        Plugin_chatbox.fetchThread = function (convo_refid, page, callback) {
            
        };

        Plugin_chatbox.createUser = function (user_refid, name, email, mobile, callback) {
            $.get( env_api + "api/plugin_chatbox/create_user?user_refid=" + user_refid + "&name=" + name + "&email=" + email + "&mobile=" + mobile, function (response) {
                callback(response);
            });
        };

        Plugin_chatbox.createConvo = function (convo_refid, convo_name, subject, subject_refid, subject_link, user_refid, callback) {
            $.get( env_api + "api/plugin_chatbox/create_convo?convo_refid="+ convo_refid +"&name="+ convo_name +"&subject="+ subject +"&subject_refid="+ subject_refid +"&subject_link="+ subject_link +"&user_refid=" + user_refid, function (response) {
                callback(response);
            });
        };

        Plugin_chatbox.connectConvoMember = function (convo_refid, client_refid, callback) {
            var args = {
                convo_refid: convo_refid,
                recepients: env_config['recepient'],
                client_refid: client_refid
            };
            $.get( env_api + "api/plugin_chatbox/member_recepient?" + $.param(args), function (response) {
                callback(response);
            });
        };

        Plugin_chatbox.sendTextMessage = function (convo_refid, content, user_refid, callback ) {
            $.get( env_api + "api/plugin_chatbox/sendText?convo_refid="+ convo_refid +"&content="+ content +"&user_refid=" + user_refid, function (response) {
                callback(response);
            });
        };

        return Plugin_chatbox;
	};

	if(typeof(Plugin_chatbox) === 'undefined'){
		window.Plugin_chatbox = PluginChatbox();
	}

}) (window);

$(document).on("click",".js-vbfgxcvzxcsde", function () {
    var convo_refid     = Plugin_chatbox.getLocalInfo()['convo_refid'];
    var content         = $(".js-klnmxcvazdcsw").val();
    var user_refid      = Plugin_chatbox.getLocalInfo()['client_refid'];
    Plugin_chatbox.sendTextMessage(convo_refid, content, user_refid, function (response) {
        $(".js-klnmxcvazdcsw").val('');
    });
});

$(document).on("click",".js-hjnxavbxznsd", function () {
    
    var user_refid      = Plugin_refid.generateLocal('USR');
    var name            = $(".js-jka4wahncsdf").val();
    var email           = $(".js-kjaxvbsfgde4").val();
    var mobile          = $(".js-jkncvxdsder5").val();
    var convo_refid     = Plugin_refid.generateLocal('CNV');

    var convo_active_info = {
        convo_refid: convo_refid,
        client_refid: user_refid,
        client_name: name,
        client_email: email,
        client_mobile: mobile,
        subject: config.subject,
        subject_refid: config.subject_refid,
        subject_link: config.subject_link
    };
    localStorage.setItem("convo_active_info", JSON.stringify(convo_active_info));

    Plugin_ui.disableButton(".js-hjnxavbxznsd", "Creating account...");
    Plugin_chatbox.createUser(user_refid, name, email, mobile, function (response) {
        if(response.success) {
            Plugin_ui.disableButton(".js-hjnxavbxznsd", "Starting conversation...");
            var convo_name      = name;
            var subject         = Plugin_chatbox.getLocalInfo()['subject'];
            var subject_refid   = Plugin_chatbox.getLocalInfo()['subject_refid'];
            Plugin_chatbox.createConvo(convo_refid, convo_name, subject, subject_refid, config.subject_link, user_refid, function (convo_created) {
                Plugin_ui.disableButton(".js-hjnxavbxznsd", "Connecting to agents...");
                if(convo_created.success) {
                    Plugin_chatbox.connectConvoMember(convo_refid, user_refid, function (convo_recepinet) {
                        $(".jl-plugin-body").html('');
                    });
                }
                else {
                    Swal.fire('Warning','Unable to connect to live agent, try again later.','warning').then( () => {
                        localStorage.removeItem("convo_active_info");
                    });
                }
            });
        }
        else {
            Swal.fire('Warning','Unable to start conversation, try again later.','warning').then( () => {
                Plugin_ui.enableButton(".js-hjnxavbxznsd", "Start Conversation");
                $(".js-jka4wahncsdf").val('');
                $(".js-kjaxvbsfgde4").val('');
                $(".js-jkncvxdsder5").val('');
            });
        }
        
    });
});

