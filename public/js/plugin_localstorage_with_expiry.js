
(function (window) {
	'use strict'
	function PluginLocalStorageWithExpiry() {

        var Plugin_storage  = {};

        Plugin_storage.setItem = function (key, value, milliseconds) {

            var ttl = Plugin_storage.time(milliseconds);

            const now = new Date();
            const item = {
                value: value,
                expiry: now.getTime() + ttl,
            }
            localStorage.setItem(key, JSON.stringify(item));
        };

        Plugin_storage.getItem = function (key) {
            const itemStr = localStorage.getItem(key);
            if (!itemStr) {
                return null
            }
            else {
                const item  = JSON.parse(itemStr);
                const now   = new Date();
                if (now.getTime() > item.expiry) {
                    localStorage.removeItem(key)
		            return null
                }
                else {
                    return item.value;
                }
            }
        };

        Plugin_storage.time = function (word) {
            if(word == 'MIN_01') { return 60000; }
            else if(word == 'MIN_05') { return 300000; }
            else if(word == 'MIN_10') { return 600000; }
            else if(word == 'MIN_15') { return 900000; }
            else if(word == 'MIN_20') { return 1200000; }
            else if(word == 'MIN_25') { return 1500000; }
            else if(word == 'MIN_30') { return 1800000; }
            else if(word == 'MIN_35') { return 2100000; }
            else if(word == 'MIN_40') { return 2400000; }
            else if(word == 'MIN_45') { return 2700000; }
            else if(word == 'MIN_50') { return 3000000; }
            else if(word == 'MIN_55') { return 3300000; }
            else if(word == 'HRS_01') { return 3600000; }
            else if(word == 'HRS_02') { return 7200000; }
            else if(word == 'HRS_03') { return 10800000; }
            else if(word == 'HRS_04') { return 14400000; }
            else if(word == 'HRS_05') { return 18000000; }
            else if(word == 'HRS_06') { return 21600000; }
            else if(word == 'HRS_07') { return 25200000; }
            else if(word == 'HRS_08') { return 28800000; }
            else if(word == 'HRS_09') { return 32400000; }
            else if(word == 'HRS_10') { return 36000000; }
            else if(word == 'HRS_11') { return 39600000; }
            else if(word == 'HRS_12') { return 43200000; }
            else if(word == 'HRS_24') { return 86400000; }
            else { return word; }
        };

        return Plugin_storage;
	};

	if(typeof(Plugin_storage) === 'undefined'){
		window.Plugin_storage = PluginLocalStorageWithExpiry();
	}
}) (window);
