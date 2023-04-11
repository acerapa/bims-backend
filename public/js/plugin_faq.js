
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

        Plugin_faq.modalInitAddFAQ = function () {
            $('html body').append(`
                <div class="modal js-faq-add-entry-bza91ovskvw5" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark">New FAQ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg-white">
                                <form>
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input type="text" class="form-control js-faq-add-question-naxcvsdfger4">
                                    </div>
                                    <div class="form-group">
                                        <label>Answer</label>
                                        <textarea class="form-control js-faq-add-question-klavxvcdfgr5" rows="10"></textarea>
                                    </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary js-faq-save-klavxvcdfgr5">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>`);
        };

        Plugin_faq.save = function (callback) {
            var reference_id    = Plugin_refid.generateLocal('FAQ');
            var question        = $(".js-faq-add-question-naxcvsdfger4").val();
            var answer          = $(".js-faq-add-question-klavxvcdfgr5").val();
            if(question == '') {
                callback({ success: false, message: "Question is required" });
            }
            else if(answer == '') {
                callback({ success: false, message: "Answer is required" });
            }
            else {
                const column = {
                    reference_id: reference_id ,
                    question: question,
                    answer: answer,
                    created_by: Plugin_auth.getLocalUser()['reference_id']
                };
                Plugin_ui.disableButton(".js-faq-save-klavxvcdfgr5", "Saving...");
                Plugin_query.insertRecord("plugin_faq", column, function (response) {
                    Plugin_ui.enableButton(".js-faq-save-klavxvcdfgr5", "Save");
                    if(response.success) {
                        $(".js-faq-add-question-naxcvsdfger4").val('');
                        $(".js-faq-add-question-klavxvcdfgr5").val('');
                        Plugin_faq.modalCloseAddFAQ();
                        callback({ success: true, message: "New FAQ successfully added." })
                    }
                    else {
                        callback({ success: false, message: "Something went wrong, please try again later." });
                    }
                });
            }
        };

        Plugin_faq.modalOpenAddFAQ = function () {
            $(document).ready(function () {
                $(".js-faq-add-entry-bza91ovskvw5").modal("show");
            });
        };

        Plugin_faq.modalCloseAddFAQ = function () {
            $(document).ready(function () {
                $(".js-faq-add-entry-bza91ovskvw5").modal("hide");
            });
        };

        return Plugin_faq;
	};

	if(typeof(Plugin_faq) === 'undefined'){
		window.Plugin_faq = PluginFAQ();
	}

}) (window);
