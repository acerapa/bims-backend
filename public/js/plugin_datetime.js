
(function (window) {
	'use strict'
	function PluginDateTime() {

        var Plugin_datetime = {};

        Plugin_datetime.dbDateOnly = function (date) {
            date = new Date(date);
            return date.toDateString();
        },

        Plugin_datetime.time24To12Format = function (time) {
            var datetime = "2023-02-07 " + time;
            var newdates = new Date(datetime);
            return newdates.toLocaleTimeString();
		};

		Plugin_datetime.getDateTime = function () {
			var date    = new Date();
            var month   = date.getMonth() + 1;
            var day     = date.getDate();
            var year    = date.getFullYear();
            var hour    = date.getHours();
            var minute  = date.getMinutes();
            var second  = date.getSeconds();

            if(month < 10)  { month = '0' + month; }
            if(day < 10)    { day = '0' + day; }
            if(hour < 10)   { hour = '0' + hour; }
            if(minute < 10) { minute = '0' + minute; }
            if(second < 10) { second = '0' + second; }

            return year + '-' + month + '-' + day + ' ' + hour+ ':' + minute + ':' + second;
			
		}

        return Plugin_datetime;
	};

	if(typeof(Plugin_datetime) === 'undefined'){
		window.Plugin_datetime = PluginDateTime();
	}



}) (window);
