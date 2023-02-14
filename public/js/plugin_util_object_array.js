
(function (window) {
	'use strict'
	function PluginUtilObjectArray() {
        
        var Plugin_UtilObjArr   = {};
       
        Plugin_UtilObjArr.removeObjectInArrayByIndex = function (arrList, objIndex, callback) {
            var temp = [];
            for(let i = 0; i < arrList.length; i++) {
                if(i == objIndex) {
                    /** Skip the object to remove */
                }
                else {
                    temp.push(arrList[i]);
                }
            }
            callback(temp);
        };

        Plugin_UtilObjArr.pushObjectToArray = function (arrList, obj, callback) {
            var temp = [];
            for(let i = 0; i < arrList.length; i++) {
                temp.push(arrList[i]);
            }
            temp.push(obj);
            callback(temp);
        };

        return Plugin_UtilObjArr;
	};

	if(typeof(Plugin_UtilObjArr) === 'undefined'){
		window.Plugin_UtilObjArr = PluginUtilObjectArray();
	}
}) (window);
