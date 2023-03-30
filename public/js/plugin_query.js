(function (window) {
	'use strict'
	function PluginQuery() {
		
		var Plugin_query 	= {};
		var env_api 		= Plugin_config_file.projects()['env_api_multi_purpose'];

		Plugin_query.insertRecord = function (table, column, callback) {

			var args 	= { table: table, column: column };
			var uri 	= env_api + "api/plugin_query/insertGetId?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}

			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.isDataExist = function (table, whereArray, callback) {

			var args 	= {table: table, where: whereArray};
			var uri 	= env_api + "api/plugin_query/isDataExist?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}

			$.get( uri, function (response) {
				callback(response);
			});
		};
		
		Plugin_query.getRecordBasic = function (table, getColumn, whereColumn, whereValue, callback) {

			var uri 	= env_api + "api/plugin_query/getRowBasic/"+ table +"/" + getColumn + "/"+ whereColumn +"/" + whereValue;
			

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
			}

			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.getRowMultiWhere = function (table, getClm, where, orderByClm, orderBySort, callback) {

			var args 	= { table: table, getClm: getClm, where: where, orderByClm: orderByClm, orderBySort: orderBySort };
			var uri 	= env_api + "api/plugin_query/getRowMultiWhere?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}

			$.get( uri, function (response) {
				callback(response);
			});
		}

		Plugin_query.getRecordPaginate = function (table, getClm, where, orderByClm, orderBySort, numOfRow, page, callback) {

			var args 	= { table: table, getClm: getClm, where: where, orderByClm: orderByClm, orderBySort: orderBySort, numOfRow: numOfRow, page: page };
			var uri 	= env_api + "api/plugin_query/getRowPaginate?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}
			  
			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordPaginateWhereIn = function (table, getClm, where, whereInColumn, whereInArray, orderByClm, orderBySort, numOfRow, page, callback) {

			var args 	= { table: table, getClm: getClm, where: where, whereInColumn: whereInColumn, whereInArray:whereInArray, orderByClm: orderByClm, orderBySort: orderBySort, numOfRow: numOfRow, page: page };
			var uri 	= env_api + "api/plugin_query/getRowPaginateWhereIn?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}
			  
			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordBasicJoinTable = function (table_pri, table_sec, join_pri, join_sec, getClmArray, whereArray, orderbyClm, orderbySort, page, rowPerPage, callback) {
			
			var args 	= { table_pri: table_pri, table_sec: table_sec, join_pri: join_pri, join_sec: join_sec, getClm: getClmArray, where: whereArray, orderbyClm: orderbyClm, orderbySort: orderbySort, page: page, rowPerPage: rowPerPage }
			var uri 	= env_api + "api/plugin_query/getJoinTwoTablePaginate?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}
			  
			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordPaginateJoinTable = function (table_pri, table_sec, join_pri, join_sec, getClmArray, whereArray, orderbyClm, orderbySort, page, rowPerPage, callback) {
			
			var args = { table_pri: table_pri, table_sec: table_sec, join_pri: join_pri, join_sec: join_sec, getClm: getClmArray, where: whereArray, orderbyClm: orderbyClm, orderbySort: orderbySort, page: page, rowPerPage: rowPerPage }
			var uri = env_api + "api/plugin_query/getJoinTwoTablePaginate?" + $.param(args);
			
			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}
			  
			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.getRecordSearchBasic = function () {};

		Plugin_query.getRecordSearchPaginate = function () {};

		Plugin_query.updateSingleColumnRecord = function () {
			
		};

		Plugin_query.updateMultiColumnRecord = function (table, whereArray, updateArray, callback) {

			var args 	= { table: table, where: whereArray, update: updateArray };
			var uri 	= env_api + "api/plugin_query/editMultiple?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}

			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.deleteRecord = function (table, whereArray, callback) {

			var args 	= { table: table, where: whereArray };
			var uri 	= env_api + "api/plugin_query/deletePermanent?" + $.param(args);

			if(Plugin_config_file.projects()['env'] == 'local') {
				console.log("Request to:");
				console.log(uri);
				console.log(args);
			}

			$.get( uri, function (response) {
				callback(response);
			});
		};

		Plugin_query.count = function (table, where, callback) {
			var args = { table: table, where: where };
			$.get( env_api + "api/plugin_query/count?" + $.param(args), function (response) {
				callback(response);
			});
		};

		Plugin_query.sum = function (table, where, column, callback) {
			var args = {
				table: table,
				where: where,
				column: column
			};
			$.get( env_api + "api/plugin_query/sum?" + $.param(args), function (response) {
				callback(response);
			});
		}

		return Plugin_query;
	};

	if(typeof(Plugin_query) === 'undefined'){
		window.Plugin_query = PluginQuery();
	}
}) (window);