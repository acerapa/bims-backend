
(function (window) {
	'use strict'
	function PluginReferenceID() {

        var Plugin_refid = {};

        Plugin_refid.generateLocal = function (identifier) {

            var date    = new Date();
            var month   = date.getMonth();
            var day     = date.getDay();
            var year    = date.getFullYear();
            var hour    = date.getHours();
            var minute  = date.getMinutes();
            var second  = date.getSeconds();

            if(month < 10)  { month = '0' + month; }
            if(day < 10)    { day = '0' + day; }
            if(hour < 10)   { hour = '0' + hour; }
            if(minute < 10) { minute = '0' + minute; }
            if(second < 10) { second = '0' + second; }

            var datetime = month + '' + day + '' + year + '' + hour+ '' + minute + '' + second;

            let end = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < 3) {
                end += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }
            return identifier + '-' + datetime + '-' + end;
		};

        return Plugin_refid;
	};

	if(typeof(Plugin_refid) === 'undefined') {
		window.Plugin_refid = PluginReferenceID();
	}
}) (window);
