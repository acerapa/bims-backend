(function (window) {
	'use strict'
	function PluginQuery() {

		/**
		 * JS Partner of plugin_query, a personal collection of custom plugins
		 * See Controller folder for more details
		*/

		var Plugin_query 	= {};

		var env 			= 'local';
		var env_api 		= '';
		var env_local 		= 'http://127.0.0.1:8000/';
		var env_live 		= 'https://mcrichtravel.com/partition-api-multi-purpose/version-1/public/';

		if(env == 'live') {
			env_api = env_live;
		}
		else {
			env_api = env_local;
		}

		Plugin_query.insertRecord = function (table, column, callback) {
			var args = { table: table, column: column };
			$.get( env_api + "api/plugin_query/insertGetId?" + $.param(args), function (response) {
				callback(response);
			});
		};

		Plugin_query.isDataExist = function (table, whereArray, callback) {
			var args = {table: table, where: whereArray};
			  $.get( env_api + "api/plugin_query/isDataExist?" + $.param(args), function (response) {
				callback(response);
			  });
		};
		
		Plugin_query.getRecordBasic = function (table, getColumn, whereColumn, whereValue, callback) {
			$.get( env_api + "api/plugin_query/getRowBasic/"+ table +"/" + getColumn + "/"+ whereColumn +"/" + whereValue, function (response) {
				callback(response);
			});
		};

		Plugin_query.getRowMultiWhere = function (table, getClm, where, orderByClm, orderBySort, callback) {
			var args = {
				table: table,
				getClm: getClm,
				where: where,
				orderByClm: orderByClm,
				orderBySort: orderBySort
			};
			$.get( env_api + "api/plugin_query/getRowMultiWhere?" + $.param(args), function (response) {
				callback(response);
			});
		}

		Plugin_query.getRecordPaginate = function (table, getClm, where, orderByClm, orderBySort, numOfRow, page, callback) {
			var args = {
				table: table,
				getClm: getClm,
				where: where,
				orderByClm: orderByClm,
				orderBySort: orderBySort,
				numOfRow: numOfRow,
				page: page
			};
			  
			$.get( env_api + "api/plugin_query/getRowPaginate?" + $.param(args), function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordBasicJoinTable = function (table_pri, table_sec, join_pri, join_sec, getClmArray, whereArray, orderbyClm, orderbySort, page, rowPerPage, callback) {
			
			var args = {
				table_pri: table_pri,
				table_sec: table_sec,
				join_pri: join_pri,
				join_sec: join_sec,
				getClm: getClmArray,
				where: whereArray,
				orderbyClm: orderbyClm,
				orderbySort: orderbySort,
				page: page,
				rowPerPage: rowPerPage
			}
			  
			$.get( env_api + "api/plugin_query/getJoinTwoTablePaginate?" + $.param(args), function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordPaginateJoinTable = function (table_pri, table_sec, join_pri, join_sec, getClmArray, whereArray, orderbyClm, orderbySort, page, rowPerPage, callback) {
			var args = {
				table_pri: table_pri,
				table_sec: table_sec,
				join_pri: join_pri,
				join_sec: join_sec,
				getClm: getClmArray,
				where: whereArray,
				orderbyClm: orderbyClm,
				orderbySort: orderbySort,
				page: page,
				rowPerPage: rowPerPage
			}
			  
			$.get( env_api + "api/plugin_query/getJoinTwoTablePaginate?" + $.param(args), function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordSearch = function () {

		};

		Plugin_query.updateSingleColumnRecord = function () {

		};

		Plugin_query.updateMultiColumnRecord = function (table, whereArray, updateArray, callback) {
			var args = { table: table, where: whereArray, update: updateArray };	
			$.get( env_api + "api/plugin_query/editMultiple?" + $.param(args), function (response) {
				callback(response);
			});
		};

		Plugin_query.deleteRecord = function (table, whereArray, callback) {
			var args = { table: table, where: whereArray };
			$.get( env_api + "api/plugin_query/deletePermanent?" + $.param(args), function (response) {
				callback(response);
			});
		};

		return Plugin_query;
	};

	if(typeof(Plugin_query) === 'undefined'){
		window.Plugin_query = PluginQuery();
	}
}) (window);